<?php
session_start();
include("../menu2.inc");
$db = $mysqli = new mysqli("localhost","root", "");  
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
?>
<title>capturar movimiento</title>
<TABLE>
	
	<form action="formulario.php" method="post">
	
	<select name="movimiento">
	<option name = "movimiento" value="entradas_a_bodega" >entradas_a_bodega</option>
	<option name = "movimiento" value="devolucion_de_proveedores">devolucion_de_proveedores</option>
	<option name = "movimiento" value="salidas_por_venta_de_mostrador">salidas_por_venta_de_mostrador</option>
	<option name = "movimiento" value="traspasos">traspasos</option>
	<option name = "movimiento" value="entradas_diversas">entradas_diversas</option>
	<option name = "movimiento" value="salidas_diversas">salidas_diversas</option>
	</select>
	<br>
	almacen de entrada
	<br>
	<SELECT class=select name="almacen_de_entrada">
	        
             <OPTION value="1">BODEGA </OPTION> 	
			 <OPTION value="2">AV. 2A </OPTION> 
			<option value="3">AV. 2</option>
			<option value="4">PLAZA CRYSTAL</option>
			<!--<option value="5"> Calle 11 </option>!-->
			<option value="6">CALLE 13</option>
			<option value="7">CALLE 3</option>
			<option value="8">CUITLAHUAC</option>
			<!--<option value="9">C. 7</option>-->
			<!--<option value="10">TIENDA SUPER</option>-->
			<!--<option value="11"> Av. 5</option>-->
			<option value="12"> Calle 11 ( Huerta)</option>
			<option value="13"> SORIANA</option>
			<option value="14"> AVENIDA 4</option>
			<option value="15"> Tienda X</option>
			<option value="16"> Tienda Y</option>
	</SELECT>
	<br>
	almacen de salida<br>
		<SELECT class=select name="almacen_de_salida"> 
			<OPTION value="1">BODEGA </OPTION> 
			<OPTION value="2">AV. 2A </OPTION> 
			<option value="3">AV. 2</option>
			<option value="4">PLAZA CRYSTAL</option>
			<!--<option value="5"> Calle 11 </option>!-->
			<option value="6">CALLE 13</option>
			<option value="7">CALLE 3</option>
			<option value="8">CUITLAHUAC</option>
			<!--<option value="9">C. 7</option>-->
			<!--<option value="10">SUPER</option>-->
			<!--<option value="11"> Av. 5</option>-->
			<option value="12"> Calle 11 (Huerta)</option>
			<option value="13"> SORIANA</option>
			<option value="14"> AVENIDA 4</option>
			<option value="15"> Tienda X</option>
			<option value="16"> Tienda Y</option>
	</SELECT>
	
	<TR><TD>DIA</TD><TD> <input type="text" class=textfield name="d"  value=<?php echo date('d');?>></TD></TR>
	<TR><TD>MES</TD><TD><input type="text" class=textfield name="m"  value=<?php echo date('m');?>></TD></TR>
	<TR><TD>AÑO</TD><TD><input type="text" class=textfield name="a"  value=<?php echo date('Y');?>></TD></TR>
	 
	 
	 <TR><TD>FACTURA</TD><TD><input type="text" class=tlargo name="factura"></TD></TR>
	 <TR><TD>CONCEPTO</TD><TD><input type="text" class=tlargo name="concepto"></TD></TR>
	 <TR><TD>N.E</TD><TD><input type="text" class=tlargo name="ne"></TD></TR>
	 <TR><TD>N.R</TD><TD><input type="text" class=tlargo name="nr"></TD></TR>
	 <TR><TD>N.A</TD><TD><input type="text" class=tlargo name="na"></TD></TR>
	<TR><TD><input type="submit" value="aplicar"></TD></TR>
	</form>
</TABLE>




<?php
if(urlencode(@$_REQUEST['movimiento'])=="entradas_a_bodega"){
    
    $concepto = urlencode(@$_REQUEST['concepto']);
    $ne = urlencode(@$_REQUEST['ne']);
    $nr = urlencode(@$_REQUEST['nr']);
    $na = urlencode(@$_REQUEST['na']);
    $factura = urlencode(@$_REQUEST['factura']);
    
    
    $f = array(urlencode(@$_REQUEST['a']), urlencode(@$_REQUEST['m']), urlencode(@$_REQUEST['d']));
    $f1 = $f[0];
    $f2 =$f[1];
    $f3 = $f[2];
    $fecha1 = "$f1-$f2-$f3";
	

    $rmf = mysqli_query($mysqli,"select max(folio)+1 as maxfolio from entradas_y_salidas;"); 
    $mf = mysqli_fetch_array($rmf); 
    $maxfolio = $mf['maxfolio'];
	
		mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 
		(folio,
		fecha, 
		movimiento,
		almacen1,
		almacen2,
		concepto,
		ne,
		nr,
		na,
		factura,
		f,
		cprov, 
		cprod, 
		cantidad,
		fecha_capturado)
		VALUES 
		('$maxfolio','$fecha1','1','1','0',
		'$concepto', '$ne', '$nr', '$na', '$factura',
		'$maxfolio','','', '', NOW() );");

	
	//grabar datos para mostrar donde los usuarios estan "metiendo sus cosas :)"
	//He estado `pensando en que en realidad no es necesario tantas tablas si uso sesiones... talvez la proxima
	
	$_SESSION['folio'] = $maxfolio;  
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['factura'] = $factura;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;
	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM entradas_y_salidas WHERE folio = '$folio';");

	while( $row=mysqli_fetch_array($result))
	{	
    extract($row);
	echo "<tr>";
	echo "<td>".$folio."</td>";
	echo "<td>$f1-$f2-$f3</td>";
	echo "<td>".$factura."</td>";
	echo "<td>".$concepto."</td>"; 
	echo "<td>".$ne."</td>"; 
	echo "<td>".$nr."</td>"; 
	echo "</tr>";
	echo "\n";
	}
	
echo"<a href =\"capturar_entradas_por_compra.php\"> continuar </A>"; 	
}





if(urlencode(@$_REQUEST['movimiento'])=="devolucion_de_proveedores")
{
    $concepto = urlencode(@$_REQUEST['concepto']);
    $ne = urlencode(@$_REQUEST['ne']);
    $nr = urlencode(@$_REQUEST['nr']);
    $na = urlencode(@$_REQUEST['na']);
    $factura = urlencode(@$_REQUEST['factura']);
    
    
    $f = array(urlencode(@$_REQUEST['a']), urlencode(@$_REQUEST['m']), urlencode(@$_REQUEST['d']));
	$f1 = $f[0];
	$f2 =$f[1];
	$f3 = $f[2];
	$fecha1 = "$f1-$f2-$f3";
	
	$rmf = mysqli_query($mysqli,"select max(folio)+1 as maxfolio from entradas_y_salidas;"); 
    $mf = mysqli_fetch_array($rmf); 
    $maxfolio = $mf['maxfolio'];
	
		mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 
		(folio,
		fecha, 
		movimiento,
		almacen1,
		almacen2,
		concepto,
		ne,
		nr,
		na,
		factura,
		f,
		cprov, 
		cprod, 
		cantidad)
		VALUES 
		('$maxfolio','$fecha1','2','0','1',
		'$concepto', '$ne', '$nr', '$na', '$factura',
		'$maxfolio','','', '' );");

	
	//grabar datos para mostrar donde los usuarios estan "metiendo sus cosas :)"
	//He estado `pensando en que en realidad no es necesario tantas tablas si uso sesiones... talvez la proxima
	
	$_SESSION['folio'] = $maxfolio;  
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['factura'] = $factura;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;
	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM entradas_y_salidas WHERE folio = '$folio';");

	while( $row=mysqli_fetch_array($result))
	{	
    extract($row);
	echo "<tr>";
	echo "<td>".$folio."</td>";
	echo "<td>$f1-$f2-$f3</td>";
	echo "<td>".$factura."</td>";
	echo "<td>".$concepto."</td>"; 
	echo "<td>".$ne."</td>"; 
	echo "<td>".$nr."</td>"; 
	echo "</tr>";
	echo "\n";
	}
	
echo"<a href =\"records_de_devolucion_de_proveedores.php\"> continuar </A>"; 	
}



if(urlencode(@$_REQUEST['movimiento'])=="salidas_por_venta_de_mostrador")
{
    $concepto = urlencode(@$_REQUEST['concepto']);
    $ne = urlencode(@$_REQUEST['ne']);
    $nr = urlencode(@$_REQUEST['nr']);
    $na = urlencode(@$_REQUEST['na']);
    $factura = urlencode(@$_REQUEST['factura']);
    $almacen_de_salida = urlencode(@$_REQUEST['almacen_de_salida']);
    
    $f = array(urlencode(@$_REQUEST['a']), urlencode(@$_REQUEST['m']), urlencode(@$_REQUEST['d']));
	$f1 = $f[0];
	$f2 =$f[1];
	$f3 = $f[2];
	$fecha1 = "$f1-$f2-$f3";
	
	$rmf = mysqli_query($mysqli,"select max(folio)+1 as maxfolio from entradas_y_salidas;"); 
    $mf = mysqli_fetch_array($rmf); 
    $maxfolio = $mf['maxfolio'];
	
		mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 
		(folio,
		fecha, 
		movimiento,
		almacen1,
		almacen2,
		concepto,
		ne,
		nr,
		na,
		factura,
		f,
		cprov, 
		cprod, 
		cantidad)
		VALUES 
		('$maxfolio','$fecha1','3','0','$almacen_de_salida',
		'$concepto', '$ne', '$nr', '$na', '$factura',
		'$maxfolio','','', '' );");

	
	//grabar datos para mostrar donde los usuarios estan "metiendo sus cosas :)"
	//He estado `pensando en que en realidad no es necesario tantas tablas si uso sesiones... talvez la proxima
	
	$_SESSION['folio'] = $maxfolio;  
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['factura'] = $factura;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;
	$_SESSION['almacen_de_salida'] = $almacen_de_salida;
	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM entradas_y_salidas WHERE folio = '$folio';");

	while( $row=mysqli_fetch_array($result))
	{	
    extract($row);
	echo "<tr>";
	echo "<td>".$folio."</td>";
	echo "<td>$f1-$f2-$f3</td>";
	echo "<td>".$factura."</td>";
	echo "<td>".$concepto."</td>"; 
	echo "<td>".$ne."</td>"; 
	echo "<td>".$nr."</td>"; 
	echo "<td>".$almacen_de_salida."</td>"; 
	echo "</tr>";
	echo "\n";
	}
	
echo"<a href =\"capturar_salidas_por_venta_de_mostrador.php\"> continuar </A>"; 	
}



if(urlencode(@$_REQUEST['movimiento'])=="traspasos")
{
        $concepto = urlencode(@$_REQUEST['concepto']);
    $ne = urlencode(@$_REQUEST['ne']);
    $nr = urlencode(@$_REQUEST['nr']);
    $na = urlencode(@$_REQUEST['na']);
    $factura = urlencode(@$_REQUEST['factura']);
    $almacen_de_salida = urlencode(@$_REQUEST['almacen_de_salida']);
    $almacen_de_entrada = urlencode(@$_REQUEST['almacen_de_entrada']);
    $f = array(urlencode(@$_REQUEST['a']), urlencode(@$_REQUEST['m']), urlencode(@$_REQUEST['d']));
	$f1 = $f[0];
	$f2 =$f[1];
	$f3 = $f[2];
	$fecha1 = "$f1-$f2-$f3";
	
	$rmf = mysqli_query($mysqli,"select max(folio)+1 as maxfolio from entradas_y_salidas;"); 
    $mf = mysqli_fetch_array($rmf); 
    $maxfolio = $mf['maxfolio'];
	
		mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 
		(folio,
		fecha, 
		movimiento,
		almacen1,
		almacen2,
		concepto,
		ne,
		nr,
		na,
		factura,
		f,
		cprov, 
		cprod, 
		cantidad,
		fecha_capturado)
		VALUES 
		('$maxfolio','$fecha1','4','$almacen_de_entrada','$almacen_de_salida',
		'$concepto', '$ne', '$nr', '$na', '$factura',
		'$maxfolio','','', '', NOW() );");

	
	//grabar datos para mostrar donde los usuarios estan "metiendo sus cosas :)"
	//He estado `pensando en que en realidad no es necesario tantas tablas si uso sesiones... talvez la proxima
	
	$_SESSION['folio'] = $maxfolio;  
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['factura'] = $factura;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;
	$_SESSION['almacen_de_entrada'] = $almacen_de_entrada;
        $_SESSION['almacen_de_salida'] = $almacen_de_salida;
	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM entradas_y_salidas WHERE folio = '$folio';");

	while( $row=mysqli_fetch_array($result))
	{	
    extract($row);
	echo "<tr>";
	echo "<td>".$folio."</td>";
	echo "<td>$f1-$f2-$f3</td>";
	echo "<td>".$factura."</td>";
	echo "<td>".$concepto."</td>"; 
	echo "<td>".$ne."</td>"; 
	echo "<td>".$nr."</td>"; 
	echo "<td>entrada".$almacen_de_entrada."</td>"; 
	echo "<td>salida".$almacen_de_salida."</td>"; 
	echo "</tr>";
	echo "\n";
	}
	
echo"<a href =\"capturar_traspasos.php\"> continuar </A>"; 	
}




if(urlencode(@$_REQUEST['movimiento'])=="entradas_diversas")
{
    $concepto = urlencode(@$_REQUEST['concepto']);
    $ne = urlencode(@$_REQUEST['ne']);
    $nr = urlencode(@$_REQUEST['nr']);
    $na = urlencode(@$_REQUEST['na']);
    $factura = urlencode(@$_REQUEST['factura']);
    $almacen_de_entrada = urlencode(@$_REQUEST['almacen_de_entrada']);
    $almacen_de_salida = urlencode(@$_REQUEST['almacen_de_salida']);
    
	$f = array(urlencode(@$_REQUEST['a']), urlencode(@$_REQUEST['m']), urlencode(@$_REQUEST['d']));
    
	$f1 = $f[0];
	$f2 =$f[1];
	$f3 = $f[2];
	$fecha1 = "$f1-$f2-$f3";
	
	$rmf = mysqli_query($mysqli,"select max(folio)+1 as maxfolio from entradas_y_salidas;"); 
    $mf = mysqli_fetch_array($rmf); 
    $maxfolio = $mf['maxfolio'];
	
		mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 
		(folio,
		fecha, 
		movimiento,
		almacen1,
		almacen2,
		concepto,
		ne,
		nr,
		na,
		factura,
		f,
		cprov, 
		cprod, 
		cantidad)
		VALUES 
		('$maxfolio','$fecha1','5','$almacen_de_entrada','0',
		'$concepto', '$ne', '$nr', '$na', '$factura',
		'$maxfolio','','', '' );");

	
	//grabar datos para mostrar donde los usuarios estan "metiendo sus cosas :)"
	//He estado `pensando en que en realidad no es necesario tantas tablas si uso sesiones... talvez la proxima
	
	$_SESSION['folio'] = $maxfolio;  
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['factura'] = $factura;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;
	$_SESSION['almacen_de_entrada'] = $almacen_de_entrada;
	$_SESSION['almacen_de_salida'] = $almacen_de_salida;
	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM entradas_y_salidas WHERE folio = '$folio';");

	while( $row=mysqli_fetch_array($result))
	{	
    extract($row);
	echo "<tr>";
	echo "<td>".$folio."</td>";
	echo "<td>$f1-$f2-$f3</td>";
	echo "<td>".$factura."</td>";
	echo "<td>".$concepto."</td>"; 
	echo "<td>".$ne."</td>"; 
	echo "<td>".$nr."</td>"; 
	echo "<td>entrada".$almacen_de_entrada."</td>"; 

	echo "</tr>";
	echo "\n";
	}
	
echo"<a href =\"capturar_entradas_diversas.php\"> continuar </A>"; 	
}

if(urlencode(@$_REQUEST['movimiento'])=="salidas_diversas")
{
    $concepto = urlencode(@$_REQUEST['concepto']);
    $ne = urlencode(@$_REQUEST['ne']);
    $nr = urlencode(@$_REQUEST['nr']);
    $na = urlencode(@$_REQUEST['na']);
    $factura = urlencode(@$_REQUEST['factura']);
    $almacen_de_entrada = urlencode(@$_REQUEST['almacen_de_entrada']);
    $almacen_de_salida = urlencode(@$_REQUEST['almacen_de_salida']);
    
    $f = array(urlencode(@$_REQUEST['a']), urlencode(@$_REQUEST['m']), urlencode(@$_REQUEST['d']));
    
	$f1 = $f[0];
	$f2 =$f[1];
	$f3 = $f[2];
	$fecha1 = "$f1-$f2-$f3";
	
	$rmf = mysqli_query($mysqli,"select max(folio)+1 as maxfolio from entradas_y_salidas;"); 
    $mf = mysqli_fetch_array($rmf); 
    $maxfolio = $mf['maxfolio'];
	
		mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 
		(folio,		fecha,  movimiento, almacen1, almacen2,
		concepto,	ne,		nr,		na,		factura,
		f,			cprov, 	cprod, 	cantidad)
		VALUES 
		('$maxfolio','$fecha1','6','0','$almacen_de_salida',
		'$concepto', '$ne', '$nr', '$na', '$factura',
		'$maxfolio','','', '' );");

	
	//grabar datos para mostrar donde los usuarios estan "metiendo sus cosas :)"
	//He estado `pensando en que en realidad no es necesario tantas tablas si uso sesiones... talvez la proxima
	
	$_SESSION['folio'] = $maxfolio;  
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['factura'] = $factura;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;
	$_SESSION['almacen_de_salida'] = $almacen_de_salida;

	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM entradas_y_salidas WHERE folio = '$folio';");

	while( $row=mysqli_fetch_array($result))
	{	
    extract($row);
	echo "<tr>";
	echo "<td>".$folio."</td>";
	echo "<td>$f1-$f2-$f3</td>";
	echo "<td>".$factura."</td>";
	echo "<td>".$concepto."</td>"; 
	echo "<td>".$ne."</td>"; 
	echo "<td>".$nr."</td>"; 
	echo "<td>salida".$almacen_de_salida."</td>"; 

	echo "</tr>";
	echo "\n";
	}
	
echo"<a href =\"capturar_salidas_diversas.php\"> continuar </A>"; 	
}

echo "no seleccionado";	
?>


</html>