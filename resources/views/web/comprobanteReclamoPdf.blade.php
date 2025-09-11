

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Libro de Reclamaciones</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border: 2px solid #000;
    }
    th,
    td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #ddd;
      font-weight: bold;
      text-align: center;
    }
    .logo-container {
      text-align: center;
      padding: 10px;
    }
    .logo {
      max-width: 150px;
      height: auto;
    }
  </style>
</head>
<body>
  <table border="1" width="100%" cellspacing="0" cellpadding="5">
    <!-- Encabezado con Logo -->
    <tr>
      <td colspan="2" class="logo-container">
        <!-- Para DomPDF, es recomendable usar rutas absolutas -->
        <img src="{{ public_path('web/images/LOGO.PNG') }}" alt="Logo de la Empresa" class="logo">
      </td>
    </tr>
    <tr>
      <th colspan="2">Hoja de Reclamaciones del Libro de Reclamaciones</th>
    </tr>
    <tr>
      <td colspan="2" style="text-align: center; font-size: 18px; font-weight: bold;">HOJA DE RECLAMACIÓN</td>
    </tr>
    <!-- Datos Generales -->
    <tr>
      <td><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($reclamo->created_at)->format('d/m/Y') }}</td>
      <td><strong>N° {{ $reclamo->codigo_reclamo }}</strong></td>
    </tr>
    <tr>
      <td colspan="2">
        {{-- NOMBRE DE LA PERSONA NATURAL O RAZÓN SOCIAL DE LA PERSONA JURÍDICA / RUC DEL PROVEEDOR:<br> --}}
        20611012978 - SOLUCIONES & ESTRATEGIAS WELLNESS S.A.C. <br>
        {{-- {{ $reclamo->persona->nombres }} {{ $reclamo->persona->apellido_paterno }} {{ $reclamo->persona->apellido_materno }}:<br> --}}
        {{-- {{ config('app.proveedor', 'Nombre del Proveedor') }}<br> --}}
        {{-- [DOMICILIO DEL ESTABLECIMIENTO DONDE SE COLOCA EL LIBRO DE RECLAMACIONES / CÓDIGO DE IDENTIFICACIÓN] --}}
        Direccion : AV. PROLONGACION PASEO DE LA CASTELLANA NRO. 1320 DPTO. 1004 LIMA - LIMA - SANTIAGO DE SURCO
      </td>
    </tr>
    <!-- 1. Identificación del Consumidor Reclamante -->
    <tr>
      <td colspan="2"><strong>1. IDENTIFICACIÓN DEL CONSUMIDOR RECLAMANTE</strong></td>
    </tr>
    <tr>
      <td colspan="2">
        DNI / CE: {{ $reclamo->persona->num_documento }}/  Nombre: {{ $reclamo->persona->nombres }} {{ $reclamo->persona->apellido_paterno }} {{ $reclamo->persona->apellido_materno }}<br>
        Domicilio: {{ $reclamo->persona->direccion }}<br>

        Teléfono: {{ $reclamo->persona->celular }} -  Email:  {{ $reclamo->persona->correo }}
      </td>
    </tr>
    {{-- <tr>
      <td colspan="2">Padre o Madre (para el caso de menores de edad): _______________________</td>
    </tr> --}}
    <!-- 2. Identificación del Bien Contratado -->
    <tr>
      <td colspan="2"><strong>2. IDENTIFICACIÓN DEL BIEN CONTRATADO</strong></td>
    </tr>
    <tr>
      <td>Producto/Servicio:  {{ $reclamo->producto_servicio }} </td>
      <td>Monto reclamado:  {{ $reclamo->monto }}</td>
    </tr>
    <!-- 3. Detalle de la Reclamación y Pedido del Consumidor -->
    <tr>
      <td colspan="2"><strong>3. DETALLE DE LA RECLAMACIÓN Y PEDIDO DEL CONSUMIDOR</strong></td>
    </tr>
    <tr>
      <td>Reclamo <input type="checkbox" {{ $reclamo->tipo_reclamo == 'Reclamo' ? 'checked' : '' }}></td>
      <td>Queja <input type="checkbox" {{ $reclamo->tipo_reclamo == 'Queja' ? 'checked' : '' }}></td>
    </tr>
    <tr>
      <td colspan="2">Detalle: {{ $reclamo->detalle }}</td>
    </tr>
    <tr>
      <td colspan="2">Pedido: {{$reclamo->pedido}}</td>
    </tr>

    <!-- 4. Observaciones y Acciones Adoptadas por el Proveedor -->
    <tr>
      <td colspan="2"><strong>4. OBSERVACIONES Y ACCIONES ADOPTADAS POR EL PROVEEDOR</strong></td>
    </tr>
    <tr>
      <td>Fecha de comunicación de la respuesta: <br>
        {{$reclamo->fecha_respuesta}}
      </td>
      <td>
        {{$reclamo->respuesta}}
      </td>
    </tr>
    <tr>
      <td colspan="2"><strong>5. ACUERDOS FINALES</strong>   {{$reclamo->fecha_acuerdo_final}}</td>
    </tr>
    <tr>
      <td colspan="2">
        {{$reclamo->acuerdo_final}}
      </td>
    </tr>


    <tr>
      <td style="height: 100px">
         Firma del proveedor: <br>
      </td >
      <td style="height: 100px">
        Firma del cliente: <br>

      </td>
    </tr>

    <tr>
      <td colspan="2">
        <strong>* RECLAMO:</strong> Disconformidad relacionada a los bienes o servicios.<br>
        <strong>* QUEJA:</strong> Disconformidad no relacionada a los bienes o servicios o malestar respecto a la atención al público.<br>
        El proveedor deberá dar respuesta al reclamo en un plazo no mayor a treinta (30) días calendario, pudiendo ampliar el plazo hasta por treinta (30) días más con comunicación previa al consumidor.
      </td>
    </tr>
  </table>
</body>
</html>
