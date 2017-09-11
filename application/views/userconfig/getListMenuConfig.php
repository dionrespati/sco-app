<form id="save_menu">
  <table width="80%" class="table table-bordered">
  	<thead>
  		<tr>
		  <th width="5%">
		   <input class="menux" type=checkbox onclick="All.checkUncheckByClass('menux','acc_checkmenu')" />
		  </th>
		  <th>Menu Name</th>
		  <th width="13%">
		   <input class="addx" type=checkbox onclick="All.checkUncheckByClass('addx','acc_add')" />
		   &nbsp;Add
		  </th>
		  <th width="13%">
		   <input class="editx" type=checkbox onclick="All.checkUncheckByClass('editx','acc_edit')" />
		   &nbsp;Edit
		  </th>
		  <th width="13%">
		   <input class="viewx" type=checkbox onclick="All.checkUncheckByClass('viewx','acc_view')" />
		   &nbsp;View
		  </th>
		  <th width="13%">
		   <input class="deletex" type=checkbox onclick="All.checkUncheckByClass('deletex','acc_delete')" />
		   &nbsp;Delete
		  </th>
	    </tr>
  	</thead>
    <tbody id="tbl_menu">
      <?php  
		echo $res;
      ?> 	
      <tr>
      	<td colspan=2>
      	    <input type=button name=update value="Update Menu" class="btn btn-primary span14" onclick="All.inputFormData('menu/access/save', 'save_menu')" />
      	</td>
      	<td colspan=4>&nbsp;</td>
      </tr>
    </tbody>
  </table><input type=hidden id=usertype name=grpid value="<?php echo $grpid; ?>" />
</form>