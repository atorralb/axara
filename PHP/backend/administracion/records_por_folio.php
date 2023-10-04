<?php include("../menu2.inc");
include 'pagination.php';
?>

<form action=records_por_folio.php?accion=buscar method=post>
<input type=text  class=textfield name="folio">FOLIO
<input type=submit name="buscar" value="buscar">
<br>
</form>
<TABLE>

<?php
$mysqli = new mysqli("localhost","root",""); mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));

if(!isset($_GET['page'])){  $page = 1; } else { 
$page = $_GET['page'] ;} 
$max_results = 30;  
$from = (($page * $max_results) - $max_results); 
function error_report () {echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";}


//eliminar records de una tabla
if(urlencode(@$_REQUEST['accion'])=="eliminar"){
    $id=mysqli_real_escape_string($mysqli,$_REQUEST['id']);
    mysqli_query($mysqli,"DELETE FROM entradas_y_salidas WHERE id='$id';");
}

elseif(urlencode(@$_REQUEST['accion'])=="actualizarfolio"){
$movimiento = urlencode(@$_REQUEST['movimiento']);
$movimiento2 = urlencode(@$_REQUEST['movimiento2']);
$almacen1 = urlencode(@$_REQUEST['almacen1']);
$almacen2 = urlencode(@$_REQUEST['almacen2']);
$fecha = urlencode(@$_REQUEST['fecha']);
$fecha2 = urlencode(@$_REQUEST['fecha2']);
$factura = urlencode(@$_REQUEST['factura']);
$concepto = urlencode(@$_REQUEST['concepto']);
$nombre_entrego  = urlencode(@$_REQUEST['nombre_entrego']);
$nombre_recibio = urlencode(@$_REQUEST['nombre_recibio']);
$nombre_autorizo = urlencode(@$_REQUEST['nombre_autorizo']);
$folio = urlencode(@$_REQUEST['folio']);

mysqli_query($mysqli,"UPDATE entradas_y_salidas set movimiento='$movimiento2',
almacen1 ='$almacen1',
almacen2 ='$almacen2',
fecha ='$fecha2',
factura='$factura',
concepto='$concepto',
ne='$nombre_entrego',
nr='$nombre_recibio',
na='$nombre_autorizo'
where folio='$folio' and fecha='$fecha' and movimiento='$movimiento';");
}

elseif(urlencode(@$_REQUEST['accion'])=="buscar"){
    $folio=mysqli_real_escape_string($mysqli,$_REQUEST['folio']);
    $header = mysqli_query($mysqli,"select f, fecha, movimiento, almacen1, almacen2, factura, concepto, ne, nr, na from entradas_y_salidas where f = '$folio' limit 1");  
    while($s = mysqli_fetch_array($header))        {

        extract($s);

        echo	"<b>foio</b> ".$f."<br>"
		."<b>fecha</b> ".$fecha."<br>"
		."<b>movimiento</b> ".$movimiento."<br>"
		."<b>entrada</b> ".$almacen1."<br>"
		."<b>salida</b> ".$almacen2."<br>"
		."<b>factura</b> ".$factura."<br>"
		."<b>concepto</b> ".$concepto."<br>"
		."<b>entrego:</b> ".$ne."<br>"
		."<b>recibio:</b> ".$nr."<br>"
		."<b>autorizo:</b> ".$na;
}
echo "<th>CANTIDAD</TH>
<TH>PROVEEDOR</TH>
<TH>PRODUCTO</TH>
<TH>DESCRIPCION
</TH><TH>COSTO</TH><th>P.V</th><th>IMPORTE</th><TH>COMANDO</TH>";
$seleccion = mysqli_query($mysqli,
"select 	
if(pv2 = 0, 
Round(if(tasa0 = 0, productos.costodecompra/tasa0, 
(productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), 
pv2)
AS pv, 
		entradas_y_salidas.cantidad*productos.costodecompra AS spcc,  
		entradas_y_salidas.id, 
		entradas_y_salidas.cprov, 
		entradas_y_salidas.cprod, 
		entradas_y_salidas.cantidad, 
		entradas_y_salidas.fecha_capturado,
		productos.descripcion, 
		productos.costodecompra 
		from 
		entradas_y_salidas, productos where f = '$folio'  
		AND 
		entradas_y_salidas.cprov = productos.cprov  
		AND 
		entradas_y_salidas.cprod = productos.cprod
		ORDER BY ID ASC");
while($s = mysqli_fetch_array($seleccion))
{
extract($s);
echo"<tr><td>".$cantidad.
"</td><td>".$cprov.
"</td><td>".$cprod.
"</td><td>".$descripcion.
"</td><td>".$costodecompra.
"</td><td>".$pv.
"</td><td>".$pv * $cantidad."</td><td>".$fecha_capturado."</td><td>";

echo '<a href="records_por_folio.php?folio=',$f,'&accion=eliminar&id=',$id,'">eliminar</a></tr>';
}

$total_results = mysql_result(mysqli_query($mysqli,"select COUNT(*) from entradas_y_salidas where f = '$folio'"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>seleccionar pagina<br />"; 
if($page > 1){    $prev = ($page - 1); 
echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&accion=buscar&folio=$folio\"><<Previa</a>&nbsp;"; } 
for($i = 1; $i <= $total_pages; $i++){   if(($page) == $i){ echo "$i&nbsp;"; } else { echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&accion=buscar&folio=$folio\">$i</a>&nbsp;"; } } 
if($page < $total_pages){ $next = ($page + 1); echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&accion=buscar&folio=$folio\">siguiente>></a>"; } 
echo "</center>";

}

?>
</TABLE>
<form action=records_por_folio.php?accion=actualizarfolio method=post>
folio:<input type=text name="folio">
fecha:<input type=text name="fecha">
#movimiento<input type=text name="movimiento">

cambiar a:
<SELECT class=select name="movimiento2"> 
<OPTION value="1">Entradas por compras  
<OPTION value="2">Salidas por devolucion de proveedores  
</OPTION> 
<option value="3">Salidas por venta de mostrador
</option>
<option value="4">Traspasos
</option>
<option value="5">Entradas diversas
</option>
<option value="6">Salidas Diversas
</option>
</select>
<br>

<input type=text name=almacen1>almacen_entrada
<br>

<input type=text name=almacen2>almacen_salida
<br>

<input type=text name=fecha2>fecha
<br>

<input type=text name=factura>factura
<br>

<input type=text name=concepto>concepto
<br>

<input type=text name=nombre_entrego>nombre_entrego
<br>
<input type=text name=nombre_recibio>nombre_recibio
<br>
<input type=text name=nombre_autorizo>nombre_autorizo
<br>
<input type=submit value="actualizar folio">
</form>


<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
</script>	
</html>