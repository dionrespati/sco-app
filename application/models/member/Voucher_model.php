<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voucher_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    function getListVcrByParam($isdate, $param1, $param2, $param3, $searchby) {
        $join = null;

        if ($isdate == 0) {
            if ($searchby == "trcd") {
                $param = " a.invoiceno ='$param1' ";
            } elseif ($searchby == "receiptno") {
                $param = " b.trcd ='$param1' ";
            } elseif ($searchby == "vcno") {
                $param = "S.formno ='$param1' ";
                $join = " INNER JOIN klink_mlm2010.dbo.starterkit S ON A.invoiceno=S.sold_trcd ";
            }
        } elseif ($isdate == 1) {
            $param = " b.createdt BETWEEN '$param2' AND '$param3' ";
        }
        $qry = "SELECT a.category, a.ordtype, a.invoiceno, a.invoicedt, a.dfno, c.fullnm,
					   b.trcd, b.createdt, b.applyto
				FROM klink_mlm2010.dbo.ordivtrh a
					 INNER JOIN klink_mlm2010.dbo.billivhdr b on a.receiptno=b.trcd
				     INNER JOIN klink_mlm2010.dbo.mssc c ON a.dfno=c.loccd
				     $join
				WHERE a.ordtype = '5' AND $param
				ORDER BY a.invoiceno";
        //echo $qry;				
        $result = $this->getRecordset($qry, null, $this->db1);
        //var_dump($result);
        return $result;
    }

    function getListProductForSK($orderno) {
        $qry = "SELECT b.invoiceno, b.prdcd, c.prdnm, c.kit,
					b.pricecode, b.dp, b.bv, b.qtyord,
				    COUNT(d.formno) as jml_active,
				    b.qtyord - COUNT(d.formno) as sisa_qty 
				FROM klink_mlm2010.dbo.ordivtrd b
				LEFT OUTER JOIN klink_mlm2010.dbo.msprd c ON (b.prdcd = c.prdcd)
				LEFT OUTER JOIN klink_mlm2010.dbo.starterkit d ON (b.invoiceno = d.sold_trcd) AND d.prdcd = b.prdcd
				WHERE b.invoiceno = '$orderno' AND c.kit = '1'
				GROUP BY b.invoiceno, b.prdcd, c.prdnm, 
					b.pricecode, b.dp, b.bv, b.qtyord, c.kit
				";
        $result = $this->getRecordset($qry, null, $this->db1);
        if ($result == null) {
            $qry = "SELECT b.invoiceno, b.prdcd, c.prdnm, c.kit,
					b.pricecode, b.dp, b.bv, b.qtyord,
				    COUNT(d.formno) as jml_active,
				    b.qtyord - COUNT(d.formno) as sisa_qty 
				FROM klink_mlm2010.dbo.ordtrd b
				LEFT OUTER JOIN klink_mlm2010.dbo.msprd c ON (b.prdcd = c.prdcd)
				LEFT OUTER JOIN klink_mlm2010.dbo.starterkit d ON (b.invoiceno = d.sold_trcd) AND d.prdcd = b.prdcd
				WHERE b.invoiceno = '$orderno' AND c.kit = '1'
				GROUP BY b.invoiceno, b.prdcd, c.prdnm, 
					b.pricecode, b.dp, b.bv, b.qtyord, c.kit
				";
            $result = $this->getRecordset($qry, null, $this->db1);
        }
        return $result;
    }

    function getStarterkitBrOrderno($orderno, $prdcd) {
        /* $qry = "SELECT a.sold_trcd, MAX(a.formno) as max_formno, MIN(a.formno) as min_formno, a.updatenm, a.updatedt
          FROM klink_mlm2010.dbo.starterkit a
          WHERE A.sold_trcd='$orderno'
          GROUP BY a.sold_trcd, a.updatenm, a.updatedt";
         * 
         */
        $qry = "SELECT a.sold_trcd, a.formno, a.updatenm, a.updatedt, 
		                a.activate_dfno, b.fullnm, a.status, CONVERT (VARCHAR(30),a.activate_dt,103) as activate_dt
				FROM klink_mlm2010.dbo.starterkit a
				     LEFT OUTER JOIN klink_mlm2010.dbo.msmemb b on a.activate_dfno=b.dfno
				WHERE A.sold_trcd='$orderno' AND a.prdcd = '$prdcd'
				ORDER BY a.formno";
        //echo $qry;				
        $result = $this->getRecordset($qry, null, $this->db1);
        //var_dump($result);
        return $result;
    }

    function getValidVoucher($vch_start, $qty) {
        $bagian1 = substr($vch_start, 0, 6);
        $counter = substr($vch_start, 6, 6);
        $value = "";
        //echo "$voucher_from<br>";
        //echo "$bagian1<br>";
        //echo "$counter";
        $baru = $qty + $counter - 1;

        $data = array();
        $arrayKe = 0;
        for ($i = $counter; $i <= $baru; $i++) {

            $next_id = sprintf("%06s", $i);
            $y = strval($bagian1 . $next_id);
            $value .= "'" . $y . "',";
            array_push($data, $y);
            $arrayKe++;
        }
        $value = substr($value, 0, -1);
        //echo "$value<br>";
        //$lastCounter = $baru - 1;
        $arrayKe--;

        $cekAvailableVoucher = "SELECT a.sold_trcd, a.formno, a.updatenm, CONVERT(VARCHAR(10), a.updatedt, 111) as updatedt, a.activate_dfno, b.fullnm, a.status
                                  FROM klink_mlm2010.dbo.starterkit a 
                                  LEFT OUTER JOIN klink_mlm2010.dbo.msmemb b on a.activate_dfno=b.dfno
                                  WHERE a.formno IN ($value) AND a.status != '0'";
        $result = $this->getRecordset($cekAvailableVoucher, null, $this->db1);
        if ($result != null) {
            $arr = array("response" => "false", "res" => $result);
        } else {
            $arr = array("response" => "true", "res" => $data[$arrayKe]);
        }
        return $arr;
    }

    function updateReleaseVoucher($form) {
        $value = "";
        for ($i = $form['vch_start']; $i <= $form['vch_end']; $i++) {
            $value .= "'" . $i . "',";
        }
        $value = substr($value, 0, -1);

        $tgl_skrg = date("Y-m-d");

        $updStarterkit = "UPDATE starterkit SET sold_trcd = '$form[trxno]', status='1', updatenm = '$this->username', 
    	                         updatedt='$tgl_skrg', PT_SVRID = 'ID', prdcd='$form[productcode]', sold_trcdnewera = '$form[trxno]' 
    					  WHERE formno IN($value)";
        $res = $this->executeQuery($updStarterkit, $this->db2);
        if ($res > 0) {
            $arr = jsonTrueResponse(null, "Voucher berhasil di release..");
        } else {
            $arr = jsonFalseResponse("Voucher gagal di release..");
        }
        return $arr;
    }

    function getDetailVoucher($formno) {
        $cekVoucherNum = "SELECT
		                      a.status, 
					          a.vchkey,
					          a.formno,
					          a.activate_by,
					          a.prdcd,
					          c.prdnm,
					          a.updatenm,
					          a.activate_dfno,
					          b.fullnm as nama_member_aktif,
					          CONVERT(VARCHAR(30), a.updatedt, 103) AS tgl2,
					          sold_trcd,
					          sold_trcdnewera
					      FROM
					          starterkit a
					          LEFT OUTER JOIN msmemb b ON (a.activate_dfno = b.dfno)
							  LEFT OUTER JOIN msprd c ON (a.prdcd = c.prdcd)
					      WHERE
					          (a.formno = '$formno')";
        $result = $this->getRecordset($cekVoucherNum, null, $this->db2);
        //var_dump($result);
        return $result;
    }

}
