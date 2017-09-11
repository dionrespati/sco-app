<div class="mainForm">
  <form class="form-horizontal" id="formGeneratedSales">
    <fieldset>	      
      <div class="control-group">
      	<label class="control-label" for="typeahead">Periode Bonus</label>     
      	<div class="controls">
      		<select tabindex="1" class="span4" id="bnsperiod"  name="bnsperiod" class="span8 typeahead">
				<?php
				$opts = 2;

				////Array of months
				$m = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

				////Get starting year and month
				$sm = date('n', strtotime("-1 Months"));
				$sy = date('Y', strtotime("-1 Months"));
				foreach ($curr_period as $dt) {
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
			</select>
      	</div>
      	<label class="control-label" for="typeahead">Tipe Transaksi</label> 
      	<div class="controls">
      		<select id="sctype" tabindex="2" name="sctype" class="span4">
      			<option value="">All</option>
				<option value="1">- Stockist Sales Report (SSR) -</option>
				<option value="2">- Sub Stockist Sales Report (SSSR) -</option>
				<option value="3">- Mobile Stockist Sales Report (MSR) -</option>
      		</select>
      	</div>	
      	<label class="control-label" for="typeahead">Stockist</label>                             
        <div class="controls">
        	<input tabindex="3" type="text" id="sc_dfno" name="sc_dfno" class="span4" value="<?php echo $sc_dfno; ?>" />
        </div>
      	<label class="control-label" for="typeahead">Tgl SSR/MSR</label>
      		<div class="controls">
      			<input tabindex="4" type="text" class="dtpicker" id="from_stk_r_trx" name="from" placeholder="From" value="<?php echo $from; ?>" /> 
      			&nbsp;<input tabindex="5" type="text" class="dtpicker" id="to_stk_r_trx" name="to" placeholder="To" value="<?php echo $to; ?>" />
        		
     		</div>
      	<label class="control-label" for="typeahead">&nbsp;</label>                             
        <div class="controls"  id="inp_btn">
            <input tabindex="6" type="button" id="btn_input_user" class="btn btn-success" name="save" value="Cari" onclick="All.ajaxFormPost(this.form.id,'<?php echo $form_action ?>')" />
            <input tabindex="7"  type="reset" class="btn btn-reset" value="Reset" />
            
         </div>
        </div> <!-- end control-group -->
     </fieldset>
    
    
  </form> 
  <div class="result"></div>
</div><!--/end mainForm-->
<?php setDatePicker(); ?>
