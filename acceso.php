<?php
include('includes/header_front.php');
$us = new Usuario($cx);
if (isset($_POST['acceder'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($email) || $email == '' || empty($password) || $password == '') {
    $error = "Error algunos campos estan vacios";
  } else {
    if ($us->acceder($email, $password)) {
      $_SESSION['auth'] = true;
      $_SESSION['email'] = $email;
      $usuario = $us->usuario_email($email);
      $_SESSION['nombre'] = $usuario->nombre;
      $_SESSION['id'] = $usuario->id;
      $_SESSION['rol_id'] = $usuario->rol_id;
      header('Location:index.php');
      die();
    } else {
      $error = "Usuario y/o contraseña incorrecto ";
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

<!--Inicio del acceso-->
<div class="container mt-5">
  <h1 class="text-center">Acesso de usuarios</h1>
  <div class="container-fluid my-4">
    <div class="row">
      <div class="col-sm-6 offset-3">
        <div class="card">
          <div class="card">
            <div class="card-header">
              Ingresa tus datos para Acceder
            </div>
            <div class="card-body">
              <form action="" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Correo</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" name="acceder" class="btn btn-primary w-100"><i class="bi bi-person-circle"></i>&nbsp;&nbsp;Acceder</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Final del acceso-->
<?php
include('includes/footer.php');
?>