<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <title>Detalles de la Tarea</title>
    <style>
        :root {
            --color-rojo: #FF6B6B;
            --color-azul: #1E90FF;
            --color-verde: #28A745;
            --color-naranja: #FFA600;
            --color-celeste: #00C1FF;
            --color-gris: #6C757D;
            --color-violeta: #8A2BE2;
        }
        
        body {
            background: linear-gradient(to bottom, #FFA600, #f0f0f0); 
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
            font-size: 0.9rem;
            margin: 0;
            min-height: 100vh;
        }
        

        .borde-prioridad-baja {
            border-top-color: #22c55e !important; 
            border-bottom-color: #22c55e !important;
        }

        .borde-prioridad-normal {
            border-top-color: #FFD700 !important; 
            border-bottom-color: #FFD700 !important;
        }

        .borde-prioridad-alta {
            border-top-color: #ef4444 !important;
            border-bottom-color: #ef4444 !important;
        }
        
        .tarea-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            padding: 25px 30px;
            margin-bottom: 30px;
            transition: all 0.2s ease-in-out;
            position: relative;
        }

        .tarea-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header-section {
            margin-bottom: 30px;
        }
        
        .subtareas-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .subtarea-card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 20px;
            border-top: 4px solid;
            border-bottom: 4px solid;
            transition: transform 0.2s;
            background-color: white;
            position: relative;
        }
        
        .subtarea-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .badge-prioridad {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .badge-prioridad.alta {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .badge-prioridad.media {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-prioridad.baja {
            background-color: #d4edda;
            color: #155724;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .info-item i {
            width: 24px;
            text-align: center;
            margin-right: 10px;
            color: #6c757d;
        }
        
        .responsables-list {
            margin-top: 15px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        
        .responsable-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 8px;
        }
        
        .btn-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-left: 5px;
        }
        
        .color-option {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            border: 1px solid #ddd;
        }
        
        .colaboradores-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .empty-state i {
            font-size: 50px;
            margin-bottom: 15px;
            color: #dee2e6;
        }
        
        .modal-custom {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content-custom {
            background: white;
            max-width: 500px;
            width: 90%;
            border-radius: 10px;
            padding: 20px;
        }

        .prioridad-icono {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 24px;
            height: 24px;
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

        .is-invalid {
        border-color: #dc3545 !important;
    }
    .is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.9rem;
        margin-top: -0.5rem;
        margin-bottom: 1rem;
    }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header-section">
            
        
        
        <h1><i class="fas fa-tasks me-2"></i> Detalles de la Tarea</h1>

        </div>
        <a href="http://localhost/PickTask/public/" class="btn-volver">
                <i class="bi bi-arrow-left"></i> Volver
        </a>
        
        

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
        } ?>
        <?php if (!empty($tarea)): ?>
            <?php
            $prioridad = strtolower($tarea['prioridad']);
            $clasePrioridad = match ($prioridad) {
                'baja' => 'borde-prioridad-baja',
                'media' => 'borde-prioridad-normal',
                'normal' => 'borde-prioridad-normal',
                'alta' => 'borde-prioridad-alta',
                default => '',
            };
            

            switch ($prioridad) {
                case 'alta':
                    $colorIcono = '#E53935'; 
                    break;
                case 'media':
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
     style="border-top: 4px solid <?= esc(obtenerColoresTarea($tarea['color'])[0]); ?>;
            border-bottom: 4px solid <?= esc(obtenerColoresTarea($tarea['color'])[0]); ?>;
            background-color: <?= esc(obtenerColoresTarea($tarea['color'])[1]); ?>;">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?= $colorIcono ?>" 
                    class="bi bi-exclamation-diamond-fill prioridad-icono"
                    viewBox="0 0 16 16">
                    <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h2><?= esc($tarea['titulo']) ?></h2>
                    <span class="badge badge-prioridad <?= esc(strtolower($tarea['prioridad'])) ?>">
                        <?= esc($tarea['prioridad']) ?>
                    </span>
                </div>
                
                <p class="text-muted mb-4"><?= esc($tarea['descripcion']) ?></p>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="fas fa-calendar-check"></i>
                            <div>
                                <small class="text-muted">Fecha de vencimiento</small>
                                <div><?= esc($tarea['fecha_vencimiento']) ?></div>
                            </div>
                        </div>
                        
                        <?php if ($tarea['fecha_recordatorio']): ?>
                        <div class="info-item">
                            <i class="fas fa-bell"></i>
                            <div>
                                <small class="text-muted">Recordatorio</small>
                                <div><?= esc($tarea['fecha_recordatorio']) ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-6">
    <div class="info-item" >
        <i class="fas fa-tag"></i>
        <div>
            <small class="text-muted">Estado</small>
            <div>
                <span class="badge bg-secondary"><?= esc($tarea['estado']) ?></span>
            </div>
        </div>
        
    </div>
</div>

        
                    
                          
                </div>
                
                <?php if (!empty($colaboradores_disponibles)): ?>
                    <div class="colaboradores-section mt-4">
                        <h5><i class="fas fa-users me-2"></i> Colaboradores disponibles (<?= count($colaboradores_disponibles) ?>)</h5>
                        
                        <div class="row mt-3">
                            <?php foreach ($colaboradores_disponibles as $colab): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                        </div>
                                        <div>
                                            <strong><?= esc($colab['nombre']) ?></strong>
                                            <div class="text-muted small"><?= esc($colab['correo']) ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-muted mt-3"><em>No hay colaboradores disponibles para asignar.</em></p>
                <?php endif; ?>
                
                <div class="d-flex gap-2 mt-4">
                    <button onclick="mostrarModalInvitar()" class="btn btn-success">
                        <i class="fas fa-envelope me-1"></i> Invitar por correo
                    </button>
                    <button onclick="mostrarModalSubtarea()" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Crear subtarea
                    </button>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                No se encontró la tarea solicitada.
            </div>
        <?php endif; ?>
        
        <h3 class="mb-4"><i class="fas fa-list-ul me-2"></i> Subtareas</h3>
        
        <?php if (!empty($subtareas)): ?>
            <div class="subtareas-container">
                <?php foreach ($subtareas as $sub): ?>
                    <?php 
                    [$borde, $fondo] = obtenerColoresTarea($sub['color']);
                    
                    $prioridadSubtarea = strtolower($sub['prioridad']);
                    $clasePrioridadSubtarea = match ($prioridadSubtarea) {
                        'baja' => 'borde-prioridad-baja',
                        'media' => 'borde-prioridad-normal',
                        'normal' => 'borde-prioridad-normal',
                        'alta' => 'borde-prioridad-alta',
                        default => '',
                    };
                    
                 
                    switch ($prioridadSubtarea) {
                        case 'alta':
                            $colorIconoSubtarea = '#E53935';
                            break;
                        case 'media':
                        case 'normal':
                            $colorIconoSubtarea = '#FFB300'; 
                            break;
                        case 'baja':
                            $colorIconoSubtarea = '#43A047'; 
                            break;
                        default:
                            $colorIconoSubtarea = '#BDBDBD'; 
                    }
                    ?>
                    
                    <div class="subtarea-card <?= $clasePrioridadSubtarea ?>" style="border-top-color: <?= $borde ?>; border-bottom-color: <?= $borde ?>; background-color: <?= $fondo ?>">
                  
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="<?= $colorIconoSubtarea ?>" 
                            class="bi bi-exclamation-diamond-fill prioridad-icono"
                            viewBox="0 0 16 16">
                            <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h4><?= esc($sub['titulo']) ?></h4>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary btn-icon" 
                                    data-bs-toggle="modal" data-bs-target="#editarSubtareaModal<?= $sub['id'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-icon btn-eliminar" 
    data-id="<?= $sub['id'] ?>"
    data-tarea-id="<?= esc($tarea['id']) ?>">
    <i class="fas fa-trash"></i>
</button>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3"><?= esc($sub['descripcion']) ?></p>
                        
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <div>
                                <small class="text-muted">Estado</small>
                                <div><span class="badge bg-secondary"><?= esc($sub['estado']) ?></span></div>
                            </div>
                            
                            <div>
                                <small class="text-muted">Prioridad</small>
                                <div>
                                    <span class="badge badge-prioridad <?= esc(strtolower($sub['prioridad'])) ?>">
                                        <?= esc($sub['prioridad']) ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div>
                                <small class="text-muted">Vencimiento</small>
                                <div><?= esc($sub['fecha_vencimiento']) ?></div>
                            </div>
                        </div>
                        
                        <?php if ($sub['fecha_recordatorio']): ?>
                            <div class="mb-3">
                                <small class="text-muted">Recordatorio</small>
                                <div><?= esc($sub['fecha_recordatorio']) ?></div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="responsables-list">
                            <h6><i class="fas fa-user-friends me-1"></i> Responsables</h6>
                            
                            <?php if (!empty($sub['responsables'])): ?>
                                <?php foreach ($sub['responsables'] as $usuario): ?>
                                    <div class="responsable-item">
                                        <div>
                                            <strong><?= esc($usuario['nombre']) ?></strong>
                                            <div class="text-muted small"><?= esc($usuario['correo']) ?></div>
                                        </div>
                                        <form id="formQuitarResponsable_<?= esc($sub['id'])?>_<?= esc($usuario['id'])?>" onsubmit="quitarResponsable(event, <?= esc($sub['id'])?>, <?= esc($usuario['id'])?>, <?= esc($tarea['id'])?>, '<?= esc($usuario['nombre'])?>')">
    <input type="hidden" name="subtarea_id" value="<?= esc($sub['id']) ?>">
    <input type="hidden" name="usuario_id" value="<?= esc($usuario['id']) ?>">
    <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
    <button type="submit" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-times"></i>
    </button>
</form>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-light">
                                    <i class="fas fa-info-circle me-1"></i> Sin responsables asignados
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($colaboradores_disponibles)): ?>
                                <button type="button" class="btn btn-sm btn-outline-success w-100 mt-2" 
                                    onclick="abrirModal(<?= esc($sub['id']) ?>)">
                                    <i class="fas fa-plus me-1"></i> Agregar responsable
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                 
                    <div class="modal fade" id="editarSubtareaModal<?= $sub['id'] ?>" tabindex="-1" aria-labelledby="editarSubtareaLabel<?= $sub['id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditarSubtarea<?= $sub['id'] ?>" action="<?= base_url('subtarea/editar/' . $sub['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarSubtareaLabel<?= $sub['id'] ?>">Editar Subtarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control" name="titulo" id="tituloEditSubtarea<?= $sub['id'] ?>" 
                               value="<?= esc($sub['titulo']) ?>" required>
                        <div class="invalid-feedback" id="titulo-error-edit<?= $sub['id'] ?>"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcionEditSubtarea<?= $sub['id'] ?>" 
                                  required><?= esc($sub['descripcion']) ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select" required>
                                <option value="creada" <?= $sub['estado'] === 'creada' ? 'selected' : '' ?>>Creada</option>
                                <option value="en_proceso" <?= $sub['estado'] === 'en_proceso' ? 'selected' : '' ?>>En proceso</option>
                                <option value="completada" <?= $sub['estado'] === 'completada' ? 'selected' : '' ?>>Completada</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Prioridad</label>
                            <select name="prioridad" class="form-select" required>
                                <option value="baja" <?= $sub['prioridad'] === 'baja' ? 'selected' : '' ?>>Baja</option>
                                <option value="normal" <?= $sub['prioridad'] === 'normal' ? 'selected' : '' ?>>Normal</option>
                                <option value="alta" <?= $sub['prioridad'] === 'alta' ? 'selected' : '' ?>>Alta</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de vencimiento</label>
                            <input type="date" class="form-control" name="fecha_vencimiento" 
                                   id="fechaVencimientoEdit<?= $sub['id'] ?>"
                                   value="<?= esc($sub['fecha_vencimiento'] ?? $tarea['fecha_vencimiento']) ?>">
                            <div class="invalid-feedback" id="fecha-vencimiento-error-edit<?= $sub['id'] ?>"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de recordatorio</label>
                            <input type="date" class="form-control" name="fecha_recordatorio" 
                                   id="fechaRecordatorioEdit<?= $sub['id'] ?>"
                                   value="<?= esc($sub['fecha_recordatorio'] ?? $tarea['fecha_recordatorio']) ?>">
                            <div class="invalid-feedback" id="fecha-recordatorio-error-edit<?= $sub['id'] ?>"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <select name="color" class="form-select">
                            <?php $colores = ['rojo', 'azul', 'verde', 'naranja', 'celeste', 'gris', 'violeta']; ?>
                            <?php foreach ($colores as $color): ?>
                                <option value="<?= $color ?>" <?= $sub['color'] === $color ? 'selected' : '' ?>>
                                    <span class="color-option" style="background-color: <?= obtenerColoresTarea($color)[1] ?>"></span>
                                    <?= ucfirst($color) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>No hay subtareas registradas</h4>
                <p>Puedes crear una nueva subtarea usando el botón superior</p>
                <button onclick="mostrarModalSubtarea()" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-1"></i> Crear primera subtarea
                </button>
            </div>
        <?php endif; ?>
    </div>

    <div id="modalAgregarResponsable" class="modal-custom">
    <div class="modal-content-custom">
        <h3><i class="fas fa-user-plus me-2"></i> Agregar responsable</h3>
        <form id="formAgregarResponsable">
            <?= csrf_field() ?>
            <input type="hidden" name="subtarea_id" id="modalSubtareaId">
            <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
            
            <div class="mb-3">
                <label for="usuario_id" class="form-label">Seleccionar colaborador:</label>
                <select name="usuario_id" id="usuario_id" class="form-select" required>
                    <?php foreach ($colaboradores_disponibles as $colab): ?>
                        <option value="<?= esc($colab['id']) ?>"><?= esc($colab['nombre']) ?> (<?= esc($colab['correo']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Asignar</button>
            </div>
        </form>
        <div id="respuestaAjax" class="mt-3"></div>
    </div>
</div>

    <div id="modalInvitarCorreo" class="modal-custom">
    <div class="modal-content-custom">
        <h3><i class="fas fa-envelope me-2"></i> Invitar colaborador</h3>
        <form id="formInvitarCorreo">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo del colaborador:</label>
                <input type="email" name="correo" id="correo" class="form-control" placeholder="ejemplo@gmail.com" required>
                <div id="error-correo" class="invalid-feedback"></div>
            </div>
            <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalInvitar()">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btnEnviarInvitacion">
                    <span id="btnText">Enviar invitación</span>
                    <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>
</div>

    <div id="modalCrearSubtarea" class="modal-custom">
    <div class="modal-content-custom">
        <h3><i class="fas fa-plus-circle me-2"></i> Crear nueva subtarea</h3>
        <form id="formCrearSubtarea" action="<?= base_url('subtarea/crear') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" id="tituloSubtarea" class="form-control" required>
                <div id="titulo-error" class="invalid-feedback" style="display: none;"></div>
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea name="descripcion" id="descripcionSubtarea" rows="3" class="form-control"></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Estado:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" id="estadoCreada" value="creada" checked>
                        <label class="form-check-label" for="estadoCreada">Creada (Recomendada)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" id="estadoEnProceso" value="en_proceso">
                        <label class="form-check-label" for="estadoEnProceso">En proceso</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha de vencimiento</label>
                        <input type="date" class="form-control" name="fecha_vencimiento" id="fechaVencimientoSubtarea"
                               value="<?= esc($tarea['fecha_vencimiento']) ?>">
                        <div id="fecha-vencimiento-error" class="invalid-feedback" style="display: none;"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha de recordatorio</label>
                        <input type="date" class="form-control" name="fecha_recordatorio" id="fechaRecordatorioSubtarea"
                               value="<?= esc($tarea['fecha_recordatorio']) ?>">
                        <div id="fecha-recordatorio-error" class="invalid-feedback" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="prioridad" class="form-label">Prioridad:</label>
                    <select name="prioridad" id="prioridadSubtarea" class="form-select" required>
                        <option value="alta">Alta</option>
                        <option value="media" selected>Media</option>
                        <option value="baja">Baja</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="color" class="form-label">Color:</label>
                <select name="color" id="colorSubtarea" class="form-select" required>
                    <option value="rojo">Rojo</option>
                    <option value="azul">Azul</option>
                    <option value="verde">Verde</option>
                    <option value="naranja">Naranja</option>
                    <option value="celeste">Celeste</option>
                    <option value="gris">Gris</option>
                    <option value="violeta">Violeta</option>
                </select>
            </div>
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalSubtarea()">Cancelar</button>
                <button type="submit" class="btn btn-success">Crear subtarea</button>
            </div>
        </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


        function abrirModal(subtareaId) {
    document.getElementById('modalSubtareaId').value = subtareaId;
    document.getElementById('modalAgregarResponsable').style.display = 'flex';
    document.getElementById('respuestaAjax').innerHTML = ''; 
}

function cerrarModal() {
    document.getElementById('modalAgregarResponsable').style.display = 'none';
}

document.getElementById('formAgregarResponsable').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const respuestaDiv = document.getElementById('respuestaAjax');
    
    fetch('<?= base_url('subtarea/agregarResponsable') ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest' 
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            respuestaDiv.innerHTML = `
                <div class="alert alert-success">
                    Responsable asignado correctamente
                </div>
            `;
            
            setTimeout(() => {
                cerrarModal();
                window.location.reload();
            }, 1500);
        } else {
            respuestaDiv.innerHTML = `
                <div class="alert alert-danger">
                    ${data.message || 'Error al asignar responsable'}
                </div>
            `;
        }
    })
    .catch(error => {
        respuestaDiv.innerHTML = `
            <div class="alert alert-danger">
                Error en la comunicación con el servidor
            </div>
        `;
        console.error('Error:', error);
    });
});

        function mostrarModalInvitar() {
            document.getElementById('modalInvitarCorreo').style.display = 'flex';
        }

        function cerrarModalInvitar() {
            document.getElementById('modalInvitarCorreo').style.display = 'none';
        }

        function mostrarModalSubtarea() {
            document.getElementById('modalCrearSubtarea').style.display = 'flex';
        }

        function cerrarModalSubtarea() {
            document.getElementById('modalCrearSubtarea').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formCrearSubtarea');
    const tituloInput = document.getElementById('tituloSubtarea');
    const fechaVencimientoInput = document.getElementById('fechaVencimientoSubtarea');
    const fechaRecordatorioInput = document.getElementById('fechaRecordatorioSubtarea');
    
    const today = new Date().toISOString().split('T')[0];
    if (fechaVencimientoInput) fechaVencimientoInput.min = today;
    if (fechaRecordatorioInput) fechaRecordatorioInput.min = today;
    
    tituloInput.addEventListener('input', validateTitulo);
    if (fechaVencimientoInput) fechaVencimientoInput.addEventListener('change', validateFechas);
    if (fechaRecordatorioInput) fechaRecordatorioInput.addEventListener('change', validateFechas);
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const isTituloValid = validateTitulo();
        const isFechasValid = validateFechas();
        
        if (isTituloValid && isFechasValid) {
            submitForm();
        }
    });
    
    function validateTitulo() {
        const titulo = tituloInput.value.trim();
        const errorElement = document.getElementById('titulo-error');
        
        if (titulo.length < 3) {
            tituloInput.classList.add('is-invalid');
            errorElement.textContent = 'El título debe tener al menos 3 caracteres.';
            errorElement.style.display = 'block';
            return false;
        }
        
        tituloInput.classList.remove('is-invalid');
        errorElement.style.display = 'none';
        return true;
    }
    
    function validateFechas() {
        const fechaVencimiento = fechaVencimientoInput ? fechaVencimientoInput.value : null;
        const fechaRecordatorio = fechaRecordatorioInput ? fechaRecordatorioInput.value : null;
        let isValid = true;
        
        if (fechaVencimientoInput) {
            fechaVencimientoInput.classList.remove('is-invalid');
            document.getElementById('fecha-vencimiento-error').style.display = 'none';
        }
        
        if (fechaRecordatorioInput) {
            fechaRecordatorioInput.classList.remove('is-invalid');
            document.getElementById('fecha-recordatorio-error').style.display = 'none';
        }
        
        if (fechaVencimiento) {
            const vencimientoDate = new Date(fechaVencimiento);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (vencimientoDate < today) {
                fechaVencimientoInput.classList.add('is-invalid');
                document.getElementById('fecha-vencimiento-error').textContent = 'La fecha de vencimiento no puede ser anterior a hoy.';
                document.getElementById('fecha-vencimiento-error').style.display = 'block';
                isValid = false;
            }
        }
        
        if (fechaRecordatorio && fechaVencimiento) {
            const recordatorioDate = new Date(fechaRecordatorio);
            const vencimientoDate = new Date(fechaVencimiento);
            
            if (recordatorioDate > vencimientoDate) {
                fechaRecordatorioInput.classList.add('is-invalid');
                document.getElementById('fecha-recordatorio-error').textContent = 'El recordatorio no puede ser posterior a la fecha de vencimiento.';
                document.getElementById('fecha-recordatorio-error').style.display = 'block';
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    function submitForm() {
        const form = document.getElementById('formCrearSubtarea');
        const formData = new FormData(form);

        const csrfName = '<?= csrf_token() ?>';
        const csrfHash = '<?= csrf_hash() ?>';
        formData.append(csrfName, csrfHash);

        fetch("<?= base_url('subtarea/crear') ?>", {
            method: "POST",
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("✅ Subtarea creada correctamente.");
                cerrarModalSubtarea();
                location.reload();
            } else {
                if (data.errors) {
                    let errorMessage = "Errores encontrados:\n";
                    for (const [field, error] of Object.entries(data.errors)) {
                        errorMessage += `- ${error}\n`;
                    }
                    alert(errorMessage);
                } else {
                    alert("❌ Error: " + (data.message || "No se pudo crear la subtarea."));
                }
            }
        })
        .catch(error => {
            console.error(error);
            alert("⚠️ Hubo un error al enviar los datos.");
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    <?php foreach($subtareas as $sub): ?>
    const formEdit<?= $sub['id'] ?> = document.getElementById('formEditarSubtarea<?= $sub['id'] ?>');
    if (formEdit<?= $sub['id'] ?>) {
        const tituloEdit<?= $sub['id'] ?> = document.getElementById('tituloEditSubtarea<?= $sub['id'] ?>');
        const fechaVencimientoEdit<?= $sub['id'] ?> = document.getElementById('fechaVencimientoEdit<?= $sub['id'] ?>');
        const fechaRecordatorioEdit<?= $sub['id'] ?> = document.getElementById('fechaRecordatorioEdit<?= $sub['id'] ?>');
        
        const today = new Date().toISOString().split('T')[0];
        if (fechaVencimientoEdit<?= $sub['id'] ?>) fechaVencimientoEdit<?= $sub['id'] ?>.min = today;
        if (fechaRecordatorioEdit<?= $sub['id'] ?>) fechaRecordatorioEdit<?= $sub['id'] ?>.min = today;
        

        tituloEdit<?= $sub['id'] ?>.addEventListener('input', function() {
            validateTituloEdit<?= $sub['id'] ?>();
        });
        
        if (fechaVencimientoEdit<?= $sub['id'] ?>) {
            fechaVencimientoEdit<?= $sub['id'] ?>.addEventListener('change', function() {
                validateFechasEdit<?= $sub['id'] ?>();
            });
        }
        
        if (fechaRecordatorioEdit<?= $sub['id'] ?>) {
            fechaRecordatorioEdit<?= $sub['id'] ?>.addEventListener('change', function() {
                validateFechasEdit<?= $sub['id'] ?>();
            });
        }
   
        formEdit<?= $sub['id'] ?>.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const isTituloValid = validateTituloEdit<?= $sub['id'] ?>();
            const isFechasValid = validateFechasEdit<?= $sub['id'] ?>();
            
            if (isTituloValid && isFechasValid) {
                submitEditForm<?= $sub['id'] ?>();
            }
        });
        
        function validateTituloEdit<?= $sub['id'] ?>() {
            const titulo = tituloEdit<?= $sub['id'] ?>.value.trim();
            const errorElement = document.getElementById('titulo-error-edit<?= $sub['id'] ?>');
            
            if (titulo.length < 3) {
                tituloEdit<?= $sub['id'] ?>.classList.add('is-invalid');
                errorElement.textContent = 'El título debe tener al menos 3 caracteres.';
                errorElement.style.display = 'block';
                return false;
            }
            
            tituloEdit<?= $sub['id'] ?>.classList.remove('is-invalid');
            errorElement.style.display = 'none';
            return true;
        }
        
        function validateFechasEdit<?= $sub['id'] ?>() {
            const fechaVencimiento = fechaVencimientoEdit<?= $sub['id'] ?> ? fechaVencimientoEdit<?= $sub['id'] ?>.value : null;
            const fechaRecordatorio = fechaRecordatorioEdit<?= $sub['id'] ?> ? fechaRecordatorioEdit<?= $sub['id'] ?>.value : null;
            let isValid = true;
            
            if (fechaVencimientoEdit<?= $sub['id'] ?>) {
                fechaVencimientoEdit<?= $sub['id'] ?>.classList.remove('is-invalid');
                document.getElementById('fecha-vencimiento-error-edit<?= $sub['id'] ?>').style.display = 'none';
            }
            
            if (fechaRecordatorioEdit<?= $sub['id'] ?>) {
                fechaRecordatorioEdit<?= $sub['id'] ?>.classList.remove('is-invalid');
                document.getElementById('fecha-recordatorio-error-edit<?= $sub['id'] ?>').style.display = 'none';
            }
            
            if (fechaVencimiento) {
                const vencimientoDate = new Date(fechaVencimiento);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (vencimientoDate < today) {
                    fechaVencimientoEdit<?= $sub['id'] ?>.classList.add('is-invalid');
                    document.getElementById('fecha-vencimiento-error-edit<?= $sub['id'] ?>').textContent = 'La fecha de vencimiento no puede ser anterior a hoy.';
                    document.getElementById('fecha-vencimiento-error-edit<?= $sub['id'] ?>').style.display = 'block';
                    isValid = false;
                }
            }
            
            if (fechaRecordatorio && fechaVencimiento) {
                const recordatorioDate = new Date(fechaRecordatorio);
                const vencimientoDate = new Date(fechaVencimiento);
                
                if (recordatorioDate > vencimientoDate) {
                    fechaRecordatorioEdit<?= $sub['id'] ?>.classList.add('is-invalid');
                    document.getElementById('fecha-recordatorio-error-edit<?= $sub['id'] ?>').textContent = 'El recordatorio no puede ser posterior a la fecha de vencimiento.';
                    document.getElementById('fecha-recordatorio-error-edit<?= $sub['id'] ?>').style.display = 'block';
                    isValid = false;
                }
            }
            
            return isValid;
        }
        
        function submitEditForm<?= $sub['id'] ?>() {
            const formData = new FormData(formEdit<?= $sub['id'] ?>);

            const csrfName = '<?= csrf_token() ?>';
            const csrfHash = '<?= csrf_hash() ?>';
            formData.append(csrfName, csrfHash);

            fetch(formEdit<?= $sub['id'] ?>.action, {
                method: "POST",
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("✅ Subtarea actualizada correctamente.");
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editarSubtareaModal<?= $sub['id'] ?>'));
                    if (modal) modal.hide();
                    location.reload();
                } else {
                    if (data.errors) {
                        let errorMessage = "Errores encontrados:\n";
                        for (const [field, error] of Object.entries(data.errors)) {
                            errorMessage += `- ${error}\n`;
                        }
                        alert(errorMessage);
                    } else {
                        alert("❌ Error: " + (data.message || "No se pudo actualizar la subtarea."));
                    }
                }
            })
            .catch(error => {
                console.error(error);
                alert("⚠️ Hubo un error al enviar los datos.");
            });
        }
    }
    <?php endforeach; ?>
});


$(document).ready(function() {
    $(document).on('click', '.btn-eliminar', function() {
        const subtareaId = $(this).data('id');
        const tareaId = $(this).data('tarea-id');
        
        if (confirm('¿Estás seguro de eliminar esta subtarea?')) {
            eliminarSubtarea(subtareaId, tareaId);
        }
    });

    function eliminarSubtarea(id, tarea_id) {
        $.ajax({
            url: '<?= base_url("subtarea/eliminar") ?>/' + id,
            method: 'POST',
            dataType: 'json',
            data: {
                tarea_id: tarea_id,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                    
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('Error en la petición: ' + xhr.responseText);
            }
        });
    }
});

$(document).ready(function() {
    $('#formInvitarCorreo').submit(function(e) {
        e.preventDefault();
        
        $('#btnEnviarInvitacion').prop('disabled', true);
        $('#spinner').removeClass('d-none');
        $('#btnText').text('Enviando...');
        
        $('#correo').removeClass('is-invalid');
        $('#error-correo').text('');
        
        $.ajax({
            url: '<?= base_url('tarea/enviarCorreo') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Invitación enviada correctamente');
                    cerrarModalInvitar();
                } else {
                    if (response.message) {
                        alert(response.message);
                    }
                    if (response.errors) {
                        if (response.errors.correo) {
                            $('#correo').addClass('is-invalid');
                            $('#error-correo').text(response.errors.correo);
                        }
                    }
                }
            },
            error: function(xhr, status, error) {
                alert('Error al enviar la invitación: ' + error);
            },
            complete: function() {
                $('#btnEnviarInvitacion').prop('disabled', false);
                $('#spinner').addClass('d-none');
                $('#btnText').text('Enviar invitación');
            }
        });
    });
});

function cerrarModalInvitar() {
    $('#modalInvitarCorreo').hide();
    $('#formInvitarCorreo')[0].reset();
}


function quitarResponsable(event, subtareaId, usuarioId, tareaId, nombreUsuario) {
    event.preventDefault();
    
    if (!confirm(`¿Quitar a ${nombreUsuario} de esta subtarea?`)) {
        return false;
    }
    
    $.ajax({
        url: '<?= base_url('subtarea/quitarResponsable') ?>',
        method: 'POST',
        data: {
            subtarea_id: subtareaId,
            usuario_id: usuarioId,
            tarea_id: tareaId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {

                Toastify({
                    text: `Se ha quitado a ${nombreUsuario} de la subtarea`,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28a745",
                }).showToast();
                
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
                
            } else {
                Toastify({
                    text: `Error: ${response.message}`,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                }).showToast();
            }
        },
        error: function(xhr, status, error) {
            Toastify({
                text: `Error en la petición: ${error}`,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#dc3545",
            }).showToast();
        }
    });
}

    </script>
</body>

</html>