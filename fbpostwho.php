<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);}

$id = $get['id'];
$site200 = mysql_fetch_object(mysql_query("SELECT * FROM `post` WHERE `id`='{$id}'"));

$name0 = $site200->details;
	
?>
<body id="tab4"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbpost.php">Like Photos to Earn</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="fbpostadd.php">Add New Photo/Post</a></li> 
	<li class="tab4"><a href="fbpostmy.php">My Photos</a></li> 
</ul>
</div>
<h1>My FaceBook Posts - Who Liked Me ?</h1>
<p>Here You can see Who Liked your post.</p>
<p>People liked your Post :</p>
<p><font color='blue'><b> <? echo $site200->details; ?> </b></font></p>
<div class="clearer">&nbsp;</div>

		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Username on Facebook liked this Post.</b>			
			</th>	
		</tr>
        	</thead>					
<?
  $site2 = mysql_query("SELECT * FROM `postdone` WHERE `site_id`='{$id}' ");
  
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$siteuser = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE `id`='{$site->user_id}'"));

?>		
			<tbody>
			<tr>
				<td>							
                		<?echo$j;?>							
				</td>				
				<td>												
				<? echo $siteuser->fbn;?>	
				</td>	
			</tr>
			</tbody><?}?>
</table>	

<div class="clearer">&nbsp;</div>

<? include('footer.php');?>