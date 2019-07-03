<?php
  if(!isset($_SESSION)){
    session_start();
  }
  if($_POST){
    if(core_sesion::verificar($_POST['usr'], $_POST['psw'])){
      $_SESSION['user']=$_POST['usr'];
      redirect('main');
    }
    
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/login.css">
    <title>Inicio de Sesion</title>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Easy Billing</h5>
            <form class="form-signin" method="post">

              <div class="form-label-group">
                <input type="text" name="usr" id="inputUser" class="form-control" placeholder="Usuario..." required autofocus>
                <label for="inputUser">Usuario</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="psw" id="inputPswd" class="form-control" placeholder="Contraseña..." required>
                <label for="inputPswd">Contraseña</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Recordar contraseña</label>
              </div>

              <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Iniciar sesión</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>