<title>concentrado</title>
<?include("../menu2.inc");?>

proveedor

<form action="concentrado.php?execute=true" method=post>
<input type=text  class=textfield name="proveedor"/>
</form>
<table>
<th>CLAVE</th>
<th>PRODUCTO</th>
<th>BODEGA</th>
<th>AV. 2A</th>
<th>AV 2</th>
<th>PLAZA</th>
<th>AV. 8</th>
<th>C. 3</th>
<th>CUIT.</th>
<!--
<th>SUPER</th>
-->
<th>C. 11</th>
<th>TOTAL</th>

<?
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
		
if($execute=="true")
{
if(!isset($_GET['page'])){  $page = 1; } 
else { $page = $_GET['page'];} 
$max_results = 200;  
$from = (($page * $max_results) - $max_results); 
function error_report () {
echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";
}

 
	 
$ti = mysqli_query($mysqli,"create temporary table inventario select 
cprod, cprov, 
sum(if(almacen1=1, cantidad, 0)) - sum(if(almacen2=1, cantidad, 0)) as inventario_tienda_1,
sum(if(almacen1=2, cantidad, 0)) - sum(if(almacen2=2, cantidad, 0)) as inventario_tienda_2,
sum(if(almacen1=3, cantidad, 0)) - sum(if(almacen2=3, cantidad, 0)) as inventario_tienda_3,
sum(if(almacen1=4, cantidad, 0)) - sum(if(almacen2=4, cantidad, 0)) as inventario_tienda_4,
sum(if(almacen1=5, cantidad, 0)) - sum(if(almacen2=5, cantidad, 0)) as inventario_tienda_5,
sum(if(almacen1=6, cantidad, 0)) - sum(if(almacen2=6, cantidad, 0)) as inventario_tienda_6,
sum(if(almacen1=7, cantidad, 0)) - sum(if(almacen2=7, cantidad, 0)) as inventario_tienda_7,
sum(if(almacen1=8, cantidad, 0)) - sum(if(almacen2=8, cantidad, 0)) as inventario_tienda_8,
sum(if(almacen1=9, cantidad, 0)) - sum(if(almacen2=9, cantidad, 0)) as inventario_tienda_9,
sum(if(almacen1=10, cantidad, 0)) - sum(if(almacen2=10, cantidad, 0)) as inventario_tienda_10,
sum(if(almacen1=11, cantidad, 0)) - sum(if(almacen2=11, cantidad, 0)) as inventario_tienda_11,
sum(if(almacen1=12, cantidad, 0)) - sum(if(almacen2=12, cantidad, 0)) as inventario_tienda_12
from entradas_y_salidas where entradas_y_salidas.cprov='$_REQUEST[proveedor]'  
group by cprov, cprod;");

$query = "select * from inventario inner join productos productos on inventario.cprov = productos.cprov and 
inventario.cprod = productos.cprod;";
$result = mysqli_query($mysqli,$query);

while( $row = mysqli_fetch_array($result))
{
extract($row);
echo  
'<tr><td>',$cprov, $cprod, 
'</td><td>',$descripcion,
'</td><td>',$inventario_tienda_1,
'</td><td>',$inventario_tienda_2,
'</td><td>',$inventario_tienda_3,
'</td><td>',$inventario_tienda_4,
'</td><td>',$inventario_tienda_6,
'</td><td>',$inventario_tienda_7,
'</td><td>',$inventario_tienda_8,
'</td><td>',$inventario_tienda_11,
'</td><td>',$inventario_tienda_12,
'</td><td>', $inventario_tienda_1 + $inventario_tienda_2 + $inventario_tienda_3 + $inventario_tienda_4 + $inventario_tienda_6 + $inventario_tienda_7 + $inventario_tienda_8  +  $inventario_tienda_11 + $inventario_tienda_12,
'</td></tr>';
echo "\n";
}

$total_results = mysql_result(mysqli_query($mysqli,"SELECT COUNT(*) as Num FROM inventario inner join productos productos on inventario.cprov = productos.cprov and 
inventario.cprod = productos.cprod"),0); 
$total_pages = ceil($total_results / $max_results); 

echo "<center>seleccionar pagina<br />"; 
if($page > 1){    $prev = ($page - 1);
 echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\"><<Previa</a>&nbsp;"; } 
for($i = 1; $i <= $total_pages; $i++){   
if(($page) == $i){ echo "$i&nbsp;"; } 
else { echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a>&nbsp;"; } 
} 
if($page < $total_pages){ 
$next = ($page + 1); echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">siguiente>></a>"; 
} 
echo "</center>"; 
}
?>
