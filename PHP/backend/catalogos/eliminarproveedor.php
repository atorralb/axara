<?php include("../inc/menu.php");?>
ELIMINAR PROVEEDOR
<br>
<form action="eliminarproveedor.php" method=get>
<input type="text" class=textfield  name="cprov">
<br>
<input type="submit" value="eliminar">
</form>
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));

if(urlencode(@$_REQUEST['cprov']) != ""){
    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
    mysql_query ("delete from proveedores where cprov='$cprov';");
	mysql_query ("delete from entradas_y_salidas where cprov='$cprov';");
    echo "<br>proveedor $cprov y productos eliminados. los productos fueron eliminados de las entradas y salidas";
}
?>