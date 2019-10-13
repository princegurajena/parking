<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon created_at
 * @property ParkingSpace location
 * @property mixed id
 * @property mixed ref
 * @property User user
 * @property mixed amount
 */
class Requests extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class , 'id' ,'user_id');
    }

    public function vehicle(){
        return $this->hasOne(Vehicle::class , 'id' ,'vehicle_id');
    }

    public function location(){
        return $this->hasOne(ParkingSpace::class , 'id' ,'parking_space_id');
    }
}
