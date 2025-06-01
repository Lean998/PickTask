<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            background: linear-gradient(to top, #FFA600,#f0f0f0);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-size: 0.9rem;
        }

        .navbar {
            background: transparent; 
    backdrop-filter: blur(8px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #FFA600;
            padding: 0.5rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 50px;
        }

        .navbar-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .navbar-nav {
            align-items: center;
            display: flex;
            gap: 0.5rem;
        }

        .navbar-nav .nav-link {
            color: #333;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            position: relative;
        }

        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            bottom: 4px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background-color: #FFA600;
            transition: width 0.2s ease;
        }

        .navbar-nav .nav-link:hover::after {
            width: 50%;
        }

        .navbar-nav .nav-link:hover {
            color: #FFA600;
        }

        .seccion-titulo {
            text-align: center;
            margin: 1.5rem 0 0.5rem;
            color:rgb(37, 33, 33);
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

        .tareas-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .tarea-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
            opacity: 0;
            transform: translateY(15px);
            border-top: 4px solid #FFA600;
        }

        .tarea-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .tarea-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .tarea-titulo {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            color: #333;
        }

        .tarea-descripcion {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }

        .tarea-meta {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .tarea-meta strong {
            color: #333;
            min-width: 70px;
            display: inline-block;
            font-size: 0.8rem;
        }

        .badge {
            background-color: #FFA600;
            color: white;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-weight: 600;
        }

        .acciones-tarea {
            display: flex;
            gap: 0.3rem;
            margin-top: 1rem;
        }

        .accion-btn {
            flex: 1;
            background-color: #FFA600;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            font-weight: 600;
        }

        .accion-btn:hover {
            background-color: #FF8C00;
            transform: translateY(-1px);
        }

        .accion-btn.editar {
            background-color: #FFC107;
        }

        .accion-btn.eliminar {
            background-color: #DC3545;
        }

        .accion-btn.archivar {
            background-color: #28A745;
            width: 100%;
            margin-top: 0.3rem;
            font-size: 0.8rem;
            padding: 0.3rem;
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

        .cuenta-container {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .cuenta-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: all 0.2s ease;
            padding: 0;
            white-space: nowrap;
            background-color: #FFA600;
            color: white;
            font-weight: bold;
            overflow: hidden;
            position: relative;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .cuenta-btn .texto-cuenta {
            display: none;
            margin-left: 6px;
            font-size: 0.8rem;
        }

        .cuenta-btn:hover .texto-cuenta {
            display: inline;
        }

        .cuenta-btn:hover {
            width: auto;
            padding: 0 10px;
            border-radius: 20px;
        }

        

        .dropdown-menu {
            min-width: 160px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-size: 0.85rem;
        }

        .dropdown-item {
            padding: 0.4rem 1rem;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: #FFA600;
            color: white;
        }

        
        .borde-prioridad-baja {
            border-top-color: #22c55e; 
        }

        .borde-prioridad-normal {
            border-top-color: #FFD700; 
        }

        .borde-prioridad-alta {
            border-top-color: #ef4444; 
        }

        body.dark-mode {
            background: linear-gradient(to top, #1a1a1a, #333);
            color: #f0f0f0;
        }

        body.dark-mode .navbar {
            background: linear-gradient(to right, #2c2c2c, #3d3d3d);
            border-bottom-color: #FF8C00;
        }

        body.dark-mode .tarea-card {
            background-color: #2c2c2c;
            color: #f0f0f0;
            border-top-color: #FF8C00;
        }

        body.dark-mode .tarea-titulo,
        body.dark-mode .tarea-meta strong {
            color: #f0f0f0;
        }

        body.dark-mode .tarea-descripcion,
        body.dark-mode .tarea-meta {
            color: #ccc;
        }

        .alert-recordatorio {
            position: fixed;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 280px;
            z-index: 1050;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.2);
            border-left: 4px solid #FFA600;
            padding: 1rem;
            background: linear-gradient(to right, #fff8e1, #ffffff);
            animation: pulse 2s infinite;
        }

        .alert-recordatorio .alert-heading {
            font-size: 1.2rem;
            color: #FFA600;
            margin-bottom: 0.8rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-recordatorio ul {
            padding-left: 1rem;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .alert-recordatorio li {
            margin-bottom: 0.3rem;
        }

        .alert-recordatorio .btn-close {
            position: absolute;
            right: 12px;
            top: 12px;
            font-size: 0.9rem;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 166, 0, 0.3); }
            70% { box-shadow: 0 0 0 8px rgba(255, 166, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 166, 0, 0); }
        }

        .mensaje-vacio {
            text-align: center;
            padding: 1.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .btn-crear-tarea {
            background: linear-gradient(135deg, #FFA600, #FF8C00);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
            transition: all 0.2s;
        }

        .btn-crear-tarea:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(255, 140, 0, 0.3);
        }

        .prioridad-icono {
            position: absolute;
            top: 8px;
            left: 8px;
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>
    <?php if (!empty($RecordatorioAlerta)): ?>
        <div class="alert alert-warning alert-recordatorio alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="bi bi-bell-fill"></i> Recordatorios</h5>
            <ul>
                <?php foreach ($RecordatorioAlerta as $mensaje): ?>
                    <li><?= $mensaje ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <?php
    function obtenerColoresTarea($colorNombre) {
        switch (strtolower($colorNombre)) {
            case 'rojo':     return '#B00020';
            case 'azul':     return '#0D47A1';
            case 'verde':    return '#1B5E20';
            case 'naranja':  return '#E65100';
            case 'celeste':  return '#0288D1';
            case 'gris':     return '#424242';
            case 'violeta':  return '#6A1B9A';
            default:         return '#616161';
        }
    }
    ?>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid position-relative">
            <a href="<?= base_url('/') ?>" class="btn-volver">
    <i class="bi bi-arrow-left"></i> Volver
</a>

            
            <div class="navbar-container">
                <ul class="navbar-nav flex-row">
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('/') ?>">Tablero</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('tareas/crear') ?>">Crear</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('tareas/historial') ?>">Historial</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/Colaborar') ?>">Colaborar</a></li>
                </ul>
            </div>

            <div class="cuenta-container">
                <div class="dropdown">
                    <button class="btn cuenta-btn dropdown-toggle d-flex align-items-center justify-content-center gap-1" type="button" id="dropdownCuenta" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        <span class="texto-cuenta">Cuenta</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownCuenta">
                        <li><a class="dropdown-item" href="<?= site_url('usuario/editar') ?>"><i class="bi bi-pencil-square me-2"></i>Editar perfil</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="seccion-titulo">Mis Tareas</h2>

<div class="tareas-container" id="tareasContainer">
    <?php if (!empty($tareas_propias)): ?>
        <?php foreach ($tareas_propias as $tarea): ?>
            <?php
            $prioridad = strtolower($tarea['prioridad']);
            $clasePrioridad = match ($prioridad) {
                'baja' => 'borde-prioridad-baja',
                'normal' => 'borde-prioridad-normal',
                'alta' => 'borde-prioridad-alta',
                default => '',
            };
            
     
            switch ($prioridad) {
                case 'alta':
                    $colorIcono = '#E53935'; 
                    break;
                case 'normal':
                    $colorIcono = '#FFB300'; 
                    break;
                case 'baja':
                    $colorIcono = '#43A047'; 
                    break;
                default:
                    $colorIcono = '#BDBDBD'; 
            }
            ?>
            
            <div class="tarea-card <?= $clasePrioridad ?>"
                 style="border-top-color: <?= esc(obtenerColoresTarea($tarea['color'])) ?>;
            border-bottom-color: <?= esc(obtenerColoresTarea($tarea['color'])) ?>;
            border-top-style: solid;
            border-bottom-style: solid;
            border-top-width: 4px;
            border-bottom-width: 4px;
            position: relative;">
                 <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="<?= $colorIcono ?>" 
         class="bi bi-exclamation-diamond-fill"
         viewBox="0 0 16 16"
         style="position: absolute; top: 8px; right: 8px;">
        <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
    </svg>
                
                <form method="POST" action="<?= site_url('tarea') ?>" style="margin: 0;">
                    <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                    <button type="submit" style="all: unset; cursor: pointer; display: block; width: 100%;">
                        <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                        <div class="tarea-descripcion"><?= esc($tarea['descripcion']) ?></div>
                        <div class="tarea-meta">
                            <strong>Estado:</strong> 
                            <span class="badge"><?= esc($tarea['estado']) ?></span>
                        </div>
                        <div class="tarea-meta">
                            <strong>Prioridad:</strong> 
                            <span class="badge"><?= esc($tarea['prioridad']) ?></span>
                        </div>
                        <div class="tarea-meta">
                            <strong>Vence:</strong> <?= esc($tarea['fecha_vencimiento']) ?>
                        </div>
                        <?php if (!empty($tarea['fecha_recordatorio'])): ?>
                            <div class="tarea-meta">
                                <strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?>
                            </div>
                        <?php endif; ?>
                    </button>
                </form>

                <div class="acciones-tarea">
                    <form action="<?= site_url('tarea/editar') ?>" method="post">
                        <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" class="accion-btn editar">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </form>
                    <form action="<?= site_url('tarea/baja') ?>" method="post">
                        <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" class="accion-btn eliminar">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </div>

                <?php if ($tarea['estado'] === 'completada' && !$tarea['archivada']): ?>
                    <a href="<?= site_url('tarea/archivar/' . $tarea['id']) ?>" class="accion-btn archivar">
                        <i class="bi bi-archive"></i> Archivar
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="mensaje-vacio">
            <p>No tienes tareas propias activas.</p>
            <a href="<?= base_url('tareas/crear') ?>" class="btn btn-crear-tarea">
                <i class="bi bi-plus-circle"></i> Crear tarea
            </a>
        </div>
    <?php endif; ?>
</div>

        <h2 class="seccion-titulo">Mis Colaboraciones</h2>

<div class="tareas-container" id="tareasContainer">
    <?php if (!empty($tareas_colaborativas)): ?>
        <?php foreach ($tareas_colaborativas as $tarea): ?>
            <?php
            $prioridad = strtolower($tarea['prioridad']);
            $clasePrioridad = match ($prioridad) {
                'baja' => 'borde-prioridad-baja',
                'normal' => 'borde-prioridad-normal',
                'alta' => 'borde-prioridad-alta',
                default => '',
            };
            
            
            switch ($prioridad) {
                case 'alta':
                    $colorIcono = '#E53935'; 
                    break;
                case 'normal':
                    $colorIcono = '#FFB300'; 
                    break;
                case 'baja':
                    $colorIcono = '#43A047'; 
                    break;
                default:
                    $colorIcono = '#BDBDBD'; 
            }
            ?>
            
            <div class="tarea-card <?= $clasePrioridad ?>"
                 style="border-top-color: <?= esc(obtenerColoresTarea($tarea['color'])) ?>;
            border-bottom-color: <?= esc(obtenerColoresTarea($tarea['color'])) ?>;
            border-top-style: solid;
            border-bottom-style: solid;
            border-top-width: 4px;
            border-bottom-width: 4px;
            position: relative;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="<?= $colorIcono ?>" 
                     class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16"
                     style="position: absolute; top: 8px; right: 8px;">
                    <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                
                <form method="POST" action="<?= site_url('tarea/colaborar') ?>" style="margin: 0;">
                    <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                    <button type="submit" style="all: unset; cursor: pointer; display: block; width: 100%;">
                        <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                        <div class="tarea-descripcion"><?= esc($tarea['descripcion']) ?></div>
                        <div class="tarea-meta">
                            <strong>Estado:</strong> 
                            <span class="badge"><?= esc($tarea['estado']) ?></span>
                        </div>
                        <div class="tarea-meta">
                            <strong>Prioridad:</strong> 
                            <span class="badge"><?= esc($tarea['prioridad']) ?></span>
                        </div>
                        <div class="tarea-meta">
                            <strong>Vence:</strong> <?= esc($tarea['fecha_vencimiento']) ?>
                        </div>
                        <?php if (!empty($tarea['fecha_recordatorio'])): ?>
                            <div class="tarea-meta">
                                <strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?>
                            </div>
                        <?php endif; ?>
                        <div class="tarea-meta">
                            <strong>Propietario:</strong> <?= esc($tarea['usuario_id']) ?>
                        </div>
                    </button>
                </form>

                <form action="<?= site_url('tarea/editar') ?>" method="post">
                        <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" class="accion-btn editar">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </form>
                    
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="mensaje-vacio">
            <p>No hay tareas colaborativas disponibles.</p>
        </div>
    <?php endif; ?>
</div>
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.tarea-card').forEach((card, i) => {
                setTimeout(() => card.classList.add('show'), i * 80);
            });
        });

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