<?php
class Producto {
    private $id;
    private $nombre;
    private $stock;
    private $precio;

    public function __construct($id = null, $nombre, $stock, $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->stock = $stock;
        $this->precio = $precio;
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getStock() {
        return $this->stock;
    }
    public function getPrecio() {
        return $this->precio;
    }

    // Setters 
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setStock($stock) {
        $this->stock = $stock;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
}