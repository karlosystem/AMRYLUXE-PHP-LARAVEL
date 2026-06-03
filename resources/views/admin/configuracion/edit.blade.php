@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__title">
                        <h2>Configuración Global del Sitio</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">
                    <div class="item-title">
                        <ul class="nav nav-tabs" id="configTab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="general-tab" data-bs-toggle="tab"
                                    data-bs-target="#general" type="button">General</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social"
                                    type="button">Redes Sociales</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                                    type="button">SEO Global</button>
                            </li>
                        </ul>
                    </div>

                    <form action="{{ route('admin.configuracion.update', $config->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="tab-content mt-4" id="configTabContent">

                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input__group mb-25">
                                            <label>Nombre del Sitio Web</label>
                                            <input type="text" name="nombre_web" value="{{ $config->nombre_web }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Email Oficial</label>
                                            <input type="email" name="email" value="{{ $config->email }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Teléfono</label>
                                            <input type="text" name="telefono" value="{{ $config->telefono }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Dirección Física</label>
                                            <input type="text" name="direccion" value="{{ $config->direccion }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label>Copyright (Pie de página)</label>
                                            <input type="text" name="copyright" value="{{ $config->copyright }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <div class="input__group mb-25">
                                                    <label>Logo Principal</label>
                                                    <div class="mb-2">
                                                        <img src="{{ asset('front/assets/images/config/' . $config->logo) }}"
                                                            id="preview_logo"
                                                            style="height: 80px; width: auto; border: 1px solid #ddd;">
                                                    </div>
                                                    <input type="file" name="logo" class="form-control"
                                                        onchange="previewImage(this, '#preview_logo')">
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <div class="input__group mb-25">
                                                    <label>Logo Footer</label>
                                                    <div class="mb-2">
                                                        <img src="{{ asset('front/assets/images/config/' . $config->logofooter) }}"
                                                            id="preview_footer"
                                                            style="height: 80px; width: auto; border: 1px solid #ddd;">
                                                    </div>
                                                    <input type="file" name="logofooter" class="form-control"
                                                        onchange="previewImage(this, '#preview_footer')">
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <div class="input__group mb-25">
                                                    <label>Favicon (32x32)</label>
                                                    <div class="mb-2">
                                                        <img src="{{ asset('front/assets/images/config/' . $config->favicon) }}"
                                                            id="preview_favicon"
                                                            style="height: 40px; width: auto; border: 1px solid #ddd;">
                                                    </div>
                                                    <input type="file" name="favicon" class="form-control"
                                                        onchange="previewImage(this, '#preview_favicon')">
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <div class="input__group mb-25">
                                                    <label>Imagen Compartir (OG)</label>
                                                    <div class="mb-2">
                                                        <img src="{{ asset('front/assets/images/config/' . $config->og_imagen) }}"
                                                            id="preview_og"
                                                            style="height: 40px; width: auto; border: 1px solid #ddd;">
                                                    </div>
                                                    <input type="file" name="og_imagen" class="form-control"
                                                        onchange="previewImage(this, '#preview_og')">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>Mapa Google (Iframe)</label>
                                            <textarea name="mapa_iframe" rows="4" placeholder="Pegue el código <iframe> aquí">{{ $config->mapa_iframe }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="social" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input__group mb-25">
                                            <label><i class="fab fa-facebook"></i> Facebook</label>
                                            <input type="text" name="facebook" value="{{ $config->facebook }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label><i class="fab fa-instagram"></i> Instagram</label>
                                            <input type="text" name="instagram" value="{{ $config->instagram }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label><i class="fab fa-whatsapp"></i> WhatsApp (Link o número)</label>
                                            <input type="text" name="wasap" value="{{ $config->wasap }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input__group mb-25">
                                            <label><i class="fab fa-tiktok"></i> TikTok</label>
                                            <input type="text" name="tiktok" value="{{ $config->tiktok }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label><i class="fab fa-twitter"></i> Twitter / X</label>
                                            <input type="text" name="twitter" value="{{ $config->twitter }}">
                                        </div>
                                        <div class="input__group mb-25">
                                            <label><i class="fab fa-linkedin"></i> LinkedIn</label>
                                            <input type="text" name="linkedin" value="{{ $config->linkedin }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="seo" role="tabpanel">
                                <div class="input__group mb-25">
                                    <label>Meta Título</label>
                                    <input type="text" name="meta_title" value="{{ $config->meta_title }}">
                                </div>
                                <div class="input__group mb-25">
                                    <label>Meta Keywords</label>
                                    <textarea name="meta_keywords" rows="3">{{ $config->meta_keywords }}</textarea>
                                </div>
                                <div class="input__group mb-25">
                                    <label>Meta Descripción</label>
                                    <textarea name="meta_descripcion" rows="3">{{ $config->meta_descripcion }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="input__button mt-30 text-end">
                            <button type="submit" class="btn btn-blue">Actualizar Configuración</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function previewImage(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(target).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush