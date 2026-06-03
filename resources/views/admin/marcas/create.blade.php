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

                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                aria-labelledby="nav-one-tab">

                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('admin.marcas.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                              
                                                <div class="input__group mb-25">
                                                    <label for="name">Nombre</label>
                                                    <input type="text" id="nombre" name="nombre"
                                                        placeholder="Nombre">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="info">SLUG</label>
                                                    <input type="text" id="slug" name="slug" placeholder="Slug">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="primary_image">Imagen</label>
                                                    <input type="file" class="form-control putImage1"
                                                        name="primary_image" id="primary_image">
                                                    <img src="" id="target1" />
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>


                                                <div class="input__button">
                                                    <button type="submit" class="btn btn-blue">Crear Marca</button>
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
