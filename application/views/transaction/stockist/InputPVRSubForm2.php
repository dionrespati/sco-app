
<?php
//print_r($header);
if ($ins == "2") {
	$sc_dfno = $header[0] -> sc_dfno;
	$sc_dfnonm = $header[0] -> sc_dfnonm;
	$sc_co = $header[0] -> sc_co;
	$sc_conm = $header[0] -> sc_conm;
	$loccd = $header[0] -> loccd;
	$loccdnm = $header[0] -> loccdnm;
	$trcd = $header[0] -> trcd;
	$etdt = $header[0] -> tglinput;
	$dfno = $header[0] -> dfno;
	$fullnm = $header[0] -> distnm;
	$orderno = $header[0] -> orderno;
	$remarks = $header[0] -> remarks;
	$readonly = "readonly=readonly";

} else {
	$sc_dfno = $stockist;
	$sc_dfnonm = $stockistnm;
	$sc_co = $stockist;
	$sc_conm = $stockistnm;
	$loccd = $stockist;
	$loccdnm = $stockistnm;
	$trcd = "";
	$etdt = date("Y-m-d");
	$dfno = "";
	$fullnm = "";
	$orderno = "";
	$remarks = "";
	$readonly = "";
    //$sctype = $sctype;
	//$co_sctype = $co_sctype;
}
?>
<form id="salesSubStockist" class="formSales">
	<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
		<tr>
			<th colspan="4">DATA PEMBELANJAAN MEMBER</th>
		</tr>
		<tr>
			<td width="13%">&nbsp;Stockist</td>
			<td width="45%">
			<input tabindex="1" type="text" class=" typeahead" id="sc_dfno"  name="sc_dfno" value="<?php echo $sc_dfno; ?>" onchange="Stockist.getStkScType(this)" />
			<input readonly="readonly" type="text" style="width: 330px;" class="typeahead" id="sc_name"  name="sc_name" value="<?php echo $sc_dfnonm; ?>" />
			<input type="hidden" id="sctype" name="sctype" value="<?php echo $sctype; ?>" />
			</td>
			<td width="13%">&nbsp;No Trx</td>
			<td>
			<input  readonly="readonly" type="text" class="span12 typeahead" id="trcd" placeholder="<< Auto Transaction Number >>"  name="trcd" value="<?php echo $trcd; ?>" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;C/O Stockist </td>
			<td>
			<input tabindex="2" type="text" class="typeahead" id="sc_co"  name="sc_co" value="<?php echo $sc_co; ?>"  onchange="Stockist.getStkScType(this)" />
			<input readonly="readonly" type="text"  style="width: 330px;" class="typeahead" id="sc_co_name"  name="sc_co_name" value="<?php echo $sc_conm; ?>" />
			<input type="hidden" id="co_sctype" name="co_sctype" value="<?php echo $co_sctype; ?>" />
			</td> 
			
			<td>&nbsp;Tgl Trx</td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="trxdate"  name="trxdate" value="<?php echo $etdt; ?>" />
			</td>
		</tr>
		<tr>
			<td> &nbsp;Main Stockist </td>
			<td>
			<input readonly="readonly" type="text" class="typeahead" id="loccd"  name="loccd" value="<?php echo $loccd; ?>" />
			<input readonly="readonly" type="text" style="width: 330px;" class="typeahead" typeahead" id="loccdnm"  name="loccdnm" value="<?php echo $loccdnm; ?>" />
			</td>
			<td>&nbsp;Pricecode</td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="pricecode"  name="pricecode" value="<?php echo $pricecode; ?>" />
			</td>
		</tr>
		<tr>
			
			<td> &nbsp;ID Member</td>
			<td>
			<input tabindex="3" type="text"  class="span12 typeahead" id="dfno"  name="dfno" onchange="All.getFullNameByID(this.value,'api/member/check','#fullnm')" value="<?php echo $dfno; ?>" />
			</td>
			
			<td>&nbsp;Periode Bonus</td>
			<td>
			<select tabindex="4" id="bnsperiod"  name="bnsperiod" class="span8 typeahead">
				<?php
				$opts = 2;

				////Array of months
				$m = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

				////Get starting year and month
				$sm = date('n', strtotime("-1 Months"));
				$sy = date('Y', strtotime("-1 Months"));
				foreach ($currentperiod as $dt) {
					$lastmonth = date('n', strtotime($dt -> lastperiod));
					$lastyear = date('Y', strtotime($dt -> lastperiod));
					$nextmonth = date('n', strtotime($dt -> nextperiod));
					$nextyear = date('Y', strtotime($dt -> nextperiod));
					for ($i = 0; $i < $opts; $i++) {
						$test = $sm - 1;
						////Check for current month and year so we can select it
						if ($lastmonth == $sm) {
							echo "<option value='" . $lastmonth . "/" . $lastyear . "' selected='selected'>" . $m[$lastmonth - 1] . " " . $lastyear . "</option>\n";
						} else {
							echo "<option value='" . $nextmonth . "/" . $nextyear . "' >" . $m[$nextmonth - 1] . " " . $nextyear . "</option>\n";
						}
						//// Fix counts when we span years
						if ($sm == 12) {
							$sm = 1;
							$sy++;
						} else {
							$sm++;
						}
					}
				}
				?>
			</select></td>
		</tr>
		<tr>
			<td>&nbsp;Nama Member </td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="fullnm"  name="fullnm" value="<?php echo $fullnm; ?>" />
			</td>
			<td>&nbsp;No TTP/Order No</td>
			<td>
			<input tabindex="5" type="text" class="span12 typeahead" id="orderno"  name="orderno" value="<?php echo $orderno; ?>" onchange="All.checkDoubleInput('db2/get/orderno/from/sc_newtrh/','orderno',this.value)" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;Remarks</td>
			<td>
			<input tabindex="6" type="text" class="span12 typeahead" id="remarks"  name="remarks" value="<?php echo $remarks; ?>"  />
			</td>
			<td>&nbsp;</td>
			<td>
			&nbsp;
			</td>
			
		</tr>
		

	</table>
	