<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab5"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbpost.php">Like Photos to Earn</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="fbpostadd.php">Add New Photo/Post</a></li> 
	<li class="tab4"><a href="fbpostmy.php">My Photos</a></li> 
</ul>
</div>
<h1>HELP : My Photo/Post becomes Disabled !</h1>

<div class="clearer">&nbsp;</div>

<p><b> Your post becomes <font color='red'>Disabled</font> ? </b> </p> 

<div class="clearer">&nbsp;</div>

<p><b>1-</b> Make sure Your Post/Photo is PUBLIC, NOT Custom and NOT for Friends. </p> 
<p> and Make sure NO Friends are tagged in your photo/album. <b>(Remove All Tags)</b> </p> 

<img src="img/POSTHELP1.png" border="0" title="Photo Should be PUBLIC">

<p>You can change this from Basic Album Privacy.</p>

<div class="clearer">&nbsp;</div>

<p><b>2-</b> Make sure Your Facebook Account is Public, so You Allow Non-Friends to Like Your Photos/Posts. </p> 
<p> <a href="http://www.facebook.com/settings/?tab=privacy&ref=mb">Click here to Set your privacy to PUBLIC.</a> </p>

<div class="clearer">&nbsp;</div>

<p><b>3-</b> Refine your Post/Photo URL. </p> 

<img src="img/POSTHELP3.png?a" border="0" title="Refine URL">


<div class="clearer">&nbsp;</div>

<? include('footer.php');?>