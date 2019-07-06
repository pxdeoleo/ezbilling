<?php 
plantilla::aplicar();
if ($_POST) {
    $cliente = $_POST;
    core_cliente::guardar($cliente);
    
    redirect('main/clientes');
    
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
<h3>AGREGAR CLIENTE</h3>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('cedula','Cedula', ['placeholder'=>'Ingrese cedula...','required'=>'required']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('nombre','Nombre', ['placeholder'=>'Ingrese nombre...','required'=>'required']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('correo','E-mail', ['placeholder'=>'Ingrese correo electronico...','required'=>'required']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <?= asgInput('telefono','Telefono', ['placeholder'=>'Ingrese telefono...','required'=>'required', 'type'=>'tell']); ?>
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
            <th>Cedula</th>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Telefono</th>
            <th></th>
            <th></th>

        </thead>
        <tbody>
        <?php
            $rs = core_cliente::listado_cliente();
            foreach($rs as $cliente){
                $urlBorrar = base_url("main/borrar_cliente/{$cliente->id_cliente}");
                $urlEditar = base_url("main/editar_cliente/{$cliente->id_cliente}");
                echo"
            <tr>
            <td>{$cliente->cedula}</td>
            <td>{$cliente->nombre}</td>
            <td>{$cliente->correo}</td>
            <td>{$cliente->telefono}</td>
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