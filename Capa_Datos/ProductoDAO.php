<?php
require_once 'Conexion.php';
require_once '../modelos/Producto.php';

class ProductoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstancia()->getConexion();
    }

    public function listarProductos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->conexion->query($sql);
        $productos = [];
        foreach ($stmt->fetchAll() as $fila) {
            $producto = new Producto($fila['id'], $fila['nombre'], $fila['stock'], $fila['precio']);
            $productos[] = $producto;
        }
        return $productos;
    }

    public function agregarProducto($nombre, $stock, $precio) {
        $sql = "INSERT INTO productos (nombre, stock, precio) VALUES (:nombre, :stock, :precio)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':stock' => $stock,
            ':precio' => $precio
        ]);
    }
    public function eliminar($id) {
            $sql = "DELETE FROM productos WHERE id = ?";
            $stmt = $this->conexion->prepare($sql); 
            return $stmt->execute([$id]);
    }
    public function buscarPorId($id) {
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([$id]);
    $fila = $stmt->fetch();

            if ($fila) {
                return new Producto($fila['id'], $fila['nombre'], $fila['stock'], $fila['precio']);
            }
            return null;
        }

    public function actualizar($id, $nombre, $stock, $precio) {
        $sql = "UPDATE productos SET nombre = ?, stock = ?, precio = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$nombre, $stock, $precio, $id]);
    }
}
?>