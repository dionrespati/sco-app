<?php
if($result == null) {
	echo setErrorMessage("No Result Found..");
} else {	
?>
<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
	<thead>
		<tr bgcolor=#f4f4f4>
			<th colspan=5>List Transaction</th>
		</tr>
		<tr bgcolor=#f4f4f4>
			<th width=5%>No</th>
			<th width=15%>Trx No</th>
			<th width=15%>Order No</th>
			<th width=25%>Id Member</th>
			<th>Member Name</th>
		</tr>
	</thead>
	<tbody>
    <?php
	    $i = 1;
	    foreach($result as $dta) {
		echo "<tr id=\"$i\">
			<td align=right>$i</td>
			<td align=\"center\">
			    <input type=hidden id=\"trcd$i\" value=\"$dta->trcd\" />
				<a id=$dta->trcd onclick=\"javascript:All.ajaxShowDetailonNextForm('stk/barcode/trx/id/$dta->trcd')\">$dta->trcd</a>
			</td>
			<td align=\"center\">
			    <input type=hidden id=\"orderno$i\" value=\"$dta->orderno\" />
				$dta->orderno
			</td>
			<td align=\"center\">
			    <input type=hidden id=\"dfno$i\" value=\"$dta->dfno\" />
				$dta->dfno
			</td>
			<td>
			    <input type=hidden id=\"fullnm$i\" value=\"$dta->fullnm\" />
				$dta->fullnm
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