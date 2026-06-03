@extends('front.layouts.app')

@section('title', 'Libro de Reclamaciones Virtual | AMRY LUXE S.R.L.')
@section('description', 'Accede al Libro de Reclamaciones Virtual de AMRY LUXE. Registra tus quejas o reclamos conforme
    al Código de Protección y Defensa del Consumidor en Perú.')
@section('keywords', '')

@section('content')
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center mb-3">
                <div class="col-md-12">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Consultas</a></li>
                        <li class="breadcrumb-item active">Libro de Reclamaciones Virtual</li>
                    </ol>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-title">
                        <h1>Libro de Reclamaciones Virtual</h1>
                        <p>
                            De acuerdo a los establecido en el Código de Protección y Defensa del Consumidor <br> AMRY LUXE
                            S.R.L. con R.U.C. 20601596076 y dirección Jirón CAP. Maximiliano Velarde N° 171, Santiago de
                            Surco 15054 cuenta con un Libro de Reclamaciones a su disposición.
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('reclamaciones.store') }}" method="POST">
                    @csrf
                        <div class="section-title">1. Identificación del consumidor reclamante</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Nombres *</label>
                                <input type="text" name="nombres" class="form-control" placeholder="Ingrese su nombre"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellidos *</label>
                                <input type="text" name="apellidos" class="form-control"
                                    placeholder="Ingrese sus apellidos" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="Ingrese su email"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tipo de Documento *</label>
                                <select name="tipo_documento" class="form-select" required>
                                    <option value="">--Seleccione--</option>
                                    <option value="DNI">DNI</option>
                                    <option value="CE">C.E.</option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Número de documento *</label>
                                <input type="text" name="nro_documento" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Celular/Teléfono *</label>
                                <input type="text" name="telefono" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Departamento *</label>
                                <input type="text" name="departamento" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Provincia *</label>
                                <input type="text" name="provincia" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Distrito *</label>
                                <input type="text" name="distrito" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Dirección / Calle / Avenida / Mz / Referencia *</label>
                                <textarea name="calle" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Nombre del padre o madre (en caso sea menor de edad)</label>
                                <input type="text" name="menor_edad" class="form-control">
                            </div>
                        </div>

                        <hr>

                        <div class="section-title">2. Detalle del bien contratado</div>
                        <div class="mb-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bien_contratado" id="producto"
                                    value="Producto" checked>
                                <label class="form-check-label" for="producto">Producto</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bien_contratado" id="servicio"
                                    value="Servicio">
                                <label class="form-check-label" for="servicio">Servicio</label>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Monto reclamado *</label>
                                <input type="text" name="monto" class="form-control" placeholder="0.00" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Descripción del producto/servicio *</label>
                                <input type="text" name="descripcion_producto" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha del problema *</label>
                                <input type="date" name="fecha_problema" class="form-control" required>
                            </div>
                        </div>

                        <hr>

                        <div class="section-title">3. Detalle del reclamo y pedido del consumidor</div>
                        <div class="mb-3 bg-light p-3 rounded">
                            <p class="mb-1"><strong>RECLAMO:</strong> Disconformidad relacionada a los productos o
                                servicios.</p>
                            <p class="mb-2"><strong>QUEJA:</strong> Disconformidad no relacionada a los productos o
                                servicios; o malestar respecto a la atención.</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_reclamo" id="reclamo"
                                    value="Reclamo" checked>
                                <label class="form-check-label" for="reclamo">Reclamo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_reclamo" id="queja"
                                    value="Queja">
                                <label class="form-check-label" for="queja">Queja</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Detalle del problema</label>
                            <textarea name="detalle_problema" class="form-control" rows="4" placeholder="Ingrese el problema"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pedido al Vendedor (AMRYLUXE)</label>
                            <textarea name="pedido_vendedor" class="form-control" rows="4" placeholder="Ingrese el pedido al vendedor"></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-danger btn-enviar text-uppercase">Enviar Datos</button>                            
                        </div>

                    </form>

                </div>

            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <div class="section pb_70">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </div>

@endsection
