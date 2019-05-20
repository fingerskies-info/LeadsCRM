<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Case_nature extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Case_nature_Model');
        $this->data['cn_ID'] = $this->data['person_name'] = $this->data['company_name'] = $this->data['address'] = $this->data['home_tel'] = $this->data['off_tel'] = $this->data['mobile'] = $this->data['email'] = $this->data['postal_code'] = $this->data['designation'] = $this->data['enquiry_type'] = $this->data['enquiry_msg'] = $this->data['enquiry_date'] = $this->data['staff_id'] = $this->data['modify_date'] = $this->data['modify_by'] = '';
        $this->data['cn_name'] = '';
    }


    public function index($sortfield = 'cn_id_pk', $order = 'desc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('cn_sortfld', $this->sortfield);
        $this->session->set_userdata('cn_sortorder', $this->order);

        $total_rows = $this->Case_nature_Model->getCaseNature($where);

        if (null == $this->session->userdata('cn_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('cn_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/case_nature/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        $this->data['CASE_NATURE'] = $this->Case_nature_Model->getCaseNatureList($where, $this->sortfield, $this->order, $offset, $rows);

        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'case nature';
        $module['tpcnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('case_nature', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'case nature';
        $this->load->view('header', $module);

        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_cn', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['cndet'] = $this->Case_nature_Model->getCaseNatureList(' where cn_id_pk=' . $slug);
            $this->load->view('add_cn', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('cn_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('cn_sortfld'), $this->session->userdata('cn_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['cn_name'] = trim($this->input->post('txt_cn_name'));


        $this->data['error'] = '';

        if (empty($this->data['cn_name'])) {
            $this->data['error'] .= 'Case nature name can not be blanked<br/>';
        }


        if (empty($this->data['error'])) {
            $cn_data = array(
                'cn_name' => $this->data['cn_name'],
                'cn_date' => date('Y-m-d H:i:s'),
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
                //$schannel_data += array('created_date' => date('Y-m-d H:i:s'));
                $cnId = $this->Common_Model->insert_table('case_nature_mst',$cn_data);
                if ($cnId) {
                    $this->data['message'] = "Nature of case saved successfully!..";
                }
            } else {
              
                $cnId = $this->Common_Model->update_table('case_nature_mst',$cn_data, array('cn_id_pk' => $id));
                if ($cnId) {
                    $this->data['message'] = "Nature of case updated successfully!..";
                }
            }

            $this->index($this->session->userdata('cn_sortfld'), $this->session->userdata('cn_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('case_nature_mst','cn_id_pk',$id);
        $this->data['message'] = "Nature of case is removed successfully!..";
        $this->index($this->session->userdata('cn_sortfld'), $this->session->userdata('cn_sortorder'));
    }

}
