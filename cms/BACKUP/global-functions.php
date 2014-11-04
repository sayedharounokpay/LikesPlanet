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
    
    public function display_table() {
        echo '<table class="table table-bordered">';
        echo '<thead><tr>';
        foreach($this->cols as $col) {
            echo '<th>'.$col.'</th>';
        }
        echo '<thead></tr>';
        $offset = $this->pagenum * $this->limit;
        $limit = $offset + $this->limit;
        $query = "SELECT * FROM ".$this->table." LIMIT $offset,$limit";
        echo '<tbody>';
        global $db;
        if( $result = $db->query($query) ) {
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach($this->cols as $key=>$val) {
                    echo '<td>'.$row[$key].'</td>';
                }
                if($this->user_options){
                    $final_string = str_replace('.id.',$row['id'],$this->last_col);
                    echo '<td>'.$final_string.'</td>';
                }
                
                echo '</tr>';
            }
        }
        echo '</tbody></table>';
    }
    
    public function pagination(){
        global $db,$baselocation;
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
