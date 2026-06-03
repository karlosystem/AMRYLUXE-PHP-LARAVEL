@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="customers__area bg-style mb-30">
                <div class="item-title text-center">
                    <h4>Editar Distrito</h4>
                    <p class="text-muted">{{ $distrito->departamento->name }} / {{ $distrito->provincia->name }}</p>
                </div>
                <form action="{{ route('admin.distritos.update', $distrito->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Nombre del Distrito</label>
                        <input type="text" name="name" class="form-control" value="{{ $distrito->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado de Entrega</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $distrito->status == 1 ? 'selected' : '' }}>Disponible para Envíos</option>
                            <option value="0" {{ $distrito->status == 0 ? 'selected' : '' }}>No disponible</option>
                        </select>
                        <small class="text-muted">Si lo desactivas, este distrito no aparecerá en el Checkout.</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.distritos.index') }}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-blue">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection