<?php
session_start();
plantilla::aplicar();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <hr>
    <hr>
    <hr>    
    <hr>
    <hr>
    <hr>
    <div class='container'>
    <h2>Facturas guardadas</h2>
        <table class='table'>
            <thead>
                <th>ID</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>Impuestos</th>
                <th>Total</th>
                <th>Cédula Cliente</th>
            </thead>
            <tbody>
                <?php
                    $rs = core_factura::listado_factura();
                    foreach ($rs as $factura) {
                        $cliente = core_cliente::cliente_x_id($factura->id_cliente);
                        $cliente = $cliente[0]['nombre'];
                        $urlImprimir = base_url("main/imprimir/{$factura->id_factura}");
                        echo <<<TABLA
                        <tr>
                                <td>{$factura->id_factura}</td>
                                <td>{$factura->fecha}</td>
                                <td>RD\$ {$factura->subtotal}</td>
                                <td>RD\$ {$factura->imp}</td>
                                <td>RD\$ {$factura->total}</td>
                                <td>{$cliente}</td>
                                <td><a href='$urlImprimir' onclick=\"return confirm('Está seguro?')\" class='btn btn-warning'>Imprimir</a></td>
                        </tr>
TABLA;
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>