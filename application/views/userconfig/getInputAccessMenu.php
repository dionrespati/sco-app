<?php

?>
<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formInputAccessMenu">
    <fieldset>      
      <div class="control-group">       
         <?php
             $opt = "";
			 foreach($listGroupUser as $list) {
			 		
			 	$opt .= "<option value=\"$list->groupid\">$list->groupname</option>";
			 }
	         $onsubmit = "Userconfig.getListAllMenuConfig()";
	         $usergroup = array(
			 	"labelname" => "User Group",
			 	"fieldname" => "groupid",
			 	"optionlist" => $opt,
			 	"submit" => $onsubmit
	 		 );
			 echo inputSelect($usergroup);
         ?>
        </div> <!-- end control-group -->
     </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->
