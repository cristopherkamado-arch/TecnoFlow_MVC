<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Proyectos</title>
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

        .badge-pendiente {
            background-color: #FFF3CD;
            color: #856404;
        }

        .badge-progreso {
            background-color: #CFE2FF;
            color: #084298;
        }

        .badge-completado {
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
            <p>TecnoSoluciones S.A. — Reporte de Proyectos</p>
        </div>
        <div class="header-right">
            <p><strong>Fecha:</strong> {{ now()->translatedFormat('d \d\e F, Y') }}</p>
            <p><strong>Hora:</strong> {{ now()->format('H:i:s') }}</p>
            <p><strong>Total registros:</strong> {{ $proyectos->count() }}</p>
        </div>
    </div>

    {{-- Resumen --}}
    <div class="resumen">
        <div class="resumen-card">
            <p>TOTAL PROYECTOS</p>
            <h3>{{ $proyectos->count() }}</h3>
        </div>
        <div class="resumen-card">
            <p>PENDIENTES</p>
            <h3>{{ $proyectos->where('estado', 'pendiente')->count() }}</h3>
        </div>
        <div class="resumen-card">
            <p>EN PROGRESO</p>
            <h3>{{ $proyectos->where('estado', 'en progreso')->count() }}</h3>
        </div>
        <div class="resumen-card">
            <p>COMPLETADOS</p>
            <h3>{{ $proyectos->where('estado', 'completado')->count() }}</h3>
        </div>
    </div>

    {{-- Tabla de proyectos --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyectos as $proyecto)
            <tr>
                <td>{{ $proyecto->id }}</td>
                <td>{{ $proyecto->nombre }}</td>
                <td>{{ $proyecto->cliente->nombre }}</td>
                <td>
                    @if($proyecto->estado === 'pendiente')
                        <span class="badge badge-pendiente">Pendiente</span>
                    @elseif($proyecto->estado === 'en progreso')
                        <span class="badge badge-progreso">En Progreso</span>
                    @else
                        <span class="badge badge-completado">Completado</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}</td>
                <td>{{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d/m/Y') : '—' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px; color: #6C757D;">
                    No hay proyectos registrados.
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