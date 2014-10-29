<?php
include('config.php');
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$userr = $get['userr'];
$userr0 = $get['userr0'];

// http://www.fansigngenerator.com/URL-fansign.asp?pic=http%3A%2F%2Flikesplanet.com%2F0001.jpg&x=-27&y=150&w=230&h=90&text=Welcome+back%0D%0AAdrianHerbert&font=03&fontsize=24&color=%23000000&color2=&gradient=&outline=&transparency=255&shadows=none&shadow=0&left=&right=&up=&down=&rotate=-23&allow=85464&spacing=&align=center&key=
//<? if(isset($data->login)){ ?>
//	<div align="right"> 
//	<iframe src="http://likesplanet.com/welcome_screen.php?userr=Welcome Back&userr0=<? echo $data->login; ?>"
//        scrolling="no" frameborder="0"
//        style="border:none; width:500px; height:318px" sandbox=""></iframe>
//        </div>
//<? } ?>
//<br/>


?>
<html>
<body>

<center>
<img src="http://www.fansigngenerator.com/URL.aspx?align=center&size=&x=-27&y=150&w=230&h=90&color=%23000000&color2=&outline=&gradient=&spacing=&rotate=-23&fontsize=24&text=<? echo $userr; ?>%0D%0A<? echo $userr0; ?>&font=03&allow=85464&transparency=255&shadow=0&shadows=none&key=&pic=http://likesplanet.com/0001.jpg" border="0" title="Welcome Back <? echo ucfirst($userr); ?>!" style="border-radius: 40px;">
</center>
</body>
</html>