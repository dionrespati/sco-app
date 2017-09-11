<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formProductSearch">
    <fieldset>      
      <div class="control-group">
      	<label class="control-label" for="typeahead">Pencarian</label>
      	<div class="controls">
      		<select id="param" name="param">
      			<option value="prdcd">Kode Produk</option>
      			<option value="prdnm">Nama Produk</option>
      			<option value="F">Daftar Kode Produk Free</option>
      			<!--<option value="P">List Product Bundling</option>-->
      		</select>	
      	</div>
      	<label class="control-label" for="typeahead">Parameter/Nilai</label>
      	<div class="controls">
      		<input type="text" class="TabOnEnter span6" id="paramValue" name="paramValue" placeholder="Product ID / Name" />	
      	</div>
      	
      	<label class="control-label" for="typeahead">&nbsp</label>                             
        <div class="controls"  id="inp_btn">
            <input type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.ajaxFormPost(this.form.id,'product/search/list')" />
            <input type="reset" class="btn btn-reset" value="Reset" />
            
         </div>
        </div> <!-- end control-group -->
      </div><!-- end control-group -->
    </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->