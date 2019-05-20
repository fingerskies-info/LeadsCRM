<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Case_topic extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Ct_Model');
        $this->data['ct_ID'] = $this->data['person_name'] = $this->data['company_name'] = $this->data['address'] = $this->data['home_tel'] = $this->data['off_tel'] = $this->data['mobile'] = $this->data['email'] = $this->data['postal_code'] = $this->data['designation'] = $this->data['enquiry_type'] = $this->data['enquiry_msg'] = $this->data['enquiry_date'] = $this->data['staff_id'] = $this->data['modify_date'] = $this->data['modify_by'] = '';
        $this->data['ct_name'] = '';
    }


    public function index($sortfield = 'ct_id_pk', $order = 'desc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('ct_sortfld', $this->sortfield);
        $this->session->set_userdata('ct_sortorder', $this->order);

        $total_rows = $this->Ct_Model->getCaseTopic($where);

        if (null == $this->session->userdata('ct_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('ct_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/case_topic/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        $this->data['CASE_TOPIC'] = $this->Ct_Model->getCaseTopicList($where, $this->sortfield, $this->order, $offset, $rows);

        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'case topic';
        $module['ctcnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('case_topic', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'case topic';
        $this->load->view('header', $module);

        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_ct', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['ctdet'] = $this->Ct_Model->getCaseTopicList(' where ct_id_pk=' . $slug);
            $this->load->view('add_ct', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('ct_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('ct_sortfld'), $this->session->userdata('ct_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['ct_name'] = trim($this->input->post('txt_ct_name'));


        $this->data['error'] = '';

        if (empty($this->data['ct_name'])) {
            $this->data['error'] .= 'Case topic name can not be blanked<br/>';
        }


        if (empty($this->data['error'])) {
            $ct_data = array(
                'ct_name' => $this->data['ct_name'],
                'ct_date' => date('Y-m-d H:i:s'),
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
                //$schannel_data += array('created_date' => date('Y-m-d H:i:s'));
                $ctId = $this->Common_Model->insert_table('case_topic_mst',$ct_data);
                if ($ctId) {
                    $this->data['message'] = "Case topic saved successfully!..";
                }
            } else {
               // $schannel_data += array('modify_date' => date('Y-m-d H:i'), 'modify_by' => $session['id']);

                $ctId = $this->Common_Model->update_table('case_topic_mst',$ct_data, array('ct_id_pk' => $id));
                if ($ctId) {
                    $this->data['message'] = "Case topic updated successfully!..";
                }
            }

            $this->index($this->session->userdata('ct_sortfld'), $this->session->userdata('ct_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('case_topic_mst','ct_id_pk',$id);
        $this->data['message'] = "Case topic is removed successfully!..";
        $this->index($this->session->userdata('ct_sortfld'), $this->session->userdata('ct_sortorder'));
    }

}
