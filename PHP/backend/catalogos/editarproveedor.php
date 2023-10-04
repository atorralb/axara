<?php include("../menu2.inc");?>
<body>
<form action="proveedoreditado.php" method="post">
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
$proveedor= $_SERVER['QUERY_STRING'];
function error_report () 
{
echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";
}
$query = "SELECT * FROM proveedores where cprov = '$proveedor';";
$result = mysqli_query($mysqli,$query);
$numResults = mysql_num_rows($result);
for ($i=0; $i < $numResults; $i++)
{
$row = mysqli_fetch_array($result);
echo 'codigo <input type ="text" value = "'.$row[cprov].'"> 
	 <br>nombre<input type="text" value="'.$row[nombre].'">
	 <br>domicilio<input type="text" value="'.$row[domicilio].'">
	 <br>ciudad<input type="text" value="'.$row[ciudad].'">
	 <br>telefono<input type="text" value="'.$row[tel].'">
	 <br>fax<input type="text" value="'.$row[fax].'">
	 <br>rfc<input type="text" value="'.$row[rfc].'">';
echo "\n";
}
?>
<input type="submit" value="aplicar cambios">
</form>
<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</body>
</html>
