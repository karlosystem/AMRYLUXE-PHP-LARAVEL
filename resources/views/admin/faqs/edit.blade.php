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
              <div class="row">
            <div class="col-md-12">

                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                aria-labelledby="nav-one-tab">
                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('admin.faq.update', $faq->id) }}">
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
                                                    value="{{ $faq->id }}">

                                                <div class="input__group mb-25">
                                                    <label for="titulo">Pregunta</label>
                                                    <input type="text" id="pregunta" name="pregunta"
                                                        value="{{ $faq->pregunta }}" placeholder="Pregunta">
                                                </div>

                                                <div class="input__group mb-25">
                                                    <label for="subtitulo">Respuesta</label>
                                                    <textarea id="respuesta" name="respuesta" cols="30" rows="10">{{ $faq->respuesta }}</textarea>
                                                </div>

                                              <div class="mt-30 d-flex">
                                                <button type="submit" class="btn btn-blue me-2 flex-fill">Actualizar</button>
                                                <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary flex-fill">Cancelar</a>
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
    </div>
    @endsection

@push('scripts')
@endpush
