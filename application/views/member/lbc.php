<?php
function set_nbsp($i) {
	$str = "";
	for ($j = 1; $j <= $i; $j++) {
		$str .= "&nbsp;";
	}
	return $str;
}
?>
<div class="mainForm">
	<form class="form-horizontal" enctype="multipart/form-data" id="formLbcReg">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="typeahead">ID Member</label>
				<div class="controls">
					<input type="text" class="TabOnEnter span4" id="idmember" name="idmember" onchange="Member.checkLbcByID(this.value)" />
				</div>
				<label class="control-label" for="typeahead">Nama Member</label>
				<div class="controls">
					<input type="text" class="TabOnEnter span6" readonly="readonly" id="nmmember" name="nmmember" />
				</div>
				<label class="control-label" for="typeahead">Tgl lahir</label>
				<div class="controls">
					<input type="text" readonly="readonly" class="TabOnEnter span2" id="dob" name="dob" />
				</div>
				<label class="control-label" for="typeahead">No KTP</label>
				<div class="controls">
					<input type="text" readonly="readonly" class="TabOnEnter span4" id="idno" name="idno" />
				</div>
				<label class="control-label" for="typeahead">Email</label>
				<div class="controls">
					<input type="text" class="TabOnEnter span4" id="email" name="email" />
				</div>
				<label class="control-label"  for="typeahead">Masa Berlaku</label>
				<div class="controls">
					<input type="text" readonly="readonly" class="TabOnEnter" id="register_dt" name="register_dt" />&nbsp;s/d&nbsp;
					<input type="text" readonly="readonly" class="TabOnEnter" id="expired_dt" name="expired_dt" />
				</div>
				<!--<label class="control-label" for="typeahead">Tgl Berakhir LBC</label>
				<div class="controls">
					
				</div>-->
				<label class="control-label" for="typeahead">Alamat</label>
				<div class="controls">
					<input type="text" class="TabOnEnter span4" id="addr1" name="addr1" maxlength="20" />
					<!--&nbsp;Correspondence Addr&nbsp;&nbsp;
					<input type="text" class="TabOnEnter fullnm_double_input" id="c_addr1" name="c_addr1" />-->
				</div>
				<label class="control-label" for="typeahead">&nbsp;</label>
				<div class="controls">
					<input type="text" class="TabOnEnter span4" id="addr2" name="addr2" maxlength="20" />
					<!--<?php echo set_nbsp(37); ?>
					<input type="text"  class="TabOnEnter fullnm_double_input" id="c_addr2" name="c_addr2" />-->
				</div>
				<label class="control-label" for="typeahead">&nbsp;</label>
				<div class="controls">
					<input type="text" class="TabOnEnter span4" id="addr3" name="addr3" maxlength="20" />
					<!--?php echo set_nbsp(37); ?>
					<input type="text"  class="TabOnEnter fullnm_double_input" id="c_addr3" name="c_addr3" />-->
				</div>
				<label class="control-label" for="typeahead">Kode Stockist</label>
				<div class="controls">
					<input id="bnsstmsc" class="idmemb_width" type="text" onchange="All.getFullNameByID(this.value,'db2/get/fullnm/from/mssc/loccd','#stockistname')" name="bnsstmsc">
					<input id="stockistname" class="fullnm_width" type="text" name="stockistname" readonly="yes">
				</div>
				<label class="control-label" for="typeahead">&nbsp</label>
				<div class="controls"  id="inp_btn">
					<input type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.ajaxFormPost(this.form.id, '<?php echo $form_action; ?>')" />
					<input type="reset" class="btn btn-reset" value="Reset" />

				</div>

			</div><!-- end control-group -->
		</fieldset>
		<div class="result"></div>
	</form>

</div><!--/end mainForm-->
<script>
	$(document).ready(function() {
		$(All.get_active_tab() + " .dtpicker").datepicker({
			changeMonth : true,
			numberOfMonths : 1,
			dateFormat : 'yy-mm-dd',
		}).datepicker();

	}); 
</script>