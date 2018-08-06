<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_online extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "transaction/online/";
        $this->load->model('transaction/Sales_online_model', 'm_sales_online');
    }

    //$route['sales/ol/redemp'] = 'transaction/sales_online/formOnlineRedemp';
    public function formOnlineRedemp() {
        $data['form_header'] = "Online Transaction Redemption";
        $data['form_action'] = base_url('sales/ol/redemp/list');
        $data['icon'] = "icon-search";
        $data['form_reload'] = 'sales/ol/redemp';

        if ($this->username != null) {

            $data['bnsmonth'] = $this->m_sales_online->getBnsMonth($this->stockist);
            $this->setTemplate($this->folderView . 'onlineTrxRedemp', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['sales/ol/redemp/list'] = 'transaction/sales_online/searchOnlineRedemp';
    public function searchOnlineRedemp() {
        $data = $this->input->post(NULL, TRUE);
        $data['trans'] = $this->m_sales_online->getListOnlineTrx($this->stockist, $data['bnsmonth'], $data['searchs']);
        //print_r($data['trans']);
        $this->load->view($this->folderView . 'onlineTrxRedempList', $data);
    }

    //$route['sales/ol/orderno/(:any)'] = 'transaction/sales_online/onlineTrxDetail/$1';
    public function onlineTrxDetail($orderno) {
        $data['detail'] = $this->m_sales_online->olTrxDetailPrd($orderno);
        $data['main'] = $this->m_sales_online->olTrxHeader($orderno);
        $this->load->view($this->folderView . 'onlineTrxRedempProcess', $data);
    }

    //$route['sales/ol/redemp/save'] = 'transaction/sales_online/onlineRedempSave';
    public function onlineRedempSave() {
        $orderno = $this->input->post('orderno');
        $secno = $this->input->post('secno');
        $updates = $this->input->post('updates');
        $this->load->helper('fpdf');

        if ($secno == '' || $secno == '0') {
            echo "<script>alert('Kode Security Anda Tidak Boleh Kosong')</script>";
        } else {
            $data['check'] = $this->m_sales_online->logstk($secno, $orderno);
            /* if($data['check'] != $secno)
              {
              echo "<script>alert('Kode Security Pengambilan Barang Salah')</script>";
              }
              else
              { */
            $count = $this->m_sales_online->countPrdcd($orderno, $this->stockist);
            foreach ($count as $datas) {
                $jml = $datas->TOTREC;
            }
            if ($jml == 0) {
                echo "Pengambilan Barang Dilakukan Ditempat Yang Sudah ditentukan";
            } else {
                $res = $this->m_sales_online->olTrxDetailPrd($orderno);
                $data['main'] = $this->m_sales_online->olTrxHeader($orderno);
                $ins = '';
                $data['kode_prod'] = '';

                $tgl = date("Y-m-d h:i:s");
                $unik_no = $orderno . "-" . $tgl;
                foreach ($res as $res2) {
                    $data['kode_prod'] .= $res2->prdcd . ", ";
                    $dta = $this->m_sales_online->show_detail_product_promo($res2->prdcd, $res2->qty, $res2->pricecode, $res2->dpr);
                    foreach ($dta as $dta3) {
                        //$ins .= "INSERT INTO WEB_SIS_TEMP_STOCKIST VALUES ('".$dta3->prdcd."', '".$dta3->prdnm."', ".number_format($dta3->qty,0,"","" ).", ".number_format($dta3->dp,0,"","" ).", ".number_format($dta3->bv,0,"","" ).", '$orderno', '$unik_no',0) ";.
                        $ins .= "INSERT INTO WEB_SIS_TEMP_STOCKIST VALUES ('" . $dta3->prdcd . "', '" . $dta3->prdnm . "', " . number_format($dta3->qty, 0, "", "") . ", " . number_format($dta3->dp, 0, "", "") . ", " . number_format($dta3->bv, 0, "", "") . ", '" . $orderno . "', '" . $unik_no . "'," . number_format($dta3->totdp, 0, "", "") . "," . number_format($dta3->totbv, 0, "", "") . ") ";
                    }
                }
                $data['kode_prod'] = substr($data['kode_prod'], 0, -2);
                $data['hasil'] = $this->m_sales_online->show_grouping_product_promo($ins, $unik_no, $orderno);
                $delete = $this->m_sales_online->delete_temp_WEB_SIS_TEMP_STOCKIST($unik_no);
                $this->load->view('printPDF1', $data);
            }
            //}
        }
    }

    //$route['sales/ol/reprint/(:any)'] = 'transaction/sales_online/reprintNote/$1';
    function reprintNote($orderno) {
        //$orderno = $this->input->post('orderno');
        //$this->load->model('m_sales_online');
        $this->load->helper('fpdf');
        //param = $orderno
        $data['user'] = $this->stockist;

        $data['main'] = $this->m_sales_online->olTrxHeader($orderno);
        $res = $this->m_sales_online->olTrxDetailPrd($orderno);
        $ins = '';
        $data['kode_prod'] = '';

        $tgl = date("Y-m-d h:i:s");
        $unik_no = $orderno . "-" . $tgl;
        foreach ($res as $res2) {
            $data['kode_prod'] .= $res2->prdcd . ", ";

            $totdp = $res2->dpr * $res2->qty;
            $totbv = $res2->bvr * $res2->qty;

            if (stripos($res2->prdnm, "PROMO") !== false || stripos($res2->prdnm, "BDL") !== false || stripos($res2->prdnm, "PTB") !== false) {
                $dta = $this->m_sales_online->show_detail_product_promo($res2->prdcd, $res2->qty, $res2->pricecode, $res2->dpr);
                foreach ($dta as $dta3) {
                    //$ins .= "INSERT INTO WEB_SIS_TEMP_STOCKIST VALUES ('".$dta3->prdcd."', '".$dta3->prdnm."', ".number_format($dta3->qty,0,"","" ).", ".number_format($dta3->dp,0,"","" ).", ".number_format($dta3->bv,0,"","" ).", '$orderno', '$unik_no',0) ";.
                    $ins .= "INSERT INTO WEB_SIS_TEMP_STOCKIST VALUES ('" . $dta3->prdcd . "', '" . $dta3->prdnm . "', " . number_format($dta3->qty, 0, "", "") . ", " . number_format($dta3->dp, 0, "", "") . ", " . number_format($dta3->bv, 0, "", "") . ", '" . $orderno . "', '" . $unik_no . "'," . number_format($dta3->totdp, 0, "", "") . "," . number_format($dta3->totbv, 0, "", "") . ") ";
                }
            } else {
                $ins .= "INSERT INTO WEB_SIS_TEMP_STOCKIST VALUES ('" . $res2->prdcd . "', '" . $res2->prdnm . "', " . number_format($res2->qty, 0, "", "") . ", " . number_format($res2->dpr, 0, "", "") . ", " . number_format($res2->bvr, 0, "", "") . ", '" . $orderno . "', '" . $unik_no . "'," . number_format($totdp, 0, "", "") . "," . number_format($totbv, 0, "", "") . ") ";
            }
        }
        //echo $ins;

        $data['kode_prod'] = substr($data['kode_prod'], 0, -2);
        $data['hasil'] = $this->m_sales_online->show_grouping_product_promo($ins, $unik_no, $orderno);
        $delete = $this->m_sales_online->delete_temp_WEB_SIS_TEMP_STOCKIST($unik_no);
        $this->load->view($this->folderView . 'printPDF1', $data);
    }

}
