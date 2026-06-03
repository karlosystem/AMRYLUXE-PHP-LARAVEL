@extends('front.layouts.app')

@section('title', 'Detalles de Listado de Ordenes de Compra')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Detalles de Pedido</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Detalles de Pedido</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->


    <div class="profile-page-area section">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-4">
                    <div class="section-wrap account-page-sidemenu user-profile-sidebar">
                        <nav class="account-page-menu">
                            <ul>
                                <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                                    <a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Mi Perfil</a>
                                </li>
                                <li class="{{ request()->routeIs('user.orders') ? 'active' : '' }}">
                                    <a href="{{ route('user.orders') }}"><i class="fas fa-box-open"></i> Mis Ordenes</a>
                                </li>
                                <li class="{{ request()->routeIs('user.reviews') ? 'active' : '' }}">
                                    <a href="{{ route('user.reviews') }}"><i class="fas fa-user-edit"></i>
                                        Comentarios</a>
                                </li>
                                <li>
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-user-edit"></i>Salir
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-xl-10 col-lg-8">
                    <div class="user-profile-right-part">
                        <div class="user-profile-content-box my-order-page-box">
                            <h2>Order Details (Order No: {{ $order->order_number }})</h2>
                            <div class="order-info">
                                <h4>Order Time: {{ $order->created_at->format('F d, Y, h:i A') }}</h4>
                                <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                                <p><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</p>
                                <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Shipping Details</h4>
                                    <ul>
                                        <li><strong>Name:</strong> {{ $order->shipping_name }}</li>
                                        <li><strong>Email:</strong> {{ $order->shipping_email }}</li>
                                        <li><strong>Address:</strong> {{ $order->shipping_street_address }}</li>
                                        <li><strong>State:</strong> {{ $order->shipping_state }}</li>
                                        <li><strong>Zipcode:</strong> {{ $order->shipping_zipcode }}</li>
                                        <li><strong>Country:</strong> {{ $order->shipping_country }}</li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <h4>Billing Details</h4>
                                    <ul>
                                        <li><strong>Name:</strong> {{ $order->billing_name }}</li>
                                        <li><strong>Email:</strong> {{ $order->billing_email }}</li>
                                        <li><strong>Address:</strong> {{ $order->billing_street_address }}</li>
                                        <li><strong>State:</strong> {{ $order->billing_state }}</li>
                                        <li><strong>Zipcode:</strong> {{ $order->billing_zipcode }}</li>
                                        <li><strong>Country:</strong> {{ $order->billing_country }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-5">
                                <h4>Order Items</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ $item->color ?? 'N/A' }}</td>
                                                    <td>{{ $item->size ?? 'N/A' }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>${{ number_format($item->total, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h4>Additional Info</h4>
                                <p><strong>Shipping Method:</strong> {{ $order->shipping_method }}</p>
                                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                                <p><strong>Order Notes:</strong> {{ $order->order_notes ?? 'N/A' }}</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
