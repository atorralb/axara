<title>concentrado</title>
<?php include("../menu2.inc");?>

proveedor

<form action="concentrado.php?execute=true" method=post>
<input type=text  class=textfield name="proveedor"/>
</form>
<table  style="font-size:smaller;">
<th>CLAVE</th>
<th>PRODUCTO</th>
<th>BODEGA</th>
<th>AV. 2A</th>
<th>AV 2</th>
<th>PLAZA</th>
<th>C. 13</th>
<th>C. 3</th>
<th>CUIT.</th>
<!--
<th>SUPER</th>
-->

<th>C. 11</th>
<th>SORIANA</th>
<th>AV. 4</th>
<th>TOTAL</th>

<?php 
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
		
if(urlencode(@$_REQUEST['execute'])=="true"){

$proveedor = urlencode(@$_REQUEST['proveedor']);
 
	 
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
sum(if(almacen1=12, cantidad, 0)) - sum(if(almacen2=12, cantidad, 0)) as inventario_tienda_12,
sum(if(almacen1=13, cantidad, 0)) - sum(if(almacen2=13, cantidad, 0)) as inventario_tienda_13,
sum(if(almacen1=14, cantidad, 0)) - sum(if(almacen2=14, cantidad, 0)) as inventario_tienda_14
from entradas_y_salidas where entradas_y_salidas.cprov='$proveedor'  
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
'</td><td>',$inventario_tienda_12,
'</td><td>',$inventario_tienda_13,
'</td><td>',$inventario_tienda_14,
'</td><td>', $inventario_tienda_1 + $inventario_tienda_2 + $inventario_tienda_3 + $inventario_tienda_4 + $inventario_tienda_6 + $inventario_tienda_7 + $inventario_tienda_8  +  $inventario_tienda_11 + $inventario_tienda_12 + $inventario_tienda_13 + $inventario_tienda_14,
'</td></tr>';
echo "\n";
}
}
?>
