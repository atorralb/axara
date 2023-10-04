<?php 
    error_reporting(E_ALL); 

    // database connection stuff 
    $db = $mysqli = new mysqli("localhost", "root", ""); 
    // $db = $mysqli = new mysqli("localhost", "root", ""); 
    mysqli_select_db("inventario", $db) or die(mysql_errno() . ': ' 
        . mysql_error() . '<br />'); 
     
    $sql = "SELECT * FROM red where f=138 "; 

    // including the DB_Pager class 
     include("DB_Pager.php"); 

    // initiate it! 
    $nav = new DB_Pager(); 

    // set how many records to show at a time 
    if ( isset($show) ) 
    { 
        $nav->rows_per_page($show); 
    } 

    $nav->str_first = 'INICIO'; 
    $nav->str_last = 'ULTIMA'; 

    // the third parameter of execute() is optional 
    $result = $nav->execute($sql, $db); 

    // build the returned array of navigation links 
    $links = $nav->build_links(); 
    $links = array_values($links); 

    // display links 
    for ($y = 0; $y < count($links); $y++) { 
        echo ' ' . $links[$y] . ' '; 
    } 
    echo '<hr />'; 

    // handle the returned result set 
    while ( $data = mysql_fetch_object($result) ) 
    { 
	echo "$data->id: $data->cprov: $data->cantidad<br />n"; 
    } 
     
    echo "<hr>"; 
    // default link display 
    // semi-, ala- Google 
    echo $nav->display_links(); 

   // echo "<hr>"; 
    // "piped" link display 
    //echo $nav->display_links(' | '); 
     
    //echo "<hr>"; 
    // "blocked" link display 
    //echo $nav->display_links(' [', ']'); 

?> 
