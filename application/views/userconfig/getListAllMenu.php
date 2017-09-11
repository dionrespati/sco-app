<?php
  if($listSubMenu == null) {
  	 echo emptyResultDiv();
  } else {
  	 echo "<form id=listUserGroup><table width=\"100%\" class=\"table table-striped table-bordered bootstrap-datatable datatable\">";
       echo "<thead><tr><th colspan=6>List Sub Menu</th></tr>";
       echo "<tr bgcolor=#f4f4f4><th width=6%>No</th><th width=10%>ID</th><th>Menu Name</th><th>Group</th><th>Order</th><th width=15%>Action</th></thead></tr>";
       echo "<tbody>";
       $i = 1;
	   
       foreach($listSubMenu as $list) {
                echo "<tr id=\"$i\">";
		        echo "<td><div align=right>$i<div></td>";
                echo "<td><div align=center><input type=\"hidden\" id=\"menu_id$i\" value=\"$list->app_menu_id\" />$list->app_menu_id</div></td>";
                echo "<td><div align=center>$list->app_menu_desc</div></td>";  
                echo "<td><div align=center>$list->group_menu</div></td>";
				echo "<td><div align=center>$list->menu_order</div></td>";
                /*echo "<td><div align=\"center\">";
                echo "<a class=\"btn btn-mini btn-info\" onclick=\"Gallery.getUpdateGallery($i)\"><i class=\"icon-edit icon-white\"></i></a>";
                echo "&nbsp;<a class=\"btn btn-mini btn-danger\" onclick=\"Gallery.deleteGallery($i)\"><i class=\"icon-trash icon-white\"></i></a>";
                echo "</div></td>";*/
                $ondelete = "All.deleteFormData('menu/delete/', '$list->app_menu_id', 'menu/list')";
                $arr = array(
				    "update" => "Userconfig.getUpdateSubMenu($i)",
				    "delete" => $ondelete
				);
                echo btnUpdateDelete($arr);
                echo "</tr>";
              $i++; 
        }
    echo "</tbody></tr>";
    echo "</table></form>";
	?>
	<!--<script>
      $( document ).ready(function() {
       All.set_datatable();
        });
 </script>-->
	<?php
	setDatatable();
  }
?>
