<?php
  if($listApp == null) {
  	 echo emptyResultDiv();
  } else {
  	 echo "<form id=listUserGroup><table width=\"100%\" class=\"table table-striped table-bordered bootstrap-datatable datatable\">";
       echo "<thead><tr><th colspan=5>List User</th></tr>";
       echo "<tr bgcolor=#f4f4f4><th width=10%>No</th><th width=20%>ID</th><th >Application Name</th><th width=15%>Create Dt</th><th width=15%>Action</th></thead></tr>";
       echo "<tbody>";
       $i = 1;
	   
       foreach($listApp as $list) {
                echo "<tr id=\"$i\">";
		        echo "<td><div align=right>$i<div></td>";
                echo "<td><div align=center><input type=\"hidden\" id=\"appid$i\" value=\"$list->app_id\" />$list->app_id</div></td>";
                echo "<td><div align=center>$list->app_name</div></td>";  
                echo "<td><div align=center>$list->createdt</div></td>";
                /*echo "<td><div align=\"center\">";
                echo "<a class=\"btn btn-mini btn-info\" onclick=\"Gallery.getUpdateGallery($i)\"><i class=\"icon-edit icon-white\"></i></a>";
                echo "&nbsp;<a class=\"btn btn-mini btn-danger\" onclick=\"Gallery.deleteGallery($i)\"><i class=\"icon-trash icon-white\"></i></a>";
                echo "</div></td>";*/
                $ondelete = "All.deleteFormData('app/delete/', '$list->app_id', 'app/list')";
                $arr = array(
				    "update" => "Userconfig.getUpdateApp($i)",
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
