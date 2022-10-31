<?php
$articulos = new Articulo($cx);
?>
<!--Inicio de los articulos-->
<!--Inicio de card -->
<div class="container mt-5">
  <h1 class="text-center">LOS MEJORES HOTELES</h1>
  <div class="container-fluid my-4">
    <div class="row">
      <?php foreach ($articulos->listar(1, 1) as $articulo) : ?>
        <div class="col-sm-4 my-3">
          <div class="card h-100">
          <img src="img/articulos/<?=  $articulo->imagen?>" class="card-img-top" alt="img/articulos/<?=  $articulo->imagen?>">
            <div class="card-body">
              <h5 class="card-title"><?= $articulo->titulo ?></h5>
              <p><strong><?= formatearFecha($articulo->fecha_creacion) ?></strong> </p>
              <p class="card-text"><?= textoCorto($articulo->texto, 200) ?></p>
              <div class="card-footer">
                <a href="<?= RUTA_FRONT ?>detalle.php?id=<?= $articulo->id ?>" class="btn btn-primary">Ver más</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<!--Fin de card -->
<!--Fin de los articulos-->
