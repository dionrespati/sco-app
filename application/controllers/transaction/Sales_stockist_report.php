<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_stockist_report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "transaction/stockist_report/";
        $this->load->model('transaction/Sales_stockist_report_model', 'm_ssr');
    }

    //$route['sales/generated/report'] = 'transaction/sales_stockist_report/formListGeneratedSales';
    public function formListGeneratedSales() {
        $data['form_header'] = "Sales Report";
        $data['form_action'] = 'sales/generated/report/list';
        $data['icon'] = "icon-search";
        $data['form_reload'] = 'sales/generated/report';
        $data['sc_dfno'] = $this->stockist;
        if ($this->username != null) {
            $data['from'] = date("Y-m-d");
            $data['to'] = date("Y-m-d");
            $data['curr_period'] = $this->m_ssr->getCurrentPeriod();
            $this->setTemplate($this->folderView . 'formListGeneratedSales', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['sales/generated/report/list'] = 'transaction/sales_stockist_report/getListGeneratedSales';
    public function getListGeneratedSales() {
        if ($this->username != null) {
            $data['form'] = $this->input->post(NULL, TRUE);
            $data['result'] = $this->m_ssr->getListGeneratedSales($data['form']);
            //print_r($data['result']);
            $this->load->view($this->folderView . 'listGeneratedSales', $data);
        } else {
            jsAlert();
        }
    }

    //$route['sales/generated/ssr/(:any)'] = 'transaction/sales_stockist_report/getDetailTrxBySSR/$1';
    public function getDetailTrxBySSR($ssrno) {
        $data['header'] = $this->m_ssr->getHeaderSsr("batchno", $ssrno);
        $data['listTTP'] = $this->m_ssr->getListSummaryTtp("batchno", $ssrno);
        $data['summaryProduct'] = $this->m_ssr->getListSummaryProduct("batchno", $ssrno);
        $this->load->view($this->folderView . 'summaryTrxBySsrNo', $data);
    }

    //$route['sales/voucher/report'] = 'transaction/sales_stockist_report/voucherReport';
    public function voucherReport() {
        $data['form_header'] = "Voucher Report";
        $data['form_action'] = 'sales/voucher/report/list';
        $data['icon'] = "icon-search";
        $data['form_reload'] = 'sales/voucher/report';
        $data['sc_dfno'] = $this->stockist;
        if ($this->username != null) {
            $data['from'] = date("Y-m-d");
            $data['to'] = date("Y-m-d");
            $data['curr_period'] = $this->m_ssr->getCurrentPeriod();
            $this->setTemplate($this->folderView . 'voucherReport', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['sales/voucher/report/list'] = 'transaction/sales_stockist_report/voucherReportList';
    public function voucherReportList() {
        if ($this->username != null) {
            $x = $this->input->post(NULL, TRUE);
            //$username = $this->session->userdata('username');          
            if ($x['searchBy'] == "VoucherNo") {
                $x['result'] = $this->m_ssr->getVoucherReportList($x['searchBy'], $x['paramVchValue']);
                //print_r($x['result']);
                $this->load->view($this->folderView . 'listVchReportByVoucherNo', $x);
            } else if ($x['searchBy'] == "DistributorCode") {
                $x['result'] = $this->m_ssr->getVoucherReportList($x['searchBy'], $x['paramVchValue']);
                //print_r($x['result']);
                $this->load->view($this->folderView . 'listVchReportByIdMember', $x);
            }
        } else {
            echo sessionExpireMessage();
        }
    }

    //$route['sales/voucher/no/(:any)'] = 'transaction/sales_stockist_report/getDetailVoucherNo/$1';
    function getDetailVoucherNo($id) {
        $x['result'] = $this->m_ssr->getVoucherReportList("VoucherNo", $id);
        $this->load->view($this->folderView . 'listVchReportByVoucherNo', $x);
    }

}
