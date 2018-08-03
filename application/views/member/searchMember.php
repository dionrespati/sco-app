<div class="mainForm">
	<form class="form-horizontal" enctype="multipart/form-data" id="formMemberSearch">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="typeahead">Pencarian</label>
				<div class="controls">
					<select id="paramMember" name="paramMember" onchange="Member.optionMemberSearch(this.value)">
						<option value="dfno">ID Member</option>
						<option value="tel_hp">No HP</option>
						<option value="fullnm">Nama Member</option>
						<option value="idno">No KTP</option>
						<option value="sfno">ID Sponsor</option>
						<option value="sfno_reg">ID Recruiter</option>
						<option value="jointdt">Tgl Join</option>
						<option value="batchdt">Tgl Generate</option>
						<option value="mm">No. MM/MMS/MMSE</option>
					</select>
				</div>
				<label class="listM control-label" for="typeahead">Parameter/Nilai</label>
				<div class="listM controls">
					<input type="text" class="TabOnEnter span6" id="paramMemberValue" name="paramMemberValue" />
				</div>
				<label class="listByDate control-label" style="display: none;" for="typeahead">ID Stockist</label>
				<div class="listByDate controls" style="display: none;">
					<?php
					$str = "";
					if ($this -> stockist != "BID06") {
						$str = "readonly=readonly";
					}
					?>
					<input <?php echo $str; ?> type="text" class="TabOnEnter span6" id="sc_dfno" name="sc_dfno" value="<?php echo $this -> stockist; ?>" />
				</div>
				<label class="listByDate control-label" for="typeahead" style="display: none;">Date</label>
				<div class="listByDate controls" style="display: none;">
					<input type="text" class="dtpicker typeahead" id="mb_from" name="mb_from" >
					&nbsp;to&nbsp;
					<input type="text"  class="dtpicker typeahead" id="mb_to" name="mb_to" >
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
<?php
/*$form = array(
 "id" => "formMemberSearch",
 "formElement" => array(
 array(
 "label" => "Pencarian",
 "name" => "paramMember",
 "type" => "select",
 "options" => array(
 array ("label" => "ID Member", "value" => "dfno"),
 array ("label" => "No HP", "value" => "tel_hp"),
 array ("label" => "Nama Member", "value" => "fullnm"),
 array ("label" => "No KTP", "value" => "idno"),
 array ("label" => "ID Sponsor", "value" => "sfno"),
 array ("label" => "ID Recruiter", "value" => "sfno_reg"),
 array ("label" => "Tgl Join", "value" => "jointdt"),
 array ("label" => "Tgl Generate", "value" => "batchdt"),
 array ("label" => "No. MM/MMS/MMSE", "value" => "mm")
 )
 ),
 array(
 "label" => "Parameter/Nilai",
 "name" => "paramMemberValue",
 "type" => "text",
 )
 )
 );

 echo htmlFormGenerator($form);*/
?>
<script>
	$(document).ready(function() {
		$(All.get_active_tab() + " .dtpicker").datepicker({
			changeMonth : true,
			numberOfMonths : 1,
			dateFormat : 'yy-mm-dd',
		}).datepicker();

	}); 
</script>