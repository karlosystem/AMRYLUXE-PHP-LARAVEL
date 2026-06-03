@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Editar Categorias</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar Categorias</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                aria-labelledby="nav-one-tab">

                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('admin.categoria.update', $categoria->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $categoria->id }}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                                <div class="input__group mb-25">
                                                    <label for="sle_tipo">Tipo de Categoría</label>
                                                    <select class="form-control" id="sle_tipo" name="sle_tipo">
                                                        <option value="">--Seleccione--</option>
                                                        @foreach ($tipo_categorias as $tc)
                                                            <option value="{{ $tc->p_cat_id }}"
                                                                {{ $categoria->tipo_id == $tc->p_cat_id ? 'selected' : '' }}>
                                                                {{ $tc->p_cat_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" id="nombre" name="nombre"
                                                        value="{{ $categoria->nombre }}" placeholder="Nombre">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="slug">SLUG</label>
                                                    <input type="text" id="slug" name="slug"
                                                        value="{{ $categoria->slug }}" placeholder="Slug">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="nombre">Nombre SEO (H1)</label>
                                                    <input type="text" id="nombre_seo" name="nombre_seo"
                                                        value="{{ $categoria->nombre_seo }}" placeholder="Nombre SEO">
                                                </div>


                                                <div class="input__group mb-25">
                                                    <label for="meta_title">Meta Title</label>
                                                    <input type="text" id="meta_title" name="meta_title"
                                                        value="{{ $categoria->meta_title }}" placeholder="Meta Title">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="meta_description">Meta Description</label>
                                                    <textarea id="meta_description" rows="4" name="meta_description" placeholder="Meta description">{{ $categoria->meta_description }}</textarea>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="primary_image">Imagen Principal</label>
                                                    <input type="file" class="form-control putImage1"
                                                        name="primary_image" id="primary_image">
                                                    <div class="mt-3">
                                                        <p>Imagen actual:</p>
                                                        <img src="{{ asset('front/assets/images/categorias/' . $categoria->imagen) }}"
                                                            id="target1"
                                                            style="width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;" />
                                                    </div>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status">
                                                        <option value="1"
                                                            {{ $categoria->status == 1 ? 'selected' : '' }}>Activo</option>
                                                        <option value="0"
                                                            {{ $categoria->status == 0 ? 'selected' : '' }}>Inactivo
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="input__button">
                                                    <button type="submit" class="btn btn-blue">Actualizar
                                                        Categoría</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                                <div class="input__group mb-25">
                                                    <label for="descripcion">Descripción</label>
                                                    <textarea id="descripcion" name="descripcion" placeholder="Descripción">{{ $categoria->descripcion }}</textarea>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="adicional">Información Adicional</label>
                                                    <textarea id="adicional" name="adicional" placeholder="Información adicional">{{ $categoria->adicional }}</textarea>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="destacado">Destacado</label>
                                                    <select name="destacado" id="destacado">
                                                        <option value="1"
                                                            {{ $categoria->destacado == 1 ? 'selected' : '' }}>Activo
                                                        </option>
                                                        <option value="0"
                                                            {{ $categoria->destacado == 0 ? 'selected' : '' }}>Inactivo
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="promocion">Promoción</label>
                                                    <select name="promocion" id="promocion">
                                                        <option value="1"
                                                            {{ $categoria->promocion == 1 ? 'selected' : '' }}>Activo
                                                        </option>
                                                        <option value="0"
                                                            {{ $categoria->promocion == 0 ? 'selected' : '' }}>Inactivo
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

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

        $(document).ready(function() {
            $("#adicional").summernote({
                placeholder: 'Adicional',
                height: 300
            });
            $('.dropdown-toggle').dropdown();
        });

        $('#nombre').on('keyup', function() {
            let $this = $(this);
            let str = $this.val().toLowerCase();

            // 1. Reemplazar vocales con tilde y letra ñ mediante normalización
            str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, "");

            // 2. Reemplazar caracteres especiales y símbolos por guiones
            str = str.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '-');

            // 3. Limpiar espacios y guiones duplicados
            str = str.replace(/\s+/g, '-') // Espacios por guiones
                .replace(/-+/g, '-') // Evita guiones dobles (--)
                .replace(/^-+|-+$/g, ''); // Elimina guiones al inicio o final

            $('#slug').val(str);
        });
    </script>
@endpush
