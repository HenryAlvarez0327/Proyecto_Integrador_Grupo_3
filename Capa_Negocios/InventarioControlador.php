<?php
require_once __DIR__ . '/../Capa_Datos/ProductoDAO.php';

class InventarioControlador {
    private $productoDAO;

    public function __construct() {
        $this->productoDAO = new ProductoDAO();
    }

    public function listarProductos() {
        return $this->productoDAO->listarProductos();
    }

    public function agregarProducto($nombre, $stock, $precio) {
       
        if (empty($nombre) || $stock < 0 || $precio <= 0) {
            return false;
        }
        return $this->productoDAO->agregarProducto($nombre, $stock, $precio);
    }
    public function eliminarProducto($id) {
    return $this->productoDAO->eliminar($id);
    }
    public function obtenerProductoPorId($id) {
    return $this->productoDAO->buscarPorId($id);
    }

    public function actualizarProducto($id, $nombre, $stock, $precio) {
        return $this->productoDAO->actualizar($id, $nombre, $stock, $precio);
    }
    
}
?>