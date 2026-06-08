<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 12px;
            color: #343A40;
            padding: 20px;
        }

        /* ── ENCABEZADO ── */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #0D6EFD;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header-left h1 {
            font-size: 20px;
            font-weight: bold;
            color: #0D6EFD;
            margin-bottom: 4px;
        }

        .header-left p {
            font-size: 11px;
            color: #6C757D;
        }

        .header-right {
            text-align: right;
            font-size: 11px;
            color: #6C757D;
        }

        .header-right p {
            margin-bottom: 2px;
        }

        /* ── RESUMEN ── */
        .resumen {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .resumen-card {
            flex: 1;
            background-color: #F8F9FA;
            border: 1px solid #E9ECEF;
            border-radius: 8px;
            padding: 10px 15px;
            text-align: center;
        }

        .resumen-card p {
            font-size: 10px;
            color: #6C757D;
            margin-bottom: 4px;
        }

        .resumen-card h3 {
            font-size: 18px;
            font-weight: bold;
            color: #0D6EFD;
        }

        /* ── TABLA ── */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #0D6EFD;
            color: #FFFFFF;
            padding: 8px 10px;
            font-size: 11px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #F8F9FA;
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF;
        }

        tbody td {
            padding: 7px 10px;
            font-size: 11px;
            border-bottom: 1px solid #E9ECEF;
            color: #343A40;
        }

        /* ── BADGES ── */
        .badge {
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-persona {
            background-color: #CFE2FF;
            color: #084298;
        }

        .badge-empresa {
            background-color: #D1E7DD;
            color: #0A3622;
        }

        /* ── PIE DE PÁGINA ── */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #6C757D;
            border-top: 1px solid #E9ECEF;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    {{-- Encabezado --}}
    <div class="header">
        <div class="header-left">
            <h1>TecnoFlow MVC</h1>
            <p>TecnoSoluciones S.A. — Reporte de Clientes</p>
        </div>
        <div class="header-right">
            <p><strong>Fecha:</strong> {{ now()->translatedFormat('d \d\e F, Y') }}</p>
            <p><strong>Hora:</strong> {{ now()->format('H:i:s') }}</p>
            <p><strong>Total registros:</strong> {{ $clientes->count() }}</p>
        </div>
    </div>

    {{-- Resumen --}}
    <div class="resumen">
        <div class="resumen-card">
            <p>TOTAL CLIENTES</p>
            <h3>{{ $clientes->count() }}</h3>
        </div>
        <div class="resumen-card">
            <p>EMPRESAS</p>
            <h3>{{ $clientes->where('tipo_cliente', 'empresa')->count() }}</h3>
        </div>
        <div class="resumen-card">
            <p>PERSONAS NATURALES</p>
            <h3>{{ $clientes->where('tipo_cliente', 'persona')->count() }}</h3>
        </div>
    </div>

    {{-- Tabla de clientes --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>
                    @if($cliente->tipo_cliente === 'persona')
                        <span class="badge badge-persona">P. Natural</span>
                    @else
                        <span class="badge badge-empresa">Empresa</span>
                    @endif
                </td>
                <td>{{ $cliente->tipo_cliente === 'persona' ? 'DNI' : 'RUC' }} {{ $cliente->codigo }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefono ?? '—' }}</td>
                <td>{{ $cliente->direccion ?? '—' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px; color: #6C757D;">
                    No hay clientes registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pie de página --}}
    <div class="footer">
        <p>TecnoFlow MVC — TecnoSoluciones S.A. | Reporte generado el {{ now()->translatedFormat('d \d\e F, Y') }} a las {{ now()->format('H:i:s') }}</p>
    </div>

</body>
</html>