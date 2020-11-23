<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FirebaseController extends Controller
{
    public function postToken(Request $request)
    {
    	// $request->validate($rules);

    	$user = Auth::guard('api')->user();
    	
    	if ($request->has('device_token')) {
	    	$user->device_token = $request->input('device_token');
	    	$user->save();	
    	}    	
    }
}
