@extends('layouts.form')
@section('title', 'Inicio de Sesion')
@section('content')
<div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary shadow border-0">
            <!-- <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-4"><small>Ingresa tus datos para iniciar </small></div>
              <div class="text-center">
                <a href="#" class="btn btn-neutral btn-icon mr-4">
                  <span class="btn-inner--icon"><img src="{{asset('img/icons/common/github.svg')}}"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div> -->
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
              <small>Ingresa tus datos para inicar sesion</small>
              </div>
              <form method="POST" action="{{ route('login') }}">
              @csrf
                <!-- <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Name" type="text">
                  </div>
                </div> -->

                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input  placeholder="Email" id="email" type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email" 
                            autofocus>
                  </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" required autocomplete="current-password" placeholder="Contraseña">
                  </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="row my-4">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="remember">
                        <span class="text-muted">Recordar Sesion</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
                <a href="{{ route('password.request') }}" class="text-light"><small>¿Olvidaste tu contraseña?</small></a>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('register') }}" class="text-light"><small>¿Aun no te has registrado?</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
