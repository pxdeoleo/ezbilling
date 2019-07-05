<?php
$connect = mysqli_connect("localhost", "root", "", "ezbilling");
$request = mysqli_real_escape_string($connect, $_POST["datos"]["nombre"]);


$query = "SELECT * FROM articulos WHERE nombre = \"$request\" ";
$result = mysqli_query($connect, $query);


if(mysqli_num_rows($result) > 0)
{
    foreach ($result as $fila) {
        $data = array(
            'id_articulo' => $fila["id_articulo"],
            'precio' => $fila['precio'],
            'existencia' => $fila['existencia']
        );
    }
    
    echo json_encode($data);
}

?>