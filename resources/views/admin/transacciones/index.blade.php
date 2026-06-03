@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__title">
                        <h2>Gestión de Órdenes</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">
                    <div class="item-title">
                        <h6>Lista de Pedidos Recientes</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="ordersTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Orden #</th>
                                    <th>Cliente (Envío)</th>
                                    <th>Total</th>
                                    <th>Método Pago</th>
                                    <th>Estado Pago</th>
                                    <th>Estado Pedido</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes as $order)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">{{ $order->order_number }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $order->shipping_name }}</strong><br>
                                            <small class="text-muted">{{ $order->shipping_email }}</small>
                                        </td>
                                        <td>
                                            <strong>S/ {{ number_format($order->total_amount, 2) }}</strong>
                                        </td>
                                        <td>{{ strtoupper($order->payment_method) }}</td>
                                        <td>
                                            @php
                                                $p_status = [
                                                    'pending' => 'bg-warning',
                                                    'paid' => 'bg-success',
                                                    'failed' => 'bg-danger',
                                                    'refunded' => 'bg-info',
                                                ];
                                            @endphp
                                            <span class="badge {{ $p_status[$order->payment_status] ?? 'bg-secondary' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $o_status = [
                                                    'pending' => 'text-warning',
                                                    'processing' => 'text-primary',
                                                    'shipped' => 'text-info',
                                                    'delivered' => 'text-success',
                                                    'canceled' => 'text-danger',
                                                ];
                                            @endphp
                                            <i
                                                class="fas fa-circle {{ $o_status[$order->order_status] ?? '' }} small me-1"></i>
                                            {{ ucfirst($order->order_status) }}
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="{{ route('admin.ordenes.show', $order->id) }}" class="btn-action"
                                                    title="Ver Detalle">
                                                    <i class="fa-solid fa-eye text-primary"></i>
                                                </a>
                                                <a href="{{ route('admin.ordenes.pdf', $order->id) }}"
                                                    class="btn-action">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <a href="#" class="btn-action" title="Cambiar Estado">
                                                    <i class="fa-solid fa-truck text-info"></i>
                                                </a>
                                            </div>
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
@endsection