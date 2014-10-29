<?php
include('header.php');
if(!isset($data->login)){echo "<script>document.location.href='index.php'</script>"; exit;}
?>
<body id="tab2"> 
<div>
<ul id="tabnav"> 
	<li class="tab1"><a href="cashout.php">Cashout Money</a></li>
	<li class="tab2"><a href="cashoutmy.php">Cashout History</a></li> 
</ul>
</div>

<h1>Cashout History</h1>
<p>You can see your payments progress, or Cancel any payments not paid yet.</p>
</br>
<p><font color='blue'><b>For PayPal payments :</b></font></p>
<p> When you see 'Now Paying', This means we sent request to our PayPal agent to send your money, and it should be paid within 2 days. </p>
</br>
<p><font color='red'><b>Marked 'Paid' but It Does Not?</b></font></p>
<p>If payment marked 'Paid' here, but It Does Not, then Check your PayPal/OKPay account, 'Approve Payment' there to get paid.</p>
<p>If payment is not paid at all, Feel free to contact us and we will send money once again, or give you Points back to use Another PayPal/OKPay/Payza address.</p>

		<table class="datatable sortable selectable full">				
		<thead>
		<tr class="theader">
			<th width="15">			
			<b>#</b>			
			</th>			
			<th>			
			<b>Payment</b>			
			</th>		
            <th>			
			<b>Method</b>			
			</th>
            <th>			
			<b>Address</b>			
			</th>			
			<th>			
			<b>Status</b>			
			</th>		
			<th width="180">			
			<b>Actions</b>			
			</th>				
		</tr>
        </thead>					
<?
  $site2 = mysql_query("SELECT * FROM `cashout` WHERE `id`='{$data->id}' ORDER BY `pending`");
  for($j=1; $site = mysql_fetch_object($site2); $j++)
{
?>		
			<tbody>
			<tr>
				<td>							
                <?echo$j;?>							
				</td>				
				<td>												
				<b> <font color= "<?if($site->pending == 0){echo "grey";}
				if($site->pending == 1 OR $site->pending == 5){echo "green";}
				if($site->pending == 2){echo "red";}?>" > 
				$<? echo $site->cash;?> </font></b>
				</td>				
				<td>				
				<?if($site->method == 'lr'){echo "LibertyReserve";}
				  if($site->method == 'ap'){echo "Alert Pay";}
				  if($site->method == 'pz'){echo "Payza";}
				  if($site->method == 'pp'){echo "PayPal";}
				  if($site->method == 'ok'){echo "OKPay";}
				  if($site->method == 'pm'){echo "PerfectMoney";}
				  if($site->method == 'mn'){echo "Money Bookers";} ?>
				</td>
				<td>				
				<? echo $site->adr;?>			
				</td>
				<td>
				<font color= "<?if($site->pending == 0){echo "grey";}
				if($site->pending == 1){echo "green";}
				if($site->pending == 2){echo "red";}?>" >
					
				<?if($site->pending== '0'){echo "Waiting";}
				  if($site->pending== '1'){echo "Paid";}
				  if($site->pending== '2'){echo "Cancelled";}
				  if($site->pending== '5'){echo "Now Paying...";} ?>
				 
				 </font>			
				</td>
				<td>				
				<?if($site->pending== '0'){?>
				<input type="submit" name="Cancel" value="Cancel" id="Cancel" class="submit" onclick="ApproveThisTask('<? echo $site->i;?>');" />
				<?}?>
				</td>					
			</tr>
			</tbody><?}?>
			
			<script language=javascript>
			function ApproveThisTask(mytaskid){
			$.post('cashoutcancel.php',{ii: mytaskid} ,  function(msg){
									alert(msg);
									document.getElementById('Mybalancenow').contentWindow.location.reload(true);
									}  );
			};
			</script>
</table>	

<? include('footer.php');?>