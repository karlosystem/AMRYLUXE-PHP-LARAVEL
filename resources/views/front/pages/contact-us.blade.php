@extends('front.layouts.app')

@section('title', $data->meta_title)
@section('description', $data->meta_description)
@section('keywords', $data->meta_keywords)

@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>{{ $data->titulo ?? '' }}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Paginas</a></li>
                        <li class="breadcrumb-item active">{{ $data->titulo ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START SECTION CONTACT -->
    <div class="section pb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-map2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Dirección</span>
                            <p>{{ get_configuracion()->direccion }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-envelope-open"></i>
                        </div>
                        <div class="contact_text">
                            <span>Email</span>
                            <a href="mailto:{{ get_configuracion()->email }}">{{ get_configuracion()->email }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-tablet2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Teléfono</span>
                            <p>{{ get_configuracion()->telefono }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CONTACT -->


    <!-- START SECTION CONTACT -->
    <div class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading_s1">
                        <h2>¿Alguna otra consulta?</h2>
                    </div>
                    <p class="leads">Utilice el siguiente formulario para ponerse en contacto con el equipo de ventas.</p>
                    <div class="field_form">

                        <form method="post" action="{{ route('contactenos.store') }}">
                            @csrf
                            <div class="row">
                                {{-- Nombres --}}
                                <div class="form-group col-md-6 mb-3">
                                    <input required placeholder="Nombres *" class="form-control" name="nombres"
                                        type="text" value="{{ old('nombres') }}">
                                </div>

                                {{-- Apellidos (Faltaba en tu código) --}}
                                <div class="form-group col-md-6 mb-3">
                                    <input required placeholder="Apellidos *" class="form-control" name="apellidos"
                                        type="text" value="{{ old('apellidos') }}">
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <input required placeholder="Email *" class="form-control" name="email" type="email"
                                        value="{{ old('email') }}">
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <input required placeholder="Número de Celular *" class="form-control" name="telefono"
                                        type="text" value="{{ old('telefono') }}">
                                </div>

                                {{-- Mensaje --}}
                                <div class="form-group col-md-12 mb-3">
                                    <textarea required placeholder="Mensaje *" class="form-control" name="mensaje" rows="4">{{ old('mensaje') }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-fill-out">Enviar Mensaje</button>
                                </div>
                            </div>
                        </form>

                        {{-- Mostrar alertas de éxito o error --}}
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">

                    {!! get_configuracion()->mapa_iframe !!}

                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CONTACT -->

@endsection
