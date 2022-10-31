<?php
include('../includes/header.php');
if ($_SESSION['rol_id'] != 1) {
  header("Location:../index.php");
  die();
}
$usuarios = new Usuario($cx);
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
<!-- Inicio de la tabla usuarios-->
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-6 ">
      <h3>Listado de usuarios</h3>
    </div>
  </div>
  <div class="row mt-2 caja">
    <table id="tblUsuarios" class="display">
      <thead>

        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Fecha de creación</th>
          <th>Operaciones</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($usuarios->listar() as $usuario) : ?>
          <tr>
            <th><?= $usuario->id ?></th>
            <td><?= $usuario->nombre ?></td>
            <td><?= $usuario->email ?></td>
            <td><?= $usuario->rol ?></td>
            <td><?= $usuario->fecha_creacion ?></td>
            <td><a class="btn btn-warning" href="<?= RUTA_ADMIN ?>editar_usuarios.php?id=<?= $usuario->id ?>"><i class=" bi bi-pencil-fill"> </i></a></td>
          </tr>
        <?php endforeach; ?>


      </tbody>
    </table>

  </div>
</div>
<!-- Fin de la tabla usuarios-->
<?php
include('../includes/footer.php');
?>