<?php
include('../includes/header.php');
$articulos = new Articulo($cx);
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

<!-- Inicio de la tabla articulos-->
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-6 ">
      <h3>Listado de articulos</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <a href="<?= RUTA_ADMIN ?>gestion_articulo.php?id=-1&op=1" class="btn btn-primary">Agregar Articulo</a>
    </div>
  </div>
  <div class="row mt-3 caja">
    <table id="tblArticulos" class="display">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titulo</th>
          <th>Imágen</th>
          <th>Texto</th>
          <?php if ($_SESSION['rol_id'] == 1) : ?>
            <th>Autor</th>
          <?php endif; ?>
          <th>Fecha de creación</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($articulos->listar($_SESSION['id'], $_SESSION['rol_id']) as $articulo) : ?>
          <tr>
            <th> <?= $articulo->id ?></th>
            <td><?= $articulo->titulo ?></td>
            <td>><img class="img-fluid" style="width: 180px;" src="../img/articulo <?= $articulo->imagen ?>"></td>
            <td><?= $articulo->texto ?></td>
            <?php if ($_SESSION['rol_id'] == 1) : ?>
              <td><?= $articulo->autor ?></td>
            <?php endif; ?>
            <td><?= $articulo->fecha_creacion ?></td>
            <td><a class="btn btn-warning" href="<?= RUTA_ADMIN ?>gestion_articulo.php?id=<?= $articulo->id ?>&op=2"><i class=" bi bi-pencil-fill"> </i></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>

<!-- Fin de la tabla articulos-->
<?php
include('../includes/footer.php');
?>

