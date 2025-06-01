<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tarea</title>
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

        .titulo-principal {
            text-align: center;
            margin-top: 2rem;
            color: #FFA600;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .form-container {
            max-width: 700px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #FFA600;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #FFA600;
            box-shadow: 0 0 0 0.25rem rgba(255, 166, 0, 0.25);
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn-submit {
            background: linear-gradient(135deg, #FFA600, #FF8C00);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }

        .color-options {
            display: flex;
            gap: 10px;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: transform 0.2s, border-color 0.2s;
        }

        .color-option:hover {
            transform: scale(1.1);
        }

        .color-option.selected {
            border-color: #333;
            transform: scale(1.1);
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
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Tablero</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('tareas/crear') ?>">Crear</a></li>
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
        <h1 class="titulo-principal">Crear Nueva Tarea</h1>
        
        <div class="form-container">
            <form action="<?= base_url('tareas/guardar') ?>" method="post">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="prioridad" class="form-label">Prioridad:</label>
                    <select class="form-control" id="prioridad" name="prioridad">
                        <option value="baja">Baja</option>
                        <option value="normal" selected>Normal</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento:</label>
                    <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
                </div>
                
                <div class="mb-3">
                    <label for="fecha_recordatorio" class="form-label">Fecha de recordatorio (opcional):</label>
                    <input type="date" class="form-control" id="fecha_recordatorio" name="fecha_recordatorio">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Color (opcional):</label>
                    <div class="color-options">
                        <div class="color-option" style="background-color: #B00020;" data-color="rojo" onclick="selectColor('rojo')"></div>
                        <div class="color-option" style="background-color: #0D47A1;" data-color="azul" onclick="selectColor('azul')"></div>
                        <div class="color-option" style="background-color: #1B5E20;" data-color="verde" onclick="selectColor('verde')"></div>
                        <div class="color-option" style="background-color: #E65100;" data-color="naranja" onclick="selectColor('naranja')"></div>
                        <div class="color-option" style="background-color: #0288D1;" data-color="celeste" onclick="selectColor('celeste')"></div>
                        <div class="color-option" style="background-color: #424242;" data-color="gris" onclick="selectColor('gris')"></div>
                        <div class="color-option" style="background-color: #6A1B9A;" data-color="violeta" onclick="selectColor('violeta')"></div>
                    </div>
                    <input type="hidden" id="color" name="color">
                </div>
                
                <input type="hidden" name="tarea_id" value="1">
                
                <button type="submit" class="btn-submit">Guardar Tarea</button>
            </form>
        </div>
    </div>

    <script>
        function selectColor(color) {
            document.querySelectorAll('.color-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            document.querySelector(`.color-option[data-color="${color}"]`).classList.add('selected');
            document.getElementById('color').value = color;
        }

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const tituloInput = document.getElementById('titulo');
    const fechaVencimientoInput = document.getElementById('fecha_vencimiento');
    const fechaRecordatorioInput = document.getElementById('fecha_recordatorio');
    
    const today = new Date().toISOString().split('T')[0];
    fechaVencimientoInput.min = today;
    fechaRecordatorioInput.min = today;
    
    tituloInput.addEventListener('input', validateTitulo);
    fechaVencimientoInput.addEventListener('change', validateFechas);
    fechaRecordatorioInput.addEventListener('change', validateFechas);
    
    form.addEventListener('submit', function(e) {
        if (!validateTitulo() || !validateFechas()) {
            e.preventDefault();
        }
    });
    
    function validateTitulo() {
        const titulo = tituloInput.value.trim();
        const errorElement = document.getElementById('titulo-error');
        
        if (errorElement) {
            errorElement.remove();
        }
        
        if (titulo.length < 3) {
            const errorDiv = document.createElement('div');
            errorDiv.id = 'titulo-error';
            errorDiv.className = 'alert alert-danger mt-2';
            errorDiv.innerHTML = `
                <i class="bi bi-exclamation-triangle-fill"></i>
                El título debe tener al menos 3 caracteres.
            `;
            
            tituloInput.insertAdjacentElement('afterend', errorDiv);
            tituloInput.classList.add('is-invalid');
            return false;
        }
        
        tituloInput.classList.remove('is-invalid');
        return true;
    }
    
    function validateFechas() {
        const fechaVencimiento = fechaVencimientoInput.value;
        const fechaRecordatorio = fechaRecordatorioInput.value;
        let isValid = true;
        
        document.querySelectorAll('.fecha-error').forEach(el => el.remove());
        
        if (fechaVencimiento) {
            const vencimientoDate = new Date(fechaVencimiento);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (vencimientoDate < today) {
                showFechaError(fechaVencimientoInput, 'La fecha de vencimiento no puede ser anterior a hoy.');
                isValid = false;
            }
        }
        
        if (fechaRecordatorio && fechaVencimiento) {
            const recordatorioDate = new Date(fechaRecordatorio);
            const vencimientoDate = new Date(fechaVencimiento);
            
            if (recordatorioDate > vencimientoDate) {
                showFechaError(fechaRecordatorioInput, 'El recordatorio no puede ser posterior a la fecha de vencimiento.');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    function showFechaError(inputElement, message) {
        inputElement.classList.add('is-invalid');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger mt-2 fecha-error';
        errorDiv.innerHTML = `
            <i class="bi bi-exclamation-triangle-fill"></i>
            ${message}
        `;
        
        inputElement.insertAdjacentElement('afterend', errorDiv);
    }
});

const style = document.createElement('style');
style.textContent = `
    .is-invalid {
        border-color: #dc3545 !important;
    }
    .is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
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
`;
document.head.appendChild(style);

    </script>
</body>
</html>