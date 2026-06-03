@extends('front.layouts.app')

@section('title', $producto->meta_title)
@section('description', $producto->meta_description)

@push('meta')
    <meta property="og:title" content="{{ $producto->meta_title ?? $producto->nombre }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('front/assets/images/productos/' . $producto->imagen) }}" />
    <meta property="og:description" content="{{ $producto->meta_description }}" />
@endpush

@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>{{ $producto->nombre?? '' }}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Colecciones</a></li>
                        <li class="breadcrumb-item active">{{ $producto->nombre ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- product-single-area start here  -->
    <div class="product-single-area section-top">
        <div class="container">
            <div class="product-single-details">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-single-left">
                            <div class="product-thumbnail-image">
                                <ul class="product-thumb-silide slider slider-nav">
                                    @foreach ($producto_galeria as $galeria)
                                        <li class="single-item">
                                            <img class="single-item-image"
                                                src="{{ asset('front/assets/images/productos/' . $galeria->imagen) }}" />
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="product-slier-big-image">
                                <div class="product-priview-slide slider slider-for">
                                    {{-- @foreach ($collection as $item) --}}
                                    <div class="single-slide">
                                        <img class="slide-image"
                                            src="{{ asset('front/assets/images/productos/' . $producto->imagen) }}" />
                                    </div>
                                    {{-- @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-single-right">
                            <div class="product-info">
                                <h4 class="product-catagory">{{ $producto->marca->nombre }} -
                                    {{ $producto->categoria->nombre }}</h4>

                                <h3 class="product-name">{{ $producto->nombre ?? '' }}</h3>

                                <ul class="product-review">
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                    <li class="review-item"><i class="flaticon-star"></i></li>
                                </ul>

                                <div class="product-price">
                                    <span class="price">S/. {{ $producto->precio }}</span>
                                    <span class="regular-price">S/. {{ $producto->precio_regular }}</span>
                                </div>

                                <div class="product-color-area">
                                    <div class="variable-single-item color-switch">
                                        <div class="product-variable-color">
                                            @foreach ($producto->colors as $color)
                                                <label>
                                                    <input type="radio" name="productColor" class="color-select"
                                                        value="{{ $color->color }}">
                                                    <input name="productColor" class="color-select" type="radio">
                                                    <span style="background:{{ $color->color_codigo }};"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="product-size-area">
                                    <h4 class="size-title">Tamaños Disponibles</h4>
                                    <ul class="size-switch">
                                        @foreach ($producto->tamanos as $tamano)
                                            <input type="hidden" class="sizeValue" name="productSize" value="1">
                                            <li class="single-size activeSize" data-size="{{ $tamano->tamano }}">
                                                {{ $tamano->tamano }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="prdouct-btn-wrapper d-flex align-items-center">
                                    <div class="cart-plus-minus">
                                        <div class="dec qtybutton btn">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                            id="product_quantity" value="1" readonly />
                                        <div class="inc qtybutton btn">+</div>
                                    </div>
                                    <a class="product-btn MyWishList" data-id="5" title="Agregar a Lista de Deseos"><i
                                            class="icon flaticon-like"></i></a>
                                    <a class="product-btn CompareList" data-id="5" title="Agregar para Comparar"><i
                                            class="icon flaticon-bar-chart"></i></a>
                                </div>
                                <div class="product-bottom-button d-flex">
                                    <a href="javascript:void(0)" class="primary-btn buyNow" data-id="5">Comprar
                                        Ahora</a>

                                    <a href="javascript:void(0)" title="Agregar a Carrito de Compras"
                                        class="add-cart addToCart" data-id="{{ $producto->id }}">Agregar a Carrito de
                                        Compras
                                        <i class="icon fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                            <div class="product-right-bottom">
                                <ul class="features">
                                    <li class="single-feature"><img class="icon"
                                            src="{{ asset('front/assets/images/delivery-van-icon.svg') }}"
                                            alt="icon" /><strong class="feature-title">Tiempo de entrega
                                            estimado:</strong><span
                                            class="feature-text">{{ $producto->delivery_duration ?? '' }}</span></li>
                                    <li class="single-feature"><img class="icon"
                                            src="{{ asset('front/assets/images/shipping-return.svg') }}"
                                            alt="icon" /><strong class="feature-title">Cargo de envío:</strong><span
                                            class="feature-text">S/. 0</span>
                                    </li>
                                </ul>

                                <div class="guarantee-checkout-area">
                                    <h3 class="guarantee-title">Garantia de Pago Seguro</h3>
                                    <img src="{{ asset('front/assets/images/we_accept.webp') }}"
                                        alt="payment-method-image" />
                                </div>

                                <div class="share-area mt-30">
                                    <h3 class="share-title">COMPARTIR:</h3>
                                    <ul class="social-media a2a_kit">
                                        <li class="media-item"><a class="media-link facebook a2a_button_facebook"
                                                href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="media-item"><a class="media-link twitter a2a_button_twitter"
                                                href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                                        <li class="media-item"><a class="media-link linkedin a2a_button_linkedin"
                                                href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li class="media-item"><a class="media-link pinterest a2a_button_pinterest"
                                                href="javascript:void(0)"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-bottom-info mt-50">
                <div class="nav-tabs-menu">
                    <ul class="nav nav-tabs" id="ProductTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                data-bs-target="#Description" type="button" role="tab" aria-controls="Description"
                                aria-selected="true">
                                Descripción</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Additional-Information-tab" data-bs-toggle="tab"
                                data-bs-target="#Additional-Information" type="button" role="tab"
                                aria-controls="Additional-Information" aria-selected="false">
                                Información Adicional</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews"
                                type="button" role="tab" aria-controls="Reviews" aria-selected="false">
                                Calificacion del Producto</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Shipping-Return-tab" data-bs-toggle="tab"
                                data-bs-target="#Shipping-Return" type="button" role="tab"
                                aria-controls="Shipping-Return" aria-selected="false">
                                Shipping &amp; Return</button>
                        </li>

                    </ul>
                </div>

                <div class="tab-content" id="ProductTabContent">

                    <div class="tab-pane fade show active" id="Description" role="tabpanel"
                        aria-labelledby="Description-tab">
                        <div class="product-description">
                            <p class="description-text">
                                {!! $producto->descripcion ?? '' !!}
                            </p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="Additional-Information" role="tabpanel"
                        aria-labelledby="Additional-Information-tab">
                        <p class="additional-information-text">
                            {{ $producto->adicional ?? '' }}
                        </p>
                    </div>

                    <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        <div class="product-reviews">
                            <div class="review-top">
                                <div class="review-top-left">
                                    <span class="review-point">{{ $averageRating }}</span>
                                    <!-- This is server side code. User can not modify it. -->
                                    <ul class="product-review">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li class="review-item active">
                                                <i class="flaticon-star"
                                                    style="color: {{ $i <= $averageRating ? '#FFD700' : '#CCC' }}"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                    <span class="review-count">{{ $producto->reviews->count() }} reviews</span>
                                </div>
                            </div>

                            @if (auth::check() && $userHasPurchased)
                                <div class="review-form">
                                    <div class="col-6">
                                        <form action="{{ route('review.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $producto->id }}">
                                            <input type="hidden" name="order_id" value="{{ $userOrderId }}">

                                            <div class="form-group">
                                                <label for="rating">Rating:</label>
                                                <select name="rating" class="form-control" required>
                                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                                    <option value="4">⭐⭐⭐⭐</option>
                                                    <option value="3">⭐⭐⭐</option>
                                                    <option value="2">⭐⭐</option>
                                                    <option value="1">⭐</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="review">Your Review:</label>
                                                <textarea name="review" class="form-control" rows="4" required></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit Review</button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            <div class="reviews-list mt-5">
                                @if (isset($producto->reviews) && $producto->reviews->count() > 0)
                                    <h3 style="border-bottom:1px dotted #ddd; width:150px;">Customer Reviews</h3>

                                    @foreach ($producto->reviews as $review)
                                        <div class="review">
                                            <strong>{{ $review->user->name }}</strong> -
                                            <small>{{ $review->created_at->format('d M, Y') }}</small>

                                            <p>Rating: {{ $review->rating }} ⭐</p>
                                            <p>Review: {{ $review->review }}</p>
                                        </div>
                                        <hr>
                                    @endforeach
                                @else
                                    <p>No reviews yet. Be the first to review this product!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Shipping-Return" role="tabpanel"
                        aria-labelledby="Shipping-Return-tab">
                        <div class="shipping-return-area">
                            <p class="return-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut
                                blandit risus. Donec mollis nec tellus et rutrum. Orci varius natoque penatibus et
                                magnis dis parturient montes, nascetur ridiculus mus. Ut consequat quam a purus faucibus
                                scelerisque. Mauris ac dui ante. Pellentesque congue porttitor tempus. Donec sodales
                                dapibus urna sed dictum. Duis congue posuere libero, a aliquam est porta quis.</p>
                            <p class="return-text">Donec ullamcorper magna enim, vitae fermentum turpis elementum quis.
                                Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                            <p class="return-text">Curabitur vel sem mi. Proin in lobortis ipsum. Aliquam rutrum tempor
                                ex ac rutrum. Maecenas nunc nulla, placerat at eleifend in, viverra etos sem. Nam
                                sagittis lacus metus, dignissim blandit magna euismod eget. Suspendisse a nisl lacus.
                                Phasellus eget augue tincidunt, sollicitudin lectus sed, convallis desto. Pellentesque
                                vitae dui lacinia, venenatis erat sit amet, fringilla felis. Nullam maximus nisi nec mi
                                facilisis.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- product-single-area end here  -->

    <div class="featured-productss-area section-top pb-100">
        <div class="container">
            <div class="section-header-area">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="sub-title">Productos Similares</h3>
                        <h2 class="section-title">Productos Relacionados</h2>
                    </div>
                    <div class="col-md-6 align-self-end text-md-end">
                        <a href="{{ route('products.index') }}" class="see-btn">Ver Todo</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($producto_relacionados as $prod)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-grid-product">
                            <div class="product-top">
                                <a href="{{ route('products.detalles', $prod->slug) }}"><img class="product-thumbnal"
                                        src="{{ asset('front/assets/images/productos/' . $prod->imagen) }}"
                                        alt="Colección AMRYLUXE 2025" /></a>

                                <ul class="prdouct-btn-wrapper">
                                    <li class="single-product-btn">
                                        <a class="product-btn CompareList" data-id="11"
                                            title="Agregar para Comparar"><i class="icon flaticon-bar-chart"></i></a>
                                    </li>
                                    <li class="single-product-btn">
                                        <a class="product-btn MyWishList" data-id="11"
                                            title="Agregar a Lista de deseos"><i class="icon flaticon-like"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info text-center">
                                <h4 class="product-catagory">{{ $prod->marca->nombre }} -
                                    {{ $prod->categoria->nombre }}</h4>
                                <input type="hidden" name="quantity" value="1" id="product_quantity">
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
                                <a href="javascript:void(0)" title="Agregar al Carrito de Compras"
                                    class="add-cart addToCart" data-id="{{ $prod->id }}">
                                    Agregar a Carrito <i class="icon fas fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
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

                var selectedColor = $('input[name="productColor"]:checked').val();
                var selectedSize = $('.size-switch li.active').data('size');

                if (!selectedColor) {
                    toastr.error('Por favor seleccione un color antes de agregar al carrito', 'Error');
                    return;
                }

                if (!selectedSize) {
                    toastr.error('Por favor seleccione un tamano antes de agregar al carrito', 'Error');
                    return;
                }

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        productoId: productoId,
                        cantidad: 1,
                        color: selectedColor,
                        tamano: selectedSize,
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
        });
    </script>
@endpush
