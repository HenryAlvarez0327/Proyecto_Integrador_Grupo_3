<?php
require_once '../Capa_Negocios/InventarioControlador.php';

$controlador = new InventarioControlador();

if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $controlador->eliminarProducto($idEliminar);
    header("Location: inventario.php"); 
    exit;
}
// Agregar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'] ?? '';
    $stock = intval($_POST['stock'] ?? 0);
    $precio = floatval($_POST['precio'] ?? 0);

    $resultado = $controlador->agregarProducto($nombre, $stock, $precio);
    $mensaje = $resultado ? "✅ Producto agregado correctamente." : "❌ Error al agregar producto.";
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $controlador->eliminarProducto($idEliminar);
}

$productos = $controlador->listarProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario - Tecnomóvil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="inventario">
<div class="contenedor-inventario">
    <h1>Inventario de Productos</h1>

    <?php if (isset($mensaje)): ?>
        <div class="mensaje <?= $resultado ? 'exito' : 'error' ?>">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Stock:</label>
        <input type="number" name="stock" min="0" required>

        <label>Precio:</label>
        <input type="number" name="precio" min="0" step="0.01" required>

        <button type="submit" name="agregar">Agregar Producto</button>
    </form>
    <h2>Lista de Productos</h2>

    <table>

        <thead>
        <tr>
            <th>ID</th><th>NOMBRE</th><th>STOCK</th><th>PRECIO</th><th>ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto->getId()) ?></td>
                    <td><?= htmlspecialchars($producto->getNombre()) ?></td>
                    <td><?= htmlspecialchars($producto->getStock()) ?></td>
                    <td>$<?= number_format($producto->getPrecio(), 2) ?></td>
                    <td>
                        <a href="editar_producto.php?id=<?= $producto->getId() ?>">Editar</a> |
                        <a href="?eliminar=<?= $producto->getId() ?>" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                        
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No hay productos registrados.</td></tr>
        <?php endif; ?>
        </tbody>
</div>
    </table>
    <div style="text-align: center; margin-top: 20px;">
    <a href="index.html" class="boton-redireccion">Volver al inicio</a>
</div>
</body>
</html>