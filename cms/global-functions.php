<?php
require_once('conn.php');

function authenticate_page($userlevel) {
    if($userlevel == 1){
        if($_SESSION['admin_level'] == $userlevel){
            return true;
        }
        else {
            global $baselocation;
            echo '<script>document.location.href="'.$baselocation.'/dashboard.php";</script>';
        }
    }
}

class emailMess {
    private $temp1,$temp2;
    public $message,$subject;
    public $additionalargs;
    private $to;
    private $headers;
    public function __construct($to,$message,$subject,$additionalargs=array()) {
        global $baselocation;
        $email1 = file_get_contents($baselocation."/email_temp1.php");
        $email2 = file_get_contents($baselocation.'/email_temp2.php');
       $this->message = $email1.$message.$email2;
       $this->subject = $subject;
       $this->to = $to;
       if(isset($headers) && strlen($headers) > 1){
           $this->headers = $headers;
       }
       else {
           if(isset($additionalargs) && count($additionalargs)) {
               $this->additionalargs = $additionalargs;
           }
           else {
               $additionalargs['headers'] = array('from_name'=>'LikesPlanet.com',
                   'from'=>'likesplanet.com@gmail.com',
                   'random_hash'=> md5(date_default_timezone_set("r")));
               $this->additionalargs = $additionalargs;
           }
           $from_name = $this->additionalargs['headers']['from_name'];
           $from = $this->additionalargs['headers']['from'];
           $random_hash = $this->additionalargs['headers']['random_hash'];
           
            $headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers .= "From: $from_name" . "\r\n" .
"Reply-To: $from" . "\r\n" .
"X-Mailer: PHP/" . phpversion();
            $this->headers = $headers;
       }
    }
    
    public function sendmail() {
        $random_hash = $this->additionalargs['headers']['random_hash'];
        $mailmessage = 
$this->message;
      
        if(mail($this->to,$this->subject,$mailmessage,$this->headers)) {
            return 1;
        }
        else {
            return 0;
        }
        
    }
}

class dbTable {
    public $cols = array();
    protected $pagenum;
    protected $limit;
    protected $table;
    protected $user_options;
    protected $last_col;
    protected $checkbox_arr;
    protected $order;
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
     * @param checkbox_arr An Option to add a checkbox to the table
     * @param order 'ASC' Or 'DESC'
     */
    public function __construct($table,$cols,$limit,$pagenum=1,$user_options=array(),$last_col="",$checkbox_arr=array(),$order="") {
        $pagenum--;
        $this->pagenum = $pagenum;
        $this->limit = $limit;
        $this->table = $table;
        $this->user_options = $user_options;
        $this->checkbox_arr = $checkbox_arr;
        $this->last_col = $last_col;
        $this->order = $order;
        foreach($cols as $key=>$val){
           $this->cols[$key] = $val;
        }
    }
    
    
    public function display_search($search,$search_length=array()) {
        $link = $this->full_url($_SERVER);
        //echo $link;
        
        $new_link = (strpos($link,'&search=true') == TRUE) ? $link : $link.'&search=true';
        $new_link = str_replace('&searchthrough=true','',$new_link);
        $new_link = str_replace('&pagenum=','&oldencrypt=',$new_link);
        echo '<h4>Search</h4>';
        echo '<form class="form-horizontal" action="'.$new_link.'" style="display:block;margin-bottom:45px;" method="POST">';
        if(is_array($search)) {
            $userarr=array();
            if(isset($_SESSION['searchparam'])) {
                $userarr = $_SESSION['searchparam'];
            }
            foreach($search as $key => $val) {
                    $value = (isset($_POST[$key])) ? $_POST[$key] : '';
                    if(!isset($_POST[$key])) $value = (isset($userarr[$key])) ? $userarr[$key] : '';
                    
                    
                    echo '<div class="form-group col-sm-4" style="">'
                    . '<label for="" class="control-label col-sm-4">'.$val.'</label><div class="col-sm-8"><input style="" id="'.$key.'" type="text" name="'.$key.'" value="'.$value.'" class=" form-control"/></div>'
                            . '</div>';
                
            }
            echo '<div class="form-group pull-right"><input type="submit" id="searchbtn-frmsearch" class="btn btn-primary" value="Search"/></div>';
        }
        else {
           echo 'Search Functionality Error';
        }
        echo '</form>';
    }
    
    private function build_search($array,$page=0) {
        $offset=0;
        $limit=$this->limit;
        $where = "";
        $wherecount = count($array);
        
        if($page > 0) {
            $offset = $limit*$page;
            $limit = $offset+$this->limit;
        }
        
        foreach($array as $key => $val){
                    
                    $searchparam = "";
                    $greaterrange =0;
                    $lesserrange  =0;
                    $is_blank=FALSE;
                    if(strpos($key,'_greaterrange')){
                        $key = str_replace('_greaterrange', '', $key);
                        $greaterrange++;
                    }                        
                    if(strlen($val) < 1 && !is_numeric($val)) {
                        $searchparam = '!';
                        $blank++;
                        $is_blank = TRUE;
                    }
                    if(is_numeric($val) && !$is_blank) {
                        
                         if($greaterrange == 1){ 
                             if(strlen($val) > 0) {
                                $where .= " $key >= $val ";
                             }
                        }
                        else {
                            $where .= " $key = $val ";
                        }
                    }
                    else {
                        if(! $is_blank)
                        $where .= " $key $searchparam= '$val' ";
                    }
                    if($wherecount > 1 && $wheres < $wherecount && $is_blank != true ) {
                        
                        $where .= "AND";
                    }
                    $wheres++;
                    
                }
                
                $returnarr = array('where'=>$where,'offset'=>$offset,'limit'=>$limit);
                return $returnarr;
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
        $returnarr = array();
        if(isset($_GET['search'])) {
            $_SESSION['searchparam'] = array();
            $where = "";
            $wheres = 1;
            $wherecount = 0;
        foreach($_POST as $key=>$val) {
            if(strlen($val) > 0){
                $wherecount++;
            }
            $_SESSION['searchparam'][$key] = $val;
        }
            
        }
        
        if($_GET['search'] == 'true' || $_GET['searchthrough']) {
                $returnarr = $this->build_search($_SESSION['searchparam'],$this->pagenum);
                $where = $returnarr['where'];
                $limit = $returnarr['limit'];
                $offset = $returnarr['offset'];
            }
        
        $query = "SELECT * FROM ".$this->table." LIMIT $offset,$limit";
        if(strlen($where) > 5) {
            $query = "SELECT * FROM ".$this->table." WHERE $where LIMIT $offset,$limit";
        }
       
      
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
            var_dump($_SESSION['searchparam'])
        }
        echo '</tbody></table>';
    }
    
    public function pagination(){
        global $db,$baselocation;
        if(! isset($_GET['search']) && ! isset($_GET['searchthrough'])) {
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
        
        else if(isset($_GET['search']) || isset($_GET['searchthrough'])) {
            $returnarr = $this->build_search($_SESSION['searchparam']);
            $where = $returnarr['where'];
            $result = $db->query("SELECT COUNT(*) FROM {$this->table} WHERE $where");
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
                $new_link = str_replace('search=true','searchthrough=true',$new_link);
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
