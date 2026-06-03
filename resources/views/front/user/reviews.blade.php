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
            		<h1>Mis Calificaciones</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Mis Calificaciones</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->


    <div class="profile-page-area section">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="section-wrap account-page-sidemenu user-profile-sidebar">
                        <nav class="account-page-menu">
                            <ul>
                                <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                                    <a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Mi Perfil</a>
                                </li>
                                <li class="{{ request()->routeIs('user.orders') ? 'active' : '' }}">
                                    <a href="{{ route('user.orders') }}"><i class="fas fa-box-open"></i> Mis Ordenes</a>
                                </li>
                                <li class="{{ request()->routeIs('user.reviews') ? 'active' : '' }}">
                                    <a href="{{ route('user.reviews') }}"><i class="fas fa-user-edit"></i> Mis
                                        Comentarios</a>
                                </li>
                                <li>
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-user-edit"></i>Salir
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="user-profile-right-part">
                        <div class="user-profile-content-box my-reviwe-list-box">
                            <div class="d-flex justify-content-between align-items-center text-black mb-5">
                                <h2 class="user-profile-content-title">Mis Calificaciones</h2>
                            </div>
                            @foreach ($reviews as $item)
                                <div class="single-review-item bg-white d-flex align-items-center">
                                    <div class="review-left flex-shrink-0">
                                        <a href="{{ route('products.detalles', $item->products->slug) }}">
                                            <img class="product-thumbnail" src="{{ asset('front/assets/images/productos/'. $item->products->imagen) }}" alt="product"></a>
                                    </div>
                                    <div class="review-right flex-grow-1">
                                        <h4 class="product-name">
                                            <a href="{{ route('products.detalles', $item->products->slug) }}">{{ $item->products->nombre }}</a>
                                        </h4>
                                        <!-- This is server side code. User can not modify it. -->
                                        <ul class="product-review">
                                            @for ($i = 1; $i <= 5; $i++)
                                               <li class="review-item active">
                                                    <i class="flaticon-star" style="color: {{ $i <= $item->rating ? '#FFD700' : '#CCC' }}"></i>
                                                </li>    
                                            @endfor                                                                                   
                                        </ul>
                                        <p>{{ $item->review }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection