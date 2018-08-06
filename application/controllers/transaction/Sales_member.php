<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_member extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "transaction/sales_member/";
        $this->load->model("transaction/sales_member_model", "m_sales_member");
    }

    //$route['member/trx'] = 'transaction/sales_member/memberTrxSearch';
    public function memberTrxSearch() {
        $data['form_header'] = "Distributor Transaction Check";
        $data['icon'] = "icon-zoom-in";
        $data['form_reload'] = 'member/trx';

        if ($this->username != null) {
            $this->setTemplate($this->folderView . 'memberTrxSearch', $data);
        } else {
            //redirect('backend', 'refresh');
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['member/trx/search'] = 'transaction/sales_member/memberTrxSearchResult';
    function memberTrxSearchResult() {
        $dt = $this->input->post(NULL, TRUE);
        $searchby = $dt['searchby']; //dfno, cnno, batchno, trcd, orderno
        $paramValue = $dt['paramValue'];
        //$chk = $dt['chk']; //if checked then no date param, not checked with date param

        if ($this->username != null && $paramValue != null && $paramValue != "") {
            $param = null;
            $bnsmonth = null;
            $bnsyear = null;
            $from = null;
            $to = null;

            if ($searchby == 'cnno' || $searchby == 'batchno' || $searchby == 'trcd' || $searchby == 'orderno') {
                $param = $paramValue;
            } elseif ($searchby == 'dfno') {
                $bnsmonth = $dt['bnsmonth'];
                $bnsyear = $dt['bnsyear'];
                $param = $paramValue;

                /* if($chk == 0){
                  $from = $dt['from'];
                  $to = $dt['to'];
                  } */
            }
            //$data['result'] = $this->m_sales_member->getListTrxByParam($searchby, $param, $bnsmonth, $bnsyear, $from, $to);
            $data['result'] = $this->m_sales_member->getListTrxByParam($searchby, $param, $bnsmonth, $bnsyear, $dt['from'], $dt['to']);
            $this->load->view($this->folderView . 'memberTrxSearchResult', $data);
        } else {
            redirect('backend', 'refresh');
        }
    }

    //$route['member/trx/detail/(:any)/(:any)'] = 'transaction/sales_member/memberTrxDetailProductByID/$1/$2';
    function memberTrxDetailProductByID($param, $trcd) {
        if ($this->username != null) {
            $data['header'] = $this->m_sales_member->getTrxByTrcdHead($param, $trcd);
            $data['detail'] = $this->m_sales_member->geTrxByTrcdDet("trcd", $data['header'][0]->trcd);
            if ($data['header'] != null && $data['detail'] != null) {
                $data['result'] = array("response" => "true", "header" => $data['header'], "detail" => $data['detail']);
            } else {
                if ($data['header'] == null) {
                    $headerx = "Data summary kosong";
                }
                if ($data['detail'] == null) {
                    $detailx = "Data detail kosong";
                }
                $msg = $data['header'] . " " . $data['detail'];
                $data['result'] = array("response" => "false", "message" => $msg);
            }
            $this->load->view($this->folderView . 'memberTrxDetailProductByID', $data);
            /* if($data['result'] == null) {
              echo "false";
              }else{
              //var_dump($data);

              } */
        } else {
            echo sessionExpireMessage(false);
        }
    }

    /*
      public function getStockist($loccd){
      if($this->username != null) {
      if($loccd != null || $loccd != ''){
      $data['result'] = $this->s_ktrans->getStockist($loccd);
      if($data['result'] != null){
      //var_dump($data['result']);
      $arr = jsonTrueResponse($data['result']);
      //echo json_encode($data['result']);
      }else{
      $arr = jsonFalseResponse("Data not found.");
      }
      }else{
      $arr = jsonFalseResponse("Stockist code cannot be empty.");
      }
      echo json_encode($arr);
      } else {
      redirect('backend', 'refresh');
      }
      }


      public function getRecapSales(){
      if($this->username != null) {
      $data['form_header'] = "Distributor Transaction Check";
      $data['icon'] = "icon-list";
      $data['form_reload'] = 'transklink/recapSales';
      $this->setTemplate($this->folderView.'getSalesRecap', $data);
      } else {
      redirect('backend', 'refresh');
      }
      }

      //$route['transklink/searchTrx/list'] = 'backend/be_trans_klink/postSearchTrx';
      function postRecapSales($is_xls=0) {
      $dt = $this->input->post(NULL, TRUE);
      $param = $dt['sc_code'];
      $bnsmonth   = $dt['bnsmonth'];
      $bnsyear    = $dt['bnsyear'];
      //echo "controller $bnsmonth";
      if($this->username != null) {
      $data['is_xls'] = $is_xls;
      $data['result'] = $this->s_ktrans->getListRecapSales($param, $bnsmonth, $bnsyear);
      $this->load->view($this->folderView.'getSalesRecapResult', $data);
      }else{
      redirect('backend', 'refresh');
      }
      }

      //$route['transklink/recapBonus'] = 'backend/be_trans_klink/getRecapBonus';
      public function getRecapBonus(){
      if($this->username != null) {
      $data['form_header'] = "Distributor Transaction Check";
      $data['icon'] = "icon-list";
      $data['form_reload'] = 'transklink/recapBonus';
      $this->setTemplate($this->folderView.'getBonusRecap', $data);
      } else {
      redirect('backend', 'refresh');
      }
      }

      //$route['transklink/recapBonus/list/(:any)'] = 'backend/be_trans_klink/postRecapBonus/$1';
      function postRecapBonus($is_xls=0) {
      $dt = $this->input->post(NULL, TRUE);
      //print_r($dt);
      $param = $dt['country_cd'];
      $bnsmonth   = $dt['bnsmonth'];
      $bnsyear    = $dt['bnsyear'];
      $rptType	= $dt['rpt_type'];

      if($this->username != null) {
      $data['is_xls'] = $is_xls;
      $data['rptType']= $dt['rpt_type'];
      $data['result'] = $this->s_ktrans->getListRecapBonus($param, $rptType, $bnsmonth, $bnsyear);
      if($rptType == "cvr" or $rptType == "pvr"){
      $this->load->view($this->folderView.'getBonusRecapCVRRes', $data);
      }elseif($rptType == "allvr" or $rptType == "chq" or $rptType == "chq_stk" or $rptType == "novac"){
      $this->load->view($this->folderView.'getBonusRecapAllVRRes', $data);
      }

      }else{
      redirect('backend', 'refresh');
      }
      }


      //$route['transklink/gnvUpload'] = 'backend/be_trans_klink/gnvUpload';
      public function gnvUpload() {
      if($this->username != null) {
      $this->load->library('csvreader');
      $data['form_header'] = "Upload Stock GNV From File";
      $data['icon'] = "icon-pencil";
      $data['form_reload'] = 'transklink/gnvUpload';
      $data['listWH'] = $this->s_ktrans->listWHFromGNV();
      $this->setTemplate($this->folderView.'gnvImportForm', $data);
      } else {
      redirect('backend', 'refresh');
      }
      }

      //$route['transklink/gnvUploadPrev'] = 'backend/be_trans_klink/gnvUploadPrev';
      public function gnvUploadPrev() {

      $this->load->library('PHPExcel/PHPExcel');
      if (!empty($_FILES['myfile']['name'])) {

      $fileName = $_FILES["myfile"]["tmp_name"];

      if($fileName != ""){
      $pathinfo = pathinfo($_FILES['myfile']['name']);
      //membuat objek PHPExcel
      $xl_obj = new PHPExcel();

      $extensionType = null;
      if (isset($pathinfo['extension'])) {
      switch (strtolower($pathinfo['extension'])) {
      case 'xlsx':            //    Excel (OfficeOpenXML) Spreadsheet
      case 'xlsm':            //    Excel (OfficeOpenXML) Macro Spreadsheet (macros will be discarded)
      case 'xltx':            //    Excel (OfficeOpenXML) Template
      case 'xltm':            //    Excel (OfficeOpenXML) Macro Template (macros will be discarded)
      $extensionType = 'Excel2007';
      break;
      case 'xls':                //    Excel (BIFF) Spreadsheet
      case 'xlt':                //    Excel (BIFF) Template
      $extensionType = 'Excel5';
      break;
      case 'ods':                //    Open/Libre Offic Calc
      case 'ots':                //    Open/Libre Offic Calc Template
      $extensionType = 'OOCalc';
      break;
      case 'slk':
      $extensionType = 'SYLK';
      break;
      case 'xml':                //    Excel 2003 SpreadSheetML
      $extensionType = 'Excel2003XML';
      break;
      case 'gnumeric':
      $extensionType = 'Gnumeric';
      break;
      case 'htm':
      case 'html':
      $extensionType = 'HTML';
      break;
      case 'csv':
      // Do nothing
      // We must not try to use CSV reader since it loads
      // all files including Excel files etc.
      break;
      default:
      break;
      }
      }

      $reader = PHPExcel_IOFactory::createReader($extensionType);
      $reader->setReadDataOnly(true);
      $file = $reader->load($fileName);
      $objWorksheet = $file->getActiveSheet();


      $isheet=0;
      $irow=1;
      $icol='A';

      $sheet = $file->getSheet(intval($isheet));
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      //echo "highest row = $highestRow.<br/>highest column = $highestColumn.<br/>";
      $valueData = null;
      $data['result'] = array();
      for ($row = intval($irow); $row <= $highestRow; $row++){
      //  Read a row of data into an array
      $valueData = $sheet->rangeToArray($icol . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
      array_push($data['result'], $valueData);
      //var_dump($data);
      }
      $this->load->view($this->folderView.'gnvImportPreview', $data);
      }


      }else{
      echo "No Data";
      }
      //var_dump($_POST);

      }

      //$route['transklink/gnvUploadAction'] = 'backend/be_trans_klink/gnvUploadAction';
      public function gnvUploadAction() {
      $dt = $this->input->post(NULL, TRUE);

      $whcd = $dt['whcd'];

      $this->load->library('PHPExcel/PHPExcel');
      if (!empty($_FILES['myfile']['name'])) {

      $this->s_ktrans->delDataStockAwal($whcd);

      $fileName = $_FILES["myfile"]["tmp_name"];

      if($fileName != ""){
      $pathinfo = pathinfo($_FILES['myfile']['name']);
      //membuat objek PHPExcel
      $xl_obj = new PHPExcel();

      $extensionType = null;
      if (isset($pathinfo['extension'])) {
      switch (strtolower($pathinfo['extension'])) {
      case 'xlsx':            //    Excel (OfficeOpenXML) Spreadsheet
      case 'xlsm':            //    Excel (OfficeOpenXML) Macro Spreadsheet (macros will be discarded)
      case 'xltx':            //    Excel (OfficeOpenXML) Template
      case 'xltm':            //    Excel (OfficeOpenXML) Macro Template (macros will be discarded)
      $extensionType = 'Excel2007';
      break;
      case 'xls':                //    Excel (BIFF) Spreadsheet
      case 'xlt':                //    Excel (BIFF) Template
      $extensionType = 'Excel5';
      break;
      case 'ods':                //    Open/Libre Offic Calc
      case 'ots':                //    Open/Libre Offic Calc Template
      $extensionType = 'OOCalc';
      break;
      case 'slk':
      $extensionType = 'SYLK';
      break;
      case 'xml':                //    Excel 2003 SpreadSheetML
      $extensionType = 'Excel2003XML';
      break;
      case 'gnumeric':
      $extensionType = 'Gnumeric';
      break;
      case 'htm':
      case 'html':
      $extensionType = 'HTML';
      break;
      case 'csv':
      // Do nothing
      // We must not try to use CSV reader since it loads
      // all files including Excel files etc.
      break;
      default:
      break;
      }
      }

      $reader = PHPExcel_IOFactory::createReader($extensionType);
      $reader->setReadDataOnly(true);
      $file = $reader->load($fileName);
      $objWorksheet = $file->getActiveSheet();

      $isheet=0;
      $irow=1;
      $icol='A';

      $sheet = $file->getSheet(intval($isheet));
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      //echo "highest row = $highestRow.<br/>highest column = $highestColumn.<br/>";
      $valueData = null;
      $data['xlsData'] = array();
      for ($row = intval($irow); $row <= $highestRow; $row++){
      //  Read a row of data into an array
      $valueData = $sheet->rangeToArray($icol . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
      array_push($data['xlsData'], $valueData);
      }
      $save = $this->s_ktrans->saveImportToDB($data, $whcd);
      $this->load->view($this->folderView.'gnvImportResult', $save);
      }



      }else{
      echo "No Data Uploaded!";
      }

      }


      //$route['transklink/setBnsPeriod'] = 'backend/be_trans_klink/setBnsPeriod';
      public function setBnsPeriod() {
      if($this->username != null) {
      $data['form_header'] = "Set Bonus Period";
      $data['icon'] = "icon-pencil";
      $data['form_reload'] = 'transklink/setBnsPeriod';
      $data['scoPeriod'] = $this->s_ktrans->listBnsPeriod();
      $this->setTemplate($this->folderView.'setBonusPeriodForm', $data);
      } else {
      redirect('backend', 'refresh');
      }
      }

      //$route['transklink/setBnsPeriodAction'] = 'backend/be_trans_klink/setBnsPeriodAction';
      public function setBnsPeriodAction($param) {
      if($this->username != null) {
      $dt = $this->input->post(NULL, TRUE);var_dump($dt);
      if(strlen($dt['bnsyear']) >= 4 && $dt['bnsmonth']!=""){
      $date = '01';
      $bnsmonth = $dt['bnsmonth'];
      $bnsyear = $dt['bnsyear'];
      $period = "$bnsyear-$bnsmonth-$date";
      $this->s_ktrans->uptBnsPeriod($period, $param);
      }
      $this->setBnsPeriod();
      } else {
      redirect('backend', 'refresh');
      }
      }

      //$route['transklink/operatorSms'] = 'backend/be_trans_klink/getOperatorSms';
      public function getOperatorSms(){
      if($this->username != null) {
      $data['form_header'] = "Operator Setup";
      $data['icon'] = "icon-list";
      $data['form_reload'] = 'transklink/operatorSms';
      $this->setTemplate($this->folderViewSMS.'getOperatorSMS', $data);
      } else {
      redirect('backend', 'refresh');
      }
      }

      //$route['transklink/operatorSms/list'] = 'backend/be_trans_klink/getListAllOperator';
      function getListAllOperator($is_xls = '0') {
      $dt = $this->input->post(NULL, TRUE);
      //print_r($dt);

      if($this->username != null) {
      $data['result'] = $this->s_ktrans->getOperatorSMS();
      if($is_xls == 0){
      $this->load->view($this->folderViewSMS.'getOperatorSMSResult', $data);
      }
      }else{
      redirect('backend', 'refresh');
      }
      }
     */
}
