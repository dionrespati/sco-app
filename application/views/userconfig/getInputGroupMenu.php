<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formInputGroupMenu">
    <fieldset>      
      <div class="control-group">                      
         <?php
         //app_menu_desc
		 $onchange = "onchange=All.checkDoubleInput('menu/group/list/','app_menu_desc',this.value)";
         $app_menu_desc = array(
		 	"labelname" => "Group Menu Name",
		 	"fieldname" => "app_menu_desc",
		 	"placeholder" => placeholderCheck(),
		 	"hiddentext" => "id",
		 	"event" => $onchange
 		 );
		 echo inputText($app_menu_desc);
		 //app_submenu_prefix
		 $onchange = "onchange=All.checkDoubleInput('menu/group/list/','app_submenu_prefix',this.value)";
         $app_submenu_prefix = array(
		 	"labelname" => "Sub Menu Prefix",
		 	"fieldname" => "app_submenu_prefix",
		 	"placeholder" => placeholderCheck(),
		 	"maxlength" => "2",
		 	"event" => $onchange
 		 );
		 echo inputText($app_submenu_prefix);
		 //user group
		 $opt = "";
		 foreach($listApp as $list) {
		 		
		 	$opt .= "<option value=\"$list->app_id\">$list->app_name</option>";
		 }
         $usergroup = array(
		 	"labelname" => "Application",
		 	"fieldname" => "app_id",
		 	"optionlist" => $opt,
		 	"refresh" => "Userconfig.refreshListApp(' #app_id')"
 		 );
		 echo inputSelect($usergroup);
		 echo selectFlagActive("Status", "status");
		 $app_submenu_prefix = array(
		 	"labelname" => "Display Order",
		 	"fieldname" => "menu_order",
		 	
		 	//"event" => $onchange
 		 );
		 echo inputText($app_submenu_prefix);
         $input  = "All.inputFormData('menu/group/save', 'formInputGroupMenu')";
		 $update = "All.updateFormData('menu/group/update', 'formInputGroupMenu', 'menu/group/list')";
		 $view   = "All.getListData('menu/group/list')";
         echo button_set($input, $update, $view);
		 ?>    
        </div> <!-- end control-group -->
     </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->
