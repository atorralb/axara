<TABLE>
<STYLE>
@import url(../gui.css);
</STYLE>
<tr><th>FOLIO</th><th>FECHA</th><th>DESTINO</th><th>ORIGEN</th><th>CONCEPTO</th><th>N.E</th><th>N.R</th><th>N.A</tr>
<tr>
<?
	session_start();
	session_register("folio");
	$f = array($a, $m, $d);
	$f1 = $f[0];
	$f2 =$f[1];
	$f3 = $f[2];
	$fecha1="$f1-$f2-$f3";
	$db = $mysqli = new mysqli("localhost","root", "");  
    mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
	mysqli_query($mysqli,"INSERT INTO st (fecha, movimiento, almacen1, almacen2, concepto, ne, nr, na, factura) VALUES('$fecha1', '4', '$almacen1', '$almacen2', '$concepto', '$ne', '$nr', '$na', '$factura');");
	$rmf = mysqli_query($mysqli,"select max(folio) as maxfolio from st;"); 
    $mf = mysqli_fetch_array($rmf); 
    $maxfolio = $mf['maxfolio'];
	//sesion
	$_SESSION['folio'] = $maxfolio;    
	$_SESSION['fecha'] = $fecha1;
	$_SESSION['almacen1'] = $almacen1;
	$_SESSION['almacen2'] = $almacen2;
	$_SESSION['concepto'] = $concepto;
	$_SESSION['ne'] = $ne;
	$_SESSION['nr'] = $nr;
	$_SESSION['na'] = $na;

	$folio = $maxfolio;	
	$result = mysqli_query($mysqli,"SELECT * FROM st WHERE folio = '$folio';");

	while( $row=mysqli_fetch_array($result))
	{	echo "<td>".$row['folio']."</td><td>$fecha1</td><td>".$row['almacen1']."</td><td>".$row['almacen2']."</td><td>".$row['concepto']."</td><td>".$row['ne']."</td><td>".$row['nr']."</td><td>".$row['na']."</td></tr>";
	echo "\n";
	}			
?>
</TABLE>
¿es correcto? 
<a href ="rst.php"> ¿si?</A> 	