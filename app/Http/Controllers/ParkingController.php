<?php

namespace App\Http\Controllers;

use App\filters\ParkingSpaceFilter;
use App\ParkingSpace;
use App\Payment;
use App\Requests;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Paynow\Http\ConnectionException;
use Paynow\Payments\HashMismatchException;
use Paynow\Payments\InvalidIntegrationException;
use Paynow\Payments\Paynow;

class ParkingController extends Controller
{
    public function index(ParkingSpaceFilter $filter)
    {
        $raw = ParkingSpace::filter($filter , []);
        $locations = $raw->get();
        $list = $raw->latest()->paginate(5);

        return view('parking.index', [
            'locations' =>  $locations,
            'list' =>  $list,
        ]);

    }

    public function create(ParkingSpace $location){

        $cars = Vehicle::query()->where('user_id', auth()->id())->get();

        return view('booking.form' , [
            'location' => $location,
            'cars' => $cars
        ]);
    }

    public function store(ParkingSpace $location){

        $request = Requests::query()->create([
            'user_id' => auth()->id(),
            'vehicle_id' => \request()->get('vehicle'),
            'parking_space_id' => $location->id,
            'status' => 'init',
            'number' => (int)\request()->get('number'),
            'type' => \request()->get('type'),
            'amount' => (int)\request()->get('number') * $location->rate
        ]);

        $request->update([
            'ref' => strtolower(Str::random(10)).
                     '-'.strtolower(Str::random(10)).
                     '-'.strtolower(Str::random(10)).
                     '-'.strtolower(Str::random(10)).
                     '-'.$request->id.
                    '-'.strtolower(Str::random(10)),
            'end' => $request->created_at->addHours((int)\request()->get('number')),
        ]);

        return view('booking.confirm', [
            'request' => $request,
            'location' => $location
        ]);

    }

    public function accept(Requests $request){

        // create paynow transaction

        $paynow = new Paynow(
            '',
            '',
            url("/parking/{$request->id}/online?ref={$request->ref}&id={$request->id}"),
            url("/parking/{$request->id}/online?ref={$request->ref}&id={$request->id}")
        );

        $payment = $paynow->createPayment("Payment Parking #{$request->id}", $request->user->email );
        $payment->add('Parking', $request->amount );

        try {

            $response = $paynow->send($payment);
            $data['gateway'] = $response->data();
            $request->update([
                'data' => $data
            ]);

            if($response->success())
            {
                $link = $response->redirectUrl();
                $request->update([
                    'follow_link' => $response->pollUrl(),
                    'link' => $link
                ]);
                return view('booking.checkout' , [
                    'request' => $request,
                    'location' => $request->location,
                    'link' => $link
                ]);
            }

        } catch (ConnectionException $e) {
        } catch (HashMismatchException $e) {
        } catch (InvalidIntegrationException $e) {
        } catch (\Exception $e) {}

        return view('booking.error' , [
            'request' => $request,
            'location' => $request->location,
        ]);

    }

    public function online(Requests $request){

        if ((int)$request->id === (int)\request()->get('id') && $request->ref === \request()->get('ref')){

            $request = $this->authorisePayment($request);
            $location = $request->location;

            return view('booking.success' , [
                'location' => $location,
                'request' => $request,
            ]);
        }

        $location = $request->location;

        return view('booking.error-end' , [
            'location' => $location,
            'request' => $request,
        ]);

    }

    public function override(Requests $request){

        $request = $this->authorisePayment($request);
        $location = $request->location;

        return view('booking.success' , [
            'location' => $location,
            'request' => $request,
        ]);

    }

    /**
     * @param Requests $request
     * @return Requests
     */
    public function authorisePayment(Requests $request): Requests
    {
        $location = $request->location;

        $location->update([
            'occupied' => $request->type == 'park' ? now() : null,
            'occupied_user_id' => $request->type == 'park' ? $request->user_id : null,
            'reserved' => $request->type == 'reserve' ? now() : null,
            'reserved_user_id' => $request->type == 'reserve' ? $request->user_id : null,
            'vehicle_id' => $request->type == 'reserve' || $request->user_id == 'park' ? $request->vehicle_id : null,
        ]);

        $request->update([
            'status' => 'completed'
        ]);

        Payment::query()->updateOrCreate([
            'user_id' => $request->user_id,
            'request_id' => $request->id,
            'amount' => $request->amount,
        ], [
            'user_id' => $request->user_id,
            'request_id' => $request->id,
            'amount' => $request->amount,
        ]);

        return $request;
    }
}
