<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formInputUser">
    <fieldset>      
      <div class="control-group">                      
         <?php
         //username
		 $onchange = "onchange=All.checkDoubleInput('user/list/','username',this.value)";
         $usrname = array(
		 	"labelname" => "User Name",
		 	"fieldname" => "username",
		 	"placeholder" => placeholderCheck(),
		 	"addClass" => "setReadOnly",	
		 	"event" => $onchange
 		 );
		 echo inputText($usrname);
		 //password
         $usrpwd = array(
		 	"labelname" => "Password",
		 	"fieldname" => "password",
		 	"placeholder" => "required"
 		 );
		 echo inputText($usrpwd);
		 //status
		 echo selectFlagActive("Status", "status");
		 //branch
         
		 //department
         $department = array(
		 	"labelname" => "Department ID",
		 	"fieldname" => "departmentid",
		 	"value" => $deptid,
		 	"readonly" => $readonly
 		 );
		 echo inputText($department);
		 //user group
		 
         $usergroup = array(
		 	"labelname" => "User Group",
		 	"fieldname" => "groupid",
		 	"optionlist" => $opt,
		 	"refresh" => $refresh
 		 );
		 echo inputSelect($usergroup, false);
		 
		 $branch = array(
		 	"labelname" => "Branch ID",
		 	"fieldname" => "branchid",
		 	"placeholder" => "Stockist / Branch ID",
		 	"value" => $branchid,
		 	"readonly" => $readonly
 		 );
		 echo inputText($branch);
		 
         $input  = "All.inputFormData('user/save', 'formInputUser')";
		 $update = "All.updateFormData('user/update', 'formInputUser', 'user/list')";
		 $view   = $btnViewAct;
         echo button_set($input, $update, $view);
		 ?>    
        </div> <!-- end control-group -->
     </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->
