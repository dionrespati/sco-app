<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
	    parent::__construct();
		$this->load->service("Login_service", "s_login");
		$this->formAction = base_url()."auth";
	}
	 
	public function index() {
		$data['formAction'] = $this->formAction;	
		$this->load->view('includes/adm_login', $data);
	}
	
	//$route['auth'] = 'login/auth';
	public function auth() {
		$data['formAction'] = $this->formAction;	
		try {
		    $srvReturn = $this->s_login->getValidateLogin();
		    //print_r($this->session->all_userdata());
			redirect('main');
		} catch(Exception $e) {
			$data['error_message'] = $e->getMessage();
			$this->load->view('includes/adm_login', $data);
		}		
	}
	
	//$route['auth/inline'] = 'login/authInline';
	public function authInline() {
			
		try {
		    $srvReturn = $this->s_login->getValidateLogin();
		    echo json_encode(jsonTrueResponse(null, "Login success"));
		} catch(Exception $e) {
			echo json_encode(jsonFalseResponse("Login gagal, check username dan password anda.."));
		}		
	}
	
	private function buildMenu2($parent, $menu, $urut)
    {
       $ss = base_url();
       $html = "";
       if (isset($menu['parents'][$parent]))
       {
         foreach ($menu['parents'][$parent] as $itemId)
           {
              if(!isset($menu['parents'][$itemId]))
              {
                $html .= "<li><a rel=\"".$menu['items'][$itemId]['menu_id']."\" class=ss href=\"#\" id='$ss".$menu['items'][$itemId]['menu_url']."'>".$menu['items'][$itemId]['menu_desc']."</a></li>";
                //$html .= "<li><a rel=\"".$menu['items'][$itemId]['menu_id']."\" onclick=buatTabulasi() href=\"#\" id='$ss".$menu['items'][$itemId]['url']."'>".$menu['items'][$itemId]['menu_name']."</a></li>";
              }  
              if(isset($menu['parents'][$itemId]))
              {
                    if($urut != 0) {
                        $html .= "</ul>";
                    }
                    $html .= "
                      <div class=\"nav-header collapsed\" data-toggle=\"collapse\" data-target=\"#".$menu['items'][$itemId]['menu_id']."\"><i class=\"icon-dashboard\"></i>".$menu['items'][$itemId]['menu_desc']."</div>
                        <ul id=\"".$menu['items'][$itemId]['menu_id']."\" class=\"nav nav-list collapse\">";
                    //$html .= "<li><a href=".$menu['items'][$itemId]['menu_name'].">".$menu['items'][$itemId]['menu_name']."</a></li>";
                    $urut++;
                    $html .= $this->buildMenu2($itemId, $menu, $urut);
              }      
           }     
       } 
       return $html;
    } 

   //$route['main'] = 'login/main';
   public function main() {
   	  
   	  if($this->username != null) {
   	  	 $menu = $this->s_login->fetchingMenu($this->groupid);
   	     $data['menu'] = $this->buildMenu2(0, $menu, 0);
		 $data['logout'] = base_url('logout');		
   	     $this->load->view('includes/header', $data);
   	  }  else {
   	  	 //print_r($this->session->all_userdata());
   	  	 //echo "username is null";	
   	  	 redirect('');
   	  } 
   }
	
	//$route['logout'] = 'login/logout';
	public function logout() {
		$this->session->sess_destroy();
		redirect('');
	}
	
	//$route['sess'] = 'login/sess';
	public function sess() {
		print_r($this->session->all_userdata());
		//redirect('');
	}
		
}
