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
                            <div class="dataTables_length" id="ContactUsTable_length"><label>Show <select
                                        name="ContactUsTable_length" aria-controls="ContactUsTable" class="">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                            <div id="ContactUsTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                        class="" placeholder="" aria-controls="ContactUsTable"></label></div>
                            <div id="ContactUsTable_processing" class="dataTables_processing" style="display: none;">
                                Processing...</div>
                            <table id="ContactUsTable"
                                class="dataTableHover row-border data-table-filter table-style dataTable no-footer"
                                role="grid" aria-describedby="ContactUsTable_info" style="width: 1196px;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="ContactUsTable" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending" style="width: 39px;">
                                            Item
                                        </th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="ContactUsTable" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending" style="width: 279px;">
                                            Nombre Completo
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="ContactUsTable" rowspan="1"
                                            colspan="1" aria-label="Email: activate to sort column ascending"
                                            style="width: 224px;">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="ContactUsTable" rowspan="1"
                                            colspan="1" aria-label="Contact Number: activate to sort column ascending"
                                            style="width: 185px;">Número de Celular</th>
                                        <th class="sorting" tabindex="0" aria-controls="ContactUsTable" rowspan="1"
                                            colspan="1" aria-label="Message: activate to sort column ascending"
                                            style="width: 205px;">Mensaje</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Action"
                                            style="width: 103px;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $data)
                                        <tr role="row" class="odd">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="sorting_1">{{ $data->nombres }} {{ $data->apellidos }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->telefono }}</td>
                                            <td>{{ $data->mensaje }}</td>
                                            <td>
                                                <div class="action__buttons">
                                                    <a href="#" class="btn-action">
                                                        <form action="{{ route('admin.contacts.destroy', $data->id) }}"
                                                            method="POST" style="display: inline-block;"
                                                            onsubmit="return confirm('Estas seguro de eliminar ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-action"
                                                                style="border: none; background: transparent;">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
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
    </div>
@endsection

@push('scripts')
@endpush
