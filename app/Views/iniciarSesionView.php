<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PickTask</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #4e008e, #9d4edd);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      display: flex;
      width: 80%;
      max-width: 1000px;
      height: 500px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
      overflow: hidden;
    }

    .login-box,
    .logo-box {
      width: 50%;
      padding: 40px;
    }

    .login-box {
      background-color: rgba(0, 0, 0, 0.25);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-box h2 {
      margin-bottom: 30px;
      font-size: 24px;
      text-align: center;
    }

    .login-box label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }

    .login-box input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: none;
    }

    .button-container {
      display: flex;
      justify-content: flex-end;
    }

    .login-box button {
      padding: 12px 24px;
      background-color: white;
      color: #4e008e;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-box button:hover {
      background-color: #ddd;
    }

    .logo-box {
      background-color: #e2e2e2;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .logo-box .logo {
      width: 250px;
      margin-bottom: -25px;
      filter: drop-shadow(0 25px 75px rgba(0, 0, 0, 1));

    }

    .logo-box .mascotas {
  width: 100%;
  border-radius: 1px;
  padding-bottom: 20px;
  filter: drop-shadow(0 25px 75px rgba(0, 0, 0, 0.5));
  margin-top: -100px; /* ← Sube la imagen */
}


    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        height: auto;
      }

      .login-box, .logo-box {
        width: 100%;
        padding: 20px;
      }

      .logo-box .mascotas {
        width: 100%;
      }

      .button-container {
        justify-content: center;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Iniciar Sesión</h2>
      <form action="<?= base_url('login/autenticar') ?>" method="post">
  <label for="usuario">Usuario:</label>
  <input type="text" id="usuario" name="usuario" value="veterinaria">

  <label for="password">Contraseña:</label>
  <input type="password" id="password" name="clave" value="veterinaria2025">

  <div class="button-container">
    <button type="submit">Ingresar</button>
  </div>
</form>
 
    </div>
  </div>
</body>
</html>



