<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voucher extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "member/voucher/";
        $this->load->model('member/Voucher_model', 'm_voucher');
    }

    //$route['voucher/search'] = 'warehouse/voucher/voucherSearchForm';
    public function voucherSearchForm() {
        $data['form_header'] = "Voucher Search & Release";
        $data['icon'] = "icon-search";
        $data['form_action'] = 'voucher/search/list';
        $data['form_reload'] = 'voucher/search';

        if ($this->username != null) {
            $this->setTemplate($this->folderView . 'voucherSearchForm', $data);
        } else {
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['voucher/search/list'] = 'warehouse/voucher/voucherSearchResult';
    function voucherSearchResult() {
        if ($this->username != null) {
            $dt = $this->input->post(NULL, TRUE);
            $searchby = $dt['searchby']; //dfno, cnno, batchno, trcd, orderno
            $paramValue = $dt['paramValue'];
            $from = $dt['trx_from'];
            $to = $dt['trx_to'];

            if (($searchby == 'trcd' || $searchby == 'receiptno') &&
                    ($paramValue != null && $paramValue != "")) {
                $data['result'] = $this->m_voucher->getListVcrByParam(0, $paramValue, $from, $to, $searchby);
                $this->load->view($this->folderView . 'voucherSearchResult', $data);
            } else if ($searchby == 'vcno' && $paramValue != "") {
                $data['result'] = $this->m_voucher->getDetailVoucher($paramValue);
                $this->load->view($this->folderView . 'voucherDetailByFormNo', $data);
            } elseif ($searchby == 'trxdt' && $from != null && $to != null) {
                $data['result'] = $this->m_voucher->getListVcrByParam(1, $paramValue, $from, $to, $searchby);
                $this->load->view($this->folderView . 'voucherSearchResult', $data);
            } else {
                redirect('backend', 'refresh');
            }
            //var_dump($data);
        } else {
            echo sessionExpireMessage(false);
        }
    }

    //$route['voucher/detail/(:any)'] = 'backend/warehouse/voucherDetail/$1';
    function voucherDetail($orderno) {
        if ($this->username != null) {
            //echo $orderno;
            $param = explode("**", $orderno);
            $count = count($param);
            $data['result'] = null;

            if ($count > 0) {
                $data['trcd'] = $param[0];
                $data['receiptno'] = $param[1];
                $data['trdt'] = $param[2];
                $data['receiptdt'] = $param[3];
                $data['stockist'] = $param[4];

                $data['result'] = $this->m_voucher->getListProductForSK($data['trcd']);
                //$data['voucherno'] = $this->s_warehouse->getStarterkitBrOrderno($data['trcd']);
            }

            if ($data['result'] == null) {
                echo "<script>alert('Data product tidak dapat ditemukan..')</script>";
            } else {
                //$this->load->view($this->folderView.'releaseVcrSKdetail', $data);
                $this->load->view($this->folderView . 'voucherDetail', $data);
            }
        } else {
            redirect('backend', 'refresh');
        }
    }

    //$route['voucher/product/(:any)/(:any)'] = 'warehouse/voucher/detailReleasedSK/$1/$2';
    public function detailReleasedSK($trxno, $prdcd) {
        $data['voucherno'] = $this->m_voucher->getStarterkitBrOrderno($trxno, $prdcd);
        $this->load->view($this->folderView . 'releasedVoucherList', $data);
    }

    //$route['voucher/check/formno/(:any)/(:any)'] = 'warehouse/voucher/checkVoucherNo/$1/$2';
    public function checkVoucherNo($voucherStart, $qty) {
        $res = $this->m_voucher->getValidVoucher($voucherStart, $qty);
        echo json_encode($res);
    }

    //$route['voucher/release'] = 'warehouse/voucher/saveReleaseVoucher';
    public function saveReleaseVoucher() {
        $data = $this->input->post(NULL, TRUE);
        try {
            $this->checkSessionBE();
            $this->form_validation->set_rules('productcode', 'Productcode', 'required|trim');
            $this->form_validation->set_rules('trcd', 'MM No', 'required|trim');
            $this->form_validation->set_rules('trxno', 'MM No', 'required|trim');
            $this->form_validation->set_rules('vch_start', 'Voucher Start', 'required|trim|min_length[11]');
            $this->form_validation->set_rules('vch_end', 'Voucher End', 'required|trim|min_length[11]');
            if ($this->form_validation->run() == TRUE) {
                $res = $this->m_voucher->updateReleaseVoucher($data);
            } else {
                $res = jsonFalseResponse("Pastikan data terisi dengan lengkap dan benar..");
            }

            echo json_encode($res);
        } catch (Exception $e) {
            $data['err_msg'] = $e->getMessage();
            $res = jsonFalseResponse($e->getMessage());
            echo json_encode($res);
        }
    }

}
