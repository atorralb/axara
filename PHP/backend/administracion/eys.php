<?include("../menu.inc");?>

<TABLE>
<form action="eys.php?accion=buscar" method=get>
<TR>
<TD>
<SELECT class=select name="tipo">
<option value="1">ENTRADAS</OPTION>
<option value="2">SALIDAS</OPTION>	
</SELECT>
</TD>
</TR>
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
<input type=text class=textfield name="cprov" size=2>
</TD>
</TR>
<TR>
<TD># PRODUCTO</TD>
<TD><input type=text  class=textfield name="cprod"></TD>
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
<TR>
<TD>
<input type=submit  value="buscar" name ="accion" value="buscar">
</form>
</TD>
</TR>
</TABLE>
<P>
<TABLE>
<TH>PROVEEDOR</TH><TH>PRODUCTO</TH><TH>DESCRIPCION</TH>
<TR>
<?
$mysqli = new mysqli("localhost","root",""); mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
IF($cprov !="")
{
$seleccion = mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");

while($s= mysqli_fetch_array($seleccion))
{
extract($s);
echo "<td>".$cprov."</td><td>".$cprod."</td><td>".$descripcion."</td>";
}
}
?>
</TR>
</TABLE>

<TABLE><th>FOLIO</th><th>MOVIMIENTO<th>FECHA</th><th>CONCEPTO</th><TH>CANTIDAD</TH><th>FACTURA</th>
<?
		
if($accion =="buscar")
{

$eys = mysqli_query($mysqli,"create temporary table eys
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

if($cprov != "" && $tipo == 1)
{
$seleccion = mysqli_query($mysqli,"select if (movimiento=1, 'ENTRADA POR COMPRAS', if(movimiento=2, 'SALIDA POR DEVOLUCION', if(movimiento=3, 'SALIDA POR VENTA DE MOSTRADOR', if(movimiento=4, 'TRASPASO', if(movimiento=5, 'ENTRADA DIVERSA', if(movimiento=6, 'SALIDA DIVERSA', 'otra')) )))) as movimiento2, folio, factura, fecha, concepto, cantidad, cprov, cprod from eys where cprov = '$cprov' AND cprod = '$cprod'  AND almacen1 = $almacen AND fecha >= $da$dm$dd AND fecha <= $ha$hm$hd ORDER BY fecha ASC;");
while($s=mysqli_fetch_array($seleccion))
{
extract($s);
echo "<tr><td><b>".$folio."</b></td><td>".$movimiento2."<td>".$fecha."</td><td>".$concepto."</td><td>".$cantidad."</td><td>".$factura."</td></tr>";
	
}
}
elseif ($cprov != "" && $tipo == 2)	
{
$seleccion = mysqli_query($mysqli,"select if (movimiento=1, 'ENTRADA POR COMPRAS', if(movimiento=2, 'SALIDA POR DEVOLUCION', if(movimiento=3, 'SALIDA POR VENTA DE MOSTRADOR', if(movimiento=4, 'TRASPASO', if(movimiento=5, 'ENTRADA DIVERSA', if(movimiento=6, 'SALIDA DIVERSA', 'otra')) )))) as movimiento, folio, factura, fecha, concepto, cantidad, cprov, cprod from eys where cprov = '$cprov' AND cprod = '$cprod'  AND almacen2 = $almacen AND fecha >= $da$dm$dd AND fecha <= $ha$hm$hd ORDER BY fecha ASC;");

while($s=mysqli_fetch_array($seleccion))
{
extract($s);
echo "<tr><td><b>".$folio."</b></td><td>".$movimiento."<td>".$fecha."</td><td>".$concepto."</td><td>".$cantidad."</td><td>".$factura."</td></tr>";
}
}
 
}
?>
</TABLE>
   <script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</HTML>	