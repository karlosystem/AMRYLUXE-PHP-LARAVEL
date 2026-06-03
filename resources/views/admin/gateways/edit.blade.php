@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Editar Forma de Pago | Pasarela de Pagos</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.gateways.edit') }}">Pasarela de
                                        Pagos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="gallery__area bg-style">
                    <div class="gallery__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-one" role="tabpanel">

                                <form method="POST" action="{{ route('admin.gateways.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-vertical__item bg-style">
                                                <h4>Stripe</h4>
                                                <div class="input__group mb-25">
                                                    <label>Public Key</label>
                                                    <input type="text" name="stripe_public_key"
                                                        value="{{ old('stripe_public_key', $gateways['Stripe']->credentials['public_key'] ?? '') }}"
                                                        placeholder="Stripe Public Key"
                                                        class="@error('stripe_public_key') is-invalid @enderror">
                                                    @error('stripe_public_key')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Secret Key</label>
                                                    <input type="text" name="stripe_secret_key"
                                                        value="{{ old('stripe_secret_key', $gateways['Stripe']->credentials['secret_key'] ?? '') }}"
                                                        placeholder="Stripe Secret Key"
                                                        class="@error('stripe_secret_key') is-invalid @enderror">
                                                    @error('stripe_secret_key')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Status</label>
                                                    <select name="stripe_status">
                                                        <option value="1"
                                                            {{ old('stripe_status', $gateways['Stripe']->status) == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('stripe_status', $gateways['Stripe']->status) == 0 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="form-vertical__item bg-style">
                                                <h4>PayPal</h4>
                                                <div class="input__group mb-25">
                                                    <label>Client ID</label>
                                                    <input type="text" name="paypal_client_id"
                                                        value="{{ old('paypal_client_id', $gateways['PayPal']->credentials['client_id'] ?? '') }}"
                                                        placeholder="PayPal Client ID"
                                                        class="@error('paypal_client_id') is-invalid @enderror">
                                                    @error('paypal_client_id')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Client Secret</label>
                                                    <input type="text" name="paypal_client_secret"
                                                        value="{{ old('paypal_client_secret', $gateways['PayPal']->credentials['client_secret'] ?? '') }}"
                                                        placeholder="PayPal Client Secret"
                                                        class="@error('paypal_client_secret') is-invalid @enderror">
                                                    @error('paypal_client_secret')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Status</label>
                                                    <select name="paypal_status">
                                                        <option value="1"
                                                            {{ old('paypal_status', $gateways['PayPal']->status) == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('paypal_status', $gateways['PayPal']->status) == 0 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="form-vertical__item bg-style">
                                                <h4>Razorpay</h4>
                                                <div class="input__group mb-25">
                                                    <label>Key ID</label>
                                                    <input type="text" name="razorpay_key_id"
                                                        value="{{ old('razorpay_key_id', $gateways['Razorpay']->credentials['key_id'] ?? '') }}"
                                                        placeholder="Razorpay Key ID"
                                                        class="@error('razorpay_key_id') is-invalid @enderror">
                                                    @error('razorpay_key_id')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Key Secret</label>
                                                    <input type="text" name="razorpay_key_secret"
                                                        value="{{ old('razorpay_key_secret', $gateways['Razorpay']->credentials['key_secret'] ?? '') }}"
                                                        placeholder="Razorpay Key Secret"
                                                        class="@error('razorpay_key_secret') is-invalid @enderror">
                                                    @error('razorpay_key_secret')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Status</label>
                                                    <select name="razorpay_status">
                                                        <option value="1"
                                                            {{ old('razorpay_status', $gateways['Razorpay']->status) == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('razorpay_status', $gateways['Razorpay']->status) == 0 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="form-vertical__item bg-style">
                                                <h4>SSLCommerz</h4>
                                                <div class="input__group mb-25">
                                                    <label>Store ID</label>
                                                    <input type="text" name="sslcommerz_store_id"
                                                        value="{{ old('sslcommerz_store_id', $gateways['SSLCommerz']->credentials['store_id'] ?? '') }}"
                                                        placeholder="SSLCommerz Store ID"
                                                        class="@error('sslcommerz_store_id') is-invalid @enderror">
                                                    @error('sslcommerz_store_id')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Store Password</label>
                                                    <input type="text" name="sslcommerz_store_password"
                                                        value="{{ old('sslcommerz_store_password', $gateways['SSLCommerz']->credentials['store_password'] ?? '') }}"
                                                        placeholder="Store Password"
                                                        class="@error('sslcommerz_store_password') is-invalid @enderror">
                                                    @error('sslcommerz_store_password')
                                                        <p class="text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input__group mb-25">
                                                    <label>Status</label>
                                                    <select name="sslcommerz_status">
                                                        <option value="1"
                                                            {{ old('sslcommerz_status', $gateways['SSLCommerz']->status) == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('sslcommerz_status', $gateways['SSLCommerz']->status) == 0 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <div class="form-vertical__item bg-style">
                                                <h4>Cash on Delivery</h4>
                                                <div class="input__group mb-25">
                                                    <label>Status</label>
                                                    <select name="cod_status">
                                                        <option value="1"
                                                            {{ old('cod_status', $gateways['COD']->status) == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('cod_status', $gateways['COD']->status) == 0 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input__button text-right">
                                        <button type="submit" class="btn btn-blue">Guardar Cambios</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
