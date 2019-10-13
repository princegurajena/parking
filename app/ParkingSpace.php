<?php

namespace App;

use App\core\HasFilter;
use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rate
 * @property mixed id
 */
class ParkingSpace extends Model
{
    use HasModelFilter;
    protected $guarded = [];

    public function occupier(){
        return $this->hasOne(User::class , 'id', 'occupied_user_id');
    }

    public function reserver(){
        return $this->hasOne(User::class , 'id', 'reserved_user_id');
    }

    public function vehicle(){
        return $this->hasOne(Vehicle::class , 'id', 'vehicle_id');
    }
}
