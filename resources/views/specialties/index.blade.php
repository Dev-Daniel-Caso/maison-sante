@extends('layouts.panel')
@section('title', 'Especialidades')
@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Especialidades</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('specialties/create') }}" class="btn btn-sm btn-primary">Nueva Especialidad</a>
      </div>
    </div>
  </div>
  <div class="card-body">
  @if (session('notificacion'))
    <div class="alert alert-success" role="alert">
        {{session('notificacion') }}
    </div>
  @endif
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Nombre de la Especialidad</th>
          <th scope="col">Descripcion de la Especialidad</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($specialties as $specialty)
        <tr> 
          <th scope="row">
           {{$specialty->name}}
          </th>
          <td>
          {{$specialty->description}}
          </td>
          <td>
          
          <form action="{{ url('specialties/'.$specialty->id) }}" method="post">
            @method('DELETE')
            @csrf
            <a href="{{ url('specialties/'.$specialty->id.'/edit') }}" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="Editar" title="Editar">
            Editar
            </a>
            <button type="submit" rel="tooltip" class="btn btn-danger btn-icon btn-sm " data-original-title="Remover" title="Remover">
              Eliminar
            </button>
            <button type="button" rel="tooltip" class="btn btn-info btn-icon btn-sm " data-original-title="Perfil" title="Perfil">
              <i class="ni ni-circle-08 pt-1"></i>
            </button>
          </form>
          
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
