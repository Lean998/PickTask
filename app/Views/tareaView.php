<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Tarea</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-left: 5px solid #333;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        .subtarea-card {
            border: 1px solid #ccc;
            border-left: 5px solid #666;
            padding: 10px;
            margin: 10px 0;
            background-color: #ffffff;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            background-color: #eee;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <h1>Detalles de la Tarea</h1>

    <?php
function obtenerColoresTarea($colorNombre)
{
    switch (strtolower($colorNombre)) {
        case 'rojo':
            return ['#FF6B6B', '#FFECEC'];
        case 'azul':
            return ['#1E90FF', '#E6F0FF'];
        case 'verde':
            return ['#28A745', '#E9F7EF'];
        case 'naranja':
            return ['#FFA600', '#FFF3E0'];
        case 'celeste':
            return ['#00C1FF', '#E0F7FF'];
        case 'gris':
            return ['#6C757D', '#F0F0F0'];
        case 'violeta':
            return ['#8A2BE2', '#F3E8FF'];
        default:
            return ['#CCCCCC', '#F9F9F9'];
    }
}
?>

    <?php if (!empty($tarea)): ?>
        <div class="card" style="border-left-color: <?= esc($tarea['color']) ?>; background-color: <?= esc($tarea['color']) ?>22;">
            <h2><?= esc($tarea['titulo']) ?></h2>
            <p><?= esc($tarea['descripcion']) ?></p>
            <p><strong>Estado:</strong> <?= esc($tarea['estado']) ?></p>
            <p><strong>Prioridad:</strong> <span class="badge"><?= esc($tarea['prioridad']) ?></span></p>
            <p><strong>Fecha de vencimiento:</strong> <?= esc($tarea['fecha_vencimiento']) ?></p>
            <?php if ($tarea['fecha_recordatorio']): ?>
                <p><strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?></p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>No se encontró la tarea.</p>
    <?php endif; ?>

    <h2>Subtareas</h2>

    <?php if (!empty($subTareas)): ?>
    <?php foreach ($subTareas as $sub): ?>
        <?php [$borde, $fondo] = obtenerColoresTarea($sub['color']); ?>
        <div class="subtarea-card" style="border-left: 4px solid <?= $borde ?>; background-color: <?= $fondo ?>; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
            <h4><?= esc($sub['titulo']) ?></h4>
            <p><?= esc($sub['descripcion']) ?></p>
            <p><strong>Estado:</strong> <?= esc($sub['estado']) ?></p>
            <p><strong>Prioridad:</strong> <span class="badge"><?= esc($sub['prioridad']) ?></span></p>
            <p><strong>Fecha de vencimiento:</strong> <?= esc($sub['fecha_vencimiento']) ?></p>
            <?php if ($sub['fecha_recordatorio']): ?>
                <p><strong>Recordatorio:</strong> <?= esc($sub['fecha_recordatorio']) ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No hay subtareas registradas para esta tarea.</p>
<?php endif; ?>


</body>
</html>
