<?php
$connect = mysqli_connect("localhost", "root", "", "ezbilling");
//Factura
$info_factura = array(
    'fecha'=>$_POST['datos']['factura_info']['fecha'],
    'subtotal'=>$_POST['datos']['factura_info']['subtotal'],
    'imp'=>$_POST['datos']['factura_info']['imp'],
    'total'=>$_POST['datos']['factura_info']['total'],
    'id_usuario'=>$_POST['datos']['factura_info']['id_usuario'],
    'id_cliente'=>$_POST['datos']['factura_info']['id_cliente'],
);
//$request = mysqli_real_escape_string($connect, $_POST["datos"]["cedula"]);
$query = "INSERT INTO `facturas` (`id_factura`, `fecha`, `subtotal`, `imp`, `total`, `id_usuario`, `id_cliente`) 
VALUES (NULL, '$info_factura[fecha]', '$info_factura[subtotal]', '$info_factura[imp]', '$info_factura[total]', '$info_factura[id_usuario]', '$info_factura[id_cliente]');";
$result = mysqli_query($connect, $query);
//Ventas
// echo(var_dump($_POST['datos']['ventas_info']['precio'][0]));
for($i=0;$i<count($_POST['datos']['ventas_info']['id_articulos']); $i++){
    $connect = mysqli_connect("localhost", "root", "", "ezbilling");
    $info_ventas = array(
        'id_factura'=>(int) $_POST['datos']['ventas_info']['id_factura'],
        'id_articulo'=>(int) $_POST['datos']['ventas_info']['id_articulos'][$i],
        'cantidad'=> (int) $_POST['datos']['ventas_info']['cantidad'][$i],
        'precio'=>$_POST['datos']['ventas_info']['precio'][$i],
        'total'=>$_POST['datos']['ventas_info']['total'][$i]
    );
    $query = "INSERT INTO `ventas` (`id_venta`, `id_factura`, `id_articulo`, `cantidad`, `precio`, `total`) 
    VALUES (NULL, $info_ventas[id_factura], $info_ventas[id_articulo], $info_ventas[cantidad], $info_ventas[precio], $info_ventas[total]);";
    $result = mysqli_query($connect, $query);

}

//Actualizar stock
for($i=0;$i<count($_POST['datos']['ventas_info']['id_articulos']); $i++){
    $connect = mysqli_connect("localhost", "root", "", "ezbilling");
    $info_ventas = array(
        'id_articulo'=>(int) $_POST['datos']['ventas_info']['id_articulos'][$i],
        'cantidad'=> (int) $_POST['datos']['ventas_info']['cantidad'][$i],
    );
    $query = "UPDATE articulos SET existencia=existencia - $info_ventas[cantidad] WHERE id_articulo=$info_ventas[id_articulo]";
    $result = mysqli_query($connect, $query);

}
?> 