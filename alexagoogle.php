<?php
include('header.php');
foreach($_POST as $key => $value) {
	$protectie[$key] = filter($value);
}
if(!isset($data->login)){echo "<script>document.location.href='login.php'</script>"; exit;}

?>
<body id="tab2"> 

<h1>Improve Alexa/GooglePR of your website/blog</h1>
<p>You can improve Alexa and Google Page Rank of your website/blog by using this system.</p>
<p>This system gives CHEAP TRAFFIC + Backlink to boost up your website.</p>
<p> Traffic will be sent to your website in cheapest way, to boost up Alexa rank of your site.</p>
<p> Credits: You can use LikesPlanet POINTS (1 Point = 10 Traffic) or MANA (1 Mana = 1 Traffic) .</p>

</br>
<center>
<p> <b>You can get UNLIMITED MANA (kind of points) to Get UNLIMITED Website Traffic!</b> </p>
<p> <a href="fast_surf.php" target="_blank"> <font color='blue' size='6'> Start Surfing Now to GET MANA for FREE! </font> </a> </p>
<p> <font color='green' size='4'> Your Balance: <b><? echo number_format($data->mana,2);?></b> Mana. (= <? echo number_format($data->mana-0.6,0);?> Traffic Credits) </font> </p>
</center>

</br>
<p>  - 10 LikesPlanet Points = 100 Real Visits.</p>
<p>  - 10 LikesPlanet Points = Backlink for 1 Hour with ~800 Unique Visits! (We recommend you pay 20,000 Points for 3 Months)</p>
<p>  - 1 Mana = 1 Visit.</p>
</br>
<p><a href="buy.php">Buy points</a> cheaply, for $50 you will get +1,000,000 (Million) UNIQUE Traffic, and a Backlink (<a href="alexagoogle_backlinks.php" target="_black">from LikesPlanet.com</a>) for 5 months with ~4,000,000 (4 Million) Unique Views.</p>
<p>It is the Cheapest way to boost up your site! Right?</p>
</br>


</br>
<center>
<a href="alexagoogle_add.php" title="Add Your website Now"> <font color='green' size='4'><b> [+] Add a New Website </b></font> </a>
</center>
</br>

<table class="datatable sortable selectable full" style="border: 5px solid #ccc; border-radius: 7px;">				
		<thead>
		<tr class="theader">
			<th width="100">			
			<b>Title</b>			
			</th>				
			<th>			
			<b>Traffic Credits</b>			
			</th>
			<th>			
			Total Views/Traffic
			</th>	
			<th>			
			<b>Backlink Age</b>			
			</th>	
			<th>
			Backlink Views
			</th>					
		</tr>
        </thead>					
<?
  
  $site2 = mysql_query("SELECT * FROM `alexagoogle` WHERE `user`='{$data->id}' ORDER BY `id` DESC");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$imageurlurl = $site->pageid;


?>		
			<tbody>
			<tr>
				<td>	
				<a href="<? echo $site->url;?>" target="_blank" title="<? echo $site->title;?>" style="<?if($site->active == 1){echo "color:red;";}else{echo "color:green;";}?>" > <? echo $site->title;?> </a>
				</td>	
				<td>				
				<font color="<?if($site->points < 10){echo 'red';}else{echo 'blue';}?>" size='4'>
				<center><? echo $site->points;?>		
				</font>		
				</br></br>
				<a href="alexagoogle_addpoints.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Traffic Points"></a>
				</center>	
				</td>
				<td>		
				<center><? echo $site->traffic_total;?></center>
				</td>
				<td>	
				<center>			
				<font color="<?if($site->life < 2){echo 'red';}else{echo 'blue';}?>">
				<? echo $site->life;?> Hours.	
				</font>		
				</br></br>
				<a href="alexagoogle_addlife.php?id=<? echo $site->id;?>"><img src="img/add2.png" border="0" title="Add Backlink Hours"></a>
				</center>
				</td>
				<td>		
				<font color='green'><? echo $site->views;?></font>
				</td>
			</tr>
			</tbody><?}?>
</table>

<? include('footer.php');?>