<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sales_generate extends MY_Controller {
	public function __construct() {
	    parent::__construct();
		$this->folderView = "transaction/generate/";
		$this->load->model('transaction/Sales_generate_model', 'm_sales_generate');
	}	
	
	//$route['sales/generate'] = 'transaction/sales_generate/formGenerateScoTrx';
	public function formGenerateScoTrx() {
		$data['form_header'] = "Generate Sales TTP & PVR";
        $data['form_action'] = base_url('sales/generate/list');
        $data['icon'] = "icon-edit";
		$data['form_reload'] = 'sales/generate';   		   
		   		
        if($this->username != null) {	
           //cek apakah group adalah ADMIN atau BID06
		   if($this->stockist == "BID06") {
		   	  $data['mainstk_read'] = "";
			  $data['idstkk_read'] = "";
		   } else {
		   	  $data['mainstk_read'] = "readonly=readonly";
			  $data['idstkk_read'] = "";
		   }
		   
		   $data['curr_period'] = $this->m_sales_generate->getCurrentPeriod();
           $this->setTemplate($this->folderView.'generateScoTrxForm', $data); 
        } else {
           //echo sessionExpireMessage(false);
		   $this->setTemplate('includes/inline_login', $data);
        } 
	}

	//$route['sales/search/list'] = 'transaction/sales_generate/searchUngeneratedSales';
	function searchUngeneratedSales(){
        if($this->username != null) {
            $x = $this->input->post(NULL, TRUE);
            //$username = $this->session->userdata('username');          
            if($x['searchs'] == "stock" || $x['searchs'] == "apl") {
                $x['tipess'] = 'ID Stockist';
                $x['idstk'] =  $this->m_sales_generate->getGenerateByStk($x);
                $this->load->view($this->folderView.'listGenSalesScoStk',$x);
            } else if($x['searchs'] == "pvr") {
            	$x['idstk'] =  $this->m_sales_generate->getGenerateByPVR($x);
                //print_r($x['idstk']);
                $this->load->view($this->folderView.'listGenSalesPvr',$x);
            } else {
                if($x['searchs'] == "sub") {
                    $x['tipess'] = 'Kode Sub Stk';
                    $x['namess'] = 'Nama Sub Stk';
                } else {
                    $x['tipess'] = 'Kode MS';
                    $x['namess'] = 'Nama MS';
                }
			   	
               $x['idstk'] =  $this->m_sales_generate->getGenerateBySUbMs($x);
                $this->load->view($this->folderView.'listGenSalesSco',$x);
            }
                
        }else{
            echo sessionExpireMessage();
        }
    }

    //$route['sales/detail/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'transaction/sales_generate/getDetailSales/$1/$2/$3/$4/$5';
	function getDetailSales($scco, $scDfno, $tglbns, $blnbns, $thnbns){
        $bnsperiod = $blnbns."/"."01"."/".$thnbns;
        $x['detailTtp'] = $this->m_sales_generate->get_details_salesttp($scDfno,$bnsperiod,$scco);
		//print_r($x['detailTtp']);
        $this->load->view($this->folderView.'detailSalesBySCdfno', $x);
    }
	
	//$route['sales/generate/preview'] = 'transaction/sales_generate/previewGenerate';
	public function previewGenerate() {
		$form = $this->input->post(NULL, TRUE);
	}
}	
	