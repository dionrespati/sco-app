<?php
class Sales_member_model extends MY_Model {
		
	function __construct() {
        // Call the Model constructor
        parent::__construct();
		//$db_connect = $this->db2;
		
    }
	
	function getListTrxByParam($searchby, $param, $bnsmonth=null, $bnsyear=null, $from=null, $to=null) {
		//dfno, cnno, batchno, trcd, orderno
		//echo "param searchby = $searchby";
		$qryParam = "";
		if($searchby == 'cnno'){ //dfno, cnno, batchno
			$qryParam = " A.invoiceno = '$param'";	
		} elseif($searchby == 'batchno'){
			$qryParam = " A.batchno = '$param' ";
		} elseif($searchby == 'trcd'){
			$qryParam = " A.trcd = '$param' OR A.orderno = '$param' ";
		} elseif($searchby == 'dfno') {
			if($bnsyear != "" || $bnsyear != null) {
				if($bnsmonth != "all"){
					$period = "$bnsyear-$bnsmonth-01";
					$qryPeriod = " A.bnsperiod = '$period' AND";
				}else{
					$qryPeriod = " YEAR(A.bnsperiod) = '$bnsyear' AND";
				}
				
				//echo $from."--------------------";
				if($from != null && $to != null){
					//echo "dsds";
					$dtfrom = date("Y/m/d", strtotime($from));
					$dtto = date("Y/m/d", strtotime($to));
					$qryParam = " (CONVERT(VARCHAR(10), A.etdt, 111) between '$dtfrom' and '$dtto') AND ";
				}
				//chk-dtrange
				$qryParam = " $qryParam $qryPeriod A.dfno='$param' ";
				//echo "$qryParam<BR/>";
			}
		}
		/*
		$qry = "SELECT  A.trcd, A.orderno, A.batchno, A.invoiceno, A.trtype, 
						A.ttptype, A.etdt, A.batchdt, A.remarks, A.createdt, 
						A.createnm, A.updatedt, A.updatenm, A.dfno, A.distnm, A.loccd, A.loccdnm, 
						A.sc_co, A.sc_conm, A.sc_dfno, A.sc_dfnonm, A.tdp, 
						A.tbv, A.bnsperiod, A.statusTrx
	   			 FROM V_HILAL_CHECK_BV_ONLINE_HDR a
	   			 WHERE $qryParam" ;
		 * 
		 */
		$qry = "SELECT  A.trcd, A.orderno, A.batchno, A.invoiceno, A.trtype, A.ttptype, 
					    MAX(A.etdt) AS etdt,  MAX(A.createdt) AS createdt, 
					    A.dfno, A.distnm, A.loccd, A.loccdnm, A.sc_co, A.sc_conm, A.sc_dfno, 
					    A.sc_dfnonm, A.tdp, A.tbv, A.bnsperiod, A.statusTrx, a.distnm, a.remarks 
	   			 FROM V_HILAL_CHECK_BV_ONLINE_HDR a
	   			 WHERE $qryParam
	   			 GROUP BY A.trcd, A.orderno, A.batchno, A.invoiceno, A.trtype, A.ttptype, 
					    A.dfno, A.distnm, A.loccd, A.loccdnm, A.sc_co, A.sc_conm, A.sc_dfno, 
					    A.sc_dfnonm, A.tdp, A.tbv, A.bnsperiod, A.statusTrx , a.distnm, a.remarks
				ORDER BY MAX(A.etdt), A.trcd" ;
	   	//echo $qry;
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}

	
	function getTrxByTrcdHead($param, $value) {
		$qry = "SELECT  TOP 1 a.trcd, a.orderno, a.batchno, a.invoiceno, a.trtype, a.ttptype, 
						a.etdt, a.batchdt, a.remarks, a.createdt, a.createnm, A.updatedt, A.updatenm, a.dfno, 
						a.distnm, a.loccd, a.loccdnm, a.sc_co, a.sc_conm, a.sc_dfno, 
						a.sc_dfnonm, a.tdp, a.tbv, a.bnsperiod, a.tglinput, a.statusTrx 
	   			 FROM V_HILAL_CHECK_BV_ONLINE_HDR a
	   			 WHERE $param = '$value'" ;
	   	//echo $qry;
	   	//echo "<br />";
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}
	
	function geTrxByTrcdDet($param, $value) {
		$qry = "SELECT  a.trcd, a.prdcd, a.prdnm, a.qtyord, a.bv, a.dp, a.TOTBV, a.TOTDP
	   			 FROM V_HILAL_CHECK_BV_ONLINE_DET a
	   			 WHERE $param = '$value'" ;
	   		//echo $qry;
	   	//echo "<br />";
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}
	
	/*
	function getStockist($loccd) {
		$qry = "SELECT a.loccd, a.fullnm AS fullnm
	   			 FROM mssc a
	   			 WHERE a.loccd = '$loccd'" ;
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}
	
	function getAllStockist() {
		$qry = "SELECT a.loccd, a.fullnm AS fullnm
	   			 FROM mssc a
	   			 WHERE a.fullnm NOT LIKE '%TERMINATION%' 
	   			 	  AND A.LOCCD NOT IN ('ADJ', 'C/S', 'D/S','PCC','LINTAS')
	   			 	  AND A.LOCCD NOT LIKE '%C/S%'
	   			 	  AND A.LOCCD NOT LIKE '%D/S%'
	   			 	  AND A.LOCCD NOT LIKE '%BLK1%'
	   			 	  AND A.LOCCD NOT LIKE '%CPC%'
	   			 	  AND A.LOCCD NOT LIKE '%GCX%'
	   			 	  AND A.LOCCD NOT LIKE '%CELEBES%'
	   			 	  AND A.fullnm NOT LIKE '%CANCEL%'
	   			 	  AND A.fullnm NOT LIKE '%CENCEL%'
	   			 ORDER BY A.sctype, A.LOCCD";
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}
	
	function getListRecapSales($param, $bnsmonth=null, $bnsyear=null) {
		$qryParam = "";
		if($bnsyear != "" || $bnsyear != null){
			$period = "$bnsyear-$bnsmonth-01";
			if($bnsmonth == "all"){
				$bnsmonthParam = "";
			}else{
				$bnsmonth = intval($bnsmonth);
				$bnsmonthParam = " AND A.bonusmth = '$bnsmonth'";
			}
			
			$qryPeriod = " WHERE A.bonusyr = '$bnsyear' $bnsmonthParam ";
			
			//echo $param;
			if($param != "all" && $param != "all-sc" && $param != "all-scandsub" && $param != "all-sub" && $param != "all-ms"){
				$qryParam = " AND A.sc_dfno = '$param' ";
			}elseif($param == "all-sc"){
				$qryParam = " AND A.sctype = '1' ";
			}elseif($param == "all-scandsub"){
				$qryParam = " AND A.sctype IN ('1','2') ";
			}elseif($param == "all-sub"){
				$qryParam = " AND A.sctype = '2' ";
			}elseif($param == "all-ms"){
				$qryParam = " AND A.sctype = '3' ";
			}
				   
			$qryParam = " $qryPeriod $qryParam ";
			//echo "$qryParam<BR/>";
		} 
		
		$qry = "SELECT A.sctype, A.sc_dfno, A.fullnm_sc, A.bonusmth, A.bonusyr, 
					   SUM(A.tdp) AS tdp, SUM(A.ndp) AS ndp, 
				       SUM(A.tbv) AS tbv, SUM(A.nbv) AS nbv
				FROM V_ECOMM_HILAL_SALES_STK a 
				$qryParam
				GROUP BY A.sctype, A.sc_dfno, A.fullnm_sc, A.bonusmth, A.bonusyr
				ORDER BY a.sctype, a.fullnm_sc" ;
	   	//echo $qry; 
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}


	function getListBonus_Vcr($param, $rptType, $bnsmonth=null, $bnsyear=null) {
		$qryParam = "";
		if($bnsyear != "" || $bnsyear != null){
			$period = "$bnsyear-$bnsmonth-01";
			if($bnsmonth == "all"){
				$bnsmonthParam = "";
			}else{
				$bnsmonth = intval($bnsmonth);
				$bnsmonthParam = " AND A.bonusmonth = '$bnsmonth'";
			}
			
			$qryPeriod = " WHERE A.bonusyear = '$bnsyear' $bnsmonthParam ";
			
			//echo $param;
			if($param == "all"){
				$qryParam = " ";
			}elseif($param == "idr"){
				$qryParam = " AND A.countrycode = 'ID' AND ";
			}elseif($param == "sar"){
				$qryParam = " AND A.countrycode = 'SA' AND ";
			}elseif($param == "tl"){
				$qryParam = " AND A.countrycode = 'TL' AND ";
			}elseif($param == "xid"){
				$qryParam = " AND A.countrycode != 'ID' AND ";
			}
				   
			$qryParam = " $qryPeriod $qryParam ";
			//echo "$qryParam<BR/>";
		} 
		
		if($rptType == "cvr" or $rptType == "pvr"){
			if($rptType == "cvr"){
				$vchtype = "'C'";
			}else{
				$vchtype = "'P'";
			}
			$qry = "SELECT a.DistributorCode, a.VoucherNo, a.vchtype, a.VoucherAmtCurr, a.VoucherAmt, a.countrycode, a.bonusyear, a.bonusmonth
					FROM tcvoucher a 
					$qryParam vchtype=$vchtype
					ORDER BY a.bonusyear desc, a.bonusmonth desc, a.countrycode DESC, a.DistributorCode ASC" ;
		}if($rptType == "allvr" OR $rptType == "chq" OR $rptType == "chq_stk" OR $rptType == "novac"){
				
			$novac = "";
			
			if($rptType == "allvr"){
				$join = "INNER ";
				$netIncome = " ";
			}elseif($rptType == "chq"){
				$join = "LEFT OUTER ";
				$netIncome = " AND c.netincome >= 20 ";
			}elseif($rptType == "chq_stk"){
				$join = "LEFT OUTER ";
				$netIncome = " AND c.netincome BETWEEN 1 AND 50 ";
			}elseif($rptType == "novac"){
				$novac = " , d.novac";
				$join = " LEFT OUTER JOIN msmemb d ON c.DistributorCode=d.dfno
						  LEFT OUTER ";
				$netIncome = " AND c.netincome BETWEEN 1 AND 50 ";
			}
			
			
			$qry = "SELECT a.DistributorCode, d.fullnm, a.VoucherNo as 'CVoucherNo', 
					   (SELECT B.VoucherNo
				       	FROM tcvoucher B 
				        WHERE B.vchtype='P' 
					  	      and B.VoucherAmtCurr < 100
				        	  and a.BonusMonth=B.BonusMonth 
				              and a.BonusYear=B.BonusYear
				              AND a.DistributorCode=B.DistributorCode) AS 'PVoucherNo', 
					   a.countrycode, a.bonusyear, a.bonusmonth, c.netincome, c.stockiestcode $novac
				FROM tbonus c
					 $join JOIN tcvoucher a ON a.BonusMonth=c.BonusMonth 
				              and a.BonusYear=c.BonusYear AND a.DistributorCode=c.DistributorCode
				     LEFT OUTER JOIN msmemb d on c.distributorcode=d.dfno
				$qryParam a.vchtype='C' $netIncome";
		}		
				
	   	//echo $qry; 
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}

	function listWHFromGNV(){
		$qry = "select A.id, A.[description], A.kode, A.warehouse_name
				from wmswarehousemaster a
				where a.[description]='WAREHOUSE'
				order by a.[description]" ;
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}
	
	function saveImportToDB($data, $whcdx) {
		$totalRecord = 0;
		$double = 0;
		$insSuccess = 0;
		$insFail = 0;
		$arrFail = array();
		$arrDouble = array();
		
		$whcdy = explode("***", $whcdx);
		$whcd = $whcdy[0];
		$whnm = $whcdy[1];
		$whid = $whcdy[2];
		
		//$nmTbl = "WMS_STOCK_AKHIR_upload";
		$nmTbl = "WMS_STOCK_AKHIR";
					
		$i = 0;
		foreach($data['xlsData'] as $list) {
			if(is_numeric($list[0][1]) && $list[0][0] != ""){
				if($i > 0){
					$totalRecord++;
					$check = $this->checkDataStockAwal($list[0][0], $whcd, $nmTbl);
					if($check) {
						
						$createDate = date("Y-m-d h:i:s");
						
						$qry = "INSERT INTO $nmTbl (kode_barang, stock_akhir, wms_warehouse	, wms_warehouse_name)
							    VALUES ('".$list[0][0]."', ".$list[0][1].", '".$whcd."', '".$whnm."')";
						//array_push($arrQry, $qry);
						//echo $qry."<BR/>";
						
					    $insExec = $this->executeQuery($qry, $this->db2);
						if($insExec > 0) {
							$insSuccess++;
						} else {
							$insFail++;
							array_push($arrFail, $list[0][0]);
						}
						//echo $qry;
					} else {
						$double++;
						array_push($arrDouble, $list[0][0]);
					}
				}
				$i++;	
			}
			
	    }
		
		if($insSuccess > 0){ //if upload stock more than 0 then update stock real to GNV
			$updqry = "EXEC SP_Hilal_UpdStockWMS_sentul '$whcd', '$whnm'";
			$SPExec = $this->executeQuery($updqry, $this->db2);
			if($SPExec > 0) {
				$msgSP = "Succes update stock.";
			} else {
				$msgSP = "Failed update stock.";
				array_push($arrFail, $msgSP);
			}
		}
		
		$arr = array("totalRecord" => $totalRecord, 
					"double" => $double, 
					"insSuccess" => $insSuccess, 
					"insFail" => $insFail,
					"arrFail" => $arrFail,
					"arrDouble" => $arrDouble,
					"msgSP" => $msgSP, 
					);
		return $arr;
	}


	function checkDataStockAwal($id, $whcd, $nmTbl) {
		$mdReturn = false;
		$qry = "SELECT * FROM $nmTbl WHERE kode_barang = '$id' AND wms_warehouse ='$whcd'";
		$res = $this->getRecordset($qry, null, $this->db2);
		if($res == null) {
			$mdReturn = true;
		}
		return $mdReturn;
	}
	
	function delDataStockAwal($whcdx) {
		$whcdy = explode("***", $whcdx);
		$whcd = $whcdy[0];
		$whnm = $whcdy[1];
		$whid = $whcdy[2];
		//$nmTbl = "WMS_STOCK_AKHIR_upload";
		$nmTbl = "WMS_STOCK_AKHIR";
		
		$mdReturn = false;
		$qry = "DELETE FROM $nmTbl WHERE wms_warehouse ='$whcd'";
		$res = $this->executeQuery($qry, $this->db2);
		if($res == null) {
			$mdReturn = true;
		}
		return $mdReturn;
	}
	
	function listBnsPeriod(){
		$qry = "select CONVERT(VARCHAR(10), A.currperiod, 111) AS currperiod, 
					   CONVERT(VARCHAR(10), A.currperiodSCO, 111) AS currperiodSCO, 
					   CONVERT(VARCHAR(10), A.currperiod, 111) AS currperiod1 
			 	from syspref a" ;
		$res = $this->getRecordset($qry, null, $this->db2);
		return $res;
	}
	
	function uptBnsPeriod($period, $param){
		$mdReturn = false;
		if($param == "1"){
			$paramUpd = "currperiodSCO";
		}elseif($param == "2"){
			$paramUpd = "currperiod";
		}
		
		$qry = "UPDATE syspref SET $paramUpd = '$period' " ;
		echo "$qry<BR/>";
		$res = $this->executeQuery($qry, $this->db2);
		if($res == null) {
			$mdReturn = true;
		}
		return $res;
	}
	
	function getTrxShippingByKWNo($id) {
		$qry = "select a.dfno, b.fullnm, a.registerno, a.trcd, a.tdp, a.tbv,  
                    a.totpay, a.ship, a.whcd
                    from ordhdr a inner join msmemb b on (a.dfno=b.dfno)
                    where a.applyto = '$id'";
	    $res = $this->getRecordset($qry, null, $this->db2);
	    if($res == null) {
	    	$tipe_trans = "CN/MSN";
	    	//Jika null maka
	    	$cn = "select a.dfno, b.fullnm,a.registerno, a.trcd, a.tdp, a.tbv,  
                    a.totpay, a.ship, a.whcd
                    from ordivhdr a inner join mssc b on (a.dfno=b.loccd)
                    where a.applyto = '$id'";
			$res2 = $this->getRecordset($cn, null, $this->db2);
			if($res2 != null) {
				$arr = array("response" => "true", "trx_type" => $tipe_trans, "arrayData" => $res2);
			} else {
				$arr = array("response" => "false", "message" => "Invalid Receipt No..");
			}
	    } else {
	    	$tipe_trans = "INVOICE";
			$arr = array("response" => "true", "trx_type" => $tipe_trans, "arrayData" => $res);
	    }
	}
	
	
    function getOperatorSMS() {
		$qry = "SELECT A.id, A.operator_desc, a.is_activated
				FROM sms_operator A
				ORDER BY A.id ";				
		$res = $this->getRecordset($qry);
		return $res;
	}
  
    */
}