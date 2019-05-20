<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Owner_root_cause extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array('Orc_Model','Rc_Model','Ct_Model','Prblm_Model'));
        $this->data['orc_ID'] = '';
        $this->data['orc_name'] = $this->data['orc_cat_id'] ='';
    }


    public function index($sortfield = 'orc_id_pk', $order = 'asc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('orc_sortfld', $this->sortfield);
        $this->session->set_userdata('orc_sortorder', $this->order);

        $total_rows = $this->Orc_Model->getOwnerRC($where);

        if (null == $this->session->userdata('orc_rows')) {
            $rows = '3';
        } else {
            $rows = $this->session->userdata('orc_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/owner_root_cause/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);
        $this->data['OWNER_TOPIC'] = $this->Orc_Model->getOwnerRCList($where,$this->sortfield, $this->order, $offset, $rows);
        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'owner_root cause';
        $module['rccnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('owner_root_cause', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'owner_root cause';
        $this->load->view('header', $module);

        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_ownercause', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['root_causedet'] = $this->Orc_Model->getOwnerRCList(' where orc_id_pk=' . $slug);
            $this->load->view('add_ownercause', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('orc_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('orc_sortfld'), $this->session->userdata('orc_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['owner_cause_name'] = trim($this->input->post('txt_ownercause_name'));
        $this->data['cat_id'] = trim($this->input->post('sel_cat_id'));
                
        $this->data['error'] = '';
    
        if (empty($this->data['cat_id']) || $this->data['cat_id']==0) {
            $this->data['error'] .= 'Category can not be blanked<br/>';
        }
        
                
        if (empty($this->data['owner_cause_name'])) {
            $this->data['error'] .= 'Owner of root cause can not be blanked<br/>';
        }
        if (empty($this->data['error'])) {
            $ct_data = array(
                'orc_name' => $this->data['owner_cause_name'],
                'orc_date' => date('Y-m-d H:i:s'),
                'cat_id_fk' => $this->data['cat_id'],
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
               
                $ctId = $this->Common_Model->insert_table('owner_rc_mst',$ct_data);
                if ($ctId) {
                    $this->data['message'] = "Owner of root cause saved successfully!..";
                }
            } else {
               
                $ctId = $this->Common_Model->update_table('owner_rc_mst',$ct_data, array('orc_id_pk' => $id));
                if ($ctId) {
                    $this->data['message'] = "Owner of root cause updated successfully!..";
                }
            }

            $this->index($this->session->userdata('orc_sortfld'), $this->session->userdata('orc_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('owner_rc_mst','orc_id_pk',$id);
        $this->data['message'] = "Owner of root cause is removed successfully!..";
        $this->index($this->session->userdata('orc_sortfld'), $this->session->userdata('orc_sortorder'));
    }

}
