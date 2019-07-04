<?php 
plantilla::aplicar();

if($_POST){
    $articulo = $_POST;
    core_articulo::guardar($articulo);
    redirect('main/articulos');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Articulos</title>
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

    <div>
    <button type="submit" class="btn btn-outline-primary"> <i  class="fa fa-user-plus"> AGREGAR</i></button>
    <button type="reset" onclick="return confirm('Seguro de limpiar los campos?')" class="btn btn-outline-warning"><i class="fa fa-eraser">LIMPIAR</i></button>
    </div>

</form>

<hr>

<h3>DATOS GUARDADOS</h3>
    <table class="table">
        <thead>
            <th>Nombre</th>
            <th>Costo</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th></th>
            <th></th>

        </thead>
        <tbody>
        <?php
            $rs = core_articulo::listado_articulos();
            foreach($rs as $articulo){
                $urlBorrar = base_url("main/borrar_articulo/{$articulo->id_articulo}");
                $urlEditar = base_url("main/editar_articulo/{$articulo->id_articulo}");
                echo"
            <tr>
            <td>{$articulo->nombre}</td>
            <td>{$articulo->costo}</td>
            <td>{$articulo->precio}</td>
            <td>{$articulo->existencia}</td>
            <td><a href='$urlBorrar' onclick=\"return confirm('Estas seguro de eliminarlo?')\" class='btn btn-danger'>X</a></td>
            <td><a href='$urlEditar' onclick=\"return confirm('Estas seguro de modificarlo?')\" class='btn btn-warning'><i class='fa fa-edit'></i></a></td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<style>
    #form{
        margin-top: 125px;
    }
</style>
</body>
</html>