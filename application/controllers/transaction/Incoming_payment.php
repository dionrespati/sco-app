<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Incoming_payment extends MY_Controller {
	public function __construct() {
	    parent::__construct();
		$this->folderView = "transaction/";
        $this->load->model('transaction/m_incoming_payment', 'incoming_payment');
	}
	
	//$route['incoming/update'] = 'transaction/incoming_payment/formUpdateIncomingPayment';
    public function formUpdateIncomingPayment() {
		$data['form_header'] = "Update Incoming Payment";
        $data['icon'] = "icon-pencil";
		$data['form_reload'] = 'be/klink/incoming/update';
		try {			
			$this->checkSessionBE();		
		} catch(Exception $e) {
			$data['err_msg'] = $e->getMessage();
		}
		$this->setTemplate($this->folderView.'incomingPaymentUpdateForm', $data); 
	}
	
	//$route['incoming/detail'] = 'transaction/incoming_payment/getDetailIncomingPayment';
	public function getDetailIncomingPayment() {
		$data = $this->input->post(NULL, TRUE);
		$srvReturn = $this->incoming_payment->getDetailIncomingPayment($data['inc_pay']);
		echo json_encode($srvReturn);
	}

	//$route['incoming/fullname/(:any)/(:any)'] = 'transaction/incoming_payment/getDetailFullname/$1/$2';
	public function getDetailFullname($cust_type, $dfno) {
		$data = $this->input->post(NULL, TRUE);
		$srvReturn = $this->incoming_payment->getDetailFullname($cust_type, $dfno);
		echo json_encode($srvReturn);
	}
	
	//$route['incoming/update/save'] = 'transaction/incoming_payment/saveUpdateIncomingPayment';
	public function saveUpdateIncomingPayment() {
		$srvReturn = null;
		try {			
			$this->checkSessionBE();
			$srvReturn = $this->incoming_payment->saveUpdateIncomingPayment();	
			if($srvReturn['response'] == "true") {
				echo setSuccessMessage($srvReturn['message']);
			}
		} catch(Exception $e) {
			echo setErrorMessage($e->getMessage());
		}
		
	}
}