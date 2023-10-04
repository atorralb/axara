<?php include("../inc/menu.php");?>
<head>
AGREGAR PROVEEDOR	
</head>
<TABLE>
<form action="agregarproveedor.php" method="get">
<TR><TD>CODIGO DE PROVEEDOR</TD><TD><input type="text" class=textfield name=cprov></TD></TR>
<TR><TD>NOMBRE</TD><TD><input type="text" class=tlargo name=nombre></TD></TR>
<TR><TD>TELEFONO</TD><TD><input type="text" class=tlargo name=telefono></TD></TR>
<TR><TD>FAX</TD><TD><input type="text" class=tlargo name=fax></TD></TR>
<TR><TD>DOMICILIO</TD><TD><input type="text" class=tlargo name=domicilio></TD></TD>
<TR><TD>CIUDAD</TD><TD><input type="text" class=tlargo name=ciudad></TD></TR>
<TR><TD>ENCARGADO</TD><TD><input type="text" class=tlargo name=encargado></TD></TR>
<TR><TD>RFC</TD><TD><input type="text" class=tlargo name=rfc></TD></TR>
<TR><TD><input type="submit" value="agregar"></TD></TR>
</FORM>
</TABLE>
<table>
<tr><th>CODIGO</th><th>NOMBRE</th><th>TELEFONO</th><th>FAX</th><th>DOMICILIO</th><th>CIUDAD</th><th>ENCARGADO</th><th>R.F.C</th></tr>
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));


if(urlencode(@$_REQUEST['cprov']) != "")	
{
    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
    $nombre=mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
    $domicilio=mysqli_real_escape_string($mysqli,$_REQUEST['domicilio']);
    $ciudad=mysqli_real_escape_string($mysqli,$_REQUEST['ciudad']);
    $tel=mysqli_real_escape_string($mysqli,$_REQUEST['telefono']);
    $fax=mysqli_real_escape_string($mysqli,$_REQUEST['fax']);
    $encargado=mysqli_real_escape_string($mysqli,$_REQUEST['encargado']);
    $rfc=mysqli_real_escape_string($mysqli,$_REQUEST['rfc']);
    //this will get the maximun number of the primary key (id)  + 1 so mysql can't confuse it for entry '0'... really weird bug
    $maxid= mysqli_query($mysqli,"SELECT MAX(id)+1 AS maximumid FROM proveedores;");
    $maxid2 = mysqli_fetch_array($maxid);
    //until here



mysqli_query($mysqli, "insert into proveedores (id, cprov, nombre, domicilio, ciudad, tel, fax, encargado, rfc)  values (".$maxid2['maximumid'].", '$cprov', '$nombre', '$domicilio', '$ciudad', '$tel', '$fax', '$encargado', '$rfc');");

$proveedor =  mysqli_query($mysqli,"SELECT * FROM proveedores Where cprov='$cprov';");

while($row=mysqli_fetch_array($proveedor))
		{
		echo "<tr><td>".$row['cprov']."</td>";
		echo "<td>".$row['nombre']."</td>";
		echo "<td>".$row['domicilio']."</td>"; 
		echo "<td>".$row['ciudad']."</td>"; 
		echo "<td>".$row['tel']."</td>"; 
		echo "<td>".$row['fax']."</td>"; 
		echo "<td>".$row['encargado']."</td>";
		echo "<td>".$row['rfc']."</td>";
		echo "</tr>";
		echo "\n";
		}
}
?>
</table>
</html>
