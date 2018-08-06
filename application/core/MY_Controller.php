<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->username = $this->session->userdata('user_scoapp');
        $this->groupid = $this->session->userdata('group_scoapp');
        $this->usergroup = $this->session->userdata('groupnm_scoapp');
        $this->stockist = $this->session->userdata('stockist');
        $this->stockistnm = $this->session->userdata('stockistnm');
        $this->pricecode = $this->session->userdata('pricecode');
        //$this->pricecode = $this->session->userdata('pricecode');
        $this->kodegudang = $this->session->userdata('kodegudang');
    }

    public function getStoreInfo() {
        if (isset($this->store_info)) {
            return $this->store_info;
        } else {
            return null;
        }
    }

    protected function _checkSessionStoreUser($redirectTo = 'loginmember') {
        $webReturn = TRUE;
        if ($this->store_info == null) {
            $webReturn = FALSE;
            redirect($redirectTo);
        }
        return $webReturn;
    }

    public function checkSessionBeUser($redirectTo = 'loginmember') {
        $webReturn = TRUE;
        if ($this->store_info == null) {
            $webReturn = FALSE;
            throw new Exception("Session expired, please login..", 1);
        }
        return $webReturn;
    }

    public function checkSessionBE($redirectTo = 'loginmember') {
        $webReturn = TRUE;
        if ($this->username == null) {
            $webReturn = FALSE;
            throw new Exception("Session expired, please login..", 1);
        }
        return $webReturn;
    }

    public function ifDion($redirectTo = 'loginmember') {
        $webReturn = TRUE;
        if ($this->username == "DION") {
            $webReturn = FALSE;
            throw new Exception("Only Dion Allowed..!!", 1);
        }
        return $webReturn;
    }

    public function createThumbnails($vfile_upload, $thumb_dir, $img_name) {
        //identitas file asli
        $im_src = imagecreatefromjpeg($vfile_upload);
        $src_width = imageSX($im_src);
        $src_height = imageSY($im_src);

        //Simpan dalam versi small 320 pixel
        //set ukuran gambar perbandingan perubahan
        $dst_width = 200;
        $dst_height = 200;


        //resize height
        $ratio = $dst_height / $src_height;
        $width = $src_width * $ratio;
        //$this->resize($width,$height);
        //resize width
        $ratio = $dst_width / $src_width;
        $height = $src_height * $ratio;
        //$this->resize($width,$height);
        //scale
        $scale = 50;
        $width = $src_width * $scale / 100;
        $height = $src_height * $scale / 100;
        //$this->resize($width,$height);
        //proses perubahan ukuran
        $im = imagecreatetruecolor($width, $height);
        imagecopyresampled($im, $im_src, 0, 0, 0, 0, $width, $height, $src_width, $src_height);


        //Simpan gambar
        imagejpeg($im, $thumb_dir . $img_name);

        imagedestroy($im_src);
        imagedestroy($im);
    }

    public function setTemplate($mainTemplate, $data = null) {
        $this->load->view('includes/div_opening', $data);
        $this->load->view($mainTemplate, $data);
        $this->load->view('includes/div_closing', $data);
    }

    public function runValidation($param) {
        if ($this->form_validation->run($param) == FALSE) {
            $err = "Please fill required input";
            if ($param == 'admLogin') {
                redirect('admin/login/err');
            }
            throw new Exception($err, 1);
        }
    }

    public function checkSessionUser() {
        
    }

    function jsonTrueResponse($data) {
        $arr = array("response" => "true", "arrayData" => $data);
        return $arr;
    }

    function jsonFalseResponse($message) {
        $arr = array("response" => "false", "message" => $message);
        return $arr;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */