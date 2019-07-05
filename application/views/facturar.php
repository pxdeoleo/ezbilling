<?php
plantilla::aplicar();
$base=base_url('base');
$fecha=date('Y-m-d H:i');

?>
<head>
<script src="<?=$base?>/bootstrap-input-spinner-master/src/bootstrap-input-spinner.js"></script>
<script>
    $("input[type='number']").inputSpinner()
</script>
</head>
<body>

    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    
    <div class="container">
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
                    <?= asgInput('cedula','Cédula', ['required'=>'required', 'placeholder'=>'XXXXXXXXXXX']); ?>
                </div>
                <div class="col-md-3 mb-3">
                    <?= asgInput('nombre','Nombre Completo', ['required'=>'required', 'placeholder'=>'Juan Pérez', 'disabled'=>'disabled']); ?>
                </div>
                <div class="col-md-3 mb-3">
                    <?= asgInput('correo','Correo Electrónico', ['required'=>'required', 'placeholder'=>'jperez@mail.com', 'disabled'=>'disabled']); ?>
                </div>
                <div class="col-md-3 mb-3">
                    <?= asgInput('telefono','No. de Teléfono', ['required'=>'required', 'placeholder'=>'8098098009', 'disabled'=>'disabled']); ?>
                </div>
                <div class="form-row">
                    <button class="btn btn-primary">Nuevo Cliente</button>
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                </div>
            </div>
        </form>
        
        <hr>
        <form method="post" action="" id="form" autocomplete="off">
            <h4>Artículos</h4>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <?= asgInput('id_articulo','ID', ['required'=>'required', 'disabled'=>'disabled']); ?>
                </div>
                <div class="col-md-4 mb-3">
                    <?= asgInput('articulo','Nombre del Artículo', ['required'=>'required']); ?>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Precio</label>
                    <input id="precio" name="precio" type="number" required class='form-control' min="1" step="1"/>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Cantidad</label>
                    <input id="cantidad" name="cantidad" required type="number" class='form-control' min="1" max="1" step="1"/>
                </div>
                <div class="col-md-2 mb-3">
                    <?=asgInput('acumulado', 'Acumulado', ['required'=>'required'])?>
                </div>
            </div>
        <div class="form-row">
                <button type="button" onclick="agregarArticulo()" class="btn btn-primary">Agregar Artículo</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
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
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><td>
                            <td><td>
                            <th>Subtotal</th>
                            <td id='td_subtotal'>0</td>
                        </tr>
                        <tr>
                            <td><td>
                            <td><td>
                            <th>ITBIS</th>
                            <td id='td_itbis'>0</td>
                        </tr>
                        <tr>
                            <td><td>
                            <td><td>
                            <th>Total</th>
                            <td id='td_total'>0</td>
                        </tr>
                    </tfoot>    
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<!-- Scritps, scripts y más scripts -->

<!-- Autocompletar cedula -->
<script>
$(document).ready(function(){
 
    $('#cedula').typeahead({
    source: function(query, result)
    {
        $.ajax({
            url:"<?=$base?>/php/busqueda_cliente.php",
            method:"POST",
            data:{query:query},
            dataType:"json",
            success:function(data)
            {
                result($.map(data, function(item){
                return item;
                }));
            }
        })
    },
        afterSelect: function (data) {
            var datos = {"cedula":data};
            $.ajax({
                url:"<?=$base?>/php/refresh_cliente.php",
                method:"POST",
                data:{datos}
            }).done(function(respuesta){
                respuesta = JSON.parse(respuesta);
                document.getElementById('nombre').value = respuesta.nombre;
                document.getElementById('correo').value = respuesta.correo;
                document.getElementById('telefono').value=respuesta.telefono;
            });
        }
    
    });
 
});

// Autocompletar articulo
$(document).ready(function(){
 
 $('#articulo').typeahead({
 source: function(query, result)
 { 
     $.ajax({
         url:"<?=$base?>/php/busqueda_articulo.php",
         method:"POST",
         data:{query:query},
         dataType:"json",
         success:function(data)
         {
             result($.map(data, function(item){
             return item;
             }));
         }
     })
 },//Luego de que se selecciona un articulo se actualizan los campos
     afterSelect: function (data) {
         var datos = {"nombre":data};
         $.ajax({
             url:"<?=$base?>/php/refresh_articulo.php",
             method:"POST",
             data:{datos}
         }).done(function(respuesta){
             console.log(respuesta);
             respuesta = JSON.parse(respuesta);
             document.getElementById('id_articulo').value = respuesta.id_articulo;
             document.getElementById('precio').value = respuesta.precio;
             document.getElementById('precio').min = respuesta.precio;
             console.log(respuesta.existencia);
             document.getElementById('cantidad').max = respuesta.existencia;
             document.getElementById('cantidad').value = 1;
             document.getElementById('acumulado').value= respuesta.precio;
         });
     }
 
 });

});
</script>
<!-- Cambiar valor acumulado cada vez que cambia el precio -->
<script>
$(document).ready(function(){
    $('#precio').on('input', function() { 
        document.getElementById('acumulado').value = document.getElementById('precio').value * document.getElementById('cantidad').value;
    });
});
// Cambiar acumulado cada vez que cambia la cantidad
$(document).ready(function(){
    $('#cantidad').on('input', function() { 
        document.getElementById('acumulado').value = document.getElementById('precio').value * document.getElementById('cantidad').value;
    });
});

</script>
<!-- Agregar articulo -->
<script>
function agregarArticulo(){
    // Si el articulo ya está agregado, no se permite agregar de nuevo
    if($("#tr_articulo_"+document.getElementById("id_articulo").value).length){
        alert('El articulo ya está agregado');
    }else{
        $("#articulos_tabla tbody").append(
        "<tr id=tr_articulo_"+document.getElementById("id_articulo").value+">" +
            "<td>"+document.getElementById("id_articulo").value+"</td>"+
            "<td>"+document.getElementById('articulo').value+   "</td>"+
            "<td id=articulo_cantidad_"+document.getElementById("id_articulo").value+">"+document.getElementById('cantidad').value+   "</td>"+
            "<td>"+document.getElementById('precio').value+     "</td>"+
            "<td id=articulo_precio_"+document.getElementById("id_articulo").value+">"+document.getElementById('acumulado').value+  "</td>"+
            "<td><button class='btn btn-danger' onclick='borrarArticulo("+document.getElementById("id_articulo").value+")'>Borrar</button></td>"+
        "</tr>"
        );
        // Cambiar los valores subtotal, itbis y total cada vez que se agrega un articulo
        document.getElementById('td_subtotal').innerHTML = parseFloat(document.getElementById('td_subtotal').innerHTML) + parseFloat(document.getElementById('acumulado').value);
        document.getElementById('td_itbis').innerHTML = (parseFloat(document.getElementById('td_subtotal').innerHTML) * 0.18).toFixed(2);
        document.getElementById('td_total').innerHTML = (parseFloat(document.getElementById('td_subtotal').innerHTML) + parseFloat(document.getElementById('td_itbis').innerHTML)).toFixed(2);
    }

    

    
}
</script>
<script>
    function borrarArticulo(id_articulo){
        console.log('id articulo ' + id_articulo);

        document.getElementById('td_subtotal').innerHTML = parseFloat(document.getElementById('td_subtotal').innerHTML) - parseFloat(document.getElementById('articulo_precio_'+id_articulo).innerHTML);
        document.getElementById('td_itbis').innerHTML = (parseFloat(document.getElementById('td_subtotal').innerHTML) * 0.18).toFixed(2);
        document.getElementById('td_total').innerHTML = (parseFloat(document.getElementById('td_subtotal').innerHTML) + parseFloat(document.getElementById('td_itbis').innerHTML)).toFixed(2);

        $('#tr_articulo_'+id_articulo).remove();
        
        document.getElementById('td_itbis').innerHTML = (parseFloat(document.getElementById('td_subtotal').innerHTML) * 0.18).toFixed(2);
        document.getElementById('td_total').innerHTML = (parseFloat(document.getElementById('td_subtotal').innerHTML) + parseFloat(document.getElementById('td_itbis').innerHTML)).toFixed(2);
    }
</script>
