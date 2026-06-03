@extends('front.layouts.app')

@section('title', 'Editar Perfil de usuario')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Editar mi Perfil</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Editar mi Perfil</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->


<div class="profile-page-area section py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="section-wrap account-page-sidemenu user-profile-sidebar shadow-sm">
                    <nav class="account-page-menu p-3">
                        <ul class="list-unstyled">
                            <li class="active border-bottom py-2">
                                <a href="{{ route('user.profile') }}" class="text-dark d-flex align-items-center">
                                    <i class="fas fa-user me-2 text-primary"></i> Mi Perfil
                                </a>
                            </li>
                            <li class="border-bottom py-2">
                                <a href="{{ route('user.orders') }}" class="text-dark d-flex align-items-center">
                                    <i class="fas fa-box-open me-2 text-primary"></i> Mis Ordenes
                                </a>
                            </li>
                            <li class="border-bottom py-2">
                                <a href="{{ route('user.reviews') }}" class="text-dark d-flex align-items-center">
                                    <i class="fas fa-user-edit me-2 text-primary"></i> Mis Comentarios
                                </a>
                            </li>
                            <li class="py-2">
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   href="{{ route('logout') }}" class="text-danger d-flex align-items-center">
                                    <i class="fas fa-sign-out-alt me-2"></i> Salir
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="user-profile-content-box edit-user-profile-page-box card shadow-sm p-4">
                    
                    <ul class="nav nav-pills mb-4 border-bottom pb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active me-2" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab">
                                <i class="fas fa-id-card me-1"></i> Información Personal
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-password" type="button" role="tab">
                                <i class="fas fa-key me-1"></i> Seguridad / Password
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel">
                            <form enctype="multipart/form-data" action="{{ route('user.profile.update') }}" method="post">
                                @csrf
                                <div class="profile-top mb-4 d-flex align-items-center">
                                    <div class="profile-image position-relative me-3">
                                        <img class="rounded-circle border border-2 shadow-sm" id="target1" 
                                             src="{{ auth()->user()->image ? asset('front/assets/images/avatar/'.auth()->user()->image) : asset('front/assets/images/user-avatar.png') }}" 
                                             width="100" height="100" style="object-fit: cover;">
                                        <div class="custom-fileuplode position-absolute bottom-0 end-0">
                                            <label for="fileuplode" class="btn btn-sm btn-primary rounded-circle p-1 shadow">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                            <input type="file" id="fileuplode" name="image" class="d-none putImage1">
                                        </div>
                                    </div>
                                    <div class="author-info">
                                        <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                        <p class="text-muted small mb-0">Actualiza tu foto y datos personales</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control border-secondary-subtle" name="name" value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control border-secondary-subtle" name="email" value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small">Celular <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control border-secondary-subtle" name="phone" value="{{ auth()->user()->phone }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small">Código Postal <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control border-secondary-subtle" name="zipcode" value="{{ auth()->user()->zipcode }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small">Dirección <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control border-secondary-subtle" name="address" value="{{ auth()->user()->address }}">
                                    </div>
                                    <div class="col-12 text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-5">Guardar Cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-password" role="tabpanel">
                            <form class="change-password-form mt-3" method="post" action="{{ route('user.change-password') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small">Password Actual</label>
                                        <input type="password" class="form-control border-secondary-subtle" name="current_password" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Nuevo Password</label>
                                        <input type="password" class="form-control border-secondary-subtle" name="new_password" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Confirmar Password</label>
                                        <input type="password" class="form-control border-secondary-subtle" name="confirm_password" required>
                                    </div>
                                    <div class="col-12 text-end mt-4">
                                        <button type="submit" class="btn btn-dark px-5">Actualizar Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection