<?php
$connect = mysqli_connect("localhost", "root", "", "ezbilling");
$request = mysqli_real_escape_string($connect, $_POST["datos"]["cedula"]);


$query = "SELECT * FROM clientes WHERE cedula = \"$request\"";
$result = mysqli_query($connect, $query);



if(mysqli_num_rows($result) > 0)
{
    foreach ($result as $fila) {
        $data = array(
            'nombre' => $fila["nombre"],
            'correo' => $fila["correo"],
            'telefono' => $fila['telefono']
        );
    }
    
    echo json_encode($data);
}

?>