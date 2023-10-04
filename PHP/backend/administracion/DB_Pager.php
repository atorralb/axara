<?php 

    /** 
     * Class DB_Pager 
     * 
     * Class to build dynamic database paging links. 
     * 
     * Based upon Joao Prado Maia (jpm@musicalidade.net) class navbar. 
     * 
     * Functions: 
     *     DB_Pager($use_text_links = true) 
    *     build_links($option = 'all', $show_blank = false) 
     *     build_url() 
     *     display_links($sep_left = ' ', $sep_right = ' ') 
     *     execute($sql, $db, $type = 'mysql') 
     *     mk_link($href, $text = '', $target = '', $name = '') 
     *     num_links_shown($links_to_show) 
     *     rows_per_page($rows_to_show) 
     * 
     * @author Michael Cannon <michael@cannonbose.com> 
     * @package cb_common 
     * @version $Id: class.DB_Pager.php,v 1.5 2002/11/08 17:55:42 mcannon Exp $ 
     */ 


    /**     

        Below is short example of how to use this class: 
        ============================================= 
    <?php 

        // database connection stuff 
        $db = $mysqli = new mysqli("localhost", "root", ""); 
        mysqli_select_db("DNAccounting", $db) or die(mysql_errno() . ': ' 
            . mysql_error() . '<br />'); 

        // create SQL statement WITHOUT LIMIT clause 
        $sql = "SELECT * FROM Reports "; 

        // including the DB_Pager class 
        include("./class.DB_Pager.php"); 
         
        // initiate it! 
        $nav = new DB_Pager(); 

        // the third parameter of execute() is optional 
        $result = $nav->execute($sql, $db, 'mysql'); 
         
        // default link display 
        echo $nav->display_links(); 
        echo "<hr>n"; 

        // display result set 
        while ( $data = mysql_fetch_object($result) ) 
        { 
            echo "$data->defrep_id : $data->service_id : $data->quantity<br />n"; 
        } 

    ?> 

    */ 



class DB_Pager 
{ 
    // Default values for the navigation link bar 
    var $rows_per_page_default; 
    var $rows_per_page; 
    var $num_links_shown_default; 
    var $num_links_shown; 

    // navigation text     
    var $str_first; 
    var $str_previous; 
    var $str_next; 
    var $str_last; 

    // Variables used internally 
    var $file; 
    var $row; 
    var $total_records; 


    /** 
     * DB_Pager($use_text_links = true) 
     * 
     * Class constructor 
     * 
     * @param boolean $use_text_links, ex: true (display 'First, Previous, ...'), 
     *     false (display '<<, <, ...') 
     * @return void 
     */ 
    function DB_Pager($use_text_links = true) 
    { 
        $this->rows_per_page_default = 15; 
        $this->rows_per_page = $this->rows_per_page_default; 

        $this->num_links_shown_default = 5; 
        $this->num_links_shown = $this->num_links_shown_default; 

        // Default values for the navigation link bar 
        if ( true === $use_text_links ) 
        { 
            $this->str_first = '<b>First Page</b>'; 
            $this->str_previous = '<b>Previous Page</b>'; 
            $this->str_next = '<b>Next Page</b>'; 
            $this->str_last = '<b>Last Page</b>'; 
        } 

        else 
        { 
            $this->str_first = '<b>&lt;&lt;</b>'; 
            $this->str_previous = '<b>&lt;</b>'; 
            $this->str_next = '<b>&gt;</b>'; 
            $this->str_last = '<b>&gt;&gt;</b>'; 
        } 

        // Variables used internally 
        $this->file = ''; 
        $this->row = 0; 
        $this->total_records = 0; 
    } 



    /** 
    * build_links($option = 'all', $show_blank = false) 
     * 
     * This function creates an array of all the links for the navigation bar. 
     * This is useful since it is completely independent from the layout or 
     * design of the page.  The function returns the array of navigation links to 
     * the caller php script, so it can build the layout with the navigation 
     * links content available. 
     * 
     * @param string $option (default to 'all'), ex: 
     *     'all' - return every navigation link 
     *     'pages' - return only the page numbering links 
     *     'sides' - return only the 'Next' and / or 'Previous' links 
     * @param boolean $show_blank parameter (default to 'false'), ex: 
     *     false - don't show the "Next" or "Previous" when it is not needed 
     *     true - show the "Next" or "Previous" strings as plain text when it is 
     *     not neededa 
     * @return array 
     */ 
    function build_links($option = 'all', $show_blank = false) 
    { 
        $extra_vars = $this->build_url(); 
        $file = $this->file; 

        // zero based counting adjust 
        $number_of_pages = ceil($this->total_records / $this->rows_per_page); 
        $last_page = $number_of_pages - 1; 

        $indice = 0; 

        if ( $option == 'all' || $option == 'sides' ) 
        { 
            // beginning link 
            // previous link 
            if ( $this->row != 0 ) 
            { 
                $array[$indice] = $this->mk_link("{$file}?row=0{$extra_vars}", 
                    $this->str_first); 
                $indice++; 
                 
                $array[$indice] = $this->mk_link("{$file}?row=" . ($this->row - 1) 
                    . $extra_vars, $this->str_previous); 
                $indice++; 
            } 

            elseif ( $this->row == 0 && $show_blank ) 
            { 
                $array[$indice] = $this->str_first; 
                $indice++; 

                $array[$indice] = $this->str_previous; 
                $indice++; 
            } 
        } 

        // show all, some, or none of the page links     
        $this->num_links_shown = ( false !== $this->num_links_shown ) 
            ? $this->num_links_shown 
            : $last_page; 

        $row_diff = $this->row - $this->num_links_shown; 
        $from_link = ( $row_diff < 0 ) 
            ? 0 
            : $row_diff; 

        $row_sum = $this->row + $this->num_links_shown; 
        $to_link = ( $row_sum > $number_of_pages ) 
            ? $number_of_pages 
            : $row_sum; 
         
        for ($current = $from_link; $current <= $to_link; $current++) 
        { 
            // current link 
            // other page links 
            if ( ( $option == 'all' || $option == 'pages' ) 
                && $current <= $last_page ) 
            { 
                $array[$indice] = ( $this->row != $current ) 
                    ? $this->mk_link("{$file}?row={$current}{$extra_vars}", 
                        $current + 1) 
                    : $current + 1; 
            } 

            // next link 
            if ( ( $option == 'all' || $option == 'sides' ) 
                && $current == $to_link ) 
            { 
                if ( ( $this->row != $to_link || $from_link == $to_link ) 
                    && $this->row != $last_page ) 
                { 
                    $array[$indice] = $this->mk_link("{$file}?row=" 
                        . ($this->row + 1) . $extra_vars, $this->str_next); 
                } 
                 
                elseif ( ( $this->row == $to_link || $this->row == $last_page ) 
                      && $show_blank ) 
                { 
                    $array[$indice] = $this->str_next; 
                } 
            } 

            $indice++; 
        } 
                 
        if ( $option == 'all' || $option == 'sides' ) 
        { 
            // ending link 
            if ($this->row != $last_page) 
            { 
                $array[$indice] = $this->mk_link("{$file}?row=" 
                    . $last_page . $extra_vars, $this->str_last); 
            } 
             
            elseif ( ($this->row == $last_page) && $show_blank ) 
            { 
                $array[$indice] = $this->str_last; 
            } 
        } 

        return $array; 
    } 

     
     
    /** 
     * build_url() 
     * 
     * This function creates a string that is going to be added to the url string 
     * for the navigation links.  This is specially important to have dynamic 
     * links, so if you want to add extra options to the queries, the class is 
     * going to add it to the navigation links dynamically. 
     * 
     * @return string 
     */ 
    function build_url() 
    { 
        global $REQUEST_URI; 
        global $REQUEST_METHOD; 
        global $HTTP_GET_VARS; 
        global $HTTP_POST_VARS; 

        $query_string = ''; 

        list($fullfile, $voided) = explode("?", $REQUEST_URI); 
        $this->file = $fullfile; 
        $cgi = $REQUEST_METHOD == 'GET' ? $HTTP_GET_VARS : $HTTP_POST_VARS; 
        reset ($cgi); 

        while (list($key, $value) = each($cgi)) { 
            if ($key != "row") 
                $query_string .= "&" . $key . "=" . $value; 
        } 

        return $query_string; 
    } 



    /** 
     * display_links($sep_left = ' ', $sep_right = ' ') 
     * 
     * Simple format and return as string of build_links(). 
     * 
     * @param string $sep_left left side separator, ex: ' ', ' [' 
     * @param string $sep_right right side separator, ex: ' ', ' ]' 
     * @return string 
     */ 
    function display_links($sep_left = ' ', $sep_right = '') 
    { 
        $string = ''; 

        $links = $this->build_links(); 
        // reindex links 
        $links = array_values($links); 

        foreach ( $links AS $key => $value ) 
        { 
            // middle stuff 
            // last item 
            if ( 0 != $key ) 
            { 
                $string .= $sep_left . $value . $sep_right; 
            } 

            // first item 
            else 
            { 
                $string .= ( '' == $sep_right ) 
                    ? $value 
                    : $sep_left . $value . $sep_right; 
            } 
        } 

        return $string; 
    } 
     
     
     
    /** 
     * execute($sql, $db, $type = 'mysql') 
     * 
     * The next function runs the needed queries.  It needs to run the first time 
     * to get the total number of rows returned, and the second one to get the 
     * limited number of rows. 
     * 
     * @param string $sql parameter actual SQL query to be performed 
     * @param resource $db database link identifier 
     * @param string $type database type parameter, ex: 
     *     'mysql' - uses mysql php functions 
     *     'pgsql' - uses pgsql php functions 
     * @return resource 
     */ 
    function execute($sql, $db, $type = 'mysql') 
    { 
        global $row; 

        $this->row = $row; 

        $start = $this->row * $this->rows_per_page; 

        if ($type == 'mysql') 
        { 
            $result = mysqli_query($mysqli,$sql, $db); 
            $this->total_records = mysql_num_rows($result); 
            $sql .= " LIMIT $start, $this->rows_per_page"; 
            $result = mysqli_query($mysqli,$sql, $db); 
        } 
         
        elseif ($type == 'pgsql') 
        { 
            $result = pg_Exec($db, $sql); 
            $this->total_records = pg_NumRows($result); 
            $sql .= " LIMIT $this->rows_per_page, $start"; 
            $result = pg_Exec($db, $sql); 
        } 

        return $result; 
    } 



    /** 
     * mk_link($href, $text = '', $target = '', $name = '') 
     * 
     * Create an HTML link. 
     * 
     * @param string $href relative, absolute, or other kind of link, 
     *     ex: 'a.php', 'http://cannonbose.com' 
     * @param string $text link text to display, ex: 'Home' 
     * @param string $target page target, ex: '_blank', '_parent' 
     * @param string $name link name, ex: 'top', 'Barry_Manilow' 
     * @return string 
     */ 
    function mk_link($href, $text = '', $target = '', $name = '') 
    { 
        $out = '<a'; 

        $out .= ( '' != $name ) ? " name='$name'" : ''; 
        $out .= ( '' != $href ) ? " href='$href'" : ''; 
        $out .= ( '' != $target ) ? " target='$target'" : ''; 
        $out .= '>'; 

        $out .= ( '' != $text ) ? $text : $href; 
        $out .= '</a>'; 

        return $out; 
    } 



    /** 
     * num_links_shown($links_to_show) 
     * 
     * Helper function to set var $num_links_shown. Checks for numbers less than 
     * zero and defaults var $num_links_shown if so. 
     * 
     * @param integer $links_to_show, ex: 10, 50 
     * @return void 
     */ 
    function num_links_shown($links_to_show) 
    { 
        $this->num_links_shown = (0 < $links_to_show || false == $links_to_show) 
            ? $links_to_show 
            : $this->num_links_shown_default; 
    } 



    /** 
     * rows_per_page($rows_to_show) 
     * 
     * Helper function to set var $row_per_page. Checks for numbers less than 
     * zero and defaults var $row_per_page if so. 
     * 
     * @param integer $rows_to_show, ex: 10, 50 
     * @return void 
     */ 
    function rows_per_page($rows_to_show) 
    { 
        $this->rows_per_page = ( 0 < $rows_to_show ) 
            ? $rows_to_show 
            : $this->rows_per_page_default; 
    } 

} 

?> 
