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
                        <li class="breadcrumb-item"><a href="#">Paginas</a></li>
                        <li class="breadcrumb-item active">{{ $data->titulo ?? '' }}</li>
                    </ol>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        <h1>{{ $data->titulo ?? '' }}</h1>
                        <p>{{ $data->descripcion ?? '' }}</p>
                    </div>
                </div>               
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- STAT SECTION ABOUT -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm">
                                            <option value="order">Default sorting</option>
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:;" class="shorting_icon grid"><i class="ti-view-grid"></i></a>
                                        <a href="javascript:;" class="shorting_icon list active"><i
                                                class="ti-layout-list-thumb"></i></a>
                                    </div>
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm">
                                            <option value="">Showing</option>
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
                        @foreach ($liquidacion as $item)
                            <div class="col-lg-3 col-md-4 col-6">
                                 <div class="product">
                                    <span class="pr_flash">Liquidación</span>
                                    <div class="product_img">
                                        <a href="{{ route('products.detalles', $item->slug) }}">
                                            <img src="{{ asset('front/assets/images/productos/' . $item->imagen) }}"
                                                alt="{{ $item->nombre }}">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li class="add-to-cart">
                                                    <a class="add-cart addToCart" data-id="{{ $item->id }}"
                                                        href="javascript:void(0)" title="Agregar a Carrito de Compras">
                                                        <i class="icon-basket-loaded"></i> Agregar a Carrito
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" data-id="{{ $item->id }}"
                                                        class="popup-ajax product-btn addToCompare"
                                                        title="Agregar para comparar">
                                                        <i class="icon-shuffle"></i></a>
                                                </li>

                                                <li><a href="{{ route('products.detalles', $item->slug) }}"><i
                                                            class="icon-magnifier-add"></i></a></li>

                                                <li>
                                                    <a href="javascript:void(0)" class="product-btn addToWishList"
                                                        data-id="{{ $item->id }}" title="Agregar a mi lista de deseos">
                                                        <i class="icon-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title">
                                            <a href="{{ route('products.detalles', $item->slug) }}">
                                                {{ $item->nombre }}</a>
                                        </h6>
                                        <div class="product_price">
                                            <span class="price">S/. {{ $item->precio }}</span>
                                            <del>S/.{{ $item->precio_regular }}</del>

                                            @if ($item->precio_regular > 0 && $item->precio < $item->precio_regular)
                                                <div class="on_sale">
                                                    @php
                                                        $descuento =
                                                            (($item->precio_regular - $item->precio) /
                                                                $item->precio_regular) *
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
                                            <span class="rating_num">({{$item->codigo}})</span>
                                        </div>
                                        <div class="pr_desc">
                                            {!! $item->descripcion  !!}
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
                            toastr.success('Producto agregado al carrito', 'Carrito de Compras');
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
@endpush