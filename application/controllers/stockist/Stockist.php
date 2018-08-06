<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stockist extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "stockist/";
        $this->load->model('stockist/Stockist_model', 'm_stockist');
    }

    //$route['stockist/addr'] = 'stockist/stockist/formUpdateAddrStk';
    public function formUpdateAddrStk() {
        $data['icon'] = "icon-edit";
        $data['form_reload'] = 'stockist/addr';
        $data['form_header'] = "Update Address Stockist";
        $data['form_action'] = base_url('stockist/addr/update');
        //print_r($this->session->all_userdata());
        if ($this->username != null) {
            //cek apakah group adalah ADMIN atau BID06
            if ($this->stockist == "BID06") {
                $data['onchange'] = "onchange=Stockist.getStockistInfo(this.value)";
                $data['loccd_read'] = "";
            } else {
                $data['onchange'] = "";
                $data['loccd_read'] = "readonly=readonly";
            }
            $data['idstk'] = $this->stockist;
            $data['result'] = $this->m_stockist->getStockistInfo($this->stockist);
            $this->setTemplate($this->folderView . 'stockistUpdateAddr', $data);
        } else {
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['stockist/info'] = 'stockist/stockist/formStockistInfo';
    public function formStockistInfo() {
        $data['form_header'] = "Branch / Stockist Information";
        $data['form_action'] = base_url('stockist/addr/update');
        $data['icon'] = "icon-search";
        $data['form_reload'] = 'stockist/info';
        $data['result'] = $this->m_stockist->getStockistInfo($this->stockist);

        if ($this->username != null) {
            $this->setTemplate($this->folderView . 'stockistInfo', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['stockist/id'] = 'stockist/stockist/getDetailStockistByID/$1';
    public function getDetailStockistByID($id) {
        $arr = jsonFalseResponse("Invalid ID Stockist");
        $res = $this->m_stockist->getStockistInfo($id);
        if ($res != null) {
            $arr = jsonTrueResponse($res);
        }
        echo json_encode($arr);
    }

    //$route['stockist/addr/update'] = 'stockist/stockist/saveUpdateAddrStk';
    public function saveUpdateAddrStk() {
        if ($this->username != null) {

            $res = $this->m_stockist->updateAddrStockist();
            if ($res['response'] == "true") {
                echo setSuccessMessage($res['message']);
            } else {
                echo setErrorMessage($res['message']);
            }
        } else {
            echo sessionExpireMessage(false);
        }
    }

}
