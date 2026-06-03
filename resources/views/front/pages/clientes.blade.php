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


    <!-- START SECTION WHY CHOOSE -->
    <div class="section bg_light_blue2 pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-8">
                    <div class="heading_s1 text-center">
                        <h2>Voces de Elegancia: La Experiencia AMRY LUXE</h2>
                    </div>
                    <p class="text-center leads">
                        Nada nos llena de más orgullo que ver nuestras colecciones en manos de mujeres que valoran la autenticidad y el lujo artesanal. Para nosotros, cada cliente satisfecho es el reflejo de nuestro compromiso con la excelencia en el cuero 100% auténtico. Aquí compartimos los testimonios y momentos de quienes han elegido complementar su estilo con nuestras piezas únicas. Su confianza nos motiva a seguir creando accesorios que no solo imponen glamour, sino que cuentan una historia de calidad y durabilidad insuperable. ¡Gracias por hacernos parte de tu esencia!
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ asset('front/assets/images/clientes/01.jpeg') }}">
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>Mayra Guzmán</h5>
                                <span>(Artista Criolla)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ asset('front/assets/images/clientes/02.jpeg') }}">
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>Ytala Rodríguez</h5>
                                <span>Miss Intercultural Turismo 2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ asset('front/assets/images/clientes/03.jpeg') }}">
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>Marina Carrizales</h5>
                                <span>Clienta frecuente</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ asset('front/assets/images/clientes/04.jpeg') }}">
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>Ketty Del Aguila</h5>
                                <span>Clienta frecuente</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ asset('front/assets/images/clientes/05.jpeg') }}">
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>Mayra Guzmán y AMRY LUXE</h5>
                                <span>Bienvenida</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ asset('front/assets/images/clientes/06.jpeg') }}">
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>Marita Cárdenas</h5>
                                <span>Clienta frecuente</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ asset('front/assets/images/clientes/07.jpeg') }}">
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>Cielo Llontop</h5>
                                <span>Clienta frecuente</span>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>

          

        </div>
    </div>
    <!-- END SECTION WHY CHOOSE -->

@endsection
