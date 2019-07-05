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
                <div class="col-md-5 mb-3">
                    <?= asgInput('articulo','Nombre del Artículo', ['required'=>'required']); ?>
                </div>
                <div class="col-md-2 mb-3">
                    <?= asgInput('precio','Precio', ['required'=>'required']); ?>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Cantidad</label>
                    <input id="cantidad" type="number" class='form-control' value="1" min="1" max="1" step="1"/>
                </div>
            </div>
            <div class="form-row">
                <button class="btn btn-primary">Agregar Artículo</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
            </div>
        </form>
    </div>
</body>
</html>

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
 },
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
             console.log(respuesta.existencia);
             document.getElementById('cantidad').max = respuesta.existencia;
         });
     }
 
 });

});
</script>