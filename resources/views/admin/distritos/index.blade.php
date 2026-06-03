@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__title">
                    <h2>Gestión de Distritos</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Distrito</th>
                                <th>Provincia</th>
                                <th>Departamento</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($distritos as $dis)
                            <tr>
                                <td>{{ $dis->name }}</td>
                                <td>{{ $dis->provincia->name }}</td>
                                <td><span class="badge bg-light text-dark">{{ $dis->departamento->name }}</span></td>
                                <td>
                                    <span class="badge {{ $dis->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $dis->status == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.distritos.edit', $dis->id) }}" class="btn-action">
                                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $distritos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection