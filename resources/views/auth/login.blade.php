@extends('layouts.app')

@section('content')

    <header id="header">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class=" text-white text-center "> Inicio de sesión </h1>
          </div>
        </div>
    </div>
</header>
<section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <center>
              <img style="width: 90%" class="center img-fluid" src="img/supercito.jpg" alt="">
            </center>

            <form method="POST" action="{{ route('login') }}" id="login" class="well">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-left">Correo:</label>

                    <div class="col-md-9">
                        <input placeholder="admin@admin.com" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-left">Contraseña:</label>

                    <div class="col-md-9">
                        <input placeholder="*********" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                            - Recordar Credenciales
                            </label>
                        </div>
                    </div>
                </div> --}}

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-warning btn-block">
                            {{ __('Login') }}
                        </button>

                        {{--@if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif--}}

                    </div>
                </div>
            </form>
            {{-- <form id="login" action="index.html" class="well">
              
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="xample@admin.com">
                  </div>
                  <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" placeholder="password">
                  </div>
                  <button type="submit" class="btn btn-warning btn-block">Acceder</button>
              </form> --}}
          </div>
        </div>
      </div>
    </section>


    <br>
   

@endsection
