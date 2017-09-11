<?php
class Lbc_model extends MY_Model {
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
		
    }

	function checkValidID($idmember) {
		$qry = "SELECT a.dfno, a.fullnm, a.sex, 
	               CONVERT(VARCHAR(30),a.birthdt,103) as birthdt, 
                   a.addr1, a.addr2, a.addr3, a.idno, a.tel_hp, a.email, 
                   a.bnsstmsc, b.fullnm as stockistname 
                FROM msmemb a LEFT JOIN mssc b ON (a.bnsstmsc = b.loccd)
                WHERE a.dfno = '$idmember' AND a.fullnm != 'TERMINATION'";
           //echo $qry;        
        $checkData = $this->getRecordset($qry,null,$this->db2);
		return $checkData;
	}
	
	function check400BV($idmember) {
		$check_bns = "EXEC SP_HILAL_LBC_CHECK400 '$idmember'";
        $cekLBC2 = $this->getRecordset($check_bns,null,$this->db2);
        return $cekLBC2;
	}
	
	function checkLbcExpireDate($idmember) {
		 $arr = array("response" => "true", "message" => "Data member valid..");
		 $date = date('d/m/Y');
         //$date = "01/02/2014";
         $cekLBC = "SELECT dfno, CONVERT(VARCHAR(30),register_dt,103) as register_dt, 
                         CONVERT(VARCHAR(30),expired_dt,103) as expired_dt 
                    FROM ASH_LBC_MEMB WHERE dfno = '$idmember'";
         $res = $this->getRecordset($cekLBC,null,$this->db2);
         
         if($res != null)
         {
             
             if(isset($res[0]->expired_dt))
             {
                 // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
                 // dari tanggal pertama
            
                 $pecah1 = explode("/", $date);
                 $date1 = $pecah1[0];
                 $month1 = $pecah1[1];
                 $year1 = $pecah1[2];
                
                 // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
                 // dari tanggal kedua
                
                 $pecah2 = explode("/", $res[0]->expired_dt);
                 $date2 = $pecah2[0];
                 $month2 = $pecah2[1];
                 $year2 =  $pecah2[2];
                
                 // menghitung JDN dari masing-masing tanggal
                
                 $jd1 = GregorianToJD($month1, $date1, $year1);
                 $jd2 = GregorianToJD($month2, $date2, $year2);
                
                 // hitung selisih hari kedua tanggal
                
                 $selisih = $jd2 - $jd1;
                 if($selisih > 0) {
                    $arr = array("response" => "false", "message" => "LAST EXPIRE DATE is ".$res[0]->expired_dt."");
                 } else {
                    $arr = array("response" => "true", "message" => "LAST EXPIRE DATE is ".$res[0]->expired_dt.", status : PASS");
                 }
                 
             }
              
       }
       
	   return $arr;
	}

	function saveRegLbc($data) {
		$idmember = $this->input->post('idmember');
        $nmmember = $this->input->post('nmmember');
        $addr1 = str_replace("'", "`", $this->input->post('addr1'));
        $addr2 = str_replace("'", "`", $this->input->post('addr2'));
        $addr3 = str_replace("'", "`", $this->input->post('addr3'));
        
        $dob = $this->input->post('dob');
        /*$addrc1 = str_replace("'", "`", $this->input->post('addrc1'));
        $addrc2 = str_replace("'", "`", $this->input->post('addrc2'));
        $addrc3 = str_replace("'", "`", $this->input->post('addrc3'));*/
        
        $email = $this->input->post('email');
        $idno = $this->input->post('idno');
        $bnsstmsc = $this->input->post('bnsstmsc');
        $regdate = date("Y-m-d h:m:s");
        $dob2 = explode("/", $dob);
        $tgllahir = $dob2[2]."-".$dob2[1]."-".$dob2[0];
		$qry = "INSERT INTO ASH_LBC_MEMB 
		            (dfno, fullnm, addr1, addr2, addr3, register_dt, birthdt, 
		            cor_addr1, cor_addr2, cor_addr3, email, noktp, bnsstmsc) 
		        VALUES 
                    ('$data[idmember]', '$nmmember', '$addr1', '$addr2', '$addr3', '$regdate', '$tgllahir', 
                    '$addrc1','$addrc2','$addrc3','$email','$idno','$bnsstmsc')";
		$qry2 = $this->db->query($qry);
        if($qry2 > 0) {
          $arr = array("response" => "true", "message" => "Saving LBC registration success..!!");
        } else {
          $arr = array("response" => "false", "message" => "Saving LBC registration failed..!!");
        }
        return $arr;
	}
}