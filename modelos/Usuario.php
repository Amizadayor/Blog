<?php
class Usuario
{
    private $cx;
    private $table = 'usuarios';
    public function __construct($db)
    {
        $this->cx = $db;
    }
    public function registrar($nombre, $email, $password)
    {
        $pass = md5($password);
        $qry = " insert into " . $this->table . "(nombre, email, password, rol_id) values ( :name , :email , :pass , 2)";
        $st = $this->cx->prepare($qry);

        $st->bindParam(":name", $nombre, PDO::PARAM_STR);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->bindParam(":pass", $pass, PDO::PARAM_STR);
        if ($st->execute()) {
            return true;
        }
        printf("Error $st\n", $st->error);
        $st->close();
        return false;
    }
    public function validar_email($email)
    {
        $qry = "select * from " . $this->table . " where email = :email";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->execute();
        if ($st->fetch(PDO::FETCH_ASSOC)) {
            return false;
        } else {
            return true;
        }
    }
    public function acceder($email, $password)
    {
        $pass = md5($password);
        $qry = "select * from " . $this->table . " where email = :email and password = :pass";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->bindParam(":pass", $pass, PDO::PARAM_STR);
        $st->execute();
        if ($st->fetch(PDO::FETCH_ASSOC)) {
            return true;
        } else {
            return false;
        }
    }

    public function listar()
    {
        $qry  = "select * from view_" . $this->table;
        $st = $this->cx->prepare($qry);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_usuario($id)
    {
        $qry  = "select * from " . $this->table . " where id = :id";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public function editar($id, $rol)
    {
        $qry  = " update " . $this->table . " set rol_id=:rol where id = :id";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":rol", $rol, PDO::PARAM_INT);
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
    public function usuario_email($email)
    {
        $qry  = "select * from " . $this->table . " where email = :email";
        $st = $this->cx->prepare($qry);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }
}
