@extends('front.layouts.app')

@section('title', 'Control de Acceso a Clientes')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')

@section('content')


    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Login</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Clientes</a></li>
                        <li class="breadcrumb-item active">Login</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->


    {{--     <div class="sign-in-page section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-lg-5">
                    <div class="login-wrap">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="far fa-user"></span>
                        </div>
                        <h1 class="text-center mb-4">Control de Acceso</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email"
                                    class="form-control rounded-left @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input id="password" type="password"
                                    class="form-control rounded-left @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password" required autocomplete="current-password">

                            </div>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control btn btn-primary rounded submit px-3 primary-btn auth-btn">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <hr>
                            <div class="form-group">
                                <a href="{{ route('auth.google') }}"
                                    class="form-control btn btn-primary rounded submit px-3 google-btn"><i
                                        class="fab fa-google"></i> accede con Google</a>
                            </div>
                            <hr>
                            <div class="remember-box form-group text-center mb-0">
                               
                                <div class="text-md-end text-lg-end">

                                    @if (Route::has('password.request'))
                                        <a class="forget-password-link" href="{{ route('password.request') }}">
                                            {{ __('Olvidaste tu Password?') }}
                                        </a>
                                    @endif

                                </div>
                            </div>

                            <div class="already-have-account">
                                No tienes una cuenta en Amry Luxe ?
                                <a href="{{ route('register') }}" class="forget-password-link">Registrarse</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- START LOGIN SECTION -->
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3>Login</h3>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <input id="email" type="email"
                                        class="form-control rounded-left @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Email" required
                                        autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <input id="password" type="password"
                                        class="form-control rounded-left @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="login_footer form-group mb-3 d-flex justify-content-between align-items-center">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="exampleCheckbox1" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="exampleCheckbox1"><span>Recordarme</span></label>
                                        </div>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Olvidaste tu Password?') }}
                                        </a>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-fill-out btn-block w-100"
                                        name="login">Acceso</button>
                                </div>
                            </form>


                            <div class="different_login">
                                <span> o</span>
                            </div>
                            <ul class="btn-login list_none text-center">
                                <li><a href="#" class="btn btn-facebook"><i
                                            class="ion-social-facebook"></i>Facebook</a></li>
                                {{-- Verifica que esté exactamente así --}}
                                <li>
                                    <a href="{{ route('auth.google') }}" class="btn btn-google">
                                        <i class="ion-social-googleplus"></i>Google
                                    </a>
                                </li>
                            </ul>
                            <div class="form-note text-center">¿ No tienes una cuenta ?
                                <a href="{{ route('register') }}">Registrese</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN SECTION -->

@endsection
