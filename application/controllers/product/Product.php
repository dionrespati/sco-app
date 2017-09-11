<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Product extends MY_Controller {
	public function __construct() {
	    parent::__construct();
		$this->folderView = "product/";
		$this->load->model('product/Product_model', 'm_product');
	}
	
	
	//$route['product/search'] = 'product/product/productSearch';
	public function productSearch() {		
        if($this->username != null) {
           $data['form_header'] = "Product Search";
           $data['form_action'] = base_url('product/search/list');
           $data['icon'] = "icon-search";
		   $data['form_reload'] = 'product/search';
           $this->setTemplate($this->folderView.'productSearch', $data); 
        } else {
           echo sessionExpireMessage(false);
        } 
	}
	
	//$route['product/search/list'] = 'product/product/productSearchByParam';
	public function productSearchByParam() {
		$data = $this->input->post(NULL,TRUE);
		if($data['param'] == "prdcd") {
			$res['result'] = $this->m_product->getProductByID($data['paramValue']);		
		} else if ($data['param'] == "prdnm") {
			$res['result'] = $this->m_product->getProductByName($data['paramValue']);
		} else if($data['param'] == "P") {
			$res['result'] = $this->m_product->getListProductBundling($data['paramValue']);
		} else {
			$res['result'] = $this->m_product->getListFreeProduct($data['paramValue']);
		}
		$this->load->view($this->folderView.'productDetailByID', $res);
	}
	
	//$route['product/id/(:any)/(:any)'] = 'product/product/productSearchByID/$1/$2';
	public function productSearchByID($id, $pricecode) {
		$res = jsonFalseResponse("Invalid product code..");
		$result = $this->m_product->getProductPriceByID($id, $pricecode);	
		if($result != null) {
			$res = jsonTrueResponse($result, "");
		}
		echo json_encode($res);	
	}

}