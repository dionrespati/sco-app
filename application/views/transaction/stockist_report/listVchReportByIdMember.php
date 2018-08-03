<?php
if($result == null) {
	echo setErrorMessage("No Result Found..");
} else {	
?>
<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
	<thead>
		<?php
		//if($form['searchby'] == "sc_dfno" ||) {
		?>	
			<tr bgcolor=#f4f4f4>
				<th colspan="10">Daftar Voucher Member<?php echo " ".$result[0]->DistributorCode." - ".$result[0]->fullnm; ?></th>
			</tr>
			<tr bgcolor=#f4f4f4>
				<th width="5%">No</th>
				<th width="13%">No Voucher</th>
				<th width="10%">Tipe</th>
				<th width="10%">Nilai</th>
				<th>Trx No</th>
				<th>Batch No</th>
				<th width="10%">ID Stockist</th>
				<th width="10%">Tgl Klaim</th>
				<th width="10%">Tgl Expire</th>
				
				<!--<th width="10%">Action</th>-->
			</tr>
		</thead>
		<tbody>
	    <?php
		    $i = 1;
		    foreach($result as $dta) {
			echo "<tr id=\"$i\">
				<td align=right>$i</td>
				<td align=\"center\">
				    <input type=hidden id=\"batchno$i\" value=\"$dta->VoucherNo\" />
					<a id=$dta->VoucherNo onclick=\"javascript:All.ajaxShowDetailonNextForm('sales/voucher/no/$dta->VoucherNo')\">$dta->VoucherNo</a>
				</td>
				<td align=\"center\">
				    $dta->vchtype
				</td>
				<td align=\"right\">
				    ".number_format($dta->VoucherAmt,2,",",".")."
				</td>
				
				<td align=\"center\">
				    $dta->trcd
				</td>
				<td align=\"center\">
				    $dta->batchno
				</td>
				<td align=\"center\">
				    $dta->loccd
				</td>
				<td align=\"center\">
				    $dta->tglklaim
				</td><td align=\"center\">
				    $dta->ExpireDate
				</td>";
			echo "</tr>";
			$i++;
		}

   // }
			
	?>	
	</tbody>
</table>

<?php
setDatatable();
}
?>