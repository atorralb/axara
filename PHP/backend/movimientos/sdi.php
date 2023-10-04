<?include("../menu.inc");?>
SALIDAS DIVERSAS
<form action="sd.php" method="post">
<TABLE>
<TR><TD>DIA</TD><TD> <input type="text" class=textfield name="d"  value=<?echo date(d);?>></TD></TR>
<TR><TD>MES</TD><TD><input type="text" class=textfield name="m"  value=<?echo date(m);?>></TD></TR>
<TR><TD>AÑO</TD><TD><input type="text" class=textfield name="a"  value=<?echo date(Y);?>></TD></TR>
<TR><TD>ALMACEN</TD><TD>

<SELECT class=select  name="almacen2"> 
        <OPTION value="1">BODEGA </OPTION>
		 <OPTION value="2">AV. 2A </OPTION> 
		<option value="3">AV. 2</option>
		<option value="4">PLAZA CRYSTAL</option>
		<option value="5">CALLE 11</option>
		<option value="6">AV. 8</option>
		<option value="7">CALLE 3</option>
		<option value="8">CUITLAHUAC</option>
</SELECT> 
</TD></TR>
	 <TR><TD>CONCEPTO</TD><TD><input type="text" class=tlargo name="concepto"></TD></TR>
	 <TR><TD>N.E</TD><TD><input type="text" class=tlargo name="ne"></TD></TR>
	 <TR><TD>N.R</TD><TD><input type="text" class=tlargo name="nr"></TD></TR>
	 <TR><TD>N.A</TD><TD><input type="text" class=tlargo name="na"></TD></TR>
	<TR><TD><input type="submit" value="aplicar"></TD></TR>

</TABLE>
</form>
</body>
<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>	
</html>