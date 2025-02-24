<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <h1>Aprobado?</h1>
    <form method="POST" action="{{ route('exit') }}">
    @csrf
    <button class="btn btn-primary" id="submitButton" type="submit">Cerrar sesión</button>
</form>
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
                    submitButton.innerText = 'Cerrar sesión'; // Opcional
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