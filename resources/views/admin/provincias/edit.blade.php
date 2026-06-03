@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <h4>Configurar Envío: {{ $provincia->name }}</h4>
                    <p class="text-muted">Departamento: {{ $provincia->departamento->name }}</p>
                </div>
                <form action="{{ route('admin.provincias.update', $provincia->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Costo de Envío (S/)</label>
                        <div class="input-group">
                            <span class="input-group-text">S/</span>
                            <input type="number" step="0.01" name="shipping_charge" 
                                   class="form-control form-control-lg" 
                                   value="{{ $provincia->shipping_charge }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Disponibilidad de Envío</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $provincia->status == 1 ? 'selected' : '' }}>Habilitado</option>
                            <option value="0" {{ $provincia->status == 0 ? 'selected' : '' }}>Deshabilitado (No llegamos aquí)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.provincias.index') }}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-blue px-5">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection