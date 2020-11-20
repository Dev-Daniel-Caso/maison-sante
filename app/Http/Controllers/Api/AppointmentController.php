<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Appointment;
use App\Http\Requests\StoreAppointment;

class AppointmentController extends Controller
{
    public function index()
    {
    	$user = Auth::guard('api')->user();
    	return  $user->asPatientAppointments();
    }

    public function store(StoreAppointment $request)
    {
    }
}
