<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset(path:'css/css.css')}}">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="row container-central" >
            <div class="col-6 container-imagen">
                <img src="{{ asset('storage/images/utt.jpg') }}" alt="utt">
            </div>
            <div class="col-6 d-flex flex-column h100">
                <h2 class="text-center">Registrarse</h2>
                <form action="{{ route('createAccount') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control"  value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div> <!-- Muestra el mensaje de error si hay uno -->
                        @enderror
                    </div>
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
                        <label class="form-label">Repetir contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" >
                        @error('password_confirmation')
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
                    
                    <button id="submitButton" type="submit" class="btn btn-primary">Iniciar sesión</button>
                </form>
                <div class="d-flex justify-content-end mt-auto">
                    <div class="col text-center">
                        <a id="link" href="{{ route('login') }}">Ya tengo cuenta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submitButton = document.getElementById('submitButton');
            const link = document.getElementById('link');
            
            // Habilitar el botón si la página se carga desde el caché
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    link.style.pointerEvents = 'auto';
                    link.style.opacity = '1';
                    submitButton.disabled = false;
                    submitButton.innerText = 'Registrarse'; // Opcional
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