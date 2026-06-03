@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Paginas</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Paginas</li>
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

                                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.paginas.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-vertical__item bg-style">
                                                <div class="input__group mb-25">
                                                    <label for="titulo">Título de la Página</label>
                                                    <input type="text" id="titulo" name="titulo"
                                                        placeholder="Ej: Quiénes Somos" required>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="slug">URL Amigable (Slug)</label>
                                                    <input type="text" id="slug" name="slug"
                                                        placeholder="quienes-somos" required>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="descripcion">Contenido / Descripción</label>
                                                    <textarea id="descripcion" name="descripcion" rows="10" placeholder="Escriba el contenido de la página aquí..."></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-vertical__item bg-style">
                                                <div class="input__group mb-25">
                                                    <label for="primary_image">Imagen Destacada</label>
                                                    <input type="file" class="form-control putImage1"
                                                        name="primary_image" id="primary_image">
                                                    <div class="mt-2">
                                                        <img src="{{ asset('admin/images/no-image.jpg') }}" id="target1"
                                                            style="width: 100%; height: auto; border-radius: 5px;" />
                                                    </div>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="status">Estado</label>
                                                    <select name="status" id="status">
                                                        <option value="1">Publicado</option>
                                                        <option value="0">Borrador</option>
                                                    </select>
                                                </div>

                                                <hr>
                                                <h5 class="mb-3">Configuración SEO</h5>

                                                <div class="input__group mb-25">
                                                    <label for="meta_title">Meta Título</label>
                                                    <input type="text" id="meta_title" name="meta_title"
                                                        placeholder="Título para buscadores">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="meta_keywords">Meta Keywords</label>
                                                    <input type="text" id="meta_keywords" name="meta_keywords"
                                                        placeholder="Palabras clave separadas por coma">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="meta_description">Meta Descripción</label>
                                                    <textarea id="meta_description" name="meta_description" rows="3" placeholder="Resumen para Google"></textarea>
                                                </div>

                                                <div class="input__button">
                                                    <button type="submit" class="btn btn-blue w-100">Guardar
                                                        Página</button>
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
    // Generador de Slug para el título de la página
    $('#titulo').on('keyup', function () {
        let str = $(this).val().toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, "") // Quitar tildes
            .replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '-')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-+|-+$/g, '');
        $('#slug').val(str);
    });

    // Previsualización de la imagen cargada
    $("#primary_image").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#target1').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $(document).ready(function() {
        $("#descripcion").summernote({
            placeholder: 'Descripción',
            height: 300
        });
        $('.dropdown-toggle').dropdown();
    });
        
</script>
@endpush