<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->folderView = "member/";
        $this->load->model('member/Member_report_model', 'm_member_report');
    }

    //$route['member/reg'] = 'member/member/regMember';
    public function regMember() {
        
    }

    //$route['member/search'] = 'member/member/searchMember';
    public function searchMember() {
        $data['form_header'] = "Member Search";
        $data['icon'] = "icon-search";
        $data['form_action'] = 'member/search/list';
        $data['form_reload'] = 'member/search';

        if ($this->username != null) {

            //cek apakah group adalah ADMIN atau BID06
            if ($this->stockist == "BID06") {
                //$data['onchange'] = "onchange=Stockist.getStockistInfo(this.value)"; 
                //$data['loccd_read'] = "";
            } else {
                //$data['onchange'] = "";
                //$data['loccd_read'] = "readonly=readonly";
            }

            //$data['result'] = $this->m_stockist->getStockistInfo($this->stockist);
            $this->setTemplate($this->folderView . 'searchMember', $data);
        } else {
            //echo sessionExpireMessage(false);
            $this->setTemplate('includes/inline_login', $data);
        }
    }

    //$route['member/search/list'] = 'member/member/searchMemberList';
    public function searchMemberList() {
        $x = $this->input->post(NULL, TRUE);
        if ($x['paramMember'] == "dfno") {
            $data['result'] = $this->m_member_report->getDetailMemberByID($x['paramMemberValue']);
            //print_r($data['result']);
            $this->load->view($this->folderView . 'detailsMember', $data);
        } else if ($x['paramMember'] == "tel_hp" || $x['paramMember'] == "fullnm" || $x['paramMember'] == "idno" || $x['paramMember'] == "sfno" || $x['paramMember'] == "sfno_reg") {
            $data['result'] = $this->m_member_report->getListMemberByParam($x['paramMember'], $x['paramMemberValue']);
            $this->load->view($this->folderView . 'listMember', $data);
        } else if ($x['paramMember'] == "jointdt") {
            $data['result'] = $this->m_member_report->getListMemberByJoinDate($x['sc_dfno'], $x['mb_from'], $x['mb_to']);

            $this->load->view($this->folderView . 'listMember', $data);
        } else if ($x['paramMember'] == "mm") {
            $data['result'] = $this->m_member_report->getListMemberByMM($x['paramMemberValue']);
            //print_r($data['result']);
            $this->load->view($this->folderView . 'listMemberByMM', $data);
        }
    }

    //$route['member/id/(:any)'] = 'member/member/getMemberByID/$1';
    public function getMemberByID($id) {
        $data['result'] = $this->m_member_report->getDetailMemberByID($id);
        $this->load->view($this->folderView . 'detailsMember', $data);
    }

}
