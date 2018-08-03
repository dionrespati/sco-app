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
				<th colspan="10">LAPORAN TRANSAKSI YANG SUDAH DI GENERATE ( <?php echo $form['sc_dfno']; ?> )</th>
			</tr>
			<tr bgcolor=#f4f4f4>
				<th width="5%">No</th>
				<th width="13%">No.SSR/MSR</th>
				<th width="10%">Tgl SSR</th>
				<th width="10%">Stk</th>
				<th>Nama Stk</th>
				<th width="10%">C/O Stk</th>
				<!--<th width="10%">SC</th>-->
				<th width="10%">Total DP</th>
				<th width="6%">BV</th>
				<th width="10%">Status</th>
				<!--<th width="10%">Action</th>-->
			</tr>
		</thead>
		<tbody>
	    <?php
		    $i = 1;
		    foreach($result as $dta) {
		    if($dta->flag_batch == "1") {
					$stt = "PENDING";
				    //$wrn = "";
				} else if($dta->flag_batch == "2") {
					$stt = "APPROVED";
					//$wrn = "bgcolor=lightgreen";
				}		
				
			echo "<tr id=\"$i\">
				<td align=right>$i</td>
				<td align=\"center\">
				    <input type=hidden id=\"batchno$i\" value=\"$dta->batchno\" />
					<a id=$dta->batchno onclick=\"javascript:All.ajaxShowDetailonNextForm('sales/generated/ssr/$dta->batchno')\">$dta->batchno</a>
				</td>
				<td align=\"center\">
				    $dta->batchdt
				</td>
				<td align=\"center\">
				    $dta->sc_dfno
				</td>
				
				<td>
				    $dta->fullnm
				</td>
				<td align=\"center\">
				    $dta->sc_co
				</td>";
				/*<td align=\"center\">
				    $dta->loccd
				</td>*/
				echo "<td align=\"right\">
				   ".number_format($dta->TOTAL_DP, 0, ",", ".")."
				</td>
				<td align=\"right\">
				   ".number_format($dta->TOTAL_BV, 0, ",", ".")."
				</td>";
				echo "<td align=\"center\">
						    $stt
						</td>";
				/*		
				if($dta->flag_batch == "0") {
					echo "<td align=\"center\">
					   <a class='btn btn-mini btn-primary' id=$dta->batchno onclick=\"javascript:All.ajaxShowDetailonNextForm('sales/stk/update/trcd/$dta->batchno')\">UPDATE</a>
					</td>";
				}	else {
				   echo "<td align=\"center\">
				     &nbsp;
				   </td>";
				}*/
				
				
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