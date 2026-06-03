@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Gestión de Productos</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Productos</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30 shadow-sm">
                    <div class="item-title d-flex justify-content-between align-items-center p-3">
                        <a href="{{ route('admin.productos.create') }}" class="btn btn-md btn-info text-white">
                            <i class="fas fa-plus"></i> Agregar Producto
                        </a>
                    </div>

                    <div class="filter-group-luxe p-3 d-flex flex-wrap gap-2">
                        <button class="btn-filter active" data-filter="">
                            Todos <span class="filter-count">{{ $counts['total'] }}</span>
                        </button>
                        <button class="btn-filter" data-filter="Mujer">
                            Mujer <span class="filter-count">{{ $counts['mujer'] }}</span>
                        </button>
                        <button class="btn-filter" data-filter="Hombre">
                            Hombre <span class="filter-count">{{ $counts['hombre'] }}</span>
                        </button>
                        <button class="btn-filter" data-filter="Ninos">
                            Niños <span class="filter-count">{{ $counts['ninos'] }}</span>
                        </button>
                        <button class="btn-filter" data-filter="Accesorios">
                            Accesorios <span class="filter-count">{{ $counts['accesorios'] }}</span>
                        </button>
                    </div>

                    <div class="customers__table">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre / Código</th>
                                        <th>Categoría</th>
                                        <th>SEO (Título / Slug)</th> {{-- Combinamos para ahorrar espacio horizontal --}}
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Última Edición</th> {{-- Columna para updated_at --}}
                                        <th>Status</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $item)
                                        <tr>
                                            {{-- Columna: Imagen --}}
                                            <td>
                                                @if ($item->imagen)
                                                    <img src="{{ asset('front/assets/images/productos/' . $item->imagen) }}"
                                                        class="table-img-category" alt="Producto">
                                                @else
                                                    <span class="badge bg-secondary">Sin img</span>
                                                @endif
                                            </td>

                                            {{-- Columna: Nombre / Código --}}
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold text-dark">{{ $item->nombre }}</span>
                                                    <small class="text-muted">{{ $item->codigo ?? 'Sin código' }}</small>
                                                </div>
                                            </td>

                                            {{-- Columna: Categoría --}}
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold text-dark">
                                                        {{ $item->categoria->nombre ?? 'Sin Categoría' }}
                                                    </span>

                                                    @if ($item->categoria && $item->categoria->tipo)
                                                        @php
                                                            $tipoNombre = strtolower(
                                                                $item->categoria->tipo->p_cat_name,
                                                            );
                                                            $badgeClass = match ($tipoNombre) {
                                                                'mujer' => 'badge-luxe-woman',
                                                                'hombre' => 'badge-luxe-man',
                                                                'ninos', 'niños' => 'badge-luxe-kids',
                                                                'accesorios' => 'badge-luxe-acc',
                                                                default => 'badge-luxe-default',
                                                            };
                                                        @endphp
                                                        <div class="mt-1">
                                                            <span class="badge-luxe {{ $badgeClass }}">
                                                                <i class="fas fa-tag me-1"></i>
                                                                {{ $item->categoria->tipo->p_cat_name }}
                                                            </span>
                                                        </div>
                                                    @else
                                                        <small class="text-danger mt-1">Sin tipo definido</small>
                                                    @endif
                                                </div>
                                            </td>

                                            {{-- NUEVA COLUMNA: SEO (Nombre SEO + Slug) --}}
                                            <td>
                                                <div class="d-flex flex-column" style="max-width: 220px;">
                                                    @if ($item->nombre_seo)
                                                        <span class="text-truncate fw-bold text-success"
                                                            style="font-size: 0.85rem;" title="{{ $item->nombre_seo }}">
                                                            <i class="fas fa-search me-1"></i>{{ $item->nombre_seo }}
                                                        </span>
                                                    @else
                                                        <small class="text-muted fst-italic">Sin título SEO</small>
                                                    @endif
                                                    <small class="text-info text-truncate" title="{{ $item->slug }}">
                                                        /{{ $item->slug }}
                                                    </small>
                                                </div>
                                            </td>

                                            {{-- Columna: Precio --}}
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="text-primary fw-bold">S/
                                                        {{ number_format($item->precio, 2) }}</span>
                                                    @if ($item->precio_regular)
                                                        <small class="text-decoration-line-through text-muted">
                                                            S/ {{ number_format($item->precio_regular, 2) }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>

                                            {{-- Columna: Stock --}}
                                            <td>
                                                <span
                                                    class="badge {{ $item->stock > 5 ? 'bg-light-success text-success' : 'bg-light-danger text-danger' }}">
                                                    {{ $item->stock }} unid.
                                                </span>
                                            </td>

                                            {{-- NUEVA COLUMNA: Última Actualización (updated_at) --}}
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark" style="font-size: 0.85rem;">
                                                        {{ $item->updated_at->format('d/m/Y') }}
                                                    </span>
                                                    <small class="text-muted" style="font-size: 0.75rem;">
                                                        {{ $item->updated_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </td>

                                            {{-- Columna: Status --}}
                                            <td>
                                                <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>

                                            {{-- Columna: Acción --}}
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('products.detalles', $item->slug) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-secondary" title="Ver en la tienda">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.productos.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning" title="Editar">
                                                        <i class="fas fa-edit text-white"></i>
                                                    </a>

                                                    <form action="{{ route('admin.productos.destroy', $item->id) }}"
                                                        method="POST" onsubmit="return confirm('¿Eliminar producto?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                    <a href="{{ route('admin.productos.galeria', $item->id) }}" class="btn btn-sm btn-info" title="Galería de Fotos">
                                                        <i class="fas fa-images text-white"></i>
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

@push('styles')
    <style>
        /* Estilos específicos para la tabla de productos */
        .table-img-category {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .bg-light-success {
            background-color: #e6fffa;
            color: #319795;
            border: 1px solid #b2f5ea;
        }

        .bg-light-danger {
            background-color: #fff5f5;
            color: #e53e3e;
            border: 1px solid #feb2b2;
        }

        /* Cabecera oscura que ya configuramos */
        #datatablesSimple thead th {
            background-color: #1a202c !important;
            color: white !important;
            border: none;
        }

        .customers__table {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
    </style>

    <style>
        /* Base para los mini-badges de tipo */
        .badge-luxe {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Mujer: Fucsia / Rosado Suave */
        .badge-luxe-woman {
            background-color: #fce7f3 !important;
            color: #9d174d !important;
            border: 1px solid #fbcfe8;
        }

        /* Hombre: Azul Oscuro / Profesional */
        .badge-luxe-man {
            background-color: #e0e7ff !important;
            color: #3730a3 !important;
            border: 1px solid #c7d2fe;
        }

        /* Niños: Naranja / Amarillo Cálido */
        .badge-luxe-kids {
            background-color: #ffedd5 !important;
            color: #9a3412 !important;
            border: 1px solid #fed7aa;
        }

        /* Accesorios: Verde / Teal */
        .badge-luxe-acc {
            background-color: #ccfbf1 !important;
            color: #115e59 !important;
            border: 1px solid #99f6e4;
        }

        /* Default: Gris */
        .badge-luxe-default {
            background-color: #f3f4f6 !important;
            color: #374151 !important;
            border: 1px solid #e5e7eb;
        }
    </style>

    <style>
        .filter-group-luxe {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .btn-filter {
            border: 1px solid #e2e8f0;
            background: white;
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            border-color: #4e73df;
            color: #4e73df;
        }

        .btn-filter.active {
            background-color: #4e73df;
            color: white;
            border-color: #4e73df;
            box-s hadow: 0 4px 10px rgba(78, 115, 223, 0.2);
        }

        .filter-count {
            background-color: rgba(0, 0, 0, 0.08);
            padding: 1px 7px;
            border-radius: 50px;
            font-size: 0.75rem;
            margin-left: 5px;
            transition: all 0.3s ease;
        }

        .btn-filter.active .filter-count {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-preview-luxe {
            background-color: #06b6d4 !important;
            /* Cyan moderno */
            color: white !important;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-preview-luxe:hover {
            background-color: #0891b2 !important;
            transform: scale(1.1);
            box-shadow: 0 0 8px rgba(6, 182, 212, 0.4);
        }

        /* Ajuste para los iconos dentro de los botones */
        .btn-sm i {
            font-size: 0.85rem;
        }

        /* Reduce el contenedor y los botones de la columna Acción */
        .table .btn {
            padding: 0.2rem 0.4rem !important; /* Reduce el espacio interno */
            font-size: 0.7rem !important;      /* Reduce el tamaño del icono */
            line-height: 1 !important;
            border-radius: 4px !important;
        }

        /* Específicamente para los iconos dentro de los botones */
        .table .btn i {
            font-size: 11px !important; 
        }

        /* Reduce el ancho de la celda para que no ocupen tanto espacio horizontal */
        .table td:last-child {
            white-space: nowrap;
            width: 1%;
        }

    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            var table = $('#datatablesSimple').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                "responsive": true,
                "dom": '<"row p-3"<"col-md-6"l><"col-md-6"f>>rt<"row p-3"<"col-md-5"i><"col-md-7"p>>',
                "order": [] // Mantenemos el orden que enviamos desde el Controlador
            });

            // Lógica de Filtrado por Botones
            $('.btn-filter').on('click', function() {
                // Cambiar estado activo de los botones
                $('.btn-filter').removeClass('active');
                $(this).addClass('active');

                var filterValue = $(this).data('filter');

                // Filtramos en la columna donde aparece el nombre del Tipo (ajusta el número si es necesario)
                // .column(2) se refiere a la tercera columna (empezando desde 0)
                table.column(2).search(filterValue).draw();
            });
        });
    </script>
@endpush
