<div class="mainForm">
  <form class="form-horizontal" enctype="multipart/form-data" id="formInputSubMenu">
    <fieldset>      
      <div class="control-group">                      
         <?php
         //app_menu_desc
		 $onchange = "onchange=All.checkDoubleInput('menu/list/','app_menu_desc',this.value)";
         $app_menu_desc = array(
		 	"labelname" => "Menu Name",
		 	"fieldname" => "app_menu_desc",
		 	"placeholder" => placeholderCheck(),
		 	"hiddentext" => "id",
		 	"event" => $onchange
 		 );
		 echo inputText($app_menu_desc);
		 //app_submenu_prefix
		 //$onchange = "onchange=All.checkDoubleInput('menu/list/','app_submenu_prefix',this.value)";
         $app_submenu_prefix = array(
		 	"labelname" => "URL",
		 	"fieldname" => "app_menu_url",
		 	"placeholder" => placeholderCheck()
		 	//"event" => $onchange
 		 );
		 echo inputText($app_submenu_prefix);
		 //user group
		 $opt = "";
		 foreach($listGroupMenu as $list) {
		 		
		 	$opt .= "<option value=\"$list->app_menu_id\">$list->app_menu_desc</option>";
		 }
         $onchange = "onchange=Userconfig.getInfoGroupMenu(this.value)";
         $usergroup = array(
		 	"labelname" => "Group Menu",
		 	"fieldname" => "app_menu_parent_id",
		 	"optionlist" => $opt,
		 	"refresh" => "Userconfig.refreshListGroupMenu(' #app_menu_parent_id')",
		 	
		 	"event" => $onchange
 		 );
		 echo inputSelect($usergroup);
		 echo selectFlagActive("Status", "status");
		 $app_submenu_prefix = array(
		 	"labelname" => "Display Order",
		 	"fieldname" => "menu_order",
		 	
		 	//"event" => $onchange
 		 );
		 echo inputText($app_submenu_prefix);
		 echo inputHidden("app_submenu_prefix");
		 echo inputHidden("app_id");
         $input  = "All.inputFormData('menu/save', 'formInputSubMenu')";
		 $update = "All.updateFormData('menu/update', 'formInputSubMenu', 'menu/list')";
		 $view   = "All.getListData('menu/list')";
         echo button_set($input, $update, $view);
		 ?>    
        </div> <!-- end control-group -->
     </fieldset>
  </form>   
  <div class="result"></div>
</div><!--/end mainForm-->
