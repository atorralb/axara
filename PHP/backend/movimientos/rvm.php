<?
session_start();
?>
<HTML>
<a href='rvm.php?action=fin'>finalizar sesion</a>
<head>
<?if($action == "fin"){session_destroy();
mysqli_query($mysqli,"delete from rvm where f = $folio and cprov ='' and cprod =0;");
 echo "<br><b>SESION FINALIZADA</b> <br><a href ='vmi.php'>empezar nuevo folio de venta de mostrador</a><p>";}?>
</HEAD>
<STYLE>
@import url(../gui.css);
</STYLE>
<TABLE >
<th>FOLIO</th><th>FECHA</th><th>CONCEPTO</th><th>N.E</th><th>N.R</th><th>N.A</th><tr>
<? 
   echo "<td>$folio</td><td>$fecha</td><td>$concepto</td><td>$ne</td><td>$nr</td><td>$na</td>";
?>
 </tr>
</table>
<form action=rvm.php method=get>
<table>
<tr><td>CANTIDAD:</td><td><input type=text class=textfield name="cantidad"></td></tr>
<tr><td>PROVEEDOR</td><td> <input type=text class=textfield name="cprov"></td></tr>
<tr><td>#PRODUCTO:</td><td> <input type=text class=textfield name="cprod"></td></tr>
<tr><td><input type=submit value="insertar"></td></tr>
</table>
</form>
<TABLE>
<th>CANTIDAD</th><th>PROVEEDOR</th><th>CODIGO</th><th>S.P.C.C</th><th>S.P.P.V</th><th>DESCRIPCION</th><th>C.C</th><th>P.V</th><th>COMANDO</th>

<?
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
function error_report () {echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";}
if($action=="del")	{mysqli_query($mysqli,"DELETE FROM rvm WHERE id=$id;");}
//codigo para no introducir productos no existentes
$buscarproducto = mysqli_query($mysqli,"select * from productos where cprov ='$cprov' and cprod = '$cprod';"); 
$existeproducto = mysqli_fetch_array($buscarproducto);
if($cprov != "" && $cprod != "" && $cantidad != "") { mysqli_query($mysqli,"INSERT INTO rvm (f, cprov, cprod, cantidad) VALUES ('$folio', '".$existeproducto['cprov']."', '".$existeproducto['cprod']."', '$cantidad' );");}

$result=mysqli_query($mysqli,"SELECT  
if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv,
rvm.cantidad*productos.costodecompra AS spcc, rvm.id, rvm.cprov, rvm.cprod, rvm.cantidad, productos.descripcion, productos.costodecompra
FROM 
rvm, productos 
WHERE 
rvm.cprov = productos.cprov 
AND 
rvm.cprod = productos.cprod 
AND 
rvm.f = $folio
ORDER BY id DESC LIMIT 10;");	
	
		while( $row=mysqli_fetch_array($result))
		{
		$sppv = $row['pv'] *$row['cantidad'];
		echo "<tr><td>".$row['cantidad']."</td><td>".$row['cprov']."</td>";
		echo "<td>".$row['cprod']."</td><td>$".$row['spcc']."</td><td>$ $sppv</td><td>".$row['descripcion']."</td><td>$".$row['costodecompra']."</td><td>$".$row['pv']."</td><td><a href=rvm.php?action=del&id=".$row['id'].">eliminar</a></td></tr>";
		echo "\n";
		}					
?>
</TABLE>
</HTML>