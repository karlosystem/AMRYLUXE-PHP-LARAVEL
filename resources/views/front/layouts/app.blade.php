<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="author" content="Carlos Marquina" />
    @stack('meta')
    <!-- SITE TITLE -->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Favicon Icon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/bootstrap/css/bootstrap.min.css') }}">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/simple-line-icons.css') }}">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="{{ asset('front/assets/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/owlcarousel/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/owlcarousel/css/owl.theme.default.min.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/slick-theme.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('front/assets/css/toastr.min.css') }}">

    <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "AMRY LUXE",
    "alternateName": "AMRY LUXE | Cueros",
    "url": "https://amryluxe.com/",
    "logo": "https://amryluxe.com/front/assets/images/logo.png",
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+51-994-148-453",
        "contactType": "customer service",
        "areaServed": "PE",
        "availableLanguage": "Spanish"
    },
    "sameAs": [
        "https://www.facebook.com/AmryLuxePeru",
        "https://www.instagram.com/amryluxe/",
        "https://www.tiktok.com/@amryluxe"
    ]
    }
    </script>

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-582H3BZ33S"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-582H3BZ33S');
    </script>
</head>
<body>
    @include('front.layouts.partials.header')

    <div class="maincontent">
        @yield('content')
    </div>

    @include('front.layouts.partials.footer')

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

    <a href="https://wa.me/51994148453?text=Hola%20Amry%20Luxe,%20deseo%20información" class="whatsapp-float"
        target="_blank" rel="noopener noreferrer">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp"
            class="whatsapp-icon">
    </a>

</body>

</html>
