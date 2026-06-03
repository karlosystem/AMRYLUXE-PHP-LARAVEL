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
                	<h2>Brillando en las Pasarelas: Miss Intercultural Turismo 2024</h2>
                </div>
                <p class="text-center leads">
                   La distinción de nuestras colecciones cobra vida en los eventos más exclusivos. Tuvimos el honor de presentar nuestras últimas tendencias en bolsos y carteras de cuero 100% auténtico durante el certamen Miss Intercultural Turismo 2024. Cada desfile es una oportunidad para demostrar cómo un accesorio de AMRY LUXE no solo complementa un outfit, sino que define una actitud de lujo y vanguardia. Nuestras modelos lucieron piezas maestras que imponen glamour en cada paso, capturando la esencia de la mujer sofisticada que nos inspira día a día.
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B01.jpg') }}" >                      
                    </div>                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B02.jpg') }}" >                       
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B03.jpg') }}" >                        
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B04.jpg') }}" >                       
                    </div>                   
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B05.jpg') }}" >                      
                    </div>                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B06.jpg') }}" >                       
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B07.jpg') }}" >                        
                    </div>                  
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B08.jpg') }}" >                       
                    </div>                   
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B09.jpg') }}" >                      
                    </div>                    
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B10.jpg') }}" >                       
                    </div>                  
                </div>
            </div>           

             <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B11.jpg') }}" >                       
                    </div>                  
                </div>
            </div>           

             <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/eventos/B12.jpg') }}" >                       
                    </div>                  
                </div>
            </div>           

        </div>
       
    </div>
</div>
<!-- END SECTION WHY CHOOSE --> 

@endsection
