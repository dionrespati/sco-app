<?php

class Sales_online_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getBnsMonth($user) {
        $view = "select bonusmonth
                from webol_trans_ok where idstk = '$user' 
                group by bonusmonth
				order by CAST(RIGHT(bonusmonth,4) AS INTEGER) DESC, CAST(LEFT(bonusmonth,2) AS INTEGER) DESC ";
        return $this->getRecordset($view, null, $this->db2);
    }

    function getListOnlineTrx($idstk, $bonusmonth, $tipe) {
        //$this->db = $this->load->database('alternate', true);
        if ($tipe == 'xx') {
            $zx = "idstk = '" . $idstk . "'";
        } elseif ($tipe == '1') {
            $zx = "idstk = '" . $idstk . "' and bonusmonth = '" . $bonusmonth . "' and status = '" . $tipe . "'";
        } else {
            $zx = "idstk = '" . $idstk . "' and bonusmonth = '" . $bonusmonth . "' and status = '" . $tipe . "'";
        }

        $rr = "select orderno,id_memb,nmmember,flag_trx,
                total_pay,bonusmonth,idstk,nmstkk,status
                from webol_trans_ok 
                where $zx and sentto = '0' order by bonusmonth";
        //echo $rr;
        //echo "<br>";
        return $this->getRecordset($rr, null, $this->db2);
    }

    function olTrxDetailPrd($orderno) {

        $view = "select orderno,prdcd,prdnm,qty,bvr,dpr, pricecode
                from webol_det_prod where orderno = '$orderno' order by prdcd";
        //echo $view;
        return $this->getRecordset($view, null, $this->db2);
    }

    function olTrxHeader($orderno) {
        $rr = "select a.orderno,a.id_memb,a.nmmember,a.total_pay,c.datetrans,
			    	a.total_bv,a.bonusmonth,a.idstk,a.nmstkk ,b.tel_hp,
			    	c.usr_login,b.fullnm as nmsponsor
			    from webol_trans_ok a
			    	INNER JOIN webol_logs_trans c on a.orderno = c.orderno
			        LEFT OUTER JOIN msmemb b on (c.usr_login = b.dfno COLLATE SQL_Latin1_General_CP1_CS_AS)
			    where a.orderno = '$orderno' and (b.dfno = c.usr_login COLLATE SQL_Latin1_General_CP1_CS_AS) ";
        //echo $rr;
        return $this->getRecordset($rr, null, $this->db2);
    }

    function show_detail_product_promo($prdcd, $qty, $pricecode, $dp) {
        //$this->db = $this->load->database('alternate', true);

        $subs = substr($prdcd, 0, 1);
        $a = str_split($subs);
        //echo  $prdcd;
        //print_r($a);
        //echo "sdsds ".$subs;

        if (in_array('3', $a)) {
            $sql = "SELECT 
                      j.prdcddet AS prdcd,
                      '(*) ' + j.prdcdNmDet AS prdnm,
                      j.qty * $qty AS qty,
                      (h.dp * 0) + ($dp * $qty) AS totdp,
                      0 AS dp,
                      h.bv,
                      h.bv * $qty as totbv
                    
                    FROM
                      newera_PRDDET j
                      INNER JOIN pricetab h ON (j.prdcdCat = h.prdcd)
                      AND (h.pricecode = '$pricecode')
                    WHERE
                      (j.prdcdCat = '$prdcd')
                    ORDER BY
                      j.prdcdCat";
            //echo $sql;
        } else {
            //original from ana
            $sql = "SELECT j.prdcdDet as prdcd, 
		    			   j.prdcdNmDet as prdnm, 
		    			   j.qty * $qty as qty, 
                		   (h.dp * j.qty) * $qty as totdp,
		     			   h.dp,
		    			   h.bv, 
		    			   (h.bv * j.qty) * $qty as totbv
                from newera_PRDDET j inner JOIN pricetab h
                ON j.prdcdDet = h.prdcd and h.pricecode = '$pricecode'
                WHERE j.prdcdCat = '$prdcd'
                order by j.prdcdCat";
            /*
              //edit hilal @2017-02-02
              $sql="SELECT A.prdcd,
              A.prdnm,
              $qty as qty,
              (B.dp * $qty) as totdp,
              B.dp,
              B.bv,
              (B.bv * $qty) as totbv
              FROM msprd A
              INNER JOIN pricetab B ON A.prdcd=B.prdcd
              WHERE A.prdcd='$prdcd' AND B.pricecode='$pricecode'";
             */
        }
        //echo $sql;
        //echo "<br>";
        return $this->getRecordset($sql, null, $this->db2);
    }

    function show_grouping_product_promo($ins, $unik, $orderno) {
        //$this->db = $this->load->database('alternate', true);
        $query = $this->executeQuery($ins, $this->db2);

        /* $qry = "SELECT prdcd, prdnm, SUM(qty) AS qty, SUM(dp) AS total_dp, SUM(bv) AS total_bv
          FROM WEB_SIS_TEMP_STOCKIST
          where session_id = '".$unik."'
          GROUP BY prdcd, prdnm"; */
        $qry = "SELECT * FROM WEB_SIS_TEMP_STOCKIST
                where session_id = '" . $unik . "' and idmember = '$orderno'
                order by idmember,session_id";
        //echo "dhfdf ".$qry;
        return $this->getRecordset($qry, null, $this->db2);
    }

    function delete_temp_WEB_SIS_TEMP_STOCKIST($unik) {
        $del = "DELETE FROM WEB_SIS_TEMP_STOCKIST
                where session_id = '" . $unik . "'";
        $del = $this->executeQuery($del, $this->db2);
    }

    function logstk($secno, $orderno) {
        //$this->db = $this->load->database('alternate', true);

        date_default_timezone_set("Asia/Jakarta");
        $tgl_updt = date("Y-m-d H:i:s ");
        $cek = $this->input->post('check');
        //$orderno = $this->input->post('orderno');
        $jumlah = count($cek);

        $cek = "select orderno,secno,status,idstk from webol_trans_ok
                where secno = '$secno' and orderno = '$orderno'";
        echo $cek;
        $res = $this->getRecordset($cek, null, $this->db2);
        //print_r($query);
        if ($res != null) {
            //$rows = $query->row();
            $secnum = $res[0]->secno;
            $statuss = $res[0]->status;
            $stk = $res[0]->idstk;
            //echo "Secnum : ".$secnum. " secno : ".$secno;
            if ($secnum !== $secno) {
                echo "<script>alert('Kode Security Salah')</script>";
            } elseif ($statuss == '1') {
                echo "<script>alert('Data Sudah Di Cetak')</script>";
            } else {

                $insert = "insert into webol_logs_stockist (orderno,userlogin,tgl_ambil)
                            values('$orderno','$stk','$tgl_updt')";
                //echo $insert;
                $query = $this->executeQuery($insert, $this->db2);

                $update = "update webol_trans_ok set status = 1 
                            where orderno = '$orderno'";
                //echo $update;
                $query = $this->executeQuery($update, $this->db2);
            }
            return $res;
        }
    }

    function countPrdcd($orderno, $username) {
        $qry = "select COUNT(*) AS TOTREC
                from webol_det_prod A 
                inner join webol_trans_ok c on a.orderno = c.orderno COLLATE SQL_Latin1_General_CP1_CI_AS 
                where A.orderno = '" . $orderno . "' AND c.idstk = '" . $username . "' and
	            A.prdcd COLLATE SQL_Latin1_General_CP1_CI_AS NOT IN 
                (SELECT B.prdcd FROM newera_PRDCAT_REJECT B)";
        return $this->getRecordset($qry, null, $this->db2);
    }

}
