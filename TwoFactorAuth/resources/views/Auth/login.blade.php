<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset(path:'css/css.css')}}">

</head>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="row container-central">
            <div class="col-6 container-imagen" >
                <img src="{{ asset('storage/images/utt.jpg') }}" alt="utt" >
            </div>
            <div class="col-6 d-flex flex-column">
                <h2 class="text-center">Iniciar sesión</h2>
                <form action="{{ route('loginForm') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="email" class="form-control"  value="{{ old('email') }}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" >
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        {!! NoCaptcha::renderJs('es', false) !!}
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @error('credenciales')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" id="submitButton" class="btn btn-primary">Iniciar sesión</button>
                    @error('error')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </form>
                <div class="d-flex justify-content-end mt-auto">
                    <div class="col text-center">
                        <a id="link" href="{{ route('register') }}">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload(); // Forzar recarga si viene del caché
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            const submitButton = document.getElementById('submitButton');
            const link = document.getElementById('link');
            
            // Habilitar el botón si la página se carga desde el caché
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    link.style.pointerEvents = 'auto';
                    link.style.opacity = '1';
                    submitButton.disabled = false;
                    submitButton.innerText = 'Iniciar sesión'; // Opcional
                }
            });
        
            submitButton.addEventListener('click', function () {
                submitButton.disabled = true;
                link.style.pointerEvents = 'none';
                link.style.opacity = '0.5';
                submitButton.innerText = 'Enviando...'; // Opcional
                const form = submitButton.closest('form');
                form.submit();
            });
        });

    </script>
</body>
</html> 