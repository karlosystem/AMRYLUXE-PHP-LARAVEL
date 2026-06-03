@extends('front.layouts.app')

@section('title', 'Listado de Ordenes de Compra')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')

@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Mis Pedidos</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Mis Pedidos</li>
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

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-active-order-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-active-order" type="button" role="tab"
                                        aria-controls="pills-active-order" aria-selected="true">
                                        Todas las Ordenes
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-delivered-order-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-delivered-order" type="button" role="tab"
                                        aria-controls="pills-delivered-order" aria-selected="false">
                                        Ordenes Entregadas
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-cancelled-order-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-cancelled-order" type="button" role="tab"
                                        aria-controls="pills-cancelled-order" aria-selected="false">
                                        Ordenes Canceladas
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-active-order" role="tabpanel"
                                    aria-labelledby="pills-active-order-tab">
                                    <div class="order-table mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Orden ID</th>
                                                        <th>Payment Estado</th>
                                                        <th>Order Status</th>
                                                        <th>Total Amount</th>
                                                        <th>Fecha</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td>
                                                                <p>Orden No: {{ $order->order_number }}</p>
                                                                <p>Fecha:
                                                                    {{ $order->created_at->format('F d, Y, h:i A') }}</p>
                                                            </td>
                                                            <td>
                                                                {{ ucfirst($order->payment_status) }}
                                                            </td>
                                                            <td>
                                                                {{ ucfirst($order->order_status) }}
                                                            </td>
                                                            <td>
                                                                <span class="amount">S/.
                                                                    {{ number_format($order->total_amount, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                {{ $order->created_at->format('d M Y') }}
                                                            </td>
                                                            <td>
                                                                <a title="Tracking"
                                                                    href="{{ route('order.track', $order->tracking_number) }}">
                                                                    <i class="fas fa-user-cog"></i>
                                                                </a>
                                                                |
                                                                <a title="detalles de orden"
                                                                    href="{{ route('user.order.details', $order->id) }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                |
                                                                <a title="imprimir factura"
                                                                    href="{{ route('order.invoice', $order->id) }}">
                                                                    <i class="fas fa-file-invoice"></i>
                                                                </a>
                                                                |
                                                                 @if ($order->payment_status == 'pending' || $order->payment_status == 'failed')
                                                                    <a title="Pay Now" href="">
                                                                        <i class="fas fa-file-invoice-dollar"></i>
                                                                    </a>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-delivered-order" role="tabpanel"
                                    aria-labelledby="pills-delivered-order-tab">
                                    <div class="order-table mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Payment Status</th>
                                                        <th>Order Status</th>
                                                        <th>Total Amount</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($deliveredOrders as $order)
                                                        <tr>
                                                            <td>
                                                                <p>Order No: {{ $order->order_number }}</p>
                                                                <p>Order Time:
                                                                    {{ $order->created_at->format('F d, Y, h:i A') }}</p>
                                                            </td>
                                                            <td>
                                                                {{ ucfirst($order->payment_status) }}
                                                            </td>
                                                            <td>
                                                                {{ ucfirst($order->order_status) }}
                                                            </td>
                                                            <td>
                                                                <span class="amount">S/.
                                                                    {{ number_format($order->total_amount, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                {{ $order->created_at->format('d M Y') }}
                                                            </td>
                                                            <td>
                                                                <a href="">
                                                                    <i class="fas fa-user-cog"></i>
                                                                </a>
                                                                |
                                                                <a href="{{ route('user.order.details', $order->id) }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                |
                                                                <a href="">
                                                                    <i class="fas fa-file-invoice"></i>
                                                                </a>
                                                                |
                                                                @if ($order->payment_status == 'pending' || $order->payment_status == 'failed')
                                                                    <a title="Pay Now" href="">
                                                                        <i class="fas fa-file-invoice-dollar"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-cancelled-order" role="tabpanel"
                                    aria-labelledby="pills-cancelled-order-tab">
                                    <div class="order-table mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Payment Status</th>
                                                        <th>Order Status</th>
                                                        <th>Total Amount</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($canceladosOrders as $order)
                                                        <tr>
                                                            <td>
                                                                <p>Order No: {{ $order->order_number }}</p>
                                                                <p>Order Time:
                                                                    {{ $order->created_at->format('F d, Y, h:i A') }}</p>
                                                            </td>
                                                            <td>
                                                                {{ ucfirst($order->payment_status) }}
                                                            </td>
                                                            <td>
                                                                {{ ucfirst($order->order_status) }}
                                                            </td>
                                                            <td>
                                                                <span class="amount">S/.
                                                                    {{ number_format($order->total_amount, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                {{ $order->created_at->format('d M Y') }}
                                                            </td>
                                                            <td>
                                                                <a href="">
                                                                    <i class="fas fa-user-cog"></i>
                                                                </a>
                                                                |
                                                                <a href="{{ route('user.order.details', $order->id) }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                |
                                                                <a href="">
                                                                    <i class="fas fa-file-invoice"></i>
                                                                </a>
                                                                |
                                                                @if ($order->payment_status == 'pending' || $order->payment_status == 'failed')
                                                                    <a title="Pay Now" href="">
                                                                        <i class="fas fa-file-invoice-dollar"></i>
                                                                    </a>
                                                                @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
