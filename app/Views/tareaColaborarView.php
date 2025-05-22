<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Tarea - PickTask</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(to top, #FFA600, #f0f0f0);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-size: 0.9rem;
        }

        .navbar {
            background: linear-gradient(to right, #fef5e6, rgb(252, 237, 197));
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #FFA600;
            padding: 0.5rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 50px;
        }

        .btn-volver {
            background: linear-gradient(135deg, #ff7a18, #ffae00);
            color: #fff;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            border: none;
            box-shadow: 0 2px 6px rgba(255, 140, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            overflow: hidden;
            cursor: pointer;
        }

        .btn-volver:hover {
            transform: translateY(-50%) scale(1.03);
            box-shadow: 0 3px 8px rgba(255, 140, 0, 0.3);
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .seccion-titulo {
            text-align: center;
            margin: 1.5rem 0 0.5rem;
            color: #FFA600;
            font-size: 1.5rem;
            font-weight: bold;
            position: relative;
        }

        .seccion-titulo::after {
            content: "";
            display: block;
            width: 80px;
            height: 3px;
            background: #FFA600;
            margin: 0.3rem auto;
            border-radius: 2px;
        }

        .tarea-card {
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .tarea-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .tarea-titulo {
            font-weight: bold;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .tarea-descripcion {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .tarea-meta {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tarea-meta strong {
            color: #333;
            min-width: 100px;
            display: inline-block;
            font-size: 0.85rem;
        }

        .badge {
            background-color: #FFA600;
            color: white;
            font-size: 0.75rem;
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            font-weight: 600;
        }

        .colaboradores-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1.5rem;
        }

        .colaborador-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .colaborador-item:last-child {
            border-bottom: none;
        }

        .colaborador-icon {
            width: 32px;
            height: 32px;
            background-color: #FFA600;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 0.9rem;
        }

        .subtareas-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .subtarea-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 1.25rem;
            border-left: 4px solid;
            transition: transform 0.2s;
        }

        .subtarea-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .subtarea-titulo {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .responsables-list {
            margin-top: 1rem;
            border-top: 1px solid #eee;
            padding-top: 1rem;
        }

        .responsable-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }

        .acciones-responsable {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .form-check-input:checked {
            background-color: #FFA600;
            border-color: #FFA600;
        }

        .form-check-label {
            font-size: 0.85rem;
            cursor: pointer;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #666;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .empty-state i {
            font-size: 2rem;
            color: #FFA600;
            margin-bottom: 1rem;
        }

        /* Modal styles */
        .modal-custom {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            align-items: center;
            justify-content: center;
        }

        .modal-content-custom {
            background: white;
            max-width: 450px;
            width: 90%;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-header-custom {
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .modal-title-custom {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }

        .btn-modal {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-modal-primary {
            background-color: #FFA600;
            color: white;
            border: none;
        }

        .btn-modal-primary:hover {
            background-color: #FF8C00;
        }

        .btn-modal-secondary {
            background-color: #f0f0f0;
            color: #333;
            border: none;
        }

        .btn-modal-secondary:hover {
            background-color: #e0e0e0;
        }

        /* Dark mode styles */
        body.dark-mode {
            background: linear-gradient(to top, #1a1a1a, #333);
            color: #f0f0f0;
        }

        body.dark-mode .navbar {
            background: linear-gradient(to right, #2c2c2c, #3d3d3d);
            border-bottom-color: #FF8C00;
        }

        body.dark-mode .tarea-card,
        body.dark-mode .subtarea-card,
        body.dark-mode .empty-state {
            background-color: #2c2c2c;
            color: #f0f0f0;
        }

        body.dark-mode .tarea-titulo,
        body.dark-mode .subtarea-titulo,
        body.dark-mode .tarea-meta strong {
            color: #f0f0f0;
        }

        body.dark-mode .tarea-descripcion,
        body.dark-mode .tarea-meta {
            color: #ccc;
        }

        body.dark-mode .colaboradores-section,
        body.dark-mode .responsable-item {
            background-color: #3d3d3d;
        }

        body.dark-mode .modal-content-custom {
            background-color: #2c2c2c;
            color: #f0f0f0;
        }

        body.dark-mode .modal-header-custom {
            border-bottom-color: #444;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid position-relative">
            <a href="javascript:history.back()" class="btn-volver">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            
            <div style="text-align: center; width: 100%;">
                <span style="font-weight: 600; color: #FFA600;">Detalles de la Tarea</span>
            </div>
        </div>
    </nav>
    
<?php


        $prioridad = strtolower($tarea['prioridad'] ?? '');
$clasePrioridad = match ($prioridad) {
    'alta'   => 'borde-prioridad-alta',
    'media'  => 'borde-prioridad-normal',
    'normal' => 'borde-prioridad-normal',
    'baja'   => 'borde-prioridad-baja',
    default  => '',
};

function obtenerColoresTarea($colorNombre)
{
    switch (strtolower($colorNombre)) {
        case 'rojo':     return ['#FF6B6B', '#FFECEC'];
        case 'azul':     return ['#1E90FF', '#E6F0FF'];
        case 'verde':    return ['#28A745', '#E9F7EF'];
        case 'naranja':  return ['#FFA600', '#FFF3E0'];
        case 'celeste':  return ['#00C1FF', '#E0F7FF'];
        case 'gris':     return ['#6C757D', '#F0F0F0'];
        case 'violeta':  return ['#8A2BE2', '#F3E8FF'];
        default:         return ['#CCCCCC', '#F9F9F9'];
    }
} ?>

    <div class="container">
        <?php if (!empty($tarea)): ?>
            <?php
$prioridad = strtolower($tarea['prioridad'] ?? '');
$clasePrioridad = match ($prioridad) {
    'alta'   => 'borde-prioridad-alta',
    'media'  => 'borde-prioridad-normal',
    'normal' => 'borde-prioridad-normal',
    'baja'   => 'borde-prioridad-baja',
    default  => '',
};
switch ($prioridad) {
                case 'alta':
                    $colorIcono = '#E53935'; //ES rojo
                    break;
                case 'media':
                case 'normal':
                    $colorIcono = '#FFB300'; //Es anaranjado - amarillo
                    break;
                case 'baja':
                    $colorIcono = '#43A047'; //Es verde
                    break;
                default:
                    $colorIcono = '#BDBDBD'; //Es gris neutro
            }

?>
            <div class="tarea-card <?= $clasePrioridad ?>"
     style="border-top: 4px solid <?= esc(obtenerColoresTarea($tarea['color'])[0]); ?>;
            border-bottom: 4px solid <?= esc(obtenerColoresTarea($tarea['color'])[0]); ?>;
            background-color: <?= esc(obtenerColoresTarea($tarea['color'])[1]); ?>;">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?= $colorIcono ?>" 
                    class="bi bi-exclamation-diamond-fill prioridad-icono"
                    viewBox="0 0 16 16">
                    <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>

                <h1 class="tarea-titulo"><?= esc($tarea['titulo']) ?></h1>
                <p class="tarea-descripcion"><?= esc($tarea['descripcion']) ?></p>
                
                <div class="tarea-meta">
                    <strong>Estado:</strong>
                    <span class="badge"><?= esc($tarea['estado']) ?></span>
                </div>
                
                <div class="tarea-meta">
                    <strong>Prioridad:</strong>
                    <span class="badge"><?= esc($tarea['prioridad']) ?></span>
                </div>
                
                <div class="tarea-meta">
                    <strong>Fecha de vencimiento:</strong>
                    <?= esc($tarea['fecha_vencimiento']) ?>
                </div>
                
                <?php if ($tarea['fecha_recordatorio']): ?>
                    <div class="tarea-meta">
                        <strong>Recordatorio:</strong>
                        <?= esc($tarea['fecha_recordatorio']) ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($colaboradores_disponibles)): ?>
                    <div class="colaboradores-section">
                        <h4 style="margin-bottom: 1rem; color: #FFA600;">
                            <i class="bi bi-people-fill"></i> Colaboradores disponibles (<?= count($colaboradores_disponibles) ?>)
                        </h4>
                        
                        <?php foreach ($colaboradores_disponibles as $colab): ?>
                            <div class="colaborador-item">
                                <div class="colaborador-icon">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <strong><?= esc($colab['nombre']) ?></strong>
                                    <div style="font-size: 0.8rem; color: #666;"><?= esc($colab['correo']) ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
        
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                No se encontró la tarea solicitada.
            </div>
        <?php endif; ?>

        <h2 class="seccion-titulo">Subtareas</h2>
        
        <?php if (!empty($subtareas)): ?>
            <div class="subtareas-container">
                <?php foreach ($subtareas as $sub): ?>
                    <?php [$borde, $fondo] = obtenerColoresTarea($sub['color']); ?>
                    
                    <?php [$borde, $fondo] = obtenerColoresTarea($sub['color']); ?>
<div class="subtarea-card"
     style="border-top: 4px solid <?= esc($borde) ?>;
            border-bottom: 4px solid <?= esc($borde) ?>;
            background-color: <?= esc($fondo) ?>;">

                        <h3 class="subtarea-titulo"><?= esc($sub['titulo']) ?></h3>
                        <p style="color: #666; font-size: 0.9rem; margin-bottom: 0.75rem;"><?= esc($sub['descripcion']) ?></p>
                        
                        <div class="tarea-meta">
                            <strong>Estado:</strong>
                            <span class="badge"><?= esc($sub['estado']) ?></span>
                        </div>
                        
                        <div class="tarea-meta">
                            <strong>Prioridad:</strong>
                            <span class="badge"><?= esc($sub['prioridad']) ?></span>
                        </div>
                        
                        <div class="tarea-meta">
                            <strong>Vencimiento:</strong>
                            <?= esc($sub['fecha_vencimiento']) ?>
                        </div>
                        
                        <?php if ($sub['fecha_recordatorio']): ?>
                            <div class="tarea-meta">
                                <strong>Recordatorio:</strong>
                                <?= esc($sub['fecha_recordatorio']) ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($sub['responsables'])): ?>
                            <div class="responsables-list">
                                <h5 style="font-size: 0.95rem; margin-bottom: 0.75rem; color: #FFA600;">
                                    <i class="bi bi-person-lines-fill"></i> Responsables
                                </h5>
                                
                                <?php foreach ($sub['responsables'] as $usuario): ?>
                                    <div class="responsable-item">
                                        <div class="colaborador-icon">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div>
                                            <strong><?= esc($usuario['nombre']) ?></strong>
                                            <div style="font-size: 0.8rem; color: #666;"><?= esc($usuario['correo']) ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p style="font-size: 0.85rem; color: #666; margin-top: 1rem;">
                                <i class="bi bi-info-circle"></i> Sin responsables asignados
                            </p>
                        <?php endif; ?>
                        
                        <?php
                        $esResponsable = false;
                        foreach ($sub['responsables'] as $usuario) {
                            if ($usuario['correo'] === $correo_usuario_logueado) {
                                $esResponsable = true;
                                break;
                            }
                        }
                        ?>
                        
                        <?php if ($esResponsable): ?>
                            <div class="acciones-responsable">
                                <p style="font-weight: 600; margin-bottom: 0.75rem; color: #FFA600;">
                                    <i class="bi bi-gear-fill"></i> Acciones de responsable
                                </p>
                                
                                <form action="<?= site_url('/subtareas/cambiarEstado') ?>" method="post" class="d-flex gap-3" onChange="this.submit();">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="subtarea_id" value="<?= esc($sub['id']) ?>">
                                    <input type="hidden" name="tarea_id" value="<?= esc($idTarea ?? '') ?>">
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="estado" id="estado_<?= $sub['id'] ?>_en_proceso" value="en_proceso"
                                            <?= $sub['estado'] === 'en_proceso' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="estado_<?= $sub['id'] ?>_en_proceso">En Proceso</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="estado" id="estado_<?= $sub['id'] ?>_completada" value="completada"
                                            <?= $sub['estado'] === 'completada' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="estado_<?= $sub['id'] ?>_completada">Completada</label>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h4>No hay subtareas registradas</h4>
                <p>Puedes crear nuevas subtareas desde el panel de edición</p>
            </div>
        <?php endif; ?>
    </div>


    <script>
        function obtenerColoresTarea(colorNombre) {
            const colores = {
                'rojo': ['#FF6B6B', '#FFECEC'],
                'azul': ['#1E90FF', '#E6F0FF'],
                'verde': ['#28A745', '#E9F7EF'],
                'naranja': ['#FFA600', '#FFF3E0'],
                'celeste': ['#00C1FF', '#E0F7FF'],
                'gris': ['#6C757D', '#F0F0F0'],
                'violeta': ['#8A2BE2', '#F3E8FF']
            };
            return colores[colorNombre.toLowerCase()] || ['#CCCCCC', '#F9F9F9'];
        }

    

        function toggleModoOscuro() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('modoOscuro', document.body.classList.contains('dark-mode'));
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('modoOscuro') === 'true') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</body>
</html>