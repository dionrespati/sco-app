<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "product/";
        $this->load->model('product/Product_model', 'm_product');
    }

    //$route['product/search'] = 'product/product/productSearch';
    public function productSearch() {
        $data['form_header'] = "Product Search";
        $data['form_action'] = base_url('product/search/list');
        $data['icon'] = "icon-search";
        $data['form_reload'] = 'product/search';
        if ($this->username != null) {
            $this->setTemplate($this->folderView . 'productSearch', $data);
        } else {
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['product/search/list'] = 'product/product/productSearchByParam';
    public function productSearchByParam() {
        $data = $this->input->post(NULL, TRUE);
        if ($data['param'] == "prdcd") {
            $res['result'] = $this->m_product->getProductByID($data['paramValue']);
        } else if ($data['param'] == "prdnm") {
            $res['result'] = $this->m_product->getProductByName($data['paramValue']);
        } else if ($data['param'] == "P") {
            $res['result'] = $this->m_product->getListProductBundling($data['paramValue']);
        } else if ($data['param'] == "F") {
            $res['result'] = $this->m_product->getListFreeProduct($data['paramValue']);
        } else if ($data['param'] == "dis") {
            $res['result'] = $this->m_product->getListIndenProduct($data['paramValue']);
        } else if ($data['param'] == "non_knet") {
            $res['result'] = $this->m_product->getListPrdKnet($data['paramValue'], "0");
        } else if ($data['param'] == "knet") {
            $res['result'] = $this->m_product->getListPrdKnet($data['paramValue'], "1");
        }
        $this->load->view($this->folderView . 'productDetailByID', $res);
    }

    //$route['product/id/(:any)/(:any)'] = 'product/product/productSearchByID/$1/$2';
    public function productSearchByID($id, $pricecode) {
        $res = jsonFalseResponse("Invalid product code..");
        $result = $this->m_product->getProductPriceByID($id, $pricecode);
        if ($result != null) {
            $res = jsonTrueResponse($result, "");
        }
        echo json_encode($res);
    }

}
