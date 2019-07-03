<?php
core_sesion::sesion();

plantilla::aplicar(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Easy Billing</title>
</head>
<body>
  <div class="container">
      <div class="row">

          <div class="col-sm-6">
              <table class="table">
                  <thead>
                      <th>Articulo</th>
                      <th>Cantidad</th>
                  </thead>
                  <tbody>
                  
                  </tbody>
              </table>
          </div>

          <div class="col-sm-4 ml-auto">
              <div class="card text-center">
              <div class="card-body">
                  <h5 class="card-title">Usuario</h5>
                  <i class="fa fa-user" style="font-size:36px"></i>
                  <p>Nombre de Usuario: <?=$_SESSION['user']?></p>

                  <button type="submit" class="btn btn-outline-primary">  Administrar usuario</button>
                  <button type="submit" class="btn btn-outline-warning" onclick="location.href='main/cerrar_sesion';"> Cerrar sesion</button>
              </div>
              </div>
              
          </div>
      </div>
  </div>

  <style>
    .row{
      margin-top:125px;
    }
    .card {
    border: 1;
    border-radius: 2rem;
    
  }

  .card .card-title {
    margin-bottom: 2rem;
    font-weight: 300;
    font-size: 1.5rem;
  }
  
  .card .card-body {
    padding: 1rem;
  }

  </style>

</body>
</html>
