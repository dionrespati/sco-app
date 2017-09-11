<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userconfig_service extends MY_Service {

    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
		$this->load->model("login_model");
        $this->load->model("userconfig/Userconfig_model", "m_userconfig");
    }
	
	/*------------------------------
	 * ACCESS MENU
	 *---------------------------- */
	
	function fetchingMenuService() {
		$srvReturn = null;
		try {
			$srvReturn = $this->login_model->fetchingAllMenu();
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function getListUserByRoleID($roleid, $menuid) {
		$srvReturn = null;
		try {
			$srvReturn = $this->login_model->getListUserByRoleID($roleid, $menuid);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function inputAccessMenuService() {
		$data = $this->input->post(NULL, TRUE);	
		$srvReturn = null;
		try {
			$del = $this->m_userconfig->deleteUserAuthByID($data['grpid']);
			$modelReturn = $this->m_userconfig->saveInputAccessMenu($data);
			$srvReturn = jsonTrueResponse($modelReturn, "Saving Group User Config Menu Success..!!");
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	/*----------------
	 * USER GROUP
	 * --------------*/
	function listUserGroupService($param, $value) {	
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListUserGroup($param, $value);
			$srvReturn = jsonTrueResponse($modelReturn);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	
	
	function listAllUserGroupService() {
		$modelReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListAllUserGroup();		
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $modelReturn;
	}
	
	function listAllUserGroupServiceByID($id) {
		$modelReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListAllUserGroupByID($id);		
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $modelReturn;
	}
	
	function inputUserGroupService() {
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->saveInputUserGroup();
			$srvReturn = jsonTrueResponse($modelReturn, "Input User Group Success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function updateUserGroupService() {
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->updateUserGroup();
			$srvReturn = jsonTrueResponse($modelReturn, "Update User Group Success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function deleteUserGroupService($id) {
		$srvReturn = null;
		try {
		   $ifRoot = $this->m_userconfig->checkDataFromTable("groupid", "ecomm_usergroup", 1);	
		   $checkUser = $this->m_userconfig->checkDataFromTable("groupid", "ecomm_user", $id);
		   $checkUsrAuth = $this->m_userconfig->checkDataFromTable("groupid", "ecomm_userauthority", $id);
		   $modelReturn = $this->m_userconfig->deleteUserGroup($id);
		   $srvReturn = jsonTrueResponse($modelReturn,  "Delete User Group success..!!");
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);
		}	
		return $srvReturn;
	}
	
	/*------------------
	 * USER
	 ------------------*/
	
	function listAllUserService() {
		$modelReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListAllUser();		
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $modelReturn;
	}
	
	function listAllUserServiceByParam($param, $branchid) {
		$modelReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListAllUserByParam($param, $branchid);		
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $modelReturn;
	}
	
	function listUserService($param, $value) {	
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListUser($param, $value);
			$srvReturn = jsonTrueResponse($modelReturn);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function inputUserService() {
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->saveInputUser();
			$srvReturn = jsonTrueResponse($modelReturn, "Input User success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());	
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function updateUserService() {
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->saveUpdateUser();
			$srvReturn = jsonTrueResponse($modelReturn, "Update User Success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function deleteUserService($id) {
		$srvReturn = null;
		try {
		   $modelReturn = $this->m_userconfig->deleteUser($id);
		   $srvReturn = jsonTrueResponse($modelReturn,  "Delete User success..!!");
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);
		}	
		return $srvReturn;
	}
	
	/*------------------
	 * APPLICATION
	 ------------------*/
	
	function listAllApplicationService() {
		$modelReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListAllApplication();		
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $modelReturn;
	}
	
	function listApplicationService($param, $value) {	
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListApplication($param, $value);
			$srvReturn = jsonTrueResponse($modelReturn);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function inputApplicationService() {
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->saveInputApplication();
			$srvReturn = jsonTrueResponse($modelReturn, "Input Application success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());	
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function updateApplicationService() {
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->saveUpdateApplication();
			$srvReturn = jsonTrueResponse($modelReturn, "Update Application Success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function deleteApplicationService($id) {
		$srvReturn = null;
		try {
		   $checkUser = $this->m_userconfig->checkDataFromTable("app_id", "app_tabprg", $id);	
		   $modelReturn = $this->m_userconfig->deleteApplication($id);
		   $srvReturn = jsonTrueResponse($modelReturn,  "Delete Application success..!!");
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);
		}	
		return $srvReturn;
	}
	
	/*------------------
	 * GROUP MENU
	 ------------------*/
	
	function listAllGroupMenuService() {
		$modelReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListAllGroupMenu();		
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $modelReturn;
	}
	
	function listGroupMenuService($param, $value) {	
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListGroupMenu($param, $value);
			$srvReturn = jsonTrueResponse($modelReturn);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function inputGroupMenuService() {
		$srvReturn = null;
		try {
			$grpmenu_id = $this->m_userconfig->getMenuID();
			$modelReturn = $this->m_userconfig->saveInputGroupMenu($grpmenu_id);
			$srvReturn = jsonTrueResponse($modelReturn, "Input Group Menu success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());	
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function updateGroupMenuService() {
		$srvReturn = null;
		$data = $this->input->post(NULL, TRUE);
		try {
			$upd = $this->m_userconfig->updateAppIdOnSubMenu($data);
			$modelReturn = $this->m_userconfig->saveUpdateGroupMenu($data);
			$srvReturn = jsonTrueResponse($modelReturn, "Update Group Menu Success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function deleteGroupMenuService($id) {
		$srvReturn = null;
		try {
		   	
		   $checkUsrAuth = $this->m_userconfig->checkDataFromTable("menuid", "ecomm_userauthority", $id);	
		   $checkUser = $this->m_userconfig->checkDataFromTable("app_menu_parent_id", "app_tabprg", $id);	
		   $modelReturn = $this->m_userconfig->deleteGroupMenu($id);
		   $srvReturn = jsonTrueResponse($modelReturn,  "Delete Group Menu success..!!");
		} catch(Exception $e) {
		   throw new Exception($e->getMessage(), 1);
		}	
		return $srvReturn;
	}
	
	/*------------------
	 * SUB MENU
	 ------------------*/
	
	function listAllSubMenuService() {
		$modelReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListAllSubMenu();		
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $modelReturn;
	}
	
	function listSubMenuService($param, $value) {	
		$srvReturn = null;
		try {
			$modelReturn = $this->m_userconfig->getListSubMenu($param, $value);
			$srvReturn = jsonTrueResponse($modelReturn);
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function inputSubMenuService() {
		$data = $this->input->post(NULL, TRUE);	
		$srvReturn = null;
		try {
			$menu_id = $this->m_userconfig->getMenuID($data['app_submenu_prefix']);
			//print_r($menu_id);
			$modelReturn = $this->m_userconfig->saveInputSubMenu($menu_id, $data);
			$srvReturn = jsonTrueResponse($modelReturn, "Input Sub Menu success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());	
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function updateSubMenuService() {
		$srvReturn = null;
		$data = $this->input->post(NULL, TRUE);
		try {
			$modelReturn = $this->m_userconfig->saveUpdateSubMenu($data);
			$srvReturn = jsonTrueResponse($modelReturn, "Update Sub Menu Success..!!");
		} catch(Exception $e) {
			$srvReturn = $this->jsonFalseResponse($e->getMessage());
			throw new Exception($e->getMessage(), 1);		
		}	
		return $srvReturn;
	}
	
	function deleteSubMenuService($id) {
		$srvReturn = null;
		try {
		   $checkUsrAuth = $this->m_userconfig->checkDataFromTable("menuid", "ecomm_userauthority", $id);	
		   $modelReturn = $this->m_userconfig->deleteGroupMenu($id);
		   $srvReturn = jsonTrueResponse($modelReturn,  "Delete Sub Menu success..!!");
		} catch(Exception $e) {
			throw new Exception($e->getMessage(), 1);
		}	
		return $srvReturn;
	}
}