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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <title>Easy Billing</title>
  <!-- Script para búsqueda -->
  <script>
    $(document).ready(function(){
      $("#busca_id").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

</head>
<body> 
  <div class="container">
      <div class="row">
          <div class="col-sm-6">
          <!-- Input de búsqueda -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Filtrar</span>
              </div>
              <input type="text" class="form-control" id="busca_id" placeholder="Búsqueda" aria-label="Username" aria-describedby="basic-addon1">
              <!-- Boton de generar factura -->
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button">Generar factura</button>
              </div>
            </div>
            <!-- Tabla de artículos -->
              <table class="table">
                  <thead>
                    <th>ID</th>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                  </thead>
                  <tbody id="tabla">
                    <?php
                      $rs = core_articulo::listado_articulos();

                      foreach ($rs as $articulo) {
                        echo <<<TABLA
                        <tr>
                          <td>{$articulo->id_articulo}</td>
                          <td>{$articulo->nombre}</td>
                          <td>{$articulo->existencia}</td>
                          <td>{$articulo->precio}</td>
                        </tr>
TABLA;
                      }
                    ?>
                  </tbody>
              </table>
          </div>

          <div class="col-sm-4 ml-auto">
              <div class="card text-center">
              <div class="card-body">
                  <h5 class="card-title">Usuario</h5>
                  <i class="fa fa-user" style="font-size:36px"></i>
                  <p>Usuario: <?=$_SESSION['user']?></p>

                  <button class="btn btn-outline-primary" onclick="location.href='main/usuarios';">  Administrar usuario</button> <br>
                  <button class="btn btn-outline-warning" onclick="location.href='main/cerrar_sesion';"> Cerrar sesion</button>
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

  .card .card-title {
    margin-bottom: 1rem;
    font-weight: 300;
    font-size: 1.5rem;
  }
  
  .card .card-body {
    padding: 1rem;
  }
    tbody tr:hover {  
      background-color: lightblue;  
      color: #666666;  
    }

  </style>

</body>
</html>
