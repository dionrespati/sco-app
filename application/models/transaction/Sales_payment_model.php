<?php
class Sales_payment_model extends MY_Model {
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
	
	function getBank(){
        $slc = "select * from ecomm_bank WHERE status = '1' order by bankDesc";
        $result = $this->getRecordset($slc,null, $this->db3);
        return $result;
    }
	
	function getCurrentPeriodSCO() {
		$qry = "select 
				  CONVERT(VARCHAR(10), a.currPeriodSCO, 103) AS currPeriodSCO,
				  CONVERT(VARCHAR(10), a.currPeriodSCO, 120) AS currPeriodSCO2 
				from syspref a";
		$result = $this->getRecordset($qry, null, $this->db2);
        if($result == null) {
        	throw new Exception("Bns period tidak ditemukan", 1);
        }
		return $result;
	}
	
	function getAuthStk($data) {
		$qry = "SELECT a.username, a.[password], b.fullnm
				FROM sc_users a INNER JOIN mssc b ON (a.username = b.loccd)
				WHERE a.username = '$data[username]' and a.[password] = '$data[password]'";
		$result = $this->getRecordset($qry, null, $this->db2);
        if($result == null) {
        	throw new Exception("Data Transaksi stokis tidak ditemukan", 1);
        }
		return $result;
	}
	
	function getListTrxToPay($data) {
		$qry = "SELECT * FROM DION_list_ungenerated_ssr 
		        WHERE sc_co = '$data[idstk]' 
		        AND bnsperiod2 = '$data[bnsperiod]' 
		        AND etdt_a >= '$data[from]' AND etdt_a <= '$data[to]'";
		$result = $this->getRecordset($qry, null, $this->db3);
		return $result;
	}
	
	function getDetailTTPbySSRno($ssrno) {
		$qry = "SELECT a.trcd, a.batchno, a.ndp, a.nbv,a.dfno, b.fullnm, a.sc_dfno, a.sc_co, a.loccd 
				FROM klink_mlm2010.dbo.sc_newtrh a
				INNER JOIN klink_mlm2010.dbo.msmemb b ON (a.dfno = b.dfno)
				WHERE a.batchno = '$ssrno'";
		$result = $this->getRecordset($qry, null, $this->db2);	
		return $result;
	}
	
	function getListSelectedSSR($data) {
		$qry = "SELECT batchno, ndp, nbv, sc_dfno, sc_co, loccd, sc_type, pricecode FROM DION_list_ungenerated_ssr 
		        WHERE batchno IN ($data)";
		$result = $this->getRecordset($qry, null, $this->db3);
        if($result == null) {
        	throw new Exception("SSR tidak tidak ditemukan", 1);
        }
		
		//return $result;
		return $result;
	}
	
	function saveTempPayStl($resx, $res) {
		$totdp = 0;
		$totbv = 0;
		$totDet = 0;
		$recSuccess = 0;
		$login = $this->session->userdata('login');
		foreach($resx as $dta) {
			$insDetail = "INSERT into stk_pay_det_sgo (sgo_token, ssr_no, total_dp, total_bv, 
			                 sc_dfno, sc_co, loccd, sc_type, pricecode) 
			              VALUES ('".$res['payID']."', '".$dta->batchno."', ".$dta->ndp.", ".$dta->nbv.", 
			                 '".$dta->sc_dfno."', '".$dta->sc_co."', '".$dta->loccd."', '".$dta->sc_type."', '".$dta->pricecode."')";
			$totdp = $totdp + (int) $dta->ndp;
			$totbv = $totbv + (int) $dta->nbv;
			
			$exeInsDet = $this->executeQuery($insDetail, $this->db3);
			if($exeInsDet > 0) {
				$recSuccess++;
			}
			$totDet++;
		}			  
		$insHeader = "INSERT into stk_pay_hdr_sgo (co_stk, sgo_token, total_pay_ssr, totbv, charge_connectivity, 
		                   charge_admin, user_login, pay_tipe, bnsperiod, pricecode) 
		              VALUES ('".$res['idstk']."', '".$res['payID']."', $totdp, $totbv, ".$res['charge_connectivity'].", 
		                   ".$res['charge_admin'].", '".$login['username']."', ".$res['bankid'].", '".$res['bnsperiod']."', '".$resx[0]->pricecode."')";
		              
		$exeInsHead= $this->executeQuery($insHeader, $this->db3);
		
		if($exeInsHead > 0 && $totDet == $recSuccess) {
			return true;
		} else {
			return false;
		}
	}

	function getStkPayHeader($sgo_token) {
		$qry = "SELECT a.co_stk, a.sgo_token, a.total_pay_ssr, a.charge_connectivity, a.charge_admin, 
		               a.user_login, a.pay_tipe, a.createdt, a.bnsperiod, a.receipt_no, a.status_pay,
		               b.bankDisplayNm 
		        FROM stk_pay_hdr_sgo a INNER JOIN ecomm_bank b
		            ON (a.pay_tipe = b.id)
		        WHERE sgo_token = '$sgo_token'";
		$result = $this->getRecordset($qry, null, $this->db3);
		return $result;
	}
	
	function getStkPayDetail($sgo_token) {
		$qry = "SELECT * FROM stk_pay_det_sgo WHERE sgo_token = '$sgo_token'";
		$result = $this->getRecordset($qry, null, $this->db3);
		return $result;
	}
	
	function setStatusPay($sgo_token, $stt) {
		$qry = "UPDATE stk_pay_hdr_sgo SET status_pay = '$stt' WHERE sgo_token = '$sgo_token'";
		$exeQry= $this->executeQuery($qry, $this->db3);
		return $exeQry;
	}
}