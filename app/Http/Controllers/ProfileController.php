<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $route = $user->name . '  '.  $user->team->name;
        return view('profile.show', compact('user', 'route', 'activities', 'teams'));
    }
}
