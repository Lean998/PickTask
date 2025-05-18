<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Tareas</title>
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

        .columnas-historial {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            gap: 20px;
        }

        .columna-tareas {
            flex: 1;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .columna-tareas.archivadas {
            background: rgba(248, 249, 250, 0.8);
            position: relative;
        }

        .columna-tareas.archivadas::before {
            content: "ARCHIVADAS";
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            background: #6c757d;
            color: white;
            padding: 2px 15px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .titulo-columna {
            text-align: center;
            margin: 0 0 1rem;
            color: #FFA600;
            font-size: 1.2rem;
            font-weight: 600;
            padding-bottom: 0.5rem;
            border-bottom: 2px dashed #FFA600;
        }

        .tareas-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 15px;
            max-height: 70vh;
            overflow-y: auto;
            padding: 0.5rem;
        }

        .tarea-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 1rem;
            transition: all 0.3s ease;
            border-top: 4px solid #FFA600;
            position: relative;
        }

        .tarea-card.archivada {
            border-top-color: #6c757d;
            background-color: #f8f9fa;
            opacity: 0.9;
            transform: scale(0.98);
        }

        .tarea-card.archivada:hover {
            transform: scale(0.99);
            opacity: 1;
        }

        .tarea-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

        .badge-archivada {
            background-color: #6c757d;
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

        .mensaje-vacio {
            text-align: center;
            padding: 1.5rem;
            color: #666;
            font-size: 0.9rem;
            grid-column: 1 / -1;
        }

        /* Estilos para prioridades */
        .borde-prioridad-baja {
            border-top-color: #22c55e;
        }

        .borde-prioridad-normal {
            border-top-color: #FFD700;
        }

        .borde-prioridad-alta {
            border-top-color: #ef4444;
        }

        /* Efecto de desvanecimiento para archivadas */
        @keyframes fadeInArchived {
            from { opacity: 0; transform: translateX(20px) scale(0.95); }
            to { opacity: 0.9; transform: translateX(0) scale(0.98); }
        }

        .tarea-card.archivada {
            animation: fadeInArchived 0.4s ease-out forwards;
        }

        /* Estilos para modo oscuro */
        body.dark-mode {
            background: linear-gradient(to top, #1a1a1a, #333);
            color: #f0f0f0;
        }

        body.dark-mode .navbar {
            background: linear-gradient(to right, #2c2c2c, #3d3d3d);
            border-bottom-color: #FF8C00;
        }

        body.dark-mode .columna-tareas {
            background: rgba(44, 44, 44, 0.8);
        }

        body.dark-mode .columna-tareas.archivadas {
            background: rgba(61, 61, 61, 0.8);
        }

        body.dark-mode .tarea-card {
            background-color: #2c2c2c;
            color: #f0f0f0;
            border-top-color: #FF8C00;
        }

        body.dark-mode .tarea-card.archivada {
            background-color: #3d3d3d;
            border-top-color: #6c757d;
        }

        body.dark-mode .tarea-titulo,
        body.dark-mode .tarea-meta strong {
            color: #f0f0f0;
        }

        body.dark-mode .tarea-descripcion,
        body.dark-mode .tarea-meta {
            color: #ccc;
        }

        body.dark-mode .mensaje-vacio {
            color: #aaa;
        }

        /* Scroll personalizado */
        .tareas-container::-webkit-scrollbar {
            width: 8px;
        }

        .tareas-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .tareas-container::-webkit-scrollbar-thumb {
            background: #FFA600;
            border-radius: 10px;
        }

        body.dark-mode .tareas-container::-webkit-scrollbar-track {
            background: #3d3d3d;
        }

        body.dark-mode .tareas-container::-webkit-scrollbar-thumb {
            background: #FF8C00;
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


        @media (max-width: 992px) {
            .columnas-historial {
                flex-direction: column;
            }
            
            .columna-tareas.archivadas {
                margin-top: 2rem;
            }
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
        .accion-btn.editar {
            background-color: #FFC107;
        }


    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid position-relative">
            <a href="javascript:history.back()" class="btn-volver">
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

            <!-- Cuenta -->
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

    <div class="container-fluid">
        <h2 class="seccion-titulo">Historial de Tareas</h2>

        <div class="columnas-historial">
        <!-- Columna de Tareas Finalizadas -->
        <div class="columna-tareas">
            <h3 class="titulo-columna">
                <i class="bi bi-lightning-charge-fill"></i> Finalizadas
            </h3>
            
            <div class="tareas-container">
                <?php if (empty($tareasFinalizadas)): ?>
                    <div class="mensaje-vacio">
                        <p>No hay tareas finalizadas.</p>
                        <a href="<?= base_url('tareas/crear') ?>" class="btn btn-crear-tarea">
                            <i class="bi bi-plus-circle"></i> Crear tarea
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach ($tareasFinalizadas as $tarea): ?>
                        <?php
                        $prioridad = strtolower($tarea['prioridad']);
                        $clasePrioridad = match ($prioridad) {
                            'baja' => 'borde-prioridad-baja',
                            'normal' => 'borde-prioridad-normal',
                            'alta' => 'borde-prioridad-alta',
                            default => '',
                        };
                        ?>
                        <div class="tarea-card <?= $clasePrioridad ?>">
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
                            <div class="acciones-tarea">
                    <form action="<?= site_url('tarea/editar') ?>" method="post">
                        <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" class="accion-btn editar">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </form>
                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

            <!-- Columna de Tareas Archivadas -->
            <div class="columna-tareas archivadas">
                <h3 class="titulo-columna">
                    <i class="bi bi-archive"></i> Archivadas
                </h3>
                
                <div class="tareas-container">
                    <?php if (empty($tareasArchivadas)): ?>
                        <div class="mensaje-vacio">
                            <p>No hay tareas archivadas.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($tareasArchivadas as $tarea): ?>
                            <?php
                            $prioridad = strtolower($tarea['prioridad']);
                            $clasePrioridad = match ($prioridad) {
                                'baja' => 'borde-prioridad-baja',
                                'normal' => 'borde-prioridad-normal',
                                'alta' => 'borde-prioridad-alta',
                                default => '',
                            };
                            ?>
                            <div class="tarea-card archivada <?= $clasePrioridad ?>">
                                <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                                <div class="tarea-descripcion"><?= esc($tarea['descripcion']) ?></div>
                                <div class="tarea-meta">
                                    <strong>Estado:</strong> 
                                    <span class="badge badge-archivada"><?= esc($tarea['estado']) ?></span>
                                </div>
                                <div class="tarea-meta">
                                    <strong>Prioridad:</strong> 
                                    <span class="badge badge-archivada"><?= esc($tarea['prioridad']) ?></span>
                                </div>
                                <div class="tarea-meta">
                                    <strong>Vence:</strong> <?= esc($tarea['fecha_vencimiento']) ?>
                                </div>
                                <?php if (!empty($tarea['fecha_recordatorio'])): ?>
                                    <div class="tarea-meta">
                                        <strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?>
                                    </div>
                                <?php endif; ?>
                                <div class="acciones-tarea">
                    <form action="<?= site_url('tarea/editar') ?>" method="post">
                        <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" class="accion-btn editar">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </form>
                </div>
                        
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animación de aparición de las tarjetas
        window.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.tarea-card').forEach((card, i) => {
                setTimeout(() => {
                    card.classList.add('show');
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, i * 80);
            });
        });

        // Modo oscuro
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