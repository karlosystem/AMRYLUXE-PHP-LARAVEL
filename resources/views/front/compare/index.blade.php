@extends('front.layouts.app')

@section('title', 'Comparar Colecciones')
@section('description', 'zzz')
@section('keywords', 'zzzz')

@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Comparar Colecciones</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Comprar</a></li>
                        <li class="breadcrumb-item active">Comparar Colecciones</li>
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
            <div class="col-md-12">
                 @if($comparedProducts->isNotEmpty())
            	<div class="compare_box">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                        <tbody>
                            <tr class="pr_image">
                                <td class="row_title">Imagen de Colección</td>
                                 @foreach ($comparedProducts as $compare)
                                <td class="row_img">
                                    <img src="{{ asset('front/assets/images/productos/' . $compare->product->imagen) }}" alt="Comparar Producto">
                                </td>
                                 @endforeach
                            </tr>
                            <tr class="pr_title">
                                <td class="row_title">Nombre de Colección</td>
                                @foreach ($comparedProducts as $compare)
                                <td class="product_name">
                                    <a href="#">
                                        {{ $compare->product->nombre }}
                                    </a>
                                </td>
                                @endforeach
                            </tr>
                            <tr class="pr_price">
                                <td class="row_title">Precio</td>
                                @foreach ($comparedProducts as $compare)
                                <td class="product_price"><span class="price">S/. {{ $compare->product->precio }}</span></td>
                                @endforeach
                            </tr>
                           
                            <tr class="pr_add_to_cart">
                                <td class="row_title">Agregar al Carrito</td>
                                @foreach ($comparedProducts as $compare)
                                <td class="row_btn">                                  
                                <a href="javascript:void(0)" title="Agregar al Carrito"
                                                    data-id="{{ $compare->product->id }}"
                                                    class="addToCart btn btn-fill-out">
                                                    <i class="icon-basket-loaded"></i> Agregar al Carrito
                                </a>
                                </td>
                                @endforeach
                            </tr>
                            <tr class="description">
                                <td class="row_title">Descripción</td>
                                @foreach ($comparedProducts as $compare)
                                <td class="row_text">
                                    <p>
                                       {!! $compare->product->descripcion !!}
                                    </p>
                                </td>
                                @endforeach
                            </tr>
                                                      
                            <tr class="pr_remove">
                                <td class="row_title"></td>
                                 @foreach ($comparedProducts as $compare)
                                <td class="row_remove">
            

                                     <a href="#" class="bg-transparent border-0 deleteCompareList"
                                                    data-id="{{ $compare->product->id }}" title="Eliminar Producto">
                                                    <span>Eliminar</span>
                                                    <i class="fas fa-times"></i>
                                    

                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                @else
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="text-center order_complete">
                                <i class="fas fa-check-circle"></i>
                                <div class="heading_s1">
                                <h3>¡Su Lista de Deseos está Vacio!</h3>
                                </div>
                                <p>Aún no has seleccionado ninguna colección para tu lista de deseos. Encuentra la inspiración en nuestra tienda y guarda esos complementos perfectos que imponen glamour.</p>
                                <a href="{{ route('home.index') }}" class="btn btn-fill-out">Continuar Comprando</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->


  {{--   <section class="compare-page-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_page table-responsive compare-table">
                        <div id="compareListTable">
                            @if($comparedProducts->isNotEmpty())
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="first-column">Producto</td>

                                        @foreach ($comparedProducts as $compare)
                                            <td class="product-image-title">
                                                <div class="product-top">
                                                    <a href="#" class="image"><img
                                                            src="{{ asset('front/assets/images/productos/' . $compare->product->imagen) }}"
                                                            alt="Comparar Producto"></a>
                                                </div>
                                                <div>
                                                    <h5><a href="/product/single/rosmo-namino-2"
                                                            class="title">{{ $compare->product->nombre }}</a></h5>
                                                </div>
                                            </td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td class="first-column">Descripción</td>
                                        @foreach ($comparedProducts as $compare)
                                            <td class="pro-desc">
                                                <p class="text-start" style="text-align: left">
                                                    {!! $compare->product->descripcion !!}
                                                </p>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Precio</td>
                                        @foreach ($comparedProducts as $compare)
                                            <td class="pro-price">S/. {{ $compare->product->precio }}</td>
                                        @endforeach                                 
                                    <tr>
                                        <td class="first-column">Agregar al Carrito</td>
                                        @foreach ($comparedProducts as $compare)
                                            <td class="pro-addtocart">
                                                <a href="javascript:void(0)" title="Agregar al Carrito"
                                                    data-id="{{ $compare->product->id }}"
                                                    class="addToCart add-cart action-btn addCart primary-btn">Agregar al
                                                    Carrito</a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="first-column">Eliminar</td>

                                        @foreach ($comparedProducts as $compare)
                                            <td class="pro-remove">

                                                <button class="bg-transparent border-0 deleteCompareList"
                                                    data-id="{{ $compare->product->id }}" title="Eliminar Producto"><i
                                                        class="fas fa-times"></i>
                                                </button>

                                            </td>
                                        @endforeach
                                    </tr>
                                    
                                </tbody>
                            </table>
                            @else
                                <p>No hay productos para comparar</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section> --}}


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

        $('.deleteCompareList').on('click', function() {
            
            var productId = $(this).data('id');
            
            if (!confirm('Eliminar este producto de la lista de comparaciones ?')) {
                return;
            }

            $.ajax({
                url: '/compare/remove/' + productId,
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
