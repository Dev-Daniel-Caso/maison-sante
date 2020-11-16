@extends('layouts.panel')
@section('title', 'Paciente')
@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Medicos</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('patients/create') }}" class="btn btn-sm btn-primary">Nueva Paciente</a>
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
          <th scope="col">Nombre del Paciente</th>
          <th scope="col">E-mail</th>
          <th scope="col">DNI</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($patients as $patient)
        <tr> 
          <th scope="row">
           {{$patient->name}}
          </th>
          <td>
          {{$patient->email}}
          </td>
          <td>
          {{$patient->dni}}
          </td>
          <td>
          
          <form action="{{ url('patients/'.$patient->id) }}" method="post">
            @method('DELETE')
            @csrf
            <a href="{{ url('patients/'.$patient->id.'/edit') }}" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="Editar" title="Editar">
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
  <div class="card-body">
  {{ $patients->links()}}
  </div>
</div>
@endsection
