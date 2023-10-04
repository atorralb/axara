<?include("../menu.inc");?>
SALIDAS POR VENTA DE MOSTRADOR
<TABLE>
<form action="vm.php" method="post">
	<TR><TD>DIA</TD><TD> <input type="text" class=textfield name="d"  value=<?echo date(d);?>></TD></TR>
	<TR><TD>MES</TD><TD><input type="text" class=textfield name="m"  value=<?echo date(m);?>></TD></TR>
	<TR><TD>AÑO</TD><TD><input type="text" class=textfield name="a"  value=<?echo date(Y);?>></TD></TR>
	 
	 
	<TR><TD> ALMACEN</TD>
	<TD>
	<SELECT class=select name="almacen"> 
			 <OPTION value="2">AV. 2A </OPTION> 
			<option value="3">AV. 2</option>
			<option value="4">PLAZA CRYSTAL</option>
			<option value="5">CALLE 11</option>
			<option value="6">AV. 8</option>
			<option value="7">CALLE 3</option>
			<option value="8">CUITLAHUAC</option>
		</SELECT>
	</TR></TD>
	 <TR><TD>CONCEPTO</TD><TD><input type="text" class=tlargo name="concepto"></TD></TR>
	 <TR><TD>N.E</TD><TD><input type="text" class=tlargo name="ne"></TD></TR>
	 <TR><TD>N.R</TD><TD><input type="text" class=tlargo name="nr"></TD></TR>
	 <TR><TD>N.A</TD><TD><input type="text" class=tlargo name="na"></TD></TR>
	<TR><TD><input type="submit" value="aplicar"></TD></TR>	
</form>
</TABLE>

<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>
</html>