<?php
include('../includes/header.php');
$comentarios = new Comentario($cx);
if (isset($_GET['mensaje'])) {
  $mensaje = $_GET['mensaje'];
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
<!-- Inicio de la tabla comentarios-->
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-6 ">
      <h3>Listado de comentarios</h3>
    </div>
  </div>
  <div class="row mt-2 caja">
    <table id="tblComentarios" class="display">
      <thead>
        <tr>
          <th>ID</th>
          <th>Comentario</th>
          <th>Usuario</th>
          <th>Articulo</th>
          <th>Estadon</th>
          <th>Fecha de creación</th>
          <th>Operaciones</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($comentarios->listar($_SESSION['id'], $_SESSION['rol_id']) as $comentario) : ?>
          <tr>
            <th><?= $comentario->id ?></th>
            <td><?= $comentario->comentario ?></td>
            <td><?= $comentario->autor ?>></td>
            <td><?= $comentario->titulo ?></td>
            <td><?= $comentario->estado == 0 ? 'PENDIENTE' : 'APROBADO' ?></td>
            <td><?= $comentario->fecha_creacion ?></td>
            <td><a class="btn btn-warning" href="<?= RUTA_ADMIN ?>editar_comentario.php?id=<?= $comentario->id ?>"><i class=" bi bi-pencil-fill"> </i></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>
<!-- Fin de la tabla comentarios-->
<?php
include('../includes/footer.php');
?>