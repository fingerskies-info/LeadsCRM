<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array('Prblm_Model','Ct_Model'));
        $this->data['prblm_ID'] = '';
        $this->data['prblm_name'] = $this->data['ct_id_fk'] ='';
    }


    public function index($sortfield = 'ct_id_pk', $order = 'asc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('prblm_sortfld', $this->sortfield);
        $this->session->set_userdata('prblm_sortorder', $this->order);

        $total_rows = $this->Ct_Model->getCaseTopic($where);

        if (null == $this->session->userdata('prblm_rows')) {
            $rows = '3';
        } else {
            $rows = $this->session->userdata('prblm_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/issue/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        //$this->data['CASE_ISSUE'] = $this->Prblm_Model->getIssuesList($where, $this->sortfield, $this->order, $offset, $rows);
        $this->data['CASE_TOPIC'] = $this->Ct_Model->getCaseTopicList($where,'ct_id_pk', $this->order, $offset, $rows);
        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'issue';
        $module['prblmcnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('issue', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'issue';
        $this->load->view('header', $module);
        $this->data['TOPIC'] = $this->Ct_Model->getCaseTopicList(' where 1=1 ');
        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_prblm', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['prblmdet'] = $this->Prblm_Model->getIssueList(' where prblm_id_pk=' . $slug);
            $this->load->view('add_prblm', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('prblm_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('prblm_sortfld'), $this->session->userdata('prblm_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['prblm_name'] = trim($this->input->post('txt_prblm_name'));
        $this->data['ct_id'] = trim($this->input->post('sel_ct_id'));
        $this->data['is_complain'] = $this->input->post('is_complain');
        $this->data['error'] = '';
        //var_dump($this->data); exit;
        if (empty($this->data['prblm_name'])) {
            $this->data['error'] .= 'Issue name can not be blanked<br/>';
        }


        if (empty($this->data['error'])) {
            $ct_data = array(
                'prblm_name' => $this->data['prblm_name'],
                'prblm_date' => date('Y-m-d H:i:s'),
                'ct_id_fk' => $this->data['ct_id'],
                'is_complaint' => $this->data['is_complain'],
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
                //$schannel_data += array('created_date' => date('Y-m-d H:i:s'));
                $ctId = $this->Common_Model->insert_table('prblm_mst',$ct_data);
                if ($ctId) {
                    $this->data['message'] = "Issue saved successfully!..";
                }
            } else {
               // $schannel_data += array('modify_date' => date('Y-m-d H:i'), 'modify_by' => $session['id']);

                $ctId = $this->Common_Model->update_table('prblm_mst',$ct_data, array('prblm_id_pk' => $id));
                if ($ctId) {
                    $this->data['message'] = "Issue updated successfully!..";
                }
            }

            $this->index($this->session->userdata('prblm_sortfld'), $this->session->userdata('prblm_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('prblm_mst','prblm_id_pk',$id);
        $this->data['message'] = "Issue is removed successfully!..";
        $this->index($this->session->userdata('prblm_sortfld'), $this->session->userdata('prblm_sortorder'));
    }
    function getIssuesFrmTopic(){
        $id = ($this->input->post('topicid'));
        $comp_id = ($this->input->post('comp_id')==3)?'1':'0';
        $prblm_id = ($this->input->post('prblm_id')!='' && $this->input->post('prblm_id')!='undefined')?$this->input->post('prblm_id'):'';
        $html = '';
        $prblm_arr = $this->Prblm_Model->getIssuesFrmTopic($id,$comp_id);
       // var_dump($prblm_arr);
        $sel = '';
        foreach($prblm_arr as $parr){
            $sel = ($prblm_id==$parr->prblm_id_pk)?'selected="selected"':'';
            $html .='<option value="'.$parr->prblm_id_pk.'" '.$sel.'>'.$parr->prblm_name.'</option>';
        }
      echo $html;
    }
}
