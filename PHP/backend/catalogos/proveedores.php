<?php include("../inc/menu.php");?>
 <body>   
<TABLE>
<TH>CODIGO</TH><th>NOMBRE</th><th>DOMICILIO</th><th>CIUDAD</th><th>TEL</th><th>FAX</th><th>RFC</th>
<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'inventario');
$mysqli->set_charset("utf8");
if(!isset($_GET['page']))
{  
    $page = 1; 
} else { $page = $_GET['page'];} 
$max_results = 30;  $from = (($page * $max_results) - $max_results); 
function error_report () {echo "Error: ".mysql_errno()."; error description: ".mysql_error()."<br>\n";}
$query = "SELECT * FROM proveedores ORDER BY cprov ASC LIMIT $from, $max_results;";
$result = mysqli_query($mysqli,$query);
while( $row = mysqli_fetch_array($result))
{
echo  
'<tr><td>',$row['cprov'], 
'</td><td>',$row['nombre'],
'</td><td>', $row['domicilio'],
'</td><td>', $row['ciudad'],
'</td><td>',$row['tel'],
'</td><td>',$row['fax'],
'</td><td>',$row['rfc'],
'</td><td><a href="productosxproveedor.php?cprov=',$row['cprov'],'">productos</a></td></tr>';
echo "\n";
}

function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

$total_results = mysqli_result(mysqli_query($mysqli,"SELECT COUNT(*) as Num FROM proveedores"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>seleccionar pagina<br />"; 
if($page > 1)
{    
$prev = ($page - 1); 
echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\"><<Previa</a>&nbsp;"; 
} 
for($i = 1; $i <= $total_pages; $i++){   if(($page) == $i){ echo "$i&nbsp;"; } else { echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a>&nbsp;"; } } 
if($page < $total_pages){ $next = ($page + 1); echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">siguiente>></a>"; } 
echo "</center>"; 

?>
</TABLE>

</html>