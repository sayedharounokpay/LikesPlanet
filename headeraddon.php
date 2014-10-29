<?
include('config.php');
if($site->maintenance > 0){
echo "<script>document.location.href='maintenance'</script>";
exit;
}

?>
<head>
<title><? echo $site->site_name;?></title>

<meta name="description" content="<? echo $site->site_description;?>" /> 
<meta name="keywords" content="LikesPlanet.com, LikesPlanet, Google Plus one, facebook likes, facebook fans, twitter followers, digg, youtube views" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<style>
input:hover[type="submit"] {
background: #FF9900;
box-shadow:inset 0px 0px 3px 4px rgba(0,0,0,0.4);
color: #602060;
}
input {
transition: 0.2s all ease;
}
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>
</head>

	<div id="main">