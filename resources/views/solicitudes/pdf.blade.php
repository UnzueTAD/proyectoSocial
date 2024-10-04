<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud PDF</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 100px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            text-align: left;
        }
        .content {
            margin-top: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .request-box {
            border: 1px solid #000;
            padding: 10px;
            height: 150px;
            margin-bottom: 30px;
        }
        .firma {
            text-align: right;
            margin-top: 80px;
        }
        .firma p {
            margin: 0;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="path_to_logo.png" alt="Municipalidad Logo">
        <h2>I. MUNICIPALIDAD SAN JUAN DE LA COSTA</h2>
    </div>

    <div class="container">
        <div class="content">
            <h3 class="section-title">SOLICITUD</h3>

            <p><strong>Nombre:</strong> {{ $solicitud->nombre_completo }}</p>
            <p><strong>RUT:</strong> {{ $solicitud->rut }}-{{ $solicitud->digito_verificador }}</p>
            <p><strong>Sector:</strong> {{ $solicitud->sector }}</p>
            <p><strong>Localidad:</strong> {{ $solicitud->localidad }}</p>
            <p><strong>Fecha de Solicitud:</strong> {{ $solicitud->fecha_solicitud }}</p>

            <div class="request-box">
                <strong>Motivo de la Solicitud:</strong><br>
                {{ $solicitud->motivo_solicitud }}
            </div>

            <div class="firma">
                <p><strong>FIRMA</strong></p>
                <p>RUT: {{ $solicitud->rut }}</p>
                <p>FONO:</p>
            </div>

            <div class="footer">
                <p>Puaucho, {{ now()->format('d-m-Y') }}</p>
            </div>
        </div>
    </div>

</body>
</html>
