<?php
 	
?>
<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formUpdateStockist">
    <fieldset>      
      <div class="control-group">
      	<label class="control-label" for="typeahead">Kode Stockist</label>
      	<div class="controls">
      		<input <?php echo $onchange; ?> <?php echo $loccd_read; ?> type="text" class="TabOnEnter" id="loccd" style="width: 150px;" name="loccd" value="<?php echo $result[0]->loccd ?>" placeholder="Stockist Code" />	
      	</div>
      	<label class="control-label" for="typeahead">Nama Stockist</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->fullnm ?>"  type="text" class="TabOnEnter span6" id="fullnm" name="fullnm" readonly="readonly" placeholder="Stockist Fullname / Owner" />	
      	</div>
      	<label class="control-label" for="typeahead">Alamat</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->addr1 ?>"  type="text" class="TabOnEnter span6" id="addr1" name="addr1" />	
      	</div>
      	<label class="control-label" for="typeahead">&nbsp;</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->addr2 ?>"  type="text" class="TabOnEnter span6" id="addr2" name="addr2" />	
      	</div>
      	<label class="control-label" for="typeahead">&nbsp;</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->addr3 ?>"  type="text" class="TabOnEnter span6" id="addr3" name="addr3" />	
      	</div>
         <label class="control-label" for="typeahead">Latitude</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->latitude ?>"  type="text" class="TabOnEnter span6" id="latitude" name="latitude" />	
      	</div>
        <label class="control-label" for="typeahead">Longitude</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->longitude ?>"  type="text" class="TabOnEnter span6" id="longitude" name="longitude" />	
      	</div>
      	<label class="control-label" for="typeahead">No HP</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->tel_hp ?>"  type="text" class="TabOnEnter span6" id="tel_hp" name="tel_hp" />	
      	</div>
      	<label class="control-label" for="typeahead">No Telp Kantor</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->tel_of ?>"  type="text" class="TabOnEnter span6" id="tel_of" name="tel_of" />	
      	</div>
      	<label class="control-label" for="typeahead">No Telp Rumah</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->tel_hm ?>"  type="text" class="TabOnEnter span6" id="tel_hm" name="tel_hm" />	
      	</div>
      	<?php
      	if($idstk == "BID06") {
      	?>
      	<label class="control-label" for="typeahead">Lastkit Member</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->lastkitno ?>"  type="text" class="TabOnEnter span6" id="lastkitno" name="lastkitno" />	
      	</div>
      	<label class="control-label" for="typeahead">Max Kuota Reg Member</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->limitkit ?>"  type="text" readonly="readonly" class="TabOnEnter span6" id="limitkit" name="limitkit" />	
      	</div>
      	<label class="control-label" for="typeahead">Sisa Kuota Input</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->sisa_kuota ?>"  type="text" readonly="readonly" class="TabOnEnter span6" id="sisa_kuota" name="sisa_kuota" />	
      	</div>
       
      	<?php
		} else {
		?>
		<label class="control-label" for="typeahead">Lastkit Member</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->lastkitno ?>"  type="text" readonly="readonly" class="TabOnEnter span6" id="lastkitno" name="lastkitno" />	
      	</div>
      	<label class="control-label" for="typeahead">Max Kuota Reg Member</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->limitkit ?>"  type="text" readonly="readonly" class="TabOnEnter span6" id="limitkit" name="limitkit" />	
      	</div>
      	<label class="control-label" for="typeahead">Sisa Kuota Input</label>
      	<div class="controls">
      		<input value="<?php echo $result[0]->sisa_kuota ?>"  type="text" readonly="readonly" class="TabOnEnter span6" id="sisa_kuota" name="sisa_kuota" />	
      	
		<?php		
		}
      	?>
      	<label class="control-label" for="typeahead">&nbsp</label>                             
        <div class="controls"  id="inp_btn">
            <input type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.ajaxPostResetField(this.form.id,'stockist/addr/update')" />
            <input type="reset" class="btn btn-reset" value="Reset" />
            
         </div>
        </div> <!-- end control-group -->
      </div><!-- end control-group -->
    </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->