<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_stockist extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "transaction/stockist/";
        //$this->load->model('transaction/Sales_stockist_model', 'm_stockist_trans');
    }

}
