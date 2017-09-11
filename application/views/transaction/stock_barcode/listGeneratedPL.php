<?php
if($result == null) {
	echo setErrorMessage("No Result Found..");
} else {	
?>
<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
	<thead>
		<tr bgcolor=#f4f4f4>
			<th colspan=5>List Generated Packing List</th>
		</tr>
		<tr bgcolor=#f4f4f4>
			<th width=5%>No</th>
			<th width=15%>Packing List No</th>
			<th>DO No</th>
			<th width=25%>WH Destination</th>
			
		</tr>
	</thead>
	<tbody>
    <?php
	    $i = 1;
	    foreach($result as $dta) {
		echo "<tr id=\"$i\">
			<td align=right>$i</td>
			<td align=\"center\">
			    <input type=hidden id=\"trcd$i\" value=\"$dta->trcdGroup\" />
				<a id=$dta->trcd onclick=\"javascript:All.ajaxShowDetailonNextForm('stk/barcode/trx/id/$dta->trcdGroup')\">$dta->trcdGroup</a>
			</td>
			<td align=\"center\">
			    <input type=hidden id=\"orderno$i\" value=\"$dta->trcd\" />
				$dta->trcd
			</td>
			<td align=\"center\">
			    <input type=hidden id=\"dfno$i\" value=\"$dta->dest_info\" />
				$dta->dest_info
			</td>
			
		</tr>";
		$i++;
		}
	?>	
	</tbody>
</table>

<?php
setDatatable();
}
?>