@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <h5 class="text-white">Galería de: {{ $producto->nombre_seo }}</h5>
                <a href="{{ route('admin.productos.index') }}" class="btn btn-sm btn-light">Volver</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.productos.galeria.store', $producto->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="imagenes[]" class="form-control" multiple required>
                        <button class="btn btn-primary" type="submit">Subir Fotos</button>
                    </div>
                </form>

                <hr>

                <div class="card-body">
                    <div class="row" id="galeria-sortable">
                        @foreach ($galeria as $img)
                            <div class="col-md-3 mb-4" data-id="{{ $img->id }}">
                                <div class="card shadow-sm h-100">
                                    <div class="handle p-2 bg-light text-center" title="Arrastrar para reordenar">
                                        <i class="fas fa-grip-horizontal text-muted"></i>
                                    </div>

                                    {{-- Cambia esta línea en tu @foreach --}}
                                    <img src="{{ asset('front/assets/images/productos/galeria/' . $img->imagen) }}"
                                        class="card-img-top bg-light" 
                                        style="height: 180px; object-fit: contain; padding: 10px;">


                                    <div class="card-body p-2 text-center">
                                        <form action="{{ route('admin.productos.galeria.destroy', $img->id) }}"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                                onclick="return confirm('¿Eliminar?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div id="save-msg" class="mt-3 text-success" style="display:none;">
                        <i class="fas fa-check-circle"></i> Orden actualizado correctamente.
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .sortable-ghost {
            opacity: 0.4;
            border: 2px dashed #ea5455;
        }

        .handle {
            cursor: move;
            cursor: -webkit-grabbing;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        const el = document.getElementById('galeria-sortable');
        const sortable = Sortable.create(el, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            handle: '.handle', // Solo se mueve desde el icono de agarre
            onEnd: function() {
                let orden = [];
                // Capturamos todos los IDs en el nuevo orden
                $('#galeria-sortable [data-id]').each(function(index) {
                    orden.push({
                        id: $(this).data('id'),
                        posicion: index + 1
                    });
                });

                // Enviamos el nuevo orden al servidor mediante AJAX
                $.ajax({
                    url: "{{ route('admin.productos.galeria.reordenar') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        orden: orden
                    },
                    success: function(response) {
                        $('#save-msg').fadeIn().delay(2000).fadeOut();
                    }
                });
            }
        });
    </script>
@endpush