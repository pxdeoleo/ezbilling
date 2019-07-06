<?php
session_start();
plantilla::aplicar();
$base=base_url('base');
$fecha=date('Y-m-d H:i');
$CI =& get_instance();
$id_factura = $CI->uri->segment(3);

//Info Factura
    $info_factura = core_factura::factura_x_id($id_factura);
    $fecha = $info_factura[0]['fecha'];
    $subtotal = $info_factura[0]['subtotal'];
    $imp = $info_factura[0]['imp'];
    $total = $info_factura[0]['total'];

// Info cliente
    $id_cliente = $info_factura[0]['id_cliente'];
    $info_cliente = core_cliente::cliente_x_id($id_cliente);
    $cedula = $info_cliente[0]['cedula'];
    $nombre = $info_cliente[0]['nombre'];
    $correo = $info_cliente[0]['correo'];
    $telefono = $info_cliente[0]['telefono'];
// --Info Cliente--

    
//Info usuario
    $id_usuario = $info_factura[0]['id_usuario'];
    $info_usuario = core_usuario::usuario_x_id($id_usuario);
    $nombre_usuario = $info_usuario[0]['nombre'];
 ?>

<body onload="window.print()">

    <hr>
    <hr>
    <hr>
    <hr>
    <hr>

    <div class="container" id='divToPrint'>
        <form method="post" action="" id="form" autocomplete="off">
            <h3>Factura Electrónica</h3>    
            <hr>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <?= asgInput('fecha','Fecha de Emisión', ['required'=>'required', 'value'=>$fecha, 'disabled'=>'disabled']); ?>
                </div>

            </div>

            <h4>Cliente</h4>
            <hr>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <?= asgInput('cedula','Cédula', ['required'=>'required', 'value'=>$cedula, 'disabled'=>'disabled', 'placeholder'=>'XXXXXXXXXXX']); ?>
                </div>
                <div class="col-md-3 mb-3">
                    <?= asgInput('nombre','Nombre Completo', ['required'=>'required', 'value'=>$nombre, 'placeholder'=>'Juan Pérez', 'disabled'=>'disabled']); ?>
                </div>
                <div class="col-md-3 mb-3">
                    <?= asgInput('correo','Correo Electrónico', ['required'=>'required', 'value'=>$correo, 'placeholder'=>'jperez@mail.com', 'disabled'=>'disabled']); ?>
                </div>
                <div class="col-md-3 mb-3">
                    <?= asgInput('telefono','No. de Teléfono', ['required'=>'required', 'value'=>$telefono, 'placeholder'=>'8098098009', 'disabled'=>'disabled']); ?>
                </div>
            </div>
        </form>

        <hr>
        <div class="card">
            <div class="card-header">
                <h2 align='center'>Detalles</h2>
            </div>
            <div class="card-body">
                <table id='articulos_tabla' class='table'>
                    <thead>
                        <th>ID</th>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php
                            $ventas = core_ventas::venta_x_id_fact($id_factura);
                            foreach($ventas as $detalle){
                                $articulo = core_articulo::articulo_x_id($detalle['id_articulo']);
                                echo<<<DETALLES
                                <tr>
                                    <td>{$detalle['id_articulo']}</td>
                                    <td>{$articulo[0]['nombre']}</td>
                                    <td>{$detalle['cantidad']}</td>
                                    <td>{$detalle['precio']}</td>
                                    <td>{$detalle['total']}</td>
                                </tr>
DETALLES;
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><td>
                            <td><td>
                            <th>Subtotal</th>
                            <td id='td_subtotal'><?=$subtotal?></td>
                        </tr>
                        <tr>
                            <td><td>
                            <td><td>
                            <th>ITBIS</th>
                            <td id='td_itbis'><?=$imp?></td>
                        </tr>
                        <tr>
                            <td><td>
                            <td><td>
                            <th>Total</th>
                            <td id='td_total'><?=$total?></td>
                        </tr>
                    </tfoot>    
                </table>
                <table class='table'>
                    <tr>
                        <th>Fecha</th>
                        <td id = 'fecha'><?=$fecha?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Le atendió</th>
                        <td><?=$nombre_usuario?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">     
    function PrintDiv() {    
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write("<html><body onload=\"window.print()\">" + divToPrint.innerHTML + "</html>");
        popupWin.document.close();
        }
 </script>
<!-- Scritps, scripts y más scripts -->
