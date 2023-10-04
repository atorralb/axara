<?include("../menu.inc");?>
<STYLE>
@import url(../gui.css);
</STYLE>
<form action="ef.php" method=get>
<SELECT class=select name="movimiento"> 
<OPTION value="1">Entradas por compras  
<OPTION value="2">Salidas por devolucion de proveedores  
</OPTION> 
<option value="3">Salidas por venta de mostrador
</option>
<option value="4">Traspasos
</option>
<option value="5">Entradas diversas
</option>
<option value="6">Salidas Diversas
</option>
</select>
<br>
FOLIO<input type=text  class=textfield name="folio">
<BR>
<input type=submit  value="buscar">
<br>
</form>
<form action="ef.php?accion=actualizar" method=get>
<table>
<?
$mysqli = new mysqli("localhost","root",""); mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));

if($movimiento==1)
{
$seleccion = mysqli_query($mysqli,"select * from ec where folio='$folio';");
while ($s = mysqli_fetch_array($seleccion))
{
echo '<tr><td>folio</td><td><input type=text class=textfield  name=folio value="'.$s[folio].'"</td></tr>';
echo '<tr><td>fecha</td><td><input type=text class=tlargo name=fecha value="'.$s[fecha].'"</td></tr>';
echo '<tr><td>concepto</td><td><input type=text class=tlargo name=concepto value="'.$s[concepto].'"</td></tr>';
echo '<tr><td>factura</td><td><input type=text class=tlargo name=factura value="'.$s[factura].'"</td></tr>';
echo '<tr><td>entro a</td><td><input type=text class=textfield name=almacen1 value="'.$s[almacen1].'"</td></tr>';
echo '<tr><td>salio de</td><td><input type=text class=textfield name=almacen2 value="'.$s[almacen2].'"</td></tr>';
echo '<tr><td>N.E</td><td><input type=text class=tlargo name=ne value="'.$s[ne].'"</td></tr>';
echo '<tr><td>N.R</td><td><input type=text class=tlargo name=nr value="'.$s[nr].'"</td></tr>';
echo '<tr><td>N.A</td><td><input type=text class=tlargo name=na value="'.$s[na].'"</td></tr>';
}
}
elseif($movimiento==2)
{
$seleccion= mysqli_query($mysqli,"select * from dp where folio='$folio';");
while($s = mysqli_fetch_array($seleccion))
{
echo '<tr><td>folio</td><td><input type=text class=textfield  name=folio value="'.$s[folio].'"</td></tr>';
echo '<tr><td>fecha</td><td><input type=text class=tlargo name=fecha value="'.$s[fecha].'"</td></tr>';
echo '<tr><td>concepto</td><td><input type=text class=tlargo name=concepto value="'.$s[concepto].'"</td></tr>';
echo '<tr><td>factura</td><td><input type=text class=tlargo name=factura value="'.$s[factura].'"</td></tr>';
echo '<tr><td>entro a</td><td><input type=text class=textfield name=almacen1 value="'.$s[almacen1].'"</td></tr>';
echo '<tr><td>salio de</td><td><input type=text class=textfield name=almacen2 value="'.$s[almacen2].'"</td></tr>';
echo '<tr><td>N.E</td><td><input type=text class=tlargo name=ne value="'.$s[ne].'"</td></tr>';
echo '<tr><td>N.R</td><td><input type=text class=tlargo name=nr value="'.$s[nr].'"</td></tr>';
echo '<tr><td>N.A</td><td><input type=text class=tlargo name=na value="'.$s[na].'"</td></tr>';
}
}
elseif($movimiento==3)
{
 $seleccion = mysqli_query($mysqli,"select * from vm where folio='$folio';");
while($s = mysqli_fetch_array($seleccion))
{
echo '<tr><td>folio</td><td><input type=text class=textfield  name=folio value="'.$s[folio].'"</td></tr>';
echo '<tr><td>fecha</td><td><input type=text class=tlargo name=fecha value="'.$s[fecha].'"</td></tr>';
echo '<tr><td>concepto</td><td><input type=text class=tlargo name=concepto value="'.$s[concepto].'"</td></tr>';
echo '<tr><td>factura</td><td><input type=text class=tlargo name=factura value="'.$s[factura].'"</td></tr>';
echo '<tr><td>entro a</td><td><input type=text class=textfield name=almacen1 value="'.$s[almacen1].'"</td></tr>';
echo '<tr><td>salio de</td><td><input type=text class=textfield name=almacen2 value="'.$s[almacen2].'"</td></tr>';
echo '<tr><td>N.E</td><td><input type=text class=tlargo name=ne value="'.$s[ne].'"</td></tr>';
echo '<tr><td>N.R</td><td><input type=text class=tlargo name=nr value="'.$s[nr].'"</td></tr>';
echo '<tr><td>N.A</td><td><input type=text class=tlargo name=na value="'.$s[na].'"</td></tr>';
}
}
elseif($movimiento==4)
{
$seleccion = mysqli_query($mysqli,"select * from st where folio='$folio';");
while($s = mysqli_fetch_array($seleccion))
{
echo '<tr><td>folio</td><td><input type=text class=textfield  name=folio value="'.$s[folio].'"</td></tr>';
echo '<tr><td>fecha</td><td><input type=text class=tlargo name=fecha value="'.$s[fecha].'"</td></tr>';
echo '<tr><td>concepto</td><td><input type=text class=tlargo name=concepto value="'.$s[concepto].'"</td></tr>';
echo '<tr><td>factura</td><td><input type=text class=tlargo name=factura value="'.$s[factura].'"</td></tr>';
echo '<tr><td>entro a</td><td><input type=text class=textfield name=almacen1 value="'.$s[almacen1].'"</td></tr>';
echo '<tr><td>salio de</td><td><input type=text class=textfield name=almacen2 value="'.$s[almacen2].'"</td></tr>';
echo '<tr><td>N.E</td><td><input type=text class=tlargo name=ne value="'.$s[ne].'"</td></tr>';
echo '<tr><td>N.R</td><td><input type=text class=tlargo name=nr value="'.$s[nr].'"</td></tr>';
echo '<tr><td>N.A</td><td><input type=text class=tlargo name=na value="'.$s[na].'"</td></tr>';
}
}
elseif($movimiento==5)
{
$seleccion = mysqli_query($mysqli,"select * from ed where folio='$folio';");
while($s = mysqli_fetch_array($seleccion))
{
echo '<tr><td>folio</td><td><input type=text class=textfield  name=folio value="'.$s[folio].'"</td></tr>';
echo '<tr><td>fecha</td><td><input type=text class=tlargo name=fecha value="'.$s[fecha].'"</td></tr>';
echo '<tr><td>concepto</td><td><input type=text class=tlargo name=concepto value="'.$s[concepto].'"</td></tr>';
echo '<tr><td>factura</td><td><input type=text class=tlargo name=factura value="'.$s[factura].'"</td></tr>';
echo '<tr><td>entro a</td><td><input type=text class=textfield name=almacen1 value="'.$s[almacen1].'"</td></tr>';
echo '<tr><td>salio de</td><td><input type=text class=textfield name=almacen2 value="'.$s[almacen2].'"</td></tr>';
echo '<tr><td>N.E</td><td><input type=text class=tlargo name=ne value="'.$s[ne].'"</td></tr>';
echo '<tr><td>N.R</td><td><input type=text class=tlargo name=nr value="'.$s[nr].'"</td></tr>';
echo '<tr><td>N.A</td><td><input type=text class=tlargo name=na value="'.$s[na].'"</td></tr>';
}
}

elseif($movimiento==6)
{
$seleccion = mysqli_query($mysqli,"select * from sd where folio='$folio';");
while($s = mysqli_fetch_array($seleccion))
{
echo '<tr><td>folio</td><td><input type=text class=textfield  name=folio value="'.$s[folio].'"</td></tr>';
echo '<tr><td>fecha</td><td><input type=text class=tlargo name=fecha value="'.$s[fecha].'"</td></tr>';
echo '<tr><td>concepto</td><td><input type=text class=tlargo name=concepto value="'.$s[concepto].'"</td></tr>';
echo '<tr><td>factura</td><td><input type=text class=tlargo name=factura value="'.$s[factura].'"</td></tr>';
echo '<tr><td>entro a</td><td><input type=text class=textfield name=almacen1 value="'.$s[almacen1].'"</td></tr>';
echo '<tr><td>salio de</td><td><input type=text class=textfield name=almacen2 value="'.$s[almacen2].'"</td></tr>';
echo '<tr><td>N.E</td><td><input type=text class=tlargo name=ne value="'.$s[ne].'"</td></tr>';
echo '<tr><td>N.R</td><td><input type=text class=tlargo name=nr value="'.$s[nr].'"</td></tr>';
echo '<tr><td>N.A</td><td><input type=text class=tlargo name=na value="'.$s[na].'"</td></tr>';
}
}
 ?>

</table>
<INPUT TYPE=SUBMIT value="actualizar">
</FORM>