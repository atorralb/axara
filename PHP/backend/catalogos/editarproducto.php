<?php include("../inc/menu.php");?>
<body>
<form action="productosxproveedor.php?accion=actualizarproducto" method="post">
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
$id= $_SERVER['QUERY_STRING'];
$pyc = explode("&", $id);

function error_report () {echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";}

$result = mysqli_query($mysqli,"SELECT * FROM productos where cprov = '$pyc[0]' AND cprod = '$pyc[1]';");

while($row = mysqli_fetch_array($result))
{
echo ' <input type ="text" value="'.$row['cprov'].'" name="cprov">cprov 		
	 <br><input type="text" value="'.$row['cprod'].'" name="cprod">cprod		
	 <br><input type="text" value="'.$row['descripcion'].'" name="descripcion">descripcion	
	 <br><input type="text" value="'.$row['costodecompra'].'" name="costodecompra">costodecompra	
	  <br><input type="text" value="'.$row['pv2'].'" name="pv2">precio de venta deseado	
	 <br><input type="text" value="'.$row['tasa15'].'" name="tasa15">tasa15		
	 <br><input type="text" value="'.$row['tasa0'].'" name="tasa0">tasa0		
	 <br><input type="text" value="'.$row['unidad'].'"	name="unidad">unidad
	<br><input type="text" value="'.$row['precio_mayoreo'].'" name="precio_mayoreo">precio de mayoreo<br>';
	 echo "\n";
}
?>
<input type="submit" value="aplicar cambios">
</form>
</body>

</html>
