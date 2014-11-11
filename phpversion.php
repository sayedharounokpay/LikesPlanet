<?php include('header.php');?>
<div class="result">
    Data displayed here
</div>
<script>
   $.getJSON('https://graph.facebook.com/daily.developer.online2', function(data) {
      alert(data["likes"]);
       //JSONObject json = new JSONObject(data);
       //alert(json);
   });
</script>
