<?include("../menu.inc");?>

<TABLE>
<form action="ic_reporte.php" method=post>
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
<option value="6">AV. 1
</option>
<option value="7">CALLE 3
</option>
<option value="8">CUITLAHUAC
</option>
</SELECT> 
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


<script type="text/javascript">
    var ddmx = new DropDownMenuX('menu1');
    ddmx.delay.show = 0;
    ddmx.delay.hide = 400;
    ddmx.position.levelX.left = 2;
    ddmx.init();
    </script>	