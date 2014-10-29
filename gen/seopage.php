<html>
    <body>
    
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
 FB.init({status: true, cookie: true, xfbml: true});
 var user = "<? echo $_GET["user"];?>";
 var siteid = "<? echo $_GET["siteid"];?>";
 var ownerid = "<? echo $_GET["ownerid"];?>";
 FB.Event.subscribe('edge.remove', function(response) {
    document.getElementById("unlike").src = "http://www.likesasap.com/unlikefb.php?userid="+user;
    alert( "Do NOT Unlike Pages! You lost -15 Points." );
 });
 FB.Event.subscribe('edge.create', function(response) {
    document.location = "http://www.likesasap.com/likedonbuttonasap.php?userid="+user+"&siteid="+siteid+"&ownerid="+ownerid;
 });
};
(function() {
 var e = document.createElement('script');
 e.type = 'text/javascript';
 e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
 e.async = true;
 document.getElementById('fb-root').appendChild(e);
 }());
</script>
    
    <div><fb:like href="<? echo $_GET["url"];?>" send="false" layout="button_count" show_faces="false" action="recommend" font=""></fb:like></div>

<iframe id="unlike" name="unlike" src="" scrolling="no" frameborder="0"
        style="border:none; width:0px; height:0px"></iframe>

    </body>
 </html>