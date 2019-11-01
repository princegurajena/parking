<?php

namespace App;

use App\filters\core\HasModelFilter;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasModelFilter;
    protected $guarded = [];
}
