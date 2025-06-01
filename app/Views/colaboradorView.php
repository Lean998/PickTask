<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background-color: #f8f9fa;
            padding-bottom: 50px;
        }
        
        .header-section {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        .tarea-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .tarea-header {
            border-left: 5px solid;
            padding-left: 20px;
            margin-bottom: 20px;
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
        
        .subtareas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
            gap: 20px;
        }
        
        .subtarea-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 20px;
            border-left: 4px solid;
            transition: transform 0.2s;
        }
        
        .subtarea-card:hover {
            transform: translateY(-3px);
        }
        
        .subtarea-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .responsables-list {
            margin-top: 15px;
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
        }
        
        .empty-state i {
            font-size: 50px;
            margin-bottom: 15px;
            color: #dee2e6;
        }
    </style>
</head>
<body>
    <div class="header-section">
        <div class="container">
            <h1><i class="fas fa-tasks me-2"></i>Detalles de la Tarea</h1>
        </div>
    </div>
    
    <div class="container">
        <?php if (!empty($tarea)): ?>
            <div class="tarea-container" style="border-left-color: <?= esc($tarea['color']) ?>">
                <div class="tarea-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <h2><?= esc($tarea['titulo']) ?></h2>
                        <span class="badge badge-prioridad <?= esc(strtolower($tarea['prioridad'])) ?>">
                            <?= esc($tarea['prioridad']) ?>
                        </span>
                    </div>
                    <p class="text-muted"><?= esc($tarea['descripcion']) ?></p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="fas fa-calendar-check"></i>
                            <div>
                                <small class="text-muted">Fecha de vencimiento</small>
                                <div><?= esc($tarea['fecha_vencimiento']) ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-bell"></i>
                            <div>
                                <small class="text-muted">Recordatorio</small>
                                <div><?= $tarea['fecha_recordatorio'] ? esc($tarea['fecha_recordatorio']) : 'No establecido' ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="fas fa-tag"></i>
                            <div>
                                <small class="text-muted">Estado</small>
                                <div>
                                    <span class="badge bg-secondary"><?= esc($tarea['estado']) ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-palette"></i>
                            <div>
                                <small class="text-muted">Color</small>
                                <div>
                                    <span class="color-option" style="background-color: <?= esc($tarea['color']) ?>"></span>
                                    <?= ucfirst(esc($tarea['color'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4 gap-2">
                    <button onclick="mostrarModalInvitar()" class="btn btn-success">
                        <i class="fas fa-envelope me-1"></i> Invitar por correo
                    </button>
                    <button onclick="mostrarModalSubtarea()" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Crear subtarea
                    </button>
                </div>
                
                <?php if (!empty($colaboradores_disponibles)): ?>
                    <div class="colaboradores-section mt-4">
                        <h5><i class="fas fa-users me-2"></i>Colaboradores disponibles</h5>
                        <p class="text-muted">Puedes asignar estos colaboradores a las subtareas</p>
                        
                        <div class="row">
                            <?php foreach ($colaboradores_disponibles as $colab): ?>
                                <div class="col-md-6 mb-2">
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
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                No se encontró la tarea solicitada.
            </div>
        <?php endif; ?>
        
        <h3 class="mt-5 mb-4"><i class="fas fa-list-ul me-2"></i>Subtareas</h3>
        
        <?php if (!empty($subtareas)): ?>
            <div class="subtareas-grid">
                <?php foreach ($subtareas as $sub): ?>
                    <?php [$borde, $fondo] = obtenerColoresTarea($sub['color']); ?>
                    
                    <div class="subtarea-card" style="border-left-color: <?= $borde ?>">
                        <div class="subtarea-header">
                            <h4><?= esc($sub['titulo']) ?></h4>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary btn-icon" 
                                    data-bs-toggle="modal" data-bs-target="#editarSubtareaModal<?= $sub['id'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="<?= base_url('subtarea/eliminar/' . $sub['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-icon" 
                                        onclick="return confirm('¿Estás seguro de eliminar esta subtarea?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <p class="text-muted"><?= esc($sub['descripcion']) ?></p>
                        
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
                            
                            <div>
                                <small class="text-muted">Color</small>
                                <div>
                                    <span class="color-option" style="background-color: <?= $borde ?>"></span>
                                    <?= ucfirst(esc($sub['color'])) ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="responsables-list">
                            <h6><i class="fas fa-user-friends me-1"></i>Responsables</h6>
                            
                            <?php if (!empty($sub['responsables'])): ?>
                                <?php foreach ($sub['responsables'] as $usuario): ?>
                                    <div class="responsable-item">
                                        <div>
                                            <strong><?= esc($usuario['nombre']) ?></strong>
                                            <div class="text-muted small"><?= esc($usuario['correo']) ?></div>
                                        </div>
                                        <form action="<?= base_url('subtarea/quitarResponsable') ?>" method="post">
                                            <input type="hidden" name="subtarea_id" value="<?= esc($sub['id']) ?>">
                                            <input type="hidden" name="usuario_id" value="<?= esc($usuario['id']) ?>">
                                            <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('¿Quitar a <?= esc($usuario['nombre']) ?> de esta subtarea?')">
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
                            <form action="<?= base_url('subtarea/editar/' . $sub['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarSubtareaLabel<?= $sub['id'] ?>">Editar Subtarea</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Título</label>
                                            <input type="text" class="form-control" name="titulo" value="<?= esc($sub['titulo']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripción</label>
                                            <textarea class="form-control" name="descripcion" required><?= esc($sub['descripcion']) ?></textarea>
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
                                                    <option value="media" <?= $sub['prioridad'] === 'media' ? 'selected' : '' ?>>Media</option>
                                                    <option value="alta" <?= $sub['prioridad'] === 'alta' ? 'selected' : '' ?>>Alta</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Fecha de vencimiento</label>
                                                <input type="date" class="form-control" name="fecha_vencimiento" value="<?= esc($sub['fecha_vencimiento']) ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Fecha de recordatorio</label>
                                                <input type="date" class="form-control" name="fecha_recordatorio" value="<?= esc($sub['fecha_recordatorio']) ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Color</label>
                                            <select name="color" class="form-select">
                                                <?php $colores = ['rojo', 'azul', 'verde', 'naranja', 'celeste', 'gris', 'violeta']; ?>
                                                <?php foreach ($colores as $color): ?>
                                                    <option value="<?= $color ?>" <?= $sub['color'] === $color ? 'selected' : '' ?>>
                                                        <span class="color-option" style="background-color: <?= obtenerColoresTarea($color)[0] ?>"></span>
                                                        <?= ucfirst($color) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
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

    <div id="modalAgregarResponsable" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index:1000;">
        
    </div>

    <div id="modalInvitarCorreo" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index:1000;">
        
    </div>

    <div id="modalCrearSubtarea" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index:1000;">
        
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       
        function abrirModal(subtareaId) {
            document.getElementById('modalSubtareaId').value = subtareaId;
            document.getElementById('modalAgregarResponsable').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modalAgregarResponsable').style.display = 'none';
        }

        function mostrarModalInvitar() {
            document.getElementById('modalInvitarCorreo').style.display = 'block';
        }

        function cerrarModalInvitar() {
            document.getElementById('modalInvitarCorreo').style.display = 'none';
        }

        function mostrarModalSubtarea() {
            document.getElementById('modalCrearSubtarea').style.display = 'block';
        }

        function cerrarModalSubtarea() {
            document.getElementById('modalCrearSubtarea').style.display = 'none';
        }
    </script>
</body>
</html>