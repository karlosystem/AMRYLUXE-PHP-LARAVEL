@extends('front.layouts.app')

@section('title', 'Proceder a Pagar')
@section('description', 'zzz')
@section('keywords', 'zzzz')

@section('content')

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Proceder con la Compra</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Comprar</a></li>
                        <li class="breadcrumb-item active">Proceder con la Compra</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    @guest
                        <div class="toggle_info">
                            <span><i class="fas fa-user"></i>¿No eres nuestro cliente?
                                <a href="{{ route('login') }}">
                                    Click aqui crear una cuenta
                                </a>
                            </span>
                        </div>
                    @endguest
                </div>

                <div class="col-lg-6">
                    <div class="toggle_info">
                        <span><i class="fas fa-tag"></i>¿Tienes un cupón de descuento? <a href="#coupon"
                                data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click aquí</a></span>
                    </div>
                    <div class="panel-collapse collapse coupon_form" id="coupon">
                        <div class="panel-body">
                            <p>Si tiene un código de cupón, aplíquelo a continuación.</p>

                            <form id="applyCouponForm">
                                @csrf
                                <div class="coupon field_form input-group">
                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                        placeholder="Ingrese su cupón de descuento" required />
                                    <div class="input-group-append">
                                        <button class="btn btn-fill-out btn-sm" id="cuponBtn" type="submit">Aplicar
                                            Cupón</button>
                                    </div>
                                </div>
                                <p id="couponMessage"></p>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="heading_s1">
                        <h4>Datos de Facturación o quién realiza la compra</h4>
                    </div>
                    <form method="post" action="{{ route('order.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                placeholder="Ingrese el nombre completo *" required />
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" id="shipping_email" name="shipping_email"
                                placeholder="Ingrese el correo del quien recibe *" required />
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="shipping_phone" name="shipping_phone"
                                placeholder="Ingrese el Numero de Celular *" required />
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="shipping_street_address"
                                name="shipping_street_address" placeholder="Ingrese la dirección a Enviar *" required />
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom_select">
                                <select class="form-select" id="shipping_departament" name="shipping_departament" required>
                                    <option>Departamento</option>
                                    @foreach ($departamentos as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom_select">
                                <select class="form-select" id="shipping_provincia" name="shipping_provincia" required>
                                    <option>Provincia</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom_select">
                                <select class="form-select" id="shipping_distrito" required name="shipping_distrito">
                                    <option>Distritos</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="shipping_zipcode" name="shipping_zipcode"
                                placeholder="Codigo Postal *" required />
                        </div>

                        <div class="ship_detail">
                            <div class="form-group mb-3">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="copy_address">
                                        <label class="form-check-label label_info" for="copy_address">
                                            <span>
                                                ¿Enviar a una dirección diferente?
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none" id="billingForm">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" id="billing_name" name="billing_name"
                                        placeholder="Ingrese el nombre completo" />
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" id="billing_email" name="billing_email"
                                        placeholder="Ingrese su Email" />
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" id="billing_phone" name="billing_phone"
                                        placeholder="Ingrese el Numero de Celular" />
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" id="billing_street_address"
                                        name="billing_street_address" placeholder="Ingrese su Dirección" />
                                </div>

                                <div class="form-group mb-3">
                                    <select class="form-select" id="billing_departament" name="billing_departament">
                                        <option>Departamento</option>
                                        @foreach ($departamentos as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <select class="form-select" id="billing_provincia" name="billing_provincia">
                                        <option>Provincia</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <select class="form-select" id="billing_distrito" name="billing_distrito">
                                        <option>Distritos</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" id="billing_zipcode"
                                        name="billing_zipcode" placeholder="Codigo Postal" />
                                </div>

                            </div>

                        </div>

                        <input type="hidden" id="costo_envio" value="0">
                        <input type="hidden" id="descuento" value="0">
                        <input type="hidden" id="subtotal" value="{{ collect(session('cart'))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']) }}">

                    </form>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="heading_s1">
                            <h4>Su Pedido</h4>
                        </div>
                        <div class="table-responsive order_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Colección</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('cart') as $product_id => $item)
                                        <tr>
                                            <td>{{ $item['nombre'] }}
                                                <span class="product-qty">x {{ $item['cantidad'] }}</span>
                                            </td>
                                            <td>S/.
                                                {{ number_format(($item['precio'] ?? $item['precio_regular']) * $item['cantidad'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SubTotal</th>
                                        <td class="product-subtotal">
                                            S/.
                                            {{ number_format(collect(session('cart'))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']), 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Costo de Envio</th>
                                        <td>S/.</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td class="product-subtotal">
                                            S/.
                                            {{ number_format(collect(session('cart'))->sum(fn($item) => ($item['precio'] ?? $item['precio_regular']) * $item['cantidad']), 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                            <div class="heading_s1">
                                <h4>Metodos de Pago</h4>
                            </div>
                            <div class="payment_option">
                                @if($gateways['INTERBANK']->status == 1)
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option"
                                        id="interbank" value="interbank" checked="">
                                    <label class="form-check-label" for="interbank">Banco InterBank</label>
                                    <p data-method="interbank" class="payment-text">
                                        <b>Detalles de las cuentas bancarias:</b> <br>
                                        Nombre de Banco: <b>InterBank</b>
                                        <br>
                                        Número de Cuenta en soles (S/.): <b>122 3120146353</b>
                                        <br>
                                        Titular de la Cuenta: <b>IRMA HUAMANCHARI C</b>
                                        <br>
                                        Número de Cuenta InterBancaria (CCI):
                                        <b>00312201312014635399</b>
                                    </p>
                                </div>
                                @endif
                               
                                @if($gateways['BCP']->status == 1)
                                <div class="custome-radio">
                                    <input class="form-check-input" type="radio" name="payment_option"
                                        id="BCP" value="bcp">
                                    <label class="form-check-label" for="BCP">Banco de Crédito del Perú |
                                        BCP</label>
                                    <p data-method="bcp" class="payment-text">
                                        <b>Detalles de las cuentas bancarias:</b> <br>
                                        Nombre de Banco: <b>Banco de Crédito del Perú</b>
                                        <br>
                                        Número de Cuenta en soles (S/.): <b>19322161756011</b>
                                        <br>
                                        Titular de la Cuenta: <b>IRMA HUAMANCHARI C</b>
                                        <br>
                                        Número de Cuenta InterBancaria (CCI):
                                        <b>00219312216175601116</b>
                                    </p>
                                </div>
                                @endif

                                @if($gateways['YAPE/PLIN']->status == 1)
                                <div class="custome-radio">
                                    <input class="form-check-input" type="radio" name="payment_option"
                                        id="YAPE/PLIN" value="YAPE/PLIN">
                                    <label class="form-check-label" for="YAPE/PLIN">Pago con billetera digital : YAPE
                                        / PLIN</label>
                                    <p data-method="YAPE/PLIN" class="payment-text">
                                        YAPE / PLIN (soles): <br>
                                        Número de celular: <b>+51 994 148 453</b>
                                        <br>
                                        Titular de la Cuenta: <b>IRMA HUAMANCHARI C</b>
                                    </p>
                                </div>
                                @endif

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="agree"
                                        required>
                                    <label class="form-check-label label_info" for="differentaddress">
                                        <span>Acepto los Terminos &amp; Condiciones</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-fill-out btn-block">INICIAR SESION</a>
                        @else
                            <a href="#" class="btn btn-fill-out btn-block">PROCEDER CON EL PEDIDO</a>
                        @endguest
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // 🔹 Inicializar valores por defecto
            initSummary();

            function initSummary() {
                let subtotal = parseFloat($('#subtotal').val());

                $('#tax-costo-envio').text('S/. 0.00');
                $('#tax-cupon').text('S/. 0.00');
                $('#total-pagar').text('S/. ' + subtotal.toFixed(2));
            }

            $('#copy_address').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#billingForm').removeClass('d-none');
                } else {
                    $('#billingForm').addClass('d-none');
                }
            });

            $('#shipping_departament, #billing_departament').on('change', function() {

                let departmentId = $(this).val();
                let provinceSelect = $('#shipping_provincia');
                let provinceSelectBilling = $('#billing_provincia');

                // Reset provincias de shipping and billing
                provinceSelect.html('<option value="">Provincia</option>');
                provinceSelectBilling.html('<option value="">Provincia</option>');

                if (departmentId === '' || departmentId === 'Departamento') {
                    return;
                }

                $.ajax({
                    url: '/get-states/' + departmentId,
                    type: 'GET',
                    success: function(response) {
                        if (response.states.length > 0) {
                            $.each(response.states, function(index, province) {
                                provinceSelect.append(
                                    `<option value="${province.id}">${province.name}</option>`
                                );
                            });

                            $.each(response.states, function(index, province) {
                                provinceSelectBilling.append(
                                    `<option value="${province.id}">${province.name}</option>`
                                );
                            });
                        }
                    },
                    error: function() {
                        alert('Error al cargar provincias');
                    }
                });

                // COSTO DE ENVÍO
                $.get('/get-department-tax/' + departmentId, function(response) {

                    let envio = parseFloat(response.costo_envio || 0);

                    $('#costo_envio').val(envio);
                    $('#tax-costo-envio').text('S/. ' + envio.toFixed(2));

                    calculateTotal(); // ✅ ahora sí
                });

            });

            $('#shipping_provincia, billing_provincia').on('change', function() {
                let provinceId = $(this).val();
                $('#shipping_distrito, billing_distrito').prop('disabled', true).html(
                    '<option>Distrito</option>');
                if (!provinceId) return;

                $.get('/get-districts/' + provinceId, function(data) {
                    $('#shipping_distrito').prop('disabled', false);
                    $('#billing_distrito').prop('disabled', false);

                    $.each(data, function(i, item) {
                        $('#shipping_distrito').append(
                            `<option value="${item.id}">${item.name}</option>`
                        );
                        $('#billing_distrito').append(
                            `<option value="${item.id}">${item.name}</option>`
                        );
                    });
                });

            });


            function calculateTotal() {
                let subtotal = parseFloat($('#subtotal').val());
                let envio = parseFloat($('#costo_envio').val());
                let descuento = parseFloat($('#descuento').val());

                let total = subtotal + envio - descuento;

                $('#total-pagar').text('S/. ' + total.toFixed(2));
            }

            function resetTotal() {
                let subtotal = parseFloat($('#subtotal').val());
                $('#costo_envio').val(0);
                $('#tax-costo-envio').text('S/. 0.00');
                $('#total-pagar').text('S/. ' + subtotal.toFixed(2));
            }

            $('#applyCouponForm').on('submit', function(e) {
                e.preventDefault();
                let couponCode = $('input[name="coupon_code"]').val();
                $.ajax({
                    url: '/coupon/apply',
                    type: 'POST',
                    data: {
                        coupon_code: couponCode,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {

                        if (!res.success) {
                            $('#couponMessage').text(res.message).css('color', 'red');
                            return;
                        }

                        let discount = parseFloat(res.discount);

                        $('#descuento').val(discount);
                        $('#tax-cupon').text('- S/. ' + discount.toFixed(2));
                        $('#couponMessage').text(res.message).css('color', 'green');

                        $('#coupon_code').prop('readonly', true);
                        $('#cuponBtn').prop('readonly', true);

                        calculateTotal();
                    },
                    error: function() {
                        $('#couponMessage').text('Error al aplicar cupón').css('color', 'red');
                    }
                });
            });

            $('input[name="payment"]').on('change', function() {

                let method = $(this).val();
                let $target = $('#payment-' + method);

                // Ocultar todos con animación
                $('.card-infor-box').not($target).slideUp(200, function() {
                    $(this).addClass('d-none');
                });

                // Mostrar el seleccionado
                if ($target.hasClass('d-none')) {
                    $target
                        .removeClass('d-none')
                        .hide()
                        .slideDown(250);
                }

            });

        });
    </script>
@endpush
