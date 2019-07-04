<?php 
plantilla::aplicar();

if($_POST){
    $articulo = $_POST;
    core_articulo::guardar($articulo);
    redirect('main/articulos');
}
$articulo = new stdClass;
$articulo->id_articulo = '';
$articulo->nombre='';
$articulo->costo='';
$articulo->precio='';
$articulo->existencia='';

if (isset($id_articulo)) {
    $rs = core_articulo::articulo_x_id($id_articulo);
    if (count($rs) > 0) {
        $articulo = $rs[0];
    }
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
<input type="hidden" name="id_articulo" value='<?= $articulo['id_articulo']?>'>
<h3>AGREGAR ARTICULO</h3>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('nombre','Nombre', ['placeholder'=>'Ingrese nombre...','required'=>'required','value'=>$articulo['nombre']]); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('costo','Costo', ['placeholder'=>'Ingrese costo...','required'=>'required','value'=>$articulo['costo']]); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('precio','Precio', ['placeholder'=>'Ingrese precio...','required'=>'required', 'type'=>'tell','value'=>$articulo['precio']]); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('existencia','Existencia', ['placeholder'=>'Ingrese cantidad...','required'=>'required','value'=>$articulo['existencia']]); ?>
        </div>
    </div>
<br>
    <div>
    <button type="submit" class="btn btn-outline-primary"> <i  class="fa fa-user-plus"> MODIFICAR</i></button>
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