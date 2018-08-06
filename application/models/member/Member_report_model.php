<?php

class Member_report_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function listInputMember($stockistID, $from, $to) {
        
    }

    function getDetailMemberByID($id) {
        $slc = "SELECT a.dfno,a.fullnm, a.idno,a.sex, a.addr1, a.addr2, a.addr3,
                        a.loccd as stockist, a.bnsstmsc, a.email, a.password,
                        CONVERT (VARCHAR(30), a.birthdt,103) as birth,
                        CONVERT (VARCHAR(30),a.jointdt,103) as datejoin, a.tel_hp, a.tel_hm,
                        a.country,a.sfno as idsponsor,  b.fullnm as sponsorname,a.novac,
                        a.createnm,a.sfno_reg as recruiter,c.fullnm as recruiternm,
                    d.formno, d.vchkey,
                    CASE 
                       WHEN a.dfno = d.formno AND (e.flag_voucher is null OR e.flag_voucher = '0')  AND e.memberid  IS NULL THEN 'PENDING VOUCHER'
                       WHEN d.formno is null AND (e.flag_voucher is null OR e.flag_voucher = '0')  AND e.memberid  IS NULL THEN 'REGISTERED FROM MLMWIN'
                       WHEN a.dfno = d.formno AND e.is_landingpage = '1' AND (e.flag_voucher is null OR e.flag_voucher = '0') AND e.memberid  IS NOT NULL THEN 'E-COMMERCE / LP'
                       WHEN a.dfno = d.formno  AND (e.flag_voucher is null OR e.flag_voucher = '0') AND e.memberid  IS NOT NULL THEN 'E-COMMERCE'
                       WHEN a.dfno != d.formno  AND e.flag_voucher = '1' THEN 'VOUCHER'
                        WHEN a.dfno != d.formno AND (e.flag_voucher is null OR e.flag_voucher = '1')  AND e.memberid  IS NULL THEN  'VOUCHER'
                    END as keteranganx,
                    e.flag_voucher,
                     e.memberid
                FROM msmemb a
                        LEFT JOIN msmemb b on (a.sfno = b.dfno)
                        LEFT JOIN msmemb c on (a.sfno_reg = c.dfno)
                        LEFT JOIN starterkit d ON (a.dfno = d.activate_dfno)
                        LEFT OUTER JOIN db_ecommerce.dbo.ecomm_memb_ok e ON (a.dfno = e.memberid COLLATE SQL_Latin1_General_CP1_CS_AS)
                WHERE a.dfno = '$id'";

        $result = $this->getRecordset($slc, null, $this->db2);
        return $result;
    }

    function getListMemberByParam($searchBy, $paramValue) {
        $where = "where a.$searchBy like '%$paramValue%'";
        $slc = "select a.dfno,a.fullnm,a.idno,a.addr1,a.tel_hp, a.password,a.novac,
		               a.loccd
					from msmemb a $where";
        $result = $this->getRecordset($slc, null, $this->db2);
        return $result;
    }

    function getListMemberByJoinDate($sc_dfno, $from, $to) {
        $where = "";
        /* if($this->stockist == "BID06") {
          $where = "where CONVERT(VARCHAR(10), a.jointdt,20) BETWEEN '$from' AND '$to'";
          } else {
          $where = "where a.loccd = '".$sc_dfno."' AND CONVERT(VARCHAR(10), a.jointdt,20) BETWEEN '$from' AND '$to'";
          } */

        $where = "where a.loccd = '" . $sc_dfno . "' AND CONVERT(VARCHAR(10), a.jointdt,20) BETWEEN '$from' AND '$to'";
        $slc = "select a.dfno,a.fullnm,a.idno,a.addr1,a.tel_hp, a.password,a.novac,
		            a.loccd
					from msmemb a $where";
        //echo $slc;
        $result = $this->getRecordset($slc, null, $this->db2);
        return $result;
    }

    function getListMemberByMM($mmno) {
        /* $qry = "SELECT a.orderno, a.dfno, a.batchno, 
          a.batchdt,  a.tdp, a.sc_dfno, a.sc_co, a.loccd,
          CONVERT(VARCHAR(10), a.batchdt, 20) as batchdt
          FROM sc_newtrh a
          --INNER JOIN msmemb b ON (a.dfno = b.dfno)
          WHERE a.ttptype = 'MEMB'
          AND a.batchno = '$mmno'"; */

        $qry = "SELECT CONVERT(VARCHAR(30), b.etdt, 103) AS etdt, a.invoiceno, a.registerno,
				       a.receiptno, a.batchscno, b.dfno, c.fullnm, CONVERT(VARCHAR(30), c.jointdt, 103) AS jointdt, c.sponsorid, c.sponsorregid,
				       CONVERT(VARCHAR(10), b.batchdt, 20) as batchdt
				FROM ordivtrh a
				     LEFT OUTER JOIN sc_newtrh b ON (a.batchscno = b.batchno)
				     INNER JOIN msmemb c ON (b.dfno = c.dfno)
				WHERE b.ttptype LIKE 'MEMB%' AND 
				a.invoiceno = '$mmno'
				AND a.batchscno != '' AND a.batchscno is not null 
				ORDER BY b.etdt";
        //echo $qry;
        $result = $this->getRecordset($qry, null, $this->db2);
        return $result;
    }

}
