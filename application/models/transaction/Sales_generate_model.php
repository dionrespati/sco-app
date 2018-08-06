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
            $usertype = "a.sc_dfno = '" . $x['mainstk'] . "' and a.sctype = '1' AND a.ttptype = 'SC'";
        } else {
            $usertype = "a.sc_dfno = '" . $x['mainstk'] . "' and a.sctype = '1' AND (a.ttptype = 'MEMBP' or a.ttptype = 'MEMB')";
        }

        $trxdate = "";
        if ($x['from'] != "" && $x['from'] != " " && $x['from'] != null) {
            //echo "tgl : ".$x['from'];
            $froms = date('Y/m/d', strtotime($x['from']));
            $tos = date('Y/m/d', strtotime($x['to']));
            $trxdate = " and (CONVERT(VARCHAR(10), a.etdt, 111) between '" . $froms . "' and '" . $tos . "')";
        }

        $folderGets = explode('/', $x['bnsperiod']);
        $data['month'] = $folderGets[0];
        $data['year'] = $folderGets[1];
        $bonusperiod = $data['month'] . "/" . "1" . "/" . $data['year'];

        $slc = "select a.trcd,a.dfno,a.totpay, a.nbv, a.etdt,a.bnsperiod,a.sc_dfno,b.fullnm,a.sc_co
                    from sc_newtrh a 
                    	inner join klink_mlm2010.dbo.msmemb b on (a.dfno = b.dfno COLLATE SQL_Latin1_General_CP1_CS_AS) 
                    where 
                    a.bnsperiod = '" . $bonusperiod . "'
                    and a.trtype = 'SB1'
                    and a.loccd = '" . $x['mainstk'] . "'
                    and (a.flag_batch = '0')
                    and (a.batchno = '' or a.batchno is null)
                    and $usertype $trxdate
                    order by a.trcd";
        //a.createnm = '".$x['mainstk']."' and 
        //echo $slc;
        return $this->getRecordset($slc, null, $this->db1);
    }

    function getGenerateByPVR($x) {
        //$froms = date('Y/m/d', strtotime($x['from']));
        //$tos = date('Y/m/d', strtotime($x['to']));

        $folderGets = explode('/', $x['bnsperiod']);
        $data['month'] = $folderGets[0];
        $data['year'] = $folderGets[1];
        $bonusperiod = $data['month'] . "/" . "1" . "/" . $data['year'];

        $trxdate = "";
        if ($x['from'] != "" && $x['from'] != " " && $x['from'] != null) {
            //echo "tgl : ".$x['from'];
            $froms = date('Y/m/d', strtotime($x['from']));
            $tos = date('Y/m/d', strtotime($x['to']));
            $trxdate = " and (CONVERT(VARCHAR(10), a.etdt, 111) between '" . $froms . "' and '" . $tos . "')";
        }

        $qry = "select a.trcd,a.dfno,a.totpay,a.etdt,a.bnsperiod,b.fullnm, a.sc_dfno, a.sc_co 
                    from sc_newtrh a 
                    	inner join klink_mlm2010.dbo.msmemb b on (a.dfno = b.dfno COLLATE SQL_Latin1_General_CP1_CS_AS) 
                    where a.sc_dfno = '" . $this->stockist . "'
                    and a.bnsperiod = '" . $bonusperiod . "'
                    and a.sc_co = '" . $this->stockist . "' 
                    
                    and (a.ttptype = 'SUBSC' or a.ttptype = 'SC' or a.ttptype = 'REDEMPTION')
                    and (a.batchno = '' or a.batchno is null) 
                    and a.ttptype <> 'MEMB' 
                    and a.ttptype <> 'MEMBP' and a.trtype = 'VP1' and a.pricecode != '1609P'
                    $trxdate
                    order by a.etdt";
        //and a.createnm = '".$this->stockist."'
        //echo $qry;
        return $this->getRecordset($qry, null, $this->db1);
    }

    function getGenerateBySUbMs($x) {
        //$x['from'],$x['to'],$x['idstkk'],$x['bnsperiod'],$x['searchs']
        //$username = $this->session->userdata('stockist');
        //$froms = date('Y/m/d', strtotime($x['from']));
        //$tos = date('Y/m/d', strtotime($x['to']));
        if ($x['idstkk'] == "") {
            if ($x['searchs'] == "sub") {
                $usertype = "a.loccd = '" . $x['mainstk'] . "' and a.sctype = '2' AND a.ttptype = 'SUBSC'";
            } else {
                $usertype = "a.loccd = '" . $x['mainstk'] . "' and a.sctype = '3' AND a.ttptype = 'SUBSC'";
            }
        } else {
            if ($x['searchs'] == "sub") {
                //$sctype = $this->cekSctype($idstk);
                $usertype = "a.sc_dfno = '" . $x['idstkk'] . "' and a.sctype = '2' AND a.ttptype = 'SUBSC'";
            } else {
                //$sctype = $this->cekSctype($idstk);
                $usertype = "a.sc_dfno = '" . $x['idstkk'] . "' and a.sctype = '3' AND a.ttptype = 'SUBSC'";
            }
        }

        $trxdate = "";
        if ($x['from'] != "" && $x['from'] != " " && $x['from'] != null) {
            //echo "tgl : ".$x['from'];
            $froms = date('Y/m/d', strtotime($x['from']));
            $tos = date('Y/m/d', strtotime($x['to']));
            $trxdate = " and (CONVERT(VARCHAR(10), a.etdt, 111) between '" . $froms . "' and '" . $tos . "')";
        }

        $folderGets = explode('/', $x['bnsperiod']);
        $data['month'] = $folderGets[0];
        $data['year'] = $folderGets[1];
        $bonusperiod = $data['month'] . "/" . "1" . "/" . $data['year'];

        $slc = "select a.sc_dfno, b.fullnm, a.bnsperiod,SUM(a.totpay) as totpay, 
                count(a.trcd) as ttp,SUM(a.nbv) as totbv,a.sc_co, a.loccd
                from sc_newtrh a 
                    inner join klink_mlm2010.dbo.mssc b on a.sc_dfno=b.loccd  
                where a.bnsperiod = '" . $bonusperiod . "' 
                 
                and a.trtype = 'SB1' 
                and (a.batchno = '' or a.batchno is null) 
                and a.flag_batch = '0' and $usertype $trxdate
                GROUP BY a.bnsperiod,a.sc_dfno, b.fullnm,a.sc_co, a.loccd";
        //echo $slc;
        //and a.createnm = '".$x['mainstk']."'
        return $this->getRecordset($slc, null, $this->db1);
    }

    function get_details_salesttp($scdfno, $bnsperiod, $scco) {
        //$bnsperiod = "01/".$bnsperiod;
        /* $slc = "select a.trcd,a.totpay,a.createdt,a.dfno,a.sc_dfno,a.nbv,a.bnsperiod,b.fullnm
          from sc_newtrh a
          inner join klink_mlm2010.dbo.msmemb b on a.dfno = b.dfno
          where a.sc_dfno = '".$scdfno."' and a.sc_co = '".$scco."'
          and a.createnm = '".$this->stockist."' AND a.bnsperiod = '".$bnsperiod."' and a.batchno is null";
         */
        $slc = "select a.trcd,a.totpay,a.createdt,a.dfno,a.sc_dfno,a.nbv,a.bnsperiod,b.fullnm
                from sc_newtrh a 
	               inner join klink_mlm2010.dbo.msmemb b on a.dfno = b.dfno 
                where a.sc_dfno = '" . $scdfno . "' and a.sc_co = '" . $scco . "' 
                and a.createnm = '" . $this->stockist . "' AND a.bnsperiod = '" . $bnsperiod . "' and a.batchno is null";
        //echo $slc;
        return $this->getRecordset($slc, null, $this->db1);
    }

}
