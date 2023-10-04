<head>
<title>producto editado</title>
</head>

</head>
<body>
<form action= "proveedoreditado.php" method="post">
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
function error_report () 
{
echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";
}

mysqli_query($mysqli,"UPDATE 
		productos 
	SET 
	cprov = '$cprov',
	cprod = '$cprod',
	descripcion = '$descripcion',
	costodecompra = '$costodecompra',
	unidad = '$unidad',
	tasa15 = '$tasa15',
	tasa0  = '$tasa0',
	WHERE 
	cprov = '$cprov'
	AND
	cprod = '$cprod';");

$encabezado = mysqli_query($mysqli,"select * from proveedores where cprov = '$cprov';");
while($e = mysqli_fetch_array($encabezado))
{
echo '<input type="text" value="'.$e[cprov].'" name="cprov" size=40>codigo<br>';
echo '<input type="text" value="'.$e[nombre].'" name="nombre" size=40>nombre<br>';
echo '<input type="text" value="'.$e[domicilio].'" name="domicilio" size=40>domicilio<br>';
echo '<input type="text" value="'.$e[tel].'" name="tel" size=40>tel<br>';
echo '<input type="text" value="'.$e[fax].'" name="fax" size=40>fax<br>';
echo '<input type="text" value="'.$e[encargado].'" name="encargado" size=40>encargado<br>';
echo '<input type="text" value="'.$e[rfc].'" name="rfc" size=40>rfc<br>';
}

 ?>
<input type="submit" value="aplicar">
</form>

<TABLE align="left">
<THEAD valign="top"><TR><TH>Codigo</TH><TH>Descripcion</TH><TH align=right>C. C</TH><th align=right>P.V</th><th>Tasa 0</th><th>Tasa 15</th><th>Unidad</th><th align=center>Comando</TR></THEAD>
<?php
$result = mysqli_query($mysqli,"SELECT  Round(if (tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)) AS pv, 
				 cprov, cprod, descripcion, costodecompra, unidad, tasa15, tasa0
				FROM
				productos 
				WHERE
				cprov = '$proveedor' 
				OR
				cprov = '$cprov'
				ORDER BY 
				cprod ASC;");

while($row = mysqli_fetch_array($result))
{
echo '<td>', $row[cprod], 
      '</td><td width=300>',$row[descripcion], 
      '</td><td width=100 align=right>',$row[costodecompra],
	  '</td><td width=100 align=right>'.$row[pv],
	  '</td><td width=100 align=center>',$row[tasa0],
	  '</td><td width=100 align=center>',$row[tasa15],
	  '</td><td width=100 align=center>'.$row[unidad],'</td><td><a href="editarproducto.php?',$row[cprov],'&',$row[cprod],'"><IMG SRC="../images/csv.gif"  border=0></a></td></tr>';
       echo "\n";
}
?>
</body>
</html>
