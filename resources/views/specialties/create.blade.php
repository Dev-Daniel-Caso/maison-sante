@extends('layouts.panel')
@section('title', 'Nueva Especialidad')
@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Nueva Especialidad</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('specialties') }}" class="btn btn-sm btn-primary">Cancelar y Volver</a>
      </div>
    </div>
  </div>
 
  <form action="{{ url('specialties') }}" method="post">
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
                <input  placeholder="Ingresar Nombre" id="name" type="text"  class="form-control"  name="name" value="{{old('name')}}">
        </div>

    </div>
    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
            </div>
                <input  placeholder="Ingresar Descripcion" id="description" type="text"  class="form-control"  name="description" value="{{old('description')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-primary mt-4 mb-4">Guardar Datos</button>
   </div>
  </form>
    

</div>
@endsection
