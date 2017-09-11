<table width="100%" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8">DETAIL PRODUK</th>
			</tr>
			<tr>
				<th width="12%">Kode Produk</th>
				<th>Nama produk</th>
				<th width="5%">Qty</th>
				<th width="5%">BV</th>
				<th width="12%">Harga</th>
				<th width="10%">Sub Total BV</th>
				<th width="14%">Sub Total Harga</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody id="addPrd">
			<?php
			$submit_value = "";
			$tot_dp = 0;
			$tot_bv = 0;
			$i = 1;
			$jum_rec = 1;
			$tabindex = $start_tabidx;
			if ($ins == "2") {
                $submit_value = "Update Transaksi";
				foreach ($detail as $prd) {
					$qty = number_format($prd -> qtyord, 0, ",", ".");
					$bv_display = number_format($prd -> bv, 0, ",", ".");
					$dp_display = number_format($prd -> dp, 0, ",", ".");
					$sub_tot_dp = number_format($prd -> TOTDP, 0, ",", ".");
					$sub_tot_bv = number_format($prd -> TOTBV, 0, ",", ".");
					echo "<tr>";
					echo "<td><input onchange=\"Stockist.getProductPrice($i)\" tabindex=\"$tabindex\" type=\"text\" class=\"span12 typeahead\" id=\"prdcd$i\"  name=\"prdcd[]\" value=\"$prd->prdcd\"/></td>";
					echo "<td><input readonly=readonly type=\"text\" class=\"span12 typeahead\" id=\"prdnm$i\"  name=\"prdnm[]\" value=\"$prd->prdnm\"/></td>";
					$tabindex++;
					echo "<td><input onkeyup=\"Stockist.calculateProduct($i)\" tabindex=\"$tabindex\" style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead jumlah\" id=\"jum$i\"  name=\"jum[]\" value=\"$qty\"/></td>";
					echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead jumlah\" id=\"poin$i\"  name=\"poin[]\" value=\"$bv_display\"/></td>";
					echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead jumlah\" id=\"harga$i\"  name=\"harga[]\" value=\"$dp_display\"/></td>";
					echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead\" id=\"sub_tot_bv$i\"  name=\"sub_tot_bv[]\" value=\"$sub_tot_bv\"/></td>";
					echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead\" id=\"sub_tot_dp$i\"  name=\"sub_tot_dp[]\" value=\"$sub_tot_dp\"/></td>";
					echo "<td align=center><a onclick=javascript:Stockist.delPayment(this) class='btn btn-mini btn-danger'><i class='icon-trash icon-white'></i></a></td>";
					echo "</tr>";
					$tabindex++;
					$jum_rec = $i;
					$i++;
					$tot_dp += $qty * $prd -> dp;
					$tot_bv += $qty * $prd -> bv;
				}
			} else {
				$submit_value = "Simpan Transaksi";
				echo "<tr>";
				echo "<td><input onchange=\"Stockist.getProductPrice($i)\" tabindex=\"$tabindex\" type=\"text\" class=\"span12 typeahead\" id=\"prdcd$i\"  name=\"prdcd[]\" value=\"\"/></td>";
				echo "<td><input readonly=readonly type=\"text\" class=\"span12 typeahead\" id=\"prdnm$i\"  name=\"prdnm[]\" value=\"\"/></td>";
				$qty_index = $tabindex + 1;
				echo "<td><input onkeyup=\"Stockist.calculateProduct($i)\" tabindex=\"$qty_index\" style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead jumlah\" id=\"jum$i\"  name=\"jum[]\" value=\"\"/></td>";
				echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead jumlah\" id=\"poin$i\"  name=\"poin[]\" value=\"\"/></td>";
				echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead jumlah\" id=\"harga$i\"  name=\"harga[]\" value=\"\"/></td>";
				echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead\" id=\"sub_tot_bv$i\"  name=\"sub_tot_bv[]\" value=\"\"/></td>";
				echo "<td><input readonly=readonly style=\"text-align:right;\" type=\"text\" class=\"span12 typeahead\" id=\"sub_tot_dp$i\"  name=\"sub_tot_dp[]\" value=\"\"/></td>";
				echo "<td align=center><a onclick=javascript:Stockist.delPayment(this) class='btn btn-mini btn-danger'><i class='icon-trash icon-white'></i></a></td>";
				echo "</tr>";

			}
			?>
		</tbody>
		<tbody id="subTotPrd">
			<tr>
				<td>
				<input type="button" tabindex="<?php echo $tabindex + 2; ?>" id="addRow" class="span 20 btn btn-mini btn-warning" value="Tambah Produk"  onclick="Stockist.addNewRecordPrd()" />
				</td>
				<td colspan="4" align="center"><b>T O T A L</b></td>
				<td>
				<input type="text" readonly="readonly" style="text-align:right;" class="span12 typeahead" id="total_all_bv"  name="total_all_bv" value="<?php echo number_format($tot_bv, 0, ",", "."); ?>" />
				</td>
				<td>
				<input type="text" readonly="readonly" style="text-align:right;" class="span12 typeahead" id="total_all_dp"  name="total_all_dp" value="<?php echo number_format($tot_dp, 0, ",", "."); ?>" />
				</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
	<table width="100%" border="0">
		<tr>
			<td width="40%" valign="top">
			<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
				<tr>
					<th colspan="3">PILIH PEMBAYARAN</th>
				</tr>
				<tr>
					<th width="25%">Tipe Bayar</th>
					<th colspan="2">Nominal/Kode Voucher</th>
				</tr>
				</thead>
				<tbody id="infoPay">
					<tr>
						<td>
						<select tabindex="25" id="paytype" name="paytype" style="text-align:left; width:140px;">
							<?php
							foreach ($listPay as $pay) {
								echo "<option value=\"$pay->id\">$pay->description</option>";
							}
							?>
						</select></td>
						<td>
						<input tabindex="26" type="text" id="payValue" class="span20" />
						
						</td>
						<td width="25%">
							<input tabindex="27" type="button" id="payBtn" class="span20 btn btn-success" value="Tambah" onclick="Stockist.addPayment()" />
						</td>
					</tr>
					<tr>
						<td>
							<input tabindex="28" value="<< Kembali" type="button" class="btn btn-warning span20" onclick="All.back_to_form(' .nextForm1',' .mainForm')"/>
						</td>
						<td colspan="2">
							<input tabindex="29" value="<?php echo $submit_value; ?>" type="button" class="btn btn-primary span20" onclick="Stockist.saveTrxStockist('<?php echo $form_action; ?>',this.form.id)"/>
		                </td>
					</tr>
				</tbody>
			</table></td>
			<td valign="top">
			<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th colspan="4">DETAIL PEMBAYARAN</th>
					</tr>
				</thead>
				<thead>
					<tr>
						<th width="25%">Tipe Bayar</th>
						<th >No Voucher</th>
						<th width="15%">Jumlah</th>
						<th width="5%">&nbsp;</th>	
					</tr>
				</thead>
				<tbody id="payChoose">
					<?php
					  $totPay = 0;
					  if($ins == "2") {
							$readonly = "";
							$btn = "";
							
							 foreach($payment as $pay) {
							 	$payamt = number_format($pay->payamt, 0, ",", ".");
							 	if($pay->paytype != "01") {
							 		$readonly = "readonly=readonly";
									$de = "<td align=center>$pay->docno&nbsp;<input class='checkReff' type=hidden name=payReff[] value=\"$pay->docno\" /></td>";
							 		$btn = "<td align=center>&nbsp;</td>";
							 	} else {
							 		
							 		$de = "<td align=center>$pay->docno&nbsp;<input class='checkReff' type=hidden name=payReff[] value=\"CASH\" /></td>";
							 		$btn = "<td align=center><a onclick=javascript:Stockist.delPayment(this) class='btn btn-mini btn-danger'><i class='icon-trash icon-white'></i></a></td>";
									
							 	}
								echo "<tr>";
								echo "<td align=center>$pay->description<input type=hidden name=payChooseType[] value=\"$pay->paytype\" /></td>";
								echo $de;
								echo "<td align=right><input $readonly onchange=Stockist.hitungTotalBayar() class='forSum' style='text-align:right; width:160px;' type=text name=payChooseValue[] value=\"$payamt\" /></td>";
								
								echo $btn;
								echo "</tr>";
								$totPay += $pay->paytype;
							 }
					   }
					?>
				</tbody>	
				<tbody id="divTotPay">
					<tr>
						<td colspan="2" align="right">&nbsp;<b>Total Harga</b>&nbsp;</td>
						<td>
						<input readonly="readonly" type="text" id="total_cost" style="text-align:right; width:160px;" value="<?php echo number_format($tot_dp, 0, ",", "."); ?>" />
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" align="right">&nbsp;<b>Total Bayar</b>&nbsp;</td>
						<td>
						<input value="0" readonly="readonly" type="text" id="pay" style="text-align:right; width:160px;" value="<?php echo number_format($totPay, 0, ",", "."); ?>" />
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" align="right">&nbsp;<b>Sisa</b>&nbsp;</td>
						<td>
						<input value="0" readonly="readonly" type="text" id="change" style="text-align:right; width:160px;" />
						</td>
						<td>&nbsp;</td>	
					</tr>
				</tbody>
			</table></td>
		</tr>
	</table>

	<input value="<?php echo $ins; ?>" type="hidden" id="ins" name="ins" />
	<input value="<?php echo $jum_rec; ?>" type="hidden" id="rec" name="rec" />
	<input value="<?php echo $tabindex + 1; ?>" type="hidden" id="tabidx" name="tabidx" />
	<input value="" type="hidden" id="jenis_bayar" name="jenis_bayar" />
	<input type="hidden" id="prd_voucher" name="prd_voucher" value="<?php echo $prd_voucher; ?>" />
</form>