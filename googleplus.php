<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}

$x110 = explode('(', $data->country);
$x110o = explode(')', $x110[1]);
	if ($x110o[0] == ''){ $x110o[0] = 'XX'; }
$usertargetc = '(' . $x110o[0] . ')';

?>
<div class="clearer">&nbsp;</div>

<body id="tab1"> 
<div>
<ul id="tabnav">  
	<li class="tab1"><a href="googleplus.php">Earn Coins</a></li> 
	<li class="tab0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </li> 
	<li class="tab2"><a href="addgoogle.php">Add Website</a></li> 
	<li class="tab3"><a href="googlepages.php">Your Websites</a></li> 
</ul>
</div>

<h1>Google Plus/Shares/Votes - Share Sites on Google and Earn points/money.</h1>
<p>To get free points/money by sharing websites, click on 'Vote' button, You will see small 'Google Plus' button.</p>
<p>Click on 'Google Plus' button, wait for 20 seconds, then click on 'Confirm' to earn Points/Money!</p>

<p> If you see <img src="img/googleplusERR.png"> This means your Google Account is Limited, Please use another account. </p>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>

<? 

  $siteliked4[] = "'none'";
  $siteliked2 = mysql_query("SELECT * FROM `plused` WHERE (`user_id`='{$data->id}') ");
  for($j=0; $siteliked = mysql_fetch_object($siteliked2); $j++)
	{ $siteliked4[] = "'" . $siteliked->site_id . "'" ; }
  
  $site2 = mysql_query("SELECT * FROM `google` WHERE (`active` = '0' AND `points` > `cpc`) AND `id` NOT in (".implode(',', $siteliked4).") ORDER BY `cpc` DESC LIMIT 0, 12;");
 
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
				<b>Site</b>			
			</th>			
            		<th width="150">			
				<font color='green'><b>Points</b></font>			
			</th>
            		<th width="150">			
				<b>Start</b>			
			</th>
			<th width="150">			
				<b>Vote</b>			
			</th>			
			<th>			
				Status
			</th>				
		</tr>
        </thead>	
        

<?
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>
<center>
	<tbody>
	<tr>
		<td>
			</br>
			<font color='blue' size='2'><? echo $site->title; ?></font>
			</br></br>
		</td>	
		<td>
			<font color='blue' size='3'> <b><? echo $site->cpc-1;?></b> Points.</font>
			</br></br>
			<font color='green' size='2'> $<b><?echo number_format(($site->cpc-1)/$coinsdollar,4);?></b> </font>
        	</td>	
		<td>
		<center>
			<? if($j == 1) { ?>
			<div id="likebtn<? echo $j;?>" style="display:block;" >
			<? } else { ?>
			<div id="likebtn<? echo $j;?>" style="display:none;" >
			<? } ?>
        		<a href="javascript:void(0);" onclick="OpenLike('<? echo $site->id;?>', '<? echo $site->user;?>', '<? echo $site->google;?>', '<? echo $site->cpc;?>', '<? echo $j;?>');"  >
        		<input type="submit" class="submit" value="Vote" style="height: 35px;" />
			</a>
			</div>
			</br>
        		<div>
			<a href="javascript:void(0);" onclick="SkipThisPage('<? echo $site->id;?>', '<? echo $j;?>');"><font color='grey' size=2>[Skip]</font></a>
			</div>
		</center>
        	</td>	
		<td>
			<div id="likeme<? echo $j;?>" style="display:none;" >
			<script type="text/javascript">
			function votekmeit<? echo $j;?>(json){
			if (json.state == "on"){
				setTimeout('GetSubCount2("<? echo $site->id;?>","<? echo $site->user;?>","<? echo $j;?>")',1000);}
				else{setTimeout('GetSubCount3("<? echo $site->id;?>","<? echo $site->user;?>","<? echo $j;?>")',500);}
			};
			</script>
			<g:plusone callback="votekmeit<? echo $j;?>" href="<? echo $site->google; ?>" size="large"></g:plusone>
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
var mywindow;
function VoteThis(siteurll) {
mywindow = window.open('https://plus.google.com/share?url='+siteurll);
}
function OpenLike(mysiteid, siteowner, mysite, cpc, jaa){
	nextbtn = Math.floor(jaa); 
	nextbtnstr = 'likeme' + nextbtn.toString();
	document.getElementById(nextbtnstr).style.display = 'block';
	$("#stat"+jaa).html('<b><font size="3" color="blue"><<<<<<<< </br> Plus It</br>and Share </br><<<<<<<< </font></b>');
	}
function SkipThisPage(mysiteid, jaa){
		$("#stat"+jaa).html('</br></br><img src="img/loader.gif">');
		$.ajax({
        		type: "POST",
        		url: "skipgoogle.php",
        		data: "data="+ mysiteid,        
        		cache: false,
        		success: function(){
        		$("#stat"+jaa).html('</br></br><font size="4" color="blue">Skipped!</font>');
        		}
    		});
    		nextbtn = 1+Math.floor(jaa); 
		nextbtnstr = 'likebtn' + nextbtn.toString();
		document.getElementById(nextbtnstr).style.display = 'block';
		document.getElementById('likeme'+jaa).contentWindow.location = "blank.php";
	}
function GetSubCount(mysiteaccid1, pageuserowner, jaa){
	$("#stat"+jaa).html('</br></br><img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "googleconf.php",
		data: "sitename1="+mysiteaccid1+ "---" + pageuserowner,
		success: function(msg){
			if (msg > 0){
			$("#stat"+jaa).html('</br></br><font size="4" color="green">Plused!</font>');
			document.getElementById('likeme'+jaa).style.display = 'none';
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
			}
			if (msg == 0){
			$("#stat"+jaa).html('</br></br><font size="4" color="red">Not Plused!</font>');
			}
		}
	});
		nextbtn = 1+Math.floor(jaa); 
		nextbtnstr = 'likebtn' + nextbtn.toString();
		document.getElementById(nextbtnstr).style.display = 'block';
	
	}
function GetSubCount2(mysiteaccid1, pageuserowner, jaa){
	$("#stat"+jaa).html('</br></br><img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "googleconf2.php",
		data: "sitename1="+mysiteaccid1+ "---" + pageuserowner,
		success: function(msg){
			if (msg > 0){
			$("#stat"+jaa).html('</br></br><font size="4" color="green">Plused!</font>');
			document.getElementById('likeme'+jaa).style.display = 'none';
			document.getElementById('Mybalancenow').contentWindow.location.reload(true);
			}
			if (msg == 0){
			$("#stat"+jaa).html('</br></br><font size="4" color="red">Not Plused!</font>');
			}
		}
	});
		nextbtn = 1+Math.floor(jaa); 
		nextbtnstr = 'likebtn' + nextbtn.toString();
		document.getElementById(nextbtnstr).style.display = 'block';
	}
function GetSubCount3(mysiteaccid1, pageuserowner, jaa){
	$("#stat"+jaa).html('</br></br><img src="img/loader.gif">');
	$.ajax({
		type: "GET",
		url: "googleconf3.php",
		data: "sitename1="+mysiteaccid1+ "---" + pageuserowner,
		success: function(msg){
			$("#stat"+jaa).html('</br></br><font size="4" color="red">Un Plused!</br>Lost Points :(</font>');
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
<tr><td><img src="img/planet_stop.jpg" border="0" title="Error"></td><td width="20"></td><td> <font color='red' size='4'><? echo $message00;?> </font> </td></tr>
</table>
</center>
<?}?>

	<div class="clearer">&nbsp;</div>

<? include('footer.php');?>