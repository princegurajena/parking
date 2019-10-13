<?php

namespace App\Http\Controllers;

use App\filters\UserFilter;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserFilter $filter){

        $users = User::filter($filter , [])->latest()->paginate(20);

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function admin(User $user){

        $user->update([
            'role' => 'admin'
        ]);

        return back()->with('message' , 'User was updated to admin successfully');

    }

    public function remove(User $user)
    {
        $user->update([
            'role' => 'default'
        ]);

        return back()->with('message' , 'User was updated to default successfully');
    }
}
