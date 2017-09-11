<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formInputUserGroup">
    <fieldset>      
      <div class="control-group">       
         <?php
         //username
         $onchange = "onchange=All.checkDoubleInput('user/group/list/','groupname',this.value)";
         $usrgroup = array(
		 	"labelname" => "User Group Name",
		 	"fieldname" => "groupname",
		 	"placeholder" => placeholderCheck(),
		 	"hiddentext" => "id",
		 	"event" => $onchange
 		 );
         echo inputText($usrgroup);
         $input = "All.inputFormData('user/group/save', 'formInputUserGroup')";
		 $update = "All.updateFormData('user/group/update', 'formInputUserGroup', 'user/group/list')";
		 $view = "All.getListData('user/group/list')";
         echo button_set($input, $update, $view);
		 ?>    
        </div> <!-- end control-group -->
     </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->
