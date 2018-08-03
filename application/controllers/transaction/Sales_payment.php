<?php

class Sales_payment extends MY_Controller {
	public function __construct() {
		parent::__construct();
	    //$this->load->service('backend/s_knet_pay_stk', 'knet');
	    $this->folderView = "transaction/stockist_payment/";
        $this->load->model('transaction/sales_payment_model', 'sales_payment');
	}
	
	//$route['sales/payment'] = 'transaction/sales_payment/index';
	public function index() {
		$data['form_header'] = "Online Payment";
        $data['form_action'] = base_url('sales/ol/redemp/list');
        $data['icon'] = "icon-search";
		$data['form_reload'] = 'sales/payment';   		   
		   		
        if($this->username != null) {	
            //cek apakah group adalah ADMIN atau BID06
		   if($this->stockist == "BID06") {
		   	  $data['mainstk_read'] = "";
			  $data['idstkk_read'] = "";
		   } else {
		   	  $data['mainstk_read'] = "readonly=readonly";
			  $data['idstkk_read'] = "";
		   }
		    $data['user'] = $this->stockist;
		    $data['from'] = date("Y-m-d");
            $data['to'] = date("Y-m-d");
			$data['bank'] = $this->sales_payment->getBank();
			$data['period'] = $this->sales_payment->getCurrentPeriodSCO();
           $this->setTemplate($this->folderView.'listTrxToPayForm', $data); 
        } else {
		   $this->setTemplate('includes/inline_login', $data);
        } 
	}
    
    //$route['sales/payment/list'] = 'transaction/sales_payment/getListSalesReport';
	function getListSalesReport() {
       if($this->username != null) {
       	    $form = $this->input->post(NULL, TRUE);	
        	$data['result'] = $this->sales_payment->getListTrxToPay($form);
			//print_r($data['result']);
			$this->load->view($this->folderView.'listTrxToPayResult',$data);
            
        } else  {
	       	$this->setTemplate('includes/inline_login', $data);
	    }
	}
	
	//$route['sales/payment/ssr/(:any)'] = 'transaction/sales_payment/getDetailTTPbySSRno/$1';
	function getDetailTTPbySSRno($ssrno) {
	 	    $data['result'] = $this->sales_payment->getDetailTTPbySSRno($ssrno);			
            $this->load->view($this->folderView.'listTrxDetailTTPResult',$data);   
	}
	
	//$route[sales/payment/preview'] = "transaction/sales_payment/previewSelectedSSR";
	function previewSelectedSSR() {
		$login = $this->session->userdata('login');
		if($this->username != null) {
			$data = $this->input->post(NULL, TRUE);	
			//key development
			//$data['key'] = "e74ba03ac0aaaccd267bffcb4d869450";
			$data['key'] = "0df5835ee198d49944c372ead860c241";
			$data['payID'] = "ST".randomNumber(8);
			$data['backURL'] = "http://www.k-net.co.id/stk/pay/finish/dev/".$data['payID'];
			//print_r($data);
			$ssr = set_list_array_to_string($data['ssr']);		
		
			$resx = $this->sales_payment->getListSelectedSSR($ssr);
			//print_r($resx);
			//print_r($data);
			$simpan = $this->sales_payment->saveTempPayStl($resx, $data);
			$data['result'] = $resx;
			//print_r($data['result']);
			$this->load->view($this->folderView.'listTrxToPayPreview',$data);
		} else  {
	       	$this->setTemplate('includes/inline_login', $data);
	    }
	}
	
	
	  /*------------------------
	  * SGO PAYMENT (DEV)
	  * -------------------------*/
	  
	  //$route['stk/pay/inquiry/dev'] = 'knet_pay_stk/getResponseFromSGODev';
	  function getResponseFromSGODev() {
        
		$xx = $this->input->post(null,true);
        $password = 'k-net181183';
		$dta = $this->sales_payment->getDataPaymentStk($xx['order_id']);
		$cost = $dta[0]->total_pay_ssr + $dta[0]->charge_connectivity;
		if(!$xx['order_id'])
        {
            die('04;Order ID Tidak Ada;;;;;');
        }
        else if($xx['password'] != $password){
            die('04;Autentifikasi Salah;;;;;');
        }else{
            $trxData = array (
                        'errorCode' => 0,
                        'errorDesc' => 'Success',
                        'orderId' => $xx['order_id'],
                        //utk test 'amount' => 350000,
                        'amount' => $cost,
                        'ccy' => 'IDR',
                        'desc' => 'Stockist Sales Report Payment',
                        'trx_date' => date('d/m/Y H:i:s')
                        );
                        
            echo $trxData['errorCode'] . ';' . $trxData['errorDesc'] . ';' . $trxData['orderId'] . ';' . $trxData['amount'] . ';' . $trxData['ccy'] . ';' . $trxData['desc'] . ';' . $trxData['trx_date'];
        }
        
        
      }

      
      //$route['stk/pay/notif/dev'] = 'knet_pay_stk/notifAfterPaymentDev';
      public function notifAfterPaymentDev() {
		    $xx = $this->input->post(null,true);
            $password = 'k-net181183';
			//$dta = $this->paymentService->getDataPaymentSGOByOrderID($xx['order_id']);
			$dta = $this->sales_payment->getDataPaymentStk($xx['order_id']);
            //$cost = $dta[0]->total_pay + $dta[0]->payShip + $dta[0]->charge_connectivity;
			$cost = $dta[0]->total_pay_ssr + $dta[0]->charge_connectivity;
            if($xx['amount'] != $cost)
            {   
                die('04,Total DP tidak sama,,,,,');
            }
            else if($xx['password'] != $password){
                die('04,Autentifikasi Salah,,,,,');
            } else{
                //$updtTabel = $this->umrohModel->updttblMutasi($xx['order_id'],$xx['payment_ref'],$xx['amount']);
                $updtTabel = $this->sales_payment->setStatusPay($xx['order_id'], "1");
				//$this->paymentService->sendTrxSMS2($resultInsert);	
                $resSukses = array(
                    'success_flag' => 0,
                    'error_message' => 'SSR Payment Success',
                    'reconcile_id' => rand(15,32),
                    'order_id' => $xx['order_id'],
                    'reconcile_datetime' =>date('Y-m-d H:i:s')
                );
                
                echo $resSukses['success_flag'] . ',' . $resSukses['error_message'] . ',' . $resSukses['reconcile_id'] . ',' . $resSukses['order_id'] . ',' . $resSukses['reconcile_datetime'];             
				
				
				//die('04,Test reject,,,,,');
            }
	  }

	  //$route['stk/pay/finish/dev/(:any)'] = 'knet_pay_stk/afterPaymentWithSGODev/$1';
		public function afterPaymentWithSGODev($order_id) {
			$dta['trxInsertStatus'] = "fail";	
			
			$dta['header'] = $this->sales_payment->getDataPaymentStk($order_id);
			$dta['detail'] = $this->sales_payment->getDataPaymentDetailStk($order_id);	
			//harus diubah 	&& $dta['header'][0]->receiptno == null
			if ($dta['header'][0]->status_pay == "1" ) {
				$dta['trxInsertStatus'] = "ok";			
			} else {
				$sgo = $this->sales_payment->getDataPaymentStk($order_id);
				if($sgo[0]->pay_tipe == "16") {
					$dta['trxInsertStatus'] = "pending";
				}
			}
			//$this->_destroy_cart_session();
			$this->load->view('backend/stockist/stkpayment/listTrxPaymentSuccess',$dta);
			//print_r($dt['prodCat']);
		}
	  
	  /*-------------
	   * END
	   * ------------*/
	
}