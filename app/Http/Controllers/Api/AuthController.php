<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    function login()
    {
        return response()->json(['message' => 'Login successful']);
    }

    function register()
    {
        return response()->json(['message' => 'Registration successful']);
    }

    function logout()
    {
        return response()->json(['message' => 'Logout successful']);
    }

    function me()
    {
        return response()->json(['user' => 'User details']);
    }

}
