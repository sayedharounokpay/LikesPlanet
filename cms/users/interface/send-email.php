
<?php global $baselocation;?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<div class="row">
<form class="form-horizontal" action="<?=$baselocation?>/functions/sendemail" method="POST">
    <div class="form-group">
        <input type="text" class="form-control" name="subject" placeholder="Subject"/>
    </div>
    <div class="form-group">
        <textarea class="form-control" placeholder="Message">
            
        </textarea>
    </div>
</form>
</div>