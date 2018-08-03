<?php
class Sales_stockist_model extends MY_Model {
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
	
	function getListSalesStockist($data, $tipe) {
		$param = "";
		if($data['searchby'] == "trcd" || $data['searchby'] == "orderno") {
			$s = "a.".$data['searchby'];
			$param .= "$s = '$data[paramValue]' and a.flag_batch = '0'";
		} else if($data['searchby'] == "sc_dfno") {
			$param .= "a.sc_dfno = '$data[paramValue]' and a.flag_batch = '0' 
			          and CONVERT(char(10), a.etdt,126) BETWEEN '$data[from]' AND '$data[to]'";
		} else {
			$s = "a.".$data['searchby'];
			$param .= "$s = '$data[paramValue]'";
		}
    	$qry = "SELECT 
				  a.orderno,
				  a.trcd,
				  a.pricecode,
				  CONVERT(char(10), a.etdt,126) as etdt,
				  a.bnsperiod,
				  a.dfno,
				  b.fullnm,
				  a.loccd,
				  a.sc_dfno,
				  a.sc_co,
				  a.tdp,
				  a.tbv,
				  a.entrytype,
				  flag_batch
				FROM sc_newtrh a
				   LEFT OUTER JOIN klink_mlm2010.dbo.msmemb b ON (a.dfno = b.dfno)  
				WHERE $param AND a.trtype = '$tipe' ORDER BY a.trcd";	
		//echo $qry;		
		return $this->getRecordset($qry, null, $this->db1);
	}	

	function getTrxByTrcdHead($param, $id) {
		$qry = "SELECT a.trcd, a.orderno, a.batchno, a.trtype, a.ttptype, a.trtype,
	                 a.etdt, a.batchdt, a.remarks, a.createdt, a.createnm, a.updatedt, a.updatenm, a.dfno, b.fullnm as distnm,
	                 a.loccd, c.fullnm as loccdnm, c.sctype as sctype,
	                 a.sc_co, c.fullnm as sc_conm, c.sctype as co_sctype,
	                 a.sc_dfno, c.fullnm as sc_dfnonm, c.sctype as loccd_sctype,
	                 a.tdp, a.tbv, a.bnsperiod,
	                 CONVERT(char(10), a.etdt,126) as tglinput
                FROM sc_newtrh a
	                LEFT OUTER JOIN klink_mlm2010.dbo.msmemb b ON a.dfno = b.dfno
					LEFT OUTER JOIN klink_mlm2010.dbo.mssc c ON a.sc_dfno = c.loccd
					LEFT OUTER JOIN klink_mlm2010.dbo.mssc d ON a.sc_co = d.loccd
					LEFT OUTER JOIN klink_mlm2010.dbo.mssc e ON a.loccd = e.loccd
				WHERE a.$param = '$id'";
          return $this->getRecordset($qry, null, $this->db1);
	}
	
	function getDetailProduct($param, $id) {
		  $qry = "SELECT A.trcd, A.prdcd, b.prdnm, A.qtyord, A.bv, A.dp, (A.qtyord*A.bv) AS TOTBV, (A.qtyord*A.dp) AS TOTDP
				  FROM sc_newtrd A
				  LEFT OUTER JOIN klink_mlm2010.dbo.msprd b ON a.prdcd=b.prdcd
				  WHERE a.$param = '$id'";	
		  return $this->getRecordset($qry, null, $this->db1);
	}
	
	function getDetailPayment($param, $id) {
		  $qry = "SELECT a.paytype, docno, payamt, b.description
				  FROM sc_newtrp A
				  LEFT OUTER JOIN klink_mlm2010.dbo.paytype b ON a.paytype=b.id
				  WHERE a.$param = '$id'";	
		  return $this->getRecordset($qry, null, $this->db1);
	}
	
	
	
	function getCurrentPeriod()
    {
        $qry = "SELECT a.currperiodSCO as lastperiod, 
                DATEADD(month, 1, a.currperiodSCO) as nextperiod 
                from klink_mlm2010.dbo.syspref a"; //edit by hilal 28-06-2014
		
        $res = $this->getRecordset($qry, null, $this->db2);
		return $res;
    } 
    
    function getStockistInfo($idstockist) {
    	$qry = "SELECT loccd, fullnm, sctype FROM mssc WHERE loccd = '$idstockist'";
        $res = $this->getRecordset($qry, null, $this->db2);
		return $res;
    }
    
    function getListPaymentType() {
    	$qry = "SELECT id, description
    	        FROM paytype WHERE id IN ('01', '08')"; //edit by hilal 28-06-2014
		
        $res = $this->getRecordset($qry, null, $this->db2);
		return $res;
    }
    
    function getListPaymentProductVoucher() {
    	$qry = "SELECT id, description
    	        FROM paytype WHERE id IN ('10')"; //edit by hilal 28-06-2014
		
        $res = $this->getRecordset($qry, null, $this->db2);
		return $res;
    }
    
    function checkValidCashVoucher($distributorcode,$vchnoo, $vchtype) {
    	$datee = date("m/d/Y");
        $month = date("m");
        $year = date("Y");
		
		$threeDigit = substr($vchnoo, 0, 3); 
       // $vchnoo1 = substr($vchnoo,0,1);
       
        /*$qry = "SELECT a.claimstatus, 
                       a.DistributorCode, a.VoucherNo as VoucherNo,
                       a.vchtype,a.VoucherAmt,
                       MONTH(a.ExpireDate) as monthExpire,
                       year(a.ExpireDate) as yearExpire
                FROM klink_mlm2010.dbo.tcvoucher a
                WHERE a.VoucherNo = '".$vchnoo."' and a.DistributorCode = '".$distributorcode."'
                and a.claimstatus = '0' 
                and MONTH(a.ExpireDate) >= '".$month."' and year(a.ExpireDate) = '".$year."'
                and a.vchtype = 'C'";*/
		$fieldCek = "VoucherNo";
		if($vchtype == "C") {
			$fieldCek = "voucherkey";
		}	
				
		$qry = "SELECT a.claimstatus, 
				       a.DistributorCode, a.VoucherNo as VoucherNo,
				       a.vchtype,a.VoucherAmt, a.vchtype, a.loccd,
					   CONVERT(char(10), a.claim_date,126) as claim_date,
				       CONVERT(char(10), a.ExpireDate,126) as ExpireDate,
				       CONVERT(char(10), GETDATE(),126) as nowDate,
				       CASE 
				           WHEN CONVERT(char(10), GETDATE(),126) > CONVERT(char(10), a.ExpireDate,126) THEN '1'
				           ELSE '0'
				       END AS status_expire
                FROM tcvoucher a
                WHERE a.$fieldCek = '".$vchnoo."' and a.DistributorCode = '".$distributorcode."' AND a.vchtype = '$vchtype'
                ";
        //echo $qry;
		$res = $this->getRecordset($qry, null, $this->db2);
		
		$res2 = null;
		if($res != null && $threeDigit == "XPV" || $threeDigit == "ZVO" || $threeDigit == "XPP") {
			$detProd = "SELECT * FROM TWA_KLPromo_Oct17_D WHERE Voucherno = '$vchnoo'";
			$res2 = $this->getRecordset($detProd, null, $this->db2);
		}
		
		return array("arrayData" => $res, "detProd" => $res2);
    }
    
    function saveTrx($data) {
    	//CHECK apakah ID MEMBER valid
    	$validMemb = $this->getValidDistributor($data['dfno']);
    	if($validMemb != null) {
    		$arr = array(
	    		"table" => "sc_newtrh",
	    		"param" => "orderno",
	    		"value" => $data['orderno'],
	    		"db" => $this->db2,
	    	);
	    	
	    	//Check Order no apabila tipe sales adalah INPUT SALES
	    	$checkOrderno = null;
	    	if($data['ins'] == "1") {
	    		$checkOrderno = $this->checkExistingRecord($arr);	
	    	}
			
			//CHECK apakah ORDERNO double
			if($checkOrderno == null) {
				
				/*---------------------------------------------------------------
				 * PROSES PEMBAYARAN, SET values utk multiple insert ke sc_newtrp
				 * --------------------------------------------------------------*/
				$jumPay = count($data['payChooseType']);
				$totalNilaiVoucher = 0;
				$totalCash = 0;
				$totalBayar = 0;
				$cv = 0;
				$pv = 0;
				$qryAddPay = "";
				$qryUpdVoucher = "";
				$j = 0;
				$no_bv = false;
				for($i=0;$i<$jumPay;$i++) {
					$j++;
					//Jika pembayaran menggunakan Voucher Cash / Voucher Produk
					if($data['payChooseType'][$i] == "08" || $data['payChooseType'][$i] == "10") {
						
						//Bila dibayar pakai Voucher Product
						//BV = 0
						if($data['payChooseType'][$i] == "10") {
							$no_bv = true;
							$pv++;
						} else {
							$cv++;							
						}
						
						$payChooseValue = intval(str_replace('.', '', $data['payChooseValue'][$i]));
						$data['payChooseValue'][$i] = $payChooseValue;
						$totalNilaiVoucher += $payChooseValue;
						$totalBayar += $payChooseValue;
						$qryAddPay .= "('DION_TRCD', ".$j.",'".$data['payChooseType'][$i]."','".$data['payReff'][$i]."',".$data['payChooseValue'][$i].",0,'','0','ID','1'), ";
							
						$qryUpdVoucher .= "'".$data['payReff'][$i]."', ";
						
						//trcd,seqno,paytype,docno,payamt,deposit,notes,trcd2,PT_SVRID,voucher
						
					} else {
						$cash = intval(str_replace('.', '', $data['payChooseValue'][$i]));
						$totalCash += $cash;
						$data['payChooseValue'][$i] = $cash;
						$totalBayar += $cash;
					}
					
				}
				//END
				/*---------------------------------------------------------------
				 * DETAIL PRODUK, SET values utk multiple insert ke sc_newtrd
				 * --------------------------------------------------------------*/
				$jum = count($data['prdcd']);
				$totBV = 0;
				$totDP = 0;
				$qryAddProduct = "";
				for($i=0;$i<$jum;$i++) {
					$dp = intval(str_replace('.', '', $data['harga'][$i]));
					$bv = intval(str_replace('.', '', $data['poin'][$i]));
					$totBV += $data['jum'][$i] * $bv;
					$totDP += $data['jum'][$i] * $dp;
					if($no_bv == true) {
						$data['poin'][$i] = 0;
						$data['sub_tot_bv'][$i] = 0;
					} else {
						$data['poin'][$i] = $bv;
						$data['sub_tot_bv'][$i] = $totBV;
					}
					$data['harga'][$i] = $dp;
					$data['sub_tot_dp'][$i] = $totDP;
					$qryAddProduct .= "('DION_TRCD','".$data['prdcd'][$i]."', ".$data['jum'][$i].", 0, 0, ".$data['harga'][$i].", ".$data['poin'][$i].", ".$data['poin'][$i].", ";
					$qryAddProduct .= "0,0,0,0,0,0,'0',0,0,'ID','".$data['pricecode']."'), ";
				}	
				$qryAddProduct = substr($qryAddProduct, 0, -2);
				//END
				/*----------------------------------------
				 * Pembayaran campuran antara cash dan voucher
				 * nilai cash yang diinput dihitung setelah
				 * menghitung total nilai voucher
				 * ---------------------------------------*/
				$change = ($totalCash + $totalNilaiVoucher) - $totDP;
				$sisaCash = $totalCash - $change;
				if($sisaCash > 0) {
					$qryAddPay .= "('DION_TRCD', ".$j.",'01','',".$sisaCash.",0,'','0','ID','0'), ";
				}	
				$qryAddPay = substr($qryAddPay, 0, -2);
				$qryUpdVoucher = substr($qryUpdVoucher, 0, -2);
				//END
				if($totDP > $totalBayar) {
					$return = jsonFalseResponse("Pembayaran kurang, total harga produk : $totDP, total pembayaran : $totalBayar");
				} else {
					//$return = jsonTrueResponse($data, "ok");
					$jenis = "id";
					if($cv > 0) {
						$jenis = "cv";
					} else if($pv > 0) {
						$jenis = "pv";
					} 
					//$res['cek_seQ'] = $this->cek_seQ($jenis);
                    //$data['idnoo'] = $this->get_idno($jenis);
                    
                    $qryRes = array(
						"jenis" => $jenis,
						"qryProduct" => $qryAddProduct,
						"qryPayment" => $qryAddPay,
						"updVoucher" => $qryUpdVoucher,
						"data" => $data,
						"totDP" => $totDP,
						"totBV" => $totBV
					);
                    
					
						$return = $this->insertTrxStockist($qryRes);
						return $return;
					
                  	
			   }
			} else {
				$return = jsonFalseResponse("No TTP sudah ada di database..");
			}
    	} else {
    		$return = jsonFalseResponse("ID Member tidak valid..");
    	}
    	return $return;
    }
    
    function insertTrxStockist($arrQuery) {
    		$trcd = "";
    		$db_qryx = $this->load->database('db_sco', true);
    		//$db_qryx = $this->load->database('klink_mlm2010', true);
			$db_qryx->trans_begin();
			$datax = $arrQuery['data'];
  			if($datax['ins'] == "1") {
  				$cek_seQ = $this->cek_seQ($arrQuery['jenis']);
                $trcd = $this->get_idno($arrQuery['jenis']);
                //$trcd = "PV09090";
  			} else {
  				$trcd = $datax['trcd'];
				
				//delete sc_newtrh
				$del_1 = "DELETE FROM sc_newtrh WHERE trcd = '$trcd'";
				$exe_del1 = $db_qryx->query($del_1);
				
				//delete sc_newtrd
				$del_2 = "DELETE FROM sc_newtrd WHERE trcd = '$trcd'";
				$exe_del2 = $db_qryx->query($del_2);
				
				//delete sc_newtrp
				$del_3 = "DELETE FROM sc_newtrp WHERE trcd = '$trcd'";
				$exe_del3 = $db_qryx->query($del_3);
  			}
			
			$pref_trcd = substr($trcd, 0, 2);
    		//$cek_seQ = $this->cek_seQ($arrQuery['jenis']);
            //$trcd = $this->get_idno($arrQuery['jenis']);
            
			
			
			//INSERT PRODUCT
            $prd = str_replace('DION_TRCD', $trcd, $arrQuery['qryProduct']);
            $insDet = "insert into sc_newtrd 
                        (trcd,prdcd,qtyord,qtyship,qtyremain,dp,pv,bv,taxrate,sp,sb,scdisc,seqno,scdiscamt,syn2web,qty_used,qty_avail,
                        PT_SVRID,pricecode) VALUES $prd";
            //echo $insDet;
			$query1 = $db_qryx->query($insDet);
            
            
            
			//INSERT PAYMENT
			$pyment = str_replace('DION_TRCD', $trcd, $arrQuery['qryPayment']);
			$insDetTrf = "insert into sc_newtrp (trcd,seqno,paytype,docno,payamt,deposit,notes,trcd2,PT_SVRID,voucher) 
                        VALUES $pyment";
			//echo $insDetTrf;
			$query2 = $db_qryx->query($insDetTrf);
			
			if($arrQuery['updVoucher'] != "") {
				//UPDATE VOUCHER
				$updVc = "UPDATE tcvoucher SET claimstatus = '1', updatenm = '".$this->stockist."', updatedt = '$this->dateTime' 
				          WHERE VoucherNo IN ($arrQuery[updVoucher])";
				//echo $updVc;
				$query2 = $db_qryx->query($updVc); 
			}
			//INSERT HEADER
			 $folderGets = explode('/', $datax['bnsperiod']);
	        $x['month'] = $folderGets[0];
	        $x['year'] = $folderGets[1];
	        $bonusperiod = $x['month']."/"."1"."/".$x['year'];
			$stockistid = $this->session->userdata('stockist');
			$sctypee = $this->session->userdata('group_scoapp');
			$createdt = date('Y-m-d H:i:s');
			$trdt = date('Y-m-d');
			
			$ttptype = "SC";
			if($datax['sctype'] == "3" || $datax['sctype'] == "2") {
				$ttptype = "SUBSC";
			} 
			
			//set trtype VP1 jika pembayaran non BV menggunakan Voucher Product
			
			if($pref_trcd == "PV") {
				$trxtype = "VP1";
				$totalBV = 0;
			} else {
				$trxtype = "SB1";
				$totalBV = $arrQuery['totBV'];
			}
			
			$insHead = "insert into sc_newtrh 
                (trcd,trtype,trdt,dfno,loccd,tdp,taxrate,taxamt,discamt,shcharge,
                othcharge,tpv,tbv,npv,nbv,ndp,whcd,branch,pricecode,
                paytype1,paytype2,paytype3,pay1amt,pay2amt,pay3amt,totpay,createnm,
                updatenm,post,sp,sb,taxable,taxableamt,ordtype,createdt,
                orderno,type,scdiscrate,scdiscamt,sctype,scdisc,generate,statusbo,
                syn2web,n_bc,status,autorecon,first_trx,bc,PT_SVRID,sc_dfno,
                sc_co,bnsperiod,remarks,othdisc,flag_batch,batchstatus,flag_recover,
                system,ttptype,entrytype,flag_show,flag_approval)
                values
                ('".$trcd."','$trxtype','".$trdt."','".$datax['dfno']."',
                '".$datax['loccd']."',".$arrQuery['totDP'].",10,0,0,0,0,".$totalBV.",".$totalBV.",
                ".$totalBV.",".$totalBV.",".$arrQuery['totDP'].",'WH001','B001','".$datax['pricecode']."',
                '01','01','03',".$arrQuery['totDP'].",0,0,".$arrQuery['totDP'].",'".$stockistid."','".$stockistid."',
                '0',0,0,0,0,'0','".$createdt."','".$datax['orderno']."','0',0,0,'".$datax['sctype']."','1','0','0','0',
                0,'0','0','0','1','ID','".$datax['sc_dfno']."',
                '".$datax['sc_co']."','".$bonusperiod."','".$datax['remarks']."',
            	0,'0','0','0','0','$ttptype',4,'0','0')";
            //echo $insHead;
            $query3 = $db_qryx->query($insHead);
            
            if ($db_qryx->trans_status() === FALSE) {
                    $db_qryx->trans_rollback();
			        $return = array("response" => "false", "message" => "Data sales gagal disimpan..");
					return $return; 
            } else {
                    $db_qryx->trans_commit();
			        
			        $arrx = array(
			 			"trcd" => $trcd, 
			 			"orderno" => $datax['orderno'],
			 			"dfno" => $datax['dfno'], 
			 			"fullnm" => $datax['fullnm'], 
			 			"totalDP" => $arrQuery['totDP'], 
			 			"totalBV" => $totalBV,
			 			"pref_trcd" => $pref_trcd,
			 			"ins" => $datax['ins']
			    	); 
			        $return = array("response" => "true", "message" => "Data sales berhasil disimpan..", "data" => $arrx);
					return $return; 
            }
    }
    
    function cek_seQ($tipe_pay) // dipake
    {
        $this->db = $this->load->database('db_sco', true);
        $y1=date("y");
        $m=date("m");
        
        //$this->db->trans_begin();
        
        //if(in_array('p',$tipe_pay))
        if($tipe_pay == 'pv')
        {
            $tbl = "SEQ_PV"."$y1"."$m";
        }elseif($tipe_pay == 'cv'){
        	$tbl = "SEQ_CV"."$y1"."$m";
        }else{
            $tbl = "SEQ_ID"."$y1"."$m";
        }
 
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
        
        /*if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        } */     
        
        return $query;
    }

	function get_idno($tipe_pay) // dipake
    {
        $this->db = $this->load->database('db_sco', true);
        $y1=date("y");
        $m=date("m");
        
        //$this->db->trans_begin();
        
        //if(in_array('p',$tipe_pay))
        if($tipe_pay == 'pv')
        {
            $tbl = "SEQ_PV"."$y1"."$m";
        }elseif($tipe_pay == 'cv'){
        	$tbl = "SEQ_CV"."$y1"."$m";
        }else{
            $tbl = "SEQ_ID"."$y1"."$m";
        }
 
        $qry = "SELECT * FROM $tbl 
           		 WHERE SeqID = ( SELECT MAX(SeqID) FROM $tbl )";
        
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
        
        if($tipe_pay == 'pv')
        //if(in_array('10',$tipe_pay))
        {
            $y =  strval("PV".$prefix.$next_seq);
		}elseif($tipe_pay == 'cv'){
			$y =  strval("CV".$prefix.$next_seq);
		}else{
            $y =  strval("ID".$prefix.$next_seq);
        }
            /*echo "<br>";
            echo $y;
            echo "<br>";*/
         
         /* if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }   */   
       
         return $y;
    }
}