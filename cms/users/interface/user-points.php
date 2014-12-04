
<?php global $baselocation;?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

<div class="row">
<form role="form" action="<?=$baselocation?>/users/base.php?action=add-points-exec" method="POST">
    <div class="row">
    <div class="col-lg-5">
        <input type="text" class="form-control" name="login" placeholder="User Login" required=""/>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-5">
        <input type="text" class="form-control" name="points" placeholder="Points To Add" required=""/>
    </div>
    </div>
    
    <input type="submit" class="btn btn-lg btn-default pull-right" value="Submit"/>
</form>
</div>