<?php include("../menu2.inc");?>
<form action=bp.php?accion=buscar method=post>
<table>
<tr><td>PALABRA</TD><td><input type=text class=tlargo name="palabra"></td></tr>
<tr><td><input type="submit" value="buscar"></td></tr>
</table>
</form>

<table>
<tr>
<th>cprov</th><th>cprod</th><th>descripcion</th><th>costodecompra</th><th>p.v</th><th>tasa 15 </th><th>tasa 0</th><th>unidad</th>
</tr>
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));

$accion = urlencode(@$_REQUEST['accion']);
$var = @$_POST['palabra'] ; 

if($accion == "buscar")
{



$resultado = mysqli_query($mysqli,"
select if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv,
cprov, cprod, descripcion, costodecompra, tasa15, tasa0, unidad
from productos where descripcion LIKE  '%$var%'  order by cprov;");
while($r = mysqli_fetch_array($resultado))
{
extract($r);
	echo '<tr><td>',$cprov,'</td><td>',$cprod, '</td><td>',$descripcion,'</td><td>',$costodecompra,'</td><td>',$pv,'</td><td>'.$tasa15,'</td><td>',$tasa0,	
	'</td><td>'.$unidad,'</td></tr>';
}

}
?>
</table>
   <script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</html>
