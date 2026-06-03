@extends('front.layouts.app')

@section('title', $data->meta_title)
@section('description', $data->meta_description)
@section('keywords', $data->meta_keywords)

@section('content')

    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">{{ $data->titulo ?? '' }}</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="page-item">{{ $data->titulo ?? '' }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->


    <div class="popular-categories-area section-bg section-top pb-30">
        <div class="container">
            <div class="section-header-area">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="sub-title">
                            Productos de Colección
                        </h3>
                        <h2 class="section-title">
                            Categorias más Populares
                        </h2>
                    </div>
                    <div class="col-md-6 align-self-end text-md-end">
                        <a href="{{ route('products.index') }}" class="primary-btn">Ver Todos los Productos</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categorias as $categoria)
                    <div class="col-lg-4 col-md-6">
                        <a class="single-categorie" href="/product/category/5">
                            <div class="categorie-wrap">
                                <div class="categorie-icon">
                                    <i class="icon flaticon-blazer"></i>
                                </div>
                                <div class="categorie-info">
                                    <h3 class="categorie-name">
                                        {{ $categoria->nombre }}</h3>
                                    <h4 class="categorie-subtitle">
                                        {{ $categoria->p_cat_name }}</h4>
                                </div>
                            </div>
                            <i class="arrow flaticon-right-arrow"></i>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


@endsection
