    <!-- LOADER -->
    <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- END LOADER -->


    <!-- START HEADER -->
    <header class="header_wrap">
        <div class="top-header d-none d-md-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="header_topbar_info">
                            <div class="header_offer">
                                <span><a href="#">Rastrear mi Pedido</a></span>
                            </div>
                            <div class="download_wrap">
                                <span class="me-3"><a href="{{ route('reclamaciones') }}">Libro de
                                        Reclamaciones</a></span>
                                <ul class="icon_list text-center text-lg-start">
                                    <li><a href="{{ get_configuracion()->facebook }}" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{ get_configuracion()->instagram }}" target="_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li>
                                        <a href="{{ get_configuracion()->tiktok }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" viewBox="0 0 448 512" style="margin-bottom: 2px;">
                                                <path
                                                    d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li><a href="https://youtube.com/" target="_blank"><i
                                                class="fab fa-youtube"></i></a></li>
                                    <li><a href="https://wa.me/51994148453" target="_blank"><i
                                                class="fab fa-whatsapp"></i></a></li>
                                    <li><a href="mailto:ventas@amryluxe.com"><i class="fas fa-envelope"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                            <div class="lng_dropdown">
                                <select name="countries" class="custome_select">
                                    <option value='esp' data-image="{{ asset('front/assets/images/esp.png') }}"
                                        data-title="Español">Español</option>
                                    <option value='eng' data-image="{{ asset('front/assets/images/eng.png') }}"
                                        data-title="English">English</option>
                                </select>
                            </div>
                            <div class="ms-3">
                                {{-- Cambiamos auth::check() por auth()->check() --}}
                                @if (auth()->check())
                                    <span>
                                        <a href="{{ route('user.profile') }}" class="lang">
                                            Hola {{ auth()->user()->name }}
                                        </a>
                                    </span>
                                @else
                                    <span>
                                        <a href="{{ route('login') }}" class="lang">Login | Registro</a>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="middle-header dark_skin">
            <div class="container">
                <div class="nav_block">
                    <a class="navbar-brand" href="{{ route('home.index') }}">
                        <img class="logo_light" src="{{ asset('front/assets/images/logo.png') }}" alt="AmryLuxe" />
                        <img class="logo_dark" src="{{ asset('front/assets/images/logo.png') }}" alt="AmryLuxe" />
                    </a>
                    <div class="contact_phone order-md-last">
                        <i class="linearicons-phone-wave"></i>
                        <span>{{ get_configuracion()->telefono }}</span>
                    </div>
                    <div class="product_search_form">
                        <form action="{{ route('products.index') }}" method="get">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="custom_select">
                                        <select class="first_null">
                                            <option value="">Categorias</option>
                                            @foreach (get_lista_categorias() as $categoria)
                                                <option @if (request()->has('category') && $categoria->id == request('category')) selected @endif
                                                    value="{{ $categoria->id }}">
                                                    {{ $categoria->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="text" value="{{ request('keywords') }}" class="form-control"
                                    id="keywords" name="keywords" placeholder="Buscar Colección" />
                                <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_header light_skin main_menu_uppercase bg_dark border-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                        <div class="categories_wrap">
                            <button type="button" data-bs-toggle="collapse" data-bs-target="#navCatContent"
                                aria-expanded="false" class="categories_btn categories_menu">
                                <span>Colecciones 2026 </span><i class="linearicons-menu"></i>
                            </button>
                            <div id="navCatContent" class="navbar nav collapse">
                                <ul>
                                    <li class="dropdown dropdown-mega-menu">
                                        <a class="dropdown-item nav-link dropdown-toggler" href="#"
                                            data-bs-toggle="dropdown"><i class="flaticon-woman"></i>
                                            <span>Mujer</span></a>
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-7">
                                                    <ul class="d-lg-flex">
                                                        <div class="row w-100">
                                                            @php
                                                                // Dividimos la colección en 2 partes iguales
                                                                $columnas = $menu_damas->chunk(
                                                                    ceil($menu_damas->count() / 2),
                                                                );
                                                            @endphp

                                                            @foreach ($columnas as $columna)
                                                                <li class="mega-menu-col col-lg-6">
                                                                    <ul class="list-unstyled">
                                                                        <li
                                                                            class="dropdown-header fw-bold text-uppercase mb-2">
                                                                            {{ $loop->first ? 'Destacados' : 'Más Colecciones' }}
                                                                        </li>

                                                                        @foreach ($columna as $menudamas)
                                                                            <li>
                                                                                <a class="dropdown-item nav-link nav_item py-1"
                                                                                    href="{{ route('products.byCategory', [$menudamas->tipo?->p_cat_slug ?? 'mujer', $menudamas->slug]) }}">
                                                                                    {{ $menudamas->nombre }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-5">
                                                    <div class="header-banner2">
                                                        <img src="{{ asset('front/assets/images/tipos/' . $menu_dama_imagen->p_cat_image) }}"
                                                            alt="Damas">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="dropdown dropdown-mega-menu">
                                        <a class="dropdown-item nav-link dropdown-toggler" href="#"
                                            data-bs-toggle="dropdown"><i class="flaticon-boss"></i>
                                            <span>Hombre</span></a>
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-7">
                                                    <ul class="d-lg-flex">
                                                        <div class="row w-100">
                                                            @php
                                                                // Dividimos la colección en 2 partes iguales
                                                                $columnas = $menu_hombres->chunk(
                                                                    ceil($menu_hombres->count() / 2),
                                                                );
                                                            @endphp

                                                            @foreach ($columnas as $columna)
                                                                <li class="mega-menu-col col-lg-6">
                                                                    <ul class="list-unstyled">
                                                                        <li
                                                                            class="dropdown-header fw-bold text-uppercase mb-2">
                                                                            {{ $loop->first ? 'Destacados' : 'Más Colecciones' }}
                                                                        </li>

                                                                        @foreach ($columna as $menuhombres)
                                                                            <li>
                                                                                <a class="dropdown-item nav-link nav_item py-1"
                                                                                    {{-- Usamos la ruta amigable pasando el tipo y el slug --}}
                                                                                    href="{{ route('products.byCategory', [$menuhombres->tipo?->p_cat_slug ?? 'hombre', $menuhombres->slug]) }}">
                                                                                    {{ $menuhombres->nombre }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-5">
                                                    <div class="header-banner2">
                                                        <img src="{{ asset('front/assets/images/tipos/' . $menu_hombre_imagen->p_cat_image) }}"
                                                            alt="Damas">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="dropdown dropdown-mega-menu">
                                        <a class="dropdown-item nav-link dropdown-toggler" href="#"
                                            data-bs-toggle="dropdown"><i class="flaticon-friendship"></i>
                                            <span>Niños</span></a>
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-7">
                                                    <ul class="d-lg-flex">
                                                        <div class="row w-100">
                                                            @php
                                                                // Dividimos la colección en 2 partes iguales
                                                                $columnas = $menu_ninos->chunk(
                                                                    ceil($menu_ninos->count() / 2),
                                                                );
                                                            @endphp

                                                            @foreach ($columnas as $columna)
                                                                <li class="mega-menu-col col-lg-6">
                                                                    <ul class="list-unstyled">
                                                                        <li
                                                                            class="dropdown-header fw-bold text-uppercase mb-2">
                                                                            {{ $loop->first ? 'Destacados' : 'Más Colecciones' }}
                                                                        </li>

                                                                        @foreach ($columna as $menuninos)
                                                                            <li>
                                                                                <a class="dropdown-item nav-link nav_item py-1"
                                                                                    {{-- Generamos la ruta amigable: amryluxe.com/ninos/calzado --}}
                                                                                    href="{{ route('products.byCategory', [$menuninos->tipo?->p_cat_slug ?? 'ninos', $menuninos->slug]) }}">
                                                                                    {{ $menuninos->nombre }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-5">
                                                    <div class="header-banner2">
                                                        <img src="{{ asset('front/assets/images/tipos/' . $menu_ninos_imagen->p_cat_image) }}"
                                                            alt="Damas">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="dropdown dropdown-mega-menu">
                                        <a class="dropdown-item nav-link dropdown-toggler" href="#"
                                            data-bs-toggle="dropdown"><i class="flaticon-necklace"></i>
                                            <span>Accesorios</span></a>
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-7">
                                                    <ul class="d-lg-flex">
                                                        <div class="row w-100">
                                                            @php
                                                                // Dividimos la colección en 2 partes iguales
                                                                $columnas = $menu_accesorios->chunk(
                                                                    ceil($menu_accesorios->count() / 2),
                                                                );
                                                            @endphp

                                                            @foreach ($columnas as $columna)
                                                                <li class="mega-menu-col col-lg-6">
                                                                    <ul class="list-unstyled">
                                                                        <li
                                                                            class="dropdown-header fw-bold text-uppercase mb-2">
                                                                            {{ $loop->first ? 'Destacados' : 'Más Colecciones' }}
                                                                        </li>

                                                                        @foreach ($columna as $menuaccesorios)
                                                                            <li>
                                                                                <a class="dropdown-item nav-link nav_item py-1"
                                                                                    {{-- Generamos la ruta amigable: amryluxe.com/accesorios/correas-de-cuero --}}
                                                                                    href="{{ route('products.byCategory', [$menuaccesorios->tipo?->p_cat_slug ?? 'accesorios', $menuaccesorios->slug]) }}">
                                                                                    {{ $menuaccesorios->nombre }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-5">
                                                    <div class="header-banner2">
                                                        <img src="{{ asset('front/assets/images/tipos/' . $menu_accesorios_imagen->p_cat_image) }}"
                                                            alt="Damas">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li><a class="dropdown-item nav-link nav_item"
                                            href="{{ route('liquidacion') }}"><i class="flaticon-jacket"></i>
                                            <span>Liquidación 2026</span></a></li>

                                </ul>
                                <div class="more_categories"><a href="{{ route('products.index') }}">Más
                                        Colecciones</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler side_navbar_toggler" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSidetoggle" aria-expanded="false">
                                <span class="ion-android-menu"></span>
                            </button>
                            <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                                <ul class="navbar-nav">
                                    <li><a class="nav-link nav_item" href="{{ route('home.index') }}">Inicio</a></li>

                                    <li class="dropdown">
                                        <a class="dropdown-toggle nav-link active" href="#"
                                            data-bs-toggle="dropdown">Nosotros</a>
                                        <div class="dropdown-menu">
                                            <ul>
                                                <li><a class="dropdown-item nav-link nav_item"
                                                        href="{{ route('acerca.de') }}">Acerca de</a></li>
                                                <li><a class="dropdown-item nav-link nav_item"
                                                        href="{{ route('historia') }}">Historia</a></li>
                                                <li><a class="dropdown-item nav-link nav_item"
                                                        href="{{ route('tienda') }}">Nuestra Tienda</a></li>
                                                <li><a class="dropdown-item nav-link nav_item"
                                                        href="{{ route('eventos') }}">Eventos</a></li>
                                                <li><a class="dropdown-item nav-link nav_item"
                                                        href="{{ route('clientes') }}">Clientes</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li><a class="nav-link nav_item" href="{{ route('products.index') }}">Colección
                                            2026</a></li>
                                    <li><a class="nav-link nav_item"
                                            href="{{ route('liquidacion') }}">Liquidación</a></li>
                                    <li><a class="nav-link nav_item"
                                            href="{{ route('contactenos') }}">Contáctenos</a></li>
                                </ul>
                            </div>
                            <ul class="navbar-nav attr-nav align-items-center">

                                <li><a href="{{ route('compare.index') }}" class="nav-link"><i
                                            class="linearicons-laptop"></i><span
                                            class="wishlist_count">{{ compareCount() }}</span></a></li>

                                <li><a href="{{ route('wishlist.index') }}" class="nav-link"><i
                                            class="linearicons-heart"></i><span
                                            class="wishlist_count">{{ wishListCount() }}</span></a></li>
                                
                                <div id="cart-wrapper">
                                <li class="dropdown cart_dropdown">
                                    <a class="nav-link cart_trigger"
                                        href="{{ route('cart.index') }}" data-bs-toggle="dropdown">
                                        <i class="linearicons-cart"></i>
                                        <span class="cart_count">{{ count(session('cart', [])) }}</span></a>

                                    <div class="cart_box dropdown-menu dropdown-menu-right">
                                        @if (session()->has('cart') && count(session('cart')) > 0)
                                            <ul class="cart_list">
                                                @foreach (session('cart') as $product_id => $item)
                                                    <li>
                                                        <form action="{{ route('cart.remove') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="producto_id"
                                                                value="{{ $product_id }}">
                                                            <button
                                                                onclick="return confirm('Estas Seguro de Eliminar')"
                                                                type="submit"
                                                                class="btn btn-sm btn-default item_remove">X</button>
                                                        </form>

                                                        <a href="#">
                                                            <img
                                                                src="{{ asset('front/assets/images/productos/' . $item['imagen']) }}">
                                                            {{ $item['nombre'] }}
                                                        </a>
                                                        <span class="cart_quantity"> {{ $item['cantidad'] }} x
                                                            <span class="cart_amount">
                                                                <span class="price_symbole">$</span>
                                                            </span>
                                                            S/.
                                                            {{ number_format(($item['precio'] ?? $item['precio_regular']) * $item['cantidad'], 2) }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="cart_footer">
                                                <p class="cart_total">
                                                    <strong>Subtotal:</strong>
                                                    <span class="cart_price">
                                                        <span class="price_symbole">S/. </span>
                                                    </span>
                                                    <span class="header_cart_total">
                                                        {{ number_format(collect(session('cart', []))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']), 2) }}
                                                    </span>
                                                </p>
                                                <p class="cart_buttons">
                                                    <a href="{{ route('cart.index') }}"
                                                        class="btn btn-fill-line view-cart mb-3">Ver Carrito de
                                                        Compras</a>

                                                    <a href="{{ route('checkout.index') }}"
                                                        class="btn btn-fill-out checkout">Comprar</a>
                                                </p>
                                            </div>
                                        @else
                                        @endif
                                    </div>
                                </li>
                                </div>
                                
                            </ul>
                            <div class="pr_search_icon">
                                <a href="javascript:;" class="nav-link pr_search_trigger"><i
                                        class="linearicons-magnifier"></i></a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END HEADER -->
