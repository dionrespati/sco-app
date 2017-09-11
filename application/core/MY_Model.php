<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Model extends CI_Model {
    var $db1;
	var $db2;
	
	function __construct() {
		log_message('debug', "Model Class Initialized");
	    $this->db1 = $this->setDB(1); 
		$this->db2 = $this->setDB(2);
		/*$this->db3 = $this->setDB(3);
		$this->db4 = $this->setDB(4);
        $this->db5 = $this->setDB(5);
		$this->db6 = $this->setDB(6);
		$this->db7 = $this->setDB(7); */
		$this->dateTime = date("Y-m-d h:m:s");
		$this->ip = $_SERVER['REMOTE_ADDR'];
		//$this->username = $this->session->userdata('user_scoapp');
		$this->username = $this->session->userdata('user_scoapp');	
		$this->groupid = $this->session->userdata('group_scoapp');
		$this->usergroup = $this->session->userdata('groupnm_scoapp');
		$this->stockist = $this->session->userdata('stockist');
		$this->stockistnm = $this->session->userdata('stockistnm');
		$this->pricecode = $this->session->userdata('pricecode');	
		$this->pricecode = $this->session->userdata('pricecode');
		$this->kodegudang = $this->session->userdata('kodegudang');
	} 
	
	function setDB($i) {
		if($i == 1) {
			return "db_sco";
		} elseif ($i == 2) {
			return "klink_mlm2010";
		} elseif ($i == 3) {
			return "alternate2";
		} /*elseif ($i == 4) {
			return "tes_newera4";
		} elseif ($i == 5){
		  return "db_test";
		} elseif ($i == 6){
		  return "pdo_tes_newera4";
		} elseif ($i == 7){
		  return "data_mining";
		}*/
	}
	 
	
	
	function getRecordset($qry, $qryParam = null, $choose_db = 'db_sco') {
		$nilai = null;	
		//if($choose_db != 'db_ecommerce')	{
        	$this->db = $this->load->database($choose_db, true);
		//}	
        $query = $this->db->query($qry, $qryParam); 
		if ($query !== FALSE) { 
			if($query->num_rows() > 0)  {
            $nilai = $query->result();   
          }
		} 
        return $nilai;  
	}
    
    
	
	function getRecordsetPDO($qry, $qryParam = null, $choose_db = 'db_sco') {
		$this->db = $this->load->database($choose_db, true);
	    $q = $this->db->conn_id->prepare($qry);
		$q->execute($qryParam);
		$arr = array(
		        "rowCount" => $q->rowCount(),
		        "arrayData" => $q->fetchAll(PDO::FETCH_CLASS));	
	    return $arr;
	}
	
	function executeQuery($qry, $choose_db = 'db_sco') {
		//if ($choose_db != 'default') {
	    $this->db = $this->load->database($choose_db, true);
	    //}
	    $query = $this->db->query($qry);
	    return $this->db->affected_rows();
	}
	
	
    
    
	public function checkDataFromTable($param, $fromTable, $value) {
		$qry = "SELECT $param FROM $fromTable WHERE $param = '$value'";
		$res = $this->getRecordset($qry, null, $this->db1);
		if($res != null) {
			throw new Exception("Data related to table $fromTable, please check..!!", 1);
		}
		return $res;
	}
	
	public function checkExistingRecord($arr) {
		$qry = "SELECT $arr[param] FROM $arr[table] WHERE $arr[param] = '".$arr['value']."'";
		$res = $this->getRecordset($qry, null, $arr['db']);
		return $res;
	}
	
	function getValidDistributor($idmember) {
        $qry = "SELECT fullnm FROM klink_mlm2010.dbo.msmemb WHERE dfno = '$idmember' 
                and fullnm not like 'RESIGNATION%'
                and fullnm not like 'TERMINATION%'
                and status = '1'";
        return $this->getRecordset($qry, null, $this->db1);
    }
    
    function getWHList(){
        $qry = "SELECT whcd,description FROM mswh";				
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
    }
    
    function getStkList(){
         $qry = "select distinct a.idstk,b.fullnm,b.addr1,b.addr2,b.tel_hm,b.tel_hp
                 from ecomm_trans_hdr a 
                 left join klink_mlm2010.dbo.mssc b on (a.idstk = b.loccd COLLATE SQL_Latin1_General_CP1_CS_AS)
                 order by a.idstk asc";
         $res = $this->getRecordset($qry);
		return $res;
    }
	
	function getCurrentPeriod() // dipake
    {
        $qry = "SELECT a.currperiodSCO as lastperiod, 
                DATEADD(month, 1, a.currperiodSCO) as nextperiod 
                from klink_mlm2010.dbo.syspref a";
        $res = $this->getRecordset($qry, null, $this->db2);
		return $res;
    }
    
    function updateTable($table, $data, $primary) {
	    //$primaryKey = $this->getPrimaryKey($table);
	
	    $arrKey = "";
	    $arrVal = "";
	    $arrayname = array();
	    foreach($data as $key => $value) {
	      if($key != $primary) {
	        $arrKey .= $key." = :".$key.",";
	        $arrValX = ":".$key;
	        if ($this->isLocalDate($value)) {
	          $value = $this->reverseDate($value);
	        }
	        $arrayname[$arrValX] = $value;
	      }
	    }
	    $arrKey = substr($arrKey, 0, -1);
	    $arrVal = substr($arrVal, 0, -1);
	    $arrayname[':data_id'] = $data['data_id'];
	    $where = " WHERE ".$primaryKey." = :data_id";
	    $upd = "UPDATE $table SET "." ".$arrKey.$where;
	    //$hasil = $this->executeQuery($upd, $arrayname);
	    //return $hasil;
	    echo $upd;
   }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */