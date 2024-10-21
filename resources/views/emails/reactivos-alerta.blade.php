<!DOCTYPE html>
<html>
<head>
    <title>Alerta de Reactivo</title>
</head>
<body>
    <h1>Alerta de Disponibilidad de Reactivo</h1>
    <p>El reactivo <strong>{{ $reactivo->nombre }}</strong> (código: {{ $reactivo->codigo }}) se encuentra con disponibilidad <strong>{{ $reactivo->disponibilidad }}</strong>.</p>
    <p>{{ $mensaje }}</p>
    <p>Cantidad disponible: {{ $reactivo->cantidad_disponible }} {{ $reactivo->unidad_medida }}.</p>
</body>
</html>