<?php
use App\Specialty;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','admin'])->namespace('Admin')->group( function(){
    // Specialty
    Route::resource('/specialties', 'SpecialtyController');
    // Doctors
    Route::resource('doctors', 'DoctorController');
    // Pactients
    Route::resource('patients', 'PatientController');

    // Charts
	Route::get('/charts/appointments/line', 'ChartController@appointments');
	Route::get('/charts/doctors/column', 'ChartController@doctors');
    Route::get('/charts/doctors/column/data', 'ChartController@doctorsJson');

    // FCM
	Route::post('/fcm/send', 'FirebaseController@sendAll');
    
});

Route::middleware(['auth','doctor'])->namespace('Doctor')->group( function(){
    // Specialty
    Route::get('/schedule', 'ScheduleController@edit');
    Route::post('/schedule', 'ScheduleController@store');
});

Route::middleware(['auth'])->group( function(){
    Route::get('/appointments/create', 'AppointmentController@create');
    Route::post('/appointments', 'AppointmentController@store');
    Route::get('/appointments', 'AppointmentController@index');	
	Route::get('/appointments/{appointment}', 'AppointmentController@show');	

	Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
	Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');

    Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');
    
    
});


 