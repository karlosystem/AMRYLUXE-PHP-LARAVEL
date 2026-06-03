@extends('front.layouts.app')

@section('title', 'Lista de Deseos')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')

@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Lista de Deseos</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Paginas</a></li>
                        <li class="breadcrumb-item active">Lista de Deseos</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive wishlist_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Acción</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishListProducts as $wishlist)
                                    <tr>
                                        <td></td>
                                        <td class="product-thumbnail">
                                            <a href="#"><img
                                                    src="{{ asset('front/assets/images/productos/' . $wishlist->product->imagen) }}"
                                                    alt="product1"></a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a href="#">{{ $wishlist->product->nombre }}</a>
                                        </td>
                                        <td class="product-price" data-title="Price">

                                            S/. {{ $wishlist->product->precio }}
                                        </td>
                                        <td class="product-stock-status" data-title="Stock Status">
                                            <span class="badge rounded-pill text-bg-success">En Stock</span>
                                        </td>
                                        <td class="product-add-to-cart">
                                  
                                            <a href="javascript:void(0)" title="Agregar al Carrito" data-id="{{ $wishlist->product->id }}"
                                                        class="addToCart btn btn-fill-out">Agregar al Carrito
                                                         <i class="icon-basket-loaded" style="font-size: 2em; vertical-align: middle;"></i>
                                            </a>

                                        </td>
                                        <td class="product-remove" data-title="Remove">
                                    
                                            <button class="delet-btn btn-default deleteWishlist" style="border: 0px" data-id="{{ $wishlist->product->id }}" title="Eliminar Producto">
                                                   x</button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- wish-list area start here  -->
    {{--  <div class="wish-list-area section">
        <div class="container">
            <div class="row">

                <div class="col-12 wish-list-table">
                    <div class="table-responsive">
                        <div id="wishlistTable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Acción</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishListProducts as $wishlist)
                                        <tr>
                                            <td>
                                                <div class="product-image">
                                                    <a href="#" class="image">
                                                        <img class="product-thumbnal" src="{{ asset('front/assets/images/productos/' . $wishlist->product->imagen) }}">
                                                    </a>
                                                    <div class="product-flags">

                                                        <span class="product-flag sale">OFERTA</span>
                                                        <span class="product-flag discount">-10%</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-info text-center">
                                                    <h3 class="product-name">
                                                        <a class="product-link" href="#">{{ $wishlist->product->nombre }}</a>
                                                    </h3>
                                                    <!-- This is server side code. User can not modify it. -->
                                                    <ul class="product-review">
                                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                                        <li class="review-item"><i class="flaticon-star"></i></li>
                                                    </ul>
                                                    <div class="variable-single-item color-switch">
                                                        <div class="product-variable-color">
                                                            <input type="hidden" name="quantity" value="1"
                                                                id="product_quantity">

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-price text-center">
                                                    <span class="regular-price">S/. {{ $wishlist->product->precio_regular }}</span>
                                                    <span class="price">S/. {{ $wishlist->product->precio }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-area">
                                                    <a href="javascript:void(0)" title="Agregar al Carrito" data-id="{{ $wishlist->product->id }}"
                                                        class="addToCart add-cart action-btn addCart">Agregar al Carrito <i
                                                            class="icon fas fa-plus-circle"></i></a>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="delet-btn deleteWishlist" data-id="{{ $wishlist->product->id }}" title="Eliminar Producto">
                                                    <img src="{{ asset('front/assets/images/close.svg') }}"
                                                        alt="close" /></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- wish-list area end here  -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                            toastr.success('Producto agregado al carrito', 'Exito');
                        } else {
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function() {
                        toastr.error('Hay un error, corregir', 'Error');
                    }
                });
            });
        });

        $('.deleteWishlist').on('click', function() {

            var productId = $(this).data('id');

            if (!confirm('Eliminar este producto de la lista de deseos ?')) {
                return;
            }

            $.ajax({
                url: '/wishlist/remove/' + productId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message, 'Éxito');
                        setTimeout(() => location.reload(), 600);
                    } else {
                        toastr.error(response.message, 'Error');
                    }
                },
                error: function(xhr) {
                    toastr.error('Error CSRF o de servidor', 'Error');
                }
            });

        });
    </script>
@endpush
