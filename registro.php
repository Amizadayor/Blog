<?php
include('includes/header_front.php');
$usuario = new Usuario($cx);
if (isset($_POST['registro'])) {
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repitepassword = $_POST['repitepassword'];
  if (empty($nombre) || $nombre == "" || empty($email) || $email == "" || empty($password) || $password == "" || empty($repitepassword) || $repitepassword == "") {
    $error = "Error algunos campos estan vacios";
  } else {
    if ($password != $repitepassword) {
      $error = "Error la contraseña no coiciden";
    } else {
      if ($usuario->validar_email($email)) {
        if ($usuario->registrar($nombre, $email, $password)) {
          $mensaje = "Usuario creado exitosamente";
        } else {
          $error = "Error,el usuario no se puede crear ";
        }
      } else {
        $error = "Error,el correo ya se encuentra registrado ";
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

<!--Inicio del registro-->
<div class="container mt-5">
  <h1 class="text-center">Registro de usuarios</h1>
  <div class="container-fluid my-4">
    <div class="row">
      <div class="col-sm-6 offset-3">
        <div class="card">
          <div class="card">
            <div class="card-header">
              Registrate para poder acceder
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="nombre" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Correo</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="repitepassword" class="form-label">Repite la contraseña</label>
                  <input type="password" name="repitepassword" id="repitepassword" class="form-control">
                </div>
                <button type="submit" name="registro" class="btn btn-success w-100"><i class="bi bi-person-circle"></i>&nbsp;&nbsp;Registrarse</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Final del registro-->
<?php
include('includes/footer.php');

?>