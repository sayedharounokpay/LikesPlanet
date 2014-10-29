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

<div class="fb-subscribe" data-href="https://www.facebook.com/<?php echo $_GET["url"]; ?>" data-layout="button_count" data-show-faces="false" data-width="200"></div>

	</body>
 </html>