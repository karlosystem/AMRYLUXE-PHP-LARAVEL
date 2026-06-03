@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <h6>Editar Departamento: {{ $departamento->name }}</h6>
                </div>
                <form action="{{ route('admin.departamentos.update', $departamento->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre del Departamento</label>
                            <input type="text" name="name" class="form-control" value="{{ $departamento->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Código (ISO/Ubigeo)</label>
                            <input type="text" class="form-control" value="{{ $departamento->code }}" disabled>
                            <small class="text-muted">El código único no se puede modificar.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tasa de Impuesto (%)</label>
                            <input type="number" step="0.01" name="tax_rate" class="form-control" value="{{ $departamento->tax_rate }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Estado</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $departamento->status == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $departamento->status == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-blue">Actualizar Departamento</button>
                        <a href="{{ route('admin.departamentos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection