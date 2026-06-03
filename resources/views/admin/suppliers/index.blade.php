@extends('admin.layouts.app')

@section('title', 'Gestión de Proveedores')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-white">Proveedores</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Proveedores</li>
        </ol>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Listado de Proveedores
                </div>
                <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nuevo Proveedor
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Dirección</th>
                                <th class="text-center">Compras</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->id }}</td>
                                    <td>
                                        <strong>{{ $supplier->name }}</strong><br>
                                        <small class="text-muted">{{ $supplier->email }}</small>
                                    </td>
                                    <td>{{ $supplier->phone ?? 'Sin teléfono' }}</td>
                                    <td>{{ Str::limit($supplier->address, 40) }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark">
                                            {{ $supplier->purchases_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                                                class="btn btn-warning btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                                    onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        No hay proveedores registrados aún.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "pageLength": 10,
            "responsive": true,
            // Agregamos wrappers con clases de Bootstrap para dar espacio (p-3)
            "dom": '<"row p-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                   '<"row"<"col-sm-12"tr>>' +
                   '<"row p-3"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* 1. Contenedor con bordes redondeados */
    .customers__table {
        background: #ffffff;
        border-radius: 12px;
        padding: 0; /* Quitamos padding para que la cabecera toque los bordes */
        overflow: hidden; /* Esto "corta" las esquinas de la tabla para que se vean redondeadas */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    /* 2. Cabecera Oscura Elegante */
    #datatablesSimple {
        border-collapse: separate; /* Permite redondear esquinas */
        border-spacing: 0;
        width: 100% !important;
    }

    #datatablesSimple thead th {
        background-color: #1a202c !important; /* Gris oscuro profundo (estilo Tailwind) */
        color: #ffffff !important; /* Texto blanco puro */
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 16px 15px !important;
        border: none !important;
    }

    /* 3. Estilo de las celdas del cuerpo */
    #datatablesSimple tbody td {
        padding: 14px 15px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        color: #4a5568;
        vertical-align: middle;
    }

    /* 4. Efecto de hover en las filas */
    #datatablesSimple tbody tr:hover {
        background-color: #f8fafc !important;
    }

    /* 5. Personalización del Buscador y Selector (Inputs) */
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #cbd5e0 !important;
        border-radius: 8px !important;
        padding: 5px 10px !important;
        background-color: #ffffff !important;
    }

    /* 6. Botones de Acción (Suavizados) */
    .btn-sm {
        border-radius: 8px !important;
        transition: all 0.3s ease;
    }

    .btn-warning {
        background-color: #ff9f43 !important;
        border-color: #ff9f43 !important;
        color: white !important;
    }

    .btn-danger {
        background-color: #ea5455 !important;
        border-color: #ea5455 !important;
    }
</style>
@endpush