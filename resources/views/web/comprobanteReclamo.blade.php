<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Reclamo</title>
    <style>
        /* ESTILOS GENERALES */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        .comprobante {
            background: white;
            width: 400px;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: left;
            position: relative;
            border: 2px dashed #000; /* Efecto de ticket */
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #61b194;
        }
        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }
        .titulo {
            color: #000;
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .codigo {
            font-size: 16px;
            font-weight: bold;
            color: #e74c3c;
            text-align: center;
            margin: 10px 0;
            background: #f9e6e6;
            padding: 5px;
            border-radius: 5px;
        }
        .info p {
            margin: 5px 0;
            font-size: 14px;
        }
        .detalle {
            font-size: 14px;
            margin: 10px 0;
            padding: 10px;
            background: #f3f3f3;
            border-radius: 5px;
        }
        .estado {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            padding: 8px;
            color: white;
            background: #f39c12;
            border-radius: 5px;
        }
        .btn-imprimir {
            background: #438971;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }
        .btn-imprimir:hover {
            background: #366F5D;
        }
        
        /* ESTILOS PARA IMPRESIÓN */
        @media print {
            body {
                background: none;
                padding: 0;
            }
            .comprobante {
                box-shadow: none;
                border: none;
                width: 100%;
            }
            .btn-imprimir {
                display: none; /* OCULTA EL BOTÓN AL IMPRIMIR */
            }
        }
    </style>
</head>
<body>

    <div class="comprobante">
        <div class="header">
            <img src="{{ url('') }}/web/images/LOGO.PNG" alt="Logo de la Empresa">
            <p class="titulo">Comprobante de Reclamo</p>
        </div>

        <p class="codigo">Código: {{ $reclamo->codigo_reclamo }}</p>

        <div class="info">
            <p><strong>Nombre:</strong> {{ $reclamo->persona->nombres }} {{ $reclamo->persona->apellido_paterno }} {{ $reclamo->persona->apellido_materno }}</p>
            <p><strong>Documento:</strong> {{ $reclamo->tipo_documento }} - {{ $reclamo->num_documento }}</p>
        </div>

        <p class="detalle"><strong>Detalle:</strong> {{ $reclamo->detalle }}</p>

        <p class="estado">Estado: {{ ucfirst($reclamo->estado) }}</p>
        <a class="btn-imprimir w-100"  href="{{ url('') }}/comprobante/{{$reclamo->codigo_reclamo}}"  target="_blank">🖨️ Imprimir</a>
        
    </div>

</body>
</html>
