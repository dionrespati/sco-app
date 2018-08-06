<?php

class Be_api_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function checkValidIdMember($idsponsor) {
        $qry = "select fullnm, state from klink_mlm2010.dbo.msmemb 
                where dfno = '$idsponsor' and fullnm not like 'RESIGNATION%'
                and fullnm not like 'TERMINATION%'
                and status = '1'";

        $res = $this->getRecordset($qry, null, $this->db2);
        if ($res == null) {
            throw new Exception("ID Member $idsponsor tidak valid / TERMINATION", 1);
        }
        return $res;
    }

    function get100Member() {
        $qry = "select top 10 dfno, fullnm, tel_hp, loccd FROM msmemb";

        $res = $this->getRecordset($qry, null, $this->db2);
        return $res;
    }

    function memberCheckExistingRecordByField($field, $value) {
        $err = "";
        if ($field == "idno") {
            $err .= "No KTP $value sudah terdaftar : ";
        } elseif ($field == "tel_hp") {
            $err .= "Telp HP $value sudah terdaftar : ";
        } elseif ($field == "dfnotemp") {
            $err .= "No Aplikasi $value sudah terdaftar : ";
        }
        $qry = "select dfno, fullnm 
		        from msmemb 
                where $field = '$value'";

        $res = $this->getRecordset($qry, null, $this->db2);
        if ($res != null) {
            $err .= $res[0]->dfno . " / " . $res[0]->fullnm;
            throw new Exception($err, 1);
        }
        return $res;
    }

    function getSelectedFieldFromTable($arr) {
        $qry = "SELECT $arr[retrieveField] 
    	        FROM $arr[tableName] 
    	        WHERE $arr[fieldName] = '$arr[paramValue]'";
        //echo $qry;		
        $res = $this->getRecordset($qry, null, $arr['db']);
        if ($res == null) {
            throw new Exception("Record with ID $arr[paramValue] doesn't exist in table $arr[tableName]", 1);
        }
        return $res;
    }

    function getDataWithSpecificField($arr) {
        $qry = "SELECT * 
    	        FROM $arr[tableName] 
    	        WHERE $arr[fieldName] = '$arr[paramValue]'";
        //echo $qry;		
        $res = $this->getRecordset($qry, null, $arr['db']);
        if ($res == null) {
            throw new Exception("Record with ID $arr[paramValue] doesn't exist in table $arr[tableName]", 1);
        }
        return $res;
    }

    function getDetailEmail($id) {
        $qry = "SELECT * 
    	        FROM V_HILAL_LIST_FOR_EMAIL 
    	        WHERE MemberID = '$id'";
        //echo $qry;		
        $res = $this->getRecordset($qry, null, $this->db2);
        if ($res == null) {
            throw new Exception("No result", 1);
        }
        return $res;
    }

    function getAllFieldFromTable($arr) {
        $qry = "SELECT * 
    	        FROM $arr[tableName] 
    	        WHERE $arr[fieldName] = '$arr[paramValue]'";
        //echo $qry;		
        $res = $this->getRecordset($qry, null, $arr['db']);
        if ($res == null) {
            throw new Exception("Record with ID $arr[paramValue] doesn't exist in table $arr[tableName]", 1);
        }
        return $res;
    }

    function deleteFromTablexx($arr) {
        $qry = "DELETE FROM $arr[tableName] WHERE $arr[fieldName] = '$arr[paramValue]'";
        $res = $this->executeQuery($qry, $arr['db']);
        if ($res < 1) {
            throw new Exception("Record with value $arr[paramValue] is failed to be deleted..", 1);
        }
        return $res;
    }

    function membLogin($username, $password) {
        $month = date("m") - 1;
        $year = date("Y");
        $tgl = $year . "-" . $month . "-" . "01";
        $qry = "SELECT a.dfno, a.idno, a.fullnm, a.sponsorid, a.bnsstmsc, 
					   a.password, a.email, a.tel_hp
				FROM msmemb a
				WHERE a.dfno = '$username' and a.password = '$password'";
        //echo $qry;
        $res = $this->getRecordset($qry, null, $this->db2);
        return $res;
    }

}
