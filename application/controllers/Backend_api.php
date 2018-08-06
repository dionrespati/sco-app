<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backend_api extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("be_api_model", "m_api");
    }

    //$route['memb/log'] = 'backend_api/membLogin';
    public function membLogin() {
        $data = $this->input->post(NULL, TRUE);
        //$arr = array("response" => "OKHTTP", "username" => "okkk", "password" => "0909", "status" => "OK Banget");
        //$arr = array("response" => "OKHTTP", "username" => $data['username'], "password" => $data['password'], "status" => "OK Banget");
        $res = $this->m_api->membLogin($data['username'], $data['password']);
        if ($res > 0) {
            $arr = jsonTrueResponse($res);
        } else {
            $arr = jsonFalseResponse("No record found");
        }
        //$qry = $this->getRecord
        echo json_encode($arr);
    }

    //$route['db2/get/(:any)/where/(:any)/(:any)'] = "backend/backend_api/getDataWithSpecificField/$1/$2/$3";
    public function getDataWithSpecificField($table, $field, $paramValue) {
        $arr = array(
            "fieldName" => $field,
            "tableName" => $table,
            "paramValue" => $paramValue,
            "db" => "klink_mlm2010",
        );
        try {
            $record = $this->m_api->getDataWithSpecificField($arr);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['db1/get/(:any)/from/(:any)/(:any)/(:any)'] = "backend/backend_api/getRetrieveFieldDB1/$1/$2/$3/$4";
    public function getRetrieveFieldDB1($retrieveField, $tablename, $field, $value) {
        $arr = array(
            "retrieveField" => $retrieveField,
            "fieldName" => $field,
            "tableName" => $tablename,
            "paramValue" => $value,
            "db" => "db_ecommerce",
        );
        try {
            $record = $this->m_api->getSelectedFieldFromTable($arr);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['db1/list/from/(:any)/(:any)/(:any)'] = "backend/backend_api/getRetrieveAllFieldB1/$1/$2/$3";
    public function getRetrieveAllFielDB1($tablename, $field, $value) {
        $arr = array(
            "fieldName" => $field,
            "tableName" => $tablename,
            "paramValue" => $value,
            "db" => "db_ecommerce",
        );
        try {
            $record = $this->m_api->getAllFieldFromTable($arr);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['db2/get/(:any)/from/(:any)/(:any)/(:any)'] = "backend/backend_api/getRetrieveFieldDB2/$1/$2/$3/$4";
    public function getRetrieveFieldDB2($retrieveField, $tablename, $field, $value) {
        $arr = array(
            "retrieveField" => $retrieveField,
            "fieldName" => $field,
            "tableName" => $tablename,
            "paramValue" => $value,
            "db" => "klink_mlm2010",
        );
        try {
            $record = $this->m_api->getSelectedFieldFromTable($arr);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['db4/list/from/(:any)/(:any)/(:any)'] = "backend/backend_api/getRetrieveAllFieldDB4/$1/$2/$3";
    public function getRetrieveAllFieldDB4($tablename, $field, $value) {
        $arr = array(
            "fieldName" => $field,
            "tableName" => $tablename,
            "paramValue" => $value,
            "db" => "tes_newera4",
        );
        try {
            $record = $this->m_api->getAllFieldFromTable($arr);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['db4/get/(:any)/from/(:any)/(:any)/(:any)'] = "backend/backend_api/getRetrieveFieldDB4/$1/$2/$3/$4";
    public function getRetrieveFieldDB4($retrieveField, $tablename, $field, $value) {
        $arr = array(
            "retrieveField" => $retrieveField,
            "fieldName" => $field,
            "tableName" => $tablename,
            "paramValue" => $value,
            "db" => "tes_newera4",
        );
        try {
            $record = $this->m_api->getSelectedFieldFromTable($arr);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['db3/list/from/(:any)/(:any)/(:any)'] = "backend/backend_api/getRetrieveAllFieldDB3/$1/$2/$3";
    //$route['db2/delete/from/(:any)/(:any)/(:any)'] = "backend/backend_api/deleteFromTable/$1/$2/$3";
    public function deleteFromTable($tablename, $field, $value) {
        $arr = array(
            "fieldName" => $field,
            "tableName" => $tablename,
            "paramValue" => $value,
            "db" => "klink_mlm2010",
        );
        try {
            $record = $this->m_api->deleteFromTablexx($arr);
            if ($record > 0) {
                $res = jsonTrueResponse(null, "Delete data $value success..");
            }
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['api/member/check/(:any)'] = "backend/backend_api/checkValidIdMember/$1";
    public function checkValidIdMember($idmember) {
        try {
            $record = $this->m_api->checkValidIdMember($idmember);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['api/member/double/(:any)/(:any)'] = "backend/backend_api/memberCheckExistingRecordByField/$1/$2";
    public function memberCheckExistingRecordByField($field, $value) {
        try {
            $record = $this->m_api->memberCheckExistingRecordByField($field, $value);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['api/email/id/(:any)'] = "backend/backend_api/getDetailEmail/$1";
    public function getDetailEmail($id) {
        try {
            $record = $this->m_api->getDetailEmail($id);
            $res = jsonTrueResponse($record);
        } catch (Exception $e) {
            $res = jsonFalseResponse($e->getMessage());
        }
        echo json_encode($res);
    }

    //$route['api/email'] = "backend/backend_api/getEmail/";
    public function getEmail() {
        $errMsg = "";
        $data = $this->input->post(NULL, TRUE);
        $given_key = array("username", "password");
        foreach ($given_key as $key => $value) {
            if (!array_key_exists($value, $data)) {
                $errMsg = "Parameter $value should be sent to API";
                break;
            }
        }

        if ($errMsg == "") {
            $tes = array("response" => "true", "data" => $data);
        } else {
            $tes = array("response" => "false", "message" => $errMsg);
        }
        echo json_encode($tes);
    }

    //$route['get/random/member'] = "backend_api/get100Member";
    public function get100Member() {
        $record = $this->m_api->get100Member();
        $res = jsonTrueResponse($record);
        echo json_encode($res);
    }

    public function tesAPI() {
        $url = "http://36.37.81.131:8080/Service.svc/KlinkTarifResponse";
        $data = array('usernama' => 'relas',
            'passw' => '123456',
            'kota' => '01010001',
            'berat' => 7.1);
        $data_json = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    }

}
