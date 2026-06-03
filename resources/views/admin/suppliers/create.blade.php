@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>Agregar Nuevo Proveedor</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Proveedores</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Crear</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                {{-- Cabecera Oscura --}}
                <div class="item-title p-3 text-white" style="background-color: #1a202c;">
                    <h5 class="mb-0 text-white"><i class="fas fa-truck-loading me-2"></i> Información del Proveedor</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.suppliers.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            {{-- Nombre/Empresa --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label font-weight-bold">Nombre del Proveedor / Empresa <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control custom-input @error('name') is-invalid @enderror" 
                                       placeholder="Ej: Inversiones Globales S.A.C." value="{{ old('name') }}" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            {{-- Persona de Contacto --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label font-weight-bold">Persona de Contacto</label>
                                <input type="text" name="contact_person" class="form-control custom-input" 
                                       placeholder="Ej: Juan Pérez" value="{{ old('contact_person') }}">
                            </div>

                            {{-- Correo Electrónico --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror" 
                                       placeholder="proveedor@ejemplo.com" value="{{ old('email') }}" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            {{-- Teléfono --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">Teléfono / WhatsApp</label>
                                <input type="text" name="phone" class="form-control custom-input" 
                                       placeholder="+51 987 654 321" value="{{ old('phone') }}">
                            </div>

                            {{-- RUC / Tax ID --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">RUC / ID Fiscal</label>
                                <input type="text" name="tax_id" class="form-control custom-input" 
                                       placeholder="Número de identificación" value="{{ old('tax_id') }}">
                            </div>

                            {{-- Dirección --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label font-weight-bold">Dirección Completa</label>
                                <input type="text" name="address" class="form-control custom-input" 
                                       placeholder="Av. Las Magnolias 123, Lima" value="{{ old('address') }}">
                            </div>

                            {{-- Status --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">Estado</label>
                                <select name="status" class="form-control custom-input">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Activo (Habilitado)</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactivo (Deshabilitado)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="row mt-4">
                            <div class="col-md-12 d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-light-modern">
                                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary-modern">
                                    <i class="fas fa-save me-1"></i> Guardar Proveedor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Estilos de Formulario Moderno */
    .custom-input {
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 12px 15px !important;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }

    .custom-input:focus {
        background-color: #fff;
        border-color: #4e73df !important;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1) !important;
        outline: none;
    }

    .form-label {
        color: #2d3748;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    /* Botones Estilizados */
    .btn-primary-modern {
        background-color: #4e73df !important;
        border: none !important;
        color: white !important;
        padding: 12px 30px !important;
        border-radius: 8px !important;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-primary-modern:hover {
        background-color: #2e59d9 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
    }

    .btn-light-modern {
        background-color: #fff !important;
        border: 1px solid #e2e8f0 !important;
        padding: 12px 30px !important;
        border-radius: 8px !important;
        color: #718096 !important;
        font-weight: 600;
    }

    .btn-light-modern:hover {
        background-color: #f1f5f9 !important;
        color: #2d3748 !important;
    }

    /* Validación */
    .is-invalid {
        border-color: #ea5455 !important;
        background-image: none !important;
    }
</style>
@endpush