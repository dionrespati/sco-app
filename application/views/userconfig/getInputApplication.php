<?php

?>
<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formInputApplication">
    <fieldset>      
      <div class="control-group">       
         <?php
            //application id
			 $onchange = "onchange=All.checkDoubleInput('app/list/','app_id',this.value)";
	         $app_id = array(
			 	"labelname" => "ID Application",
			 	"fieldname" => "app_id",
			 	"placeholder" => placeholderCheck(),
			 	"addClass" => "setReadOnly",
			 	"event" => $onchange
	 		 );
			 echo inputText($app_id);
			 //application name
	         $app_name = array(
			 	"labelname" => "Application Name",
			 	"fieldname" => "app_name",
			 	"placeholder" => "required"
	 		 );
			 echo inputText($app_name);
			  //application url
	         $app_name = array(
			 	"labelname" => "Application URL",
			 	"fieldname" => "app_url",
			 	"placeholder" => "required"
	 		 );
			 echo inputText($app_name);
			 //status
		     echo selectFlagActive("Active", "status");
			 $input  = "All.inputFormData('app/save', 'formInputApplication')";
			 $update = "All.updateFormData('app/update', 'formInputApplication', 'app/list')";
			 $view   = "All.getListData('app/list')";
	         echo button_set($input, $update, $view);
         ?>
        </div> <!-- end control-group -->
     </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->
