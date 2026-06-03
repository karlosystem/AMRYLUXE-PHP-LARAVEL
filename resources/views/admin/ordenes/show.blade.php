@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2 class="text-white">Detalle de Orden: {{ $order->order_number }}</h2>
                <a href="{{ route('admin.ordenes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>

        <div class="row">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0 text-white">Información de Envío</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $order->shipping_name }}</p>
                        <p><strong>Email:</strong> {{ $order->shipping_email }}</p>
                        <p><strong>Teléfono:</strong> {{ $order->shipping_phone }}</p>
                        <hr>
                        <p><strong>Dirección:</strong> {{ $order->shipping_street_address }}</p>
                        <p><strong>Distrito:</strong> {{ $order->shipping_district }}</p>
                        <p><strong>Provincia/Dpto:</strong> {{ $order->shipping_province }} /
                            {{ $order->shipping_departament }}</p>
                        <hr>
                        <p><strong>Estado del Pedido:</strong>
                            <span class="badge bg-primary">{{ ucfirst($order->order_status) }}</span>
                        </p>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0 text-white"><i class="fas fa-truck-loading me-2"></i>Actualizar Estado de Pedido</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ordenes.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">Estado del Pedido</label>
                                <select name="order_status" id="order_status_select" class="form-select border-2">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                        Pendiente</option>
                                    <option value="processing"
                                        {{ $order->order_status == 'processing' ? 'selected' : '' }}>En Proceso</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                        Enviado (Para despacho)</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>
                                        Entregado</option>
                                    <option value="canceled" {{ $order->order_status == 'canceled' ? 'selected' : '' }}>
                                        Cancelado</option>
                                </select>
                            </div>

                            <div id="tracking_field" class="mb-3"
                                style="display: {{ $order->order_status == 'shipped' ? 'block' : 'none' }};">
                                <label class="form-label fw-bold text-primary">Número de Seguimiento (Tracking)</label>
                                <input type="text" name="tracking_number" class="form-control border-primary"
                                    value="{{ $order->tracking_number }}" placeholder="Ej: OLVA-12345678">
                                <small class="text-muted">Este número ayuda al cliente a rastrear su paquete.</small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold">
                                <i class="fas fa-save me-1"></i> GUARDAR CAMBIOS
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Productos Comprados</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cant.</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                @if ($item->thumb)
                                                    <img src="{{ asset('front/assets/images/productos/' . $item->thumb) }}"
                                                        width="50" class="rounded">
                                                @else
                                                    <img src="{{ asset('admin/assets/images/no-image.png') }}"
                                                        width="50">
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->product_name }}</strong><br>
                                                <small class="text-muted">Color: {{ $item->color }} | Talla:
                                                    {{ $item->size }}</small>
                                            </td>
                                            <td>S/ {{ number_format($item->price, 2) }}</td>
                                            <td>{{ number_format($item->quantity, 0) }}</td>
                                            <td class="text-end font-weight-bold">S/ {{ number_format($item->total, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-end">Subtotal:</th>
                                        <td class="text-end">S/ {{ number_format($order->subtotal_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-end text-success">Descuento
                                            ({{ $order->coupon_code }}):</th>
                                        <td class="text-end text-success">- S/
                                            {{ number_format($order->discounted_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-end fs-5">Total a Pagar:</th>
                                        <td class="text-end fs-5 text-primary"><strong>S/
                                                {{ number_format($order->total_amount, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order_status_select').on('change', function() {
                if ($(this).val() === 'shipped') {
                    $('#tracking_field').slideDown();
                } else {
                    $('#tracking_field').slideUp();
                }
            });
        });
    </script>
@endpush
