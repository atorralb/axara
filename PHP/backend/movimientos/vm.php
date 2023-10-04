<?
	session_start();
	session_register("folio");
	$db = $mysqli = new mysqli("localhost","root", "");  
     mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
?>
<html>
<STYLE>
@import url(../gui.css);
</STYLE>
<TABLE>
<tr><br><th>FOLIO</th><th>FECHA</th><th>ALMACEN</th><th>CONCEPTO</th><th>N.E</th><th>N.R</th><th>N.A</th></tr>
<?
	$f = array($a, $m, $d);
	$f1 = $f[0];
	$f2 =$f[1];
	$f3 = $f[2];
	$fecha1 = "$f1-$f2-$f3";

	mysqli_query($mysqli,"INSERT INTO vm (fecha, movimiento, almacen1, almacen2, concepto, ne, nr, na, factura) VALUES ('$fecha1', '3', '0', '$almacen', '$concepto', '$ne', '$nr', '$na', 'no');");
	$rmf = mysqli_query($mysqli,"select max(folio) as maxfolio from vm;"); 
     $mf = mysqli_fetch_array($rmf); 
     $maxfolio = $mf['maxfolio'];
	
	//sesiones
	$_SESSION['folio'] = $maxfolio;    
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['almacen2'] = $almacen;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;
	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM vm WHERE folio = '$folio';");


	while( $row=mysqli_fetch_array($result))
	{	
	echo "<tr><td>".$row['folio']."</td><td>$f1-$f2-$f3</td><td>".$row['almacen2']."</td><td>".$row['concepto']."</td><td>".$row['ne']."</td><td>".$row['nr']."</td><td>".$row['na']."</td></tr>";
	echo "\n";
	}			
?>
</TABLE>
<P>
¿es correcto? 
<a href ="rvm.php"> ¿si?</A> 	