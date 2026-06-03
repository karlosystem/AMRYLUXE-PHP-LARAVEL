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



<div class="section">
	<div class="container">
    	<div class="row justify-content-center">
        	
            <div class="col-md-6">
            	<div class="heading_s1 mb-3 mb-md-5">
                	<h3>Preguntas Generales</h3>
                </div>
            	<div id="accordion" class="accordion accordion_style1">
                     @foreach ($preguntas as $pregunta)
                    <div class="card">
                        <div class="card-header" id="heading{{ $pregunta->id}}">
                            <h6 class="mb-0"> 
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse{{ $pregunta->id}}" aria-expanded="true" aria-controls="collapse{{ $pregunta->id}}">{{ $pregunta->pregunta ?? '' }}</a> 
                            </h6>
                          </div>
                          <div id="collapse{{ $pregunta->id}}" class="collapse show" aria-labelledby="heading{{ $pregunta->id}}" data-bs-parent="#accordion">
                            <div class="card-body">
                            	<p>{{ $pregunta->respuesta ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach             
              	</div>
            </div>         
        </div>
    </div>
</div>


@endsection
