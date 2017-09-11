<?php
	foreach ($result["header"] as $data) {
		$trcd = $data->trcd;
		$orderno = $data->orderno;
		$batchno = $data->batchno;
		$invoiceno = $data->invoiceno;
		$trtype = $data->trtype;
		$ttptype = $data->ttptype;
		$etdt = $data->etdt;
		$etdt = date("d-m-Y", strtotime($etdt));
		$batchdt = $data->batchdt;
		$remarks = $data->remarks;
		$updatedt = $data->updatedt;
		$updatedt = date("d-m-Y", strtotime($updatedt));
		$updatenm = $data->updatenm;
		$createdt = $data->createdt;
		$createnm = $data->createnm;
		$dfno = $data->dfno;
		$distnm = $data->distnm;
		$loccd = $data->loccd;
		$loccdnm = $data->loccdnm;
		$sc_co = $data->sc_co;
		$sc_conm = $data->sc_conm;
		$sc_dfno = $data->sc_dfno;
		$sc_dfnonm = $data->sc_dfnonm;
		$tdp = $data->tdp;
		$tbv = $data->tbv;
		$tdp = number_format($tdp, 0, ",", ".");
		$tbv = number_format($tbv, 0, ",", ".");
		$bnsperiod = $data->bnsperiod;
		$bnsperiod = date("M-Y", strtotime($bnsperiod));
		$statusTrx = $data->statusTrx;

		if($statusTrx == "OP"){ //PENDING
			$descStat = "Stockist Pending";
		}elseif($statusTrx == "OA"){ //OA APPROVED
			$descStat = "Stockist Approved";
		}elseif($statusTrx == "MA"){ //MA APPROVED
			$descStat = "Manual Approved";
		}elseif($statusTrx == "OP"){ //OP PENDING
			$descStat = "Online Pending";
		}
			

	}

	echo "<form id=\"formDetailTrxByID\">";
	echo "<table class='table table-striped table-bordered' width='100%'>
	       <thead>
			<tr><th colspan=4>SUMMARY TRANSACTION</th></tr></thead>";
	//echo "<table class='table table-striped table-bordered' width='100%'>";
	echo "<tbody>
			<tr><td width=12% align='right'><strong>Transaction No&nbsp;&nbsp;</strong></td>
				<td width=25%><strong>$trcd</strong></td>
				<td width=8% align='right'>Order No&nbsp;&nbsp;</td>
				<td width=25%>$orderno</td>
			</tr>
			<tr><td width=12% align='right'>Distributor&nbsp;&nbsp;</td>
				<td width=25%>$dfno - $distnm</td>
				<td width=8% align='right'>Period&nbsp;&nbsp;</td>
				<td width=25%>$bnsperiod</td>
			</tr>
			<tr><td width=12% align='right'>Stockist&nbsp;&nbsp;</td>
				<td width=25%>$sc_dfno - $sc_dfnonm</td>
				<td width=8% align='right'>Batch No&nbsp;&nbsp;</td>
				<td width=25%>$batchno</td>
			</tr>
			<tr><td width=12% align='right'>C/O Stockist&nbsp;&nbsp;</td>
				<td width=25%>$sc_co - $sc_conm</td>
				<td width=8% align='right'>CN No&nbsp;&nbsp;</td>
				<td width=25%>$invoiceno</td>
			</tr>
			<tr><td width=12% align='right'>Main Stockist&nbsp;&nbsp;</td>
				<td width=25%>$loccd - $loccdnm </td>
				<td width=8% align='right'>Total DP&nbsp;&nbsp;</td>
				<td width=25%>$tdp</td>
			</tr>
			<tr><td width=12% align='right'>Created&nbsp;&nbsp;</td>
				<td width=25%>$createnm @ $etdt</td>
				<td width=8% align='right'>Total BV&nbsp;&nbsp;</td>
				<td width=25%>$tbv</td>
			</tr>
			<tr><td width=12% align='right'>Updated&nbsp;&nbsp;</td>
				<td width=25%>$updatenm @ $updatedt</td>
				<td width=8% align='right'>Remarks&nbsp;&nbsp;</td>
				<td width=25%>$remarks</td>
			</tr>
			<tr>
				<td><input value=\"<< Back\" type=\"button\" class=\"span13 btn btn-mini btn-warning\" onclick=\"All.back_to_form(' .nextForm1',' .mainForm')\"/></td>
				<td>&nbsp;</td>
				<td width=8% align='right'>Status&nbsp;&nbsp;</td>
				<td>$descStat</td>
			</tr>
		  </tbody>
	</table>";
	?>
	
	<?php
	echo "<table class='table table-striped table-bordered' width='100%'>
		  	<thead>
		  		<tr><th colspan=8>DETAIL TRANSACTION</th></tr>
		  		<tr><th width=5%>No</th>
		  			<th width=15%>Code</th>
		  			<th>Name</th>
		  			<th width=5%>Qty</th>
		  			<th width=10%>DP</th>
		  			<th width=8%>BV</th>
		  			<th width=13%>Tot DP</th>
		  			<th width=10%>Tot BV</th>
		  		</tr>
		  	</thead>
		  <tbody>";
		  
		$i = 1;
		$tdp = 0;
		$tbv = 0;
		$tqty = 0;
		$tot_dp = 0;
		$tot_bv = 0;
		$tot_qty = 0;
		foreach($result["detail"] as $data) {
			$trcd = $data->trcd;
			$prdcd = $data->prdcd;
			$prdnm = $data->prdnm;
			$qtyord = $data->qtyord;
			$bv = $data->bv;
			$dp = $data->dp;
			$TOTBV = $data->TOTBV;
			$TOTDP = $data->TOTDP;
			
			$qtyord = number_format($qtyord, 0, "", ".");	
			$tdpnom = number_format($dp, 0, ",", ".");	
			$tbvnom = number_format($bv, 0, ",", ".");	
			$TOTDP = number_format($TOTDP, 0, ",", ".");	
			$TOTBV = number_format($TOTBV, 0, ",", ".");	
			
			echo "<tr>
					<td align=right>$i</td>
					<td align=center>$prdcd</td>
					<td align=left>$prdnm</td>
					<td align=right>$qtyord</td>
					<td align=right>$tdpnom</td>
					<td align=right>$tbvnom</td>
					<td align=right>$TOTDP</td>
					<td align=right>$TOTBV</td>
				 </tr>";
			$tqty += $data->qtyord;
			$tdp += $data->TOTDP;
			$tbv += $data->TOTBV;
			$i++;
		}	
		
	$tdp = number_format($tdp, 0, ",", ".");	
	$tbv = number_format($tbv, 0, ",", ".");	
	echo "<tr>
			<td colspan='3' align='right'><strong>Grand Total</strong></td>
			<td align=right><strong>$tqty</strong></td>
			<td colspan='2'>&nbsp;</td>
			<td align=right><strong>$tdp</strong></td>
			<td align=right><strong>$tbv</strong></td>
		 </tr>";
				 
	echo "</tbody></table><br />
		  </form>";
		  
    
?>

