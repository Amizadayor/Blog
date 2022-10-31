<?php
include('../includes/header.php');
$articulo = new Articulo($cx);
$cad = "";
if (isset($_GET['op'])) {
  $op = $_GET['op'];
  if ($op == 1) {
    $cad = "Crear";
  } else {
    $cad = "Editar";
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $a = $articulo->get_articulo($id);
    }
  }
}
if (isset($_POST['borrar'])) {

  if ($articulo->eliminar($id)) {
    $mensaje = "Registro eliminado correctamente";
    header("Location:articulos.php?mensaje=" . urlencode($mensaje));
  } else {
    $error = "No se pudo eliminar el registro";
  }
}
if (isset($_POST['gestion'])) {
  $titulo = $_POST['titulo'];
  $texto = $_POST['texto'];
  if ($op == 2) {
    $id = $_POST['id'];
  }
  if (empty($titulo) || $titulo == '' || empty($texto) || $texto == '') {
    $error = "Error,algunos campos estan vacios";
  } else {
    if ($_FILES['imagen']['error'] > 0) {
      if ($op != 2) {
        $error = "Error,ningun archivo seleccionado";
      } else {
        if ($articulo->editar($id, $titulo, "", $texto)) {
          $mensaje = "Articulo editado correctamente!!";
          header("Location:articulos.php?mensaje=" . urlencode($mensaje));
        } else {
          $error = "Error,no se pudo editar el articulo";
        }
      }
    } else {
      $image = $_FILES['imagen']['name'];
      $imageArr = explode('.', $image);
      $rand = rand(1000, 99999);
      $newImageName = $imageArr[0] . $rand . "." . $imageArr[1];
      $rutaFinal = "../img/articulos" . $newImageName;
      if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFinal)) {
        if ($op == 1) {
          if ($articulo->crear($titulo, $texto, $newImageName, $_SESSION['id'])) {
            $mensaje = "Articulo creado correctamente!!";
            header("Location:articulos.php?mensaje=" . urlencode($mensaje));
          } else {
            $error - "Error, no se puede crear el articulo";
          }
        } else {
          if ($articulo->editar($id, $titulo, $newImageName, $texto)) {
            $mensaje = "Articulo editado correctamente!!";
            header("Location:articulos.php?mensaje=" . urlencode($mensaje));
          } else {
            $error = "Error,no se pudo editar el articulo";
          }
        }
      } else {
        $error = "Error,no se pudo subir el archivo";
      }
    }
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

<!-- Inicio de la seccion y creacion de articulos-->
<div class="container mt-5">
  <h1 class="text-center"><?= $cad ?> un Articulo</h1>
  <div class="container-fluid my-4">
    <div class="row">
      <div class="col-sm-6 offset-3">
        <div class="card">
          <div class="card-header">
            Ingresa los Datos
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <?php if ($op == 2) : ?>
                <input type="hidden" name="id" value="<?= $a->id ?>">
              <?php endif; ?>
              <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?= $op == 2 ? $a->titulo : '' ?>">
              </div>
              <div class="mb-3">
                <img src="<?= $op == 2 ? RUTA_FRONT . "img/articulos/" . $a->imagen : '' ?>" alt="<?= $op == 2 ? RUTA_FRONT . "img/articulos/" . $a->imagen : '' ?>" class="img-fluid img-thumbnail">
              </div>
              <div class="mb-3">
                <label for="imagen" class="form-label">Imágen</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Selecciona una imágen">
              </div>
              <div class="mb-3">
                <label for="texto" class="form-label">Texto</label>
                <textarea name="texto" id="texto" style="height:200px;" class="form-control"><?= $op == 2 ? $a->texto : '' ?></textarea>
              </div>
              <br>
              <?php
              $w = "";
              if ($op == 1) {
                $w = "w-100";
              }
              ?>
              <button tipe="submit" name="gestion" class="btn btn-success float-start <?= $w ?>"><i class="bi bi-person-circle"></i>&nbsp;&nbsp;<?= $cad ?> Articulo</button>
              <?php if ($op == 2) : ?>
                <button tipe="submit" name="borrar" class="btn btn-danger float-end"><i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;Borrar Articulo</button>
              <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Fin de la seccion y creacion de articulo-->
<?php
include('../includes/footer.php');
?>