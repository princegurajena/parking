<?php

namespace App;

use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasModelFilter;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }

}
