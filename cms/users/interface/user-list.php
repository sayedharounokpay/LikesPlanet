
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
          <button type="button" class="btn btn-primary" onclick="get_user_id('#id')">Search</button>
      </div>
    </div>
  </div>
</div>

<?php
global $baselocation;
$table = "users";
$cols = array('id'=>'User ID','login'=>'Username');
if($_SESSION['admin_level'] == 1) $cols['email'] = "Email";
$limit = 50;
$pagenum = 1;
if(isset($_GET['pagenum'])) {
    $pagenum = $_GET['pagenum'];
}
$usertable = new dbTable($table, $cols, $limit, $pagenum, $user_options = 1, '<a href="'.$baselocation.'/users/base.php?action=uoptions&id=.id.">User Options</a>');
$usertable->display_search($cols);
$usertable->display_table();
$usertable->pagination();