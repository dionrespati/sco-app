<?php
class Member_registration_model extends MY_Model {
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	function getListMemberByMM($mmno) {
		$qry = "SELECT a.orderno, a.dfno, a.batchno, 
				       a.batchdt,  a.tdp, a.sc_dfno, a.sc_co, a.loccd,
				       CONVERT(VARCHAR(10), a.batchdt, 20) as batchdt
				FROM sc_newtrh a
				--INNER JOIN msmemb b ON (a.dfno = b.dfno)
				WHERE a.ttptype = 'MEMB'
				AND a.batchno = '$mmno";
		$result = $this->getRecordset($slc,null,$this->db2);
	    return $result;
	}
	
	public function cekValidVoucher($voucherno,$voucherkey) {
        $qry = "SELECT a.formno, a.activate_dfno, a.activate_by, a.status, b.fullnm,
                  CONVERT(VARCHAR(10), a.activate_dt, 20) as activate_dt, prdcd 
                FROM starterkit a
                LEFT OUTER JOIN msmemb b ON (a.activate_dfno = b.dfno) 
                WHERE a.formno = '".$voucherno."' and a.vchkey = '".$voucherkey."'";
        $result = $this->getRecordset($qry,null,$this->db2);
	    return $result;
    }
	
	function cekLimitKit($idstockist) {
        $qry = "select a.limitkit-a.arkit as limitstock,a.arkit,a.limitkit
                from mssc a where a.loccd = '$idstockist'";
		
        $result = $this->getRecordset($qry,null,$this->db2);
	    return $result;
    }

	function showStockistByArea($state)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $cc = "select loccd, fullnm,state 
                FROM mssc where loccd = '$state' and sctype != '3' 
                AND fullnm not in('TERMINATION','CANCEL','BUSSINESS & DEVELOPMENT','INTERNET ID','CENCEL',
				'UNITED STATES OF AME', 'THAILAND', 'SWITZERLAND', 'SPANYOL', 'SRILANKA', 'SINGAPORE', 'JAPAN',
					   'CANADA','INTERNET CODE','UNITED ARAB EMIRATES')";
        
        //echo $cc;
        $query = $this->db->query($cc);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $data)
			{
				$nilai[]=$data;
			}
			return $nilai;
		}
    }
    
    function getListState() {
        $qry = "select st_id, description 
                FROM state where cn_id = 'ID' and description not IN ('TEMPORARY','UNITED STATES OF AME', 'THAILAND', 'SWITZERLAND', 'SPANYOL', 'SRILANKA', 'SINGAPORE', 'JAPAN',
					   'CANADA','INTERNET CODE','UNITED ARAB EMIRATES')";
        $result = $this->getRecordset($qry,null,$this->db2);
	    return $result;
    }
    
    function getListStockistByState($state) {
        $qry = "SELECT loccd, fullnm 
                FROM mssc where state = '$state' and sctype != '3' 
                    AND fullnm not in('TERMINATION','CANCEL','BUSSINESS & DEVELOPMENT','INTERNET ID','CENCEL', 
                       'UNITED STATES OF AME', 'THAILAND', 'SWITZERLAND', 'SPANYOL', 'SRILANKA', 'SINGAPORE', 'JAPAN',
					   'CANADA','INTERNET CODE','UNITED ARAB EMIRATES') 
                    AND scstatus='1' 
		        ORDER BY sctype, fullnm ";
		//echo $qry;
        $result = $this->getRecordset($qry,null,$this->db2);
	    return $result;
    }
    
    function getListBank() {
        $qry = "select * from klink_mlm2010.dbo.bank 
                WHERE bankid not in('VCA','NA','BLK','CIC','BKU') 
                and web_status='1' order by bankid";
        $result = $this->getRecordset($qry,null,$this->db2);
	    return $result;
    }
	
	function showLastkitno($stk) {
        $qry = "select memberprefix, lastcodememb, lastkitno from mssc where loccd = '$stk'";
        $result = $this->getRecordset($qry,null,$this->db2);
	    if($result != null) {
	    	return $result;
	    } else {
	    	$input = "insert into mssc (lastkitno) values(1)";
	    	$s = $this->executeQuery($input, $this->db2);
			return null;
	    }
        
        //echo $sql;
    }

	function setLastKitNo($stk) {
        $sql = "update mssc SET lastkitno = lastkitno + 1 where loccd = '$stk'";
        $s = $this->executeQuery($sql, $this->db2);
        return $s;
    }
	
	function cek_seQ() {
        $this->db = $this->load->database($this->db2, true);
         $y1=date("y");
         $m=date("m");
        
        $this->db->trans_begin();
 
        $tbl = "SEQ_MEMB"."$y1"."$m";
        
        $cek = "select * from $tbl";
        
        $query = $this->db->query($cek);
        if($query->num_rows < 1)
        {
            $input = "insert into $tbl (SeqVal) values('a')";
            $query = $this->db->query($input);
           
        }
        else
        {
            $input = "insert into $tbl (SeqVal) values('a')";
            $query = $this->db->query($input);
        }
        
        if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }      
        
        return $query;
    }
	
	function get_idno()
    {
        $this->db = $this->load->database($this->db2, true);
        $y1=date("y");
         $m=date("m");
        
        $this->db->trans_begin();
 
        $tbl = "SEQ_MEMB"."$y1"."$m";
        $qry = "SELECT * FROM $tbl 
           		 WHERE SeqID = ( SELECT MAX(SeqID) FROM $tbl )";
        
        //echo $qry;
        $query = $this->db->query($qry);
        if($query == null)
        {
            $ss = 0;
        }
        else
        {
            foreach($query->result() as $data)
            {
                $ss = $data->SeqID;
            }  
        }
         $jumlah = $query->num_rows();
         
       	$next_seq = sprintf("%06s",$ss);
        $prefix = date('ym');
        $y =  strval("MEMB".$prefix.$next_seq);
         
          if ($query->result() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }      
       
         return $y;
    }

    function insert_new_member($new_id,$usr,$idnoo, $group_stk)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $data['voucherno'] = $this->input->post('voucherno');
        $data['voucherkey'] = $this->input->post('voucherkey');
        $data['idsponsor'] = strtoupper($this->input->post('idsponsor'));
        $data['nmsponsor'] = strtoupper($this->input->post('nmsponsor'));
        
        $data['idrekrut'] = strtoupper($this->input->post('idrekrut'));
        $data['nmrekrut'] = strtoupper($this->input->post('nmrekrut'));
        
        $data['tgllahir'] = $this->input->post('tgllahir');
        $data['noapl'] = $this->input->post('noapl');
        $data['nmmember'] = strtoupper($this->input->post('nmmember'));
        $data['noktp'] = strtoupper($this->input->post('noktp'));
        $data['sex'] = $this->input->post('sex');
        $data['addr1'] = strtoupper($this->input->post('addr1'));
        $data['addr2'] = strtoupper($this->input->post('addr2'));
        $data['addr3'] = strtoupper($this->input->post('addr3'));
        $data['area'] = $this->input->post('area');
        $data['tel_hm'] = $this->input->post('tel_hm');
        $data['tel_hp'] = $this->input->post('tel_hp');
        $data['bnstmt'] = $this->input->post('bnstmt');
        $data['kdpos'] = $this->input->post('kdpos');
        $data['email'] = $this->input->post('email');
        $data['bankid'] = $this->input->post('bankid');
        $data['banknm'] = $this->input->post('banknm');
        $data['norek'] = $this->input->post('norek'); 
        //$data['username'] = $this->input->post('username');
        $data['regtype'] = $this->input->post('regtype');
        $data['kdpos'] = $this->input->post('kdpos');
        $data['choosevoucher'] = $this->input->post('chosevoucher');
        
        $search_for = "'";
        $replace = "`";
        
        $nmsponsor = str_replace($search_for,$replace,$data['nmsponsor']);
        $nmmember = str_replace($search_for,$replace,$data['nmmember']);
        $addr1 = str_replace($search_for,$replace,$data['addr1']);
        $addr2 = str_replace($search_for,$replace,$data['addr2']);
        $addr3 = str_replace($search_for,$replace,$data['addr3']);
        
        //$bonusperiod = date("m")."/"."1"."/".date("Y");
        $period = $this->get_current_period();
        $bonusperiod = date('m/d/Y', strtotime($period[0]->lastperiod));
        
        //$bonusperiod = $this->showKitPrdcd();
        
        //echo "bonus period ".$bonusperiod."";
        
        $createdt = date('Y-m-d H:i:s');
        
        $birth = explode("/", $data['tgllahir']);
        $thn = substr($birth[2], 2, 2);
        $now = date("Y-m-d");
        $password = $birth[0]."".$birth[1]."".$thn;
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $alamat3 = $data['addr3']." ".$data['kdpos'];
        //$postcode = '000004';
        $postcode = $data['kdpos'];
        
      
        $tgllahir = $birth[2]."-".$birth[1]."-".$birth[0];
        
        
        if($data['regtype']=="" || $data['regtype']=="0")
        {
            $test = $this->showKitPrdcd($usr);
            $regtype = $test[0]->kitprdcd;
            $totdp = $test[0]->dp;
            $totbv = $test[0]->bv;
            $pricecode = $test[0]->pricecode;
            //echo "door ".$regtype."<br>";
        }
        else
        {
            $test = $this->showKitPrdcdV($usr,$data['regtype']);
            $regtype = $test[0]->prdcd;
            $totdp = $test[0]->dp;
            $totbv = $test[0]->bv;
            $pricecode = $test[0]->pricecode;
        }
        
        if($data['choosevoucher'] == '1')
        {
            $ordtypee = 'V';
            $kitstatus = '1';
        }
        else
        {
            $ordtypee = 'P';
            $kitstatus = '0';
        }
        
        if($data['norek']!="")
        {
            $nmmembery = $nmmember;
        }
        else
        {
            $nmmembery = "";
        }
        
       
        //$alamat3 = $this->input->post('addr3')." ". $this->input->post('postcode');
                $insMsmemb = "INSERT into msmemb 
                                (dfno, sfno, sfno_reg, memberid,password,
                                 sponsorid, sponsorregid, fullnm,idno,birthdt,
                                 sex,citizen,addr1,addr2,addr3,
                                 state,postcd,country,tel_hm,tel_hp,
                                 email,jointdt,regtype,bankaccno,bankaccnm,
                                bankid,branch,loccd,trdt,etdt,
                                createnm,status,autobns,activitystatusid,sentstm,
                                auto_totdnln,iplastupd,PT_SVRID,allowmemberlogin,bnsstmsc,
                                loccd_et,loccd_co,formno,vchkey,dfnotemp,
                                banknm,ordtype,kit_status,birth2dt,benbirthdt,trcd,entrytype)
                VALUES ('$new_id','".$data['idsponsor']."','".$data['idrekrut']."','$new_id','$password',
                        '".$data['idsponsor']."','".$data['idsponsor']."','".$nmmember."','".$data['noktp']."','".$tgllahir."',
                        '".$data['sex']."','ID','".$addr1."','".$addr2."','".$addr3."',
                        '".$data['area']."','$postcode','ID','".$data['tel_hm']."','".$data['tel_hp']."',
                        '".$data['email']."','$now','".$regtype."','".$data['norek']."','".$nmmembery."',
                        '".$data['bankid']."','B001','".$usr."','$now','$now',
                        '".$usr."','1',0,1,'2',
                        0,'$ip','ID','1','".$data['bnstmt']."',
                        '".$usr."','".$usr."','".$data['voucherno']."','".$data['voucherkey']."','".$data['noapl']."',
                        '".$data['banknm']."', '".$ordtypee."','".$kitstatus."','$now','$now','".$idnoo."','$group_stk')";
                        
               
        //echo "QUERY MSMEMB ".$insMsmemb."";
        //echo "<br /><br />";
        $query1 = $this->db->query($insMsmemb);
        
        if($data['choosevoucher'] == '1')
        {
            $insSc_newtrh = "insert into sc_newtrh 
                            (trcd,trtype,trdt,dfno,loccd,tdp,taxrate,taxamt,discamt,shcharge,
                            othcharge,tpv,tbv,npv,nbv,ndp,whcd,branch,pricecode,
                            paytype1,paytype2,paytype3,pay1amt,pay2amt,pay3amt,totpay,createnm,
                            updatenm,post,sp,sb,taxable,taxableamt,ordtype,createdt,
                            type,scdiscrate,scdiscamt,sctype,scdisc,generate,statusbo,
                            syn2web,n_bc,status,autorecon,first_trx,bc,PT_SVRID,sc_dfno,
                            sc_co,bnsperiod,othdisc,flag_batch,batchstatus,flag_recover,
                            system,ttptype,entrytype,flag_show,flag_approval,csno,batchno,batchdt)
                            VALUES
                            ('".$idnoo."','SB1','".$createdt."','".$new_id."',
                            '".$usr."',".$totdp.",10,0,0,0,0,".$totbv.",".$totbv.",
                            ".$totbv.",".$totbv.",".$totdp.",'WH001','B001','".$pricecode."',
                            '01','01','03',".$totdp.",0,0,".$totdp.",'".$usr."','".$usr."',
                            '0',0,0,0,0,'0','".$createdt."','0',0,0,'1','1','0','0','0',
                            0,'0','0','0','1','ID','".$usr."','".$usr."','".$bonusperiod."',
                            0,'2','0','0','0','MEMB',4,'1','1','IDBL','IDBL','".$createdt."')";
        
            //echo "QUERY NEWTRH ".$insSc_newtrh."";
            //echo "<br /><br />";
            $query2 = $this->db->query($insSc_newtrh);
            
            
            $insStarterkit = "update starterkit set activate_dfno='".$new_id."',
                                activate_by = '".$usr."',activate_fromip = '".$ip."',
                                activate_dt='".$createdt."',status = '2'
                                where formno = '".$data['voucherno']."' and vchkey = '".$data['voucherkey']."'";
        
            //echo "QUERY STARTERKIT ".$insStarterkit."";
            //echo "<br /><br />";
           $query3 = $this->db->query($insStarterkit);
            
        }
        else
        {
            $insSc_newtrh = "insert into sc_newtrh 
                            (trcd,trtype,trdt,dfno,loccd,tdp,taxrate,taxamt,discamt,shcharge,
                            othcharge,tpv,tbv,npv,nbv,ndp,whcd,branch,pricecode,
                            paytype1,paytype2,paytype3,pay1amt,pay2amt,pay3amt,totpay,createnm,
                            updatenm,post,sp,sb,taxable,taxableamt,ordtype,createdt,
                            type,scdiscrate,scdiscamt,sctype,scdisc,generate,statusbo,
                            syn2web,n_bc,status,autorecon,first_trx,bc,PT_SVRID,sc_dfno,
                            sc_co,bnsperiod,othdisc,flag_batch,batchstatus,flag_recover,
                            system,ttptype,entrytype,flag_show,flag_approval)
                            VALUES
                            ('".$idnoo."','SB1','".$createdt."','".$new_id."',
                            '".$usr."',".$totdp.",10,0,0,0,0,".$totbv.",".$totbv.",
                            ".$totbv.",".$totbv.",".$totdp.",'WH001','B001','".$pricecode."',
                            '01','01','03',".$totdp.",0,0,".$totdp.",'".$usr."','".$usr."',
                            '0',0,0,0,0,'0','".$createdt."','0',0,0,'1','1','0','0','0',
                            0,'0','0','0','1','ID','".$usr."','".$usr."','".$bonusperiod."',
                            0,'0','0','0','0','MEMBP',4,'1','0')";
        
            //echo "QUERY NEWTRH ".$insSc_newtrh."";
            //echo "<br /><br />";
            $query2 = $this->db->query($insSc_newtrh);
            
            
            $insStarterkit = "insert into starterkit 
                        (formno,vchkey,createdt,createnm,
                        status,activate_by,activate_dfno,activate_fromip,activate_dt,
                        actseq,updatenm,updatedt,prdcd,PT_SVRID) 
                        VALUES
                        ('".$new_id."','".$new_id."','".$createdt."','".$usr."','2','".$usr."','".$new_id."',
                        '".$ip."','".$createdt."',0,'".$usr."','".$createdt."','".$regtype."','ID')";
        
            //echo "QUERY STARTERKIT ".$insStarterkit."";
            //echo "<br /><br />";
            $query3 = $this->db->query($insStarterkit);
        }
        
        $insSc_newtrd = "insert into sc_newtrd 
                        (trcd,prdcd,qtyord,qtyship,qtyremain,dp,pv,bv,taxrate,sp,sb,scdisc,seqno,scdiscamt,
                        syn2web,qty_used,qty_avail,PT_SVRID,pricecode) 
                        VALUES
                        ('".$idnoo."', '".$regtype."',1,0,0,".$totdp.",
                        ".$totbv.",".$totbv.",0,0,0,0,0,0,'0',0,0,'ID','".$pricecode."')";
        
        //echo "QUERY NEWTRD ".$insSc_newtrd."";
        //echo "<br /><br />";
        $query4 = $this->db->query($insSc_newtrd);   

                    
        // return $query4;           
        
        if(!$query1)
        {
            return 0;
        }
        else
        {
            if(!$query2)
            {
                return 0;
            }
            else
            {
                if(!$query3)
                {
                    return 0;
                }
                else
                {
                    if(!$query4)
                    {
                        return 0;
                    }
                    else
                    {
                        return 1;
                    }   
                }   
            }   
        }   
    }
    
    function show_new_member($new_id)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $sql = "SELECT a.dfno, a.fullnm, a.password, a.sponsorid, a.createnm,
               b.fullnm as sponsorname, a.sfno_reg, c.fullnm as rekruiternm
               from msmemb a 
                inner join klink_mlm2010.dbo.msmemb b on a.sponsorid=b.dfno COLLATE SQL_Latin1_General_CP1_CS_AS
                inner join klink_mlm2010.dbo.msmemb c on a.sfno_reg=c.dfno COLLATE SQL_Latin1_General_CP1_CS_AS
               where a.dfno = '$new_id'";
        
        $query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $data)
			{
				$nilai[]=$data;
			}
			return $nilai;
		}
        
    }
	
	function DecrementingLastKitNo($stk)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $sql = "update mssc SET lastkitno = lastkitno - 1 where loccd = '$stk'";
        $query = $this->db->query($sql);
        if(!$query)
        {
            return 0;
        }
        else
        {
            return 1;
        } 
    }
    
    function setLastKitToZero($stk)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $sql = "update mssc SET lastkitno = 0, lastcodememb = lastcodememb + 1 where loccd = '$stk'";
        //echo $sql;
        //echo "<br /><br />";
        $query = $this->db->query($sql);
        if(!$query)
        {
            return 0;
        }
        else
        {
            return 1;
        } 
    }
	
	function update_limitkit($username)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $upd = "update mssc SET arkit = arkit + 1 where loccd = '".$username."'";
        $query = $this->db->query($upd);
        if(!$query)
        {
            return 0;
        }
        else
        {
            return 1;
        } 
    }
	
	public function get_current_period()
    {
        $this->db = $this->load->database($this->db2, true);
        
        $qry = "SELECT a.currperiodSCO as lastperiod 
                from klink_mlm2010.dbo.syspref a";
        $query = $this->db->query($qry);
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $data)
			{
				$nilai[]=$data;
			}
			return $nilai;
		}
    }
	
	public function showKitPrdcd($username)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $sql = "select a.pricecode,a.loccd,a.kitprdcd,c.bv,c.dp
                from klink_mlm2010.dbo.mssc a
                	INNER JOIN klink_mlm2010.dbo.pricetab c on a.kitprdcd = c.prdcd COLLATE SQL_Latin1_General_CP1_CS_AS
                WHERE a.loccd = '".$username."' AND a.pricecode=c.pricecode";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $data)
			{
				$nilai[]=$data;
			}
			return $nilai;
		}
    }
    
    
    public function showKitPrdcdV($username,$prdcd)
    {
        $this->db = $this->load->database($this->db2, true);
        
        $sql = "select a.pricecode,c.prdcd,c.bv,c.dp
                from klink_mlm2010.dbo.mssc a
                  INNER JOIN klink_mlm2010.dbo.pricetab c on a.pricecode=c.pricecode COLLATE SQL_Latin1_General_CP1_CS_AS
                WHERE a.loccd = '$username' AND c.prdcd = '$prdcd'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $data)
			{
				$nilai[]=$data;
			}
			return $nilai;
		}
    }
	
}  