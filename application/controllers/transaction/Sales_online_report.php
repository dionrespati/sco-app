<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_online_report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "transaction/online_sales_report/";
        $this->load->model('transaction/Sales_online_model', 'm_sales_online');
    }

    //$route['sales/ol/ip'] = 'transaction/sales_online_report/formListIncomingPayment';
    function formListIncomingPayment() {
        $data['form_header'] = "Incoming Payment Report";
        $data['form_action'] = 'sales/ol/ip/list';
        $data['icon'] = "icon-search";
        $data['form_reload'] = 'sales/ol/ip';
        $data['sc_dfno'] = $this->stockist;
        if ($this->username != null) {
            $data['from'] = date("Y-m-d");
            $data['to'] = date("Y-m-d");
            $this->setTemplate($this->folderView . 'formListIncomingPayment', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['sales/ol/ip/list'] = 'transaction/sales_online_report/getListIncomingPayment';
    function getListIncomingPayment() {
        echo "dsd";
    }

}
