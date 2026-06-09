<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Producción | Ahumados R y M</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { primary: '#610000', 'primary-container': '#8b0000' } }
            }
        }
    </script>
</head>
<body class="bg-gray-50 p-8">
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Gestión de Lotes de Producción</h1>
    <p class="text-gray-500">Control de calidad y seguimiento de ahumados artesanales.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">local_fire_department</span>
            Lote Activo: L-2026-004
        </h2>
        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">En Proceso</span>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="font-bold text-gray-700 mb-2">Detalles del Lote</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><span class="font-semibold text-gray-800">Producto a elaborar:</span> Cecina Premium Ahumada</li>
                    <li><span class="font-semibold text-gray-800">Cantidad proyectada:</span> 25.00 Kg</li>
                    <li><span class="font-semibold text-gray-800">Fecha de inicio:</span> {{ date('d/m/Y') }} 08:30 AM</li>
                    <li><span class="font-semibold text-gray-800">Encargado:</span> {{ Auth::user()->name }}</li>
                </ul>
            </div>
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                <h3 class="font-bold text-orange-800 mb-2">Consumo de Insumos</h3>
                <ul class="space-y-1 text-sm text-orange-900">
                    <li class="flex justify-between"><span>Carne de cerdo:</span> <strong>30.00 Kg</strong></li>
                    <li class="flex justify-between"><span>Madera Nogal:</span> <strong>5.00 Kg</strong></li>
                    <li class="flex justify-between"><span>Especias Múltiples:</span> <strong>0.50 Kg</strong></li>
                </ul>
            </div>
        </div>

        <h3 class="font-bold text-gray-800 mb-4">Progreso del Ahumado</h3>
        
        <!-- Barra de progreso (Swimlane visual) -->
        <div class="relative pt-1 mb-8">
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                <div style="width: 50%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary"></div>
            </div>
            <div class="flex justify-between text-xs font-semibold text-gray-500">
                <div class="text-center w-1/4">
                    <div class="w-8 h-8 mx-auto bg-primary text-white rounded-full flex items-center justify-center mb-1">
                        <span class="material-symbols-outlined text-[16px]">check</span>
                    </div>
                    Preparación y Salado
                </div>
                <div class="text-center w-1/4">
                    <div class="w-8 h-8 mx-auto bg-primary text-white rounded-full flex items-center justify-center mb-1">
                        <span class="material-symbols-outlined text-[16px]">check</span>
                    </div>
                    Reposo
                </div>
                <div class="text-center w-1/4">
                    <div class="w-8 h-8 mx-auto border-2 border-primary text-primary bg-white rounded-full flex items-center justify-center mb-1 animate-pulse">
                        <span class="material-symbols-outlined text-[16px]">local_fire_department</span>
                    </div>
                    Ahumado en Horno
                </div>
                <div class="text-center w-1/4 opacity-50">
                    <div class="w-8 h-8 mx-auto border-2 border-gray-300 text-gray-300 bg-white rounded-full flex items-center justify-center mb-1">
                        <span class="material-symbols-outlined text-[16px]">inventory_2</span>
                    </div>
                    Empacado al Vacío
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4 border-t pt-4">
            <button class="px-6 py-2 border border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50">Registrar Insumos</button>
            <button class="px-6 py-2 bg-primary text-white font-bold rounded-lg hover:bg-primary-container">Avanzar a Siguiente Etapa</button>
        </div>
    </div>
</div>

<!-- Lotes Anteriores -->
<h2 class="text-xl font-bold text-gray-800 mb-4">Lotes Finalizados Recientemente</h2>
<div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
            <tr>
                <th class="px-6 py-3">Lote ID</th>
                <th class="px-6 py-3">Producto</th>
                <th class="px-6 py-3">Rendimiento (Mermas)</th>
                <th class="px-6 py-3">Fecha Fin</th>
                <th class="px-6 py-3">Estado</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            <tr>
                <td class="px-6 py-4 font-bold text-gray-700">L-2026-003</td>
                <td class="px-6 py-4">Chorizo Casero</td>
                <td class="px-6 py-4">15.00 Kg (12% merma)</td>
                <td class="px-6 py-4">Hace 2 días</td>
                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">TERMINADO</span></td>
            </tr>
            <tr>
                <td class="px-6 py-4 font-bold text-gray-700">L-2026-002</td>
                <td class="px-6 py-4">Costillar BBQ</td>
                <td class="px-6 py-4">18.50 Kg (18% merma)</td>
                <td class="px-6 py-4">Hace 4 días</td>
                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">TERMINADO</span></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
