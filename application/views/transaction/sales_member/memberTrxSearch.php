<div class="mainForm">
  <form class="form-horizontal" id="formTrxSearch">
    <fieldset>      
      <div class="control-group">
      	
      	<label class="control-label" for="typeahead">Search By</label>                             
        <div class="controls">
        	<select id="searchby" name="searchby">
        		<option value="dfno">Distributor Code</option>
        		<option value="trcd">Transaction No</option>
        		<!-- option value="orderno">Order No</option -->
        		<option value="cnno">CN No.</option>
        		<option value="batchno">Batch No</option>
        	</select>
        </div>
       
        <span id="param" style="display: block;">
          	<label class="control-label" for="typeahead">Value</label>                             
	        <div class="controls">
	        	<input type="text" id="paramValue" name="paramValue" class="span4" />
	        </div>
        </span>
        

		<span id="period" style="display: block;">
        	<?php
				echo bonusPeriodAll();
        	?>
	        
	        <span id="trxdate" style="display: block;"> 
	        	
	        	<label class="control-label" for="typeahead">Transaction Date</label>
	      		<div class="controls">
	      			<input type="text" class="dtpicker" id="trx_memb_from" name="from" placeholder="From" /> 
	      			&nbsp;<input type="text" class="dtpicker" id="trx_memb_to" name="to" placeholder="To" />
	        		
	     		</div>
	        </span>
         
        </span>
        
        <label class="control-label" for="typeahead">&nbsp</label>                             
        <div class="controls"  id="inp_btn">
            <input tabindex="3" type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.ajaxFormPost(this.form.id,'member/trx/search')" />
            <input tabindex="4"  type="reset" class="btn btn-reset" value="Reset" />
         </div>
        </div> <!-- end control-group -->
     </fieldset>
    
    <div class="result"></div>
  </form> 
</div><!--/end mainForm-->
<script>
	$(document).ready(function() { 
		if( $("#searchby").val() == "cnno" || $("#searchby").val() == "batchno") {
		        $("#param").css('display', 'block');
		        $("#period").css('display', 'none');
		  } else {
		     	$("#param").css('display', 'block');
		        $("#period").css('display', 'block');
		  }
		
		$("#searchby").change(function() {
		    if( $("#searchby").val() == "cnno" || $("#searchby").val() == "batchno" || 
		    	$("#searchby").val() == "trcd" ){
		        $("#param").css('display', 'block');
		        $("#period").css('display', 'none');
		     }else{
		     	$("#param").css('display', 'block');
		        $("#period").css('display', 'block');
		     }
		 });
		 
		/* 
	 	var dtfrom = document.getElementById('from');
	 	var dtto = document.getElementById('to');
	 	
		$('#chk-dtrange').attr('checked', true); //set default value checked
		dtfrom.disabled = true;
		dtto.disabled = true;
		 
		 $('input:checkbox').click(function () {
		 	var chk = $("#chk-dtrange").val();
		 	//alert(chk);
		  	if ($(this).is(':checked')) {
		  		dtfrom.disabled = true;
		  		dtto.disabled = true;
		  		$("#chk").val("1");
		  	} else {
		  		dtfrom.disabled = false;
		  		dtto.disabled = false;
		  		$("#chk").val("0");
		  	}
		});
		 */
		$(All.get_active_tab() + " .dtpicker").datepicker({
			changeMonth: true,
			numberOfMonths: 1,
			dateFormat: 'yy-mm-dd',
		}).datepicker("setDate", new Date());;
		
		
	});	
</script>
