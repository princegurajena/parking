<?php

namespace App;

use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasModelFilter;
    protected $guarded = [];

    public function request()
    {
        return $this->hasOne(Requests::class , 'id' , 'request_id');
    }
}
