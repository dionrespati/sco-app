
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

}
?>
<form id="salesStockist" class="formSales">
	<table width="100%" class="table table-striped table-bordered">
		<tr>
			<th colspan="4">DATA PEMBELANJAAN MEMBER</th>
		</tr>
		<tr>
			<td width="15%"> Stockist Code </td>
			<td width="35%">
			<input readonly="readonly" type="text" class="span12 typeahead" id="sc_dfno"  name="sc_dfno" value="<?php echo $sc_dfno; ?>" />
			<input type="hidden" id="sctype" name="sctype" value="<?php echo $sctype; ?>" />
			</td>
			<td width="15%">Trx No</td>
			<td>
			<input  readonly="readonly" type="text" class="span12 typeahead" id="trcd" placeholder="<< Auto Transaction Number >>"  name="trcd" value="<?php echo $trcd; ?>" />
			</td>
		</tr>
		<tr>
			<td> Stockist Name </td>
			<td>
			<input  readonly="readonly" type="text" class="span12 typeahead" id="sc_name"  name="sc_name" value="<?php echo $sc_dfnonm; ?>" />
			</td>
			<td>Trx Date</td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="trxdate"  name="trxdate" value="<?php echo $etdt; ?>" />
			<input readonly="readonly" type="hidden" class="span12 typeahead" id="sc_co"  name="sc_co" value="<?php echo $sc_co; ?>" />
			</td>
		</tr>
		<tr>
			<td> Main Stockist </td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="loccd"  name="loccd" value="<?php echo $loccd; ?>" />
			</td>
			<td>Pricecode</td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="pricecode"  name="pricecode" value="<?php echo $pricecode; ?>" />
			</td>
		</tr>
		<tr>
			<td>Main Stockist Name</td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="loccdnm"  name="loccdnm" value="<?php echo $loccdnm; ?>" />
			</td>
			<td>Bonus Period</td>
			<td>
			<select tabindex="2" id="bnsperiod"  name="bnsperiod" class="span8 typeahead">
				<?php
				$opts = 2;

				////Array of months
				$m = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

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
		<!--<tr>
		<td> Member Code </td>
		<td>
		<input tabindex="1" type="text" class="span12 typeahead" id="dfno"  name="dfno" onchange="All.getFullNameByID(this.value,'api/member/check','#fullnm')" value="<?php echo $dfno; ?>" />
		</td>
		<td>Order No</td>
		<td>
		<input tabindex="3" type="text" class="span12 typeahead" id="orderno"  name="orderno" value="<?php echo $orderno; ?>" onchange="All.checkDoubleInput('db2/get/orderno/from/sc_newtrh/','orderno',this.value)" />
		</td>
		</tr>
		<tr>
		<td> Member Name </td>
		<td>
		<input readonly="readonly" type="text" class="span12 typeahead" id="fullnm"  name="fullnm" value="<?php echo $fullnm; ?>" />
		</td>
		<td>Remarks</td>
		<td>
		<input tabindex="4" type="text" class="span12 typeahead" id="remarks"  name="remarks" value="<?php echo $orderno; ?>"  />
		</td>
		</tr>-->
		<tr>
			<td> Member Code </td>
			<td>
			<input tabindex="1" type="text" class="span12 typeahead" id="dfno"  name="dfno" onchange="All.getFullNameByID(this.value,'api/member/check','#fullnm')" value="<?php echo $dfno; ?>" />
			</td>
			<td>Order No</td>
			<td>
			<input tabindex="3" type="text" class="span12 typeahead" id="orderno"  name="orderno" value="<?php echo $orderno; ?>" onchange="All.checkDoubleInput('db2/get/orderno/from/sc_newtrh/','orderno',this.value)" />
			</td>
		</tr>
		<tr>
			<td> Member Name </td>
			<td>
			<input readonly="readonly" type="text" class="span12 typeahead" id="fullnm"  name="fullnm" value="<?php echo $fullnm; ?>" />
			</td>
			<td>Remarks</td>
			<td>
			<input tabindex="4" type="text" class="span12 typeahead" id="remarks"  name="remarks" value="<?php echo $remarks; ?>"  />
			</td>
		</tr>
		<!--
		<tr>
		<td> Member Code </td>
		<td>
		<input tabindex="1" type="text" class="span12 typeahead" id="dfno"  name="dfno" onchange="All.getFullNameByID(this.value,'api/member/check','#fullnm')" value="<?php echo $dfno; ?>" />
		</td>
		<td>&nbsp;</td>
		<td>
		&nbsp;
		</td>
		</tr>
		<tr>
		<td> Member Name </td>
		<td>
		<input readonly="readonly" type="text" class="span12 typeahead" id="fullnm"  name="fullnm" value="<?php echo $fullnm; ?>" />
		</td>
		<td>&nbsp;</td>
		<td>
		&nbsp;
		</td>
		</tr>-->

	</table>
	