<?php
session_start();

$usuario_valido = 'admin';
$clave_valida = '12345';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';

    if ($usuario === $usuario_valido && $clave === $clave_valida) {
        $_SESSION['usuario'] = $usuario;
        header('Location: inventario.php');
        exit;
    } else {
        $mensaje = '❌ Usuario o clave incorrectos';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Tecnomóvil</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: url('../Src/imgs/Fondo1.jpg') no-repeat center center;
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            text-align: center;
            width: 300px;
        }

        .login-container h2 {
            color: #0d6efd;
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .login-container button {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #084298;
        }

        .mensaje-error {
            color: red;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>

        <?php if ($mensaje): ?>
            <div class="mensaje-error"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html> 