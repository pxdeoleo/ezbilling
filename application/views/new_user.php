<?php 
plantilla::aplicar();
if ($_POST) {
    $usuario = $_POST;
    core_usuario::guardar($usuario);
    
    redirect('main/usuarios');
    
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
<div class="col-sm-4">
<form method= "post" action="" id="form">
<h3>AGREGAR USUARIO</h3>
    <div class="form-row">
        <div class="col-md-10 mb-3">
            <?= asgInput('usuario','Usuario', ['placeholder'=>'Ingrese usuario...','required'=>'required']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-10 mb-3">
            <?= asgInput('contrasena','Contraseña', ['placeholder'=>'Ingrese contraseña...','required'=>'required']); ?>
        </div>
    </div>

    <div>
    <button type="submit" class="btn btn-outline-primary"> <i  class="fa fa-user-plus"> AGREGAR</i></button>
    <button type="reset" onclick="return confirm('Seguro de limpiar los campos?')" class="btn btn-outline-warning"><i class="fa fa-eraser">LIMPIAR</i></button>
    </div>
</form>
</div>

<div class="col-sm-8">
    <table class="table">
        <thead>
            <th>Usuarios</th>
            <th>Contraseña</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
        <?php
            $rs = core_usuario::listado_usuario();
            foreach($rs as $usuarios){
                $urlBorrar = base_url("main/borrar_usuario/{$usuarios->id_usuario}");
                $urlEditar = base_url("main/editar_usuario/{$usuarios->id_usuario}");
                echo"
            <tr>
            <td>{$usuarios->usuario}</td>
            <td>{$usuarios->contrasena}</td>
            <td><a href='$urlBorrar' onclick=\"return confirm('Estas seguro de eliminarlo?')\" class='btn btn-danger'>X</a></td>
            <td><a href='$urlEditar' onclick=\"return confirm('Estas seguro de modificarlo?')\" class='btn btn-warning'><i class='fa fa-edit'></i></a></td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
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