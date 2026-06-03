@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__title">
                    <h2>Logística: Costos de Envío por Provincia</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="table-responsive">
                    <table id="provinciasTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Provincia</th>
                                <th>Departamento</th>
                                <th>Costo de Envío</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($provincias as $prov)
                            <tr>
                                <td>{{ $prov->name }}</td>
                                <td><span class="text-muted">{{ $prov->departamento->name }}</span></td>
                                <td><strong>S/ {{ number_format($prov->shipping_charge, 2) }}</strong></td>
                                <td>
                                    <span class="badge {{ $prov->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $prov->status == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.provincias.edit', $prov->id) }}" class="btn-action">
                                        <i class="fa-solid fa-truck-fast text-primary"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection