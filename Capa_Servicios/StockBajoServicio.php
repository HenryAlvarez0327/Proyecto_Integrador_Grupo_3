<?php
require_once '../Capa_Datos/conexion.php';

class StockBajoServicio {
    private $pdo;

    public function __construct() {
        $conexion = conexion::getInstancia();
        $this->pdo = $conexion->getConexion();
    }

    public function obtenerProductosBajoStock($limite = 5) {
        $sql = "SELECT * FROM productos WHERE stock < ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limite]);
        return $stmt->fetchAll();
    }
}