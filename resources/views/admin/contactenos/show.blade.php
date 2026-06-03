@extends('admin.layouts.app')


@section('content')
    <div class="container-fluid">
        <div id="table-url" data-url="#"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__content__left">
                        <div class="breadcrumb__title">
                            <h2>Contáctenos</h2>
                        </div>
                    </div>
                    <div class="breadcrumb__content__right">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contáctenos</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">
                    <div class="customers__table">
                        <div id="ContactUsTable_wrapper" class="dataTables_wrapper no-footer">                          
                            <table>
                                <tr>
                                    <td><strong>Nombre: </strong></td>
                                    <td>{{ $contact->nombres }} {{ $contact->apellidos }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email: </strong></td>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Celular: </strong></td>
                                    <td>{{ $contact->telefono }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mensaje: </strong></td>
                                    <td>{{ $contact->mensaje }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
