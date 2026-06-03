@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__title">
                        <h2>Gestión de Cupones</h2>
                    </div>
                    <div class="breadcrumb__button">
                        <a href="{{ route('admin.coupon.create') }}" class="btn btn-blue">
                            <i class="fa fa-plus-circle"></i> Agregar Cupón
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">
                    <div class="item-title">
                        <h6>Lista de Ordenes Activos</h6>
                    </div>
                    <div class="table-responsive">
                       <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                        <thead class="table-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Tipo</th>
                                    <th>Valor Descuento</th>
                                    <th>Mínimo Compra</th>
                                    <th>Fecha Expiración</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td><strong>{{ $coupon->code }}</strong></td>
                                        <td>
                                            @if ($coupon->type == 'percentage')
                                                <span class="badge bg-info">Porcentaje</span>
                                            @else
                                                <span class="badge bg-primary">Fijo</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $coupon->type == 'percentage' ? $coupon->discount_value . '%' : '$' . number_format($coupon->discount_value, 2) }}
                                        </td>
                                        <td>${{ number_format($coupon->minimum_order_amount, 2) }}</td>
                                        <td>{{ $coupon->expiry_date ? \Carbon\Carbon::parse($coupon->expiry_date)->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($coupon->status == 1)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn-action">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="#" class="btn-action">
                                                    <form action="{{ route('admin.coupon.destroy', $coupon->id) }}"
                                                        method="POST" style="display: inline-block;"
                                                        onsubmit="return confirm('Estas seguro de eliminar ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action"
                                                            style="border: none; background: transparent;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
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
