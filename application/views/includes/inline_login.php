<div class="mainForm">
 <form class="form-horizontal" id="inlineLogin">
	<fieldset>
	  <div class="control-group">
	  	<?php
	  	 echo sessionExpireMessage(false);
	  	?>
      	<label class="control-label" for="typeahead">Username</label>
      	<div class="controls">
      		<input type="text" name="username" id="username" class="TabOnEnter span5" />	
      	</div>
      	
      	<label class="control-label" for="typeahead">Password</label>
      	<div class="controls">
      		<input type="password" name="password" id="password" class="TabOnEnter span5" />	
      	</div>
      	<label class="control-label" for="typeahead">&nbsp</label>                             
        <div class="controls"  id="inp_btn">
        	<input type="hidden" id="form_reload" name="form_reload" value="<?php echo $form_reload; ?>" />
            <input type="button" id="btn_input_user" class="btn btn-primary .submit" name="save" value="Submit" onclick="All.relogin(this.form.id)" />
            <input type="reset" class="btn btn-reset" value="Reset" />
        </div>
      </div>   
    </fieldset>
 </form>
</div>
