<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sales_stockist extends MY_Controller {
	public function __construct() {
	    parent::__construct();
		$this->folderView = "transaction/stockist/";
		
	}	
	
	//$route['sales/stk/ttp/input'] = 'transaction/sales_stockist/inputTTP';
	public function inputTTP() {
		$data['form_header'] = "Input TTP Stockist";
        $data['form_action'] = "sales/stk/ttp/input";
        $data['icon'] = "icon-pencil";
		$data['form_reload'] = 'sales/stk/ttp/input';   		   
		   		
        if($this->username != null) {
           $data['from'] 	= date("Y-m-d");
           $data['to'] 	= date("Y-m-d");
		   $data['sc_dfno'] 	= $this->stockist;			
		  // $data['stk_barcode_opt'] = $this->m_stock_barcode->getListStkbarMenu($this->groupid);   
		   $this->setTemplate($this->folderView.'inputTTP', $data); 
        } else {
           $this->setTemplate('includes/inline_login', $data);
        } 
	}

	//$route['sales/stk/input/list'] = 'transaction/sales_stockist/getListInputSalesStockist';
	public function getListInputSalesStockist() {
		
		if($this->username != null) {
			$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$data['form'] = $this->input->post(NULL, TRUE);
			$data['result'] = $this->m_sales_stk->getListSalesStockist($data['form'], "SB1");
			$this->load->view($this->folderView.'inputTTPListResult',$data);	
		} else {
           jsAlert();
        } 
	}

    //$route['sales/stk/update/(:any)/(:any)'] = 'transaction/sales_stockist/updateTrx/$1/$2';
	public function updateTrx($param, $id) {
		if($this->username != null) {
			//$this->load->model("transaction/sales_member_model", "m_sales_member");
			$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$data['header'] = $this->m_sales_stk->getTrxByTrcdHead($param, $id);
			if($data['header'] != null) {
				$data['form_action'] = "sales/stk/save";
				$data['sctype'] = $data['header'][0]->sctype;
			    $data['co_sctype'] = $data['header'][0]->co_sctype;
					
				if($data['header'][0]->trtype == "VP1") {
					$data['prd_voucher'] = 1;
					$data['listPay'] = $this->m_sales_stk->getListPaymentProductVoucher();
				} else {
					$data['prd_voucher'] = 0;
					$data['listPay'] = $this->m_sales_stk->getListPaymentType();
				}
				
				$data['detail'] = $this->m_sales_stk->getDetailProduct("trcd", $data['header'][0]->trcd);
				$data['payment'] = $this->m_sales_stk->getDetailPayment("trcd", $data['header'][0]->trcd);
				$data['currentperiod']= $this->m_sales_stk->getCurrentPeriod();
				$data['ins'] = "2";
				$data['pricecode'] = $this->pricecode;
				$data['start_tabidx'] = 7;
				
				$this->load->view($this->folderView.'inputTTPSubForm2',$data);	
				$this->load->view($this->folderView.'viewProductPayment',$data);
			} else {
				jsAlert("Transaction ID : $id is Invalid..");
			}
			
		} else {
           jsAlert();
        } 
	}

	//$route['sales/stk/info/(:any)'] = 'transaction/sales_stockist/getStockistInfo/$1';
	public function getStockistInfo($ids) {
		if($this->username != null) {
			$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$hasil = jsonFalseResponse("Kode Stockist Salah..");
			$arr = $this->m_sales_stk->getStockistInfo($ids);
			if($arr != null) {
				$hasil = jsonTrueResponse($arr);
			}
			echo json_encode($hasil);
			//echo "string";
		} else {
           jsAlert();
        } 
	}
	
	
	
	//$route['sales/stk/input/form'] = 'transaction/sales_stockist/inputTrxForm';
	public function inputTrxForm() {
		if($this->username != null) {
			$this->load->model("transaction/sales_member_model", "m_sales_member");
			$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$data['currentperiod']= $this->m_sales_member->getCurrentPeriod();
			$data['form_action'] = "sales/stk/save";
			$data['ins'] = "1";
			$data['stockist'] = $this->stockist;
			$data['stockistnm'] = $this->stockistnm	;
			$data['pricecode'] = $this->pricecode;
			$sctype = $this->m_sales_stk->getStockistInfo($data['stockist']);
			$data['sctype'] = $sctype[0]->sctype;
			$data['listPay'] = $this->m_sales_stk->getListPaymentType();
			$data['start_tabidx'] = 5;
			$this->load->view($this->folderView.'inputTTPForm',$data);	
			$this->load->view($this->folderView.'viewProductPayment',$data);
			
		} else {
           jsAlert();
        } 
	}
	
	//$route['sales/stk/save'] = 'transaction/sales_stockist/saveTrxStockist';
	public function saveTrxStockist() {
		if($this->username != null) {
			$this->load->library('form_validation');
			$data = $this->input->post(NULL, TRUE);
			
			if ($this->form_validation->run('inputTtpStockist') === TRUE) {
    			
				$jum = count($data['prdcd']);
				if($jum == 0) {
					echo json_encode(jsonFalseResponse("Produk tidak boleh kosong.."));
				} else if(!isset($data['payChooseType'])) {
					echo json_encode(jsonFalseResponse("Pembayaran tidak boleh kosong.."));
				} else {
					$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
					$res = $this->m_sales_stk->saveTrx($data);	
					echo json_encode($res);
				}
			} else {
				$this->form_validation->set_error_delimiters("","");
			    echo json_encode(jsonFalseResponse(validation_errors()));
			    //jsAlert(validation_errors());
			}
			
		} else {
           jsAlert();
        } 
	}
	
	//$route['sales/sub/ttp/input'] = 'transaction/sales_stockist/inputTtpSub';
	public function inputTtpSub() {
		$data['form_header'] = "Input TTP MS/Sub/Stockist";
        $data['form_action'] = "sales/sub/ttp/input";
        $data['icon'] = "icon-pencil";
		$data['form_reload'] = 'sales/sub/ttp/input';   		   
			
        if($this->username != null) {
        	$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
           $data['from'] 	= date("Y-m-d");
           $data['to'] 	= date("Y-m-d");
		   $data['sc_dfno'] 	= $this->stockist;	
		   $data['payment'] = null;	
		  // $data['stk_barcode_opt'] = $this->m_stock_barcode->getListStkbarMenu($this->groupid);   
		   $this->setTemplate($this->folderView.'inputTTPSub', $data); 
        } else {
           $this->setTemplate('includes/inline_login', $data);
        } 
        //echo "sds";
	}
    //intval(str_replace(',', '', $myVal))
	//$route['sales/sub/input/form'] = 'transaction/sales_stockist/inputTrxFormSub';
	public function inputTrxFormSub() {
		if($this->username != null) {
			//$this->load->model("transaction/sales_member_model", "m_sales_member");
			$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$data['form_action'] = "sales/stk/save";
			$data['currentperiod']= $this->m_sales_stk->getCurrentPeriod();
			$data['ins'] = "1";
			$data['stockist'] = $this->stockist;
			$data['stockistnm'] = $this->stockistnm	;
			$data['pricecode'] = $this->pricecode;
			$data['listPay'] = $this->m_sales_stk->getListPaymentType();
			$data['start_tabidx'] = 7;
			$sctype = $this->m_sales_stk->getStockistInfo($data['stockist']);
		    $data['sctype'] = $sctype[0]->sctype;
			$data['co_sctype'] = $sctype[0]->sctype;	
			$data['prd_voucher'] = 0;
			$this->load->view($this->folderView.'inputTTPSubForm2',$data);	
			$this->load->view($this->folderView.'viewProductPayment',$data);
		} else {
           jsAlert();
        } 
	}

	//$route['sales/vc/check/(:any)/(:any)/(:any)'] = 'transaction/sales_stockist/checkValidVoucherCash/$1/$2/$3';
	function checkValidVoucherCash($distributorcode,$vchnoo, $paytype)
    {
        $response = jsonFalseResponse("No Voucher salah atau tidak sesuai dengan Member ".$distributorcode);	
        if($this->username != null) {	
	        $this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$arr = null;
			if($paytype == "10") {
				$arr = $this->m_sales_stk->checkValidCashVoucher($distributorcode,$vchnoo, "P");				
			} else {
				$arr = $this->m_sales_stk->checkValidCashVoucher($distributorcode,$vchnoo,"C");
			}
	        //print_r($arr);
			
			$arrData = $arr['arrayData'];
			if($arrData != null) {
				if($arrData[0]->claimstatus == "1") {
				    $arrx = array("response" => "false", "arrayData" => $arrData,"message" => "Voucher Cash sudah pernah di klaim pada ".$arrData[0]->claim_date.", Stokist : ".$arrData[0]->loccd);
					$response = $arrx;
				} 
				/*else if($arr[0]->vchtype != 'C') {
					$response = jsonFalseResponse("Voucher $vchnoo bukan voucher cash..");
				} */
				
				else if($arrData[0]->status_expire == '1') {
					$response = jsonFalseResponse("Voucher sudah expire pada tanggal : ".$arrData[0]->ExpireDate."");
				} else {
					$arrx = array("response" => "true", "arrayData" => $arrData, "detProd" => $arr['detProd']);
					$response = $arrx;	
				}
			}
	        
			echo json_encode($response);
		} else {
           jsAlert();
        } 
    }

	/*----------------
	 * PVR
	 * ---------------*/
	 
	 //$route['sales/pvr/input'] = 'transaction/sales_stockist/inputSalesPvr';
	 public function inputSalesPvr() {
	 	$data['form_header'] = "Input PVR MS/Sub/Stockist";
        $data['form_action'] = "sales/sub/ttp/input";
        $data['icon'] = "icon-pencil";
		$data['form_reload'] = 'sales/pvr/input';   		   
			
        if($this->username != null) {
        	$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
           $data['from'] 	= date("Y-m-d");
           $data['to'] 	= date("Y-m-d");
		   $data['sc_dfno'] 	= $this->stockist;	
		  	
		  // $data['stk_barcode_opt'] = $this->m_stock_barcode->getListStkbarMenu($this->groupid);   
		   $this->setTemplate($this->folderView.'inputPVRSub', $data); 
        } else {
           $this->setTemplate('includes/inline_login', $data);
        } 
	 }
	 
	 //$route['sales/pvr/input/list'] = 'transaction/sales_stockist/getListInputPvrSalesStockist';
	public function getListInputPvrSalesStockist() {
		
		if($this->username != null) {
			$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$data['form'] = $this->input->post(NULL, TRUE);
			$data['result'] = $this->m_sales_stk->getListSalesStockist($data['form'], "VP1");
			$this->load->view($this->folderView.'inputPvrListResult',$data);	
		} else {
           jsAlert();
        } 
	}
	
	//$route['sales/pvr/input/form'] = 'transaction/sales_stockist/inputTrxPvrForm';
	public function inputTrxPvrForm() {
		if($this->username != null) {
			$this->load->model("transaction/sales_member_model", "m_sales_member");
			$this->load->model('transaction/Sales_stockist_model', 'm_sales_stk');
			$data['currentperiod']= $this->m_sales_member->getCurrentPeriod();
			$data['form_action'] = "sales/stk/save";
			$data['ins'] = "1";
			$data['stockist'] = $this->stockist;
			$data['stockistnm'] = $this->stockistnm	;
			$data['pricecode'] = $this->pricecode;
			$sctype = $this->m_sales_stk->getStockistInfo($data['stockist']);
			$data['sctype'] = $sctype[0]->sctype;
			$data['co_sctype'] = $sctype[0]->sctype;	
			$data['listPay'] = $this->m_sales_stk->getListPaymentProductVoucher();
			$data['start_tabidx'] = 7;
			$data['prd_voucher'] = 1;
			$this->load->view($this->folderView.'inputTTPSubForm2',$data);	
			$this->load->view($this->folderView.'viewProductPayment',$data);
			
		} else {
           jsAlert();
        } 
	}
	
}