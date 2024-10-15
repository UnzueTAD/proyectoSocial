<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            font-size: 14px;
            position: relative;
            min-height: 100vh; /* Asegura que la página siempre cubra la altura completa */
        }

        /* Estilo del encabezado */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 20px;
            text-transform: uppercase;
            margin: 5px 0;
        }

        .header h2 {
            font-size: 18px;
            margin: 5px 0;
        }

        .details {
            margin-bottom: 30px;
        }

        .details p {
            margin: 5px 0;
        }

        /* Estilo de tabla para mostrar los detalles */
        .motivo-solicitud {
            border: 1px solid black;
            padding: 10px;
            margin-top: 20px;
            white-space: pre-wrap; /* Mantener saltos de línea del texto */
            word-wrap: break-word; /* Ajustar texto largo con saltos de línea */
        }

        /* Estilo de la firma y fecha */
        .footer-section {
            position: absolute;
            bottom: 40px; /* Asegura que esté cerca del pie de página */
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .firma {
            text-align: left;
        }

        .footer {
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="images/logomuni.png" alt="Logo Municipalidad">
        <h1>I. MUNICIPALIDAD SAN JUAN DE LA COSTA</h1>
        <h2>Solicitud</h2>
    </div>

    <div class="details">
        <p><strong>Nombre:</strong> {{ $solicitud->nombre_completo }}</p>
        <p><strong>RUT:</strong> {{ $solicitud->rut }}-{{ $solicitud->digito_verificador }}</p>
        <p><strong>Sector:</strong> {{ $solicitud->sector }}</p>
        <p><strong>Fecha de Solicitud:</strong> {{ $solicitud->fecha_solicitud }}</p>
    </div>

    <div class="motivo-solicitud">
        <strong>Motivo de la Solicitud:</strong>
        <p>{{ $solicitud->motivo_solicitud }}</p>
    </div>

    <div class="footer-section">
        <div class="firma">
            <p>FIRMA</p>
            <p>RUT: {{ $solicitud->rut }}-{{ $solicitud->digito_verificador }}</p>
        </div>
        <div class="footer">
            <p>Puaucho, {{ date('d-m-Y') }}</p>
        </div>
    </div>

</body>
</html>
