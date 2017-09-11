<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login_service extends MY_Service {

	public function __construct() {
		parent::__construct();
		$this->load->model("Login_model", "m_login");
	}

	public function getValidateLogin() {
		$mdReturn= null;	
		try {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() == FALSE) {
				throw new Exception("Please fill the required field..");
			} else {
				$formData = $this->input->post(NULL, TRUE);
				$res1 = $this->m_login->getValidateLogin($formData);	
				
				$this->session->set_userdata('user_scoapp', $res1[0]->username);
				$this->session->set_userdata('group_scoapp', $res1[0]->groupid);
				$this->session->set_userdata('groupnm_scoapp', $res1[0]->groupname);
				$this->session->set_userdata('stockist', $res1[0]->loccd);
				$this->session->set_userdata('stockistnm', $res1[0]->fullnm);
				$this->session->set_userdata('pricecode', $res1[0]->pricecode);
				$this->session->set_userdata('kodegudang', $res1[0]->kode_gudang);
				$mdReturn = true;
			}
		} catch(Exception $e) {
			throw new Exception($e->getMessage());
		}	
		return $mdReturn;
	}
	
	function fetchingMenu($groupid) {
		$mdReturn = $this->m_login->fetchingMenu($groupid);
		return $mdReturn;
	}

}
