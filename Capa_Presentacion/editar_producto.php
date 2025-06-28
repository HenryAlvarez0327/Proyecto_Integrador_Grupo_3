<?php
require_once '../Capa_Negocios/InventarioControlador.php';

$controlador = new InventarioControlador();

if (!isset($_GET['id'])) {
    die("ID de producto no especificado.");
}

$id = intval($_GET['id']);
$producto = $controlador->obtenerProductoPorId($id);

if (!$producto) {
    die("Producto no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $stock = intval($_POST['stock']);
    $precio = floatval($_POST['precio']);

    $controlador->actualizarProducto($id, $nombre, $stock, $precio);
    header("Location: inventario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="inventario">
    <div class="contenedor-inventario">
        <h1>Editar Producto</h1>
        <form method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto->getNombre()) ?>" required>

            <label>Stock:</label>
            <input type="number" name="stock" value="<?= $producto->getStock() ?>" required>

            <label>Precio:</label>
            <input type="number" name="precio" value="<?= $producto->getPrecio() ?>" step="0.01" required>

            <button type="submit">Guardar Cambios</button>
        </form>
        <div style="text-align:center;">
            <a class="boton-redireccion" href="inventario.php">Volver</a>
        </div>
    </div>
</body>
</html>