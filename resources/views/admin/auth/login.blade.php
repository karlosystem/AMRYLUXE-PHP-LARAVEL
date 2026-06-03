<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo | Amry Luxe</title>

    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-dark: #1a1a1a;
            --accent-gold: #c5a059; /* Dorado elegante para cuero */
            --bg-soft: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-soft);
            height: 100vh;
            display: flex;
            align-items: center;
            margin: 0;
        }

        /* Fondo con textura sutil o imagen de cuero desenfocada */
        .main-content__area {
            width: 100%;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1547949003-9792a18a2601?q=80&w=2070&auto=format&fit=crop'); 
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .authentication__item {
            background: rgba(255, 255, 255, 0.98);
            padding: 50px 40px;
            border-radius: 4px; /* Bordes menos redondeados = más serio/lujoso */
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            border-top: 5px solid var(--accent-gold);
        }

        .authentication__item_logo img {
            max-width: 200px;
            margin-bottom: 30px;
            filter: grayscale(1); /* Logo en negro para elegancia */
        }

        h2 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-dark);
            font-size: 28px;
            letter-spacing: 1px;
            margin-bottom: 35px;
            text-transform: uppercase;
        }

        label {
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 8px;
            display: block;
        }

        .input-overlay {
            position: relative;
            margin-bottom: 20px;
        }

        .input-overlay input {
            width: 100%;
            height: 55px;
            border: 1px solid #ddd;
            background: #fff;
            padding-left: 45px !important;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .input-overlay input:focus {
            border-color: var(--accent-gold);
            outline: none;
            box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.1);
        }

        .input-overlay .overlay {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.6;
        }

        .password-visibility {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
        }

        /* Botón estilo Boutique */
        .btn-luxe {
            background-color: var(--primary-dark);
            color: white;
            width: 100%;
            height: 55px;
            border: none;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 2px;
            transition: all 0.4s;
            margin-top: 10px;
        }

        .btn-luxe:hover {
            background-color: var(--accent-gold);
            color: white;
            transform: translateY(-2px);
        }

        .footer-text {
            margin-top: 25px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="main-content__area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7"> <div class="authentication__item text-center">

                        <div class="authentication__item_logo">
                            <a href="/">
                                <img src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="AMRY LUXE">
                            </a>
                        </div>

                        <div class="authentication__item_title">
                            <h2>Panel de Control</h2>
                        </div>

                        <div class="authentication__item_content text-start">
                            <form action="{{ route('admin.login') }}" method="post">
                                @csrf
                                <div class="input__group">
                                    <label>Correo Electrónico</label>
                                    <div class="input-overlay">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="admin@amryluxe.com" required>
                                        <div class="overlay">
                                            <img src="{{ asset('admin/assets/images/mail.svg') }}" width="18">
                                        </div>
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="input__group">
                                    <label>Contraseña</label>
                                    <div class="input-overlay">
                                        <input type="password" name="password" id="pass" placeholder="••••••••" required>
                                        <div class="overlay">
                                            <img src="{{ asset('admin/assets/images/lock.svg') }}" width="18">
                                        </div>
                                        <div class="password-visibility">
                                            <img src="{{ asset('admin/assets/images/eye.svg') }}" width="18">
                                        </div>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-luxe">Iniciar Sesión</button>
                            </form>
                        </div>

                        <p class="footer-text">&copy; {{ date('Y') }} AMRY LUXE. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.password-visibility').on('click', function() {
                let input = $('#pass');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });
        });
    </script>

</body>
</html>