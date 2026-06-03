@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Listado de Clientes</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">
                    <div class="item-title d-flex justify-content-between align-items-center">
                        <h2>Clientes Registrados</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                            <thead class="table-dark">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Registro</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <img src="{{ $cliente->image ? asset('front/assets/images/usuarios/' . $cliente->image) : asset('front/assets/images/usuarios/default-user.png') }}"
                                                alt="user" width="45" height="45" style="object-fit: cover;"
                                                class="rounded-circle shadow-sm">
                                        </td>
                                        <td>{{ $cliente->name }}</td>
                                        <td>{{ $cliente->email }}</td>
                                        <td>{{ $cliente->phone ?? 'No registrado' }}</td>
                                        <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if ($cliente->email_verified_at)
                                                <span class="badge bg-success">Verificado</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pendiente</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <button type="button" class="btn-action delete-btn"
                                                    data-id="{{ $cliente->id }}" title="Eliminar">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </button>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Evento de eliminación
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                var url = "{{ route('admin.clientes.destroy', ':id') }}";
                url = url.replace(':id', id);

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire('¡Eliminado!', response.message,
                                            'success')
                                        .then(() => {
                                            location
                                                .reload(); // Recargar para ver los cambios
                                        });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush

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
            padding: 0;
            /* Quitamos padding para que la cabecera toque los bordes */
            overflow: hidden;
            /* Esto "corta" las esquinas de la tabla para que se vean redondeadas */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        /* 2. Cabecera Oscura Elegante */
        #datatablesSimple {
            border-collapse: separate;
            /* Permite redondear esquinas */
            border-spacing: 0;
            width: 100% !important;
        }

        #datatablesSimple thead th {
            background-color: #1a202c !important;
            /* Gris oscuro profundo (estilo Tailwind) */
            color: #ffffff !important;
            /* Texto blanco puro */
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
