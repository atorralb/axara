<?
session_start();
?>
<HTML>
<head>
<a href = "rdp.php?action=fin" >finalizar sesion</a>
<?	if($action == "fin")
	{
	session_destroy();
	echo "<br><b>SESION FINALIZADA</b> <br><a href ='dpi.php'>empezar nuevo folio de devolucion de proveedores</a>";
	}
?>	
</head>
<STYLE>
@import url(../gui.css);
</STYLE>
<TABLE >
<th>FOLIO</th><th>FECHA</th><th>FACTURA</th><th>CONCEPTO</th><th>N.E</th><th>N.R</th><th>N.A</th>
<tr>
<?
echo "<td>$folio</td><td>$fecha</td><td>$factura</th><td>$concepto</td><td>$ne</td><td>$nr</td><td>$na</td>";
?>
<p>
</tr>
<table>
<p>
</head>
<BODY>
<form action=rdp.php method=get>
<table>
<tr><td>CANTIDAD:</td><td><input type=text  class=textfield name="cantidad"></td></tr>
<tr><td>PROVEEDOR:</td><td><input type=text  class=textfield name="cprov"></td></tr>
<tr><td>#PRODUCTO:</td><td><input type=text class=textfield name="cprod"></td></tr>
<tr><td><input type=submit border=0 value="insertar"></td></tr>
</table>
</form>
<TABLE>
<th>CANTIDAD</th><th>PROVEEDOR</th><th>CODIGO</th><th>S.P.C.C</th><th>S.P.P.V</th><th>DESCRIPCION</th><th>C.C</th><th>P.V</th><th>COMANDO</th>
<?
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
function error_report ()
{
echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";
}
	if($action=="del")
	{
		mysqli_query($mysqli,"DELETE FROM rdp WHERE id=$id;");
	}	

	if($cprov != "" && $cprod != "" && $cantidad != "")
	{
		mysqli_query($mysqli,"INSERT INTO rdp (f, cprov, cprod, cantidad) VALUES ('$folio', '$cprov','$cprod', '$cantidad' );");
	}
	$result=mysqli_query($mysqli,"SELECT  
				if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv,
				rdp.cantidad*productos.costodecompra AS spcc,  rdp.id, rdp.cprov, rdp.cprod, rdp.cantidad, productos.descripcion, productos.costodecompra
				FROM 
				rdp, productos 
			    WHERE 
				rdp.cprov = productos.cprov 
			     AND 
				rdp.cprod = productos.cprod 
			     AND 
				rdp.f= $folio
				ORDER BY id DESC LIMIT 10;");	
	
		while( $row=mysqli_fetch_array($result))
		{
		$sppv = $row['pv'] *$row['cantidad'];
		echo "<tr><td>".$row['cantidad']."</td><td>".$row['cprov']."</td><td>".$row['cprod']."</td><td>$".$row['spcc']."</td><td>$ $sppv</td><td>".$row['descripcion']."</td><td>$".$row['costodecompra']."</td><td>$".$row['pv']."</td><td><a href=rdp.php?action=del&id=".$row['id'].">eliminar</a></td></tr>";
		echo "\n";
		}			
?>
</TABLE>
</BODY>
</HTML>