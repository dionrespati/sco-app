<?php

$form = array(
  'id' => 'formInputUser',
  'formElement' => 
    array(
	    array(
	      'label' => 'Username',
	      'type' => 'text',
	      'name' => 'username',
	      'required' => true,
	      'onchange' => 'All.checkDoubleInput("user/list/","username",this.value)'
	    ),
	    
		array(
	      'label' => 'Password',
	      'type' => 'text',
	      'name' => 'password',
	      'required' => true,
	      'onchange' => 'All.checkDoubleInput("user/list/","password",this.value)'
	     
	    ),
	    
		array(
	      'label' => 'Department',
	      'type' => 'text',
	      'name' => 'departmentid'      
	    ),
	    
		//Array Status active/pasif
		ActiveSelect("Status"),
    )	    
  );
htmlFormGenerator($form);
?>