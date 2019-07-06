<?php 
plantilla::aplicar();
if ($_POST) {
    $cliente = $_POST;
    core_cliente::guardar($cliente);
    
    redirect('main/clientes');    
}

$cliente = new stdClass;
$cliente->id_cliente = ''; 
$cliente->cedula='';
$cliente->nombre='';
$cliente->correo='';
$cliente->telefono='';

if (isset($id_cliente)) {
    $rs = core_cliente::cliente_x_id($id_cliente);
    if (count($rs) > 0) {
        $cliente = $rs[0];
    }
}
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
<h3>EDITAR CLIENTE</h3>
    <input type="hidden" name="id_cliente" value='<?= $cliente['id_cliente']?>'>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('cedula','Cedula', ['placeholder'=>'Ingrese cedula...','required'=>'required','value'=>$cliente['cedula']]); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('nombre','Nombre', ['placeholder'=>'Ingrese nombre...','required'=>'required','value'=>$cliente['nombre']]); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('correo','E-mail', ['placeholder'=>'Ingrese correo electronico...','required'=>'required','value'=>$cliente['correo']]); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('telefono','Telefono', ['placeholder'=>'Ingrese telefono...','required'=>'required', 'type'=>'tell','value'=>$cliente['telefono']]); ?>
        </div>
    </div>

    <div>
    <button type="submit" class="btn btn-outline-primary"> <i  class="fa fa-user-plus"> EDITAR</i></button>
    </div>

</form>
<hr>
</div>

<style>
    #form{
        margin-top: 125px;
    }
</style>
</body>
</html>