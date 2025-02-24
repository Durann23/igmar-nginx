<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación de la cuenta</title>
    <style>
        .contenedor {
            margin: auto;
            width: 95%;
            text-align: center;
        }

        body {
            background-color: rgb(236, 236, 236);
        }

        .card {
            background-color: white;
            border-radius: 1rem;
            padding-top: 1rem;
            padding-bottom: 1.5rem;
        }

        .logo {
            margin-top: 1rem;
            width: 4.5rem;
        }

        .titulo {
            font-weight: lighter;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .subtitulo {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: lighter;
        }

        .linea {
            margin: auto;
            width: 50%;
            background:rgb(160, 36, 217);
            height: 0.01rem;
            margin-bottom: 0.5rem;
        }

        .codigo {
            color:rgb(160, 36, 217);
            font-family: 'Times New Roman', Times, serif;
            font-size: 1.5rem;
        }

        .mensajes {
            color: rgb(198, 198, 198);
        }

        h1,
        h2,
        p {
            color: #000000
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <h1 class="mensajes">Two Factor</h1>
        <div class="card">
            <h1 class="titulo">CÓDIGO DE AUTENTICACIÓN</h1>
            <div class="linea"></div>
            <h2 class="subtitulo" style="color: #000000; margin-bottom: 1.5rem;">Hola!, {{ $name }}</h2>
            <p class="subtitulo" style="margin-bottom: 1.5rem;">Tú código para acceder es el siguiente</p>
            <p class="codigo">{{ $code }}</a>
        </div>
    </div>
</body>

</html>
