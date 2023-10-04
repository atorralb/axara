<!DOCTYPE html>
<?php date_default_timezone_set('America/Los_Angeles'); ?>
<head>
<link href="https://releases.transloadit.com/uppy/v3.2.1/uppy.min.css" rel="stylesheet">
</head>
<body>
<br>
    <b><A href="">CATALOGOS</A></b> 
        <a id="proveedores"></a>
        <a id="agregarproducto"></a>
        <a id="agregarproveedor"></a>
        <a id="eliminarproducto"></a>
        <a id="eliminarproveedor"></a>
<br>
<b><A   href="https:/localhost/backend/movimientos/formulario.php">MOVIMIENTOS</A></b> 
<br>
    <b><A href="">ADMINISTRACION</A></b>
        <a id="entradas_y_salidas"></a>
        <a id="records_por_folio"></a>
        <a id="anexar_records_por_folio"></a>
        <a id="inventario_por_proveedor"></a>
        <a id="bp"></a>
        <a id="concentrado"></a>
<br>
</DIV>
<script>
let catalogos = ["proveedores", "agregar producto", "agregar proveedor", "agregar proveedor", "eliminar proveedor"];
let catalogos_links = [ "<a href='http://localhost/backend/catalogos/proveedores.php'>", 
                        "<a href='http://localhost/backend/catalogos/agregarproducto.php'>",
                        "<a href='http://localhost/backend/catalogos/agregarproveedor.php'>",
                        "<a href='http://localhost/backend/catalogos/eliminarproducto.php'>",
                        "<a href='http://localhost/backend/catalogos/eliminarproveedor.php'>"]

let proveedores = catalogos_links[0] + catalogos[0];
let agregarproducto = catalogos_links[1] + catalogos[1];
let agregarproveedor = catalogos_links[2] + catalogos[2];
let eliminarproducto = catalogos_links[3] + catalogos[3];
let eliminarproveedor = catalogos_links[4] + catalogos[4]; 
document.getElementById("proveedores").innerHTML = proveedores;
document.getElementById("agregarproducto").innerHTML = agregarproducto;
document.getElementById("agregarproveedor").innerHTML = agregarproveedor;
document.getElementById("eliminarproducto").innerHTML = eliminarproducto;
document.getElementById("eliminarproveedor").innerHTML = eliminarproveedor;

let administracion = ["entradas y salidas ", "records por folio", "anexar records por folior", "inventario por proveedor", "buscar producto", "concentrado"];
let administracion_urls =   [   "<a href='http://localhost/backend/administracion/entradas_y_salidas.php'>", 
                                "<a href='http://localhost/backend/administracion/records_por_folio.php'>",
                                "<a href='http://localhost/backend/administracion/anexar_records_por_folio.php'>",
                                "<a href='http://localhost/backend/administracion/inventario_por_proveedor.php'>",
                                "<a href='http://localhost/backend/administracion/bp.php'>",
                                "<a href='http://localhost/backend/administracion/concentrado.php'>"
                            ];
let entradas_y_salidas = administracion_urls[0] + administracion[0];
let records_por_folio = administracion_urls[1] + administracion[1];
let anexar_records_por_folio = administracion_urls[2] + administracion[2];
let inventario_por_proveedor = administracion_urls[3] + administracion[3];
let bp = administracion_urls[4] + administracion[4];
let concentrado = administracion_urls[5] + administracion[5];
document.getElementById("entradas_y_salidas").innerHTML = entradas_y_salidas;
document.getElementById("records_por_folio").innerHTML = records_por_folio;
document.getElementById("anexar_records_por_folio").innerHTML = anexar_records_por_folio;
document.getElementById("inventario_por_proveedor").innerHTML = inventario_por_proveedor;
document.getElementById("bp").innerHTML = bp;
document.getElementById("concentrado").innerHTML = concentrado;
</script>


