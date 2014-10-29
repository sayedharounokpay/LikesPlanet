<?php
include('header.php');

$sstat = mysql_fetch_object(mysql_query("SELECT * FROM `sitestat` WHERE `id`='3'"));

$totalmembers1 = mysql_query("SELECT * FROM `users` ");
$totalmembers = mysql_num_rows($totalmembers1);
$totalmembers1 = mysql_query("SELECT * FROM `users` WHERE `banned`='1' OR `ban`!='0'");
$bannedmembers = mysql_num_rows($totalmembers1);
$totalmembers1 = mysql_query("SELECT * FROM `online` ");
$onlinetoday = mysql_num_rows($totalmembers1);

$totalmembers1 = mysql_query("SELECT * FROM `users` WHERE `pr`!='0' ");
$premmembers = mysql_num_rows($totalmembers1);

?>
<body id="tab2"> 
<div>
</div>
<h1>Statistics of LikesASAP.com</h1>
<div class="clearer">&nbsp;</div>

<p><b>All Statistics are update in Realtime.</b></p>

<div class="clearer">&nbsp;</div>

<p><font color='blue'><b>FaceBook System</b> (Likes, Photos, Posts) : </font><font color='darkgreen'><b> <? echo number_format($sstat->likes); ?> </b></font></p>
<p><font color='blue'><b>YouTube System</b> (Likes, Subscribe, ...) : </font><font color='darkgreen'><b> <? echo number_format($sstat->youtube); ?> </b></font></p>
<p><font color='blue'><b>Website Traffic </b> : </font><font color='darkgreen'><b> <? echo number_format($sstat->visit); ?> </b></font></p>
<p><font color='blue'><b>Google Plus</b> : </font><font color='darkgreen'><b> <? echo number_format($sstat->google); ?> </b></font></p>
<p><font color='blue'><b>Twitter Followers</b> : </font><font color='darkgreen'><b> <? echo number_format($sstat->hits); ?> </b></font></p>

<div class="clearer">&nbsp;</div>

<p><font color='blue'><b>Registered Members</b> : </font><font color='darkgreen'><b> <? echo number_format($totalmembers); ?> </b></font></p>
<p><font color='blue'><b>Banned Members</b> : </font><font color='darkred'><b> <? echo number_format($bannedmembers); ?> </b></font></p>
<p><font color='blue'><b>Premium Members</b> : </font><font color='darkgreen'><b> <? echo number_format($premmembers); ?> </b></font></p>
<p><font color='blue'><b>Online</b> : </font><font color='darkgreen'><b> <? echo number_format($onlinetoday); ?> </b></font></p>

<div class="clearer">&nbsp;</div>
<div class="clearer">&nbsp;</div>

<p> <font color="darkgreen"><b> Users Online :</b></b>  (We do Not display Username for Personal reasons) </font></p> 
<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>User ID on LikesASAP</b>			
			</th>		
            <th>			
			<b>Country</b>			
			</th>
	    <th>			
			<b>Login Time</b>			
			</th>				
		</tr>
        </thead>	
<?
  $site2 = mysql_query("SELECT * FROM `login` ORDER BY `id` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
$userp2 = mysql_query("SELECT * FROM `users` WHERE (`login`='{$site->user_id}' OR `email`='{$site->user_id}') ");
$userp = mysql_fetch_object($userp2);

$x11102oo = explode('(', $userp->country);
$x111022oo = explode(')', $x11102oo[1]);
if ($x111022oo[0] == 'DE' ) $x111022oo[0] = 'GM';
if ($x111022oo[0] == 'TR' ) $x111022oo[0] = 'TU';
if ($x111022oo[0] == 'PH' ) $x111022oo[0] = 'RP';
if ($x111022oo[0] == 'DZ' ) $x111022oo[0] = 'AG';
if ($x111022oo[0] == 'BW' ) $x111022oo[0] = 'BC';
if ($x111022oo[0] == 'PT' ) $x111022oo[0] = 'PO';
if ($x111022oo[0] == 'VN' ) $x111022oo[0] = 'VM';
if ($x111022oo[0] == 'RU' ) $x111022oo[0] = 'RS';
if ($x111022oo[0] == 'OM' ) $x111022oo[0] = 'MU';
if ($x111022oo[0] == 'GB' ) $x111022oo[0] = 'UK';
if ($x111022oo[0] == 'GE' ) $x111022oo[0] = 'GG';
if ($x111022oo[0] == 'LB' ) $x111022oo[0] = 'LE';
if ($x111022oo[0] == 'AZ' ) $x111022oo[0] = 'AJ';
if ($x111022oo[0] == 'LV' ) $x111022oo[0] = 'LG';
if ($x111022oo[0] == 'LK' ) $x111022oo[0] = 'CE';
if ($x111022oo[0] == 'UA' ) $x111022oo[0] = 'UP';
if ($x111022oo[0] == 'SD' ) $x111022oo[0] = 'SU';
if ($x111022oo[0] == 'BD' ) $x111022oo[0] = 'BG';

?>

<tbody>
			<tr>
				<td>							
                		<?echo$j;?>							
				</td>				
				<td>												
				<b><font color='blue'><? echo $userp->id;?></font></b>
				</td>	
				<td>	
				<img src="https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/<? echo Strtolower($x111022oo[0]); ?>-lgflag.gif" border="0" title=<? echo $userp->country; ?>" height="16" width="24" >											
				<? echo $userp->country;?>
				</td>
				<td>												
				<? echo $userp->online;?>
				</td>	
			</tr>
</tbody><?}?>
</table>

	
<? include('footer.php');?>