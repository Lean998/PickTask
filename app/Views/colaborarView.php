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
            background: linear-gradient(to right, #fef5e6,rgb(252, 237, 197));
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            border-bottom: 3px solid #FFA600;
            padding: 0.8rem 1rem;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .btn-volver {
            background: linear-gradient(135deg, #ff7a18, #ffae00);
            color: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
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

        .btn-volver:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 14px rgba(255, 140, 0, 0.4);
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

        /* Estilos para modo oscuro */
        body.dark-mode {
            background: linear-gradient(to top, #1a1a1a, #333);
            color: #f0f0f0;
        }

        body.dark-mode .navbar {
            background: linear-gradient(to right, #2c2c2c, #3d3d3d);
            border-bottom-color: #FF8C00;
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a href="javascript:history.back()" class="btn-volver">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
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

    <script>
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