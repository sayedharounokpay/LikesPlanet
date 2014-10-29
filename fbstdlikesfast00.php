<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$x110 = explode('(', $data->country);
$x110o = explode(')', $x110[1]);
	if ($x110o[0] == ''){ $x110o[0] = 'XX'; }
$usertargetc = '(' . $x110o[0] . ')';

?>
<div class="clearer">&nbsp;</div>

<body id="tab2"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="fbstdlikes.php">Earn Points</a></li> 
	<li class="tab2"><a href="fbstdlikesfast.php">Earn Points (Fast) *BETA</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab3"><a href="addfb.php">Add Facebook Page</a></li> 
	<li class="tab4"><a href="fbpages.php">My Pages</a></li> 
</ul>
</div>

<h1>Facebook Pages Likes - Become a Fan and Earn points/cash.</h1>
<p>To get free points/cash by liking others Facebook Pages click on 'Like' button, You will see small 'Facebook Like' button.</p>
<p>Click on 'Facebook Like' button, wait for 3 seconds, then click on 'Confirm' to earn Points/Cash!</p>
<p><font color='green' style="background-color: yellow;"><b>Note:</font> <font color='green'>Do NOT like all pages then confirm all, You SHOULD like pages One-by-One.</b></font></p>
<p><font color='darkred'>If you see any page <b>Already liked</b>, <b>Do NOT</b> Try to like it again, simply 'Skip' it.</font></p>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<? 

  $siteliked4[] = "'none'";
  $siteliked2 = mysql_query("SELECT * FROM `liked` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'" ; }
  
  $site2 = mysql_query("SELECT * FROM `facebook` WHERE (`active` = '0' AND `points` > `cpc`) AND (`target`='' OR `target` LIKE '%{$usertargetc}%' ) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 20;");
 
  $ext = mysql_num_rows($site2);
  
if($ext > 0){
?>
<script>
function refreshpage()
   {window.location.reload();}
function removeElement(parentDiv, childDiv){
         if (document.getElementById(childDiv)) {     
                    var child = document.getElementById(childDiv);
                    var parent = document.getElementById(parentDiv);
                    parent.removeChild(child);}
    }
</script>

<div id="tbl" style="width: 850px;">

</br>

<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="52">			
				<b>Page</b>			
			</th>			
            		<th width="150">			
				<font color='green'><b>Points</b></font>			
			</th>
            		<th width="150">			
				<b>Start</b>			
			</th>
			<th width="150">			
				<b>Like</b>			
			</th>			
			<th width="130">			
				<b>Confirm</b>			
			</th>
			<th>			
				Status
			</th>				
		</tr>
        </thead>	
        

<?
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
$pictureofpage = "https://graph.facebook.com/" . $pictureofpageall[5] . "/picture";
} else {
$pictureofpage = "https://graph.facebook.com/" . $pictureofpageall[3] . "/picture";
}

?>
<center>
	<tbody>
	<tr>
		<td>
			</br>
			<a href="<? echo $site->facebook; ?>">
			<img src="<? echo $pictureofpage; ?>" style="border-radius: 10px;">
			</a>
			</br></br>
		</td>	
		<td>
			<font color='blue' size='3'> <b><? echo $site->cpc-1;?></b> Points.</font>
			</br></br>
			<font color='green' size='2'> $<b><?echo number_format(($site->cpc-1)/$coinsdollar,4);?></b> </font>
        	</td>	
		<td>
			<? if($j == 1) { ?>
			<div id="likebtn<? echo $j;?>" style="display:block;" >
			<? } else { ?>
			<div id="likebtn<? echo $j;?>" style="display:none;" >
			<? } ?>
        		<a href="javascript:void(0);" onclick="OpenLike('<? echo $site->id;?>', '<? echo $site->user;?>', '<? echo $site->facebook;?>', '<? echo $site->cpc;?>', '<? echo $j;?>');"  >
        		<input type="submit" class="submit" value="Like" style="height: 28px;" />
			</a>
			</div>
			</br>
        		<div>
			<a href="javascript:void(0);" onclick="SkipThisPage('<? echo $site->id;?>', '<? echo $j;?>');"><font color='grey' size=2>[Skip]</font></a>
			</div>
        	</td>	
		<td>
			<iframe style="display:block; position: center; height: 80px; width: 110px; font-size: 24; color: #604060;" 
        scrolling="no" frameborder="0" id="likeme<? echo $j;?>"></iframe>
        	</td>	
		<td>
			<a href="javascript:void(0);" onclick="GetSubCount('<? echo $site->id;?>', '<? echo $site->user;?>', '<? echo $j;?>');"  >
        		<input type="submit" class="submit" value="Confirm" style="height: 28px;" />
			</a>
			</div>
		</td>	
		<td>
			<div id="stat<? echo $j;?>" style="border-radius: 0px; border: 0px solid #cdcdcd; display:block; padding: 0px; position: center; height: 80px; width: 120px;"></div>
		</td>	
	</tr>
	</tbody>
	
</center>

<?}?>

</table>

<script type="text/javascript">
var nextbtn = 0;
var nextbtnstr = 'hello';
function OpenLike(mysiteid, siteowner, mysite, cpc, jaa){
	document.getElementById('likeme'+jaa).contentWindow.location = "http://crowngold.biz/joinyayapp.php?user=<? echo $data->id;?>&url=" + mysite;
	$("#stat"+jaa).html('</br></br><img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "fbstartlike.php",
		data: "sitename1="+mysiteid+ "---" + siteowner,
		success: function(msg){
			if (msg > 0){
			$("#stat"+jaa).html('<b><font size="3" color="blue"><<<<<<<< </br> 1.Like </br> 2.Confirm</br><<<<<<<< </font></b>');
			} else {
			$("#stat"+jaa).html('<font size="2" color="red">Page is Broken.</font>');
			}
		}
	});
	}
function SkipThisPage(mysiteid, jaa){
		$("#stat"+jaa).html('</br></br><img src="img/loader.gif">');
		$.ajax({
        		type: "POST",
        		url: "skipfb_free.php",
        		data: "data="+ mysiteid + "---" + '<? echo $data->id;?>',        
        		cache: false,
        		success: function(){
        		$("#stat"+jaa).html('</br></br><font size="4" color="blue">Skipped!</font>');
        		}
    		});
    		document.getElementById('likeme'+jaa).contentWindow.location = "blank.php";
    		nextbtn = 1+Math.floor(jaa); 
		nextbtnstr = 'likebtn' + nextbtn.toString();
		document.getElementById(nextbtnstr).style.display = 'block';
	}
function GetSubCount(mysiteaccid1, pageuserowner, jaa){
	$("#stat"+jaa).html('</br></br><img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "fblikesconflike.php",
		data: "sitename1="+mysiteaccid1+ "---" + pageuserowner,
		success: function(msg){
			
			if (msg > 0){
			$("#stat"+jaa).html('</br></br><font size="4" color="green">Liked!</font>');
			document.getElementById('likeme'+jaa).contentWindow.location = "blank.php";
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
			}
			if (msg == '-1'){
			$("#stat"+jaa).html('</br></br><font size="4" color="green">OK !</font>');
			document.getElementById('likeme'+jaa).contentWindow.location = "blank.php";
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
			}
			if (msg == 0){
			$("#stat"+jaa).html('</br></br><font size="4" color="red">Not Liked!</font>');
			}
		}
	});
	
		nextbtn = 1+Math.floor(jaa); 
		nextbtnstr = 'likebtn' + nextbtn.toString();
		document.getElementById(nextbtnstr).style.display = 'block';
	
	}
</script>

</div>

<div class="clearer">&nbsp;</div>

<div class='infobox'> 

<form action='' method='' onsubmit='refreshpage();'>
<input name='refresh' type='submit' value='Load More Pages...' style='width: 200px;'>
</form></div>

<?}else{?>
<center></br>
<? $message00 = "Sorry, there are no more coins to be earned at the moment.</br>Please come back again later.</br><a href='buy.php'><b>Feel like you need more coins? You can purchase them now!</b></a>"; ?>
<table cellpadding="0" cellspacing="0" border="0" class="form" style="margin-top: 0px; padding: 0px; border: 0px;">
<tr><td><img src="img/planet_stop.jpg" border="0" title="LikesPlanet.com - Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00;?> </font> </td></tr>
</table>
</center>
<?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>