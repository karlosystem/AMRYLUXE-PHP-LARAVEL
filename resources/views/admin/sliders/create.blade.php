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
                                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.sliders.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                                <div class="item-top mb-30">
                                                    <h2>Español:</h2>
                                                </div>
                                                <input type="hidden" name="id" id="id" value="2">
                                                <div class="input__group mb-25">
                                                    <label for="exampleInputEmail1">Titulo</label>
                                                    <input type="text" id="titulo" name="titulo" placeholder="Titulo">
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label for="exampleInputEmail1">Sub Titulo</label>
                                                    <input type="text" id="subtitulo" name="subtitulo" placeholder="Sub Titulo">
                                                </div>                                               
                                                <div class="input__group mb-25">
                                                    <label for="fr_btn_text">Link</label>
                                                    <input type="text" id="link" name="link" placeholder="Link">
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label for="en_description">Descripción</label>
                                                    <textarea id="descripcion" name="descripcion" placeholder="Descripcion"></textarea>
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="background_image">Imagen</label>
                                                    <input type="file" class="putImage2" name="imagen" id="imagen">
                                                    <img class="admin_image"
                                                        src="http://127.0.0.1:8000/uploaded_files/slider/hero-banner-bg-2.png"
                                                        id="target2" />
                                                </div>
                                                <div class="input__button">
                                                    <button type="submit" class="btn btn-blue">Crear</button>
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
