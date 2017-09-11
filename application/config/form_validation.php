<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
 'admLogin' => array(
                    array(
                            'field' => 'username',
                            'label' => 'ID member',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => 'required|trim'
                         ),
                    
				),
 'login' => array(
                    array(
                            'field' => 'idmember',
                            'label' => 'ID member',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'captcha',
                            'label' => 'captcha',
                            'rules' => 'required|trim'
                         )          
				),
				
  'user/group' => array(
  			        array(
                            'field' => 'groupname',
                            'label' => 'groupname',
                            'rules' => 'required|trim'
                         ),
				),
				
  'user' => array(
  			        array(
                            'field' => 'username',
                            'label' => 'Username',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => 'required|trim'
                         ) ,
                    array(
                            'field' => 'groupid',
                            'label' => 'Group ID',
                            'rules' => 'required|trim'
                         )
				),
  
  'app' => array(
  			        array(
                            'field' => 'app_id',
                            'label' => 'app_id',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'app_name',
                            'label' => 'app_name',
                            'rules' => 'required|trim'
                         ) ,
                    array(
                            'field' => 'app_url',
                            'label' => 'app_url',
                            'rules' => 'required|trim'
                         )
				),
  'menu/group' => array(
  			        array(
                            'field' => 'app_menu_desc',
                            'label' => 'app_menu_desc',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'app_submenu_prefix',
                            'label' => 'app_submenu_prefix',
                            'rules' => 'required|trim'
                         ) ,
                    array(
                            'field' => 'app_id',
                            'label' => 'app_id',
                            'rules' => 'required|trim'
                         )
				),
  'menu' => array(
  			        array(
                            'field' => 'app_menu_desc',
                            'label' => 'app_menu_desc',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'app_menu_url',
                            'label' => 'app_menu_url',
                            'rules' => 'required|trim'
                         ) 
                    
				),
  
  'product/cat' => array(
  			         array(
                            'field' => 'cat_id',
                            'label' => 'cat_id',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'cat_desc',
                            'label' => 'cat_desc',
                            'rules' => 'required|trim'
                         ) 
                ),
  'pricecode' => array(
  				     array(
                            'field' => 'pricecode',
                            'label' => 'pricecode',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'pricecode_desc',
                            'label' => 'pricecode_desc',
                            'rules' => 'required|trim'
                         ) 
                ),
  'product' => array(
  			        array(
                            'field' => 'cat_inv_id',
                            'label' => 'cat_inv_id',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'cat_inv_desc',
                            'label' => 'cat_inv_desc',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'cat_id',
                            'label' => 'cat_id',
                            'rules' => 'required|trim'
                         )      
                ),  
                
	'product/price' => array(
				     array(
                            'field' => 'cat_inv_id',
                            'label' => 'cat_inv_id',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'country_id',
                            'label' => 'country_id',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'hq_id',
                            'label' => 'hq_id',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'branch_id',
                            'label' => 'branch_id',
                            'rules' => 'required|trim'
                         )
					/*array(
                            'field' => 'pricecode[]',
                            'label' => 'pricecode',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'dp[]',
                            'label' => 'dp',
                            'rules' => 'required|trim|numeric'
                         ),
                    array(
                            'field' => 'bv[]',
                            'label' => 'bv',
                            'rules' => 'required|trim|numeric'
                         )	*/	     	 
						 
						             
			    ),
                
  'umroh' => array(
                    array(
                            'field' => 'fullnm',
                            'label' => 'Nama Lengkap',
                            'rules' => 'required|trim'
                         ),
                    /*array(
                            'field' => 'idno',
                            'label' => 'No KTP',
                            'rules' => 'required|trim'
                         ),*/
                    array(
                            'field' => 'birthplace',
                            'label' => 'Tempat Lahir',
                            'rules' => 'required|trim'
                         ), 
                    array(
                            'field' => 'fathersnm',
                            'label' => 'Nama Ayah Kandung',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'addr1',
                            'label' => 'Alamat',
                            'rules' => 'required|trim'
                         ),
                    /*array(
                            'field' => 'kelurahan',
                            'label' => 'Kelurahan',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'kecamatan',
                            'label' => 'Kecamatan',
                            'rules' => 'required|trim'
                         ),  
                    array(
                            'field' => 'kota',
                            'label' => 'Kota',
                            'rules' => 'required|trim'
                         ),  
                    array(
                            'field' => 'prov',
                            'label' => 'Provinsi',
                            'rules' => 'required|trim'
                         ),  
                    array(
                            'field' => 'zipcode',
                            'label' => 'Kode Pos',
                            'rules' => 'required|trim'
                         ),*/
                    /*array(
                            'field' => 'tel_hp',
                            'label' => 'No. HP',
                            'rules' => 'required|trim'
                         ),*/  
                    /*array(
                            'field' => 'tel_hm',
                            'label' => 'No. Telp Rmh',
                            'rules' => 'required|trim'
                         ),*/
                     /*array(
                            'field' => 'passportnm',
                            'label' => 'Nama Sesuai Passport',
                            'rules' => 'required|trim'
                         ),
                     array(
                            'field' => 'passportno',
                            'label' => 'Nomor Passport',
                            'rules' => 'required|trim'
                         )*/
				),
                
    'installments' => array(
                    array(
                            'field' => 'regnos',
                            'label' => 'Register No',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'amtUmroh',
                            'label' => 'Cicilan',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'paymentreff',
                            'label' => 'Payment Reff',
                            'rules' => 'required|trim'
                         )
                         /*,
                    array(
                            'field' => 'kelurahan',
                            'label' => 'Kelurahan',
                            'rules' => 'required|trim'
                         )
						  */
				),
				
				
  'campaign' => array(
  			        array(
                            'field' => 'dfno',
                            'label' => 'Distributor Code',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'fullnm',
                            'label' => 'Distributor Name',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'pic_desc',
                            'label' => 'Picture Description',
                            'rules' => 'required|trim'
                         ),
                    array(
                            'field' => 'pic_desc',
                            'label' => 'Picture Description',
                            'rules' => 'required|trim'
                         ),  
                ),
                 
  'inv/cat' => array(
                    array(
                            'field' => 'id_cat',
                            'label' => 'Inventory Category Code',
                            'rules' => 'required|trim'
                    ),
                    array(
                            'field' => 'cat_nm',
                            'label' => 'Inventory Category Name',
                            'rules' => 'required|trim'
                    ),
                ),
  
  'inv/supplier' => array(
                        array(
                                'field' => 'id_supplier',
                                'label' => 'Supplier Code',
                                'rules' => 'required|trim'
                        ),
                        array(
                                'field' => 'nm_supplier',
                                'label' => 'Supplier Name',
                                'rules' => 'required|trim'
                        ),
                    ),
  'inv/asset' => array(
                        array(
                                'field' => 'id_inventory',
                                'label' => 'Inventory Code',
                                'rules' => 'required|trim'
                        ),
                        array(
                                'field' => 'nm_inventory',
                                'label' => 'Supplier Name',
                                'rules' => 'required|trim'
                        ),
                        array(
                                'field' => 'qtyInv',
                                'label' => 'Quantity',
                                'rules' => 'required|trim'
                        ),
                        array(
                                'field' => 'value',
                                'label' => 'Value',
                                'rules' => 'required|trim'
                        ),
                    ),
  'empl/asset' => array(
                        array(
                                'field' => 'id_employee',
                                'label' => 'Employee ID',
                                'rules' => 'required|trim'
                        ),
                        array(
                                'field' => 'nm_employee',
                                'label' => 'Employee Name',
                                'rules' => 'required|trim'
                        ),
                    ),
  'mutasi/asset' => array(
                        array(
                                'field' => 'id_employee',
                                'label' => 'Employee ID',
                                'rules' => 'required|trim'
                        ),
                        array(
                                'field' => 'qtyReq',
                                'label' => 'Qty Request',
                                'rules' => 'required|trim'
                        ),
                    ),
   
   'inputTtpStockist' => array(
   							array(
                                'field' => 'dfno',
                                'label' => 'ID Member',
                                'rules' => 'required|trim',
                                'errors' => array('required' => 'ID Member harus diisi')
                            ),
                            
							array(
                                'field' => 'sc_dfno',
                                'label' => 'Stockist Code',
                                'rules' => 'required|trim',
                                'errors' => array('required' => 'Kode Stockist harus diisi')
                            ),
                            
							array(
                                'field' => 'orderno',
                                'label' => 'No TTP',
                                'rules' => 'required|trim',
                                'errors' => array('required' => 'No TTP harus diisi')
                            ),
   
   						)
  		            								
);
//$this->form_validation->set_rules($config);				 