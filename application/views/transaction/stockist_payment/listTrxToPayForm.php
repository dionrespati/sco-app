<div class="mainForm">
	<form class="form-horizontal" target="_blank" method="post" id="listTrx" name="listTrx" action="<?php echo base_url('sales/payment/preview') ?>" onsubmit="return paystk.previewStkPay()">
		<fieldset>

			<label class="control-label" for="typeahead">Tgl Generate</label>
			<div class="controls" >
				<input type="text" class="dtpicker" id="from1" name="from" value="<?php echo $from; ?>"  />
				<input type="text"  class="dtpicker" id="to1" name="to" value="<?php echo $to; ?>"  />
			</div>
			<div class="clearfix"></div>
			<label class="control-label" for="typeahead">Bonus Period</label>
			<div class="controls" >
				
				<select id="bnsperiod" name="bnsperiod">
					<?php
					  foreach($period as $dta) {
					  	echo "<option value=\"$dta->currPeriodSCO2\">$dta->currPeriodSCO</option>";
					  }
					?>
				</select>
			</div>
			<div class="clearfix"></div>

			<label class="control-label" for="typeahead">ID Stockist</label>
			<div class="controls" >
				<input type="text" class="span2" id="idstk" name="idstk" value="<?php echo $user; ?>"  />

			</div>
			<div class="clearfix"></div>
			<label class="control-label" for="typeahead">Metode Pembayaran</label>
			<div class="controls" >
				<select id="bank" name="bank" onchange="paystk.setSelectPay()">
					<option value="">--Pilih disini--</option>
					<?php
					foreach ($bank as $dta) {
						echo "<option value=\"$dta->id|$dta->bankCode|$dta->charge_connectivity|$dta->charge_admin|$dta->bankDesc|$dta->bankDisplayNm\">$dta->bankDisplayNm</option>";
					}
					?>
				</select>

				<input type="hidden" value="" name="totalx">
				<input id="bankid" type="hidden" value="" name="bankid">
				<input id="bankCode" type="hidden" value="" name="bankCode">
				<input id="bankDesc" type="hidden" value="" name="bankDesc">
				<input id="bankDescDetail" type="hidden" value="" name="bankDescDetail">
				<input id="charge_connectivity" type="hidden" value="" name="charge_connectivity">
				<input id="charge_admin" type="hidden" value="" name="charge_admin">
				<input id="dp_real" type="hidden" value="" name="dp_real">
				<input id="bv_real" type="hidden" value="" name="bv_real">
			</div>
			<div class="clearfix"></div>
			<label class="control-label" for="typeahead">Total Pembayaran</label>
			<div class="controls" >
				<input type="text" readonly="readonly" style="text-align: right;" class="span3" id="selected_pay" name="selected_pay" value=""  />

			</div>
			<div class="clearfix"></div>
			<label class="control-label" for="typeahead">&nbsp;</label>
			<div class="controls" >
				<input type="button" id="submits" class="btn btn-success" onclick="All.ajaxFormPost(this.form.id, 'sales/payment/list')" name="submit" value="Cari"/>
				<!--<input type="button" class="btn btn-primary" value="Proceed to Payment" name="kirim" onclick="paystk.previewPayment(this.form.id, 'stk/trx/preview')" />-->
				<input type="submit" class="btn btn-primary" value="Lanjut Pembayaran" name="kirim" />
			</div>

		</fieldset>
		<br />
		<div class="result"></div>
	</form>

</div>
<?php setDatePicker(); ?>