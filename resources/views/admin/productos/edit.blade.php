@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mt-4">Editar Producto: <span class="text-primary">{{ $producto->nombre }}</span></h2>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                                    <input type="text" name="nombre" class="form-control"
                                        value="{{ old('nombre', $producto->nombre) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Nombre SEO (H1)</label>
                                    <input type="text" name="nombre_seo" class="form-control"
                                        value="{{ old('nombre_seo', $producto->nombre_seo) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label font-weight-bold">Slug (URL Única) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        value="{{ old('slug', $producto->slug) }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label font-weight-bold">Código (SKU)</label>
                                    <input type="text" name="codigo" class="form-control bg-light"
                                        value="{{ $producto->codigo }}" readonly>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label font-weight-bold">Orden</label>
                                    <input type="number" name="orden" class="form-control"
                                        value="{{ old('orden', $producto->orden) }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label font-weight-bold">Duración Delivery <span
                                            class="text-danger">*</span></label>
                                    <select name="delivery_duration" class="form-control" required>
                                        <option value="24 horas"
                                            {{ old('delivery_duration', $producto->delivery_duration) == '24 horas' ? 'selected' : '' }}>
                                            24 horas</option>
                                        <option value="48 horas"
                                            {{ old('delivery_duration', $producto->delivery_duration) == '48 horas' ? 'selected' : '' }}>
                                            48 horas</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Descripción General</label>
                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Detalles Técnicos</label>
                                    <textarea name="detalles" class="form-control" rows="3">{{ old('detalles', $producto->detalles) }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-weight-bold">Adicional</label>
                                    <textarea name="adicional" id="adicional" class="form-control" rows="3">{{ old('adicional', $producto->adicional) }}</textarea>
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
                                            class="form-control custom-input" maxlength="60"
                                            value="{{ old('meta_title', $producto->meta_title) }}" placeholder="Título para buscadores...">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label font-weight-bold d-flex justify-content-between">
                                            Meta Description
                                            <small class="text-muted"><span id="desc-count">0</span> / 160</small>
                                        </label>
                                        <textarea name="meta_description" id="meta_description" class="form-control custom-input" maxlength="160"
                                            rows="2" placeholder="Resumen atractivo para los resultados de búsqueda...">{{ old('meta_description', $producto->meta_description) }}</textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label font-weight-bold">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control custom-input"
                                            placeholder="Separa por comas" value="{{ old('meta_keywords', $producto->meta_keywords) }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                {{-- SECCIÓN DERECHA: CATEGORÍA, IMAGEN Y PRECIOS --}}
                <div class="col-lg-4">
                    {{-- ORGANIZACIÓN --}}
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold text-primary">Categoría <span
                                        class="text-danger">*</span></label>
                                <select name="categoria_id" class="form-control border-primary" required>
                                    <option value="">Seleccione Categoría...</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Marca</label>
                                <select name="marca_id" class="form-control">
                                    <option value="">Sin Marca</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}"
                                            {{ old('marca_id', $producto->marca_id) == $marca->id ? 'selected' : '' }}>
                                            {{ $marca->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- IMAGEN --}}
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <label class="form-label font-weight-bold d-block text-start">Imagen Principal</label>

                            <img id="preview-img"
                                src="{{ $producto->imagen ? asset('front/assets/images/productos/' . $producto->imagen) : asset('admin/assets/images/no-image.jpg') }}"
                                class="img-fluid rounded mb-3 border"
                                style="max-height: 180px; width: auto; object-fit: cover;">

                            <input type="file" name="imagen" id="imagen-input" class="form-control"
                                accept="image/*">
                            <small class="text-muted d-block mt-2">Dejar vacío para mantener la actual</small>
                        </div>
                    </div>

                    {{-- PRECIOS Y ESTADOS --}}
                    <div class="customers__area bg-style mb-30 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label font-weight-bold">Precio S/</label>
                                    <input type="number" name="precio" step="0.01" class="form-control"
                                        value="{{ old('precio', $producto->precio) }}" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label font-weight-bold">P. Regular S/</label>
                                    <input type="number" name="precio_regular" step="0.01" class="form-control"
                                        value="{{ old('precio_regular', $producto->precio_regular) }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label font-weight-bold">Stock Actual</label>
                                    <input type="number" name="stock" class="form-control"
                                        value="{{ old('stock', $producto->stock) }}" required>
                                </div>
                            </div>

                            <hr>

                            <div class="row luxe-checkboxes">
                                @php
                                    $checks = [
                                        'recienllegado' => 'Nuevo',
                                        'mejorvendido' => 'Best Seller',
                                        'destacado' => 'Destacado',
                                        'liquidacion' => 'Liquidación',
                                        'enventa' => 'En Venta',
                                        'status' => 'Activo',
                                    ];
                                @endphp
                                @foreach ($checks as $key => $label)
                                    <div class="col-6 mb-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="{{ $key }}"
                                                value="1" {{ old($key, $producto->$key) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $label }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-warning w-100 mt-4 py-2 font-weight-bold">
                                <i class="fas fa-sync-alt me-2"></i> ACTUALIZAR PRODUCTO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Previsualización de imagen en tiempo real
        $('#imagen-input').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Generador de slug automático (opcional, si deseas que se actualice al cambiar el nombre)
        $('input[name="nombre"]').keyup(function() {
            let text = $(this).val().toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            $('#slug').val(text);
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
                placeholder: 'Adicional',
                height: 300
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endpush
