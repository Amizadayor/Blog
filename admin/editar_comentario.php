<?php
include('../includes/header.php');
$comentario = new Comentario($cx);
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $c = $comentario->get_comentario($id);
}
if (isset($_POST['editar'])) {
  $estado = $_POST['estado'];
  if ($estado != -1) {
    if ($comentario->editar($id, $estado)) {
      $mensaje = "Actualizacion exitosa";
      header("Location:comentarios.php?mensaje=" . urlencode($mensaje));
    } else {
      $error = "No se puede actualizar el comentario";
    }
  } else {
    $error = "Error,elige el estado del comentario";
  }
}
if (isset($_POST['borrar'])) {

  if ($comentario->eliminar($id)) {
    $mensaje = "Se elimino el comentario";
    header("Location:comentarios.php?mensaje=" . urlencode($mensaje));
  } else {
    $error = "No se pudo eliminar el comentario";
  }
}
?>
<div class="row">
  <div class="col-sm-12">
    <?php if (isset($error)) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><?= $error ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <?php if (isset($mensaje)) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?= $mensaje ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
      </div>
    <?php endif; ?>
  </div>
</div>
<!-- Inicio de la edicion del comentario-->
<div class="container mt-5">
  <div class="container-fluid my-4">
    <div class="row">
      <div class="col-sm-6 offset-3">
        <div class="card">
          <div class="card-header">
            Editar Comentario
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="mb-3">
                <label for="texto" class="form-label">Texto</label>
                <textarea name="texto" id="texto" class="form-control" style="height:200px;" readonly><?= $c->comentario ?></textarea>
              </div>

              <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" name="usuario" id="usuario" value="<?= $c->autor ?>" class="form-control" readonly>
              </div>
              <div class="mb-3">
                <label for="estado" class="form-label">Cambiar Estado:</label>
                <select type="estado" name="estado" id="estado" class="form-control">
                  <option value="-1">--Seleccione un estado--</option>
                  <option value="1" <?= $c->estado == 1 ? 'selected' : '' ?>>--Aprobado--</option>
                  <option value="0" <?= $c->estado == 0 ? 'selected' : '' ?>>--Pendiente--</option>
                </select>
              </div>
              <br>
              <button tipe="submit" name="editar" class="btn btn-success float-start"><i class="bi bi-person-circle"></i>&nbsp;&nbsp;Aceptar Comentario</button>
              <button tipe="submit" name="borrar" class="btn btn-danger float-end"><i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;Borrar Comentario</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin de la edicion del comentario-->
  <?php
  include('../includes/footer.php');
  ?>