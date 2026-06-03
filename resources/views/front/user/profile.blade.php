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
                        <h1>Mi Perfil</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                        <li class="breadcrumb-item active">Mi Perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->


    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">

                    <div class="container">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="contact_wrap shadow-sm text-center">
                                    <div class="contact_icon mb-3">
                                        <a href="{{ route('user.profile.edit') }}" class="text-primary">Editar mi Perfil</a>
                                    </div>

                                    <div class="widget">
                                        <h5 class="widget_title mb-3">Información Personal</h5>

                                        <ul class="widget_categories list_none">
                                            <li
                                                class="border-bottom py-1 d-flex justify-content-between align-items-center">
                                                <span class="categories_name"><b>Nombre:</b></span>
                                                <span class="text-muted">{{ auth()->user()->name ?? 'N/A' }}</span>
                                            </li>

                                            <li
                                                class="border-bottom py-1 d-flex justify-content-between align-items-center">
                                                <span class="categories_name"><b>Email:</b></span>
                                                <span class="text-muted">{{ auth()->user()->email ?? 'N/A' }}</span>
                                            </li>

                                            <li
                                                class="border-bottom py-1 d-flex justify-content-between align-items-center">
                                                <span class="categories_name"><b>Celular:</b></span>
                                                <span class="text-muted">{{ auth()->user()->phone ?? 'N/A' }}</span>
                                            </li>

                                            <li class="border-bottom py-1">
                                                <span class="categories_name d-block"><b>Dirección:</b></span>
                                                <small class="text-muted">{{ auth()->user()->address ?? 'N/A' }}</small>
                                            </li>

                                            <li class="py-1 d-flex justify-content-between align-items-center">
                                                <span class="categories_name"><b>C.P.:</b></span>
                                                <span class="text-muted">{{ auth()->user()->zipcode ?? 'N/A' }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="address-box card h-100 shadow-sm">
                                    <div class="card-body p-3">


                                        <h5 class="card-title text-black mb-3 border-bottom pb-2">
                                            <i class="fas fa-shopping-basket me-2"></i>Estados de Órdenes
                                        </h5>

                                        <ul class="list-unstyled mb-0">
                                            <li
                                                class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                                <span class="text-secondary">Pendientes</span>
                                                <span
                                                    class="badge bg-warning text-dark rounded-pill">{{ orderStatusCount('pending') }}</span>
                                            </li>

                                            <li
                                                class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                                <span class="text-secondary">En Proceso</span>
                                                <span
                                                    class="badge bg-info text-white rounded-pill">{{ orderStatusCount('processing') }}</span>
                                            </li>

                                            <li
                                                class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                                <span class="text-secondary">Enviadas</span>
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ orderStatusCount('shipped') }}</span>
                                            </li>

                                            <li
                                                class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                                <span class="text-secondary">Entregadas</span>
                                                <span
                                                    class="badge bg-success rounded-pill">{{ orderStatusCount('delivered') }}</span>
                                            </li>

                                            <li class="d-flex justify-content-between align-items-center py-1">
                                                <span class="text-secondary">Canceladas</span>
                                                <span
                                                    class="badge bg-danger rounded-pill">{{ orderStatusCount('canceled') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="address-box card h-100 shadow-sm">
                                    <div class="card-body p-3">
                                        <h5 class="card-title text-black mb-3 border-bottom pb-2">
                                            <i class="fas fa-info-circle me-2"></i>Información Adicional
                                        </h5>

                                        <ul class="list_none p-0 m-0">
                                            <li class="d-flex justify-content-between align-items-center py-1">
                                                <span class="categories_name">
                                                    <i class="far fa-calendar-alt me-2 text-muted"></i><b>Miembro desde:</b>
                                                </span>
                                               
                                            </li>
                                            <li>
                                                <span class="text-muted">
                                                    {{ auth()->user()->created_at->format('d M, Y') }}
                                                </span>
                                            </li>

                                            {{-- Aquí puedes agregar más líneas en el futuro siguiendo el mismo formato --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="col-lg-2 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget_title">Menú de usuario</h5>
                            <ul class="widget_categories">
                                <li><a href="{{ route('user.profile') }}"><span class="categories_name">Mi
                                            Perfil</span></a>
                                </li>
                                <li><a href="{{ route('user.orders') }}"><span class="categories_name">Mis
                                            Ordenes</span></a></li>
                                <li><a href="{{ route('user.reviews') }}"><span class="categories_name">Mis
                                            Comentarios</span></a></li>
                                <li>
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        href="{{ route('logout') }}">
                                        <span class="categories_name">Salir</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--     <div class="profile-page-area section">
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
                                    <a href="{{ route('user.reviews') }}"><i class="fas fa-user-edit"></i> Mis Comentarios</a>
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
                        <div class="user-profile-content-box">
                            <div class="d-flex justify-content-between align-items-center text-black mb-5">
                                <h2 class="user-profile-content-title">Mi Perfil</h2>
                                <a href="{{ route('user.profile.edit') }}" class="text-black">Editar mi Perfil</a>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="address-box card">
                                        <h3 class="text-black">Información Personal</h3>
                                        <ul>
                                            <li>Nombre Completo: {{ auth()->user()->name ?? '' }}</li>
                                            <li>Email: {{ auth()->user()->email ?? '' }}</li>
                                            <li>Celular: {{ auth()->user()->phone ?? 'N/A' }}</li>
                                            <li>Dirección: {{ auth()->user()->address ?? 'N/A' }}</li>
                                            <li>Codigo Postal: {{ auth()->user()->zipcode ?? 'N/A' }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="address-box card">
                                        <h3 class="text-black">Estados de Ordenes</h3>
                                        <ul>
                                            <li>Pending: {{ orderStatusCount('pending') }}</li>
                                            <li>Processing: {{ orderStatusCount('processing') }}</li>
                                            <li>Shipped: {{ orderStatusCount('shipped') }}</li>
                                            <li>Delivered: {{ orderStatusCount('delivered') }}</li>
                                            <li>Cancelled: {{ orderStatusCount('canceled') }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="address-box card">
                                        <h3 class="text-black">Other Info</h3>
                                        <ul>
                                            <li>Ingreso: {{ auth()->user()->created_at->format('d M, Y') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
