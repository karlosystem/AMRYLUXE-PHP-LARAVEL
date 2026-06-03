@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Editar Admin</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel">
                                <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Nombre Completo</label>
                                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Correo Electrónico</label>
                                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Contraseña (dejar en blanco para no cambiar)</label>
                                                <input type="password" name="password" placeholder="Nueva contraseña">
                                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Estado</label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Activo</option>
                                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input__group mb-25">
                                                <label>Imagen de Perfil Actual</label>
                                                <div class="mb-2">
                                                    <img src="{{ asset($user->image) }}" width="80" class="img-thumbnail">
                                                </div>
                                                <input type="file" name="image" accept="image/*" class="form-control">
                                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="input__button">
                                        <button type="submit" class="btn btn-blue">Actualizar Admin</button>
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