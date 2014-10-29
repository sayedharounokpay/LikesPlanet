<html>
    <head>
      <title>Like Button Generator</title>
    </head>
    <body>
    
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
<div class="fb-like" data-href="<?php echo $_GET["url"]; ?>" data-send="false" data-show-faces="false" data-layout="button_count" data-action="recommend"></div>

	</body>
 </html>