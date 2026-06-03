@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Libro de Reclamaciones</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Libro de Reclamaciones</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="customers__area bg-style mb-30 customers__table">
                    <div class="table-responsive">
                        <table class="table" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Consumidor</th>
                                    <th>Documento</th>
                                    <th>Tipo</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reclamaciones as $item)
                                    <tr>
                                        <td>#{{ $item->id }}</td>
                                        <td>
                                            {{-- Solución al error: validamos si existe created_at --}}
                                            {{ $item->created_at ? $item->created_at->format('d/m/Y') : '---' }}
                                        </td>
                                        <td>
                                            {{-- Estructura para que el email vaya debajo --}}
                                            <div style="line-height: 1.2;">
                                                <span class="fw-bold d-block text-uppercase"
                                                    style="color: #2d3748; font-size: 0.85rem;">
                                                    {{ $item->nombres }} {{ $item->apellidos }}
                                                </span>
                                                <span class="text-muted small d-block" style="font-size: 0.75rem;">
                                                    {{ $item->email }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="d-block text-dark">{{ $item->tipo_documento }}</span>
                                            <small class="text-muted">{{ $item->nro_documento }}</small>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $item->tipo_reclamo == 'Reclamo' ? 'bg-warning' : 'bg-info' }} text-dark">
                                                {{ $item->tipo_reclamo }}
                                            </span>
                                        </td>
                                        <td>S/. {{ number_format($item->monto, 2) }}</td>
                                        <td id="status-container-{{ $item->id }}">
                                            <a href="javascript:void(0)" onclick="toggleStatus({{ $item->id }})"
                                                style="text-decoration: none;">
                                                <span class="badge {{ $item->estado == 0 ? 'bg-danger' : 'bg-success' }}"
                                                    id="badge-{{ $item->id }}">
                                                    {{ $item->estado == 0 ? 'Pendiente' : 'Atendido' }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-warning"
                                                    onclick="verDetalle({{ $item->id }})" title="Ver Detalle">
                                                    <i class="fas fa-eye text-white"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
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

    <div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title text-white">Detalle de la Hoja de Reclamación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="contenidoDetalle">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

@push('scripts')
    <script>
        function toggleStatus(id) {
            const url = "{{ url('admin/reclamaciones/cambiar-estado') }}/" + id;

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        const badge = $('#badge-' + id);
                        if (response.nuevo_estado == 1) {
                            badge.removeClass('bg-danger').addClass('bg-success').text('Atendido');
                        } else {
                            badge.removeClass('bg-success').addClass('bg-danger').text('Pendiente');
                        }
                        // Opcional: Una notificación pequeña (Toast)
                        toastr.success(response.message);
                    }
                },
                error: function() {
                    alert('No se pudo cambiar el estado. Intente de nuevo.');
                }
            });
        }

        function verDetalle(id) {
            $('#modalDetalle').modal('show');
            $('#contenidoDetalle').html('<div class="text-center"><div class="spinner-border text-primary"></div></div>');

            $.get("{{ url('admin/reclamaciones/detalle') }}/" + id, function(data) {
                let html = `
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Cliente:</strong> ${data.nombres} ${data.apellidos}</p>
                    <p><strong>DNI/CE:</strong> ${data.nro_documento}</p>
                    <p><strong>Teléfono:</strong> ${data.telefono}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Bien:</strong> ${data.bien_contratado}</p>
                    <p><strong>Monto:</strong> S/. ${data.monto}</p>
                    <p><strong>Fecha Suceso:</strong> ${data.fecha_problema}</p>
                </div>
                <hr>
                <div class="col-12">
                    <h5>Descripción del Producto:</h5>
                    <p class="bg-light p-2 rounded">${data.descripcion_producto}</p>
                    
                    <h5>Detalle del Problema:</h5>
                    <p class="bg-light p-2 rounded">${data.detalle_problema || 'No especificado'}</p>
                    
                    <h5>Pedido del Vendedor:</h5>
                    <p class="bg-light p-2 rounded">${data.pedido_vendedor || 'No especificado'}</p>
                </div>
            </div>
        `;
                $('#contenidoDetalle').html(html);
            });
        }
    </script>
@endpush



@push('styles')
    <style>
        /* 1. Contenedor con bordes redondeados y sombra */
        .customers__table {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        /* 2. Cabecera Oscura Estilo Tailwind */
        #datatablesSimple thead th {
            background-color: #1a202c !important;
            /* Gris oscuro profundo */
            color: #ffffff !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 16px 15px !important;
            border: none !important;
        }

        /* 3. Ajuste de celdas */
        #datatablesSimple tbody td {
            padding: 14px 15px !important;
            border-bottom: 1px solid #edf2f7 !important;
            vertical-align: middle;
            color: #4a5568;
        }

        /* 4. Efecto hover en filas */
        #datatablesSimple tbody tr:hover {
            background-color: #f7fafc !important;
        }

        /* 5. Estilo de los Badges */
        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 500;
        }

        /* 6. Botones de Acción (Tus estilos aplicados) */
        .btn-sm {
            border-radius: 8px !important;
            padding: 5px 10px;
            margin: 0 2px;
        }

        .btn-warning {
            background-color: #ff9f43 !important;
            border: none !important;
            color: white !important;
        }

        .btn-danger {
            background-color: #ea5455 !important;
            border: none !important;
        }
    </style>
@endpush
