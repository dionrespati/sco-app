<?php
class Sales_stockist_report_model extends MY_Model {
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
	
	function getListGeneratedSales($x)
    {
        //$x['from'],$x['to'],$x['idstkk'],$x['bnsperiod'],$x['searchs']
        //$username = $this->session->userdata('stockist');
        $froms = date('Y/m/d', strtotime($x['from']));
        $tos = date('Y/m/d', strtotime($x['to']));
        
        /*if($x['searchs'] == "stock"){
            $usertype = "a.sc_dfno = '".$x['mainstk']."' and a.sctype = '".$x['sctype']."'";
        }*/
        
        $folderGets = explode('/', $x['bnsperiod']);
        $data['month'] = $folderGets[0];
        $data['year'] = $folderGets[1];
        $bonusperiod = $data['year']."-".$data['month']."-"."1";
        
        $slc = "select * from V_HILAL_SCO_SSR_LIST a
        		WHERE a.loccd = '$x[sc_dfno]' 
        		AND a.sctype = '".$x['sctype']."' 
        		AND a.bnsperiod='$bonusperiod'
        		AND a.flag_batch <> '0' 
        		AND (a.batchno <> '' OR a.batchno is not null)
        		ORDER BY a.batchdt desc";
       //echo $slc;
       return $this->getRecordset($slc, null, $this->db2);
    }
	
	function getHeaderSsr($field, $value) {
		$qry = "SELECT top 1 a.trcd, 
				       a.sc_dfno, b.fullnm as sc_dfno_name,
				       a.sc_co, c.fullnm as sc_co_name,
				       a.loccd, d.fullnm as loccd_name,
				       CONVERT(char(10), a.batchdt,126) as batchdt,
				       CONVERT(char(10), a.bnsperiod,126) as bnsperiod
				FROM sc_newtrh a
				LEFT OUTER JOIN mssc b ON (a.sc_dfno = b.loccd)
				LEFT OUTER JOIN mssc c ON (a.sc_co = c.loccd)
				LEFT OUTER JOIN mssc d ON (a.loccd = d.loccd)
				WHERE a.$field = '$value'";
		return $this->getRecordset($qry, null, $this->db2);
	}
	
	function getListSummaryTtp($field, $value) {
		$slc = "SELECT a.trcd, a.orderno, a.dfno, b.fullnm, a.tdp, a.tbv
				FROM sc_newtrh a
				LEFT OUTER JOIN msmemb b ON (a.dfno = b.dfno)
				WHERE a.$field = '$value'";
       //echo $slc;
       return $this->getRecordset($slc, null, $this->db2);
	}
	
	function getListSummaryProduct($field, $value) {
		$qry = "SELECT a.prdcd, b.prdnm, SUM(a.qtyord) as qtyord
				FROM sc_newtrd a
				INNER JOIN sc_newtrh c ON (a.trcd = c.trcd)
				LEFT OUTER JOIN msprd b ON (a.prdcd = b.prdcd)
				WHERE c.$field = '$value'
				GROUP BY a.prdcd, b.prdnm
				ORDER BY a.prdcd, b.prdnm";
		return $this->getRecordset($qry, null, $this->db2);
	}
	
	function getVoucherReportList($field, $value) {
		$qry = "SELECT a.claimstatus, c.trcd, d.batchno, d.batchdt, d.loccd,
				       a.DistributorCode, b.fullnm, a.VoucherNo as VoucherNo,
				       a.vchtype,a.VoucherAmt,
				       CONVERT(char(10), d.createdt, 126) as tglklaim,
				       CONVERT(char(10), a.ExpireDate,126) as ExpireDate,
				       CONVERT(char(10), GETDATE(),126) as nowDate,
				       CASE 
				           WHEN CONVERT(char(10), GETDATE(),126) > CONVERT(char(10), a.ExpireDate,126) THEN '1'
				           ELSE '0'
				       END AS status_expire
				FROM tcvoucher a
				INNER JOIN msmemb b ON (a.DistributorCode = b.dfno)
				LEFT JOIN sc_newtrp c ON (a.VoucherNo = c.docno)
				LEFT JOIN sc_newtrh d ON (c.trcd = d.trcd)
				WHERE a.$field = '".$value."'";	
		return $this->getRecordset($qry, null, $this->db2);
	}
}