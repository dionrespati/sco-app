<?php
class Userconfig_model extends MY_Model {
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	
	
	
	/*----------------
	 * USER GROUP
	 * --------------*/
	
	function getListUserGroup($param, $value) {
		$qry = "SELECT * FROM ecomm_usergroup WHERE $param = '$value'";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("No result", 1);
		}
		return $res;
	}
	
	function getListAllUserGroup() {
		$qry = "SELECT * FROM ecomm_usergroup";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("Data user group is empty..!", 1);
		}
		return $res;
	}
	
	function getListAllUserGroupByID($id) {
		$qry = "SELECT * FROM ecomm_usergroup WHERE groupid = $id";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("Data user group is empty..!", 1);
		}
		return $res;
	}
	
	function saveInputUserGroup() {
		$data = $this->input->post(NULL, TRUE);
		$qry = "INSERT INTO ecomm_usergroup (groupname)
		        VALUES ('$data[groupname]')";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Save Group Menu failed..!!", 1);
		} 
		return $query;
	}
	
	function updateUserGroup() {
		$data = $this->input->post(NULL, TRUE);
		$qry = "UPDATE ecomm_usergroup SET groupname = '$data[groupname]'
		        WHERE groupid = '$data[id]'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Update Group Menu failed..!!", 1);
		} 
		return $query;
	}
	
	function deleteUserGroup($id) {
		$qry = "DELETE FROM ecomm_usergroup WHERE groupid = '$id'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Delete Group Menu failed..!!", 1);
		} 
		return $query;
	}
	
	/*----------------
	 * USER
	 * --------------*/
	 function getListAllUser() {
	 	$qry = "SELECT 
				  dbo.ecomm_usergroup.groupname,
				  dbo.ecomm_user.username,
				  dbo.ecomm_user.departmentid,
				  dbo.ecomm_user.branchid,
				  CONVERT(VARCHAR(30),dbo.ecomm_user.createdt, 103) AS createdt
				FROM
				  dbo.ecomm_user
				  INNER JOIN dbo.ecomm_usergroup 
				  ON (dbo.ecomm_user.groupid = dbo.ecomm_usergroup.groupid)";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("Data user is empty..!", 1);
		}
		return $res;
	 }
	 
	 function getListAllUserByParam($param, $value) {
	 	$qry = "SELECT 
				  dbo.ecomm_usergroup.groupname,
				  dbo.ecomm_user.username,
				  dbo.ecomm_user.departmentid,
				  dbo.ecomm_user.branchid,
				  CONVERT(VARCHAR(30),dbo.ecomm_user.createdt, 103) AS createdt
				FROM
				  dbo.ecomm_user
				  INNER JOIN dbo.ecomm_usergroup 
				  ON (dbo.ecomm_user.groupid = dbo.ecomm_usergroup.groupid)
				WHERE dbo.ecomm_user.$param = '$value'";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("Data user is empty..!", 1);
		}
		return $res;
	 }
	 
	 function getListUser($param, $value) {
		$qry = "SELECT * FROM ecomm_user WHERE $param = '$value'";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("No result", 1);
		}
		return $res;
	 }
	 
	 function saveInputUser() {
	 	$data = $this->input->post(NULL, TRUE);
		$qry = "INSERT INTO ecomm_user (username, password, status, branchid, 
		                    departmentid, createnm, groupid)
		        VALUES ('$data[username]','$data[password]','$data[status]','$data[branchid]',
		               '$data[departmentid]', '".$this->username."', '$data[groupid]')";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Save User failed..!!", 1);
		} 
		return $query;
	 }
	 
	 function saveUpdateUser() {
		$data = $this->input->post(NULL, TRUE);
		$qry = "UPDATE ecomm_user SET password = '$data[password]',
		              status = '$data[status]', branchid = '$data[branchid]', departmentid = '$data[departmentid]',
		              groupid = '$data[groupid]'
		        WHERE username = '$data[username]'";
		
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Update User failed..!!", 1);
		} 
		return $query;
	 }
	 
	 function deleteUser($id) {
	 	$qry = "DELETE FROM ecomm_user WHERE username = '$id'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Delete User failed..!!", 1);
		} 
		return $query;
	 }

     /*----------------
	 * USER
	 * --------------*/
     function getListAllApplication() {
	 	$qry = "SELECT 
				  a.app_id,
				  a.app_name,
				  a.app_url, a.status, createnm,
				  CONVERT(VARCHAR(30),a.createdt, 103) AS createdt
				FROM
				  app_table a";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("Data Application is empty..!", 1);
		}
		return $res;
	 }
	 
	 function getListApplication($param, $value) {
		$qry = "SELECT * FROM app_table WHERE $param = '$value'";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("No result", 1);
		}
		return $res;
	 }
	 
	 function saveInputApplication() {
	 	$data = $this->input->post(NULL, TRUE);
		$qry = "INSERT INTO app_table (app_id, app_name, app_url, status, createnm)
		        VALUES ('$data[app_id]','$data[app_name]','$data[app_url]','$data[status]',
		               '".$this->username."')";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Save User failed..!!", 1);
		} 
		return $query;
	 }
	 
	 
	 function saveUpdateApplication() {
		$data = $this->input->post(NULL, TRUE);
		$qry = "UPDATE app_table SET app_name = '$data[app_name]',
		              app_url = '$data[app_url]', status = '$data[status]'
		        WHERE app_id = '$data[app_id]'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Update User failed..!!", 1);
		} 
		return $query;
	 }
	 
	 function deleteApplication($id) {
	 	$qry = "DELETE FROM app_table WHERE app_id = '$id'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Delete User failed..!!", 1);
		} 
		return $query;
	 }
	 
	 /*----------------
	 * MENU GROUP
	 * --------------*/
     function getListAllGroupMenu() {
	 	$qry = "SELECT 
				  dbo.app_table.[app_name],
				  dbo.app_tabprg.app_id,
				  dbo.app_tabprg.app_menu_id,
				  dbo.app_tabprg.app_menu_desc,
				  dbo.app_tabprg.app_submenu_prefix,
				  dbo.app_tabprg.[status],
				  dbo.app_tabprg.menu_order
				FROM
				  dbo.app_tabprg
				  INNER JOIN dbo.app_table ON (dbo.app_table.app_id = dbo.app_tabprg.app_id)
				WHERE dbo.app_tabprg.app_menu_parent_id = '0'";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("Data Application is empty..!", 1);
		}
		return $res;
	 }
	 
	 function getListGroupMenu($param, $value) {
		$qry = "SELECT * FROM app_tabprg WHERE $param = '$value'";
		$res = $this->getRecordset($qry, NULL, $this->db1);
		if($res == null) {
			throw new Exception("No result", 1);
		}
		return $res;
	 }
	 
	 function getMenuID($prefix = "RT") {

	 	$qry = "SELECT max(a.app_menu_id) as jum
				FROM app_tabprg a
				WHERE app_menu_id LIKE '$prefix%'";	
		//echo $qry;	
		$res = $this->getRecordset($qry, NULL, $this->db1);	
		$jumlah = substr($res[0]->jum, 2, 3);
		$next_id = $jumlah + 1;
        
    	$next_id = sprintf("%03s",$next_id);
    	$y =  strval($prefix.$next_id); 
        return $y;  
	 }
	 
	 function saveInputGroupMenu($id) {
	 	$data = $this->input->post(NULL, TRUE);
		$qry = "INSERT INTO app_tabprg (app_id, app_menu_id, app_submenu_prefix, app_menu_desc, app_menu_url, status, createnm, menu_order)
		        VALUES ('$data[app_id]','$id', '$data[app_submenu_prefix]', '$data[app_menu_desc]', '#', '$data[status]',
		               '".$this->username."', '$data[menu_order]')";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Save User failed..!!", 1);
		} 
		return $query;
	 }
	 
	 function updateAppIdOnSubMenu($data) {
	 	$qry = "UPDATE app_tabprg SET app_id = '$data[app_id]'
		        WHERE app_menu_parent_id = '$data[id]'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Update Sub Menu failed..!!", 1);
		} 
		return $query;
	 }
	 
	 
	 function saveUpdateGroupMenu($data) {
		
		$qry = "UPDATE app_tabprg SET app_menu_desc = '$data[app_menu_desc]',
		              app_id = '$data[app_id]', status = '$data[status]',
		              menu_order = '$data[menu_order]'
		        WHERE app_menu_id = '$data[id]'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Update User failed..!!", 1);
		} 
		return $query;
	 }
	 
	 function deleteGroupMenu($id) {
	 	$qry = "DELETE FROM app_tabprg WHERE app_menu_id = '$id'";
		//echo $qry;
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Delete Group Menu failed..!!", 1);
		} 
		return $query;
	 }
	 
	 /*-----------------------
	  * SUB MENU
	  * ----------------------
	  */
	  
	 function getListAllSubMenu() {
	  	 $qry = "SELECT 
				  a.app_menu_id,
				  a.app_menu_desc,
				  b.app_menu_desc as group_menu,
				  a.menu_order
				 FROM
				  app_tabprg a
				  INNER JOIN app_tabprg b 
				  ON (a.app_menu_parent_id = b.app_menu_id)";
		 $res = $this->getRecordset($qry, NULL, $this->db1);
		 if($res == null) {
			throw new Exception("Data Application is empty..!", 1);
		 }
		 return $res;
	 }
	  
	 function getListSubMenu($param, $value) {
			$qry = "SELECT * FROM app_tabprg WHERE $param = '$value'";
			$res = $this->getRecordset($qry, NULL, $this->db1);
			if($res == null) {
				throw new Exception("No result", 1);
			}
			return $res;
	 }
	  
	 function saveInputSubMenu($menu_id, $data) {
		$qry = "INSERT INTO app_tabprg (app_id, app_menu_id, app_menu_parent_id, app_menu_desc, app_menu_url, status, createnm, menu_order)
		        VALUES ('$data[app_id]','$menu_id', '$data[app_menu_parent_id]', '$data[app_menu_desc]', '$data[app_menu_url]', '$data[status]',
		               '".$this->username."', '$data[menu_order]')";
		      
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Save Sub menu failed..!!", 1);
		} 
		return $query;		
	  }
	  
	  function saveUpdateSubMenu($data) {
	  	$qry = "UPDATE app_tabprg SET app_menu_desc = '$data[app_menu_desc]',
	  	              app_menu_url = '$data[app_menu_url]',
	  	              menu_order = '$data[menu_order]',
		              status = '$data[status]',
		              app_menu_parent_id = '$data[app_menu_parent_id]'
		        WHERE app_menu_id = '$data[id]'";
		$query = $this->executeQuery($qry);
		if(!$query) {			
			throw new Exception("Update User failed..!!", 1);
		} 
		return $query;
	  }
	  
	  
	  
	  /*------------------------------
	 * ACCESS MENU
	 *---------------------------- */
	 function deleteUserAuthByID($groupid) {
	 	$qry = "DELETE FROM ecomm_userauthority WHERE groupid = '$groupid'";
		//echo $qry;
		$query = $this->executeQuery($qry);
		
		return $query;
	 }
	 
	 function saveInputAccessMenu($data) {
		$jum = count($data['menuid']);
		$res = 0;
		for($i = 0; $i < $jum; $i++) {
           if($data['menuid'][$i] != "") {
                if(isset($data['add'][$i])) {
                	$add = "1";
                } else {
                	$add = "0";
                }	
				if(isset($data['edit'][$i])) {
                	$edit = "1";
                } else {
                	$edit = "0";
                }
				if(isset($data['view'][$i])) {
                	$view = "1";
                } else {
                	$view = "0";
                }
                if(isset($data['delete'][$i])) {
                	$delete = "1";
                } else {
                	$delete = "0";
                }
                $qry2 = "INSERT INTO ecomm_userauthority (groupid, menuid, toggle_add, toggle_edit, toggle_delete, toggle_view, createnm) 
                       VALUES ('$data[grpid]', '".$data['menuid'][$i]."', '$add', '$edit', '$view', '$delete', '".$this->username."')";
                
				//echo $qry2;
				//echo "<br />"; 
				//$query2 = $this->db->query($qry2);
				$query2 = $this->executeQuery($qry2);
				if(!$query2) {			
					throw new Exception("Save User Access failed..!!", 1);
				} else {
					$res++;
				} 
           }    
        } 
		
		if($res == $jum) {
			return true;
		} else {
			return false;
		} 
        
        
	 }
}