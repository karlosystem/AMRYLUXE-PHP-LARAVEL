@extends('front.layouts.app')

@section('title', $data->meta_title)
@section('description', $data->meta_description)
@section('keywords', $data->meta_keywords)

@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->

            <div class="row align-items-center">
                <div class="col-md-12">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active">Tienda Virtual</li>
                    </ol>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        <h1 class="mb-3">Tienda Virtual</h1>
                        <p>La tienda virtual de AMRY LUXE se presenta como una plataforma moderna y sofisticada, bajo el
                            lema "Tendencia que Impone Glamour". El sitio ofrece una experiencia de compra intuitiva
                            centrada en la Colección 2026, donde los usuarios pueden navegar por diversas categorías de
                            accesorios, como brazaletes y joyería de alta calidad.</p>
                    </div>
                </div>

            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row align-items-center mb-2 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm productsByCategory">
                                            <option value="">Categorías</option>
                                            @foreach ($categorias as $categ)
                                                {{-- Usamos la misma lógica del header: si no existe p_cat_slug, ponemos 'mujer' o el valor por defecto --}}
                                                <option
                                                    value="{{ route('products.byCategory', [$categ->tipo?->p_cat_slug ?? 'mujer', $categ->slug]) }}">
                                                    {{-- Mostramos el nombre concatenado: Tipo | Categoría --}}
                                                    {{ $categ->nombre_full }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:;" class="shorting_icon grid active"><i
                                                class="ti-view-grid"></i></a>
                                        <a href="javascript:;" class="shorting_icon list"><i
                                                class="ti-layout-list-thumb"></i></a>
                                    </div>
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm">
                                            <option value="">Paginar</option>
                                            <option value="9">9</option>
                                            <option value="12">12</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row shop_container">
                        @foreach ($producto as $prod)
                            <div class="col-md-4 col-6">
                                <div class="product">

                                    <div class="product_img">
                                        <a href="{{ route('products.detalles', $prod->slug) }}">
                                            <img src="{{ asset('front/assets/images/productos/' . $prod->imagen) }}"
                                                alt="{{ $prod->nombre }}">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li class="add-to-cart">
                                                    <a class="add-cart addToCart" data-id="{{ $prod->id }}"
                                                        href="javascript:void(0)" title="Agregar a Carrito de Compras">
                                                        <i class="icon-basket-loaded"></i> Agregar a Carrito
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" data-id="{{ $prod->id }}"
                                                        class="popup-ajax product-btn addToCompare"
                                                        title="Agregar para comparar">
                                                        <i class="icon-shuffle"></i></a>
                                                </li>

                                                <li><a href="{{ route('products.detalles', $prod->slug) }}"><i
                                                            class="icon-magnifier-add"></i></a></li>

                                                <li>
                                                    <a href="javascript:void(0)" class="product-btn addToWishList"
                                                        data-id="{{ $prod->id }}" title="Agregar a mi lista de deseos">
                                                        <i class="icon-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title">
                                            <a href="{{ route('products.detalles', $prod->slug) }}">
                                                {{ $prod->nombre }}</a>
                                        </h6>
                                        <div class="product_price">
                                            <span class="price">S/. {{ $prod->precio }}</span>
                                            <del>S/.{{ $prod->precio_regular }}</del>

                                            @if ($prod->precio_regular > 0 && $prod->precio < $prod->precio_regular)
                                                <div class="on_sale">
                                                    @php
                                                        $descuento =
                                                            (($prod->precio_regular - $prod->precio) /
                                                                $prod->precio_regular) *
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
                                            <span class="rating_num">(Código : {{ $prod->codigo }})</span>
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
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination mt-3 justify-content-center pagination_style1">
                                {{ $producto->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <div class="sidebar">

                        <div class="widget">
                            <h5 class="widget_title">Colección</h5>
                            <form method="GET" action="{{ route('products.index') }}">
                                <div class="d-flex gap-2 flex-grow-1">
                                    <div id="price_filter" data-min="0" data-max="500" data-min-value="50"
                                        data-max-value="300" data-price-sign="$"></div>
                                    <input type="text" class="form-control" id="searchwidget" name="keywords"
                                        placeholder="Buscar" value="{{ request('keywords') }}" />
                                    <button type="submit" class="btn btn-custom-submit">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                                <input type="hidden" id="minPrice" name="min_price"
                                    value="{{ request('min_price') }}" />
                                <input type="hidden" id="maxPrice" name="max_price"
                                    value="{{ request('max_price') }}" />

                            </form>

                        </div>

                        <div class="widget">
                            <h5 class="widget_title mb-3">Precio S/.</h5>
                            <form method="GET" action="{{ route('products.index') }}">
                                <input type="hidden" id="searchwidget" name="keywords"
                                    value="{{ request('keywords') }}" />

                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex gap-2 flex-grow-1">
                                        <div class="price-input-container">
                                            <input type="text" class="form-control price-field" id="minPrice"
                                                name="min_price" placeholder="Min" min="50"
                                                value="{{ request('min_price') }}" />
                                        </div>
                                        <div class="price-input-container">
                                            <input type="text" class="form-control price-field" id="maxPrice"
                                                name="max_price" placeholder="Max" value="{{ request('max_price') }}" />
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-custom-submit">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="widget">
                            <h5 class="widget_title">Colección Mujer</h5>
                            <ul class="widget_categories">
                                @foreach ($coleccion_mujer as $colMujer)
                                    <li>
                                        {{-- CAMBIO: Usamos la ruta nombrada con el prefijo de tipo dinámico --}}
                                        <a
                                            href="{{ route('products.byCategory', [$colMujer->tipo?->p_cat_slug ?? 'mujer', $colMujer->slug]) }}">
                                            <span class="categories_name">{{ $colMujer->nombre }}</span>
                                            <span class="categories_num">({{ $colMujer->productos_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget">
                            <h5 class="widget_title">Marcas</h5>
                            <ul class="list_brand">

                                @foreach ($marcas as $marca)
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input CheckBrand" type="checkbox"
                                                value="{{ $marca->id }}"
                                                @if (request()->has('brands') && in_array($marca->id, explode(',', request('brands')))) checked @endif>
                                            <label class="form-check-label"
                                                for="Renuar"><span></span>{{ $marca->nombre ?? '' }}</label>
                                        </div>
                                        {{-- <span class="brand-count">{{ $marca->prod_count }}</span> --}}
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="widget">
                            <h5 class="widget_title">Tamaño</h5>
                            <div class="product_size_switch">
                                @foreach ($tamanos as $item)
                                    {{-- <input class="form-check-input checkSize" type="checkbox" id="{{ $item->id }}" value="S"> --}}
                                    <span>{{ $item->tamano }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="widget">
                            <h5 class="widget_title">Color</h5>
                            <div class="product_color_switch">
                                @foreach ($colores as $color)
                                    <span data-color="{{ $color->color_codigo }}"></span>
                                @endforeach
                            </div>
                        </div>
                        <div class="widget">
                            <div class="shop_banner">
                                <div class="banner_img overlay_bg_20">
                                    <img src="{{ asset('front/assets/images/sidebar_banner_img.png') }}" />
                                </div>
                                <div class="shop_bn_content2 text_white">
                                    <h5 class="text-uppercase shop_subtitle">Colección 2026</h5>
                                    <h3 class="text-uppercase shop_title">Sale 30% Off</h3>
                                    <a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Comprar
                                        Ahora</a>
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
                            $('#cart-wrapper').load(window.location.href + ' #cart-wrapper > *',
                                function() {

                                    // 2. FORZAR COLOR BLANCO AL ICONO
                                    // Esto asegura que resalte sobre el fondo oscuro inmediatamente
                                    $('.cart_trigger i').css('color', '#ffffff');

                                    // 3. UNA VEZ CARGADO EL NUEVO HTML, ACTIVAMOS EL DESPLIEGUE
                                    var cartTriggerEl = document.querySelector(
                                        '.cart_trigger');
                                    if (cartTriggerEl) {
                                        // Inicializamos y mostramos el dropdown de Bootstrap 5
                                        var bsDropdown = new bootstrap.Dropdown(
                                            cartTriggerEl);
                                        bsDropdown.show();
                                    }
                                });

                            toastr.success('Producto agregado al carrito',
                            'Carrito de Compras');
                        } else {
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function() {
                        toastr.error('Hay un error, corregir', 'Error');
                    }
                });
            });

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
                        } else {
                            toastr.warning(response.message, 'Aviso');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            toastr.error('Debe iniciar sesión', 'Acceso denegado');
                        } else {
                            console.error(xhr.responseText);
                            toastr.error('Error del servidor', 'Error');
                        }
                    }
                });
            });

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
                            toastr.success(response.message, 'Éxito');
                        } else {
                            toastr.warning(response.message, 'Aviso');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            toastr.error('Debe iniciar sesión', 'Acceso denegado');
                        } else {
                            console.error(xhr.responseText);
                            toastr.error('Error del servidor', 'Error');
                        }
                    }
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(".productsByCategory").change(function() {
                // Tomamos la URL completa que ya viene en el value
                let newUrl = $(this).val();

                // Validamos que no sea la opción por defecto ("stop" o "")
                if (newUrl && newUrl !== "stop") {
                    window.location.href = newUrl;
                }
            });
        });

        // filtrar productos por marcas
        $(document).ready(function() {
            $(".CheckBrand").change(function() {
                let selectedBrands = [];
                //recuperar todas las marcas seleccionadas
                $('.CheckBrand:checked').each(function() {
                    selectedBrands.push($(this).val());
                });

                //recuperar con los otros parametros de busqueda
                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                //asignar parametros
                if (!params.has('keywords')) params.set('keywords', '');
                if (!params.has('min_price')) params.set('min_price', '');
                if (!params.has('max_price')) params.set('max_price', '');

                // construir manualmente la cadena de consulta
                params.delete('brands'); // eliminar parametro de marca existente

                if (selectedBrands.length > 0) {
                    let newParams = params.toString();
                    let newUrl = url.origin + url.pathname + '?' + newParams + '&brands=' + selectedBrands
                        .join(',');

                    //eliminar & innecesarios al final
                    newUrl = newUrl.replace(/[?&]$/, '');
                    window.location.href = newUrl;
                } else {
                    window.location.href = url.origin + url.pathname + '?' + params.toString();
                }

            });
        });
    </script>
@endpush
