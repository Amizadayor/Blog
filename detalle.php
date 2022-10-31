<?php
include('includes/header_front.php');
$articulos = new Articulo($cx);
$comentario = new Comentario($cx);
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $articulo = $articulos->get_articulo($id);
  $comentarios = $comentario->get_comentarios_articulo($id);
}
if (isset($_POST['enviarcomentario'])) {
  $texto = $_POST['texto'];
  if (!empty($texto) || $texto == '') {
    $articulo_id = $id;
    $usuario_id = $_SESSION['id'];
    if ($comentario->crear($texto, $usuario_id, $articulo_id)) {
      header("Location:index.php");
    } else {
      $error = "Error, no se puede agregar el comentario";
    }
  } else {
    $error = "Tiene que ir a algún comentario";
  }
}

?>
<!-- Inicio del detalle del articulo-->
<div class="container mt-5">
  <h1 class="text-center"></h1>
  <div class="container-fluid my-4">
    <div class="row">
      <div class="col-sm 12">
        <div class="card">
          <h1><?= $articulo->titulo ?></h1>
          <div class="card-header">
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="imh-fluid img-thumbnail"  src="img/articulos/<?=$articulo->imagen?>" alt="img/articulos <?= $articulo->imagen ?>">
            </div>
            <p class="card-text"><?= $articulo->texto ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Inicio para agregar comentarios-->
    <?php if (isset($_SESSION['auth'])) : ?>
      <div class="row my-5">
        <div class="col-sm-6 offset-3">
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
          <form action="" method="POST">
            <div class="mb-3">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text" class="form-control" name="usuario" id="usuario" value="<?= $_SESSION['nombre'] ?>" readonly>
            </div>
            <div class="mb-3">
              <label for="texto" class="form-label">Comentario</label>
              <textarea name="texto" id="texto" class="form-control" style="height:200px;"></textarea>
            </div>
            <br>
            <button type="submit" name="enviarcomentario" class="btn-primary w-100"><i class="bi bi-person-circle"></i>&nbsp;&nbsp;Enviar comentario</button>
          </form>
        </div>
      </div>
    <?php endif; ?>
    <!-- Fin para agregar comentarios-->

    <!-- inicio para mostrar comentarios-->
    <div class="row-mt-4">
      <h3 class="text-center">Comentarios</h3>
      <?php foreach ($comentarios  as $c) : ?>
        <hr>
        <h4> <i class="bi bi-person-circle"> </i>&nbsp;&nbsp;<?= $c->autor ?></h4>
        <p><?= $c->comentario ?></p>
      <?php endforeach; ?>

    </div>
    <!-- Fin para mostrar comentarios-->
  </div>
</div>
<!-- Fin del detalle del articulo-->
<?php
include('includes/footer.php');
?>