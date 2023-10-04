<?php include("../inc/menu.php");?>
ELIMINAR PRODUCTO
<p>
<TABLE>
<form action="eliminarproducto.php?accion=preguntar" method=POST>
<TR><TD>CODIGO DEL PROVEEDOR</TD><TD><input type="text" class=textfield name="cprov"></TD></TR>
<TR><TD># DEL PRODUCTO</TD><TD><input type="text" class=textfield name="cprod"></TD></TR>
<TR><TD><input type="submit" value="buscar"></TD></TR>
</form>
</TABLE>
<TABLE>
<TR>
<?php
$mysqli = new mysqli("localhost","root","");
mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));



if(urlencode(@$_REQUEST['accion']) == "seguro"){
     $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
     $cprod=mysqli_real_escape_string($mysqli,$_REQUEST['cprod']);
     mysqli_query($mysqli,"DELETE  FROM PRODUCTOS	WHERE CPROV='$cprov' AND CPROD='$cprod';");
}

if(urlencode(@$_REQUEST['cprov']) != "" && urlencode(@$_REQUEST['cprod'])!= "" && urlencode(@$_REQUEST['accion'])=="preguntar")	{
        $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
        $cprod=mysqli_real_escape_string($mysqli,$_REQUEST['cprod']);
        $seleccion = mysql_query ("select * from productos where cprov='$cprov' and cprod='$cprod';");
        
        while($s= mysqli_fetch_array($seleccion)){
        echo '<td>'.$s['cprov'],'</td><td>'.$s['cprod'],'</td><td>'.$s['descripcion'],'</td><td><a href="eliminarproducto.php?accion=seguro&cprov='.$s['cprov'],'&cprod='.$s['cprod'],'">eliminar</A></td>';
}
}
?>
</table>
</HTML>