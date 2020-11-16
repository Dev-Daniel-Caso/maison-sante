<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function performValidation(Request $request){
        $rules = [
            'name'       => 'required',
            'email'   => 'required|email',
            'dni'        => 'digits:8',
            'address'    => 'min:5',
            'phone'      => 'min:6'
        ];

        $message = [
            'name.required'            =>  'Es necesario ingresar su nombre',
            'email.required'           =>  'Es necesario ingresar el email',
            'dni.digits'               =>  'El DNI debe contener 8 digitos',
            'address.min'              =>  'La direccion debe contener mas de 5 caracteres',
            'phone.min'                =>  'La direccion debe contener mas de 6 caracteres'
        ];

        $this->validate($request, $rules, $message);
    }

    public function index()
    {
        $patients = User::patients()->paginate(10);
        return view('patients.index', compact('patients'));
    }


    public function create()
    {
        return view('doctors.create');
    }


    public function store(Request $request)
    {
        $this->performValidation($request);

        User::create(
            $request->only('name', 'email', 'dni', 'address', 'phone') +
            [
                'role'      => 'patient',
                'password'  => bcrypt($request->password)
            ]       
        );
        $notificacion = 'El paciente fue registrado correctamente';
        return redirect('/patients')->with(compact('notificacion'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $patient = User::patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }


    public function update(Request $request, $id)
    {
        $this->performValidation($request);
        $user = User::patients()->findOrFail($id);
        $data = $request->only('name', 'email', 'dni', 'address', 'phone');
        $password = $request->password;
        if ($password)
            $data += ['password' => bcrypt($password)];
        $user->fill($data);    
        $user->save(); // actualizar
        
        $notificacion = 'Los datos del paciente se han actualizado correctamente';
        return redirect('/patients')->with(compact('notificacion'));
    }


    public function destroy($id)
    {
        $patient = User::find($id);
        $deletePatient = $patient->name;
        $patient->delete(); // delete
        $notificacion = 'El registro del paciente(a) '.$deletePatient.' fue eliminado correctamente del sistema';
        return redirect('/patients')->with(compact('notificacion'));
    }
}
