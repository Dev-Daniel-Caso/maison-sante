<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{

    public function performValidation(Request $request){
        $rules = [
            'name'       => 'required',
            'email'   => 'required|email',
            'dni'        => 'nullable|digits:8',
            'address'    => 'nullable|min:5',
            'phone'      => 'nullable|min:6'
        ];

        $message = [
            'name.required'            =>  'Es necesario ingresar su nombre',
            'email.required'           =>  'Es necesario ingresar el email',
            'dni.digits'               =>  'El DNI debe contener 8 digitos',
            'address.min'              =>  'La direccion debe contener mas de 5 caracteres',
            'phone.min'                =>  'El Telefono debe contener mas de 6 caracteres'
        ];

        $this->validate($request, $rules, $message);
    }

    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    

    public function store(Request $request)
    {
        $this->performValidation($request);
        #dd($request->all());
        $user = User::create(
            $request->only('name', 'email', 'dni', 'address', 'phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $user->specialties()->attach($request->input('specialties'));
        $notificacion = 'El doctor fue registrado correctamente';
        return redirect('/doctors')->with(compact('notificacion'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
    }


    public function update(Request $request, $id)
    {
        $this->performValidation($request);
        $user = User::doctors()->findOrFail($id);
        $data = $request->only('name', 'email', 'dni', 'address', 'phone');
        $password = $request->password;
        if ($password)
            $data += ['password' => bcrypt($password)];
        $user->fill($data);    
        $user->save(); // actualizar
        $user->specialties()->sync($request->specialties); //save many to many
        $notificacion = 'Los datos del medico se han actualizado correctamente';
        return redirect('/doctors')->with(compact('notificacion'));
    }


    public function destroy($id)
    {
        $doctor = User::find($id);
        $deleteDoctor = $doctor->name;
        $doctor->delete(); // delete
        $notificacion = 'El registro del doctor(a) '.$deleteDoctor.' fue eliminado correctamente del sistema';
        return redirect('/doctors')->with(compact('notificacion'));
    }
}
