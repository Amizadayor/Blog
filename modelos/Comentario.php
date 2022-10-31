<?php
class Comentario
{
    private $cx;
    private $table = 'comentarios';
    public function __construct($db)
    {
        $this->cx = $db;
    }
    public function listar($usuario_id, $rol_id)
    {
        $cad = "";
        if ($rol_id != 1) {
            $cad = " where prop_art = :usuario_id";
        }
        $qry  = "select * from view_" . $this->table . $cad;
        $st = $this->cx->prepare($qry);
        if ($rol_id != 1) {
            $st->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
        }
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }
    public function get_comentario($id)
    {
        $qry  = "select * from view_" . $this->table . " where id = :id";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }
    public function get_comentarios_articulo($id)
    {
        $qry  = "select * from view_" . $this->table . " where articulo_id = :id and estado = 1";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }
    public function editar($id, $estado)
    {
        $qry  = "update " . $this->table . " set estado=:estado where id = :id";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":estado", $estado, PDO::PARAM_INT);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        if ($st->execute()) {
            return true;
        }
        return false;
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
    public function crear($texto, $usuario_id, $articulo_id)
    {

        $qry = " insert into " . $this->table . " ( comentario, usuario_id, articulo_id, estado) values ( :texto , :usuario_id , :articulo_id, 0)";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":texto", $texto, PDO::PARAM_STR);
        $st->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
        $st->bindParam(":articulo_id", $articulo_id, PDO::PARAM_INT);
        if ($st->execute()) {
            return true;
        }
        printf("Error $st\n", $st->error);
        return false;
    }
}
