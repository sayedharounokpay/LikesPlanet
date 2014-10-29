<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}
foreach($_POST as $key => $value) {
	$protect[$key] = filter($value);
}
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$high = $get['high'];

$sitehidden = mysql_query("SELECT * FROM `facebook` WHERE (`user`='{$data->id}' AND `hide`='1')");
$sitehiddennum = mysql_num_rows($sitehidden);

?>
<body id="tab3"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="fbstdlikes.php">Earn Points</a></li> 
	<li class="tab2"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab3"><a href="fbpages.php">My Pages</a></li> 
</ul>
</div>

<h1>Facebook Pages Likes - My Fan-Pages.</h1>
<p>Here You can see How many likes you received for each page, and How many people had 'Skipped' your page!</p>
<p>When users 'Report' your page a lot of times, Your page will be Closed, You can Activate it once again.</p>
<p>When your page is Closed, Please make sure Page URL is Correct, 'Edit' it and Activate it again.</p>
<p>[Stop At] means Page will stop automatically when Likes on Facebook reach this number.</p>
<p>Remember to ADD Coins to your page. or it will Not receive likes even if you have points in account balance.</p>

<? if($sitehiddennum > 0) { 

echo "<div id=\"-1\">
<div class=\"msg_success\" style=\"margin-top: 0px; margin-bottom: 4px; background: #00FF00;\">
<a STYLE=\"text-decoration:none\" href='fbshowall.php' target='_blank' ><b><font color=\"#800080\"> $sitehiddennum Pages are temporary Invisible/Hidden on list. Click here to show all hidden pages again. </font></b> </a>
</div></div>";
 } ?>
 </br>

		<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="150">			
			<b>Page</b>			
			</th>			
            <th width="120">			
			<font color='green'><b>Likes</b></font>			
			</th>
            <th>			
			<b>CPC</b>			
			</th>			
			<th>			
			<b>Points</b>			
			</th>
			<th width="120">			
			Skips/<font color='red'>Reports</font>		
			</th>	
			<th>			
			<b>Target</b>			
			</th>	
			<th width="50">			
			<b>Stop At</b>			
			</th>		
			<th width="140">			
			<b>Add/Retract Points</b>			
			</th>				
		</tr>
        </thead>					
<?
  
  $site2 = mysql_query("SELECT * FROM `facebook` WHERE (`user`='{$data->id}' AND `hide`='0') ORDER BY `oid` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

if (strpos($site->facebook, '?') != false) {
$mobilelinksO = explode('?', $site->facebook);
$mobilelink = $mobilelinksO[0];
} else {
$mobilelink = $site->facebook;
}

$pictureofpageall = explode('/', $mobilelink);
if (strpos($site->facebook, '/pages/') != false) {
$imageurlurl = "https://graph.facebook.com/" . $pictureofpageall[5] . "/picture";
} else {
$imageurlurl = "https://graph.facebook.com/" . $pictureofpageall[3] . "/picture";
}

?>		
			<tbody>
			<tr>
				<td>
				<a href="<? echo $site->facebook;?>" target="_blank" title="<? echo $site->title;?>" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" > <img src="<? echo $imageurlurl; ?>"  style="border-radius: 10px;"> </a>
				
				<? if($site->active == 1) {?>
				&nbsp;&nbsp;
					<? if($site->lastreallikes >= $site->top ) {?>
					<img src="img/DONE.png" title="Done at <? echo $site->lastreallikes; ?>!">
					<? } else { ?>
					<img src="img/alerticon.png" title="Paused at <? echo $site->lastreallikes; ?>!">
					<? } ?>
				<? } else { ?>
				<font color='grey'> ~<? echo $site->lastreallikes; ?> </font>
				<? } ?>	
				
				</td>	
				<td>				
				<b><font color='green' size='4'><? echo $site->likes+$site->minilikes; ?></b></font> 
				</br></br>
				<font color='blue' size='2'><? echo $site->likes+$site->minilikes+$site->jump+$site->skipped; ?> hits.</font> 
				</td>
				<td>				
				<? echo $site->cpc;?></br>	
				</td>
				<? if($high == $site->id) { ?>
				<td style="background: #ffff00;">
				<? } else { ?>
				<td>
				<? } ?>		
				<?if($site->points < 16){?>
				<font color='red' size='4'><b><? echo $site->points;?></b></font></br>
				<a href="fbcoins.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/add2.png" border="0" title="Add Points to get more likes"></a>
				<? } else { ?>
				<font color='blue' size='4'><? echo $site->points;?></font>
				<? } ?>
				</td>
				<td>				
				<font size='3'><? echo $site->jump;?> - <font color='red'><? echo $site->skipped;?></font></font>	
				</td>
				<td>
				<? if($site->target != ''){ 
					$targetlist = str_replace(')(' , ')</br>(' , $site->target);
					$targetlist = str_replace('(' , '.' , $targetlist);
					$targetlist = str_replace(')' , '.' , $targetlist); ?>
					<a href="editfb.php?id=<? echo $site->id;?>" target="_Blank">
					<font style="background-color: red;" color="white" size='3'><b> <? echo $targetlist; ?> </b></font>
					</a>
				<? } else { ?>
					<font color="grey"> Off </font>
				<? } ?>
				</font>
				</td>
				<td>		
				<font color="<?if($site->top > 0){echo 'blue';}else{echo 'grey';}?>">
				<? echo $site->top;?>			
				</font>
				</td>
				<td>	
				<center>			
				<a href="editfb.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/pencil2.png" border="0" title="Edit"></a>
				<a href="delfb.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/delete2.png" border="0" title="Delete Page"></a>			
				</br>						
				<a href="fbcoins.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/add2.png" border="0" title="Add Points"></a>
				<a href="fbcoins2.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/retract2.png" border="0" title="Retract Points"></a>
				</br>
				<a href="fbhide.php?id=<? echo $site->id;?>" target="_Blank"><img src="img/hidelist2.png" border="0" title="Hide Page from List (Temporary)"></a>
				</center>
				</td>	
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>
