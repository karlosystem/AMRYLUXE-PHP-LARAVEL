@extends('front.layouts.app')

@section('title', $producto->meta_title)
@section('description', $producto->meta_description)

@push('meta')
    <meta property="og:title" content="{{ $producto->meta_title ?? $producto->nombre }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('front/assets/images/productos/' . $producto->imagen) }}" />
    <meta property="og:description" content="{{ $producto->meta_description }}" />

    <meta property="og:title" content="{{ $producto->meta_title ?? $producto->nombre }}" />
    {{-- ... tus otros metas ... --}}

    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{ $producto->nombre_seo }}",
      "image": ["{{ asset('front/assets/images/productos/' . $producto->imagen) }}"],
      "description": "{{ Str::limit(strip_tags($producto->meta_description), 160) }}",
      "sku": "AMRY-{{ $producto->codigo }}",
      "brand": {
        "@type": "Brand",
        "name": "AMRY LUXE"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "12"
      },
      "offers": {
        "@type": "Offer",
        "url": "{{ url()->current() }}",
        "priceCurrency": "PEN",
        "price": "{{ $producto->precio }}",
        "priceValidUntil": "{{ date('Y-12-31') }}",
        "itemCondition": "https://schema.org/NewCondition",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "AMRY LUXE"
        }
      }
    }
    </script>

    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Inicio",
            "item": "https://amryluxe.com/"
        },{
            "@type": "ListItem",
            "position": 2,
            "name": "Productos",
            "item": "https://amryluxe.com/productos"
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $producto->nombre }}",
            "item": "{{ url()->current() }}"
        }]
        }
    </script>
@endpush

@section('content')

    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">

            <div class="row align-items-center mb-3">
                <div class="col-md-12">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>

                        {{-- Enlace al Tipo de Categoría --}}
                        <li class="breadcrumb-item">
                            <a href="#">{{ $producto->categoria->tipo->p_cat_name ?? 'Colecciones' }}</a>
                        </li>

                        {{-- Enlace a la Categoría específica --}}
                        <li class="breadcrumb-item">
                            <a href="{{ url('categoria/' . $producto->categoria->slug) }}">
                                {{ $producto->categoria->nombre ?? '' }}
                            </a>
                        </li>

                        <li class="breadcrumb-item active">{{ $producto->nombre ?? '' }}</li>
                    </ol>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        <h1>
                            @if (empty($producto->nombre_seo))
                                {{ $producto->categoria->tipo->p_cat_name ?? '' }} |
                                {{ $producto->categoria->nombre ?? '' }} |
                                {{ $producto->nombre ?? '' }}
                            @else
                                {{ $producto->nombre_seo }}
                            @endif
                        </h1>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="product_img_box">
                            <img id="product_img" src='{{ asset('front/assets/images/productos/' . $producto->imagen) }}'
                                data-zoom-image="{{ asset('front/assets/images/productos/' . $producto->imagen) }}"
                                alt="{{ $producto->nombre ?? '' }}" />
                            <a href="#" class="product_img_zoom" title="Zoom">
                                <span class="linearicons-zoom-in"></span>
                            </a>
                        </div>

                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4"
                            data-slides-to-scroll="1" data-infinite="false">

                            <div class="item">
                                <a href="#" class="product_gallery_item active"
                                    data-image="{{ asset('front/assets/images/productos/' . $producto->imagen) }}"
                                    data-zoom-image="{{ asset('front/assets/images/productos/' . $producto->imagen) }}">
                                    <img src="{{ asset('front/assets/images/productos/' . $producto->imagen) }}"
                                        alt="{{ $producto->nombre }}"
                                        style="width: 150px; height: 160px; object-fit: cover;">
                                </a>
                            </div>

                            @foreach ($producto->imagenes as $item)
                                <div class="item">
                                    <a href="#" class="product_gallery_item"
                                        data-image="{{ asset('front/assets/images/productos/galeria/' . $item->imagen) }}"
                                        data-zoom-image="{{ asset('front/assets/images/productos/galeria/' . $item->imagen) }}">
                                        <img src="{{ asset('front/assets/images/productos/galeria/' . $item->imagen) }}"
                                            alt="Galería Amry Luxe" style="width: 150px; height: 160px; object-fit: cover;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title">{{ trim($producto->nombre) ?? '' }}</h4>

                            <div class="product_price">
                                <span class="price">S/. {{ $producto->precio }}</span>
                                <del>S/. {{ $producto->precio_regular }}</del>
                                @if ($producto->precio_regular > 0 && $producto->precio < $producto->precio_regular)
                                    <div class="on_sale">
                                        @php
                                            $descuento =
                                                (($producto->precio_regular - $producto->precio) /
                                                    $producto->precio_regular) *
                                                100;
                                        @endphp
                                        <span>{{ round($descuento) }}% Descuento</span>
                                    </div>
                                @endif
                            </div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:80%"></div>
                                </div>
                                <span class="rating_num">(código : {{ $producto->codigo ?? '' }})</span>
                            </div>

                            <div class="pr_desc">
                                <p>{{ $producto->detalles ?? '' }}</p>
                            </div>


                            <div class="product_sort_info">
                                <ul>
                                    <li><i class="linearicons-shield-check"></i> Tiempo de entrega :
                                        {{ $producto->delivery_duration ?? '' }}</li>
                                    <li><i class="linearicons-sync"></i> Política de devolución de 30 días</li>
                                    <li><i class="linearicons-bag-dollar"></i> Contra reembolso disponible</li>
                                </ul>
                            </div>
                            {{-- Selector de Color --}}
                            <div class="pr_switch_wrap">
                                <span class="switch_lable">Color:</span>
                                <div class="product_color_switch">
                                    @foreach ($producto->colors as $color)
                                        <label class="color-option">
                                            <input type="radio" name="productColor" class="color-select d-none"
                                                value="{{ $color->color }}">
                                            <span class="color-circle" style="background:{{ $color->color_codigo }};"
                                                title="{{ $color->color }}"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Selector de Tamaño --}}
                            <div class="pr_switch_wrap">
                                <span class="switch_lable">Tamaño:</span>
                                <div class="product_size_switch">
                                    @foreach ($producto->tamanos as $tamano)
                                        <label class="size-option">
                                            <input type="radio" name="productSize" class="size-select d-none"
                                                value="{{ $tamano->tamano }}">
                                            <span class="size-box">{{ $tamano->tamano }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="cart_extra">
                            <div class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="text" name="quantity" value="1" title="Qty" class="qty"
                                        size="4">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>

                            <div class="cart_btn">
                                <a class="btn btn-fill-out text-uppercase addToCart" data-id="{{ $producto->id }}"
                                    href="javascript:void(0)">
                                    <i class="icon-basket-loaded"></i> Agregar a Carrito
                                </a>
                                <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                                <a class="add_wishlist" href="#"><i class="icon-heart"></i></a>
                            </div>

                        </div>
                        <hr />
                        <ul class="product-meta">
                            <li>Marca: {{ $producto->marca->nombre }}</li>
                            <li>Categoria: {{ $producto->categoria->nombre }}</li>
                            <li>Tipo: {{ $producto->categoria->tipo->p_cat_name ?? '' }}</li>
                        </ul>
                        <div class="product_share">
                            <span>Compartir:</span>
                            <ul class="social_icons">
                                {{-- Facebook --}}
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank">
                                        <i class="ion-social-facebook"></i>
                                    </a>
                                </li>
                                {{-- Twitter (X) --}}
                                <li>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($producto->nombre) }}&url={{ urlencode(url()->current()) }}"
                                        target="_blank">
                                        <i class="ion-social-twitter"></i>
                                    </a>
                                </li>
                                {{-- WhatsApp --}}
                                <li>
                                    <a href="https://api.whatsapp.com/send?text=Mira este producto: {{ urlencode($producto->nombre) }} {{ urlencode(url()->current()) }}"
                                        target="_blank">
                                        <i class="ion-social-whatsapp-outline"></i>
                                    </a>
                                </li>
                                {{-- Pinterest (Ideal para productos visuales como carteras) --}}
                                <li>
                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ asset('front/assets/images/productos/' . $producto->imagen) }}&description={{ urlencode($producto->nombre) }}"
                                        target="_blank">
                                        <i class="ion-social-pinterest"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="large_divider clearfix"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description"
                                    role="tab" aria-controls="Description" aria-selected="true">Descripción</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                    href="#Additional-info" role="tab" aria-controls="Additional-info"
                                    aria-selected="false">Información Adicional</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews"
                                    role="tab" aria-controls="Reviews" aria-selected="false">Calificaciones y
                                    comentarios</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="Description" role="tabpanel"
                                aria-labelledby="Description-tab">
                                {!! $producto->descripcion ?? '' !!}
                            </div>
                            <div class="tab-pane fade" id="Additional-info" role="tabpanel"
                                aria-labelledby="Additional-info-tab">
                                {!! $producto->adicional ?? '' !!}
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

                                    @if (auth()->check() && $userHasPurchased)
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
                                                    <strong>{{ $review->user->name ?? 'Usuario Anónimo' }}</strong> -
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="small_divider"></div>
                    <div class="divider"></div>
                    <div class="medium_divider"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="heading_s1">
                        <h3>Colecciones Relacionados</h3>
                    </div>
                    <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-loop="true"
                        data-autoplay="true" data-margin="20"
                        data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        @foreach ($producto_relacionados as $prod)
                            <div class="item">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="{{ route('products.detalles', $prod->slug) }}">
                                            <img src="{{ asset('front/assets/images/productos/' . $prod->imagen) }}"
                                                alt="product_img1">
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
                                                        class="product-btn addToCompare" title="Agregar para comparar">
                                                        <i class="icon-shuffle"></i></a>
                                                </li>

                                                <li><a href="{{ route('products.detalles', $prod->slug) }}"><i
                                                            class="icon-magnifier-add"></i></a></li>

                                                <li>
                                                    <a href="javascript:void(0)" class="product-btn addToWishList"
                                                        data-id="{{ $prod->id }}"
                                                        title="Agregar a mi lista de deseos">
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
                                            <span class="rating_num">({{ $prod->codigo }})</span>
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

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.addToCart').on('click', function(e) {
                e.preventDefault();

                var productoId = $(this).data('id');

                // Captura simplificada de valores seleccionados
                var selectedColor = $('input[name="productColor"]:checked').val();
                var selectedSize = $('input[name="productSize"]:checked').val();

                // Validaciones con Toastr
                if (!selectedColor) {
                    toastr.error('Por favor seleccione un color antes de agregar al carrito', 'Error');
                    return;
                }

                if (!selectedSize) {
                    toastr.error('Por favor seleccione un tamaño antes de agregar al carrito', 'Error');
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
                        toastr.error('Ocurrió un error en la conexión', 'Error');
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

        });
    </script>
@endpush
