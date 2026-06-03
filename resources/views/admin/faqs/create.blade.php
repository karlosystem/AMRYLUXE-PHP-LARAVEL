@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>F.A.Q.</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">F.A.Q.</li>
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
                                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.faq.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                                <div class="item-top mb-30">
                                                    <h2>Español:</h2>
                                                </div>
                                                <input type="hidden" name="id" id="id" value="2">
                                                <div class="input__group mb-25">
                                                    <label for="exampleInputEmail1">Pregunta</label>
                                                    <input type="text" id="pregunta" name="pregunta" placeholder="Pregunta">
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label for="exampleInputEmail1">Respuesta</label>
                                                    <textarea id="respuesta" name="respuesta" cols="30" rows="10"></textarea>
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
