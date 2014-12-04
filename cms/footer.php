</div>
<hr>
<div class="footer">
      <div class="container">
        <p class="text-muted">Copyright 2014 LikesPlanet Team</p>
      </div>
</div>

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
</body>
</html>