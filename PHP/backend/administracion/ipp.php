<?include("../menu.inc");?>

<TABLE>
<form action="ipp.php?accion=buscar" method=post>
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
<option value="5">CALLE 11
</option>
<option value="6">AV. 8
</option>
<option value="7">CALLE 3
</option>
<option value="8">CUITLAHUAC
</option>
</SELECT> 
</TD>
</TR>
<TR>
<TD>
PROVEEDOR
</TD>
<TD>
<input type=text class=textfield name="cprov">
</TD>
</TR>
<TR>
<TD></TD><TD>#AAAA</TD><TD> #MM</TD> <TD> #DD</TD>
</TR>
<TR>
<TD>DESDE</TD><TD><input type=text  class=textfield name="da"></TD><TD><input type=text  class=textfield name="dm" ></TD><TD><input type=text  class=textfield name="dd"></TD>
</TR>
<TR>
<TD></TD><TD>#AAAA</TD><TD>#MM</TD><TD>#DD</TD>
</TR>
<TR>
<TD>HASTA</TD><TD><input type=text  class=textfield name="ha"></TD><TD><input type=text  class=textfield name="hm"></TD><TD><input type=text  class=textfield  name="hd"></TD>
</TR>
<TR><TD><input type=submit  value="buscar"></form></TD></TR>
</TABLE>
<table><th>PRODUCTO</th><th>DESCRIPCION</th><th>INVENTARIO INICIAL</th><th>ENTRADAS</th><th>SALIDAS</th><th>INVENTARIO FINAL</th>
<?
$mysqli = new mysqli("localhost","root",""); mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
if($accion==buscar)
{
$te = mysqli_query($mysqli,"create temporary table eys
										(select * from ec inner join rec on ec.folio = rec.f)
										UNION
										(select * from dp inner join rdp on dp.folio = rdp.f)
										UNION
										(select * from ed inner join red on ed.folio = red.f)
										UNION
										(select * from sd inner join rsd on sd.folio = rsd.f)
										UNION
										(select * from st inner join rst on st.folio = rst.f)
										UNION
										(select * from vm inner join rvm on vm.folio = rvm.f);");

$ti = mysqli_query($mysqli,"create temporary table inventario select 
@entradas:= sum(if(almacen1=$almacen AND fecha >=$da$dm$dd and fecha <=$ha$hm$hd, cantidad, 0)) as entradas, 
@salidas:= sum(if(almacen2=$almacen AND fecha >=$da$dm$dd and fecha <=$ha$hm$hd, cantidad, 0)) as salidas,
sum(if(almacen1=$almacen AND fecha <$da$dm$dd, cantidad, 0)) - sum(if(almacen2=$almacen AND fecha <$da$dm$dd, cantidad, 0))  as inventarioinicial, cprod, cprov, 
sum(if(almacen1=$almacen AND fecha  <=$ha$hm$hd, cantidad, 0)) - 
sum(if(almacen2=$almacen AND fecha <=$ha$hm$hd, cantidad, 0)) as inventariofinal 
from eys where eys.cprov='$cprov'  
group by cprov, cprod;");

$inventario = mysqli_query($mysqli,"select * from inventario inner join productos productos on inventario.cprov = productos.cprov and 
inventario.cprod = productos.cprod;");
while ($seleccion = mysqli_fetch_array($inventario))
{
extract($seleccion);
ECHO "<tr><td>".$cprod."</td><td>".$descripcion."</td><td>".$inventarioinicial."</td><td>".$entradas."</td><td>".$salidas."</td><td>".$inventariofinal."</td></tr>";
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