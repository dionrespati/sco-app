<?php
$stk = $this -> session -> userdata("stockist");
$stkname = $this -> session -> userdata("stockistnm");
//print_r($curr_period);
?>
<div class="mainForm">
	<form class="form-horizontal" enctype="multipart/form-data" id="formInputList">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="typeahead">Main Stockist</label>
				<div class="controls">
					<input <?php echo $mainstk_read; ?> type="text" name="mainstk" id="mainstk" value="<?php echo $stk; ?>" onchange="All.getFullNameByID(this.value,'db2/get/fullnm/from/mssc/loccd','#mainstknm')" />
					<input type="text" class="fullnm_width" readonly="yes" name="mainstknm" id="mainstknm" value="<?php echo $stkname; ?>" />
				</div>
				<div class="clearfix"></div>
				<label class="control-label" for="typeahead">Kode Stockist</label>
				<div class="controls">
					<input type="text" id="idstkk" name="idstkk" placeholder="ID Stockist" class="" onchange="All.getFullNameByID(this.value,'db2/get/fullnm/from/mssc/loccd','#stknmm')" tabindex="1"/>
					<input type="text" class="fullnm_width" id="stknmm" name="stknmm" placeholder="Nama Stockist" class="" readonly="yes"/>
				</div>
				<div class="clearfix"></div>
				<label class="control-label" for="typeahead">Period Bonus</label>
				<div class="controls">
					<select id="bnsperiod"  name="bnsperiod" class="span3 typeahead" tabindex="2">
						<?php
						  echo "<option value='" . date('m/Y', strtotime($curr_period[0] -> lastperiod)) . "'>" . date('M Y', strtotime($curr_period[0] -> lastperiod)) . "</option>";
						  echo "<option value='" . date('m/Y', strtotime($curr_period[0] -> nextperiod)) . "'>" . date('M Y', strtotime($curr_period[0] -> nextperiod)) . "</option>";
						?>
					</select>
				</div>
				<div class="clearfix"></div>
				<label class="control-label" for="typeahead">Tipe Transaksi</label>
				<div class="controls">
					<select class="span4 typeahead" id="searchs"  name="searchs" tabindex="3">
						<option value="">--Pilih disini--</option>
						<option value="apl">Aplikasi Member</option>
						<option value="ms">MSR - Mobile Stockist Sales Report</option>
						<option value="stock">SSR - Stockist Sales Report</option>
						<option value="sub">SSSR - Sub Stockist Sales Report</option>
						<option value="pvr">PVR - Product Voucher</option>
						<!--<option value="apl">Application</option>-->
						<!--<option value="pvr">Product Voucher</option>-->
					</select>
				</div>
				<div class="clearfix"></div>
				<label class="control-label" for="typeahead">Tgl Trx</label>
				<div class="controls">
					<input type="text" tabindex="4" class="dtpicker" id="datepicker" name="from" placeholder="Date From" />
					 s/d
					<input type="text" tabindex="5" class="dtpicker" id="datepicker2" name="to" placeholder="Date To" />
					<input type="button" tabindex="6" class="btn btn-primary" onclick="All.ajaxFormPost(this.form.id,'sales/search/list')" name="submit" value="Cari"/>
				</div>
				
			
			<!-- end control-group -->
          </div><!-- end control-group -->
		</fieldset>
	  </form>
	<div class="result"></div>
</div><!--/end mainForm-->
<?php setDatePicker(); ?>