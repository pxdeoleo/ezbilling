<?php 
plantilla::aplicar();
if ($_POST) {
    $usuario = $_POST;
    core_usuario::guardar($usuario);
    
    redirect('main/usuarios');
}

$usuario = new stdClass;
$usuario->id_usuario = '';
$usuario->usuario='';
$usuario->contrasena='';

if (isset($id_usuario)) {
    $rs = core_usuario::usuario_x_id($id_usuario);
    if (count($rs) > 0) {
        $usuario = $rs[0];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario</title>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-6">
<form method= "post" action="" id="form">
<h3>EDITAR USUARIO</h3>
    <input type="hidden" name="id_usuario" value='<?= $usuario['id_usuario']?>'>
    <div class="form-row">
        <div class="col-md-7 mb-3">
            <?= asgInput('usuario','Usuario', ['placeholder'=>'Ingrese usuario...','required'=>'required', 'value'=>$usuario['usuario']]); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-7 mb-3">
            <?= asgInput('contrasena','Contraseña', ['placeholder'=>'Ingrese contraseña...','required'=>'required','value'=>$usuario['contrasena']]); ?>
        </div>
    </div>

    <div>
    <button type="submit" class="btn btn-outline-primary"> <i  class="fa fa-user-plus"> EDITAR</i></button>
    <button type="reset" onclick="return confirm('Seguro de limpiar los campos?')" class="btn btn-outline-warning"><i class="fa fa-eraser">LIMPIAR</i></button>
    </div>
</form>
</div>

</div>
</div>

<style>
    .row{
        margin-top: 125px;
    }
</style>
</body>
</html>