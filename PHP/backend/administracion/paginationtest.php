<?
include 'connect_to_database.php';
include 'pagination.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<title> zozial.info: tu voto elije lo mejor de noticias, anuncios y encuestas 
</title>
<head>
<script type="text/javascript">
    var GB_ROOT_DIR = "http://www.zozial.info/scripts/greybox/greybox/";
</script>
<script type="text/javascript" src="http://www.zozial.info/scripts/greybox/greybox/AJS.js"></script>
<script type="text/javascript" src="http://www.zozial.info/scripts/greybox/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="http://www.zozial.info/scripts/greybox/greybox/gb_scripts.js"></script>
<link href="http://www.zozial.info/scripts/greybox/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@import url(<?$_SERVER['PHP_SELF']?>orioldotf2odotorg.css);
</style>
</head>
<body>

<div id="wrapper">
<?include "menu.inc";?>
<div id="content">

<b>
<a href="http://zozial.info/noticias.php?ver=mas_votadas">populares</a>
<a href="http://zozial.info/noticias.php?ver=recientes">recientes</a>
<a href="http://zozial.info/noticias.php?agregar">agrega las tuyas</a>
</b>
</h2>
<?
///////////////////////////////////////////////////////////////////////////////////////
if(isset($_REQUEST['g']) & $_REQUEST['g'] != NULL)
{
$result=mysqli_query($mysqli,"select * from galeria where gallery_name='$_GET[g]'");
for($i=0;$row=mysql_fetch_assoc($result);$i++){
echo "<img src=\"/galeria/".$row['file_name']."\"></img><br>";
}
}

elseif(isset($_REQUEST['g']) & $_REQUEST['g'] == NULL  )
{
?>
<form action="<?$_SERVER['PHP_SELF']?>?subir_imagenes"  ENCTYPE="multipart/form-data" method="post">
dale un titulo a tu album de fotos
<br>
<input type="text" name="gallery_name" />
<br>
selecciona las imagenes para tu album
<br>
<input type="file" id="element_input" name="files[]" />
<div id="files_list"><strong>fotos (maximo 100 fotos):</strong></div>
<script src="/multifile.js"></script>
<input type="submit">
</form>
<?
}


elseif(isset($_REQUEST['subir_imagenes']))
{

$path_to_file = "galeria/";
$files = $HTTP_POST_FILES['files']; 
$gallery_name = str_replace(" ", "_", $_REQUEST[gallery_name]);

 foreach ($files['name'] as $key=>$name) { 
    if ($files['size'][$key]) { 
     
$name= md5(rand() * time()) . '.' . substr(strrchr($name, '.'),1);
	   
             
$query= "INSERT INTO galeria  VALUES('', '$gallery_name', '$name')";
mysqli_query($mysqli,$query);
 
      $location = $path_to_file.$name; 
       while (file_exists($location)) 
          $location .= ".copy"; 
       copy($files['tmp_name'][$key],$location); 
       unlink($files['tmp_name'][$key]); 
 //    $content .= "Uploaded File: ".$location."n"; 
 $thanks .= "<br>tu galeria es http://zozial.info/?g=".$gallery_name.""; 
    } 
 } 
 print "<h1>$thanks</h1>"; 

}

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
elseif(isset($_REQUEST['chat']))
{
?>

<div style="width:550px"><style>.mcrmeebo { display: block; background:url("http://widget.meebo.com/r.gif") no-repeat top right; } .mcrmeebo:hover { background:url("http://widget.meebo.com/ro.gif") no-repeat top right; } </style><embed src="http://widget.meebo.com/mcr.swf?id=doGcBVBLti" type="application/x-shockwave-flash" width="550" height="415" /><a href="http://www.meebo.com/rooms" class="mcrmeebo"><img alt="http://www.meebo.com/rooms" src="http://widget.meebo.com/b.gif" width="550" height="45" style="border:0px"/></a></div>
<?
}else{
?>
<script src="create_request_object.js" type="text/javascript" language="javascript"></script>
<?
$entries_per_page=7;
$page = (isset($_GET['page'])?$_GET['page']:1);

// a normal sql query to get the count from the database

$result     = mysqli_query($mysqli,"SELECT COUNT(*) from noticias ")
            or die (mysql_error());
            
//$num_rows is the number of rows from the result            

$num_rows = mysql_fetch_row($result);

//if there are results

if($num_rows[0]!=0){

        //total pages = round_up the number of results/entries per page

    $total_pages = ceil($num_rows[0]/$entries_per_page);
    
        //now we have the $total_pages and page we can call our pagination function
    
    $pagination = pagination_one($total_pages,$page);
    
        //the offset is the current page number * entries - entries
        //
        //  e.g. page 10 with 10 entries per page
        //
        //    10 * 10 - 10 = 90;
        // $offset = 90 -> start at result 90 for that page of results
        
    
    $offset = (($page * $entries_per_page) - $entries_per_page);
    
        // obtain the results LIMIT -> from example above:-
        //  start at result 90 and get ten results 
    

//we get ip address
    
if (getenv("HTTP_CLIENT_IP")){   
   $ip = getenv("HTTP_CLIENT_IP");   
}   
elseif(getenv("HTTP_X_FORWARDED_FOR")) {   
   $ip = getenv("HTTP_X_FORWARDED_FOR");   
}   
elseif(getenv("REMOTE_ADDR")){   
   $ip = getenv("REMOTE_ADDR");   
}   
else {   
   $ip = "UNKNOWN"; 
} 
    $direccion_ip = gethostbyaddr($ip);

$result_noticias = mysqli_query($mysqli,"SELECT 
		votos_buenos,
                votos_malos,
		id,
                url,
                blogger,
		fecha,
		numero_de_comentarios,
                titulo,
                clicks
		FROM noticias
		where fecha >= date_sub(now(), interval 90 day)
		order by 
		fecha desc
		LIMIT $offset,$entries_per_page");

 for($i=0;$row=mysql_fetch_assoc($result_noticias);$i++){
extract($row);
 
echo"<div class=\"post\"><h1><div id=\"vote".$id."\"></div></h1>
<a href=\"javascript:rqst('news','$id','votos_buenos', '$ip')\">+</a>\n"
.$votos_buenos.
"<a href=\"javascript:rqst('news','$id','votos_malos','$ip')\">-</a>\n"
.$votos_malos. 
"<a href=\"http://zozial.info/click.php?url=".$url."\" title=\"".$titulo."\">
$titulo</a>
<br/>
<h1>
".$numero_de_comentarios."
<a href=\"noticias.php?titulo=".$titulo."\"rel=\"gb_page_center[700, 500]\"> 
comentarios</a> ".$clicks." visitas <a href=\"http://".$blogger."\">".$blogger
."</a> "

.date("d M Y", strtotime($fecha))."</h1> </div>";
}
}
}
    
    //or echo $pagination here for below the results
    
    echo $pagination;
        
?>