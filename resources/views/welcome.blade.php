@extends('front.layouts.app')

@section('title', 'AMRY LUXE | Carteras y Bolsos de Cuero 100% Auténtico en Lima, Perú')
@section('description',
    'Descubre AMRY LUXE: exclusividad en carteras, bolsos y accesorios de cuero legítimo. Tendencia
    que impone glamour con diseños únicos y calidad artesanal.')
@section('keywords',
    'carteras de cuero, bolsos de cuero, accesorios para mujer, Amry Luxe, moda exclusiva Lima,
    carteras artesanales peruanas.')

    @php
        $destacados = $data['destacados'];
        $enventa = $data['enventa'];
        $mejorvendido = $data['mejorvendido'];
        $recienllegado = $data['recienllegado'];
        $carterascuero = $data['carteras_cuero_nacional'];
        $bolsoscuero = $data['bolsos_cuero'];
        $cimportadas = $data['carteras_importadas'];
        $billetera_mujer = $data['billeteras_mujer'];
    @endphp

@section('content')

    <!-- Home Popup Section -->
    @if (!request()->cookie('hide_popup'))
        <div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                        </button>
                        <div class="row g-0">
                            <div class="col-sm-5">
                                <div class="background_bg h-100"
                                    data-img-src="{{ asset('front/assets/images/popup_img.jpg') }}"></div>
                            </div>
                            <div class="col-sm-7">
                                <div class="popup_content">
                                    <div class="popup-text">
                                        <div class="heading_s4">
                                            <h4>¡Suscríbete y obtén un 25% de descuento!</h4>
                                        </div>
                                        <p>Suscríbase al boletín para recibir actualizaciones sobre nuevas colecciones.</p>
                                    </div>
                                    <form action="{{ route('subscribers.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input name="email" id="email" required type="email"
                                                class="form-control rounded-0" placeholder="Ingrese su Email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <button class="btn btn-fill-line btn-block text-uppercase rounded-0"
                                                title="Subscribe" type="submit">Suscribase</button>
                                        </div>
                                    </form>
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox"
                                                id="exampleCheckbox3" value="">
                                            <label class="form-check-label" for="exampleCheckbox3">
                                                <span>¡No volver a mostrar este aviso!</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- End Screen Load Popup Section -->

    <!-- START SECTION BANNER -->
    <div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
        <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                    <div class="carousel-item background_bg {{ $loop->first ? 'active' : '' }}"
                        data-img-src="{{ asset('front/assets/images/slider/' . $banner->imagen) }}">
                        <div class="banner_slide_content banner_content_inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-10">
                                        <div class="banner_content overflow-hidden">
                                            <h2 class="staggered-animation" data-animation="slideInLeft"
                                                data-animation-delay="0.5s">{{ $banner->titulo ?? '' }}</h2>
                                            <h5 class="mb-3 mb-sm-4 staggered-animation font-weight-light"
                                                data-animation="slideInLeft" data-animation-delay="1s">
                                                {{ $banner->subtitulo ?? '' }}
                                                {{--  <span class="text_default">50%</span> off Today Only! --}}
                                            </h5>
                                            <a class="btn btn-fill-out staggered-animation text-uppercase"
                                                href="{{ $banner->link }}" data-animation="slideInLeft"
                                                data-animation-delay="1.5s">Comprar Ahora</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev"><i
                    class="ion-chevron-left"></i></a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next"><i
                    class="ion-chevron-right"></i></a>
        </div>
    </div>
    <!-- END SECTION BANNER -->

    <!-- END MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section small_pb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading_tab_header">
                            <div class="heading_s2">
                                <h2>Colecciones Exclusivas</h2>
                            </div>
                            <div class="tab-style2">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#tabmenubar" aria-expanded="false">
                                    <span class="ion-android-menu"></span>
                                </button>
                                <ul class="nav nav-tabs justify-content-center justify-content-md-end" id="tabmenubar"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="arrival-tab" data-bs-toggle="tab" href="#arrival"
                                            role="tab" aria-controls="arrival" aria-selected="true">Carteras de
                                            Cuero</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sellers-tab" data-bs-toggle="tab" href="#sellers"
                                            role="tab" aria-controls="sellers" aria-selected="false">Bolsos de
                                            Cuero</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="featured-tab" data-bs-toggle="tab" href="#featured"
                                            role="tab" aria-controls="featured" aria-selected="false">Carteras
                                            Importadas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="special-tab" data-bs-toggle="tab" href="#special"
                                            role="tab" aria-controls="special" aria-selected="false">Billeteras
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab_slider">
                            <div class="tab-pane fade show active" id="arrival" role="tabpanel"
                                aria-labelledby="arrival-tab">
                                <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1"
                                    data-loop="true" data-autoplay="true" data-dots="false" data-nav="true"
                                    data-margin="20"
                                    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                                    @foreach ($carterascuero as $ccuero)
                                        <div class="item">
                                            <div class="product">
                                                <span class="pr_flash">{{ $ccuero->marca->nombre }}</span>
                                                <div class="product_img">
                                                    <a href="{{ route('products.detalles', $ccuero->slug) }}">
                                                        <img src="{{ asset('front/assets/images/productos/' . $ccuero->imagen) }}"
                                                            alt="product_img1">
                                                    </a>
                                                    <div class="product_action_box">
                                                        <ul class="list_none pr_action_btn">
                                                            <li class="add-to-cart">
                                                                <a class="add-cart addToCart"
                                                                    data-id="{{ $ccuero->id }}"
                                                                    href="javascript:void(0)"
                                                                    title="Agregar al Carrito de Compras">
                                                                    <i class="icon-basket-loaded"></i> Agregar a Carrito
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $ccuero->id }}"
                                                                    class="product-btn addToCompare"
                                                                    title="Agregar para comparar">
                                                                    <i class="icon-shuffle"></i></a>
                                                            </li>

                                                            <li><a href="{{ route('products.detalles', $ccuero->slug) }}"><i
                                                                        class="icon-magnifier-add"></i></a></li>

                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="product-btn addToWishList"
                                                                    data-id="{{ $ccuero->id }}"
                                                                    title="Agregar a mi lista de deseos">
                                                                    <i class="icon-heart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title">
                                                        <a href="{{ route('products.detalles', $ccuero->slug) }}">
                                                            {{ $ccuero->nombre }}</a>
                                                    </h6>
                                                    <div class="product_price">
                                                        <span class="price">S/. {{ $ccuero->precio }}</span>
                                                        <del>S/.{{ $ccuero->precio_regular }}</del>

                                                        @if ($ccuero->precio_regular > 0 && $ccuero->precio < $ccuero->precio_regular)
                                                            <div class="on_sale">
                                                                @php
                                                                    $descuento =
                                                                        (($ccuero->precio_regular - $ccuero->precio) /
                                                                            $ccuero->precio_regular) *
                                                                        100;
                                                                @endphp
                                                                <span>{{ round($descuento) }}% Dscto.</span>
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:80%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $ccuero->codigo }})</span>
                                                    </div>
                                                    <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Phasellus blandit massa enim. Nullam id varius nunc id varius
                                                            nunc.</p>
                                                    </div>
                                                    <div class="pr_switch_wrap">
                                                        <div class="product_color_switch">
                                                            <span class="active" data-color="#87554B"></span>
                                                            <span data-color="#333333"></span>
                                                            <span data-color="#DA323F"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                                <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1"
                                    data-loop="true" data-autoplay="true" data-dots="false" data-nav="true"
                                    data-margin="20"
                                    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

                                    @foreach ($bolsoscuero as $bcuero)
                                        <div class="item">
                                            <div class="product">
                                                <span class="pr_flash">{{ $bcuero->marca->nombre }}</span>
                                                <div class="product_img">
                                                    <a href="{{ route('products.detalles', $bcuero->slug) }}">
                                                        <img src="{{ asset('front/assets/images/productos/' . $bcuero->imagen) }}"
                                                            alt="product_img1">
                                                    </a>
                                                    <div class="product_action_box">
                                                        <ul class="list_none pr_action_btn">
                                                            <li class="add-to-cart">
                                                                <a class="add-cart addToCart"
                                                                    data-id="{{ $bcuero->id }}"
                                                                    href="javascript:void(0)"
                                                                    title="Agregar a Carrito de Compras">
                                                                    <i class="icon-basket-loaded"></i> Agregar a Carrito
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $bcuero->id }}"
                                                                    class="product-btn addToCompare"
                                                                    title="Agregar para comparar">
                                                                    <i class="icon-shuffle"></i></a>
                                                            </li>


                                                            <li><a href="{{ route('products.detalles', $bcuero->slug) }}"><i
                                                                        class="icon-magnifier-add"></i></a></li>

                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="product-btn addToWishList"
                                                                    data-id="{{ $bcuero->id }}"
                                                                    title="Agregar a mi lista de deseos">
                                                                    <i class="icon-heart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title">
                                                        <a href="{{ route('products.detalles', $bcuero->slug) }}">
                                                            {{ $bcuero->nombre }}</a>
                                                    </h6>
                                                    <div class="product_price">
                                                        <span class="price">S/. {{ $bcuero->precio }}</span>
                                                        <del>S/.{{ $bcuero->precio_regular }}</del>

                                                        @if ($bcuero->precio_regular > 0 && $bcuero->precio < $bcuero->precio_regular)
                                                            <div class="on_sale">
                                                                @php
                                                                    $descuento =
                                                                        (($bcuero->precio_regular - $bcuero->precio) /
                                                                            $bcuero->precio_regular) *
                                                                        100;
                                                                @endphp
                                                                <span>{{ round($descuento) }}% Dscto.</span>
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:80%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $bcuero->codigo }})</span>
                                                    </div>
                                                    <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Phasellus blandit massa enim. Nullam id varius nunc id varius
                                                            nunc.</p>
                                                    </div>
                                                    <div class="pr_switch_wrap">
                                                        <div class="product_color_switch">
                                                            <span class="active" data-color="#87554B"></span>
                                                            <span data-color="#333333"></span>
                                                            <span data-color="#DA323F"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                                <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1"
                                    data-loop="true" data-autoplay="true" data-dots="false" data-nav="true"
                                    data-margin="20"
                                    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

                                    @foreach ($cimportadas as $cimpo)
                                        <div class="item">
                                            <div class="product">
                                                <span class="pr_flash">{{ $cimpo->marca->nombre }}</span>
                                                <div class="product_img">
                                                    <a href="{{ route('products.detalles', $cimpo->slug) }}">
                                                        <img src="{{ asset('front/assets/images/productos/' . $cimpo->imagen) }}"
                                                            alt="product_img1">
                                                    </a>
                                                    <div class="product_action_box">
                                                        <ul class="list_none pr_action_btn">
                                                            <li class="add-to-cart">
                                                                <a class="add-cart addToCart"
                                                                    data-id="{{ $cimpo->id }}"
                                                                    href="javascript:void(0)"
                                                                    title="Agregar a Carrito de Compras">
                                                                    <i class="icon-basket-loaded"></i> Agregar a Carrito
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $cimpo->id }}"
                                                                    class="product-btn addToCompare"
                                                                    title="Agregar para comparar">
                                                                    <i class="icon-shuffle"></i></a>
                                                            </li>

                                                            <li><a href="{{ route('products.detalles', $cimpo->slug) }}"><i
                                                                        class="icon-magnifier-add"></i></a></li>

                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="product-btn addToWishList"
                                                                    data-id="{{ $cimpo->id }}"
                                                                    title="Agregar a mi lista de deseos">
                                                                    <i class="icon-heart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title">
                                                        <a href="{{ route('products.detalles', $cimpo->slug) }}">
                                                            {{ $cimpo->nombre }}</a>
                                                    </h6>
                                                    <div class="product_price">
                                                        <span class="price">S/. {{ $cimpo->precio }}</span>
                                                        <del>S/.{{ $cimpo->precio_regular }}</del>

                                                        @if ($cimpo->precio_regular > 0 && $cimpo->precio < $cimpo->precio_regular)
                                                            <div class="on_sale">
                                                                @php
                                                                    $descuento =
                                                                        (($cimpo->precio_regular - $cimpo->precio) /
                                                                            $cimpo->precio_regular) *
                                                                        100;
                                                                @endphp
                                                                <span>{{ round($descuento) }}% Dscto.</span>
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:80%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $cimpo->codigo }})</span>
                                                    </div>
                                                    <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Phasellus blandit massa enim. Nullam id varius nunc id varius
                                                            nunc.</p>
                                                    </div>
                                                    <div class="pr_switch_wrap">
                                                        <div class="product_color_switch">
                                                            <span class="active" data-color="#87554B"></span>
                                                            <span data-color="#333333"></span>
                                                            <span data-color="#DA323F"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade" id="special" role="tabpanel" aria-labelledby="special-tab">
                                <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1"
                                    data-loop="true" data-autoplay="true" data-dots="false" data-nav="true"
                                    data-margin="20"
                                    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

                                    @foreach ($billetera_mujer as $bmujer)
                                        <div class="item">
                                            <div class="product">
                                                <span class="pr_flash">{{ $bmujer->marca->nombre }}</span>
                                                <div class="product_img">
                                                    <a href="{{ route('products.detalles', $bmujer->slug) }}">
                                                        <img src="{{ asset('front/assets/images/productos/' . $bmujer->imagen) }}"
                                                            alt="product_img1">
                                                    </a>
                                                    <div class="product_action_box">
                                                        <ul class="list_none pr_action_btn">
                                                            <li class="add-to-cart">
                                                                <a class="add-cart addToCart"
                                                                    data-id="{{ $bmujer->id }}"
                                                                    href="javascript:void(0)"
                                                                    title="Agregar a Carrito de Compras">
                                                                    <i class="icon-basket-loaded"></i> Agregar a Carrito
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $bmujer->id }}"
                                                                    class="product-btn addToCompare"
                                                                    title="Agregar para comparar">
                                                                    <i class="icon-shuffle"></i></a>
                                                            </li>


                                                            <li><a href="{{ route('products.detalles', $bmujer->slug) }}"><i
                                                                        class="icon-magnifier-add"></i></a></li>

                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="product-btn addToWishList"
                                                                    data-id="{{ $bmujer->id }}"
                                                                    title="Agregar a mi lista de deseos">
                                                                    <i class="icon-heart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title">
                                                        <a href="{{ route('products.detalles', $bmujer->slug) }}">
                                                            {{ $bmujer->nombre }}</a>
                                                    </h6>
                                                    <div class="product_price">
                                                        <span class="price">S/. {{ $bmujer->precio }}</span>
                                                        <del>S/.{{ $bmujer->precio_regular }}</del>

                                                        @if ($bmujer->precio_regular > 0 && $bmujer->precio < $bmujer->precio_regular)
                                                            <div class="on_sale">
                                                                @php
                                                                    $descuento =
                                                                        (($bmujer->precio_regular - $bmujer->precio) /
                                                                            $bmujer->precio_regular) *
                                                                        100;
                                                                @endphp
                                                                <span>{{ round($descuento) }}% Dscto.</span>
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate" style="width:80%"></div>
                                                        </div>
                                                        <span class="rating_num">({{ $bmujer->codigo }})</span>
                                                    </div>
                                                    <div class="pr_desc">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Phasellus blandit massa enim. Nullam id varius nunc id varius
                                                            nunc.</p>
                                                    </div>
                                                    <div class="pr_switch_wrap">
                                                        <div class="product_color_switch">
                                                            <span class="active" data-color="#87554B"></span>
                                                            <span data-color="#333333"></span>
                                                            <span data-color="#DA323F"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->

        <!-- START SECTION BANNER -->
        <div class="section pb_20 small_pt">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="single_banner">
                            <img src="{{ asset('front/assets/images/oferta01.png') }}" alt="shop_banner_img1">
                            <div class="single_banner_info">
                                <h5 class="single_bn_title1">Cartera 100% Cuero</h5>
                                <h3 class="single_bn_title">Colección 2026</h3>
                                <a href="{{ route('products.index') }}" class="single_bn_link">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single_banner">
                            <img src="{{ asset('front/assets/images/oferta02.png') }}" alt="shop_banner_img2">
                            <div class="single_banner_info">
                                <h3 class="single_bn_title">New Season</h3>
                                <h4 class="single_bn_title1">Sale 40% Off</h4>
                                <a href="{{ route('products.index') }}" class="single_bn_link">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION BANNER -->

        <!-- START SECTION SHOP -->
        <div class="section small_pt small_pb">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading_tab_header">
                            <div class="heading_s2">
                                <h2>Colecciones para Mujer</h2>
                            </div>
                            <div class="deal_timer">
                                <div class="countdown_time countdown_style1" data-time="2026/02/15 13:22:15"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true"
                            data-dots="false" data-autoplay="true" data-nav="true" data-margin="20"
                            data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

                            @foreach ($categorias_damas as $cat_damas)
                                <div class="item">
                                    <div class="product">
                                        <div class="product_img">
                                            {{-- CAMBIO: Vinculamos la imagen con la nueva ruta --}}
                                            <a
                                                href="{{ route('products.byCategory', [$cat_damas->tipo?->p_cat_slug ?? 'mujer', $cat_damas->slug]) }}">
                                                <img src="{{ asset('front/assets/images/categorias/' . $cat_damas->imagen) }}"
                                                    alt="{{ $cat_damas->nombre }}">
                                            </a>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title text-center">
                                                {{-- CAMBIO: Actualizamos el enlace del título --}}
                                                <a
                                                    href="{{ route('products.byCategory', [$cat_damas->tipo?->p_cat_slug ?? 'mujer', $cat_damas->slug]) }}">
                                                    {{ $cat_damas->nombre }}
                                                </a>
                                            </h6>

                                            <div class="pr_desc">
                                                <p>Explora nuestra colección exclusiva de {{ $cat_damas->nombre }} diseñada
                                                    para resaltar la elegancia de AMRY LUXE.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->

        <!-- START SECTION BANNER -->
        <div class="section pb_20 small_pt">
            <div class="container-fluid px-2">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="sale_banner">
                            <a class="hover_effect1" href="{{ route('products.index') }}">
                                <img src="{{ asset('front/assets/images/shop_banner_img3.jpg') }}"
                                    alt="Oferta en AMRY LUXE">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sale_banner">
                            <a class="hover_effect1" href="{{ route('products.index') }}">
                                <img src="{{ asset('front/assets/images/shop_banner_img4.jpg') }}"
                                    alt="Oferta en AMRY LUXE">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sale_banner">
                            <a class="hover_effect1" href="{{ route('products.index') }}">
                                <img src="{{ asset('front/assets/images/shop_banner_img5.jpg') }}"
                                    alt="Oferta en AMRY LUXE">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION BANNER -->


        <!-- START SECTION CATEGORIES -->
        <div class="section small_pb small_pt">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="heading_s4 text-center">
                            <h2>Explora Más Colecciones</h2>
                        </div>
                        <p class="text-center mx-auto">
                            Descubre nuestra selección exclusiva diseñada para complementar tu estilo.
                            Desde accesorios únicos hasta las últimas tendencias para caballeros y jóvenes,
                            tenemos el detalle perfecto para cada ocasión.
                        </p>
                    </div>
                </div>

                <div class="row g-4">

                    <div class="col-12">
                        <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true"
                            data-autoplay="true" data-margin="20"
                            data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                            @foreach ($categorias_otras as $otras)
                                <div class="item">
                                    <div class="product_wrap">
                                        <div class="product_img">
                                            {{-- CAMBIO AQUÍ: Usamos la ruta con el tipo y el slug --}}
                                            <a
                                                href="{{ route('products.byCategory', [$otras->tipo->p_cat_slug, $otras->slug]) }}">
                                                <img src="{{ asset('front/assets/images/categorias/' . $otras->imagen) }}"
                                                    alt="{{ $otras->nombre }}">
                                                <img class="product_hover_img"
                                                    src="{{ asset('front/assets/images/categorias/' . $otras->imagen) }}"
                                                    alt="{{ $otras->nombre }}">
                                            </a>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title">
                                                {{-- CAMBIO AQUÍ: También actualizamos el enlace del título --}}
                                                <a
                                                    href="{{ route('products.byCategory', [$otras->tipo->p_cat_slug, $otras->slug]) }}">
                                                    {{ $otras->nombre }}
                                                </a>
                                            </h6>
                                            <div class="product_price">
                                                <div class="on_sale">
                                                    <span>25% de Descuento</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{--  @foreach ($categorias_otras as $otras)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="categories_box border rounded shadow-sm h-100 d-flex flex-column">

                                <a href="{{ url('categoria/' . $otras->slug) }}"
                                    class="text-decoration-none p-3 text-center flex-grow-1">
                                    <div class="img_container mb-3" style="background: #f8f9fa; border-radius: 5px;">
                                        <img src="{{ asset('front/assets/images/categorias/' . $otras->imagen) }}"
                                            alt="{{ $otras->nombre }}" class="img-fluid"
                                            style="height: 140px; object-fit: contain; padding: 10px;" />
                                    </div>
                                    <h6 class="text-dark fw-bold mb-0">{{ $otras->nombre }}</h6>
                                </a>

                                <a href="{{ url('categoria/' . $otras->slug) }}"
                                    class="btn btn-danger btn-sm rounded-0 w-100 py-2 fw-light"
                                    style="background-color: #ff324d; border: none; font-size: 0.85rem;">
                                    Ver Más
                                </a>
                            </div>
                        </div>
                    @endforeach --}}
                </div>

            </div>
        </div>
        <!-- END SECTION CATEGORIES -->

        <!-- START SECTION CLIENT LOGO -->
        <div class="section small_pt">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading_tab_header">
                            <div class="heading_s2">
                                <h2>Nuestras Marcas</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3" data-dots="false"
                            data-nav="true" data-margin="30" data-loop="true" data-autoplay="true"
                            data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}}'>
                            <div class="item">
                                <div class="cl_logo">
                                    <img src="{{ asset('front/assets/images/cl_logo1.png') }}" alt="cl_logo" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="cl_logo">
                                    <img src="{{ asset('front/assets/images/cl_logo2.png') }}" alt="cl_logo" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="cl_logo">
                                    <img src="{{ asset('front/assets/images/cl_logo3.png') }}" alt="cl_logo" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="cl_logo">
                                    <img src="{{ asset('front/assets/images/cl_logo4.png') }}" alt="cl_logo" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="cl_logo">
                                    <img src="{{ asset('front/assets/images/cl_logo5.png') }}" alt="cl_logo" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="cl_logo">
                                    <img src="{{ asset('front/assets/images/cl_logo6.png') }}" alt="cl_logo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION CLIENT LOGO -->

        <!-- START SECTION SUBSCRIBE NEWSLETTER -->
        <div class="section bg_dark small_pt small_pb">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="heading_s1 mb-md-0 heading_light">
                            <h3>Boletin de Ofertas</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="newsletter_form">
                            <form action="{{ route('subscribers.store') }}" method="POST">
                                @csrf
                                <input type="email" class="form-control rounded-0" id="email" name="email"
                                    placeholder="Email" />

                                <button type="submit" class="btn btn-fill-out rounded-0" name="submit"
                                    value="Submit">Subscribase</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- START SECTION SUBSCRIBE NEWSLETTER -->

    </div>
    <!-- END MAIN CONTENT -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.addToCart').on('click', function(e) {
                e.preventDefault();
                var productoId = $(this).data('id');

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        productoId: productoId,
                        cantidad: 1,
                        _token: "{{ csrf_token() }}"
                    },
                   success: function(response) {
                        if (response.status === 'success') {
                            // 1. REFRESCAR EL CONTENEDOR DEL HEADER
                            // Cargamos el fragmento del carrito desde el servidor
                            $('#cart-wrapper').load(window.location.href + ' #cart-wrapper > *', function() {

                                // 2. FORZAR COLOR BLANCO AL ICONO
                                // Esto asegura que resalte sobre el fondo oscuro inmediatamente
                                $('.cart_trigger i').css('color', '#ffffff');
                                
                                // 3. UNA VEZ CARGADO EL NUEVO HTML, ACTIVAMOS EL DESPLIEGUE
                                var cartTriggerEl = document.querySelector('.cart_trigger');
                                if (cartTriggerEl) {
                                    // Inicializamos y mostramos el dropdown de Bootstrap 5
                                    var bsDropdown = new bootstrap.Dropdown(cartTriggerEl);
                                    bsDropdown.show(); 
                                }
                            });

                            // 3. MOSTRAR NOTIFICACIÓN
                            toastr.success('Producto agregado al carrito', 'Carrito de Compras');

                        } else {
                            toastr.error(response.message || 'No se pudo agregar el producto', 'Error');
                        }
                    },
                    error: function() {
                        toastr.error('Hay un error, corregir', 'Error');
                    }
                });
            });

            // Lógica para Wishlist
            $('.addToWishList').on('click', function(e) {
                e.preventDefault();
                let productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('wishlist.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message, 'Éxito');
                            // ACTUALIZACIÓN AUTOMÁTICA DEL NÚMERO
                            $('.wishlist_count_value').text(response.count);
                        } else {
                            toastr.warning(response.message, 'Aviso');
                        }
                    },
                    // ... (error igual)
                });
            });

            // Lógica para Comparar
            $('.addToCompare').on('click', function(e) {
                e.preventDefault();
                let productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('compare.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message, 'Éxito', {
                                timeOut: 3000
                            });
                            // ACTUALIZACIÓN AUTOMÁTICA DEL NÚMERO
                            $('.compare_count_value').text(response.count);
                        } else {
                            toastr.warning(response.message, 'Aviso');
                        }
                    },
                    // ... (error igual)
                });
            });

        });
    </script>

    <script src="{{ asset('front/assets/js/toastr.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            // 1. Verificar si la cookie 'hide_popup' existe
            if (!getCookie('hide_popup')) {
                // Si no existe, mostrar el modal después de 2 segundos
                setTimeout(function() {
                    $('#onload-popup').modal('show');
                }, 2000);
            }

            // 2. Detectar cuando se cierra el modal o se pulsa suscribirse
            $('#onload-popup').on('hidden.bs.modal', function() {
                if ($('#exampleCheckbox3').is(':checked')) {
                    // Crear cookie por 30 días si el check está marcado
                    setCookie('hide_popup', 'true', 30);
                }
            });
        });

        // Funciones auxiliares para manejar Cookies
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
    </script>
@endpush
