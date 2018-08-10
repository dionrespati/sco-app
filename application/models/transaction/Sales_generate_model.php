<?php

class Sales_generate_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getGenerateByStk($x) {
        //$x['from'],$x['to'],$x['idstkk'],$x['bnsperiod'],$x['searchs']
        //$username = $this->session->userdata('stockist');


        if ($x['searchs'] == "stock") {
            $usertype = "a.sc_dfno = '" . $x['mainstk'] . "' AND a.sctype = '1' AND a.ttptype = 'SC'";
        } else {
            $usertype = "a.sc_dfno = '" . $x['mainstk'] . "' AND a.sctype = '1' AND (a.ttptype = 'MEMBP' or a.ttptype = 'MEMB')";
        }

        $trxdate = "";
        if ($x['from'] != "" && $x['from'] != " " && $x['from'] != null) {
            //echo "tgl : ".$x['from'];
            $FROMs = date('Y/m/d', strtotime($x['from']));
            $tos = date('Y/m/d', strtotime($x['to']));
            $trxdate = " AND (CONVERT(VARCHAR(10), a.etdt, 111) between '" . $FROMs . "' AND '" . $tos . "')";
        }

        $folderGets = explode('/', $x['bnsperiod']);
        $data['month'] = $folderGets[0];
        $data['year'] = $folderGets[1];
        $bonusperiod = $data['month'] . "/" . "1" . "/" . $data['year'];

        $slc = "SELECT a.trcd,a.dfno,a.totpay, a.nbv, a.etdt,a.bnsperiod,a.sc_dfno,b.fullnm,a.sc_co
                FROM sc_newtrh a 
                    inner join klink_mlm2010.dbo.msmemb b on (a.dfno = b.dfno COLLATE SQL_Latin1_General_CP1_CS_AS) 
                WHERE a.bnsperiod = '" . $bonusperiod . "'
                    AND a.trtype = 'SB1'
                    AND a.loccd = '" . $x['mainstk'] . "'
                    AND (a.flag_batch = '0')
                    AND (a.batchno = '' or a.batchno is null)
                    AND $usertype $trxdate
                ORDER BY a.trcd";
        //a.createnm = '".$x['mainstk']."' AND 
        //echo $slc;
        return $this->getRecordset($slc, null, $this->db2);
    }

    function getGenerateByPVR($x) {
        //$FROMs = date('Y/m/d', strtotime($x['from']));
        //$tos = date('Y/m/d', strtotime($x['to']));

        $folderGets = explode('/', $x['bnsperiod']);
        $data['month'] = $folderGets[0];
        $data['year'] = $folderGets[1];
        $bonusperiod = $data['month'] . "/" . "1" . "/" . $data['year'];

        $trxdate = "";
        if ($x['from'] != "" && $x['from'] != " " && $x['from'] != null) {
            //echo "tgl : ".$x['from'];
            $FROMs = date('Y/m/d', strtotime($x['from']));
            $tos = date('Y/m/d', strtotime($x['to']));
            $trxdate = " AND (CONVERT(VARCHAR(10), a.etdt, 111) between '" . $FROMs . "' AND '" . $tos . "')";
        }

        $qry = "SELECT a.trcd,a.dfno,a.totpay,a.etdt,a.bnsperiod,b.fullnm, a.sc_dfno, a.sc_co 
                FROM sc_newtrh a 
                    inner join klink_mlm2010.dbo.msmemb b on (a.dfno = b.dfno COLLATE SQL_Latin1_General_CP1_CS_AS) 
                WHERE a.sc_dfno = '" . $this->stockist . "'
                AND a.bnsperiod = '" . $bonusperiod . "'
                AND a.sc_co = '" . $this->stockist . "' 

                AND (a.ttptype = 'SUBSC' or a.ttptype = 'SC' or a.ttptype = 'REDEMPTION')
                AND (a.batchno = '' or a.batchno is null) 
                AND a.ttptype <> 'MEMB' 
                AND a.ttptype <> 'MEMBP' AND a.trtype = 'VP1' AND a.pricecode != '1609P'
                $trxdate
                order by a.etdt";
        //AND a.createnm = '".$this->stockist."'
        //echo $qry;
        return $this->getRecordset($qry, null, $this->db1);
    }

    function getGenerateBySUbMs($x) {
        //$x['from'],$x['to'],$x['idstkk'],$x['bnsperiod'],$x['searchs']
        //$username = $this->session->userdata('stockist');
        //$FROMs = date('Y/m/d', strtotime($x['from']));
        //$tos = date('Y/m/d', strtotime($x['to']));
        if ($x['idstkk'] == "") {
            if ($x['searchs'] == "sub") {
                $usertype = "a.loccd = '" . $x['mainstk'] . "' AND a.sctype = '2' AND a.ttptype = 'SUBSC'";
            } else {
                $usertype = "a.loccd = '" . $x['mainstk'] . "' AND a.sctype = '3' AND a.ttptype = 'SUBSC'";
            }
        } else {
            if ($x['searchs'] == "sub") {
                //$sctype = $this->cekSctype($idstk);
                $usertype = "a.sc_dfno = '" . $x['idstkk'] . "' AND a.sctype = '2' AND a.ttptype = 'SUBSC'";
            } else {
                //$sctype = $this->cekSctype($idstk);
                $usertype = "a.sc_dfno = '" . $x['idstkk'] . "' AND a.sctype = '3' AND a.ttptype = 'SUBSC'";
            }
        }

        $trxdate = "";
        if ($x['from'] != "" && $x['from'] != " " && $x['from'] != null) {
            //echo "tgl : ".$x['from'];
            $FROMs = date('Y/m/d', strtotime($x['from']));
            $tos = date('Y/m/d', strtotime($x['to']));
            $trxdate = " AND (CONVERT(VARCHAR(10), a.etdt, 111) between '" . $FROMs . "' AND '" . $tos . "')";
        }

        $folderGets = explode('/', $x['bnsperiod']);
        $data['month'] = $folderGets[0];
        $data['year'] = $folderGets[1];
        $bonusperiod = $data['month'] . "/" . "1" . "/" . $data['year'];

        $slc = "SELECT a.sc_dfno, 
                    b.fullnm, 
                    a.bnsperiod,SUM(a.totpay) as totpay, 
                    count(a.trcd) as ttp,SUM(a.nbv) as totbv,
                    a.sc_co, a.loccd
                FROM sc_newtrh a 
                    inner join klink_mlm2010.dbo.mssc b on a.sc_dfno=b.loccd  
                WHERE a.bnsperiod = '" . $bonusperiod . "' 
                    AND a.trtype = 'SB1' 
                    AND (a.batchno = '' or a.batchno is null) 
                    AND a.flag_batch = '0' AND $usertype $trxdate
                GROUP BY a.bnsperiod,a.sc_dfno, b.fullnm,a.sc_co, a.loccd";
        //echo $slc;
        //AND a.createnm = '".$x['mainstk']."'
        return $this->getRecordset($slc, null, $this->db1);
    }

    function get_details_salesttp($scdfno, $bnsperiod, $scco) {
        //$bnsperiod = "01/".$bnsperiod;
        /* $slc = "SELECT a.trcd,a.totpay,a.createdt,a.dfno,a.sc_dfno,a.nbv,a.bnsperiod,b.fullnm
          FROM sc_newtrh a
          inner join klink_mlm2010.dbo.msmemb b on a.dfno = b.dfno
          WHERE a.sc_dfno = '".$scdfno."' AND a.sc_co = '".$scco."'
          AND a.createnm = '".$this->stockist."' AND a.bnsperiod = '".$bnsperiod."' AND a.batchno is null";
         */
        $slc = "SELECT a.trcd,
                    a.totpay,
                    a.createdt,
                    a.dfno,
                    a.sc_dfno,
                    a.nbv,
                    a.bnsperiod,
                    b.fullnm
                FROM sc_newtrh a 
	        INNER JOIN klink_mlm2010.dbo.msmemb b on (a.dfno = b.dfno)
                WHERE a.sc_dfno = '" . $scdfno . "' "
                . "AND a.sc_co = '" . $scco . "' "
                . "AND a.createnm = '" . $this->stockist . "' "
                . "AND a.bnsperiod = '" . $bnsperiod . "' "
                . "AND a.batchno is null";
        //echo $slc;
        return $this->getRecordset($slc, null, $this->db1);
    }

}
