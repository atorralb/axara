
<?php include("../menu2.inc");?>
<p>
<form action="anexar_records_por_folio.php?accion=anexar" method=post>
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
<tr><td>#FOLIO:</TD><TD><input type=text class=textfield name="f" value="<?php echo urlencode(@$_REQUEST['f']);?>"></td></tr>
<tr><td>CANTIDAD:</td><td><input type=text class=textfield name="cantidad"></td></tr>
<tr><td>PROVEEDOR</td><td> <input type=text class=textfield name="cprov"></td></tr>
<tr><td>#PRODUCTO:</td><td> <input type=text class=textfield name="cprod"></td></tr>
<tr><td><input type=submit value="anexar"></td></tr>

</table>
</form>
<?php
$mysqli = new mysqli("localhost","root","");mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));


if(urlencode(@$_REQUEST['accion'])=="anexar"){

    $f=urlencode(@$_REQUEST['f']);
    $cprov=urlencode(@$_REQUEST['cprov']);
    $cprod=urlencode(@$_REQUEST['cprod']);
    $cantidad=urlencode(@$_REQUEST['cantidad']);

    $capturar_fila = mysqli_query($mysqli,"select * from entradas_y_salidas where folio ='$f' order by fecha desc");
    
    $campo = mysqli_fetch_array($capturar_fila);

    mysqli_query($mysqli,"INSERT INTO entradas_y_salidas 

            values('', '$campo[folio]', 	'$campo[fecha]', 	'$campo[movimiento]', 
           '$campo[almacen1]', 	'$campo[almacen2]', '$campo[concepto]',
		   '$campo[ne]', 		'$campo[nr]',	 	'$campo[na]',	
		   '$campo[factura]',	'$campo[f]', 		'$cprov', 		 
		   '$cprod', 		'$cantidad', now() );");
		   
 $seleccion= mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
while($s = mysqli_fetch_array($seleccion))
 {
 echo "<table><th>FOLIO</th><th>CANTIDAD</th><th>PROVEEDOR</th><th>PRODUCTO</th><th>DESCRIPCION</th><tr><td>".$f."</td><td>$cantidad</td><td>".$s['cprov']."</td><td>".$s['cprod']."</td><td>".$s['descripcion']."</td></tr></table>";
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