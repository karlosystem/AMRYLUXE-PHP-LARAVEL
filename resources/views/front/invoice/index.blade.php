@extends('front.layouts.app')

@section('title', 'Invoice - Listado de Ordenes de Compra')
@section('description', 'Mi descripcion')
@section('keywords', 'Mis Palabras Claves')

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Impresión de Factura</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Impresión de Factura</li>
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
                <div class="col-xl-10 col-lg-8 d-print-none">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h3>Invoice</h3>
                        <div>
                            <button class="btn btn-info" onclick="printInvoice()" style="min-width: 100px !important;">
                                <i class="fas fa-print"></i> Print Invoice
                            </button>
                        </div>
                    </div>

                    <div id="invoiceSection">
                        <div class="card card-lg">
                            <div class="card-body">
                                <div class="row">
                                    <div class="logo">
                                        <img src="{{ asset('front/assets/images/' . get_configuracion()->logo) }}">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="pt-2 col-md-6">
                                        <strong><i>Sold To: </i></strong>
                                        <p class="h3">{{ auth()->user()->name ?? '' }}</p>
                                        <address>
                                            {{ auth()->user()->name ?? '' }} <br>
                                            {{ auth()->user()->email ?? '' }} <br>
                                            {{ auth()->user()->phone ?? '' }} <br>
                                            {{ auth()->user()->address ?? '' }}
                                        </address>
                                    </div>

                                    <div class="pt-2 col-md-6">
                                        <strong><i>Sold From: </i></strong>
                                        <p class="h3">{{ get_configuracion()->nombre_web }}</p>
                                        <address>
                                            <br>
                                            {{ get_configuracion()->telefono }}<br>
                                            {{ get_configuracion()->direccion }}<br>
                                        </address>
                                    </div>
                                </div>
                                <hr class="mt-3">

                                <div class="row">
                                    <div class="col-6 p-0">
                                        <h3>Invoice: #629808</h3>
                                        <ul>
                                            <li>Invoice Date: {{ $order->created_at->format('d M, Y') }}</li>
                                        </ul>
                                    </div>

                                    <div class="col-6 text-right">
                                        <h3>Payment Info</h3>
                                        <ul>
                                            <li>Order Status : {{ $order->order_status }}</li>
                                            <li>Payment Method: {{ $order->payment_method }}</li>
                                            <li>Payment Status: {{ $order->payment_status }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="table-responsive mt-5">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Title</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th class="text-right" colspan="2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td><span class="amount">${{ $item->price }}</span></td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td class="text-right" colspan="2">${{ $item->total }}</td>
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
                                <p class="text-secondary text-center mt-5">
                                    Thank you very much for doing shopping with us. We look forward to working with you
                                    again!
                                </p>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function printInvoice() {
            var printContents = $("#invoiceSection").html();
            var originalContents = $("body").html();

            $("body").html(printContents);
            window.print();
            $("body").html(originalContents);
            location.reload();
        }
    </script>
@endpush