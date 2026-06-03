@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Editar Marca</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar Marca</li>
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
                                    action="{{ route('admin.marcas.update', $marca->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $marca->id }}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                                <div class="input__group mb-25">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" id="nombre" name="nombre"
                                                        value="{{ $marca->nombre }}" placeholder="Nombre">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="slug">SLUG</label>
                                                    <input type="text" id="slug" name="slug"
                                                        value="{{ $marca->slug }}" placeholder="Slug">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="primary_image">Imagen</label>
                                                    <input type="file" class="form-control" name="primary_image"
                                                        id="primary_image">
                                                    <div class="mt-3">
                                                        <p>Imagen actual:</p>
                                                        <img src="{{ asset('front/assets/images/marcas/' . $marca->imagen) }}"
                                                            id="target1"
                                                            style="width: 120px; border: 1px solid #ddd; padding: 5px;" />
                                                    </div>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status">
                                                        <option value="1" {{ $marca->status == 1 ? 'selected' : '' }}>
                                                            Activo</option>
                                                        <option value="0" {{ $marca->status == 0 ? 'selected' : '' }}>
                                                            Inactivo</option>
                                                    </select>
                                                </div>

                                                <div class="input__button">
                                                    <button type="submit" class="btn btn-blue">Actualizar Marca</button>
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
    // Generador de Slug (Misma lógica que Categorías)
    $('#nombre').on('keyup', function () {
        let str = $(this).val().toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, "") // Elimina tildes
            .replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '-')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-+|-+$/g, '');
        $('#slug').val(str);
    });

    // Previsualización de imagen
    $("#primary_image").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#target1').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush