
<?php global $baselocation;?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

<div class="col-lg-offset-4 col-lg-4 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
<form role="form" action="<?=$baselocation?>/users/base.php?action=add-points-exec" method="POST">
    <input style="display:none">
<input type="password" style="display:none">
<center>
    <h1>Add Points</h1>
</center>
    <hr/>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <input type="text" class="form-control" name="login" placeholder="User Login" required="" autocomplete="off"/>
    </div>
    </div>
    <br/>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <input type="text" class="form-control" name="points" placeholder="Points To Add" required="" autocomplete="off"/>
    </div>
    </div>
    <br/><br/>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <input type="password" style="color:red;" class="form-control" name="conf" placeholder="Admin Password Confirmation" required="" autocomplete="off"/>
    </div>
    </div>
    <br/><br/>
    <input type="submit" class="btn btn-lg btn-info pull-right col-lg-12" value="Add Points"/>
</form>
</div>