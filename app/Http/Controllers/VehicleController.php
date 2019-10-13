<?php

namespace App\Http\Controllers;

use App\filters\VehicleFilter;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param VehicleFilter $filter
     * @return \Illuminate\Http\Response
     */
    public function index(VehicleFilter $filter)
    {
        $vehicles = Vehicle::filter($filter , [])->latest()->paginate(20);

        return  view('vehicle.index' , [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
        ]);

        Vehicle::query()->create([
            'number' => $request->get('number'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'user_id' => auth()->id(),
        ]);

        return back()->with('message' , 'Vehicle was successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicle.view' , [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.edit' , [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'number' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
        ]);

        $vehicle->update([
            'number' => $request->get('number'),
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return back()->with('message' , 'Vehicle was successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return back()->with('message' , 'Vehicle was successfully deleted');
    }
}
