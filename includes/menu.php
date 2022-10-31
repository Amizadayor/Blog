<!--Inicio del menu-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <H4> Thirteen Lines </H4>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['auth'])) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Administración
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="<?= RUTA_ADMIN ?>articulos.php">Articulos</a></li>
              <li><a class="dropdown-item" href="<?= RUTA_ADMIN ?>comentarios.php">Comentarios</a></li>
              <li><a class="dropdown-item" href="#"></a></li>
            </ul>

          </li>
          <?php if ($_SESSION['rol_id'] == 1) : ?>
            <li class="nav-item">
              <a class="nav-link active" href="<?= RUTA_ADMIN ?>usuarios.php">Usuarios</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-md-auto">
        <li class="nav-item">
          <a class="nav-link " href="<?= RUTA_FRONT ?>index.php">Home</a>
        </li>
        <?php if (!isset($_SESSION['auth'])) : ?>
          <li class="nav-item">
            <a class="nav-link " href="<?php echo RUTA_FRONT; ?>registro.php">Registrarse</a>
          </li>
        <?php endif; ?>

        <?php if (isset($_SESSION['auth'])) : ?>
          <li class="nav-item">
            <a class="nav-link " href="#"><i class="bi bi-person-circle"></i>&nbsp;&nbsp; <?= $_SESSION['nombre'] ?></a>
          </li>
        <?php endif; ?>
        <?php if (!isset($_SESSION['auth'])) : ?>
          <li class="nav-item">
            <a class="nav-link " href="<?= RUTA_FRONT ?>acceso.php">Iniciar Sesión</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth'])) : ?>
          <li class="nav-item">
            <a class="nav-link " href="<?= RUTA_FRONT ?>salir.php">Salir</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!--Fin del menu-->