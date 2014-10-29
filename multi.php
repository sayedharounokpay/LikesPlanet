<?php
include('header.php');

?>

<br/>
<h1> Multi Accounts ? </h1>
<div> <p> </p></div>

<div class="msg_success">Multi Account is Automatic Protection to keep LikesASAP network Clean.</div>
<br/><br/>

<div> Accounts linked with Your IP Address : </div>

<br/>

<br/>
<h1> Your Referrals </h1>



		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>User Name 1</b>			
			</th>
			<th>			
			<b>User Name 2</b>			
			</th>
			<th>			
			<b>Similar IP Detected</b>			
			</th>			
		</tr>
        	</thead>

<?
  $site2 = mysql_query("SELECT * FROM `similarip` WHERE (`user1`='{$data->id}' OR `user2`='{$data->id}') ");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{

$userrr1 = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user1}' )"));
$userrr2 = mysql_fetch_object(mysql_query("SELECT * FROM `users` WHERE (`id`='{$site->user2}' )"));

?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<? echo $userrr1->login;?>		
				</td>
				<td>												
				<? echo $userrr2->login;?>		
				</td>			
				<td>												
				<? echo $site->IP;?>		
				</td>		
			</tr>
			</tbody><?}?>
</table>	

<? include('footer.php');?>