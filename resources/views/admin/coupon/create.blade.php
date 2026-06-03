@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Crear Nuevo Cupón</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.coupon.index') }}">Cupones</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Crear</li>
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
                                <form method="POST" action="{{ route('admin.coupon.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Código del Cupón</label>
                                                <input type="text" name="code" placeholder="Ej: DESC10" value="{{ old('code') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Tipo de Descuento</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="percentage">Porcentaje (%)</option>
                                                    <option value="fixed">Monto Fijo ($)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Valor del Descuento</label>
                                                <input type="number" name="discount_value" step="0.01" placeholder="10.00" value="{{ old('discount_value') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Monto Mínimo de Orden</label>
                                                <input type="number" name="minimum_order_amount" step="0.01" placeholder="50.00" value="{{ old('minimum_order_amount', 0) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Fecha de Expiración</label>
                                                <input type="date" name="expiry_date" value="{{ old('expiry_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input__group mb-25">
                                                <label>Estado</label>
                                                <select name="status" class="form-control">
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="input__button">
                                        <button type="submit" class="btn btn-blue">Guardar Cupón</button>
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