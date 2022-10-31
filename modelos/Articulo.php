<?php
class Articulo
{
    private $cx;
    private $table = 'articulos';
    public function __construct($db)
    {
        $this->cx = $db;
    }

    public function listar($usuario_id, $rol_id)
    {
        $cad = "";
        if ($rol_id != 1) {
            $cad = " where usuario_id = :usuario_id";
        }
        $qry  = "select * from view_" . $this->table . $cad;
        $st = $this->cx->prepare($qry);
        if ($rol_id != 1) {
            $st->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
        }
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_articulo($id)
    {
        $qry  = "select * from view_" . $this->table . " where id = :id";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public function eliminar($id)
    {
        $qry  = " delete from  " . $this->table . "  where id = :id";
        echo $qry;
        $st = $this->cx->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        try {
            if ($st->execute()) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function crear($titulo, $texto, $img, $usuario_id)
    {

        $qry = " insert into " . $this->table . " ( titulo, texto, imagen, usuario_id) values (:titulo, :texto, :imagen, :usuario_id)";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $st->bindParam(":texto", $texto, PDO::PARAM_STR);
        $st->bindParam(":imagen", $img, PDO::PARAM_STR);
        $st->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
        if ($st->execute()) {
            return true;
        }
        printf("Error $st\n", $st->error);
        return false;
    }

    public function editar($id, $titulo, $img, $texto)
    {
        $qry  = "update " . $this->table . " set titulo=:titulo, texto=:texto  where id=:id";
        if ($img != "") {
            $qry  = "update " . $this->table . " set titulo=:titulo, texto=:texto,  imagen=:img where id=:id";
        }
        $st = $this->cx->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $st->bindParam(":texto", $texto, PDO::PARAM_STR);
        if ($img != "") {
            $st->bindParam(":img", $img, PDO::PARAM_STR);
        }
        if ($st->execute()) {
            return true;
        }
        printf("Error $st\n", $st->error);
        return false;
    }
}
