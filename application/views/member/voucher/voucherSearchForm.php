<div class="mainForm">
  <form class="form-horizontal" id="frmVoucherSearch">
    <fieldset>      
      <div class="control-group">
      	
      	<label class="control-label" for="typeahead">Pencarian</label>                             
        <div class="controls">
        	<select id="searchby" name="searchby">
        		<option value="trcd">CN/MM/MSN No.</option>
        		<option value="receiptno">Receipt No.</option>
        		<option value="vcno">Voucher No</option>
        		<option value="trxdt">Receipt Date</option>
        	</select>
        </div>
       
        <span class="trcdno" style="display: none;">
          	<label class="control-label" for="typeahead">Parameter/Nilai</label>                             
	        <div class="controls">
	        	<input type="text" id="paramValue" name="paramValue" class="span4" />
	        </div>
        </span>
        
        <span class="trxdate" style="display: none;"> <?php echo datepickerFromTo("Transaction Date", "trx_from", "trx_to"); ?></span>
 
        
        <label class="control-label" for="typeahead">&nbsp</label>                             
        <div class="controls"  id="inp_btn">
            <input tabindex="3" type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.ajaxFormPost(this.form.id, 'voucher/search/list')" />
            <input tabindex="4"  type="reset" class="btn btn-reset" value="Reset" />
         </div>
        </div> <!-- end control-group -->
     </fieldset>
    
    <div class="result"></div>
  </form> 
</div><!--/end mainForm-->
<script>
	$(document).ready(function() { 
		if( $(All.get_active_tab() + " #searchby").val() == "trcd" || 
		     $(All.get_active_tab() + " #searchby").val() == "receiptno" || 
		     $(All.get_active_tab() + " #searchby").val() == "vcno"){
		        $(All.get_active_tab() + " .trcdno").css('display', 'block');
		        $(All.get_active_tab() + " .trxdate").css('display', 'none');
		     }
		
		$(All.get_active_tab() + " #searchby").change(function() {
		     if( $(All.get_active_tab() + " #searchby").val() == "trcd" || 
		        $(All.get_active_tab() + " #searchby").val() == "receiptno" || 
		        $(All.get_active_tab() + " #searchby").val() == "vcno") {
		        	$(All.get_active_tab() + " .trcdno").css('display', 'block');
		        	$(All.get_active_tab() + " .trxdate").css('display', 'none');
		     }else if($(All.get_active_tab() + " #searchby").val() == "trxdt"){
		        $(All.get_active_tab() + " .trxdate").css('display', 'block');
		        $(All.get_active_tab() + " .trcdno").css('display', 'none');
		     }
		 });
		 
		$(All.get_active_tab() + " .dtpicker").datepicker({
			changeMonth: true,
			numberOfMonths: 1,
			dateFormat: 'yy-mm-dd',
		}).datepicker("setDate", new Date());
	});	
</script>
