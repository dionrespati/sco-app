<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userconfig extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "userconfig/";
        $this->load->service('userconfig/Userconfig_service', 's_userconfig');
    }

    /* --------------------
     * USER GROUP
     * ------------------- */

    //$route['user/group'] = 'backend/userconfig/getInputUserGroup';
    public function getInputUserGroup() {
        $data['form_header'] = "Input User Group";
        $data['form_action'] = base_url('user/group');
        $data['icon'] = "icon-pencil";
        $data['form_reload'] = 'user/group';

        if ($this->username != null) {
            $this->setTemplate($this->folderView . 'getInputUserGroup', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['user/group/list/(:any)/(:any)'] = 'backend/userconfig/getListUserGroup/$1/$2';
    public function getListUserGroup($param, $value) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listUserGroupService($param, $value);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['user/group/list'] = 'backend/userconfig/getListAllUserGroup';
    public function getListAllUserGroup($type = "array") {
        $data['listUserGroup'] = null;
        try {
            $data['listUserGroup'] = $this->s_userconfig->listAllUserGroupService();
        } catch (Exception $e) {
            
        }
        if ($type == "array") {
            $this->load->view($this->folderView . 'getListAllUserGroup', $data);
        } else {
            echo json_encode(jsonTrueResponse($data['listUserGroup']));
        }
    }

    //$route['user/group/id/(:any)'] = 'backend/userconfig/getListUserGroupByID/$1';
    public function getListUserGroupByID($id) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listUserGroupService("groupid", $id);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['user/group/save'] = 'backend/userconfig/saveInputUserGroup';
    public function saveInputUserGroup() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('user/group') == TRUE) {
                $srvReturn = $this->s_userconfig->inputUserGroupService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['user/group/update'] = 'backend/userconfig/saveUpdateUserGroup';
    public function saveUpdateUserGroup() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('user/group') == TRUE) {
                $srvReturn = $this->s_userconfig->updateUserGroupService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['user/group/delete/(:any)'] = 'backend/userconfig/deleteUserGroup/$1';
    public function deleteUserGroup($id) {
        $srvReturn = null;
        try {
            $srvReturn = $this->s_userconfig->deleteUserGroupService($id);
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    /* --------------------
     * USER 
     * ------------------- */

    //$route['user'] = 'backend/userconfig/getInputUser';
    public function getInputUser() {
        $data['form_header'] = "Input User";
        $data['form_action'] = base_url('user');
        $data['icon'] = "icon-pencil";
        $data['form_reload'] = 'user';

        if ($this->username != null) {
            $opt = "";
            if ($this->stockist == "BID06") {
                $data['listUserGroup'] = $this->s_userconfig->listAllUserGroupService();
                $data['deptid'] = "";
                $data['readonly'] = null;
                $data['refresh'] = "Userconfig.refreshListUserGroup(' #groupid')";
                $data['btnViewAct'] = "All.getListData('user/list')";
                foreach ($data['listUserGroup'] as $list) {
                    $opt .= "<option value=\"$list->groupid\">$list->groupname</option>";
                }
            } else {
                $data['listUserGroup'] = $this->s_userconfig->listAllUserGroupServiceByID($this->groupid);
                $data['deptid'] = $this->stockist;
                $data['readonly'] = true;
                $data['refresh'] = "";
                $data['btnViewAct'] = "All.getListData('user/param/branchid/$this->stockist')";
                foreach ($data['listUserGroup'] as $list) {
                    $opt .= "<option value=\"$list->groupid\">$list->groupname</option>";
                }
            }
            $data['branchid'] = $this->stockist;

            $data['opt'] = $opt;
            $this->setTemplate($this->folderView . 'getInputUser', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['user/list'] = 'backend/userconfig/getListAllUser';
    public function getListAllUser() {
        $data['listUser'] = null;
        try {
            $data['listUser'] = $this->s_userconfig->listAllUserService();
        } catch (Exception $e) {
            
        }
        $this->load->view($this->folderView . 'getListAllUser', $data);
    }

    //$route['user/param/(:any)/(:any)'] = 'userconfig/userconfig/getListAllUserByParam/$1/$2';
    public function getListAllUserByParam($param, $branchid) {
        $data['listUser'] = null;
        try {
            $data['listUser'] = $this->s_userconfig->listAllUserServiceByParam($param, $branchid);
        } catch (Exception $e) {
            
        }
        $this->load->view($this->folderView . 'getListAllUser', $data);
    }

    //$route['user/id/(:any)'] = 'backend/userconfig/getListUserByID/$1';
    public function getListUserByID($id) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listUserService("username", $id);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['user/list/(:any)/(:any)'] = 'backend/userconfig/getListUser/$1/$2';
    public function getListUser($param, $value) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listUserService($param, $value);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['user/save'] = 'backend/userconfig/saveInputUser';
    public function saveInputUser() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('user') == TRUE) {
                $srvReturn = $this->s_userconfig->inputUserService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['user/update'] = 'backend/userconfig/saveUpdateUser';
    public function saveUpdateUser() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('user') == TRUE) {
                $srvReturn = $this->s_userconfig->updateUserService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['user/delete/(:any)'] = 'backend/userconfig/deleteUser/$1';
    public function deleteUser($id) {
        $srvReturn = null;
        try {
            $srvReturn = $this->s_userconfig->deleteUserService($id);
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    /* --------------------
     * APPLICATION
     * ------------------- */

    //$route['app'] = 'backend/userconfig/getInputNewApplication';
    public function getInputApplication() {
        $data['form_header'] = "Input Application";
        $data['form_action'] = base_url('app/save');
        $data['icon'] = "icon-pencil";
        $data['form_reload'] = 'app';

        if ($this->username != null) {
            $this->setTemplate($this->folderView . 'getInputApplication', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['app/list'] = 'backend/userconfig/getListAllApplication';
    //$route['app/list/json'] = 'backend/userconfig/getListAllApplication/$1';
    public function getListAllApplication($type = "array") {
        $data['listApp'] = null;
        try {
            $data['listApp'] = $this->s_userconfig->listAllApplicationService();
        } catch (Exception $e) {
            
        }
        if ($type == "array") {
            $this->load->view($this->folderView . 'getListAllApplication', $data);
        } else {
            echo json_encode(jsonTrueResponse($data['listApp']));
        }
    }

    //$route['app/id/(:any)'] = 'backend/userconfig/getListApplicationByID/$1';
    public function getListApplicationByID($id) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listApplicationService("app_id", $id);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['app/list/(:any)/(:any)'] = 'backend/userconfig/getListApplication/$1/$2';
    public function getListApplication($param, $value) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listApplicationService($param, $value);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['app/save'] = 'backend/userconfig/saveInputApplication';
    public function saveInputApplication() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('app') == TRUE) {
                $srvReturn = $this->s_userconfig->inputApplicationService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['app/update'] = 'backend/userconfig/saveUpdateApplication';
    public function saveUpdateApplication() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('app') == TRUE) {
                $srvReturn = $this->s_userconfig->updateApplicationService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['app/delete/(:any)'] = 'backend/userconfig/deleteApplication/$1';
    public function deleteApplication($id) {
        $srvReturn = null;
        try {
            $srvReturn = $this->s_userconfig->deleteApplicationService($id);
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    /* --------------------
     * GROUP MENU
     * ------------------- */

    //$route['menu/group'] = 'backend/userconfig/getInputGroupMenu';
    public function getInputGroupMenu() {
        $data['form_header'] = "Input Group Menu";
        $data['icon'] = "icon-pencil";
        $data['form_reload'] = 'menu/group';

        if ($this->username != null) {
            $data['listApp'] = $this->s_userconfig->listAllApplicationService();
            $this->setTemplate($this->folderView . 'getInputGroupMenu', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['menu/group/list'] = 'backend/userconfig/getListAllGroupMenu';
    //$route['menu/group/list/json'] = 'backend/userconfig/getListAllGroupMenu/$1';
    public function getListAllGroupMenu($type = "array") {
        $data['listGroupMenu'] = null;
        try {
            $data['listGroupMenu'] = $this->s_userconfig->listAllGroupMenuService();
        } catch (Exception $e) {
            
        }
        if ($type == "array") {
            $this->load->view($this->folderView . 'getListAllGroupMenu', $data);
        } else {
            echo json_encode(jsonTrueResponse($data['listGroupMenu']));
        }
    }

    //$route['menu/group/id/(:any)'] = 'backend/userconfig/getListGroupMenuByID/$1';
    public function getListGroupMenuByID($id) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listGroupMenuService("app_menu_id", $id);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/group/list/(:any)/(:any)'] = 'backend/userconfig/getListGroupMenu/$1/$2';
    public function getListGroupMenu($param, $value) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listGroupMenuService($param, $value);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/group/save'] = 'backend/userconfig/saveInputGroupMenu';
    public function saveInputGroupMenu() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('menu/group') == TRUE) {
                $srvReturn = $this->s_userconfig->inputGroupMenuService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/group/update'] = 'backend/userconfig/saveUpdateGroupMenu';
    public function saveUpdateGroupMenu() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('menu/group') == TRUE) {
                $srvReturn = $this->s_userconfig->updateGroupMenuService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/group/delete/(:any)'] = 'backend/userconfig/deleteGroupMenu/$1';
    public function deleteGroupMenu($id) {
        $srvReturn = null;
        try {
            $srvReturn = $this->s_userconfig->deleteGroupMenuService($id);
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    /* --------------------
     * SUB MENU
     * ------------------- */

    //$route['menu'] = 'backend/userconfig/getInputSubMenu';
    public function getInputSubMenu() {
        $data['form_header'] = "Input Sub Menu";
        $data['icon'] = "icon-pencil";
        $data['form_reload'] = 'menu';

        if ($this->username != null) {
            $data['listGroupMenu'] = $this->s_userconfig->listAllGroupMenuService();
            $this->setTemplate($this->folderView . 'getInputSubMenu', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['menu/list'] = 'backend/userconfig/getListAllSubMenu';
    //$route['menu/list/json'] = 'backend/userconfig/getListAllSubMenu/$1';
    public function getListAllSubMenu($type = "array") {
        $data['listSubMenu'] = null;
        try {
            $data['listSubMenu'] = $this->s_userconfig->listAllSubMenuService();
        } catch (Exception $e) {
            
        }
        if ($type == "array") {
            $this->load->view($this->folderView . 'getListAllMenu', $data);
        } else {
            echo json_encode(jsonTrueResponse($data['listSubMenu']));
        }
    }

    //$route['menu/id/(:any)'] = 'backend/userconfig/getListSubMenuByID/$1';
    public function getListSubMenuByID($id) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listSubMenuService("app_menu_id", $id);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/list/(:any)/(:any)'] = 'backend/userconfig/getListSubMenu/$1/$2';
    public function getListSubMenu($param, $value) {
        $srvReturn = jsonFalseResponse();
        try {
            $srvReturn = $this->s_userconfig->listSubMenuService($param, $value);
        } catch (Exception $e) {
            
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/save'] = 'backend/userconfig/saveInputSubMenu';
    public function saveInputSubMenu() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('menu') == TRUE) {
                $srvReturn = $this->s_userconfig->inputSubMenuService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/update'] = 'backend/userconfig/saveUpdateSubMenu';
    public function saveUpdateSubMenu() {
        $srvReturn = jsonFalseResponse(requiredFieldMessage());
        try {
            if ($this->form_validation->run('menu') == TRUE) {
                $srvReturn = $this->s_userconfig->updateSubMenuService();
            }
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    //$route['menu/delete/(:any)'] = 'backend/userconfig/deleteSubMenu/$1';
    public function deleteSubMenu($id) {
        $srvReturn = null;
        try {
            $srvReturn = $this->s_userconfig->deleteSubMenuService($id);
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

    /* ---------------------------
     * USER ACCESS MENU 
     * -------------------------- */

    private function buildMenu($parent, $menu, $roleid) {

        $html = "";
        if (isset($menu['parents'][$parent])) {
            //$html .= "</br>";
            $s = 0;
            foreach ($menu['parents'][$parent] as $itemId) {
                //echo $menu['items'][$itemId]['menu_id'];
                //echo "<br />";
                //echo $roleid; 
                $exist = $this->s_userconfig->getListUserByRoleID($roleid, $menu['items'][$itemId]['menu_id']);
                //$exist = $this->m_admuser->getListUserByRoleID($roleid, "10");
                $bt_chk = "";
                $bt_unchk = "";
                if ($exist != null) {
                    if ($exist[0]->toggle_add == "1") {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_add\" name=\"add[]\" value=\"" . $exist[0]->toggle_add . "\" checked=\"checked\" onclick=\"All.setValCheck(this)\" />&nbsp;Add</div></td>";
                    } else {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_add\" name=\"add[]\" value=\"" . $exist[0]->toggle_add . "\" onclick=\"All.setValCheck(this)\" />&nbsp;Add</div></td>";
                    }

                    if ($exist[0]->toggle_edit == "1") {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_edit\" name=\"edit[]\" value=\"" . $exist[0]->toggle_edit . "\" checked=\"checked\"  onclick=\"All.setValCheck(this)\"/>&nbsp;Edit</div></td>";
                    } else {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_edit\" name=\"edit[]\" value=\"" . $exist[0]->toggle_edit . "\"  onclick=\"All.setValCheck(this)\"/>&nbsp;Edit</div></td>";
                    }

                    if ($exist[0]->toggle_view == "1") {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_view\" name=\"view[]\" value=\"" . $exist[0]->toggle_view . "\" checked=\"checked\" onclick=\"All.setValCheck(this)\" />&nbsp;View</div></td>";
                    } else {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_view\" name=\"view[]\" value=\"" . $exist[0]->toggle_view . "\" onclick=\"All.setValCheck(this)\" />&nbsp;View</div></td>";
                    }

                    if ($exist[0]->toggle_delete == "1") {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_delete\" name=\"delete[]\" value=\"" . $exist[0]->toggle_delete . "\" checked=\"checked\" onclick=\"All.setValCheck(this)\" />&nbsp;Delete</div></td>";
                    } else {
                        $bt_chk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_delete\" name=\"delete[]\" value=\"" . $exist[0]->toggle_delete . "\" onclick=\"All.setValCheck(this)\" />&nbsp;Delete</div></td>";
                    }
                } else {
                    $bt_unchk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_add\" name=\"add[]\" value=\"0\" onclick=\"All.setValCheck(this)\" />&nbsp;Add</div></td>";
                    $bt_unchk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_edit\" name=\"edit[]\" value=\"0\" onclick=\"All.setValCheck(this)\" />&nbsp;Edit</div></td>";
                    $bt_unchk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_view\" name=\"view[]\" value=\"0\" onclick=\"All.setValCheck(this)\" />&nbsp;View</div></td>";
                    $bt_unchk .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_delete\" name=\"delete[]\" value=\"0\" onclick=\"All.setValCheck(this)\" />&nbsp;Delete</div></td>";
                }


                $ss = site_url();
                //echo $exist;
                if (!isset($menu['parents'][$itemId])) {
                    if ($exist != null) {
                        //echo 1;	
                        $html .= "<tr>";
                        $html .= "<td><div align=center><input type=\"checkbox\" class=\"acc_checkmenu\" name=\"menuid[]\" value=\"" . $menu['items'][$itemId]['menu_id'] . "\" checked=\"checked\" /></div></td><td>" . $menu['items'][$itemId]['menu_desc'] . "</td>";
                        $html .= $bt_chk;
                        $html .= "</tr>";

                        //$html ."";
                    } else {
                        //echo 2;	  	
                        $html .= "<tr>";
                        $html .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_checkmenu\" name=\"menuid[]\" value=\"" . $menu['items'][$itemId]['menu_id'] . "\" /></div></td><td>" . $menu['items'][$itemId]['menu_desc'] . "</td>";
                        $html .= $bt_unchk;

                        $html .= "</tr>";
                    }

                    //$arr = array($menu['items'][$itemId]['menu_id'] => $menu['items'][$itemId]['menu_name']);   
                }

                if (isset($menu['parents'][$itemId])) {
                    //<li><input type=\"checkbox\" id=\"item-$s\"/><label for=\"item-$s\">".$menu['items'][$itemId]['menu_name']."</label>";
                    //$html .= "<tr bgcolor=\"lightgrey\"><td><input type=\"checkbox\" name=\"menuid\" value=\"".$menu['items'][$itemId]['menu_id']."\" />&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$menu['items'][$itemId]['menu_name']."</td></tr>";
                    if ($exist != null) {
                        //echo 3;	  	
                        $html .= "<tr bgcolor=\"lightgrey\">";
                        $html .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_checkmenu\" name=\"menuid[]\" value=\"" . $menu['items'][$itemId]['menu_id'] . "\" checked=\"checked\" /></div></td><td><strong>" . $menu['items'][$itemId]['menu_desc'] . "</strong></td>";
                        $html .= "<td colspan=4>";
                        $html .= "<input type=\"hidden\" class=\"acc_add\" name=\"add[]\" value=\"1\"  />";
                        $html .= "<input type=\"hidden\" class=\"acc_edit\" name=\"edit[]\" value=\"1\"  />";
                        $html .= "<input type=\"hidden\" class=\"acc_view\" name=\"view[]\" value=\"1\"  />";
                        $html .= "<input type=\"hidden\" class=\"acc_delete\" name=\"delete[]\" value=\1\"  />";
                        $html .= "</td>";
                        $html .= "</tr>";
                    } else {
                        $html .= "<tr bgcolor=\"lightgrey\">";
                        $html .= "<td ><div align=center><input type=\"checkbox\" class=\"acc_checkmenu\" name=\"menuid[]\" value=\"" . $menu['items'][$itemId]['menu_id'] . "\" /></div></td><td><strong>" . $menu['items'][$itemId]['menu_desc'] . "</strong></td>";

                        $html .= "<td colspan=4>";
                        $html .= "<input type=\"hidden\" class=\"acc_add\" name=\"add[]\" value=\"1\" />";
                        $html .= "<input type=\"hidden\" class=\"acc_edit\" name=\"edit[]\" value=\"1\" />";
                        $html .= "<input type=\"hidden\" class=\"acc_view\" name=\"view[]\" value=\"1\" />";
                        $html .= "<input type=\"hidden\" class=\"acc_delete\" name=\"delete[]\" value=\"1\" />";
                        $html .= "</td>";
                        $html .= "</tr>";
                    }
                    //$arr = array($menu['items'][$itemId]['menu_id'] => $menu['items'][$itemId]['menu_name']);
                    $html .= $this->buildMenu($itemId, $menu, $roleid);
                }

                $s++;
            }
            //$html .= "</br>"; 
        }
        return $html;
        //return $arr;
    }

    //$route['menu/access'] = 'backend/userconfig/getInputAccessMenu';
    public function getInputAccessMenu() {
        $data['form_header'] = "Setting User Access Menu";
        $data['icon'] = "icon-pencil";
        $data['form_reload'] = 'menu/access';

        if ($this->username != null) {
            $data['listGroupUser'] = $this->s_userconfig->listAllUserGroupService();
            $this->setTemplate($this->folderView . 'getInputAccessMenu', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['menu/check'] = 'backend/userconfig/getShowListMenuByGroupID';
    public function getShowListMenuByGroupID() {
        $groupid = $this->input->post('groupid');
        $menu = $this->s_userconfig->fetchingMenuService();
        //print_r($menu);
        $data['grpid'] = $groupid;
        $data['res'] = $this->buildMenu(0, $menu, $groupid);
        $this->load->view($this->folderView . 'getListMenuConfig', $data);
    }

    //$route['menu/access/save'] = 'backend/userconfig/saveInputAccessMenu';
    public function saveInputAccessMenu() {
        $srvReturn = null;
        try {
            $srvReturn = $this->s_userconfig->inputAccessMenuService();
        } catch (Exception $e) {
            $srvReturn = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($srvReturn);
    }

}
