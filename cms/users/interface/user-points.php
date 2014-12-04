
<?php global $baselocation;?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

<div class="row">
<form class="form-horizontal" action="<?=$baselocation?>/users/base.php?action=add-points-exec" method="POST">
    <div class="form-group">
        <input type="text" class="form-control" name="login" placeholder="User Login"/>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="points" placeholder="Points To Add"/>
    </div>
    
    <input type="submit" class="btn btn-lg btn-default pull-right" value="Submit"/>
</form>
</div>