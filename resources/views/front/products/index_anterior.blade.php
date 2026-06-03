@extends('front.layouts.app')

@section('title', $data->meta_title)
@section('description', $data->meta_description)
@section('keywords', $data->meta_keywords)

@section('content')
    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">
                    Nuestra Tienda
                </h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="{{ route('home.index') }}">Inicio</a>
                    </li>
                    <li class="page-item">
                        Nuestra Tienda</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- Product Area Start -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="sidebar-widget-area mobile-sidebar">
                        <div class="sidebar-widget-header d-block d-lg-none">
                            <div class="widget-header-wrap">
                                <h5 class="offcanvas-title">Filtrar</h5>
                                <button type="button" class="btn-close text-reset sidebar-close"></button>
                            </div>
                        </div>

                        <div class="single-widget search-widget">
                            <h3 class="widget-title">Buscar aqui</h3>
                            <form method="GET" action="{{ route('products.index') }}">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="searchwidget" name="keywords"
                                        placeholder="Buscar producto" value="{{ request('keywords') }}" />
                                    <button type="submit" class="search-btn"><i
                                            class="flaticon-search searchWidget"></i></button>
                                </div>
                                <input type="hidden" id="minPrice" name="min_price" value="{{ request('min_price') }}" />
                                <input type="hidden" id="maxPrice" name="max_price" value="{{ request('max_price') }}" />
                            </form>
                        </div>



                        <div class="single-widget price-widget">
                            <h3 class="widget-title">Precio S/.</h3>
                            <form method="GET" action="{{ route('products.index') }}">
                                <input type="hidden" id="searchwidget" name="keywords" value="{{ request('keywords') }}" />
                                <div class="price-wrap">
                                    <div class="price-wrap-left">
                                        <div class="single-price">
                                            <input type="number" class="form-control" id="minPrice" name="min_price"
                                                placeholder="S/. Min" min="50" value="{{ request('min_price') }}" />
                                        </div>
                                        <div class="single-price">
                                            <input type="number" class="form-control" id="maxPrice" name="max_price"
                                                placeholder="S/. Max" value="{{ request('max_price') }}" />
                                        </div>
                                    </div>
                                    <button type="submit" class="price-submit PriceSubmit"><i
                                            class="fas fa-play"></i></button>
                                </div>
                            </form>
                        </div>

                        {{--    <div class="single-widget colors-widget">
                            <h3 class="widget-title">Colores</h3>
                            <div class="colors-list">
                                @foreach ($colores as $color)
                                    <div class="single-colors">
                                        <div class="colors-left">
                                            <input style="background: {{ $color->color_codigo }}"
                                                class="form-check-input checkColor" type="checkbox" id="#FF0000"
                                                value="{{ $color->id }}">
                                            <label class="form-check-label" for="#FF0000">{{ $color->color }}</label>
                                        </div>
                                        <span class="colors-count">{{ $color->cantidad ?? '0' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="single-widget size-widget">
                            <h3 class="widget-title">Tamaños</h3>
                            <div class="size-list">
                                @foreach ($tamanos as $item)
                                    <div class="single-size">
                                        <input class="form-check-input checkSize" type="checkbox" id="{{ $item->id }}"
                                            value="S">
                                        <label class="form-check-label" for="1">{{ $item->tamano }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}

                        <div class="single-widget brand-widget">
                            <h3 class="widget-title">Marcas</h3>
                            <div class="brand-list">
                                @foreach ($marcas as $marca)
                                    <div class="single-brand">
                                        <div class="brand-left">
                                            <input class="form-check-input CheckBrand" type="checkbox"
                                                value="{{ $marca->id }}"
                                                @if (request()->has('brands') && in_array($marca->id, explode(',', request('brands')))) checked @endif>
                                            <label class="form-check-label"
                                                for="Renuar">{{ $marca->nombre ?? '' }}</label>
                                        </div>
                                        <span class="brand-count">{{ $marca->prod_count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="product-section-top">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="product-section-top-left">
                                    <button class="sidebar-filter d-block d-lg-none" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                                        aria-controls="offcanvasExample">
                                        Filter <img src="{{ asset('front/assets/images/angle-down.svg') }}"
                                            alt="angle-down" />
                                    </button>
                                    <div class="list-grid-view">
                                        <a href="#" class="view-btn grid-view active"><img class="view-icon"
                                                src="{{ asset('front/assets/images/view-grid.svg') }}"
                                                alt="view-grid" /></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="product-filter">

                                    <select class="form-select sortingFilter productsByCategory">
                                        <option value="stop">Categorias</option>
                                        @foreach ($categorias as $categ)
                                            <option value="{{ $categ->slug }}">
                                                {{ $categ->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="filterProduct">
                        <div class="product-list">
                            <div class="row">
                                @foreach ($producto as $prod)
                                    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                                        <div class="single-grid-product">
                                            <div class="product-top">
                                                <a href="{{ route('products.detalles', $prod->slug) }}"><img
                                                        class="product-thumbnal"
                                                        src="{{ asset('front/assets/images/productos/' . $prod->imagen) }}"
                                                        alt="Colección AMRYLUXE 2025" /></a>

                                                <ul class="prdouct-btn-wrapper">
                                                    <li class="single-product-btn">
                                                        <a href="javascript:void(0)" class="product-btn addToCompare"
                                                            data-id="{{ $prod->id }}"
                                                            title="Agregar para comparar"><i
                                                                class="icon flaticon-bar-chart"></i></a>
                                                    </li>
                                                    <li class="single-product-btn">

                                                        <a href="javascript:void(0)" class="product-btn addToWishList"
                                                            data-id="{{ $prod->id }}"
                                                            title="Agregar a mi lista de deseos"><i
                                                                class="icon flaticon-like"></i></a>

                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-info text-center">
                                                <h4 class="product-catagory">{{ $prod->marca->nombre }} -
                                                    {{ $prod->categoria->nombre }}</h4>
                                                <input type="hidden" name="quantity" value="1"
                                                    id="product_quantity">
                                                <h3 class="product-name"><a class="product-link"
                                                        href="{{ route('products.detalles', $prod->slug) }}">{{ $prod->nombre }}</a>
                                                </h3>
                                                <!-- This is server side code. User can not modify it. -->
                                                <ul class="product-review">
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                                </ul>
                                                <div class="product-price">
                                                    <span class="regular-price">S/. {{ $prod->precio_regular }}</span>
                                                    <span class="price">S/. {{ $prod->precio }}</span>
                                                </div>
                                                <a href="javascript:void(0)" title="Agregar a Carrito de Compras"
                                                    class="add-cart addToCart" data-id="{{ $prod->id }}">
                                                    Agregar a Carrito <i class="icon fas fa-plus-circle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-area mt-30">
                                {{ $producto->links('pagination::bootstrap-4') }}
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
                            $('.totalCountItem').text(response.cart_count);
                            $('.totalAmount').text('S/.' + response.total_price);
                            toastr.success('Producto agregado al carrito', 'Success');
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
                let slug = $(this).val();

                if (slug) {
                    let newUrl = "{{ url('/categoria') }}/" + slug;
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
