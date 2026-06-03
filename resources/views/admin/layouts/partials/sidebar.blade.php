    <!-- Sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__close">
            <button class="close-btn">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <div class="sidebar__brand">
            <a href="assets/dashboard">
                <img src="{{ asset('admin/assets/images/logo/footer-logo.png') }}" alt="icon">
            </a>
        </div>
        <ul id="sidebar-menu" class="sidebar__menu">
            <li class="mm-active">
                <a href="dashboard.html">
                    <img src="{{ asset('admin/assets/images/icons/sidebar/dashboard.svg') }}" alt="icon">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-user"></i>
                    <span>Administrador</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Lista de Admin</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="assets/create-admin">
                            <i class="fa fa-circle"></i>
                            <span>Agregar Admin</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="assets/roles">
                            <i class="fa fa-circle"></i>
                            <span>Roles</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-list"></i>
                    <span>Categorias y Marcas</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.categorias.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Categorias</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.marcas.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Marcas</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fab fa-product-hunt"></i>
                    <span>Producto e Inventarios</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.productos.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.suppliers.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Proveedores</span>
                        </a>
                    </li>
                     <li class="">
                        <a href="products.html">
                            <i class="fa fa-circle"></i>
                            <span>Compras</span>
                        </a>
                    </li>
                      <li class="">
                        <a href="products.html">
                            <i class="fa fa-circle"></i>
                            <span>Stocks</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Ordenes de Compra</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.ordenes.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Listado</span>
                            <span class="badge bg-info text-white">1</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('admin.transacciones.index') }}">
                    <i class="fas fa-random"></i>
                    <span>Transacciones</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.reclamaciones.index') }}">
                    <i class="fas fa-percent"></i>
                    <span>Libro de Reclamaciones</span>
                </a>
            </li>
            <li class="">
                <a href="assets/delivery-charge-list">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Delivery Charge</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('admin.coupon.index') }}">
                    <i class="fas fa-code"></i>
                    <span>Coupones</span>
                </a>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-blog"></i>
                    <span>CRM</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.contacts.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Contáctenos</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.subscribers.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Subscripciones</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.clientes.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Lista de Clientes</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-cube"></i>
                    <span>CMS</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.configuracion.edit') }}">
                            <i class="fa fa-circle"></i>
                            <span>Configuración</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.paginas.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Paginas</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.testimonio.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Testimonios</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="languages.html">
                            <i class="fa fa-circle"></i>
                            <span>Languages</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('admin.sliders.index') }}">
                    <i class="fas fa-list-ol"></i>
                    <span>Banners</span>
                </a>
            </li>

             <li class="">
                <a href="{{ route('admin.faq.index') }}">
                    <i class="fas fa-list-ol"></i>
                    <span>F.A.Q.</span>
                </a>
            </li>

            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-cube"></i>
                    <span>SEO Management</span>
                </a>
                <ul>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>About Us</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Cart</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Checkout</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Wishlist</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Compare</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Sign In</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Sign Up</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Forget Password</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="seo-homepage.html">
                            <i class="fa fa-circle"></i>
                            <span>Reset Password</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="">
                <a href="{{ route('admin.gateways.edit') }}">
                    <i class="fa fa-money-bill"></i>
                    <span>Pasarelas de Pago</span>
                </a>
            </li>
            <li class="">
                <a class="has-arrow" href="#">
                    <i class="fas fa-address-book"></i>
                    <span>Vat/Tax & Shipping</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ route('admin.departamentos.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Departamentos</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.provincias.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Provincias</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.distritos.index') }}">
                            <i class="fa fa-circle"></i>
                            <span>Distritos</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Sidebar area end -->