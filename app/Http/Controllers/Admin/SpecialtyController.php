<?php

namespace App\Http\Controllers\Admin;
use App\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create(){
        return view('specialties.create');
    }

    public function performValidation(Request $request){
        $rules = [
            'name'          => 'required',
            'description'   => 'required'
        ];

        $message = [
            'name.required'         =>  'Es necesario ingresar su nombre',
            'description.required'  =>  'Es necesario ingresar la descripcion'
        ];

        $this->validate($request, $rules, $message);
    }

    public function store(Request $request){
       
        $this->performValidation($request);

        $specialties = new Specialty();
        $specialties->name = $request->name;
        $specialties->description = $request->description;
        $specialties->save(); // register

        $notificacion = 'La especialidad se registrado correctamente';
        return redirect('/specialties')->with(compact('notificacion'));
    }

    public function edit( Specialty $specialty){

        return view('specialties.edit', compact('specialty'));
    }
    public function update(Request $request, Specialty $specialty){

        $this->performValidation($request);

        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save(); // update

        $notificacion = 'La especialidad se ha actualizado correctamente';
        return redirect('/specialties')->with(compact('notificacion'));
    }

    public function destroy($id){
        $specialty = Specialty::find($id);
        $deleteSpecialty = $specialty->name;
        $specialty->delete(); // delete
        $notificacion = 'La especialidad '.$deleteSpecialty.' se ha eliminado correctamente';
        return redirect('/specialties')->with(compact('notificacion'));
    }
}
