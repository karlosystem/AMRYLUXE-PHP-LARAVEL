@extends('front.layouts.app')

@section('title', 'Carrito de Compras')
@section('description', 'zzz')
@section('keywords', 'zzzz')

@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Carrito de Compras</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Comprar</a></li>
                        <li class="breadcrumb-item active">Carrito de Compras</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->


    <!-- START SECTION SHOP -->
    <div class="section">
        @if (session()->has('cart') && count(session('cart')) > 0)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive shop_cart_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Colección</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product-quantity">Cantidad</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('cart') as $product_id => $item)
                                        <tr>
                                            <td class="product-thumbnail"><a href="#">
                                                    <img class="product-thumbnal"
                                                        src="{{ asset('front/assets/images/productos/' . $item['imagen']) }}">
                                                </a></td>
                                            <td class="product-name" data-title="Product">
                                                <a href="#">{{ $item['nombre'] }}</a>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                S/. {{ number_format($item['precio'] ?? $item['precio_regular'], 2) }}
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="quantity">

                                                    <input type="button" value="-" class="minus qty_decrease"
                                                        data-id="{{ $product_id }}">

                                                    <input type="number" name="cart_update[{{ $product_id }}][qty]"
                                                        value="{{ $item['cantidad'] }}" class="qty" min="1">

                                                    <input type="button" value="+" class="plus qty_increase"
                                                        data-id="{{ $product_id }}">

                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                S/.
                                                {{ number_format(($item['precio'] ?? $item['precio_regular']) * $item['cantidad'], 2) }}
                                            </td>
                                            <td class="product-remove" data-title="Remove">
                                                <form action="{{ route('cart.remove') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="producto_id" value="{{ $product_id }}">
                                                    <button onclick="return confirm('Estas Seguro de Eliminar')"
                                                        type="submit" class="btn btn-sm btn-default">X</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="px-0">
                                            <div class="row g-0 align-items-center">

                                                <div class="col-lg-4 col-md-6 mb-3 mb-md-0">

                                                </div>
                                                <div class="col-lg-8 col-md-6  text-start  text-md-end">
                                                    <button class="btn btn-line-fill btn-sm btnActualizarTotal"
                                                        type="submit">
                                                        Actualizar Carrito
                                                    </button>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="medium_divider"></div>
                        <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="border p-3 p-md-4">
                            <div class="heading_s1 mb-3">
                                <h6>Total de Carrito</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">Subtotal</td>
                                            <td class="cart_total_amount">
                                                S/.
                                {{ number_format(collect(session('cart'))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']), 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Costo de Envio</td>
                                            <td class="cart_total_amount">S/. 0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Total</td>
                                            <td class="cart_total_amount">
                                            <strong>
                                                 S/.
                                {{ number_format(collect(session('cart'))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']), 2) }}
                                            </strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="btn btn-fill-out">Proceder a Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="text-center order_complete">
                            <i class="fas fa-check-circle"></i>
                            <div class="heading_s1">
                                <h3>¡Su carrito de compras está vacio!</h3>
                            </div>
                            <p>Tu carrito de compras se encuentra vacío en este momento. Parece que aún no has seleccionado
                                ninguna prenda de nuestras colecciones. ¡No te preocupes! Explora nuestras últimas
                                tendencias y encuentra el estilo que impone glamour.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-fill-out">
                                Continuar Comprando
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- END SECTION SHOP -->

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // incrementar cantidad
            $('.qty_increase').click(function(e) {
                e.preventDefault();
                let productoId = $(this).data('id');
                let qtyInput = $(this).siblings('.qty');
                let currencyQty = parseInt(qtyInput.val());

                $.ajax({
                    url: "{{ route('cart.increase') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        producto_id: productoId
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Producto Incrementado', 'Carrito de Compras');
                            window.location.reload();
                        } else {
                            toastr.error('Producto con Cantidad Invalida', 'Error');
                            window.location.reload();
                        }
                    },
                    error: function() {
                        toastr.error('Ha ocurrido un error', 'Error');
                    }
                });
            });

            $('.qty_decrease').click(function(e) {
                e.preventDefault();
                let productoId = $(this).data('id');
                let qtyInput = $(this).siblings('.qty');
                let currencyQty = parseInt(qtyInput.val());

                $.ajax({
                    url: "{{ route('cart.decrease') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        producto_id: productoId
                    },
                    success: function(response) {
                        if (response.success) {
                            if (currencyQty > 1) {
                                toastr.success('Producto con Cantidad - 1', 'Success');
                                window.location.reload();
                            } else {
                                toastr.error('Producto no puede ser - 1', 'Error');
                                window.location.reload();
                            }
                        } else {
                            toastr.error('Producto con Cantidad Invalida', 'Error');
                        }
                    },
                    error: function() {
                        toastr.error('Ha ocurrido un error', 'Error');
                    }
                });
            });

            $('.btnActualizarTotal').click(function(e) {
                e.preventDefault();

                // Creamos un objeto de datos vacío
                let data = {
                    _token: "{{ csrf_token() }}",
                    cart_update: {}
                };

                // Recorremos todos los inputs de cantidad en la tabla
                $('.qty').each(function() {
                    let productId = $(this).closest('tr').find('.qty_increase').data('id');
                    let quantity = $(this).val();

                    data.cart_update[productId] = {
                        qty: quantity
                    };
                });

                $.ajax({
                    url: "{{ route('cart.update') }}", // Define esta ruta en web.php
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            // Recargamos para que Blade recalcule todos los subtotales y el total final
                            setTimeout(function() {
                                window.location.reload();
                            }, 800);
                        }
                    },
                    error: function() {
                        toastr.error('Error al actualizar el carrito');
                    }
                });
            });

        });
    </script>
@endpush
