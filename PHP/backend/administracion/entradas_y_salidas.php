
<?php include("../menu2.inc");?>
<body>
<title>entradas.y.salidas</title>
<TABLE>
<form action="entradas_y_salidas.php?accion=buscar" method=get>
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
<!--<option value="5">CALLE 11
</option>-->
<option value="6">CALLE 13
</option>
<option value="7">CALLE 3
</option>
<option value="8">CUITLAHUAC
</option>
<!--
<option value="10">SUPER</option>
-->
<!--<option value="11"> Av. 5 </option>-->

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
<input type=text class=textfield name="cprov" size=2>
</TD>
</TR>
<TR>
<TD># PRODUCTO</TD>
<TD><input type=text  class=textfield name="cprod" ></TD>
<TR>
<TD></TD><TD>#AAAA</TD><TD> #MM</TD> <TD> #DD</TD>
</TR>
<TR>
<TD>DESDE</TD>
<TD><input type=text  class=textfield name="da" value="<?php echo urlencode(@$_REQUEST['da']);?>"></TD>
<TD><input type=text  class=textfield name="dm" value="<?php echo urlencode(@$_REQUEST['dm']);?>"></TD>
<TD><input type=text  class=textfield name="dd" value="<?php echo urlencode(@$_REQUEST['dd']);?>"></TD>
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
<?php
$mysqli = new mysqli("localhost","root",""); mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));

IF(urlencode(@$_REQUEST['cprov']) !=""){
    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
    $cprod=mysqli_real_escape_string($mysqli,$_REQUEST['cprod']);
    $seleccion = mysqli_query($mysqli,"select * from productos where cprov='$cprov' and cprod='$cprod';");
   
    while($s= mysqli_fetch_array($seleccion))        {
        extract($s);
        echo "<td>".$cprov."</td><td>".$cprod."</td><td>".$descripcion."</td>";
}
}
?>
</TR>
</TABLE>

<TABLE><th>FOLIO</th><th>MOVIMIENTO<th>FECHA</th><th>CONCEPTO</th><TH>CANTIDAD</TH><th>FACTURA</th>
<?php
		
if(urlencode(@$_REQUEST['accion']) =="buscar"){

    $cprov=mysqli_real_escape_string($mysqli,$_REQUEST['cprov']);
    $cprod=mysqli_real_escape_string($mysqli,$_REQUEST['cprod']);
    $almacen = urlencode(@$_REQUEST['almacen']); 
    $dd = urlencode(@$_REQUEST['dd']); 
    $da = urlencode(@$_REQUEST['da']); 
    $dm = urlencode(@$_REQUEST['dm']);
    $ha = urlencode(@$_REQUEST['ha']);
    $hd = urlencode(@$_REQUEST['hd']);
    $hm = urlencode(@$_REQUEST['hm']); 
    
    if($cprov != "" && urlencode(@$_REQUEST['tipo']) == 1){
        $seleccion = mysqli_query($mysqli,"select if (movimiento=1, 'ENTRADA POR COMPRAS', if(movimiento=2, 'SALIDA POR DEVOLUCION', if(movimiento=3, 'SALIDA POR VENTA DE MOSTRADOR', if(movimiento=4, 'TRASPASO', if(movimiento=5, 'ENTRADA DIVERSA', if(movimiento=6, 'SALIDA DIVERSA', 'otra')) )))) as movimiento2, folio, factura, fecha, concepto, cantidad, cprov, cprod from entradas_y_salidas where cprov = '$cprov' AND cprod = '$cprod'  AND almacen1 = $almacen AND fecha >= $da$dm$dd AND fecha <= $ha$hm$hd ORDER BY fecha ASC;");
        while($s=mysqli_fetch_array($seleccion)){
            extract($s);
            echo "<tr><td><b>".$folio."</b></td><td>".$movimiento2."<td>".$fecha."</td><td>".$concepto."</td><td>".$cantidad."</td><td>".$factura."</td></tr>";	
}}

    elseif ($cprov != "" && urlencode(@$_REQUEST['tipo']) == 2)	{
    $seleccion = mysqli_query($mysqli,"select if (movimiento=1, 'ENTRADA POR COMPRAS', if(movimiento=2, 'SALIDA POR DEVOLUCION', if(movimiento=3, 'SALIDA POR VENTA DE MOSTRADOR', if(movimiento=4, 'TRASPASO', if(movimiento=5, 'ENTRADA DIVERSA', if(movimiento=6, 'SALIDA DIVERSA', 'otra')) )))) as movimiento, folio, factura, fecha, concepto, cantidad, cprov, cprod from entradas_y_salidas where cprov = '$cprov' AND cprod = '$cprod'  AND almacen2 = $almacen AND fecha >= $da$dm$dd AND fecha <= $ha$hm$hd ORDER BY fecha ASC;");
    while($s=mysqli_fetch_array($seleccion)){
        extract($s);
        echo "<tr><td><b>".$folio."</b></td><td>".$movimiento."<td>".$fecha."</td><td>".$concepto."</td><td>".$cantidad."</td><td>".$factura."</td></tr>";
}}}
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