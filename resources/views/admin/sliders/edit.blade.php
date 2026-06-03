@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Sliders</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sliders</li>
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
                                    action="{{ route('admin.sliders.update', $banner->id) }}">
                                    @csrf
                                    @method('PUT') {{-- Muy importante para la actualización --}}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                                <div class="item-top mb-30">
                                                    <h2>Español (Editar):</h2>
                                                </div>

                                                {{-- Campo oculto para el ID si lo necesitas, aunque el ID ya va en la ruta --}}
                                                <input type="hidden" name="id" id="id"
                                                    value="{{ $banner->id }}">

                                                <div class="input__group mb-25">
                                                    <label for="titulo">Titulo</label>
                                                    <input type="text" id="titulo" name="titulo"
                                                        value="{{ $banner->titulo }}" placeholder="Titulo">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="subtitulo">Sub Titulo</label>
                                                    <input type="text" id="subtitulo" name="subtitulo"
                                                        value="{{ $banner->subtitulo }}" placeholder="Sub Titulo">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="link">Link</label>
                                                    <input type="text" id="link" name="link"
                                                        value="{{ $banner->link }}" placeholder="Link">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="descripcion">Descripción</label>
                                                    <textarea id="descripcion" name="descripcion" placeholder="Descripcion">{{ $banner->descripcion }}</textarea>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="imagen">Imagen Actual</label>
                                                    <input type="file" class="putImage2" name="imagen" id="imagen">

                                                    <div class="mt-2">
                                                        @if ($banner->imagen)
                                                            <img class="admin_image"
                                                                src="{{ asset('front/assets/images/slider/' . $banner->imagen) }}"
                                                                id="target2"
                                                                style="width: 200px; height: auto; border-radius: 8px;" />
                                                        @else
                                                            <img class="admin_image"
                                                                src="{{ asset('uploaded_files/slider/no-image.png') }}"
                                                                id="target2" />
                                                        @endif
                                                    </div>
                                                </div>

                                              <div class="mt-30 d-flex">
                                                <button type="submit" class="btn btn-blue me-2 flex-fill">Actualizar</button>
                                                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary flex-fill">Cancelar</a>
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
@endpush
