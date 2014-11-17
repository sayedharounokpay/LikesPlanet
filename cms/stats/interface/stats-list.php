<script>
    function get_user_id() {
        
        var userlogin = $('#userlogin').val();
        var url_type = '<?=$baselocation;?>/ajax-functions.php';
        $.ajax({
            type: "GET",
            url: url_type,
            data: { function: "get_user_id_from_login", userlogin: userlogin },
            success: function(data) {
                $('#useridfetchclose').click();
               
                if(isNaN(data)) alert(data);
                else{  
                    $('#user_id').val(data); 
                    
                    }
            }
            
        });
        
    }
</script>

<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#userModal">
  Set User
</button>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="useridfetchclose" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Search For User ID</h4>
      </div>
      <div class="modal-body">
          <input type="text" class="form-control" id="userlogin" placeholder="User Login"/>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="get_user_id()">Search</button>
      </div>
    </div>
  </div>
</div>
<?php
global $baselocation;
$table = "statistics";
$cols = array('id'=>'Stat ID','user_id'=>'User','date'=>'Date','coins_gained'=>'Points Earned','coins_deducted' => 'Points Deducted','log' => 'Status');
$limit = 50;
$pagenum = 1;
if(isset($_GET['pagenum'])) {
    $pagenum = $_GET['pagenum'];
}

$usertable = new dbTable($table, $cols, $limit, $pagenum, $user_options = 2);
$usertable->display_search(array('user_id'=>'User ID','date'=>'Date','coins_gained_greaterrange'=>'Points Gained >=','coins_deducted_greaterrange' => 'Points Deducted >='));

if(isset($_SESSION['searchparam'])) {
    global $db;
    $user_arr = $_SESSION['searchparam'];
    if(isset($user_arr['user_id'])) {
        echo '<table class="table table-bordered"><thead><tr><th>Total Points Gained</th><th>Total Points Used</th><th>Total Points in Account</th></tr><tbody><tr>';
        $userid = $user_arr['user_id'];
        $query = "SELECT sum(coins_gained) as sum_gained FROM statistics WHERE user_id={$userid}";
        if($result = $db->query($query)) {
            if($row = mysqli_fetch_assoc($result)) {
                echo '<td>'.$row['sum_gained'].'</td>';
            }
        }
        $query = "SELECT sum(coins_deducted) as sum_deducted FROM statistics WHERE user_id={$userid}";
        if($result = $db->query($query)) {
            if($row = mysqli_fetch_assoc($result)) {
                echo '<td>'.$row['sum_deducted'].'</td>';
            }
        }
        $query = "SELECT coins FROM users WHERE id={$userid}";
        if($result = $db->query($query)) {
            if($row = mysqli_fetch_assoc($result)) {
                echo '<td>'.$row['coins'].'</td>';
            }
        }
        echo '</tbody></table>';
    }
}

$usertable->display_table();
$usertable->pagination();
?>