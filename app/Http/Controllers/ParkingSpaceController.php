<?php /** @noinspection MethodShouldBeFinalInspection */

namespace App\Http\Controllers;
use App\filters\ParkingSpaceFilter;
use App\ParkingSpace;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParkingSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ParkingSpaceFilter $filter)
    {

        $locations = ParkingSpace::filter($filter , [])->orderBy('id','desc')->paginate(5);

        return view('parking-space.index', [
            'locations' => $locations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('parking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'lat' => ['required'],
            'long' => ['required'],
            'name' => ['required'],
            'road' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'country' => ['required'],
            'rate' => ['required'],
        ]);


        ParkingSpace::query()->create([
            'lat' => $request->get('lat'),
            'long' => $request->get('long'),
            'name' => $request->get('name'),
            'road' => $request->get('road'),
            'city' => $request->get('city'),
            'province' => $request->get('province'),
            'country' => $request->get('country'),
            'rate' => $request->get('rate'),
        ]);

        return back()->with('message' , 'Parking Space was successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParkingSpace  $parkingSpace
     * @return Response
     */
    public function show(ParkingSpace $parkingSpace)
    {
        return view('parking.view' , [
            'parkingSpace' => $parkingSpace
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ParkingSpace $location
     * @return Response
     */
    public function edit(ParkingSpace $location)
    {
        return view('parking-space.edit' , [
            'location' => $location
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ParkingSpace $location
     * @return Response
     */
    public function update(Request $request, ParkingSpace $location)
    {
        $request->validate([
            'lat' => ['required'],
            'long' => ['required'],
            'name' => ['required'],
            'road' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'country' => ['required'],
            'rate' => ['required'],
        ]);

        $location->update([
            'lat' => $request->get('lat'),
            'long' => $request->get('long'),
            'name' => $request->get('name'),
            'road' => $request->get('road'),
            'city' => $request->get('city'),
            'province' => $request->get('province'),
            'country' => $request->get('country'),
            'rate' => $request->get('rate'),
        ]);


        return back()->with('message' , 'Parking Space was successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParkingSpace $location
     * @return Response
     * @throws \Exception
     */
    public function destroy(ParkingSpace $location)
    {
        $location->delete();
        return back()->with('message' , 'Parking Space was successfully deleted');
    }

    /**
     * @param ParkingSpace $location
     * @return RedirectResponse
     */
    public function activate(ParkingSpace $location) : RedirectResponse
    {
        $location->update([
            'status' => 'active'
        ]);
        return back()->with('message' , 'Parking Space was successfully activated');
    }

    /**
     * @param ParkingSpace $location
     * @return RedirectResponse
     */
    public function block(ParkingSpace $location) : RedirectResponse
    {
        $location->update([
            'status' => 'blocked'
        ]);
        return back()->with('message' , 'Parking Space was successfully blocked');
    }
}
