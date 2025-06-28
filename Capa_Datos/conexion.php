<?php
class conexion {
    private static $instancia = null;
    private $conexion;

    private $host = 'localhost';
    private $puerto = '33065';
    private $dbname = 'tecnomovil';
    private $usuario = 'root';
    private $clave = '';

    private function __construct() {
        try {
            $this->conexion = new PDO(
                "mysql:host={$this->host};port={$this->puerto};dbname={$this->dbname};charset=utf8",
                $this->usuario,
                $this->clave
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new conexion();
        }
        return self::$instancia;
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>