<?php
class Basemysql
{
    private $servidor = 'localhost';
    private $db = 'blog';
    private $usuario = 'root';
    private $password = '';
    private $conexion;
    //conexion con la base de datos
    public function connect()
    {
        $this->conexion = null;
        try {
            $this->conexion = new PDO('mysql:host=' . $this->servidor . ';dbname=' . $this->db, $this->usuario, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexion:" . $e->getMessage();
        }
        return $this->conexion;
    }
}
