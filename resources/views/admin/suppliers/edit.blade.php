@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>Editar Proveedor</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Proveedores</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                {{-- Cabecera Oscura con nombre dinámico --}}
                <div class="item-title p-3 text-white d-flex justify-content-between align-items-center" style="background-color: #1a202c;">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-edit me-2"></i> Editando: <strong>{{ $supplier->name }}</strong>
                    </h5>
                    <span class="badge {{ $supplier->status == 1 ? 'bg-success' : 'bg-danger' }}">
                        {{ $supplier->status == 1 ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            {{-- Nombre/Empresa --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label font-weight-bold">Nombre del Proveedor / Empresa <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control custom-input @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $supplier->name) }}" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            {{-- Persona de Contacto --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label font-weight-bold">Persona de Contacto</label>
                                <input type="text" name="contact_person" class="form-control custom-input" 
                                       value="{{ old('contact_person', $supplier->contact_person) }}">
                            </div>

                            {{-- Correo Electrónico --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $supplier->email) }}" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            {{-- Teléfono --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">Teléfono / WhatsApp</label>
                                <input type="text" name="phone" class="form-control custom-input" 
                                       value="{{ old('phone', $supplier->phone) }}">
                            </div>

                            {{-- RUC / Tax ID --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">RUC / ID Fiscal</label>
                                <input type="text" name="tax_id" class="form-control custom-input" 
                                       value="{{ old('tax_id', $supplier->tax_id) }}">
                            </div>

                            {{-- Dirección --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label font-weight-bold">Dirección Completa</label>
                                <input type="text" name="address" class="form-control custom-input" 
                                       value="{{ old('address', $supplier->address) }}">
                            </div>

                            {{-- Status --}}
                            <div class="col-md-4 mb-4">
                                <label class="form-label font-weight-bold">Estado</label>
                                <select name="status" class="form-control custom-input">
                                    <option value="1" {{ old('status', $supplier->status) == 1 ? 'selected' : '' }}>Activo (Habilitado)</option>
                                    <option value="0" {{ old('status', $supplier->status) == 0 ? 'selected' : '' }}>Inactivo (Deshabilitado)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="row mt-4 border-top pt-4">
                            <div class="col-md-12 d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-light-modern">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary-modern">
                                    <i class="fas fa-sync-alt me-1"></i> Actualizar Proveedor
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
    /* Mantenemos la consistencia visual con el archivo create */
    .custom-input {
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 12px 15px !important;
        transition: all 0.3s ease;
        background-color: #fdfdfd;
    }

    .custom-input:focus {
        background-color: #fff;
        border-color: #4e73df !important;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1) !important;
        outline: none;
    }

    .btn-primary-modern {
        background-color: #4e73df !important;
        border: none !important;
        color: white !important;
        padding: 12px 30px !important;
        border-radius: 8px !important;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(78, 115, 223, 0.2);
    }

    .btn-primary-modern:hover {
        background-color: #2e59d9 !important;
        transform: translateY(-1px);
    }

    .btn-light-modern {
        background-color: #fff !important;
        border: 1px solid #e2e8f0 !important;
        padding: 12px 30px !important;
        border-radius: 8px !important;
        color: #718096 !important;
        font-weight: 600;
    }

    .badge {
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 20px;
    }
</style>
@endpush