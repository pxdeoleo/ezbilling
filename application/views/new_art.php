<?php 
plantilla::aplicar();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
</head>
<body>
<div class="container">
<form method= "post" action="" id="form">
<h3>AGREGAR ARTICULO</h3>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('nombre','Nombre', ['placeholder'=>'Ingrese nombre...','required'=>'required']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('costo','Costo', ['placeholder'=>'Ingrese costo...','required'=>'required']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('precio','Precio', ['placeholder'=>'Ingrese precio...','required'=>'required', 'type'=>'tell']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('existencia','Existencia', ['placeholder'=>'Ingrese cantidad...','required'=>'required']); ?>
        </div>
    </div>
<br>
    <div>
    <button type="submit" class="btn btn-outline-primary"> <i  class="fa fa-user-plus"> AGREGAR</i></button>
    <button type="reset" onclick="return confirm('Seguro de limpiar los campos?')" class="btn btn-outline-warning"><i class="fa fa-eraser">LIMPIAR</i></button>
    </div>

</form>
</div>
<style>
    #form{
        margin-top: 125px;
    }
</style>
</body>
</html>