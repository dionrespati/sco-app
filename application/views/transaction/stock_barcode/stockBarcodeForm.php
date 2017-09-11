<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formStockBarcode">
    <fieldset>      
      <div class="control-group">
      	<?php if($stk_barcode_opt != null) {?>
      	<label class="control-label" for="typeahead">Search Param By</label>
      	<div class="controls">
      		<select class="span5" id="trx_type" name="trx_type" onchange="Stkbarcode.showSendTo(this.value, '#divSendTo')">
      			<option value="">--Select here--</option>
      			<?php
      			foreach($stk_barcode_opt as $dta) {
      				echo "<option value=\"$dta->id\">$dta->desc</option>";
      			}
      			?>
      		</select>	
      	</div>
      	<div class="clearfix"></div>
      	<?php } ?>
      	<label class="control-label" for="typeahead">Trx Date</label>
        <div class="controls" >
        	<input type="text" class="dtpicker" id="from1" name="from" value="<?php echo $from1; ?>"  />
   			<input type="text"  class="dtpicker" id="to1" name="to" value="<?php echo $to1; ?>"  />
        </div>	
        <div class="clearfix"></div>
        <div id="pilGenPl">
                            	
	    </div>
	    <div id="divSendTo">
	    	
	    </div>
      	<label class="control-label" for="typeahead">&nbsp</label>                             
        <div class="controls"  id="inp_btn">
            <input type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.ajaxFormPost(this.form.id, '<?php echo $form_action; ?>')" />
            <input type="reset" class="btn btn-reset" value="Reset" />
            <input id="info" type="hidden" name="info" value="">
            
         </div>
       
      </div><!-- end control-group -->
    </fieldset>
    <div class="result"></div>
  </form>   
  
</div><!--/end mainForm-->
<?php setDatePicker(); ?>