@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb__content">
                    <div class="breadcrumb__title">
                        <h2>Gestión de Admin</h2>
                    </div>
                    <div class="breadcrumb__button">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-blue">
                            <i class="fa fa-plus-circle"></i> Agregar Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="customers__area bg-style mb-30">
                    <div class="item-title">
                        <h6>Lista de Admin Activos</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="adminTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Creado el</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admin as $user)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" 
                                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->status == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td>
                                        <div class="action__buttons">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action" title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            
                                            {{-- Evitar que el admin se elimine a sí mismo si lo deseas --}}
                                            @if(auth()->id() != $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action"
                                                                style="border: none; background: transparent;">
                                                                <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
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