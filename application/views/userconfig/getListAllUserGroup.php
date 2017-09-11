<?php
  if($listUserGroup == null) {
  	 echo emptyResultDiv();
  } else {
  	 echo "<form id=listUserGroup><table width=\"70%\" align=center class=\"table table-striped table-bordered bootstrap-datatable datatable\">";
       echo "<thead><tr ><th colspan=5 bgcolor=#lightgrey>List User Group</th></tr>";
       echo "<tr bgcolor=#f4f4f4><th width=15%>No</th><th>User Group Name</th><th width=15%>Action</th></thead></tr>";
       echo "<tbody>";
       $i = 1;
	   
       foreach($listUserGroup as $list) {
                echo "<tr id=\"$i\">";
                echo "<td><div align=right><input type=\"hidden\" id=\"gid$i\" value=\"$list->groupid\" />$list->groupid</div></td>";
                echo "<td><div align=center>$list->groupname</div></td>";  
                
                /*echo "<td><div align=\"center\">";
                echo "<a class=\"btn btn-mini btn-info\" onclick=\"Gallery.getUpdateGallery($i)\"><i class=\"icon-edit icon-white\"></i></a>";
                echo "&nbsp;<a class=\"btn btn-mini btn-danger\" onclick=\"Gallery.deleteGallery($i)\"><i class=\"icon-trash icon-white\"></i></a>";
                echo "</div></td>";*/
                $ondelete = "All.deleteFormData('user/group/delete/', '$list->groupid', 'user/group/list')";
                $arr = array(
				    "update" => "Userconfig.getUpdateUserGroup($i)",
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
