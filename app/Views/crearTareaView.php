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
            background: linear-gradient(to right, #fef5e6,rgb(252, 237, 197));
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #FFA600;
            padding: 0.8rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-nav {
            align-items: center;
        }

        .navbar-nav .nav-link {
            color: #333;
            font-weight: 600;
            font-size: 1rem;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            bottom: 6px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background-color: #FFA600;
            transition: width 0.3s ease;
            border-radius: 10px;
        }

        .navbar-nav .nav-link:hover::after {
            width: 60%;
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

        /* Estilos para modo oscuro */
        body.dark-mode {
            background: linear-gradient(to top, #1a1a1a, #333);
            color: #f0f0f0;
        }

        body.dark-mode .form-container {
            background-color: #2c2c2c;
            color: #f0f0f0;
            border-color: #FF8C00;
        }

        body.dark-mode .form-label {
            color: #f0f0f0;
        }

        body.dark-mode .form-control {
            background-color: #3d3d3d;
            border-color: #555;
            color: #f0f0f0;
        }

        body.dark-mode .form-control:focus {
            border-color: #FF8C00;
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
        }

        .btn-volver {
            background: linear-gradient(135deg, #ff7a18, #ffae00);
            color: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            box-shadow: 0 4px 10px rgba(255, 140, 0, 0.3);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .btn-volver::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.2) 0%, transparent 80%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .btn-volver:hover::after {
            opacity: 1;
        }

        .btn-volver:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 14px rgba(255, 140, 0, 0.4);
        }

        /* 1. Botón de cuenta circular que se expande */
        .cuenta-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            transition: all 0.3s ease-in-out;
            padding: 0;
            white-space: nowrap;
            background-color: #FFA600;
            color: white;
            font-weight: bold;
            overflow: hidden;
            position: relative;
        }

        .cuenta-btn:hover {
            width: 160px;
            border-radius: 30px;
            padding: 0 12px;
        }

        .texto-cuenta {
            display: none;
            transition: opacity 0.2s ease-in-out;
            white-space: nowrap;
        }

        .cuenta-btn:hover .texto-cuenta {
            display: inline;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="javascript:history.back()" class="btn-volver">← Volver atrás</a>
            
            <ul class="navbar-nav mx-auto flex-row">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('tareas') ?>">Tablero</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('tareas/crear') ?>">Crear Tarea</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('tareas/historial') ?>">Historial</a></li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?= base_url('tareas/colaborar') ?>">Colaborar en Tarea</a>
                </li>
            </ul>

            <!-- Cuenta -->
            <div class="dropdown">
                <button class="btn cuenta-btn dropdown-toggle d-flex align-items-center justify-content-center gap-2" type="button" id="dropdownCuenta" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle icono-cuenta"></i>
                    <span class="texto-cuenta">Cuenta</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownCuenta">
                    <li><a class="dropdown-item" href="<?= site_url('usuario/editar') ?>">Editar perfil</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('logout') ?>">Cerrar sesión</a></li>
                </ul>
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
        // Función para seleccionar color
        function selectColor(color) {
            document.querySelectorAll('.color-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            document.querySelector(`.color-option[data-color="${color}"]`).classList.add('selected');
            document.getElementById('color').value = color;
        }

        // Función para modo oscuro (consistente con la otra vista)
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