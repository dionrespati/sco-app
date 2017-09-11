<?php
$shipinfo = $result['shipinfo'];
$listPrd = $result['listPrd'];
?>
<form id=proceedBarcode>
	<table width=100% class="table table-bordered table-striped">
		<tr>
			<th colspan=7>Generate Packing List</th>
		</tr>
		<tr>
			<td width=25% colspan="2">Packing List No</td>
			<td colspan="5">
			 <input type="hidden" id="trcdGroup" name="trcdGroup" value="<?php echo $shipinfo[0]->trcdGroup; ?>" />
			 <input type="hidden" id="trcd" name="trcd" value="<?php echo $shipinfo[0]->trcdGroup; ?>" />
			 <?php echo $shipinfo[0]->trcdGroup; ?>
			</td>
		</tr>
		<tr>
			<td width=25% colspan="2">Send To</td>
			<td colspan="5">
			 <input type="hidden" id="loccdT" name="loccdTo" value="<?php echo $shipinfo[0]->loccdTo; ?>" />
			 <?php echo $shipinfo[0]->loccdTo; ?>
			</td>
		</tr>
		<tr>
			<td width=25% colspan="2">Info</td>
			<td colspan="5">
			 <input type="hidden" id="info" name="info" value="<?php echo $shipinfo[0]->info; ?>" />
			 <?php echo $shipinfo[0]->info; ?>
			</td>
		</tr>
	<!--</table>
	<br />
	<table width=100% class="table table-bordered table-striped">-->
		<tr>
			<th colspan=7>Detail Product</th>
		</tr>
		<tr>
			<th width="7%">No</th>
			<th width="15%">ID</th>
			<th>Product Name</th>
			<th width="10%">Qty</th>
			<th width="10%">Qty Barcode</th>
			<th width="10%">Qty Remain</th>
			<th width="10%">Act</th>
		</tr>
		
		<?php
		$i=1;
		foreach($listPrd as $dta) {
			echo "<tr>
			       <td align=right>$i</td>
				   <td align=center>
					  <input type=hidden id=\"prdcd$i\" name=prdcd[] value=\"$dta->prdcd\" />
					  <a id=\"$i\" onclick=\"javascript:Stkbarcode.getListProductToBarcode('$i')\")>$dta->prdcd</a>
				   </td>
				   <td>
					  <input type=hidden id=\"prdnm$i\" name=prdnm[] value=\"$dta->prdnm\" />
					  $dta->prdnm
				   </td>
				   <td align=right>
					  <input type=hidden id=\"qty$i\" name=qty[] value=\"$dta->qty\" />
					  $dta->qty
				   </td>
				   <td align=right>
					  <input type=hidden id=\"BC$i\" name=BC[] value=\"$dta->BC\" />
						$dta->BC
				   </td>
				   <td align=right>
					  <input type=hidden id=\"SLH$i\" name=BC[] value=\"$dta->SLH\" />
						$dta->SLH
				   </td>";
				if($dta->SLH == 0) {	
					echo "<td>
					  		<a class='btn btn-mini btn-success' id=\"$i\" onclick=javascript:Stkbarcode.getListProductBarcode('$i')>View Barcode</a>
					     </td>";
				} else if($dta->BC > 0 && $dta->BC != $dta->qty) {
					echo "<td>
					  		<a class='btn btn-mini btn-success' id=\"$i\" onclick=javascript:Stkbarcode.getListProductBarcode('$i')>View Barcode</a>
					     </td>";
				} else {
					echo "<td>
					  		&nbsp;
					     </td>";
				}		   
			echo "</tr>";	  
			$i++; 
		}	
		?>
		
	</table>
	<?php backToMainForm(); ?>
</form>
