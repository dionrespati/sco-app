<?php

class Stockist_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getStockistInfo($loccd) {
        $qry = "SELECT a.loccd, a.sctype, a.fullnm, 
				   a.addr1, a.addr2, a.addr3,
				   a.dfno,
				   a.tel_hm, a.tel_hp, a.tel_of,
				   a.[state], c.[description] as statenm,
				   a.limitkit, a.arkit,
				   a.limitkit - a.arkit as sisa_kuota,
				   a.sfno as uplinestk, b.fullnm as uplinenm,
				   a.lastkitno, a.latitude, a.longitude
				FROM mssc a 
				INNER JOIN mssc b ON (a.sfno = b.loccd)
				INNER JOIN [state] c ON (a.[state] = c.st_id)
				WHERE a.loccd = '$loccd'";
        $res = $this->getRecordset($qry, NULL, $this->setDB(2));
        return $res;
    }

    function updateAddrStockist() {
        $arr = jsonFalseResponse("Update Data Stockist gagal..");
        $data = $this->input->post(NULL, TRUE);
        if ($this->stockist == "BID06") {
            
        }
        $qry = "UPDATE mssc
			    SET addr1 = '$data[addr1]',
			        addr2 = '$data[addr2]',
			        addr3 = '$data[addr3]',
			        tel_hp = '$data[tel_hp]',
			        tel_hm = '$data[tel_hm]',
			        tel_of = '$data[tel_of]',
                                latitude = '$data[latitude]',
                                longitude = '$data[longitude]'
				WHERE loccd = '$data[loccd]'";
        $res = $this->executeQuery($qry, $this->setDB(2));
        if ($res > 0) {
            $arr = jsonTrueResponse(null, "Update Data Stockist berhasil..");
        }
        return $arr;
    }

}
