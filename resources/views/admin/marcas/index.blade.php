@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Marcas</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Marcas</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">

                    <div class="item-title">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.marcas.create') }}" class="btn btn-md btn-info">Agregar Marca</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">                      
                               <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                                  <thead class="table-dark">
                                    <tr role="row">
                                        <th>Item</th>
                                        <th>Nombre</th>
                                        <th>Slug</th>
                                        <th>Estado</th>
                                        <th>Imagen</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marcas as $data)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nombre }}</td>
                                            <td>{{ $data->slug }}</td>
                                            <td>
                                                @if ($data->imagen)
                                                    <img src="{{ asset('front/assets/images/marcas/' . $data->imagen) }}"
                                                        alt="{{ $data->nombre }}"
                                                        style="width: 100px; height: auto; border-radius: 5px; border: 1px solid #ddd;">
                                                @else
                                                    <span class="badge bg-secondary">Sin imagen</span>
                                                @endif
                                            </td>
                                            <td><span class="status active">
                                                    @if ($data->status == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </span></td>
                                            <td>

                                                <div class="action__buttons">
                                                    <a href="{{ route('admin.marcas.edit', $data->id) }}"
                                                        class="btn-action">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="#" class="btn-action">
                                                        <form action="{{ route('admin.marcas.destroy', $data->id) }}"
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
