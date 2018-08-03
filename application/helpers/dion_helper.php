<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function addRangeOneMonth($tes, $i) {
	$date = new DateTime($tes);
    $date->modify("first day of +$i month");
    return $date->format('d/m/Y');
}

function loopMenu($data, $parent) {
		if(isset($data[$parent]))  { // jika ada anak dari menu maka tampilkan
	 	    /* setiap menu ditampilkan dengan tag <ul> dan apabila nilai $parent bukan 0 maka sembunyikan element 
	 	     * karena bukan merupakan menu utama melainkan sub menu */
	 	  	$str = '<ul parent="'.$parent.'" style="display:'.($parent>0?'none':'').'">'; 
	 	  	foreach($data[$parent] as $value)  {
	 	  	  /* variable $child akan bernilai sebuah string apabila ada sub menu dari masing-masing menu utama
	 	  	   * dan akan bernilai negatif apabila tidak ada sub menu */
	 	  	  $child = loopMenu($data,$value->id); 
	 	  	  $str .= '<li>';
	 	  	  /* beri tanda sebuah folder dengan warna yang mencolok apabila terdapat sub menu di bawah menu utama 	  	   
	 	  	   * dan beri juga event javascript untuk membuka sub menu di dalamnya */
	 	  	  $str .= ($child) ? '<a href="javascript:openTree('.$value->id.') "><img src="asset/image/folderclose2.jpg" id="img'.$value->id.'" border="0"></a>' : '<img src="asset/image/folderclose1.jpg">';
	 	  	  if($value->url_laravel == "#") {	  
			    $str .= '<a href="javascript:openTree('.$value->id.') ">'.$value->name.'</a></li>';
			  }
			  else {
			    $str .= '<a href="'.$value->url_laravel.'">'.$value->name.'</a></li>';
			  }  
	 	  	  if($child) $str .= $child;
			}
			$str .= '</ul>';
			return $str;
		  }
		  else 
	    return false;	  
	}

if ( ! function_exists('jsonTrueResponse'))
{
	function jsonTrueResponse($data = null, $message = "success") {
     	$arr = array("response" => "true", "arrayData" => $data, "message" => $message);
		return $arr;
     }
}	

if ( ! function_exists('randomNumber'))
{
    function randomNumber($length) {
	    $min = 1 . str_repeat(0, $length-1);
	    $max = str_repeat(9, $length);
	    $ss = mt_rand($min, $max);   
		return date("y")."".date("m").$ss;
	}
}

if ( ! function_exists('substrwords'))
{
	function substrwords($text, $maxchar, $end=' ...') {
	    if (strlen($text) > $maxchar || $text == '') {
	        $words = preg_split('/\s/', $text);      
	        $output = '';
	        $i      = 0;
	        while (1) {
	            $length = strlen($output)+strlen($words[$i]);
	            if ($length > $maxchar) {
	                break;
	            } 
	            else {
	                $output .= " " . $words[$i];
	                ++$i;
	            }
	        }
	        $output .= $end;
	    } 
	    else {
	        $output = $text;
	    }
	    return $output;
	}
}

if ( ! function_exists('jsonFalseResponse'))
{
     function jsonFalseResponse($message = "No result found..!!") {
	 	$arr = array("response" => "false", "message" => $message);
		return $arr;
	 }
}

if ( ! function_exists('sessionExpireMessage'))
{
     function sessionExpireMessage($arrs = true) {
     	$message = "Sesi anda habis, silahkan login kembali";
	 	if($arrs) {	
	    	$arr = array("response" => "false", "message" => $message);			
		} else {
			$arr = "<div class=\"alert alert-error\"><p align=center>".$message."</p></div>";
		}	
		return $arr;
	 }
}

if ( ! function_exists('setErrorMessage'))
{
    function setErrorMessage($message = "Data tidak ditemukan..")
    {
       echo "<div class=\"alert alert-error\"><p align=center>".$message."</p></div>";
    }
}
  
if ( ! function_exists('setSuccessMessage'))
{  
    function setSuccessMessage($message)
    {
        echo "<div class=\"alert alert-success\"><p align=center>".$message."</p></div>";
        
    }
}


if ( ! function_exists('requiredFieldMessage'))
{
     function requiredFieldMessage($message = "Please fill the REQUIRED field") {
		return $message;
	 }
}

if ( ! function_exists('dataNotFoundMessage'))
{
     function dataNotFoundMessage($message = "Data yang dicari tidak ada..!!") {
		return $message;
	 }
}

if(! function_exists('placeholderCheck')) {
    function placeholderCheck() {
        $str = "required (press TAB after typing to check data)";
        return $str;
    }
}

if(! function_exists('inputText')) {	
	function inputText($arr) {
		$setPlaceHolder = "";
		$setEvent = "";	
		$maxlength = "";
		$setValue = "";
		$readOnly = "";
		if(isset($arr['readonly'])) {
			if($arr['readonly'] == true) {
				$readOnly = "readonly=readonly";
			} else {
				$readOnly = "";
			}
			
		}
		
		if(isset($arr['type'])) {
			$inpType = $arr['type'];
		} else {
			$inpType = "text";
		}
		
		if(!isset($arr['class'])) {
			$arr['class'] = "span9 typeahead";
		}	
		
		if(isset($arr['addClass'])) {
			$arr['class'] .= $arr['class']." ".$arr['addClass'];
		}
		if(isset($arr['placeholder'])) {
			$setPlaceHolder = "placeholder=\"$arr[placeholder]\"";
		}
		if(isset($arr['event'])) {
			$setEvent = $arr['event'];
		}
		
		if(isset($arr['value'])) {
			$setValue = $arr['value'];
		}
		
		if(isset($arr['maxlength'])) {
			$maxlength = "maxlength=\"$arr[maxlength]\"";
		}
		$str = "<label class=\"control-label\" for=\"typeahead\">$arr[labelname]</label>";
        $str .=  "<div class=\"controls\">";
        if(isset($arr['hiddentext'])) {
		  $str .=  "<input type=\"hidden\" id=\"$arr[hiddentext]\" name=\"$arr[hiddentext]\"  />";
		}
        $str .=  "<input $setPlaceHolder $maxlength type=\"$inpType\" class=\"$arr[class]\" id=\"$arr[fieldname]\"  name=\"$arr[fieldname]\" value=\"$setValue\" $readOnly $setEvent />";
		$str .=  "</div>";
		
		return $str;
	}
}

if(!function_exists('opening_form')) {
    function opening_form($arr) {
    	$id = "";
		$enctype = "";
		$class = "class=form-horizontal";
		if(isset($arr['id'])) {
			$id = "id=".$arr['id'];
		}
		
		if(isset($arr['class'])) {
			$class = "class=".$arr['class'];
		}
		
		if(isset($arr['enctype']) && $arr['enctype'] == true) {
			$enctype = "enctype=multipart/form-data";
		}
		$str =  "<div class=\"mainForm\"><form $id $class $enctype $id>";
        $str .= "<fieldset><div class=\"control-group\">";
		return $str;
	}

}

if(!function_exists('closing_form')) {
    function closing_form() {
    	$str =  "</div> <!-- end control-group --></fieldset></form><div class=\"result\"></div></div>";
        return $str;
	}

}



if(! function_exists('inputHidden')) {
    function inputHidden($field) {
    	$str =  "<input type=\"hidden\" id=\"$field\" name=\"$field\" value=\"\" />";
		return $str;
	}	
}

if(! function_exists('emptyResultDiv')) {
    function emptyResultDiv($message = "No result found..!") {
        $str = "<div class=\"alert\">$message</div>";
        return $str;
    }
}

if(! function_exists('text_cut')) {
    function text_cut($text, $length = 200, $dots = true) {
        $text = trim(preg_replace('#[\s\n\r\t]{2,}#', ' ', $text));
        $text_temp = $text;
        while (substr($text, $length, 1) != " ") { $length++; if ($length > strlen($text)) { break; } }
        $text = substr($text, 0, $length);
        return $text . ( ( $dots == true && $text != '' && strlen($text_temp) > $length ) ? '...' : ''); 
    }
}

if(! function_exists('selectFlagActive')) {	
	function selectFlagActive($labelName = "Active", $fieldname = "act") {
		$str = "<label class=\"control-label\" for=\"typeahead\">$labelName</label>";
        $str .= "<div class=\"controls\">";
        $str .= "<select id=\"$fieldname\" name=\"$fieldname\">";
        $str .= "<option value=\"1\">Yes</option>";
        $str .= "<option value=\"0\">No</option>";
        $str .= "</select>"; 
        $str .= "</div>";
		
		return $str;
	}
}

if(! function_exists('selectTwoOption')) {	
	function selectTwoOption($labelName = "Active", $fieldname = "act", $arr) {
		$str = "<label class=\"control-label\" for=\"typeahead\">$labelName</label>";
        $str .= "<div class=\"controls\">";
        $str .= "<select id=\"$fieldname\" name=\"$fieldname\">";
		$str .= $arr;
        $str .= "</select>"; 
        $str .= "</div>";
		
		return $str;
	}
}

if(! function_exists('inputSelectArray')) {	
	function inputSelectArray($labelName = "Active", $fieldname = "act", $arr) {
		$str = "<label class=\"control-label\" for=\"typeahead\">$labelName</label>";
        $str .= "<div class=\"controls\">";
        $str .= "<select id=\"$fieldname\" name=\"$fieldname\">";

		foreach($arr as $key => $value) {
		$str .= "<option value=\"$key\">$value</option>";
		}	
        $str .= "</select>"; 
        $str .= "</div>";
		
		return $str;
	}
}

if(! function_exists('setSingleUploadFile')) {	
	function setSingleUploadFile($labelName, $fileTitle = FALSE) {
		$str = "<label class=\"control-label\" for=\"typeahead\">$labelName</label>";
        $str .=  "<div class=\"controls\">";
        $str .= "<input id=\"myfile\" type=\"file\" name=\"myfile\" class=\"cfile span7 typeahead\" />";
             if($fileTitle) {
			 	$str .= "<input placeholder=\"Title of Image, max length is 50 characters\" id=\"imageTitle\" type=\"text\" name=\"imageTitle\" class = \"span9 typeahead\" maxlength=\"50\" />";	
			 }
			 $str .= "<span id=\"spanPic\" class=\"fileExistingInfo\"></span>";
             $str .= "<input type=\"hidden\" class=\"fileHiddenExistingInfo\" id=\"filename\" name=\"filename\" />"; 
         
        $str .=  "</div>";
		
		return $str;
	}
}

if(! function_exists('monthYearPeriod')) {	
	function monthYearPeriod($labelName = "Period") {
		$date = date('Y');	
		$str = "<label class=\"control-label\" for=\"typeahead\">$labelName</label>";
        $str .= "<div class=\"controls\">";
        $str .= "<select id=\"month\" name=\"month\" style='width:100px'>";
		$str .= "<option value=\"1\">January</option>";
		$str .= "<option value=\"2\">February</option>";
		$str .= "<option value=\"3\">March</option>";
		$str .= "<option value=\"4\">April</option>";
		$str .= "<option value=\"5\">May</option>";
		$str .= "<option value=\"6\">June</option>";
		$str .= "<option value=\"7\">July</option>";
		$str .= "<option value=\"8\">August</option>";
		$str .= "<option value=\"9\">September</option>";
		$str .= "<option value=\"10\">October</option>";
		$str .= "<option value=\"11\">November</option>";
		$str .= "<option value=\"12\">December</option>";
        $str .= "</select>";
		 $str .= "&nbsp;<input type=text id=year name=year value=\"$date\" style='width:50px' />"; 
        $str .= "</div>";
		
		return $str;
	}
}

if(! function_exists('bonusPeriod')) {	
	function bonusPeriod($labelName = "Bonus Period") {
		$date = date('Y');	
		$str = "<label class=\"control-label\" for=\"typeahead\">$labelName</label>";
        $str .= "<div class=\"controls\">";
        $str .= "<select id=\"bnsmonth\" name=\"bnsmonth\" style='width:120px'>";
		$str .= "<option value=\"\">--Select Here--</option>";
		$str .= "<option value=\"01\">January</option>";
		$str .= "<option value=\"02\">February</option>";
		$str .= "<option value=\"03\">March</option>";
		$str .= "<option value=\"04\">April</option>";
		$str .= "<option value=\"05\">May</option>";
		$str .= "<option value=\"06\">June</option>";
		$str .= "<option value=\"07\">July</option>";
		$str .= "<option value=\"08\">August</option>";
		$str .= "<option value=\"09\">September</option>";
		$str .= "<option value=\"10\">October</option>";
		$str .= "<option value=\"11\">November</option>";
		$str .= "<option value=\"12\">December</option>";
        $str .= "</select>";
		 $str .= "&nbsp;<input type=text id=bnsyear name=bnsyear value=\"$date\" style='width:50px' />"; 
        $str .= "</div>";
		
		return $str;
	}
}

if(! function_exists('bonusPeriodAll')) {	
	function bonusPeriodAll($labelName = "Bonus Period") {
		$date = date('Y');	
		$str = "<label class=\"control-label\" for=\"typeahead\">$labelName</label>";
        $str .= "<div class=\"controls\">";
        $str .= "<select id=\"bnsmonth\" name=\"bnsmonth\" style='width:120px'>";
		$str .= "<option value=\"all\">All</option>";
		$str .= "<option value=\"01\">January</option>";
		$str .= "<option value=\"02\">February</option>";
		$str .= "<option value=\"03\">March</option>";
		$str .= "<option value=\"04\">April</option>";
		$str .= "<option value=\"05\">May</option>";
		$str .= "<option value=\"06\">June</option>";
		$str .= "<option value=\"07\">July</option>";
		$str .= "<option value=\"08\">August</option>";
		$str .= "<option value=\"09\">September</option>";
		$str .= "<option value=\"10\">October</option>";
		$str .= "<option value=\"11\">November</option>";
		$str .= "<option value=\"12\">December</option>";
        $str .= "</select>";
		 $str .= "&nbsp;<input type=text id=bnsyear name=bnsyear value=\"$date\" style='width:50px' />"; 
        $str .= "</div>";
		
		return $str;
	}
}

if(! function_exists('inputCountryHQBranch')) {
	function inputCountryHQBranch() {
		 $str = "";
		 $country_id = null;
		 $hq_id = null;
		 $branch_id = null;
		 $country_id = array(
		 	"labelname" => "Country ID",
		 	"fieldname" => "country_id",
		 	"value" => "ID",
		 	"readonly" => "yes"
 		 );
         $str .= inputText($country_id);
		 
		 //Headquarter ID
		 $hq_id = array(
		 	"labelname" => "Headquarter ID",
		 	"fieldname" => "hq_id",
		 	"value" => "BID06",
		 	"readonly" => "yes"
		 	
 		 );
          $str .= inputText($hq_id);
		 
		  //Headquarter ID
		 $branch_id = array(
		 	"labelname" => "Branch ID",
		 	"fieldname" => "branch_id",
		 	"value" => "B001",
		 	"readonly" => "yes"
 		 );
          $str .= inputText($branch_id);
		  
		  return $str;
	}	
}		

if(! function_exists('inputSelect')) {	
	function inputSelect($arr, $null = true) {
		$setClass = "";
		$setEvent = "";	
		if(isset($arr['event'])) {
			$setEvent .= $arr['event'];
		}	
		
		if(isset($arr['class'])) {
			$setClass .= $arr['class'];
		}
		
		if(isset($arr['addClass'])) {
			$setClass .= $setClass." ".$arr['addClass'];
		}
		
		$str = "<label class=\"control-label\" for=\"typeahead\">$arr[labelname]</label>";
        $str .= "<div class=\"controls\">";
        $str .= "<select class=\"$setClass\" id=\"$arr[fieldname]\" name=\"$arr[fieldname]\" $setEvent>";
		if($null == true) {
        	$str .= "<option value=\"\">--Select here--</option>";
		}	
        $str .= $arr['optionlist'];	
        $str .= "</select>"; 
		if(isset($arr['refresh']) && $arr['refresh'] != "") {
			$str .= "&nbsp;<input class=\"btn btn-mini btn-primary\" type=\"button\" onclick=\"$arr[refresh]\" value=\"Refresh\">";
		}
		if(isset($arr['submit'])) {
			$str .= "&nbsp;<input class=\"btn btn-mini btn-primary\" type=\"button\" onclick=\"$arr[submit]\" value=\"Submit\">";
		}	
		
        $str .= "</div>";
		
		return $str;
	}
}

if(! function_exists('btnUpdateDelete')) {
	function btnUpdateDelete($arr) {
		$html = "";	
		$html .= "<td><div align=\"center\">";
		if(isset($arr['view'])) {
		    $html .= "<a class=\"btn btn-mini btn-success\" onclick=\"$arr[view]\"><i class=\"icon-search icon-white\"></i></a>&nbsp;";
		}
		if(isset($arr['update'])) {
        	$html .= "<a class=\"btn btn-mini btn-info\" onclick=\"$arr[update]\"><i class=\"icon-edit icon-white\"></i></a>&nbsp;";
		}	
		if(isset($arr['delete'])) {
        	$html .= "<a class=\"btn btn-mini btn-danger\" onclick=\"$arr[delete]\"><i class=\"icon-trash icon-white\"></i></a>";
		}	
        $html .=  "</div></td>";
		return $html;
	}
}



if(! function_exists('button_set')) {
    function button_set($save, $update, $view, $cancel = "All.cancelUpdateForm()") {
      $html = "";	
      $html .= "<label class=\"control-label\" for=\"typeahead\">&nbsp</label> ";                            
      $html .= "<div class=\"controls\"  id=\"inp_btn\">";
      $html .= "<input type=\"button\" id=\"btn_input_user\" class=\"btn btn-primary .submit\" name=\"save\" value=\"Submit\" onclick=\"$save\" />&nbsp;";
      $html .= "<input type=\"reset\" class=\"btn btn-reset\" value=\"Reset\" />&nbsp;";
      $html .= "<input type=\"button\" class=\"btn btn-success\" value=\"View List\" onclick=\"$view\" />";
      $html .= "</div><div class=\"controls\" id=\"upd_btn\" style=\"display: none;\">";
      $html .= "<input type=\"button\" class=\"btn btn-primary\" id=\"updsave\" name=\"save\" value=\"Update\" onclick=\"$update\" />&nbsp;";
      $html .= "<input type=\"button\" class=\"btn btn-danger\" value=\"Cancel Update\" id=\"cancelupd\" onclick=\"$cancel\" />&nbsp;";
      $html .= "<input type=\"button\" class=\"btn btn-success\" value=\"View List\" onclick=\"$view\" /></div>";
	  
	  return $html;
    }
}   

if(! function_exists('button_set2')) {
    function button_set2($save) {
      $html = "";	
      $html .= "<label class=\"control-label\" for=\"typeahead\">&nbsp</label> ";                            
      $html .= "<div class=\"controls\"  id=\"inp_btn\">";
      $html .= "<input type=\"button\" id=\"btn_input_user\" class=\"btn btn-primary .submit\" name=\"save\" value=\"Submit\" onclick=\"$save\" />&nbsp;";
	   $html .= "<input type=\"reset\" class=\"btn btn-reset\" name=\"reset\" value=\"Reset\" />&nbsp;";
      $html .= "</div>";
	  
	  return $html;
    }
}  

if(! function_exists('button_set_no_visible')) {
    function button_set_prdprice($save, $update, $view, $cancel = "Product.cancelUpdatePrdPrice()") {
      $html = "";	
      $html .= "<label class=\"control-label\" for=\"typeahead\" \">&nbsp</label> ";                            
      $html .= "<div class=\"controls\"  id=\"inp_btn\" style=\"display: block;\">";
      $html .= "<input type=\"button\" id=\"btn_input_user\" class=\"btn btn-primary .submit\" name=\"save\" value=\"Save\" onclick=\"$save\" />&nbsp;";
      $html .= "<input type=\"button\" class=\"btn btn-reset\" value=\"Reset\" onclick=\"$cancel\" />&nbsp;";
      $html .= "<input type=\"button\" class=\"btn btn-success\" value=\"View List\" onclick=\"$view\" />";
      $html .= "</div><div class=\"controls\" id=\"upd_btn\" style=\"display: none;\">";
      $html .= "<input type=\"button\" class=\"btn btn-primary\" id=\"updsave\" name=\"save\" value=\"Update\" onclick=\"$update\" />&nbsp;";
      $html .= "<input type=\"button\" class=\"btn btn-danger\" value=\"Cancel Update\" id=\"cancelupd\" onclick=\"$cancel\" />&nbsp;";
      $html .= "<input type=\"button\" class=\"btn btn-success\" value=\"View List\" onclick=\"$view\" /></div>";
	  
	  return $html;
    }
}     

if(! function_exists('datepickerFromTo')) {
	function datepickerFromTo($label, $from = "from", $to = "to") {
	  $html = "";	
	  $html .= "<label class=\"control-label\" for=\"typeahead\">$label</label>";
      $html .= "<div class=\"controls\">";
      $html .= "<input type=\"text\" class=\"dtpicker\" id=\"$from\" name=\"$from\" placeholder=\"From\" required=\"required\" />"; 
      $html .= "&nbsp;<input type=\"text\" class=\"dtpicker\" id=\"$to\" name=\"$to\" placeholder=\"To\" required=\"required\" />";
      $html .= "</div>";
	  return $html;
	}
}



if(! function_exists('set_list_array_to_string2')) {
    function set_list_array_to_string2($array, $fieldname, $roundby = "'" , $delimiter = ",")
    {
        $ss = '';
        //$jum = count($array);
        foreach($array as $dta)
        {
            $ss .= $roundby.$dta[$fieldname].$roundby.$delimiter." ";      
        }
        $ss = substr($ss, 0, -2);
        return $ss;
    }
}

if(! function_exists('getUsername')) {
    function getUsername()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info !=  NULL) {
			$username = $store_info[0]->fullnm;
			return $username;
		} else {
			return NULL;
		}
	}
}	

if(! function_exists('getUserID')) {
    function getUserID()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		
		if($store_info !=  NULL) {
			$userid = $store_info[0]->dfno;
			return $userid;
		} else {
			$non_member_info =   $CI->session->userdata('non_member_info');
			if($non_member_info !=  NULL) {
				$userid = $non_member_info['userlogin'];
			   return $userid;
			} else {	
				return NULL;
			}
		}
	}
}

if(! function_exists('getUserAddress')) {
    function getUserAddress()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		$usraddress = $store_info[0]->addr1." ".$store_info[0]->addr2." ".$store_info[0]->addr3;
		return $usraddress;
	}
}	

if(! function_exists('getUserEmail')) {
    function getUserEmail()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info !=  NULL) {
			$email = $store_info[0]->email;
			return $email;
		} else {
			$non_member_info =   $CI->session->userdata('non_member_info');
			if($non_member_info !=  NULL) {
				$email = $non_member_info['useremail'];
			   return $email;
			} else {	
				return NULL;
			}
		}
	}
}

if(! function_exists('getUserIdno')) {
    function getUserIdno()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info !=  NULL) {
			$idno = $store_info[0]->idno;
			return $idno;
		} else {
			return NULL;
		}
	}
}

if(! function_exists('getUserPhone')) {
    function getUserPhone()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info !=  NULL) {
			if($store_info[0]->tel_hp != "") {
				$telp = $store_info[0]->tel_hp;
			} else {
				$telp = $store_info[0]->tel_hm;
			}
		} else {
			$non_member_info =   $CI->session->userdata('non_member_info');
			if($non_member_info !=  NULL) {
				$telp = $non_member_info['usertelp'];		   
			} else {	
				$telp = NULL;
			}
		}
		return $telp;
	}
}

/*tambahan dari ana*/
if(! function_exists('getUserPhonehome')) {
    function getUserPhonehome()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info != NULL) {
			$telphm = $store_info[0]->tel_hm;
            return $telphm;
		}else{
		  return NULL;
		}
	}
}

if(! function_exists('getUserNovac')) {
    function getUserNovac()
    {
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info != NULL) {
			$novac = $store_info[0]->novac;
            return $novac;
		}else{
		  return NULL;
		}
	}
}

if(! function_exists('getSponsorID')) {
    function getSponsorID()
    {
    	$sponsorid = "";	
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info[0]->sponsorid != "") {
			$sponsorid = $store_info[0]->sponsorid;
		} 
		return $sponsorid;
	}
}

if(! function_exists('getSponsorName')) {
    function getSponsorName()
    {
    	$sponsorname = "";	
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info[0]->sponsorname != "") {
			$sponsorname = $store_info[0]->sponsorname;
		} 
		return $sponsorname;
	}
}

if(! function_exists('getBirthDate')) {
    function getBirthDate()
    {
    	$birthdt = "";	
    	$CI = & get_instance(); 	
    	$store_info =   $CI->session->userdata('store_info');
		if($store_info[0]->tel_hp != "") {
				
			$birthdt = date('d-m-Y', strtotime($store_info[0]->birthdt));
		} 
		return $birthdt;
	}
}

if(! function_exists('getBeUsername')) {
    function getBeUsername()
    {
    	$beUsername = "";	
    	$CI = & get_instance(); 	
    	$beUsername =   $CI->session->userdata('ecom_user');
		/*if($ecomm_user[0]->ecom_user != "") {
				
			$beUsername = $ecom_user[0]->ecom_user;
		} */
		return $beUsername;
	}
}

if(! function_exists('getBeGroupname')) {
    function getBeGroupname()
    {
    	$groupName = "";	
    	$CI = & get_instance(); 	
    	$groupName =   $CI->session->userdata('ecom_groupname');
		/*if($ecomm_user->ecom_groupname != "") {
				
			$groupName = $ecom_user->ecom_groupname;
		} */
		return $groupName;
	}
}


if(! function_exists('getTotalPayNet')) {
    function getTotalPayNet()
    {
    	
    	$CI = & get_instance(); 	
    	$pricecode =   $CI->session->userdata('pricecode');
		if($pricecode == "12W3") {
			$totalPay = $CI->cart->total_west_price();
		} else {
			$totalPay = $CI->cart->total_east_price();
		}
		return $totalPay;
	}
}

if(! function_exists('getTotalPayNetAndShipCost')) {
    function getTotalPayNetAndShipCost()
    {
    	
    	$CI = & get_instance(); 	
    	$pricecode =   $CI->session->userdata('pricecode');
		
		$shipping_jne_info = $CI->session->userdata('shipping_jne_info');
		  if($shipping_jne_info == null) {
		  	 $shipping_jne_info['price'] = 0;
		  }
		
		if($pricecode == "12W3") {
			$totalPay = $CI->cart->total_west_price() + $shipping_jne_info['price'];
		} else {
			$totalPay = $CI->cart->total_east_price() + $shipping_jne_info['price'];
		}
		return $totalPay;
	}
}

if(! function_exists('getTotalSKandShipCost')) {
    function getTotalSKandShipCost() {
    	  $CI = & get_instance(); 	
    	  $pricecode = $CI->session->userdata('pricecode');
		  $priceSK = $CI->session->userdata('starterkit_prd');
		  $shipping_jne_info = $CI->session->userdata('shipping_jne_info');
		  if($shipping_jne_info == null) {
		  	 $shipping_jne_info['price'] = 0;
		  }
		  
		  $total_payment = $priceSK['price'] + $shipping_jne_info['price'];
		  return $total_payment;
    }
}

if(! function_exists('getTotalBV')) {
    function getTotalBV()
    {
    	$totalBV = 0;
    	$CI = & get_instance(); 	
    	$cart_contents =   $CI->session->userdata('cart_contents');
		$totalBV = $cart_contents['total_bv'];
		return $totalBV;
	}
}



if(! function_exists('setRpcResponse')) {
    function setRPCResponse($dta, $request)
    {
    	$returnArr = array();		
    	$rpc = $dta->request($request);

        if (!$dta->send_request()) {
            echo $dta->display_error();
        } else {
        	$arr = $dta->display_response();
			if($arr['arrayData'] == null) {
				$returnArr = array("response" => "false");
			} else {
	            $valReturn = json_decode($arr['arrayData']);
				$returnArr = array("response" => "true", "arrayData" => $valReturn);
			}
		
		    return $returnArr;
        }
	}
}	

if(! function_exists('getTotalPayment')) {
	function getTotalPayment($tipe)
    {
    	  $CI = & get_instance(); 	
    	  $pricecode = $CI->session->userdata('pricecode');
		  $shipping_jne_info = $CI->session->userdata('shipping_jne_info');
		  if($shipping_jne_info == null) {
		  	 $shipping_jne_info['price'] = 0;
		  }
		  
          if($pricecode == "12W3") {
          	$total_payment = $CI->cart->total_west_price() + $shipping_jne_info['price'];
          } else {
          	$total_payment = $CI->cart->total_east_price() + $shipping_jne_info['price'];
          } 
		  
		  $total_pay = $total_payment;
		  if($tipe == "cc") {
		  	//$tot = $total_pay + ((3.2 / 100) * $total_pay) + 2500;
		  	$tot = $total_pay + 2500 + (2500 * 0.1);
		  } else {
		  	$tot = $total_pay + 2500;
		  }
		  
		  return $tot;
	}	
}	

if(! function_exists('getTotalPaymentSK')) {
	function getTotalPaymentSK($tipe)
    {
    	  $CI = & get_instance(); 	
    	  $pricecode = $CI->session->userdata('pricecode');
		  $priceSK = $CI->session->userdata('starterkit_prd');
		  $shipping_jne_info = $CI->session->userdata('shipping_jne_info');
		  if($shipping_jne_info == null) {
		  	 $shipping_jne_info['price'] = 0;
		  }
          /*if($pricecode == "12W3") {
          	$total_payment = $CI->cart->total_west_price() + $shipping_jne_info['price'];
          } else {
          	$total_payment = $CI->cart->total_east_price() + $shipping_jne_info['price'];
          } 
		  */
		  $total_payment = $priceSK['price'] + $shipping_jne_info['price'];
		  $total_pay = $total_payment;
		  if($tipe == "cc") {
		  	//$tot = $total_pay + ((3.2 / 100) * $total_pay) + 2500;
		  	$tot = $total_pay + 2500 + (2500 * 0.1);
		  } else {
		  	$tot = $total_pay + 2500;
		  }
		  
		  return $tot;
	}	
}	

if(! function_exists('getCustomerDetail')) {
	function getCustomerDetail($tipe = null)
    {
    	  $customer_details = array();	
    	  if($tipe == "lp") {
	    	  $CI = & get_instance(); 			
	    	  $member_info = $CI->session->userdata('member_info');	
	    	  $customer_details = array(
	            'first_name'    => $member_info['membername'],
	            'last_name'     => "", // Optional
	            'email'         => $member_info['email_pendaftar'],
	            'phone'         => $member_info['tel_hp']
	            );
		  }	elseif($tipe == null) {
		  		$customer_details = array(
	            'first_name'    => $member_info['membername'],
	            'last_name'     => "", // Optional
	            'email'         => $member_info['email_pendaftar'],
	            'phone'         => $member_info['tel_hp']
	            );
		  }
		  return $customer_details;	
	}	
}	

if(! function_exists('datebirth_combo')) {
	function datebirth_combo($minimum_age = 18, $maximum_age = 100, $class = '')
    {
    	$addClass = "";
		if($class != "") {
    		$addClass = "class='$class'";
    	}	
    	$str = "<select $addClass  id=tgllhr name=tgllhr>";
		for($i = 1;$i <= 31; $i++) {
    		$val = sprintf("%02s", $i);	
    		$str .= "<option value=\"$val\">$val</option>";
		}	
    	$str .= "</select>&nbsp;/&nbsp;";
		
		$str .= "<select $addClass id=blnlhr name=blnlhr>";
		for($i = 1;$i <= 12; $i++) {
    		$val = sprintf("%02s", $i);	
    		$str .= "<option value=\"$val\">$val</option>";
		}	
    	$str .= "</select>&nbsp;/&nbsp;";
		
		$year = date("Y");
		$min = $year - $minimum_age;
		$max = $year - $maximum_age;
		$str .= "<select $addClass  id=thnlhr name=thnlhr>";
		for($i = $min; $i > $max; $i--) {
    		$str .= "<option value=\"$i\">$i</option>";
		}	
    	$str .= "</select>";
		
		return $str;
	}
if(! function_exists('set_list_array_to_string')) {	
	function set_list_array_to_string($array, $roundby = "'" , $delimiter = ",")
    {
        $ss = '';
        $jum = count($array);
        for($i = 0; $i < $jum; $i++)
        {
            $ss .= $roundby.$array[$i].$roundby.$delimiter." ";      
        }
        $ss = substr($ss, 0, -2);
        return $ss;
    }
}

if(! function_exists('link_sk')) {	
	function link_sk() {
		$str = "<a class=\"btn1 btn2 btn-primary1\" href=\"".base_url('member/file/sk')."\">";
	    $str .= "<i class=\"fa fa-arrow-left\"></i><span>Download Starterkit</span></a>";
	    return $str;                    
	                    
	}
}

if(! function_exists('set_list_array_to_stringCart')) {
    function set_list_array_to_stringCart($array, $fieldname, $roundby = "'" , $delimiter = ",")
    {
        $ss = '';
        //$jum = count($array);
        foreach($array as $dta)
        {
            $ss .= $roundby.$dta[$fieldname].$roundby.$delimiter." ";      
        }
        $ss = substr($ss, 0, -2);
        return $ss;
    }
}
}	

    function nma($ss,$length)
    {
        $fgh = strlen($ss);
		if($fgh > $length)
        {
            $tmp = explode(" ", $ss);
           $nma = $tmp[0]." ".$tmp[1];
   
            return $nma;
        }
		
		else
		{
		   return $ss;
		}								
    }
    
    function nama($ss,$length)
    {
        $fgh = strlen($ss);
		
		 if($fgh > $length)
        {
            $tmp = explode(" ", $ss);
           $nma = $tmp[0]." ".$tmp[1];
   
            return $nma;
        }
		else
		{
		   return $ss;
		}								
    }
    
    function garisSambung(){
        for($i = 1;$i<=11;$i++)
   	    {
            echo "_______";
        }
    }
    
    function garisStrip()
	{
	   for($i = 1;$i<=11;$i++)
   	    {
            echo "-------";
        }
	}
    function garisStripKW() {
		for($i = 1;$i<=8;$i++)
        	{
        	  echo "----------";
        	}
	}
    function garisStrip2()
	{
	   for($i = 1;$i<=2;$i++)
   	   {
            echo "----------";
       }
	}
    
    function garisStrip3()
	{
	   for($i = 1;$i<=8;$i++)
   	   {
            echo "--------";
       }
	}
    
    function TotQty($pengurang, $x)
	{
	    $kos = '';
    	$d = strlen($x);
    	$kiri = $pengurang - $d;
    	for($v = 1;$v <= $kiri;$v++)
    	{
    	  $kos .= " ";
    	}
    	
    	echo $kos;
    	echo $x;
	}
    
    function tmbh_spaceHeader($value)
	{
	  $bts_kiri = 11;
      $data_kiri = 38;
      $bts_kanan = 13;
      $data_kanan = 18;
      
      $sisa_data_kiri = $data_kiri - $value;
    	if($sisa_data_kiri)
    	{
    	  $kosong = '';
    	  for($x = 1; $x <= $sisa_data_kiri; $x++)
    	  {
    	    $kosong .= " ";
    	  }
    	}
	  echo $kosong;
	}
    
    
    function tmbh_spaceHeaderProduct($value)
	{
    	  $kosong = '';
          for($x = 1; $x <= $value; $x++)
    	  {
    	    $kosong .= " ";
    	  }

	  echo $kosong;
	}
    
    function titleHeaderData()
	{
	    echo "Stock";
    	tmbh_spaceHeaderProduct(6);
    	echo "Description";
    	tmbh_spaceHeaderProduct(22);
    	echo "Qty";
    	tmbh_spaceHeaderProduct(10);
    	echo "DP";
        tmbh_spaceHeaderProduct(7);
        echo "Gross DP\n";
    	//tmbh_spaceHeaderProduct(5);
	    
    	garisStrip();

	}
	
	function backToMainForm() {
		
		echo "<div>
					 <input value=\"<< Kembali\" type=\"button\" class=\"btn btn-warning\" onclick=\"All.back_to_form(' .nextForm1',' .mainForm')\"/>
				</div>
				";
	}
	
	function backToNextForm() {
		
		echo "<div><input value=\"<< Back\" type=\"button\" class=\"btn btn-mini btn-warning\" onclick=\"All.back_to_form('.nextForm2','.nextForm1')\" /></div>";
	}
	
	function tmbh_spaceHeaderIP($value)
	{
    	  $kosong = '';
          for($x = 1; $x <= $value; $x++)
    	  {
    	    $kosong .= " ";
    	  }

	  echo $kosong;
	}
	
	function titleHeaderDataKW()
	{
	    echo "NO";
    	tmbh_spaceHeaderIP(1);
    	echo "KW NO";
    	tmbh_spaceHeaderIP(9);
    	echo "IP NO";
        tmbh_spaceHeaderIP(9);
        echo "CN NO";
    	tmbh_spaceHeaderIP(10);
        echo "ID MEMBER";
    	tmbh_spaceHeaderIP(5);
        echo "STOCKIST";
    	tmbh_spaceHeaderIP(5);
        echo "NOMINAL";
    	tmbh_spaceHeaderIP(1);
    	//tmbh_spaceHeaderIP(1);
        echo "\n";
	    
    	garisStripKW();
	}
	
	function createEmptySpace($val) {
		$isi = "";		
		for($i = 1;$i<=$val;$i++)
   	    {
            $isi .= " ";
        }
		return $isi;
	}
	
	function addSpacePersonal($batas, $value) {
		$pjg = strlen($value);
	    $kosong = '';
		//$batas = 11;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
		  {
    	     $kosong .= " "; 
    	  }
		  return $kosong;
	}

	function addLine($jum, $char = "-") {
		$kosong = '';	
		for($i = 1; $i <=$jum; $i++)
		  {
    	     $kosong .= $char; 
    	  }
		  return $kosong;
	}
    
    function tmbh_spaceDetailPersonal($no,$value)
	{
	    $pjg = strlen($value);
	    $kosong = '';
        
	    //Utk STOCK
    	if($no == 1)
		{
		  $batas = 11;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
		  {
    	     $kosong .= " "; 
    	  }
		}
        
        //Utk DESC  
		elseif($no == 2)
		{
          $batas = 33;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  } 
		}
        
         //Utk QTY  
		elseif($no == 3)
		{
          $batas = 3;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
		}
        
         //Utk QTY  
		elseif($no == 4)
		{
		  //$batas = 10;
          $batas = 6;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
		}
        
		//Utk DP  
		elseif($no == 5)
		{
		  //$batas = 10;
          $batas = 12;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
		}
         elseif($no == 7)
		{
		  //$batas = 10;
          $batas = 2;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
		}
        
		//Utk GROSS DP
		elseif($no == 6)
		{ 
		  //$batas = 24;
          $batas = 14;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  }
		}
        echo $kosong;
	}

    function tmbh_spaceDetailPersonalKW($no,$value)
	{
	    $pjg = strlen($value);
	    $kosong = '';
        
	    //Utk NO
    	if($no == 1)
		{
		  if($pjg <= 1)
		  {
		    $kosong .= " ";
		  }
  		
		}
        
        //Utk NO  
		elseif($no == 2)
		{
		  //$batas = 10;
          $batas = 3;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
            //$kosong = " ";  
		}
        
         //Utk KW NO  
		elseif($no == 3)
		{
		  //$batas = 10;
          $batas = 14;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
            //$kosong = " ";  
		}
        
		//Utk IP NO  
		elseif($no == 4)
		{
		  //$batas = 10;
          $batas = 14;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
            //$kosong = " ";  
		}
        
		//Utk ID MEMBER
		elseif($no == 5)
		{ 
		  //$batas = 24;
          $batas = 15;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  } 
		  
		}
        
        //Utk NM MEMBER
		elseif($no == 6)
		{ 
		  //$batas = 24;
          $batas = 14;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  } 
		  
		}
        
        //Utk ID STOKIST
		elseif($no == 7)
		{ 
		  //$batas = 24;
          $batas = 10;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  } 
		  
		}
        
        //Utk NOMINAL
		elseif($no == 8)
		{ 
		  //$batas = 24;
          $batas = 10;
		  
          $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  } 
		}	
		echo $kosong;  
	}
    
    //tambahan ana
    function title_headerDO(){
       echo "No";
    	tmbh_spaceHeaderProduct(3);
    	echo "Product";
    	tmbh_spaceHeaderProduct(4);
    	echo "Product Name";
    	tmbh_spaceHeaderProduct(32);
    	echo "Qty";
    	tmbh_spaceHeaderProduct(4);
    	echo "Ship";
    	tmbh_spaceHeaderProduct(5);
    	echo "B/O\n";
    	garisStripDO(12);
    }
    
    function garisStripDO($x)
	{
	   for($i = 1;$i<=$x;$i++)
   	    {
            echo "-------";
        }
	}
    
    function tmbh_spaceDetailDO($no,$value,$batas)
	{
	    $pjg = strlen($value);
	    $kosong = '';
        
	    //Utk NO
    	if($no == 1)
		{
		  if($pjg <= 1)
		  {
		    $kosong .= " ";
		  }
  		
		}
        
        //Utk NO  
		elseif($no == 2)
		{
		  //$batas = 10;
          //$batas = 5;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
            //$kosong = " ";  
		}
        
         //Utk Prdcd  
		elseif($no == 3)
		{
		  //$batas = 10;
          //$batas = 11;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
            //$kosong = " ";  
		}
        
		//Utk PRDNM  
		elseif($no == 4)
		{
		  //$batas = 10;
          //$batas = 40;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <=$sisa; $i++)
    		  {
    		    $kosong .= " "; 
    		  }
            //$kosong = " ";  
		}
        
		//Utk QTY
		elseif($no == 5)
		{ 
		  //$batas = 24;
          //$batas = 7;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  } 
		  
		}
        
        //Utk SHIP
		elseif($no == 6)
		{ 
		  //$batas = 24;
          //$batas = 6;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  } 
		  
		}
        
        //Utk BO
		elseif($no == 7)
		{ 
		  //$batas = 24;
          //$batas = 3;
		  $sisa = $batas - $pjg;
		  for($i = 1; $i <= $sisa; $i++)
    		  {
    		    $kosong .= " ";
    		  } 
		  
		}
        
		echo $kosong;  
	}
    
    function titleHeaderPromo(){
        echo "No";
    	tmbh_spaceHeaderProduct(3);
    	echo "Orderno";
    	tmbh_spaceHeaderProduct(7);
    	echo "ID Member";
    	tmbh_spaceHeaderProduct(5);
	    echo "Member Name";
    	tmbh_spaceHeaderProduct(11);
    	echo "Product";
    	tmbh_spaceHeaderProduct(4);
        echo "Prod. Name";
    	tmbh_spaceHeaderProduct(5);
        echo "Qty\n";
    	garisStripDO(12);
    }
	
	function jsAlert($message = 'Session expired..') {
		echo "<script>alert($message)</script>";
	}
    
	function setDatePicker($param = ".dtpicker") {
		echo "<script>
				$(document).ready(function() { 
					$(All.get_active_tab() + \"$param\").datepicker({
						changeMonth: true,
						numberOfMonths: 1,
						changeYear: true,
						dateFormat: 'yy-mm-dd',
					}).datepicker();
					
					
				});	
			</script>";
	}		
	
	function setDatatable() {
		echo "<script>
				$(document).ready(function() {
					$(All.get_active_tab() + \" .datatable\").dataTable({
						\"aLengthMenu\" : [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
						\"sPaginationType\" : \"bootstrap\",
						\"oLanguage\" : {
						},
						\"bDestroy\" : true
					});
					$(All.get_active_tab() + \" .datatable\").removeAttr('style');
				});
			</script>";
	}
	
	function link_js_sgo($tipe) {
		if($tipe == "dev") {
			$str = "<script type=\"text/javascript\" src=\"https://sandbox-kit.espay.id/public/signature/js\"></script>";
		} else if($tipe == "prod"){
			//<script type="text/javascript" src="https://secure.sgo.co.id/public/signature/js"></script>
			//$str = "<script type=\"text/javascript\" src=\"https://kit.espay.id/public/signature/js\"></script>";
			$str = "<script type=\"text/javascript\" src=\"https://secure.sgo.co.id/public/signature/js\"></script>";
		}
		return $str;
	}
	
	function createTable($array) {
		$header = "&nbsp;";
		if(in_array("title", $array)) {
			$header = $array['header'];
		}
		
		if(!in_array("columns", $array)) {
			echo "Column harus diisi";
		} 
		
		
		$str = "<table>";
		$str = "<thead>";
		$count = count($columns);
		$str .= "<tr>";
		for($i=0;$i<$columns;$i++) {
			$str .= "<th>$columns[$i]</th>";
		}
		$str .= "</tr>";
		$str = "<thead>";
		
		$str .= "</table>";
	}
