<?php
	if($result == null) {
		echo setErrorMessage();
	} else {
		echo "<table width='100%' class='table table-striped table-bordered bootstrap-datatable datatable'>
				  <thead>
					  <tr>
						  <th width='3%'>No</th>
						  <th width='15%'>CN/MSN/MM#</th>
						  <th width='15%'>Receipt#</th>
						  <th width='10%'>CN Date</th>
						  <th width='10%'>Rec. Date</th>
			  			  <th>Sockist</th>
					  </tr>
				  </thead>
			  <tbody>";
		$i = 1;
		foreach($result as $data) {
			$etdt = date("d-m-Y", strtotime($data->invoicedt));
			$createdt = date("d-m-Y", strtotime($data->createdt));
			echo "<tr>
				  <td align=right>$i</td>";
			/* .category, a.ordtype, a.invoiceno, a.invoicedt, a.dfno, c.fullnm, b.trcd, b.createdt, b.applyto 
			 */
			 $fullnm = str_replace(",", "", $data->fullnm);
			$param = "$data->invoiceno**$data->trcd**$etdt**$createdt**$data->dfno - $fullnm";
			echo "<td align=center><a id='$param' onclick=\"javascript:All.ajaxShowDetailonNextForm('voucher/detail/$param')\">$data->invoiceno</a></td>
				  <td align=center>$data->trcd</td>
				  <td align=center>$etdt</td>
				  <td align=center>$createdt</td>
				  <td align=left>$data->dfno - $data->fullnm</td>
				  </tr>";
			$i++;
		}
		echo "</tbody>";
		echo "</table>";
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