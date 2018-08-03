<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Member_registration extends MY_Controller {
	public function __construct() {
	    parent::__construct();
		$this->folderView = "member/";
		$this->load->model('member/Member_registration_model', 'm_member_reg');
	}
	
	//$route['member/reg'] = 'member/member_registration/regMember';
	public function regMember() {
		$data['form_header'] = "Member Registration";
		$data['icon'] = "icon-pencil";
        $data['form_reload'] = 'member/reg';
		   	
		if($this->username != null) {	
		   		   
		   $data['limit'] = $this->m_member_reg->cekLimitKit($this->stockist);
		   $this->setTemplate($this->folderView.'memberRegCheckVoucher', $data); 
        } else {
           //echo sessionExpireMessage(false);
		   $this->setTemplate('includes/inline_login', $data);
        } 
	}
	
	//$route['member/voucher/check/(:any)/(:any)'] = 'member/member_registration/checkVoucher/$1/$2';
	public function checkVoucher($voucherno, $voucherkey) {		
		$arr = $this->checkVoucherMemb($voucherno, $voucherkey);
		echo json_encode($arr);
	}
	
	private function checkVoucherMemb($voucherno, $voucherkey) {
		
		$result = $this->m_member_reg->cekValidVoucher($voucherno, $voucherkey);
		if($result != null) {
			if($result[0]->status == "1") {
				$arr = jsonTrueResponse($result);
			} else if($result[0]->status == "0") {
				$arr = array("response" => "unreleased", "message" => "Voucher $voucherno belum di release..");
			} else if($result[0]->status == "2") {
				$arr = array("response" => "activated", "arrayData" => $result, "message" => "Voucher $voucherno sudah terpakai untuk : ".$result[0]->activate_dfno." / ".$result[0]->fullnm );
			} 
		} else {
			$arr = jsonFalseResponse("Voucher No / Voucher Key salah.."); 
		}
		return $arr;
	}
	
	//$route['member/reg/input'] = 'member/member_registration/inputMember';
	public function inputMember() {
		if($this->username != null) {	
		   $data = $this->input->post(NULL, TRUE);		
		   try {
		   	  $check = $this->checkValidation($data);
			  if($check['response'] == "true") {
				$data['show_state'] = $this->m_member_reg->getListState();
				$data['bank'] = $this->m_member_reg->getListBank();
				$data['valid'] = '0';
			  } 
			  
			  if($data['tipe_input'] == "1") {
			  	//tampilkan halaman reg member single
			  	$data['regtype'] = $check['regtype'];
			  	$this->load->view($this->folderView.'memberRegInput', $data);	
			  } else {
			  	//tampilkan halaman reg member couple
			  	$this->load->view($this->folderView.'memberRegInputCouple', $data);
			  }
			  
		   } catch(Exception $e) {
		   	   $data['err'] = $e->getMessage();
		   }
		   //print_r($data);
            
        } else {
        	$arr = jsonFalseResponse("Silahkan login kembali, sesi anda sudah habis..");
            //echo json_encode($)
        } 
	}

	private function checkValidation($data) {
		   $this->load->model("be_api_model", "m_api");
		   $data['err'] = null;
		   $cnterr = 0;
		   $regtype = 0;
		   try {
		   		//Check sponsor & rekruiter	
		   		$idsponsor = $this->m_api->checkValidIdMember($data['idsponsor']);
		   		$idrekruit = $this->m_api->checkValidIdMember($data['idrekrut']);	
				//Jika memilih pending voucher	
				if($data['chosevoucher'] == "0") {
					//Check Limit starterkit pending voucher
				   	$cekLimit = $this->m_member_reg->cekLimitKit($this->stockist);
				   	if($cekLimit != null && $cekLimit[0]->arkit < 1) {
				   		//print_r($cekLimit);
				   		$data['err'] = "Limit starterkit : ".$cekLimit[0]->arkit;
				   		$cnterr++;
				   	}
				} 
				//jika memilih voucher
				else {
			   	  $checkVch = $this->checkVoucherMemb($data['voucherno'], $data['voucherkey']);
				  if($checkVch['response'] !== "true") {
				  	 $data['err'] = $checkVch['message'];
					 $cnterr++;
				  } else {
				  	$regtype = $checkVch['arrayData'][0]->prdcd;
				  }
				}
				
		   } catch(Exception $e) {
		   	   $data['err'] = $e->getMessage();
			   $cnterr++;
		   }
		   
		   if($cnterr > 0) {
		   	  $arr = array("response" => "false", "errorMsg" => $data['err'], "regtype" => $regtype);
		   } else {
		   	  $arr = array("response" => "true", "errorMsg" => $data['err'], "regtype" => $regtype);
		   }
		   return $arr;
	}

    //$route['member/list/stk/(:any)'] = 'member/member_registration/showStockistByArea/$1';
    public function showStockistByArea($area) {
    	$res = $this->m_member_reg->getListStockistByState($area);
		if($res != null) {
			$arr = jsonTrueResponse($res);
		} else {
			$arr = jsonFalseResponse("Tidak ada stokist terdaftar di area tersebut..");
		}
		echo json_encode($arr);
    }
    
    //$route['member/reg/input/save'] = 'member/member_registration/saveInputMember';
    public function saveInputMember() {
    	$data = $this->input->post(NULL, TRUE);	
		try {
		   	  $check = $this->checkValidation($data);
			  $cekNoKtp  = $this->m_api->memberCheckExistingRecordByField("idno", $data['noktp']);
		      $cekNohP  =  $this->m_api->memberCheckExistingRecordByField("tel_hp", $data['tel_hp']);
			  
			  //Single member registration
			  if($data['tipe_input'] == "1") {	
			      $lastkit = $this->m_member_reg->showLastkitno($this->stockist);
				  if($lastkit != null) {
				     //echo "dsdsd";		 
					 if($lastkit[0]->lastkitno < 99999) {
						$arr = $this->processInputMember($lastkit, $data);
					 } 	else {
						$setLastKid = $this->m_member_reg->setLastKitToZero($this->stockist);
                        $lastkit = $this->m_member_reg->showLastkitno($this->stockist);
						$arr = $this->processInputMember($lastkit, $data);						
					 }
					 
					 $arr = jsonTrueResponse($insMemb);
				  } else {
					 $arr = jsonFalseResponse("Error Lastkitno..");
				  }
		      //end if($data['tipe_input'] == "1")	  
			  } else {
			  //Couple member registration	
			  }
		} catch(Exception $e) {
			$arr = jsonFalseResponse($e->getMessage());
		}
		echo json_encode($arr);
    }

	private function processInputMember($lastkit, $data) {
		$memberprefix1 = $lastkit[0]->memberprefix;
	  	if($lastkit[0]->memberprefix == '9999' or $lastkit[0]->memberprefix == '999') {
            $memberprefix = substr($this->stockist,2,3);
            $memberprefix1 = $memberprefix."A";
        } 
		
		$counter = $lastkit[0]->lastkitno + 1;
	    $next_id = sprintf("%05s",$counter);
	    $alph = chr($lastkit[0]->lastcodememb);
	    $new_id = strval("ID".$memberprefix1.$alph.$next_id);
	    
	    //$new_id = "TESTDION15MAR-2";
	    $updlastkitno = $this->m_member_reg->setLastKitNo($this->stockist);
	    if($updlastkitno > 0) {
	        $data['cek_seQ'] = $this->m_member_reg->cek_seQ();
	        $data['idnoo'] = $this->m_member_reg->get_idno();
	    
	        $input_new = $this->m_member_reg->insert_new_member($new_id,$this->stockist,$data['idnoo'], $this->groupid);
	        if($input_new > 0) {
	        	$data['upd_skit'] = null;
	        	if($data['chosevoucher'] != "1") {
	        		$data['upd_skit'] = $this->m_member_reg->update_limitkit($this->stockist);
	        	}   
	            //$upd_skit = $this->m_member->update_starterkit($new_id);
	            $res = jsonFalseResponse("Data member $new_id tidak ditemukan..");
	            $insMemb = $this->m_member_reg->show_new_member($new_id);
				if($insMemb != null) {
					$res = jsonTrueResponse($insMemb);
				}
	            //$this->load->view($this->folderView.'memberRegInputResult', $data);
	            
	        } else {
	            $dec_lastkitno = $this->m_member_reg->DecrementingLastKitNo($this->stockist);
				$res = jsonFalseResponse("Input member gagal..");
	        }  
	    } else {
	    	$res = jsonFalseResponse("Update lastkit gagal..");
	    }
		return $res; 
	    
	}

	//$route['member/reg/id/(:any)'] = 'member/member_registration/showNewMember/$1';
	public function showNewMember($idmember) {
		$data['show_new_member'] = $this->m_member_reg->show_new_member($idmember);
		$this->load->view($this->folderView.'memberRegInputResult', $data);
	}

	
}