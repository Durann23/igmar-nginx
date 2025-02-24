<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset(path:'css/css.css')}}">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <div class="row container-central">
            <div class="col-6 container-imagen" >
                <img src="{{ asset('storage/images/utt.jpg') }}" alt="utt" >
            </div>
            <div class="col-6 d-flex flex-column">
                <h2 class="text-center">Ingrese el código</h2>
                <form action="{{ route('twoFactor') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Codigo</label>
                        <input type="hidden" name="email" value="{{ request('email') }}">
                        <input type="text" name="code"  class="form-control input-uppercase"  value="{{ old('code') }}" pattern="[A-Za-z0-9]+" maxlength="6">
                        @error('code')
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
                    <button id="submitButton" type="submit" class="btn btn-primary">Enviar</button>
                </form>
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
            
            // Habilitar el botón si la página se carga desde el caché
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    submitButton.disabled = false;
                    submitButton.innerText = 'Enviar'; // Opcional
                }
            });
        
            submitButton.addEventListener('click', function () {
                submitButton.disabled = true;
                submitButton.innerText = 'Enviando...'; // Opcional
                const form = submitButton.closest('form');
                form.submit();
            });
        });

    </script>
</body>
</html>