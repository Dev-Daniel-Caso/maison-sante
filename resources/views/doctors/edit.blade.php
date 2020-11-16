@extends('layouts.panel')
@section('title', 'Editar Doctor')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection
@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Editar Doctor</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('doctors') }}" class="btn btn-sm btn-primary">Cancelar y Volver</a>
      </div>
    </div>
  </div>
 
  <form action="{{url('doctors/'.$doctor->id)}}" method="post">
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
                        value="{{old('name' , $doctor->name)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Correo Electronico" id="description" type="email"  class="form-control"  name="email" 
                        value="{{old('email', $doctor->email)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar DNI" id="description" type="text"  class="form-control"  name="dni" 
                        value="{{old('dni', $doctor->dni)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Direccion" id="address" type="text"  class="form-control"  name="address" 
                        value="{{old('address', $doctor->address)}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Telefono/Movil" id="phone" type="text"  class="form-control"  name="phone" 
                        value="{{old('phone', $doctor->phone)}}">
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
    <div class="form-group">
        <select name="specialties[]" id="specialties" class="form-control selectpicker text-white" multiple data-style="btn-default"
                title="Seleccione una o varias especialidades">
            @foreach ($specialties as $specialty)
            <option value="{{$specialty->id}}">{{$specialty->name}}</option>
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary mt-4 mb-4">Guardar Datos</button>
   </div>
  </form>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(() => {
      $('#specialties').selectpicker('val', @json($specialty_ids));     
    });    
  </script>
@endsection
