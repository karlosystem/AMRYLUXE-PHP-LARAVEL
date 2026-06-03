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

        <!-- STAT SECTION ABOUT --> 
<div class="section">
	<div class="container">
    	<div class="row align-items-start">
        	<div class="col-lg-3">
            	<div class="about_img scene mb-4 mb-lg-0">
                    <img style="vertical-align: top" src="{{ asset('front/assets/images/paginas/'. $data->imagen) }}"/>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="heading_s1">
                    <h2>{{ $data->titulo ?? '' }}</h2>
                </div>
                <p>{!! $data->descripcion !!}</p>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION ABOUT --> 

<!-- START SECTION WHY CHOOSE --> 
<div class="section bg_light_blue2 pb_70">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-lg-12 col-md-8">
            	<div class="heading_s1 text-center">
                	<h2>Visítanos y descubre la excelencia en cada detalle.</h2>
                </div>
                <p class="text-center leads">
                    En AMRY LUXE, hemos diseñado un espacio pensado exclusivamente para la mujer moderna que busca distinción. Nuestro local cuenta con el más amplio stock en carteras, bolsos de cuero 100% auténtico y accesorios de vanguardia, garantizando que siempre encuentres la pieza perfecta para cada ocasión. Disfruta de una experiencia de compra cómoda y personalizada en un ambiente acogedor. Gracias a nuestra ubicación estratégica, estamos a un paso de ti desde cualquier punto de Lima. ¡Tu próximo complemento favorito te espera aquí!
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/01.jpg') }}" >                      
                    </div>                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/02.jpg') }}" >                       
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/03.jpg') }}" >                        
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/04.jpg') }}" >                       
                    </div>                   
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/05.jpg') }}" >                      
                    </div>                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/06.jpg') }}" >                       
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/07.jpg') }}" >                        
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/08.jpg') }}" >                       
                    </div>                   
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/09.jpg') }}" >                      
                    </div>                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/local/10.jpg') }}" >                       
                    </div>                  
                </div>
            </div>           
        </div>
       
    </div>
</div>
<!-- END SECTION WHY CHOOSE --> 

@endsection
