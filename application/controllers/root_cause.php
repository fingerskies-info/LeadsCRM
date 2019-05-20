<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Root_cause extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array('Rc_Model','Ct_Model','Prblm_Model'));
        $this->data['rc_ID'] = '';
        $this->data['rc_name'] = $this->data['ct_id_fk'] =$this->data['prblm_id_fk'] ='';
    }


    public function index($sortfield = 'ct_id_pk', $order = 'asc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('rc_sortfld', $this->sortfield);
        $this->session->set_userdata('rc_sortorder', $this->order);

        $total_rows = $this->Ct_Model->getCaseTopic($where);

        if (null == $this->session->userdata('rc_rows')) {
            $rows = '3';
        } else {
            $rows = $this->session->userdata('rc_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/root_cause/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        //$this->data['CASE_ISSUE'] = $this->Prblm_Model->getIssuesList($where, $this->sortfield, $this->order, $offset, $rows);
        $this->data['CASE_TOPIC'] = $this->Ct_Model->getCaseTopicList($where,'ct_id_pk', $this->order, $offset, $rows);
        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'root cause';
        $module['rccnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('root_cause', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'root cause';
        $this->load->view('header', $module);
        $this->data['TOPIC'] = $this->Ct_Model->getCaseTopicList(' where 1=1 ');
        //$this->data['ISSUE'] = $this->Prblm_Model->getCaseTopicList(' where is_complaint=1 ');
        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_cause', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['root_causedet'] = $this->Rc_Model->getRootCauseList(' where rc_id_pk=' . $slug);
            $this->load->view('add_cause', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('rc_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('rc_sortfld'), $this->session->userdata('rc_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['cause_name'] = trim($this->input->post('txt_cause_name'));
        $this->data['ct_id'] = trim($this->input->post('sel_ct_id'));
        $this->data['prblm_id_fk'] = trim($this->input->post('sel_prblm_id'));
        
        $this->data['error'] = '';
        //var_dump($this->data); exit;
        
        if (empty($this->data['ct_id']) || $this->data['ct_id']==0) {
            $this->data['error'] .= 'Topic can not be blanked<br/>';
        }
        
        if (empty($this->data['prblm_id_fk']) || $this->data['prblm_id_fk']==0) {
            $this->data['error'] .= 'Issue can not be blanked<br/>';
        }
        
        if (empty($this->data['cause_name'])) {
            $this->data['error'] .= 'Root cause name can not be blanked<br/>';
        }
        if (empty($this->data['error'])) {
            $ct_data = array(
                'rc_name' => $this->data['cause_name'],
                'rc_date' => date('Y-m-d H:i:s'),
                'ct_id_fk' => $this->data['ct_id'],
                'prblm_id_fk' => $this->data['prblm_id_fk'],
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
                //$schannel_data += array('created_date' => date('Y-m-d H:i:s'));
                $ctId = $this->Common_Model->insert_table('root_cause_mst',$ct_data);
                if ($ctId) {
                    $this->data['message'] = "Root cause saved successfully!..";
                }
            } else {
               // $schannel_data += array('modify_date' => date('Y-m-d H:i'), 'modify_by' => $session['id']);

                $ctId = $this->Common_Model->update_table('root_cause_mst',$ct_data, array('rc_id_pk' => $id));
                if ($ctId) {
                    $this->data['message'] = "Root cause updated successfully!..";
                }
            }

            $this->index($this->session->userdata('rc_sortfld'), $this->session->userdata('rc_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('root_cause_mst','rc_id_pk',$id);
        $this->data['message'] = "Root cause is removed successfully!..";
        $this->index($this->session->userdata('rc_sortfld'), $this->session->userdata('rc_sortorder'));
    }
function getCauseFrmIssue(){
        $id = ($this->input->post('issueid'));
        $rcid = ($this->input->post('rc_id')!='')?$this->input->post('rc_id'):'';
        $html = '';
        $prblm_arr = $this->Rc_Model->getIssueRootCause($id);
        foreach($prblm_arr as $parr){
            $sel = ($rcid=$parr->rc_id_pk?'selected="selected"':'');
            $html .='<option value="'.$parr->rc_id_pk.'" '.$sel.'>'.$parr->rc_name.'</option>';
        }
      echo $html;
    }
}
