@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__title">
                    <h2>Gestión de Departamentos del Perú</h2>
                </div>                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <h6>Lista de Departamentos</h6>
                </div>
                <div class="table-responsive">
                    <table id="departamentoTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Código</th>
                                <th>Impuesto (%)</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departamentos as $dep)
                            <tr>
                                <td>{{ $dep->id }}</td>
                                <td><strong>{{ $dep->name }}</strong></td>
                                <td><code>{{ $dep->code }}</code></td>
                                <td>{{ number_format($dep->tax_rate, 2) }}%</td>
                                <td>
                                    @if($dep->status == 1)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action__buttons">
                                        <a href="{{ route('admin.departamentos.edit', $dep->id) }}" class="btn-action">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>
                                    </div>
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