<?php
include('../includes/header.php');
if ($_SESSION['rol_id'] != 1) {
  header("Location:../index.php");
  die();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $usuario = new Usuario($cx);
  $u = $usuario->get_usuario($id);
}
if (isset($_POST['editar'])) {
  $rol = $_POST['rol'];

  if ($rol != 0) {
    if ($usuario->editar($id, $rol)) {
      $mensaje = "Actualizacion exitosa";
      header("Location:usuarios.php?mensaje=" . urlencode($mensaje));
    } else {
      $error = "No se puede actualizar el usuario";
    }
  } else {
    $error = "Error,elige el rol del usuario";
  }
}

if (isset($_POST['borrar'])) {

  if ($usuario->eliminar($id)) {
    $mensaje = "Se elimino el usuario";
    header("Location:usuarios.php?mensaje=" . urlencode($mensaje));
  } else {
    $error = "No se pudo eliminar el usuario";
  }
}
?>

<!-- Inicio de la sección de edición del usuario-->
<div class="container mt-5">
  <h1 class="text-center"></h1>
  <div class="container-fluid my-4">
    <h1 class="text-center">Editar usuario</h1>
    <div class="row">
      <div class="col-sm-6 offset-3">
        <div class="card">
          <div class="card-header">
            Modifica el rol del usuario
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <input type="hidden" name="id" id="id" value="1">
              <div class="mb-3">
                <label for="nombre" for="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $u->nombre ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="email" for="form-label">Correo</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= $u->email ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="rol" for="form-label">Rol</label>
                <select name="rol" id="rol" class="form-control">
                  <option value="0">Elige el rol</option>
                  <option value="1" <?= ($u->rol_id == 1 ? 'selected' : '') ?>>Administrador</option>
                  <option value="2" <?= $u->rol_id == 2 ? 'selected' : '' ?>>Registrado</option>
                </select>
              </div>
              <button type="submit" name="editar" class="btn btn-success float-start"><i class="bi bi-person-circle"></i>&nbsp;&nbsp;Editar</button>
              <button type="submit" name="borrar" class="btn btn-danger float-end"><i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FIn de la sección de edición del usuario-->
<?php
include('../includes/footer.php');
?>