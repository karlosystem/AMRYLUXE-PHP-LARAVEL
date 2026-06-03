@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Testimonios</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Testimonio</li>
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
                                    action="{{ route('admin.testimonio.update', $testimonio->id) }}">
                                    @csrf
                                    @method('PUT') {{-- Muy importante para la actualización --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-vertical__item bg-style">
                                                <div class="item-top mb-30">
                                                    <h2>Español:</h2>
                                                </div>
                                                 {{-- Campo oculto para el ID si lo necesitas, aunque el ID ya va en la ruta --}}
                                                <input type="hidden" name="id" id="id"
                                                    value="{{ $testimonio->id }}">

                                                <div class="input__group mb-25">
                                                    <label for="exampleInputEmail1">Nombre</label>
                                                    <input type="text" id="nombre" name="nombre" value="{{ $testimonio->nombre }}"  placeholder="Nombre">
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label for="exampleInputEmail1">Cargo</label>
                                                    <input type="text" id="cargo" name="cargo" value="{{ $testimonio->cargo }}" placeholder="Cargo">
                                                </div>                                                                                             
                                                <div class="input__group mb-25">
                                                    <label for="en_description">Comentario</label>
                                                    <textarea id="comentario" name="comentario" placeholder="comentario">{{ $testimonio->comentario }}</textarea>
                                                </div>

                                                  <div class="input__group mb-25">
                                                    <label for="imagen">Imagen Actual</label>
                                                    <input type="file" class="putImage2" name="imagen" id="imagen">

                                                    <div class="mt-2">
                                                        @if ($testimonio->imagen)
                                                            <img class="admin_image"
                                                                src="{{ asset('front/assets/images/testimonios/' . $testimonio->imagen) }}"
                                                                id="target2"
                                                                style="width: 200px; height: auto; border-radius: 8px;" />
                                                        @else
                                                            <img class="admin_image"
                                                                src="{{ asset('uploaded_files/testimonios/no-image.png') }}"
                                                                id="target2" />
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="input__button">
                                                    <button type="submit" class="btn btn-blue">Actualizar</button>
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
