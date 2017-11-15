<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
    	return [
    		'authenticated_user' => Auth::user()
    	];
    }
}
