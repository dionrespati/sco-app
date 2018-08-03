<div class="mainForm">
  <form class="form-horizontal" id="formTrxSearchPVR">
    <fieldset>      
      <div class="control-group">
      	<label class="control-label" for="typeahead">Tgl Transaksi</label>
      		<div class="controls">
      			<input type="text" class="dtpicker" id="from_pvr_trx" name="from" placeholder="From" value="<?php echo $from; ?>" /> 
      			&nbsp;<input type="text" class="dtpicker" id="to_pvr_trx" name="to" placeholder="To" value="<?php echo $to; ?>" />
        		
     		</div>
      	<label class="control-label" for="typeahead">Pencarian</label>                             
        <div class="controls">
        	
        	<select id="searchby" class="input" name="searchby">
				<option value="">[Pilih]</option>
				<option value="trcd">No Trx</option>
				<option selected="selected" value="sc_dfno">Kode Stockist</option>
				<option value="batchno">No PVR</option>
				<option value="orderno">No TTP</option>
				<!--<option value="csno">CN No.</option>-->
			</select>
        </div>
     
      	<label class="control-label" for="typeahead">Parameter/Nilai</label>                             
        <div class="controls">
        	<input type="text" id="paramValue" name="paramValue" class="span4" value="<?php echo $sc_dfno; ?>" />
        </div>
       	<label class="control-label" for="typeahead">&nbsp;</label>                             
        <div class="controls"  id="inp_btn">
            <input tabindex="5" type="button" id="btn_input_user" class="btn btn-success" name="save" value="Search" onclick="All.ajaxFormPost(this.form.id,'sales/pvr/input/list')" />
            <input tabindex="6"  type="reset" class="btn btn-reset" value="Reset" />
            <input tabindex="7"  type="button" class="btn btn-primary" value="Input PVR Baru" onclick="javascript:All.ajaxShowDetailonNextForm('sales/pvr/input/form')" />
         </div>
        </div> <!-- end control-group -->
     </fieldset>
    
    
  </form> 
  <div class="result"></div>
</div><!--/end mainForm-->
<?php setDatePicker(); ?>
