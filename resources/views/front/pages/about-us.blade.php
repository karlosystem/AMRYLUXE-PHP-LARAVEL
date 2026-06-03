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

@endsection
