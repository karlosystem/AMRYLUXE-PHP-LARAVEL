@extends('front.layouts.app')

@section('title', 'Tracking - Listado de Ordenes de Compra')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Tracking</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Tracking</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

    <div class="profile-page-area section">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="section-wrap account-page-sidemenu user-profile-sidebar">
                        <nav class="account-page-menu">
                            <ul>
                                <li class="active"><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i>Mi
                                        Perfil</a></li>
                                <li class=""><a href="{{ route('user.orders') }}"><i class="fas fa-box-open"></i>Mis
                                        Ordenes</a></li>
                                <li class=""><a href="{{ route('user.reviews') }}"><i class="fas fa-user-edit"></i>
                                        Comentarios</a></li>
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
                <div class="col-xl-9 col-lg-8">
                    <div class="user-profile-right-part">
                        <div class="user-profile-content-box my-order-page-box track-my-order-page-box">

                            <div class="d-flex justify-content-between align-items-center text-black mb-5">
                                <h2 class="user-profile-content-title">Tracking de Orden de Compra</h2>
                            </div>

                            <div class="order-progress bg-white">
                                @if ($order->order_status == 'canceled')
                                    <div class="single-progress cancelled">
                                        <span class="text-danger">Order Cancelled</span>
                                    </div>
                                @else
                                    <div
                                        class="single-progress {{ in_array($order->order_status, ['pending', 'processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                        <span>Pending</span>
                                    </div>
                                    <div
                                        class="single-progress {{ in_array($order->order_status, ['processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                        <span>Processing</span>
                                    </div>
                                    <div
                                        class="single-progress {{ in_array($order->order_status, ['shipped', 'delivered']) ? 'active' : '' }}">
                                        <span>Shipped</span>
                                    </div>
                                    <div class="single-progress {{ $order->order_status == 'delivered' ? 'active' : '' }}">
                                        <span>Delivered</span>
                                    </div>
                                @endif
                            </div>

                            <div class="order-table mt-5">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->product_name }}</td>
                                                <td>
                                                    <div class="item-image-list d-flex align-items-center">
                                                        <div class="single-item">
                                                            <img class="order-image"
                                                                src="{{ asset('front/assets/images/productos/' . $item->thumb) }}"
                                                                alt="Product Image">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="amount">${{ $item->price }}</span>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ $item->total }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Subtotal</td>
                                            <td>${{ $order->subtotal_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Tax</td>
                                            <td>${{ $order->tax_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Delivery Charge</td>
                                            <td>${{ $order->shipping_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>Discount (-)</td>
                                            <td>${{ $order->discounted_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><strong>Grand Total</strong></td>
                                            <td><strong>${{ $order->total_amount }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
