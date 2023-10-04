<?php
use Sglms\Gs1Gtin\Gtin;
use Sglms\Gs1Gtin\Gtin12;
use Sglms\Gs1Gtin\Gs1;

require_once 'gtin-gs1/vendor/autoload.php';
require_once '../inc/config.php';
$gtin12 = Gtin12::create(1, 750141);    // Item Reference + Client Prefix
// GTIN-12: 614141000012
// Save barcode
$gtin12->saveBarcode('../../images/products/');


date_default_timezone_set( "America/Mexico_City");
header('Content-Type: application/json; charset=utf-8');
$data = array("a" => "Apple", "b" => "Ball", "c" => "Cat");
$cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
$cprod=mysqli_real_escape_string($mysqli,$_REQUEST['cprod']);
$descripcion=mysqli_real_escape_string($mysqli,$_REQUEST['descripcion']);
$costodecompra=mysqli_real_escape_string($mysqli,$_REQUEST['costodecompra']);
$tasa15=mysqli_real_escape_string($mysqli,$_REQUEST['tasa15']);
$tasa0=mysqli_real_escape_string($mysqli,$_REQUEST['tasa0']);
$unidad=mysqli_real_escape_string($mysqli,$_REQUEST['unidad']);
$pv2=mysqli_real_escape_string($mysqli,$_REQUEST['pv2']);
$precio_mayoreo=mysqli_real_escape_string($mysqli,$_REQUEST['precio_mayoreo']);
$categoria=mysqli_real_escape_string($mysqli,$_REQUEST['categoria']);
$subcategoria=mysqli_real_escape_string($mysqli,$_REQUEST['subcategoria']);
$imagen =   $cprov. $cprod. '-'. $costodecompra. '-'. $pv2;
$codigo_impresion  = $cprod. '-'.$costodecompra.'-'.$pv2;
$fecha_de_alta = date("Y-m-d H:i:s");         
if (isset($_POST['cprov'])) {
    $countfiles = count($_FILES['files']['name']);
    for($i=0;$i<$countfiles;$i++){
    $filename = $cprov.$cprod.$i.'.jpg';
    move_uploaded_file($_FILES['files']['tmp_name'][$i],'../../images/products/'.$filename);  
 }
}
   // mysql_query("insert into productos ( imagen ) values ('$filename') where cprov='$cprov' and cprod='$cprod';");
$mysqli->query("REPLACE INTO productos
(cprov, cprod, descripcion, costodecompra, tasa15, tasa0, unidad, pv2, precio_mayoreo, categoria, subcategoria, imagen, codigo_impresion, fecha_de_alta)
VALUES
('$cprov',$cprod,'$descripcion',$costodecompra,$tasa15,$tasa0,'$unidad',$pv2,$precio_mayoreo,'$categoria','$subcategoria','$imagen', '$codigo_impresion', '$fecha_de_alta');");
echo json_encode($data);
exit();
?>
