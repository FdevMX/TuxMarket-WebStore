<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Abel OSH">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media();?>/images/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/style.css">
    
    <title>Registro - <?= NOMBRE_EMPESA ?></title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>REGISTRO DE USUARIO</h1>
      </div>
      <div class="login-box" style="min-height: 550px; width: 400px;">
        <div id="divLoading" >
          <div>
            <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
          </div>
        </div>
        <form class="login-form" name="formRegistro" id="formRegistro" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user-plus"></i>CREAR CUENTA</h3>
          
          <div class="form-group">
            <label class="control-label">NOMBRES</label>
            <input id="txtNombre" name="txtNombre" class="form-control" type="text" placeholder="Nombres" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">APELLIDOS</label>
            <input id="txtApellido" name="txtApellido" class="form-control" type="text" placeholder="Apellidos" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" required>
          </div>
          
          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña" required>
          </div>
          
          <div id="alertRegistro" class="text-center"></div>
          
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>REGISTRARSE</button>
          </div>
          
          <div class="form-group mt-3">
            <p class="semibold-text mb-0 text-center">¿Ya tienes una cuenta? <a href="<?= base_url(); ?>/login" class="text-primary">Iniciar sesión</a></p>
          </div>
        </form>
      </div>
    </section>
    <script>
        const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media();?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
  </body>
</html>