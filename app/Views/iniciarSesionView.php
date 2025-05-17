<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PickTask</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: linear-gradient(to top, #FFA600, #f0f0f0);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .login-container {
      width: 100%;
      max-width: 400px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      position: relative;
    }

    .login-header {
      background: linear-gradient(to right, #FFA600, #FF8C00);
      padding: 25px;
      text-align: center;
      color: white;
      position: relative;
    }

    .login-header h1 {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .login-header p {
      font-size: 0.9rem;
      opacity: 0.9;
    }

    .login-logo {
      width: 60px;
      height: 60px;
      background-color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      color: #FFA600;
      font-size: 1.8rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .login-body {
      padding: 30px;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #555;
      font-size: 0.9rem;
    }

    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.3s;
    }

    .form-control:focus {
      border-color: #FFA600;
      box-shadow: 0 0 0 3px rgba(255, 166, 0, 0.2);
      outline: none;
    }

    .input-icon {
      position: absolute;
      right: 15px;
      top: 38px;
      color: #999;
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      background: linear-gradient(to right, #FFA600, #FF8C00);
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 10px;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
    }

    .login-footer {
      text-align: center;
      margin-top: 25px;
      font-size: 0.9rem;
      color: #666;
    }

    .login-footer a {
      color: #FFA600;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s;
    }

    .login-footer a:hover {
      color: #FF8C00;
      text-decoration: underline;
    }

    .tab-container {
      display: flex;
      margin-bottom: 25px;
      border-bottom: 2px solid #f0f0f0;
    }

    .tab {
      flex: 1;
      text-align: center;
      padding: 12px;
      font-weight: 600;
      cursor: pointer;
      color: #999;
      transition: all 0.3s;
      position: relative;
    }

    .tab.active {
      color: #FFA600;
    }

    .tab.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: #FFA600;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    .alert {
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
    }

    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
      border-left: 4px solid #dc3545;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border-left: 4px solid #28a745;
    }

    .alert i {
      margin-right: 10px;
      font-size: 1.2rem;
    }

    @media (max-width: 480px) {
      .login-container {
        max-width: 100%;
      }
      
      .login-body {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <div class="login-logo">
        <i class="bi bi-check-circle-fill"></i>
      </div>
      <h1>PickTask</h1>
      <p>Organiza tus tareas de manera eficiente</p>
    </div>

    <div class="login-body">
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
          <i class="bi bi-exclamation-triangle-fill"></i>
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <i class="bi bi-check-circle-fill"></i>
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <div class="tab-container">
        <div class="tab active" onclick="switchTab('login')">Iniciar Sesión</div>
        <div class="tab" onclick="switchTab('register')">Registrarse</div>
      </div>

      <!-- Login Form -->
      <div id="login-tab" class="tab-content active">
        <form action="<?= base_url('usuario/autenticar') ?>" method="post">
          <div class="form-group">
            <label for="login-correo">Correo electrónico</label>
            <input type="email" id="login-correo" name="correo" class="form-control" required>
            <i class="bi bi-envelope input-icon"></i>
          </div>

          <div class="form-group">
            <label for="login-clave">Contraseña</label>
            <input type="password" id="login-clave" name="clave" class="form-control" required>
            <i class="bi bi-lock input-icon"></i>
          </div>

          <button type="submit" class="btn-login">
            <i class="bi bi-box-arrow-in-right"></i> Ingresar
          </button>
        </form>

        <div class="login-footer">
          <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
      </div>

      <!-- Register Form -->
      <div id="register-tab" class="tab-content">
        <form action="<?= base_url('usuario/guardarRegistro') ?>" method="post">
          <div class="form-group">
            <label for="register-nombre">Nombre completo</label>
            <input type="text" id="register-nombre" name="nombre" class="form-control" required>
            <i class="bi bi-person input-icon"></i>
          </div>

          <div class="form-group">
            <label for="register-correo">Correo electrónico</label>
            <input type="email" id="register-correo" name="correo" class="form-control" required>
            <i class="bi bi-envelope input-icon"></i>
          </div>

          <div class="form-group">
            <label for="register-clave">Contraseña</label>
            <input type="password" id="register-clave" name="clave" class="form-control" required>
            <i class="bi bi-lock input-icon"></i>
          </div>

          <button type="submit" class="btn-login">
            <i class="bi bi-person-plus"></i> Registrarse
          </button>
        </form>

        <div class="login-footer">
          ¿Ya tienes cuenta? <a href="#" onclick="switchTab('login')">Inicia sesión</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function switchTab(tabName) {
      // Ocultar todos los contenidos de pestañas
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
      });

      // Mostrar el contenido de la pestaña seleccionada
      document.getElementById(`${tabName}-tab`).classList.add('active');

      // Actualizar las pestañas activas
      document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
      });
      
      // Activar la pestaña correspondiente
      const tabs = document.querySelectorAll('.tab');
      if (tabName === 'login') {
        tabs[0].classList.add('active');
      } else {
        tabs[1].classList.add('active');
      }
    }

    // Mostrar mensajes flash en la pestaña correcta
    document.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('register') === 'true') {
        switchTab('register');
      }
    });
  </script>
</body>
</html>