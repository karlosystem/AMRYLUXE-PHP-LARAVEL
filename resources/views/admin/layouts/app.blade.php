<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | AmryLuxe</title>

    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" type="image/x-icon">

    <link rel="apple-touch-icon" href="{{ asset('admin/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/styles/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/extra.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/cookie-consent.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">
    @stack('styles') {{-- <--- ESTO ES VITAL PARA QUE EL CSS FUNCIONE --}}
</head>

<body>
    @include('admin.layouts.partials.sidebar')

    <div class="main-content">
        @include('admin.layouts.partials.header')

        <div class="page-content-wrap">

            <div class="page-content">
                @yield('content')
            </div>

            @include('admin.layouts.partials.footer')

        </div>
    </div>

<script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/admin/summernote-init.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom/data-table-page.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/image-preview.js') }}"></script>
<script src="{{ asset('admin/assets/js/main.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom.js') }}"></script>
<script src="{{ asset('admin/assets/js/summernote-lite.min.js') }}"></script>

<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>



    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}", 'Exito');
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}", 'Error');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}", 'Validation Error');
            @endforeach
        @endif
    </script>
    @stack('scripts')
</body>

</html>
