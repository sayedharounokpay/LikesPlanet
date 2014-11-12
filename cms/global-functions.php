<?php
require_once('conn.php');
class dbTable {
    public $cols = array();
    protected $pagenum;
    protected $limit;
    protected $table;
    protected $user_options;
    protected $last_col;
    protected $checkbox_arr;
    /**
     * __construct
     * 
     * Creates the table
     * 
     * @param table The Selected Table for information to be fetch
     * @param cols Array of Columns to be used on the table
     * @param limit The limit of records displayed per page
     * @param pagenum The Current Page number
     * @param user_options Array to display what types of options the administrator has
     * @param last_col An option to add code to the last Columns
     */
    public function __construct($table,$cols,$limit,$pagenum=1,$user_options=array(),$last_col="",$checkbox_arr=array()) {
        $pagenum--;
        $this->pagenum = $pagenum;
        $this->limit = $limit;
        $this->table = $table;
        $this->user_options = $user_options;
        $this->checkbox_arr = $checkbox_arr;
        $this->last_col = $last_col;
        foreach($cols as $key=>$val){
           $this->cols[$key] = $val;
        }
    }
    
    public function display_search($search,$search_length=array()) {
        $link = $this->full_url($_SERVER);
        //echo $link;
        
        $new_link = (strpos($link,'&search=true') == TRUE) ? $link : $link.'&search=true';
        echo '<h4>Search</h4>';
        echo '<form class="form-horizontal" action="'.$new_link.'" style="display:block;margin-bottom:45px;" method="POST">';
        if(is_array($search)) {
            foreach($search as $key => $val) {
                    $value = (isset($_POST[$key])) ? $_POST[$key] : '';
                    echo '<div class="form-group col-sm-4" style="">'
                    . '<label for="" class="control-label col-sm-4">'.$val.'</label><div class="col-sm-8"><input style="" type="text" name="'.$key.'" value="'.$value.'" class=" form-control"/></div>'
                            . '</div>';
                
            }
            echo '<div class="form-group pull-right"><input type="submit" class="btn btn-primary" value="Search"/></div>';
        }
        else {
           echo 'Search Functionality Error';
        }
        echo '</form>';
    }
    
    public function display_table() {
        echo '<table class="table table-bordered">';
        echo '<thead><tr>';
        foreach($this->cols as $col) {
            echo '<th>'.$col.'</th>';
        }
        echo '<thead></tr>';
        $offset = $this->pagenum * $this->limit;
        $limit = $offset + $this->limit;
        $where ="";
        $blank = 0;
        $wherecount = count($_POST);
        if(isset($_GET['search'])) {
            $where = "";
            $wheres = 1;
            if($_GET['search'] == 'true') {
                foreach($_POST as $key => $val){
                    $searchparam = "";
                    $greaterrange =0;
                    $lesserrange  =0;
                    $is_blank=FALSE;
                    if(strpos($key,'_greaterrange')){
                        $key = str_replace('_greaterrange', '', $key);
                        $greaterrange++;
                    }                        
                    if(strlen($val) < 1) {
                        $searchparam = '!';
                        $blank++;
                        $is_blank = TRUE;
                    }
                    if(is_numeric($val)) {
                        
                         if($greaterrange == 1){ 
                             if(strlen($val) > 0) {
                                $where .= " $key >= $val ";
                             }
                        }
                        else {
                        $where .= " $key >= 0 ";
                        }
                    }
                    else {
                        if(! $is_blank)
                        $where .= " $key $searchparam= '$val' ";
                    }
                    if(count($_POST) > 1 && $wheres < count($_POST) && $is_blank != true ) {
                        
                        $where .= "AND";
                    }
                    $wheres++;
                    
                }
            }
        }
        $query = "SELECT * FROM ".$this->table." LIMIT $offset,$limit";
        if(strlen($where) > 5 && ($blank < $wherecount)) {
            $query = "SELECT * FROM ".$this->table." WHERE $where LIMIT 500";
        }
       echo $query;
      
        echo '<tbody>';
        global $db;
        if( $result = $db->query($query) ) {
            // Dependencies Variables
                $total=0;
            while($row = $result->fetch_assoc()) {
                
                
                //Code
                echo '<tr>';
                foreach($this->cols as $key=>$val) {
                    echo '<td>'.$row[$key].'</td>';
                }
                if($this->user_options == 1){ // Add custom code
                    $final_string = str_replace('.id.',$row['id'],$this->last_col);
                    echo '<td>'.$final_string.'</td>';
                }
                else if($this->user_options == 2 && isset($_GET['search'])) {
                    $total = $total + $row['coins_gained'];
                    echo '<td>'.$total.'</td>';
                }
                
                echo '</tr>';
            }
        }
        else {
            echo '<br>Invalid query: '.$query;
        }
        echo '</tbody></table>';
    }
    
    public function pagination(){
        global $db,$baselocation;
        if(! isset($_GET['search'])) {
        $result = $db->query("SELECT COUNT(*) FROM ".$this->table);
        $row = $result->fetch_row();
        $count = $row[0];
        
        $pages = round($count/$this->limit);
        
        $action = "";
        if(isset($_GET['action'])){
            $action=$_GET['action'];
        }
        $pagenum = $this->pagenum + 1;
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        echo '<ul class="pagination">';
        for($i = $pagenum - 5; $i < $pagenum + 5; $i++) 
        {
           
            if($i > 0 && $i <=$pages) {
                $new_link = str_replace('pagenum='.$pagenum, 'pagenum='.$i, $actual_link);
                if($new_link == $actual_link) {
                    $new_link = $actual_link.'&pagenum='.$i;
                }
                if($i == $pagenum) echo '<li><a class="active" href="#">'.$i.'</a></li>';
                else echo '<li><a href="'.$new_link.'">'.$i.'</a></li>';
            }
        }
        echo '</ul>';
        }
    }
    
    function url_origin($s, $use_forwarded_host=false)
    {
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
        $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }
    function full_url($s, $use_forwarded_host=false)
    {
        return $this->url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
    }

    
}
