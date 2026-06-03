@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- SECCIÓN IZQUIERDA: CONTENIDO --}}
                <div class="col-lg-8">
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="item-title p-3 text-white"
                            style="background-color: #1a202c; border-radius: 12px 12px 0 0;">
                            <h5 class="mb-0 text-white"><i class="fas fa-box-open me-2"></i> Información del Producto</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Nombre del Producto <span
                                            class="text-danger">*</span></label>
                                   <input type="text" name="nombre" 
                                        class="form-control @error('nombre') is-invalid @enderror" 
                                        value="{{ old('nombre') }}">

                                    @error('nombre')
                                        <div class="invalid-feedback d-block"> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Nombre SEO (H1)</label>
                                    <input type="text" name="nombre_seo" class="form-control custom-input"
                                        value="{{ old('nombre_seo') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Slug (URL Única) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light @error('slug') border-danger @enderror"><i
                                                class="fas fa-link"></i></span>
                                        <input type="text" name="slug" id="slug"
                                            class="form-control custom-input @error('slug') is-invalid @enderror" required
                                            value="{{ old('slug') }}">
                                    </div>
                                    @error('slug')
                                        <small class="text-danger" style="font-size: 0.8rem;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label font-weight-bold">Código (SKU) <i class="fas fa-lock ms-1"
                                            style="font-size: 0.7rem;"></i></label>
                                    <input type="text" name="codigo" class="form-control custom-input bg-light"
                                        value="{{ $sku }}" readonly
                                        style="cursor: not-allowed; border: 1px dashed #cbd5e1 !important;"
                                        title="Este código se genera automáticamente y es único.">
                                    <small class="text-primary fw-bold">Formato automático: US-XXXXX</small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label font-weight-bold">Orden de Aparición</label>
                                    <input type="number" name="orden" class="form-control custom-input"
                                        value="{{ old('orden', 0) }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label font-weight-bold">Duración de Delivery <span
                                            class="text-danger">*</span></label>
                                    <select name="delivery_duration"
                                        class="form-control custom-input @error('delivery_duration') is-invalid @enderror"
                                        required>
                                        <option value="" disabled selected>Seleccione...</option>
                                        <option value="24 horas"
                                            {{ old('delivery_duration') == '24 horas' ? 'selected' : '' }}>24 horas</option>
                                        <option value="48 horas"
                                            {{ old('delivery_duration') == '48 horas' ? 'selected' : '' }}>48 horas</option>
                                    </select>
                                    @error('delivery_duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Descripción General</label>
                                    <textarea name="descripcion" id="descripcion" class="form-control custom-input" rows="3">{{ old('descripcion') }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Información Adicional</label>
                                    <textarea name="adicional" id="adicional" class="form-control custom-input" rows="3">{{ old('adicional') }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Detalles Técnicos</label>
                                    <textarea name="detalles" class="form-control custom-input" rows="3">{{ old('detalles') }}</textarea>
                                </div>


                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN SEO --}}
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="item-title p-3 text-white"
                            style="background-color: #2d3748; border-radius: 12px 12px 0 0;">
                            <h5 class="mb-0 text-white"><i class="fas fa-search me-2"></i> Configuración SEO (Meta Tags)
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold d-flex justify-content-between">
                                        Meta Title
                                        <small class="text-muted"><span id="title-count">0</span> / 60</small>
                                    </label>
                                    <input type="text" name="meta_title" id="meta_title"
                                        class="form-control custom-input" maxlength="60" value="{{ old('meta_title') }}"
                                        placeholder="Título para buscadores...">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold d-flex justify-content-between">
                                        Meta Description
                                        <small class="text-muted"><span id="desc-count">0</span> / 160</small>
                                    </label>
                                    <textarea name="meta_description" id="meta_description" class="form-control custom-input" maxlength="160"
                                        rows="2" placeholder="Resumen atractivo para los resultados de búsqueda...">{{ old('meta_description') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label font-weight-bold">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control custom-input"
                                        placeholder="Separa por comas" value="{{ old('meta_keywords') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN DERECHA: ESTADOS Y CATEGORÍA --}}
                <div class="col-lg-4">
                    {{-- ORGANIZACIÓN --}}
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold text-primary">Tipo de Categoría</label>
                                <select id="tipo_id" class="form-control custom-input border-primary">
                                    <option value="">Seleccione Tipo...</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->p_cat_id }}">{{ $tipo->p_cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label font-weight-bold text-primary">Categoría <span
                                        class="text-danger">*</span></label>
                                <select name="categoria_id" id="categoria_id" 
                                    class="form-control custom-input @error('categoria_id') is-invalid @enderror" 
                                    required disabled>
                                    <option value="">Seleccione un tipo primero</option>
                                </select>
                                @error('categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Marca</label>
                                <select name="marca_id" class="form-control custom-input">
                                    <option value="">Sin Marca</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- IMAGEN --}}
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <label class="form-label font-weight-bold d-block text-start">Imagen Principal <span
                                    class="text-danger">*</span></label>
                            <img id="preview-img" src="{{ asset('admin/assets/images/no-image.jpg') }}"
                                class="img-fluid rounded mb-3 border" style="max-height: 180px;">
                            <input type="file" name="imagen" id="imagen-input" 
                                class="form-control custom-input @error('imagen') is-invalid @enderror" 
                                accept="image/*" required>
                            @error('imagen')
                                <div class="invalid-feedback text-start d-block">{{ $message }}</div> 
                                {{-- Agregamos d-block para forzar visibilidad --}}
                            @enderror
                        </div>
                    </div>

                    {{-- PRECIOS Y FLAGS --}}
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                               <div class="col-6 mb-3">
                                    <label class="form-label font-weight-bold">Precio S/</label>
                                    <input type="number" name="precio" step="0.01"
                                        class="form-control custom-input @error('precio') is-invalid @enderror" 
                                        value="{{ old('precio') }}" required>
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label font-weight-bold">P. Regular S/</label>
                                    <input type="number" name="precio_regular" step="0.01"
                                        class="form-control custom-input">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label font-weight-bold">Stock Actual</label>
                                    <input type="number" name="stock" class="form-control custom-input"
                                        value="1" required>
                                </div>
                            </div>

                            <hr>

                            <div class="row luxe-checkboxes">
                                <div class="col-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="recienllegado"
                                            value="1">
                                        <label class="form-check-label">Nuevo</label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="mejorvendido"
                                            value="1">
                                        <label class="form-check-label">Best Seller</label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="destacado" value="1"
                                            checked>
                                        <label class="form-check-label">Destacado</label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="liquidacion"
                                            value="1">
                                        <label class="form-check-label">Liquidación</label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="enventa" value="1"
                                            checked>
                                        <label class="form-check-label">En Venta</label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" value="1"
                                            checked>
                                        <label class="form-check-label">Activo</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary-luxe w-100 mt-4 py-2">
                                <i class="fas fa-save me-2"></i> PUBLICAR PRODUCTO
                            </button>

                            {{-- Botón Cancelar / Regresar --}}
                            <a href="{{ route('admin.productos.index') }}" class="btn btn-cancel-luxe py-2 px-3 mt-5"
                                title="Cancelar y regresar">
                                <i class="fas fa-times me-2"></i> CANCELAR
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        #title-count,
        #desc-count {
            font-family: monospace;
            font-weight: bold;
        }

        .text-success {
            color: #10b981 !important;
        }

        /* Verde Esmeralda */
        .text-warning {
            color: #f59e0b !important;
        }

        /* Ámbar */
        .text-danger {
            color: #ef4444 !important;
        }

        /* Rojo */

        /* Fuerza la visualización de errores aunque el DOM sea complejo */
        .is-invalid~.invalid-feedback,
        .is-invalid~.text-danger {
            display: block !important;
        }

        .custom-input.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25 margin-top: 5px;
            rem rgba(220, 53, 69, 0.25) !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // 1. Previsualización de Imagen
        document.getElementById('imagen-input').onchange = evt => {
            const [file] = evt.target.files
            if (file) {
                document.getElementById('preview-img').src = URL.createObjectURL(file)
            }
        }

        // 2. Carga Dinámica de Categorías por Tipo
        $('#tipo_id').on('change', function() {
            var tipoId = $(this).val();
            var categorySelect = $('#categoria_id');

            if (tipoId) {
                categorySelect.prop('disabled', false).html('<option value="">Cargando...</option>');

                // Llamada AJAX a una ruta que crearemos
                $.get('/admin/get-categorias/' + tipoId, function(data) {
                    categorySelect.html('<option value="">Seleccione Categoría...</option>');
                    $.each(data, function(index, cat) {
                        categorySelect.append('<option value="' + cat.id + '">' + cat.nombre +
                            '</option>');
                    });
                });
            } else {
                categorySelect.prop('disabled', true).html(
                    '<option value="">Primero seleccione un tipo...</option>');
            }
        });
    </script>
@endpush

@push('scripts')
    <script>
        "use strict";
        $(document).ready(function() {
            $("#descripcion").summernote({
                placeholder: 'Description',
                height: 300
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endpush

@push('scripts')
    <script>
        "use strict";
        $(document).ready(function() {
            $("#adicional").summernote({
                placeholder: 'Description',
                height: 300
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endpush

@push('styles')
    <style>
        .custom-input {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0 !important;
            padding: 10px !important;
        }

        .btn-primary-luxe {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary-luxe:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
        }
    </style>
@endpush

@push('styles')
    <style>
        .custom-input {
            border-radius: 6px !important;
            border: 1px solid #d1d5db !important;
            font-size: 0.9rem;
        }

        .custom-input:focus {
            border-color: #4e73df !important;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1) !important;
        }

        .luxe-checkboxes .form-check-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #4b5563;
        }

        .form-switch .form-check-input {
            width: 2.5em;
            cursor: pointer;
        }

        .btn-primary-luxe {
            background: #1a202c;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-cancel-luxe {
            background-color: #ef4444;
            color: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel-luxe:hover {
            background-color: #fee2e2;
            /* Rojo muy suave */
            color: #ef4444;
            /* Rojo alerta */
            border-color: #fecaca;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 4px;
        }

        /* Resaltado para inputs con error */
        .custom-input.is-invalid {
            border-color: #ef4444 !important;
            background-image: none !important;
            /* Quita el icono de advertencia de BS por defecto */
        }

        .custom-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            function updateCounter(inputId, counterId, limit) {
                const input = $(inputId);
                const counter = $(counterId);

                input.on('input', function() {
                    const length = $(this).val().length;
                    counter.text(length);

                    // Cambio de color visual según la proximidad al límite
                    if (length >= limit) {
                        counter.addClass('text-danger').removeClass('text-success');
                    } else if (length > (limit * 0.8)) {
                        counter.addClass('text-warning').removeClass('text-danger text-success');
                    } else {
                        counter.addClass('text-success').removeClass('text-danger text-warning');
                    }
                });

                // Ejecutar al cargar por si hay valores previos (old)
                input.trigger('input');
            }

            // Inicializar contadores
            updateCounter('#meta_title', '#title-count', 60);
            updateCounter('#meta_description', '#desc-count', 160);
        });
    </script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            const nombreInput = $('input[name="nombre"]');
            const slugInput = $('input[name="slug"]');
            let slugEditadoManualmente = false;

            // Detectar si el usuario escribe manualmente en el slug
            slugInput.on('keydown', function() {
                slugEditadoManualmente = true;
            });

            // Función para convertir texto a Slug
            function convertToSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-') // Reemplaza espacios por -
                    .replace(/[^\w\-]+/g, '') // Elimina caracteres no alfanuméricos
                    .replace(/\-\-+/g, '-') // Reemplaza múltiples - por uno solo
                    .replace(/^-+/, '') // Trim - al inicio
                    .replace(/-+$/, ''); // Trim - al final
            }

            // Escuchar el evento de escritura en el nombre
            nombreInput.on('keyup', function() {
                if (!slugEditadoManualmente) {
                    const suggestedSlug = convertToSlug($(this).val());
                    slugInput.val(suggestedSlug);
                }
            });

            // Opcional: Si borra todo el slug, reactivar la sincronización
            slugInput.on('blur', function() {
                if ($(this).val() === "") {
                    slugEditadoManualmente = false;
                    const suggestedSlug = convertToSlug(nombreInput.val());
                    slugInput.val(suggestedSlug);
                }
            });
        });
    </script>
@endpush
