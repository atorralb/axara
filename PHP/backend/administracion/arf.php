<?include("../menu.inc");?>
<form action="arf.php?accion=anexar" method=post>
<table>
<TR><td>MOVIMIENTO</td><TD><SELECT class=select name="movimiento"> 
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
</TD>
</TR>
<tr><td>#FOLIO:</TD><TD><input type=text class=textfield name="f"></td></tr>
<tr><td>CANTIDAD:</td><td><input type=text class=textfield name="cantidad"></td></tr>
<tr><td>PROVEEDOR</td><td> <input type=text class=textfield name="cprov"></td></tr>
<tr><td>#PRODUCTO:</td><td> <input type=text class=textfield name="cprod"></td></tr>
<tr><td><input type=submit value="anexar"></td></tr>
</table>
</form>
<?
$mysqli = new mysqli("localhost","root","");mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));
if($accion=="anexar" && $movimiento==1)
{
mysqli_query($mysqli,"INSERT INTO rec values('', '$f', '$cprov', '$cprod', '$cantidad');");
 $seleccion= mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
while($s = mysqli_fetch_array($seleccion))
 {
 echo "<table><th>FOLIO</th><th>CANTIDAD</th><th>PROVEEDOR</th><th>PRODUCTO</th><th>DESCRIPCION</th><tr><td>$f</td><td>$cantidad</td><td>".$s['cprov']."</td><td>".$s['cprod']."</td><td>".$s['descripcion']."</td></tr></table>";
 }
}
elseif($accion=="anexar" && $movimiento==2)
{mysqli_query($mysqli,"insert into rdp values('', '$f', '$cprov', '$cprod', '$cantidad');");
 $seleccion=mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
 while($s = mysqli_fetch_array($seleccion))
 {
 echo "<table><th>FOLIO</th><th>CANTIDAD</th><th>PROVEEDOR</th><th>PRODUCTO</th><th>DESCRIPCION</th><tr><td>$f</td><td>$cantidad</td><td>".$s['cprov']."</td><td>".$s['cprod']."</td><td>".$s['descripcion']."</td></tr></table>";
 }
}

elseif($accion=="anexar" && $movimiento==3)
{
mysqli_query($mysqli,"insert into rvm values ('', '$f', '$cprov', '$cprod', '$cantidad');");
$seleccion=mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
 while($s = mysqli_fetch_array($seleccion))
 {
 echo "<table><th>FOLIO</th><th>CANTIDAD</th><th>PROVEEDOR</th><th>PRODUCTO</th><th>DESCRIPCION</th><tr><td>$f</td><td>$cantidad</td><td>".$s['cprov']."</td><td>".$s['cprod']."</td><td>".$s['descripcion']."</td></tr></table>";
 }
}
elseif($accion=="anexar" && $movimiento==4)
{
mysqli_query($mysqli,"insert into rst values('', '$f', '$cprov', '$cprod', '$cantidad');");
$seleccion=mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
 while($s = mysqli_fetch_array($seleccion))
 {
 echo "<table><th>FOLIO</th><th>CANTIDAD</th><th>PROVEEDOR</th><th>PRODUCTO</th><th>DESCRIPCION</th><tr><td>$f</td><td>$cantidad</td><td>".$s['cprov']."</td><td>".$s['cprod']."</td><td>".$s['descripcion']."</td></tr></table>";
 }
}
elseif($accion=="anexar" && $movimiento==5)
{
mysqli_query($mysqli,"insert into red values('', '$f', '$cprov', '$cprod', '$cantidad');");
$seleccion=mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
while($s = mysqli_fetch_array($seleccion))
 {
 echo "<table><th>FOLIO</th><th>CANTIDAD</th><th>PROVEEDOR</th><th>PRODUCTO</th><th>DESCRIPCION</th><tr><td>$f</td><td>$cantidad</td><td>".$s['cprov']."</td><td>".$s['cprod']."</td><td>".$s['descripcion']."</td></tr></table>";
 }
}
elseif($accion=="anexar" && $movimiento==6)
{
mysqli_query($mysqli,"insert into rsd values('', '$f', '$cprov', '$cprod', '$cantidad');");
$seleccion=mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
while($s = mysqli_fetch_array($seleccion))
 {
 echo "<table><th>FOLIO</th><th>CANTIDAD</th><th>PROVEEDOR</th><th>PRODUCTO</th><th>DESCRIPCION</th><tr><td>$f</td><td>$cantidad</td><td>".$s['cprov']."</td><td>".$s['cprod']."</td><td>".$s['descripcion']."</td></tr></table>";
 }
}
?>
   <script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</html>