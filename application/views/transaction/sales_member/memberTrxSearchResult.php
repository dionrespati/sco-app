<?php
	if($result == null) {
		echo setErrorMessage();
	} else {
		echo "<table width='100%' class='table table-striped table-bordered bootstrap-datatable datatable'>
				  <thead>
					  <tr>
						  <th>No</th>
						  <th>Date</th>
						  <th>Period</th>
						  <th>Order ID</th>
						  <th>Order#</th>
						  <th>Batch#</th>
						  <th>CN#</th>
						  <th>Stockist</th>
						  <th width='10%'>DP</th>
						  <th width='6%'>BV</th>
						  <th width='8%'>Status</th>
					  </tr>
				  </thead>
			  <tbody>";
		$i = 1;
		
		$iApp = 0;
		$iPen = 0;
		$totBVApp = 0;
		$totDPApp = 0;
		$totBVPen = 0;
		$totDPPen = 0;
		$totBVAll = 0;
		$totDPAll = 0;
		
		foreach($result as $data) {
			/* A.trcd, A.orderno, A.batchno, A.invoiceno, A.trtype, 
				A.ttptype, A.etdt, A.batchdt, A.remarks, A.createdt, 
				A.createnm, A.dfno, A.distnm, A.loccd, A.loccdnm, 
				A.sc_co, A.sc_conm, A.sc_dfno, A.sc_dfnonm, A.tdp, 
				A.tbv, A.bnsperiod, A.statusTrx
			 */
			$totBVAll += $data->tbv;
			$totDPAll += $data->tdp;
			
			$etdt = date("d-m-Y", strtotime($data->etdt));
			$bnsperiod = date("M-Y", strtotime($data->bnsperiod));
			$tdp = number_format($data->tdp, 0, ",", ".");
			$tbv = number_format($data->tbv, 0, ",", ".");
			$trcd = $data->trcd;
			if($data->trcd == $data->orderno){
				$orderno = null;
			}else{
				$orderno = $data->orderno;
			}
			
			$statusTrx = $data->statusTrx;
			if($statusTrx == "OP"){ //PENDING
				$totBVPen += $data->tbv;
				$totDPPen += $data->tdp;
				$iPen++;
				$descStat = "Sc Pend.";
			}elseif($statusTrx == "OA"){ //OA APPROVED
				$totBVApp += $data->tbv;
				$totDPApp += $data->tdp;
				$iApp++;
				$descStat = "Sc Appr.";
			}elseif($statusTrx == "MA"){ //MA APPROVED
				$totBVApp += $data->tbv; 
				$totDPApp += $data->tdp;
				$iApp++;
				$descStat = "Man. Appr.";
			}elseif($statusTrx == "OP"){ //OP PENDING
				$totBVPen += $data->tbv;
				$totDPPen += $data->tdp;
				$iPen++;
				$descStat = "OL. Pend.";
			}
			$url = 'member/trx/detail/trcd/'.$trcd;
			$url2 = 'member/trx/detail/orderno/'.$orderno;
			echo "<tr>
				  <td align=right>$i</td>
				  <td align=center>$etdt</td>
				  <td align=center>$bnsperiod</td>";
				  
				  echo "<td align=\"center\"><a onclick=\"javascript:All.ajaxShowDetailonNextForm('$url')\">$trcd</a></td>";
				  echo "<td align=\"center\"><a onclick=\"javascript:All.ajaxShowDetailonNextForm('$url2')\">$orderno</a></td>";
				  
				  echo "<td align=center>$data->batchno</td>
				  <td align=center>$data->invoiceno</td>
				  <td align=center>$data->sc_dfno</td>
				  <td align=right>$tdp</td>
				  <td align=right>$tbv</td>
				  <td align=center>$descStat</td>";
			echo "</tr>";
			//<td align=left>$data->sc_dfno - $data->sc_dfnonm</td>
			$i++;
		}

		$totDPAll = number_format($totDPAll, 0, ",", ".");
		$totBVAll = number_format($totBVAll, 0, ",", ".");
		$totBVApp = number_format($totBVApp, 0, ",", ".");
		$totDPApp = number_format($totDPApp, 0, ",", ".");
		$totBVPen = number_format($totBVPen, 0, ",", ".");
		$totDPPen = number_format($totDPPen, 0, ",", ".");
		$iPen = number_format($iPen, 0, ",", ".");
		$iApp = number_format($iApp, 0, ",", ".");
		$rec = $iPen + $iApp;
		/*
		echo "	  <tr>
					<td align=left colspan=8><strong>Summary</strong></td>
				    <td align=right><strong>$totDPAll</strong></td>
				    <td align=right><strong>$totBVAll</strong></td>
				    <td>&nbsp;</td>
				  </tr>
				</tbody>
			  </table>";
		*/
		echo "<table width='50%' class='table table-striped table-bordered bootstrap-datatable'>
				  <thead>
				  	<tr><th>&nbsp;</th><th>Approved</th><th>Pending</th><th>Summary(All)</th></tr>
				  </thead>
		  		  <tbody>
		  		  	<tr><td>Total Records</td><td align=right>$iApp</td><td align=right>$iPen</td><td align=right>$rec</td></tr>
				  	<tr><td>Total DP</td><td align=right>$totDPApp</td><td align=right>$totDPPen</td><td align=right>$totDPAll</td></tr>
				  	<tr><td>Total BV</td><td align=right>$totBVApp</td><td align=right>$totBVPen</td><td align=right>$totBVAll</td></tr>
		  		  </tbody>
			  </table>";
		$i = 1;
	}
?>

<script type="text/javascript">
$(document).ready(function() 
{
	$(All.get_active_tab() + " .datatable").dataTable( {
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
		"sPaginationType": "bootstrap",
		"oLanguage": {
		},
        "bDestroy": true
	});
    $(All.get_active_tab() + " .datatable").removeAttr('style');
 });

</script>