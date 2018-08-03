<div class="mainForm">
	<form class="form-horizontal" enctype="multipart/form-data" id="formMemberSearch">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="typeahead">Tipe Transaksi</label>
				<div class="controls">
					<select id="trxtype" name="trxtype">
						<option value="1">Online</option>
						<option value="2">Stockist</option>
					</select>
				</div>
				<label class="control-label" for="typeahead">Pencarian</label>
				<div class="controls">
					<select id="searchs" name="searchs">
						<option value="">--Pilih disini--</option>
						<option value="allstk">All Stockist</option>
						<option value="idstks">ID Stockist</option>
					</select>
				</div>
				<label class="listByDate control-label" style="display: none;" for="typeahead">ID Stockist</label>
				<div class="listByDate controls" style="display: none;">
					<?php
					$str = "";
					if ($this -> stockist != "BID06") {
						$str = "readonly=readonly";
					}
					?>
					<input <?php echo $str; ?> type="text" class="TabOnEnter span6" id="idstk" name="idstk" value="<?php echo $this -> stockist; ?>" />
				</div>
				<label class="listByDate control-label" for="typeahead">Tgl IP</label>
				<div class="listByDate controls">
					<input type="text" class="dtpicker typeahead" id="ip_from" name="from" >
					&nbsp;to&nbsp;
					<input type="text"  class="dtpicker typeahead" id="ip_to" name="to" >
				</div>
				<label class="control-label" for="typeahead">Status Print</label>
				<div class="controls">
					<select id="type" name="type">
						<option value="">All</option>
						<option value="0">New Print</option>
                        <option value="1">Reprint</option>
					</select>
				</div>
				<label class="control-label" for="typeahead">&nbsp</label>
				<div class="controls"  id="inp_btn">
					<input type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.ajaxFormPost(this.form.id, '<?php echo $form_action; ?>')" />
					<input type="reset" class="btn btn-reset" value="Reset" />
				</div>
			</div>
		</fieldset>
		<div class="result"></div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$(All.get_active_tab() + " .dtpicker").datepicker({
			changeMonth : true,
			numberOfMonths : 1,
			dateFormat : 'yy-mm-dd',
		}).datepicker();

	}); 
</script>