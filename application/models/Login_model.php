<?php

class Login_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getValidateLogin($formData) {

        $qry = "SELECT a.username, a.[password], a.groupid, a.branchid, 
                    b.groupname, c.loccd, c.sctype, 
                    c.pricecode, c.pricecodePvr , c.fullnm, d.kode_gudang
                FROM db_sco.dbo.ecomm_user a 
                INNER JOIN db_sco.dbo.ecomm_usergroup b 
                   ON(a.groupid = b.groupid)
                INNER JOIN klink_mlm2010.dbo.mssc  c 
                   ON (a.branchid = c.loccd COLLATE SQL_Latin1_General_CP1_CS_AS)
                LEFT OUTER JOIN klink_mlm2010.dbo.sc_users d 
                   ON (a.branchid = d.username COLLATE SQL_Latin1_General_CP1_CS_AS)
                WHERE a.username = '$formData[username]' AND a.password = '$formData[password]'";
        $res = $this->getRecordset($qry, NULL, $this->setDB(1));
        if ($res == null) {
            throw new Exception("Login failed, invalid username or password", 1);
        }
        return $res;
    }

    function fetchingMenu($usertype) {
        $dbx = $this->load->database("db_sco", TRUE);
        $qry = "SELECT 
                    db_sco.dbo.ecomm_userauthority.menuid as menu_id,
                    db_sco.dbo.app_tabprg.app_menu_parent_id as parent_id,
                    db_sco.dbo.app_tabprg.app_menu_desc as menu_desc,
                    db_sco.dbo.app_tabprg.app_menu_url as menu_url
                FROM
                    db_sco.dbo.ecomm_userauthority
                INNER JOIN db_sco.dbo.app_tabprg ON (db_sco.dbo.ecomm_userauthority.menuid = db_sco.dbo.app_tabprg.app_menu_id)
                WHERE
                    (db_sco.dbo.ecomm_userauthority.groupid = '$usertype')
                ORDER BY 
                    db_sco.dbo.app_tabprg.app_menu_parent_id, 
                    db_sco.dbo.app_tabprg.menu_order";
        //echo $qry;   
        $query = $dbx->query($qry);
        $menu = array('items' => array(), 'parents' => array());


        // Builds the array lists with data from the menu table
        foreach ($query->result_array() as $row) {
            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $menu['items'][$row['menu_id']] = $row;
            // Creates entry into parents array. Parents array contains a list of all items with children
            $menu['parents'][$row['parent_id']][] = $row['menu_id'];
        }
        return $menu;
    }

    function fetchingMenu2($usertype) {
        $dbx = $this->load->database("db_sco", TRUE);
        $qry = "SELECT 
                    dbo.ecomm_userauthority.menuid as menu_id,
                    dbo.app_tabprg.app_menu_parent_id as parent_id,
                    dbo.app_tabprg.app_menu_desc as menu_desc,
                    dbo.app_tabprg.app_menu_url as menu_url,
                    dbo.ecomm_userauthority.toggle_add as toogle_add,
                    dbo.ecomm_userauthority.toggle_edit as toogle_edit,
                    dbo.ecomm_userauthority.toggle_view as toogle_view,
                    dbo.ecomm_userauthority.toggle_delete as toogle_delete
                FROM
                    dbo.ecomm_userauthority
                INNER JOIN dbo.app_tabprg ON (dbo.ecomm_userauthority.menuid = dbo.app_tabprg.app_menu_id)
                WHERE
                    (dbo.ecomm_userauthority.groupid = '$usertype')
                ORDER BY dbo.app_tabprg.app_menu_parent_id, dbo.app_tabprg.menu_order";
        //echo $qry;   
        $query = $dbx->query($qry);
        $menu = array('items' => array(), 'parents' => array());


        foreach ($query->result_array() as $row) {
            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $menu['items'][$row['menu_id']] = $row;
            // Creates entry into parents array. Parents array contains a list of all items with children
            $menu['parents'][$row['parent_id']][] = $row['menu_id'];
        }

        return $menu;
    }

    function fetchingAllMenu() {
        $dbx = $this->load->database("db_sco", TRUE);
        $qry = "SELECT 
                    db_sco.dbo.app_tabprg.app_menu_id as menu_id,
                    db_sco.dbo.app_tabprg.app_menu_parent_id as parent_id,
                    db_sco.dbo.app_tabprg.app_menu_desc as menu_desc,
                    db_sco.dbo.app_tabprg.app_menu_url as menu_url
                FROM
                    db_sco.dbo.app_tabprg 
                ORDER BY 
                    db_sco.dbo.app_tabprg.app_menu_parent_id, 
                    db_sco.dbo.app_tabprg.menu_order";
        //echo $qry;   
        $query = $dbx->query($qry);
        $menu = array('items' => array(), 'parents' => array());


        // Builds the array lists with data from the menu table
        foreach ($query->result_array() as $row) {
            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $menu['items'][$row['menu_id']] = $row;
            // Creates entry into parents array. Parents array contains a list of all items with children
            $menu['parents'][$row['parent_id']][] = $row['menu_id'];
        }
        return $menu;
    }

    public function getListUserByRoleID($role, $menu_id, $type = "array") {
        $qry = "SELECT groupid as role_id, 
                       menuid as menu_id,
                       toggle_add,
                       toggle_edit,
                       toggle_delete,
                       toggle_view
                FROM ecomm_userauthority 
                WHERE groupid = '" . $role . "' AND menuid = '" . $menu_id . "'";
        //echo $qry;
        return $this->getRecordset($qry, NULL, $this->db1);
    }

}
