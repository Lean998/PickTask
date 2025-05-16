<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: white;
            border-bottom: 2px solid #FFA600;
            padding: 1rem 0;
        }
        .navbar-nav .nav-link {
            color: #333;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            transition: background-color 0.3s, color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            background-color: #FFA600;
            color: white !important;
        }

        .tareas-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 2rem;
        }

        .tarea-card {
            width: 300px;
            background-color: white;
            border-left: 10px solid #FFA600;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 1.5rem;
            transition: transform 0.2s;
        }

        .tarea-card:hover {
            transform: translateY(-5px);
        }

        .tarea-titulo {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: #333;
        }

        .tarea-descripcion {
            font-size: 0.95rem;
            color: #555;
        }

        .tarea-meta {
            font-size: 0.85rem;
            color: #777;
        }

        .tarea-card[data-color] {
            border-left-color: inherit;
            background-color: inherit;
        }

        .tarea-card .badge {
            background-color: #00C1FF;
            color: white;
            font-size: 0.75rem;
        }

        .titulo-principal {
            text-align: center;
            margin-top: 2rem;
            color: #FFA600;

            
        }

        .accion-btn {
    background-color: #FFA600;
    border: none;
    color: white;
    font-size: 1.2rem;
    padding: 0.4rem 0.6rem;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.accion-btn:hover {
    background-color: #FF8C00;
}


    </style>
</head>
<body>

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

    <nav class="navbar navbar-expand-lg">
        <div class="container justify-content-center">
            <ul class="navbar-nav text-center">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Tablero</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Crear Tarea</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Historial</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <h2 class="titulo-principal">Mis Tareas</h2>

    <div class="tareas-container">
    <?php if (!empty($tareas)): ?>
        <?php foreach ($tareas as $tarea): ?>
            <?php [$borde, $fondo] = obtenerColoresTarea($tarea['color']); ?>
            <form method="POST" action="<?= site_url('tarea') ?>" style="margin-bottom: 1rem;">
                <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                <button type="submit" style="all: unset; cursor: pointer; display: block;">
                    <div class="tarea-card" style="background-color: <?= $fondo ?>; border-left: 4px solid <?= $borde ?>; padding: 1rem; border-radius: 8px;">
                        <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                        <div class="tarea-descripcion"><?= esc($tarea['descripcion']) ?></div>
                        <hr>
                        <div class="tarea-meta"><strong>Estado:</strong> <?= esc($tarea['estado']) ?></div>
                        <div class="tarea-meta"><strong>Prioridad:</strong> <span class="badge"><?= esc($tarea['prioridad']) ?></span></div>
                        <div class="tarea-meta"><strong>Vence:</strong> <?= esc($tarea['fecha_vencimiento']) ?></div>
                        <?php if ($tarea['fecha_recordatorio']): ?>
                            <div class="tarea-meta"><strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?></div>
                        <?php endif; ?>
                    
                    </div>
                </button>
            <div style="display: flex; margin-top: auto;">
    <form action="<?= site_url('tarea/editar') ?>" method="post" style="flex: 1;">
        <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
        <button type="submit" class="accion-btn"
            style="width: 100%; padding: 0.1rem 0; background-color:rgb(228, 231, 11); color: #000; border: none; font-weight: bold; border-radius: 0 0 0 8px; transition: background-color 0.3s; transform: translateY(-5px);">
            🖊️ Editar
        </button>
    </form>
    <form action="<?= site_url('tarea/baja') ?>" method="post" style="flex: 1;">
        <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
        <button type="submit" class="accion-btn"
            style="width: 100%; padding: 0.1rem 0; background-color:rgb(160, 156, 156); color: #000; border: none; font-weight: bold; border-radius: 0 0 8px 0; transition: background-color 0.3s; transform: translateY(-5px);">
            🗑️ Borrar
        </button>
    </form>
</div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>

    <h2 class="titulo-principal">Mis Colaboraciones</h2>


</body>
</html>
