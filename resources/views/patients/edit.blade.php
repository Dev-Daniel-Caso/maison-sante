@extends('layouts.panel')
@section('title', 'Editar Paciente')
@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Editar patient</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('patients') }}" class="btn btn-sm btn-primary">Cancelar y Volver</a>
      </div>
    </div>
  </div>
 
  <form action="{{url('patients/'.$patient->id)}}" method="post">
    @method('PUT')
    @csrf
  <div class="container-fluid">
  @if (count($errors) > 0)
      <div class="alert alert-danger">
        <p>Corrige los siguientes errores:</p>
          <ul>
              @foreach ($errors->all() as $message)
                  <li>{{ $message }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Nombre" id="name" type="text"  class="form-control"  name="name" 
                        value="{{old('name' , $patient->name)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Correo Electronico" id="description" type="email"  class="form-control"  name="email" 
                        value="{{old('email', $patient->email)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar DNI" id="description" type="text"  class="form-control"  name="dni" 
                        value="{{old('dni', $patient->dni)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Direccion" id="address" type="text"  class="form-control"  name="address" 
                        value="{{old('address', $patient->address)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Telefono/Movil" id="phone" type="text"  class="form-control"  name="phone" 
                        value="{{old('phone', $patient->phone)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar la contraseña" id="password" type="password"  class="form-control"  name="password">
        </div>
        <p>Ingresar valor si desea cambiar la contraseña</p>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary mt-4 mb-4">Guardar Datos</button>
   </div>
  </form>
</div>
@endsection
