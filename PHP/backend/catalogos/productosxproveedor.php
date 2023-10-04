<?php
 include("../inc/menu.php");
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
if (urlencode(@$_REQUEST['accion'])=="actualizarproveedor")
	{
	$nombre=mysqli_real_escape_string($mysqli,$_REQUEST['nombre']);
    $domicilio=mysqli_real_escape_string($mysqli,$_REQUEST['domicilio']);
    $ciudad=mysqli_real_escape_string($mysqli,$_REQUEST['ciudad']);
    $tel=mysqli_real_escape_string($mysqli,$_REQUEST['tel']);
    $fax=mysqli_real_escape_string($mysqli,$_REQUEST['fax']);
    $encargado=mysqli_real_escape_string($mysqli,$_REQUEST['encargado']);
    $rfc=mysqli_real_escape_string($mysqli,$_REQUEST['rfc']);
    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
	
	mysqli_query($mysqli,"UPDATE proveedores SET nombre = '$nombre', domicilio= '$domicilio', ciudad = '$ciudad', tel = '$tel', fax = '$fax', encargado = '$encargado', rfc = '$rfc' WHERE  cprov = '$cprov';");
	}
elseif(urlencode(@$_REQUEST['accion'])=="actualizarproducto"){

    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
    $cprod=mysqli_real_escape_string($mysqli,$_REQUEST['cprod']);
    $descripcion=mysqli_real_escape_string($mysqli,$_REQUEST['descripcion']);
    $costodecompra=mysqli_real_escape_string($mysqli,$_REQUEST['costodecompra']);
    $tasa15=mysqli_real_escape_string($mysqli,$_REQUEST['tasa15']);
    $tasa0=mysqli_real_escape_string($mysqli,$_REQUEST['tasa0']);
    $unidad=mysqli_real_escape_string($mysqli,$_REQUEST['unidad']);
    $pv2=mysqli_real_escape_string($mysqli,$_REQUEST['pv2']);
    $precio_mayoreo=mysqli_real_escape_string($mysqli,$_REQUEST['precio_mayoreo']);

    mysqli_query($mysqli,"UPDATE productos SET cprov = '$cprov', cprod = '$cprod', descripcion = '$descripcion', costodecompra = '$costodecompra', unidad = '$unidad', pv2 = '$pv2', precio_mayoreo='$precio_mayoreo',
	tasa15 = '$tasa15',
	tasa0  = '$tasa0'
	WHERE cprov = '$cprov' AND cprod = '$cprod';");
}
?>
<TABLE>
<form action="productosxproveedor.php?accion=actualizarproveedor" method="post">
<?php
$cprov=mysqli_real_escape_string($mysqli, $_REQUEST['cprov']);
$encabezado = mysqli_query($mysqli,"select * from proveedores where cprov = '$cprov';");
while($e = mysqli_fetch_array($encabezado))
{
echo '<tr><td>CODIGO</td><TD>
    <input type="text" class=tlargo value="'.$e['cprov'].'" name="cprov"></TD></TR>
        <TR><TD>NOMBRE</TD><TD><input type="text" class=tlargo  value="'.$e['nombre'].'" name="nombre"></TD></TR>
            <TR><TD>CIUDAD</TD><TD><input type="text" class=tlargo value="'.$e['ciudad'].'" name="ciudad"></TD></TR>
                <TR><TD>DOMICILIO</TD><TD><input type="text" class=tlargo value="'.$e['domicilio'].'" name="domicilio"></TD></TR>
                    <TR><TD>TEL</TD><TD><input type="text" class=tlargo value="'.$e['tel'].'" name="tel"></TD></TR>
                        <TR><TD>FAX</TD><TD><input type="text" class=tlargo value="'.$e['fax'].'" name="fax"></TD></TR>
                            <TD>ENCARGADO</TD><TD><input type="text" class=tlargo value="'.$e['encargado'].'" name="encargado"></TD></TR>
                                <TR><TD>RFC</TD><TD><input type="text" class=tlargo value="'.$e['rfc'].'" name="rfc"></TD></TR>';
}
 ?>
 <TR>
 <TD>
 <input type="submit" value="actualizar proveedor">
</TD>
</TR>
 </form>
</TABLE>
<P>
<TABLE>
<TH>CODIGO</TH><TH>DESCRIPCION</TH><TH>C.C</TH><th>P.V</th><th>TASA 15</th><th>TASA 0</th><th>UNIDAD</th><th>p.mayoreo</th><th>COMANDO</th>
<?php
if(!isset($_GET['page'])){  $page = 1; } else { $page = $_GET['page'];} $max_results = 30;  $from = (($page * $max_results) - $max_results); 

$proveedor=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);

$result = mysqli_query($mysqli,"SELECT  
if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv, 
 cprov, cprod, descripcion, costodecompra, tasa15, tasa0, unidad, precio_mayoreo
FROM
productos 
WHERE
cprov = '$proveedor' 
OR
cprov = '$cprov'
ORDER BY 
cprod ASC
LIMIT $from, $max_results;");

while($row = mysqli_fetch_array($result)){
    

    echo '<tr><td width = 100>', $row['cprod'], 
            '</td><td>',$row['descripcion'], 
            '</td><td>',$row['costodecompra'],
            '</td><td>'.$row['pv'],
            '</td><td>'.$row['tasa15'],
            '</td><td>'.$row['tasa0'],
            '</td><td>'.$row['unidad'],
            '</td><td>'.$row['precio_mayoreo'],'</td><td><a href="editarproducto.php?',$row['cprov'],'&',$row['cprod'],'">EDITAR</A></td></tr>';
       
    echo "\n";
}

//$pages_query = mysqli_query($conn, 'SELECT COUNT(id) FROM users'); 
/*
$total_results = mysqli_query($mysqli,"SELECT COUNT(*) as Num FROM productos where cprov= '$proveedor' OR cprov = '$cprov'"); 
$row = mysqli_fetch_array($total_results);
$total_pages = ceil($total_results / $max_results); 
echo "<center>seleccionar pagina<br />"; 
if($page > 1){    $prev = ($page - 1); echo "<a href=\"".$_SERVER['PHP_SELF']."?cprov=$cprov&page=$prev\"><<Previa</a>&nbsp;"; } 
for($i = 1; $i <= $total_pages; $i++){   if(($page) == $i){ echo "$i&nbsp;"; } else { echo "<a href=\"".$_SERVER['PHP_SELF']."?cprov=$cprov&page=$i\">$i</a>&nbsp;"; } } 
if($page < $total_pages){ $next = ($page + 1); echo "<a href=\"".$_SERVER['PHP_SELF']."?cprov=$cprov&page=$next\">siguiente>></a>"; } 
echo "</center>"; 
*/
?>
</TABLE>