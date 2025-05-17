<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Código de Invitación - PickTask</title>
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
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .navbar {
            background: transparent; 
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #FFA600;
            padding: 0.5rem 1rem;
            position: fixed;
            top: 0;
            width: 100%;
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

        .form-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2.5rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #FFA600;
        }

        .titulo-principal {
            text-align: center;
            color: #FFA600;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .titulo-principal::after {
            content: "";
            display: block;
            width: 80px;
            height: 3px;
            background: #FFA600;
            margin: 0.8rem auto;
            border-radius: 2px;
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

        .btn-enviar {
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
            margin-top: 0.5rem;
        }

        .btn-enviar:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }

        .alert {
            max-width: 500px;
            margin: 1rem auto;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: #28a745;
        }

        .alert-danger {
            border-left-color: #dc3545;
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

    <div class="container">
        <div class="form-container">
            <h1 class="titulo-principal">Ingresar Código</h1>
            
            <form action="<?= base_url('invitacion/verificar') ?>" method="post">
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código de invitación:</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" placeholder="xxxxxxxx" required>
                </div>
                
                <button type="submit" class="btn-enviar">
                    <i class="bi bi-check-circle"></i> Verificar Código
                </button>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>
</body>
</html>