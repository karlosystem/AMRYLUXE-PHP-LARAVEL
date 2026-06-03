@extends('front.layouts.app')

@section('title', 'Recuperar clave de Acceso')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')


@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Cambiar su password</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Cambiar su password</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START LOGIN SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Ingrese su Email</h3>
                        </div>
                          @if (session('status'))
                         <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                         </div>
                        @endif
                         <form class="login-form" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group mb-3">                                
                                <input id="email" type="email"
                                    class="form-control rounded-left @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" placeholder="Email" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                             <div class="form-group mb-3">
                                <input id="password" type="password"
                                    class="form-control rounded-left @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror    
                            </div>

                             <div class="form-group mb-3">
                                <input id="password-confirm" type="password" class="form-control rounded-left"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirmar Password">
                            </div>


                            
                          
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">Cambiar Password</button>
                            </div>
                        </form>
                       
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->

{{--     <div class="sign-in-page sign-up-page section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-lg-5">
                    <div class="login-wrap">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="far fa-user"></span>
                        </div>
                        <h1 class="text-center mb-4">Cambiar clave de acceso</h1>

                        <form class="login-form" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <input id="email" type="email"
                                    class="form-control rounded-left @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" placeholder="Email" required autocomplete="email"
                                    autofocus>
                            </div>

                            <div class="form-group">
                                <input id="password" type="password"
                                    class="form-control rounded-left @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control rounded-left"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirmar Password">
                            </div>

                            <div class="form-group">

                                <button type="submit"
                                    class="form-control btn btn-primary rounded submit px-3 primary-btn auth-btn">
                                    Cambiar Clave de Acceso
                                </button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection