
<?php global $baselocation;?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<div class="row">
<form class="form-horizontal" action="<?=$baselocation?>/users/base.php?action=email-send-act" method="POST">
    <div class="form-group">
        <input type="text" class="form-control" name="subject" placeholder="Subject"/>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="message" placeholder="Message">
            
        </textarea>
    </div>
    <input type="submit" class="btn btn-lg btn-default pull-right" value="Submit"/>
</form>
</div>