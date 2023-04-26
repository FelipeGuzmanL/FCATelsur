<!DOCTYPE html>
<html>
<head>
    <title>Exportar a Excel</title>
</head>
<body>
    <form method="POST" action="{{ route('etiquetas.export') }}">
        @csrf
        <button type="submit">Exportar a Excel</button>
    </form>
</body>
</html>
