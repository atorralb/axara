<?php
session_start();
?>
<HTML>
<head>
<a href = "capturar_salidas_por_venta_de_mostrador.php?accion=fin" >finalizar sesion</a>
<?php	
$accion = urlencode(@$_REQUEST['accion']);
if($accion == "fin"){
	session_destroy();
	echo "<br><b>SESION FINALIZADA</b> <br><a href ='formulario.php'>empezar nuevo folio de devolucion de proveedores</a>";
	}
?>	
</head>
<STYLE>
@import url(../gui.css);
</STYLE>
<TABLE >
<TH></TH><TH>ALMACEN</TH><TH>FOLIO</th><th>FECHA</th><th>FACTURA</th><th>CONCEPTO</th><th>N.E</th><th>N.R</th><th>N.A</th>
<tr>
<?php
print_r($_SESSION);
?>
<p>
</tr>
<table>
<p>
</head>
<BODY>
<form action=capturar_salidas_por_venta_de_mostrador.php method=get>
<table>
<tr><td>CANTIDAD:</td><td><input type=text  id="textbox" class=textfield name="cantidad">
		<script>document.getElementById('textbox').focus()</script></td></tr>
<tr><td>PROVEEDOR:</td><td><input type=text  class=textfield name="cprov"></td></tr>
<tr><td>#PRODUCTO:</td><td><input type=text class=textfield name="cprod"></td></tr>
<tr><td><input type=submit border=0 value="insertar"></td></tr>
</table>
</form>
<TABLE>
<th>CANTIDAD</th><th>PROVEEDOR</th><th>CODIGO</th><th>S.P.C.C</th><th>S.P.P.V</th><th>DESCRIPCION</th><th>C.C</th><th>P.V</th><th>COMANDO</th>
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
function error_report (){
echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";
}
$cprov = urlencode(@$_REQUEST['cprov']);
$cprod = urlencode(@$_REQUEST['cprod']);
$cantidad = urlencode(@$_REQUEST['cantidad']);
$id = urlencode(@$_REQUEST['id']);
$accion = urlencode(@$_REQUEST['accion']);

if($accion=="eliminar"){
		mysqli_query($mysqli,"DELETE FROM entradas_y_salidas WHERE id=$id;");
	}	
	
if($cprov != "" && $cprod != "" && $cantidad != ""){
	$result = mysqli_query($mysqli,"SELECT * FROM productos WHERE cprov='$cprov' and cprod='$cprod'");
	$num_rows = mysql_num_rows($result);
	if ($num_rows > 0) {
		mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 
		(folio,			fecha,	
		movimiento,		almacen1,	
		almacen2,		concepto,	
		ne,				nr,	
		na,				factura,
		f,				cprov, 			
		cprod, 			cantidad,		
		fecha_capturado)
		VALUES 
		('$_SESSION[folio]','$_SESSION[fecha]',
		'3',				'0',	
		'$_SESSION[almacen_de_salida]',				'$_SESSION[concepto]', 	
		'$_SESSION[ne]', 	'$_SESSION[nr]',
		'$_SESSION[na]', 	'$_SESSION[factura]',
		'$_SESSION[folio]',	'$cprov',
		'$cprod',			'$cantidad', 
		NOW() );");
		}
		else{echo "<FONT COLOR='RED'>ESE PRODUCTO NO EXISTE</FONT>";}
	}
	
	$result=mysqli_query($mysqli,"SELECT  
				if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv,
				entradas_y_salidas.cantidad*productos.costodecompra AS spcc,  
				entradas_y_salidas.id, 
				entradas_y_salidas.cprov, 
				entradas_y_salidas.cprod, 
				entradas_y_salidas.cantidad, productos.descripcion, productos.costodecompra
				FROM 
				entradas_y_salidas, productos 
			    WHERE 
				entradas_y_salidas.cprov = productos.cprov 
			     AND 
				entradas_y_salidas.cprod = productos.cprod 
			     AND 
				entradas_y_salidas.f= '$_SESSION[folio]'
				ORDER BY id DESC;");	
	
		while( $row=mysqli_fetch_array($result))
		{
		extract($row);
		$sppv = $pv *$cantidad;
		echo "<tr><td>".$cantidad."</td>
		<td>".$cprov."</td>
		<td>".$cprod."</td>
		<td>$".$spcc."</td>
		<td>$ $sppv</td><td>".$descripcion."</td>
		<td>$".$costodecompra."</td>
		<td>$".$pv."</td>
		<td><a href=capturar_salidas_por_venta_de_mostrador.php?accion=eliminar&id=".$id.">eliminar</a></td></tr>";
		echo "\n";
		}			
?>
</TABLE>
</BODY>
</HTML>