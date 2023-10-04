<?php include("../inc/menu.php");?>
<table>
<form id="formDataExample" action=agregarproducto.php method=GET enctype="multipart/form-data">
    <TR><TD>CODIGO DE PROVEEDOR</TD><TD><input type="text" name=cprov class=textfield ></TD></TR>
    <TR><TD># PRODUCTO</TD><TD><input type="text" class=textfield name=cprod></TD></TR>
    <TR><TD>DESCRIPCION</TD><TD><input type="text" class=tlargo name=descripcion></TD></TR>
    <TR><TD>COSTO DE COMPRA</TD><TD><input type="text" class=textfield name=costodecompra></TD>
    <TR><TD>PRECIO DE VENTA DESEADO</TD><TD><input type="text" class=textfield name=pv2 value=0.00></TD>
    <TR><TD>TASA 0</TD><TD><input type="text" class=textfield name=tasa0 value=0.65></TD></TR>
    <TR><TD>TASA 15</TD><TD><input type="text" class=textfield name=tasa15 value=0.00 ></TD></TR>
    <TR><TD>UNIDAD</TD><TD>
        <select name="unidad" id="unidad">
            <option value="PIEZA">PIEZA</option>
            <option value="DOCENA">DOCENA</option>
            <option value="KILO">KILO</option>
            <option value="MEDIO KILO">MEDIO KILO</option>
            <option value="CUARTO DE KILO">CUARTO DE KILO</option>
            <option value="FRASCO">FRASCO</option>
            <option value="FRASCO">BULTO</option>
            <option value="VASO">VASO</option>
            <option value="CAJA">CAJA</option>
        </select>
    </TD></TR>
    <TR><TD>PRECIO MAYOREO</TD><TD><input type="text" class=tlargo name=precio_mayoreo></TD></TR>
    <TR><TD>CATEGORIA</TD><TD>
            <select name="categoria" id="categoria">
            <option value="LENTES">LENTES</option>
            <option value="COMIDA">COMIDA</option>
            <option value="ROPA">ROPA</option>
            <option value="ELECTRONICOS">ELECTRONICOS</option>
            </select>
    </TD></TR>
    <TR><TD>SUBCATEGORIA</TD><TD>
            <select name="subcategoria" id="subcategoria">
            <option value="LENTES SOL">SOL</option>
            <option value="LENTES AUMENTO">AUMENTO</option>
            <option value="LENTES ACCESORIOS">ACCESORIOS</option>
            <option value="ROPA">ROPA</option>
            <option value="ELECTRONICOS">ELECTRONICOS</option>
            </select>

    </TD></TR>
    <TR><TD>AGREGAR IMAGENES</TD><TD>
<div id="drag-drop-area"></div>
<?php require_once '../inc/uppy_script.php';?>
<TR><TD><input type="submit" value="agregar"></TD></TR>
</form>
</table>
<P>
<TABLE><th>PROVEEDOR</th><th>CODIGO</th><th>DESCRIPCION</th><th>C.C</th><th>P.V</th><th>TASA 0</th><th>TASA 15</th><th>UNIDAD</th>
<?php
require_once '../inc/config.php';

if(urlencode(@$_REQUEST['cprov']) != "" && urlencode(@$_REQUEST['cprod']) !="")	{  
    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
    $cprod=mysqli_real_escape_string($mysqli,$_REQUEST['cprod']);
    $descripcion=mysqli_real_escape_string($mysqli,$_REQUEST['descripcion']);
    $costodecompra=mysqli_real_escape_string($mysqli,$_REQUEST['costodecompra']);
    $tasa15=mysqli_real_escape_string($mysqli,$_REQUEST['tasa15']);
    $tasa0=mysqli_real_escape_string($mysqli,$_REQUEST['tasa0']);
    $unidad=mysqli_real_escape_string($mysqli,$_REQUEST['unidad']);
    $pv2=mysqli_real_escape_string($mysqli,$_REQUEST['pv2']);
    $precio_mayoreo=mysqli_real_escape_string($mysqli,$_REQUEST['precio_mayoreo']);
    
    mysql_query("insert into productos (cprov, cprod,  descripcion, costodecompra, tasa15, tasa0, unidad, pv2, precio_mayoreo)values 
        ('$cprov',  '$cprod', '$descripcion', '$costodecompra', '$tasa15', '$tasa0', '$unidad', '$pv2','$precio_mayoreo' );");
    
   $result=mysql_query
        ("SELECT if(pv2 = 0, Round(if(tasa0 = 0, productos.costodecompra/tasa0, (productos.costodecompra*productos.tasa15+costodecompra)/tasa0)), pv2) AS pv,  
           productos.descripcion, productos.costodecompra, productos.cprov, productos.cprod, productos.tasa0, productos.tasa15, productos.unidad 
           FROM  productos WHERE cprov = '$cprov' and cprod='$cprod';");
   header('Content-Type: application/json; charset=utf-8');
 	
    while( $row=mysqli_fetch_array($result)){
		echo "<tr><td>".$row['cprov']."</td>";
		echo "<td>".$row['cprod']."</td>";
		echo "<td>".$row['descripcion']."</td>"; 
		echo "<td>$".$row['costodecompra']."</td>"; 
		echo "<td>$".$row['pv']."</td>"; 
		echo "<td>$".$row['tasa0']."</td>"; 
		echo "<td>$".$row['tasa15']."</td>";
		echo "<td>".$row['unidad']."</td>"; 		
		echo "</tr>";
		echo "\n";
	}
}
?>	
</TABLE>