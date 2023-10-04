<?php include("../menu2.inc");?>
<HTML font-size= "12px">

<title>inv.x.prov</title>
<TABLE>
<form action="inventario_por_proveedor.php?accion=buscar" method=post>
<TR>
<TD>
<SELECT class=select name="almacen">
<OPTION value="1">BODEGA  
<OPTION value="2">AV. 2A  
</OPTION> 
<option value="3">AV. 2
</option>
<option value="4">PLAZA CRYSTAL
</option>
<!--
YA NO SE UTILIZA POR QUE SIGUE CON PRODUCTOS CARGADOS
<option value="5">CALLE 11
</option>
-->
<option value="6">CALLE 13
</option>
<option value="7">CALLE 3
</option>
<option value="8">CUITLAHUAC
</option>
<!-- YA NO SE UTILIZA POR QUE SIGUE CON PRODUCTOS CARGADOS
<option value="10">TIENDA SUPER</option>
-->
<option value="11"> Av. 5</option>
<option value="12"> CALLE 11</option>
<option value="13"> SORIANA</option>
<option value="14"> AVENIDA 4</option>
<option value="15"> TIENDA X</option>
<option value="16"> TIENDA Y</option>
</SELECT> 
</TD>
</TR>
<TR>
<TD>
PROVEEDOR
</TD>
<TD>
<input type=text class=textfield name="cprov" value="<?php echo urlencode(@$_REQUEST['cprov']);?>">
</TD>
</TR>
<TR>
<TD></TD><TD>#AAAA</TD><TD> #MM</TD> <TD> #DD</TD>
</TR>
<TR>
<TD>DESDE</TD>
<TD><input type=text  class=textfield name="da"  value="<?php echo urlencode(@$_REQUEST['da']);?>"></TD>
<TD><input type=text  class=textfield name="dm"  value="<?php echo urlencode(@$_REQUEST['dm']);?>"></TD>
<TD><input type=text  class=textfield name="dd"  value="<?php echo urlencode(@$_REQUEST['dd']);?>"></TD>
</TR>
<TR>
<TD></TD><TD>#AAAA</TD><TD>#MM</TD><TD>#DD</TD>
</TR>
<TR>
<TD>HASTA</TD>
<TD><input type=text  class=textfield name="ha" value="<?php echo urlencode(@$_REQUEST['ha']);?>"></TD>
<TD><input type=text  class=textfield name="hm" value="<?php echo urlencode(@$_REQUEST['hm']);?>"></TD>
<TD><input type=text  class=textfield  name="hd" value="<?php echo urlencode(@$_REQUEST['hd']);?>"></TD>
</TR>
<TR><TD><input type=submit  value="buscar"></form></TD></TR>
</TABLE>
<table  style="font-size:smaller;"><th>PRODUCTO</th><th>DESCRIPCION</th><th>INVENTARIO INICIAL</th><th>ENTRADAS</th><th>SALIDAS</th><th>INVENTARIO FINAL</th>
<?php 
$mysqli = new mysqli("localhost","root",""); mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
if(urlencode(@$_REQUEST['accion'])=="buscar"){
    
    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
    $almacen = urlencode(@$_REQUEST['almacen']); 
    $dd = urlencode(@$_REQUEST['dd']); 
    $da = urlencode(@$_REQUEST['da']); 
    $dm = urlencode(@$_REQUEST['dm']);
    $ha = urlencode(@$_REQUEST['ha']);
    $hd = urlencode(@$_REQUEST['hd']);
    $hm = urlencode(@$_REQUEST['hm']); 
    

    $ti = mysqli_query($mysqli,"create temporary table inventario select 
@entradas:= sum(if(almacen1=$almacen AND fecha >=$da$dm$dd and fecha <=$ha$hm$hd, cantidad, 0)) as entradas, 
@salidas:= sum(if(almacen2=$almacen AND fecha >=$da$dm$dd and fecha <=$ha$hm$hd, cantidad, 0)) as salidas,
sum(if(almacen1=$almacen AND fecha <$da$dm$dd, cantidad, 0)) - sum(if(almacen2=$almacen AND fecha <$da$dm$dd, cantidad, 0))  as inventarioinicial, cprod, cprov, 
sum(if(almacen1=$almacen AND fecha  <=$ha$hm$hd, cantidad, 0)) - 
sum(if(almacen2=$almacen AND fecha <=$ha$hm$hd, cantidad, 0)) as inventariofinal 
from entradas_y_salidas where entradas_y_salidas.cprov='$cprov'  
group by cprov, cprod;");

$inventario = mysqli_query($mysqli,"select * from inventario inner join productos productos on inventario.cprov = productos.cprov and 
inventario.cprod = productos.cprod;");
while ($seleccion = mysqli_fetch_array($inventario))
{
extract($seleccion);
ECHO "<tr><td>".$cprod."</td><td>".$descripcion."</td><td>".$inventarioinicial."</td><td>".$entradas."</td><td>".$salidas."</td><td>".$inventariofinal."</td></tr>";
}

$result2 = mysqli_query($mysqli,$inventario) or die($inventario."<br/><br/>".mysql_error());
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