<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contractor extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Con_Model');
        $this->data['con_ID'] = $this->data['person_name'] = $this->data['company_name'] = $this->data['address'] = $this->data['home_tel'] = $this->data['off_tel'] = $this->data['mobile'] = $this->data['email'] = $this->data['postal_code'] = $this->data['designation'] = $this->data['enquiry_type'] = $this->data['enquiry_msg'] = $this->data['enquiry_date'] = $this->data['staff_id'] = $this->data['modify_date'] = $this->data['modify_by'] = '';
        $this->data['con_name'] = '';
    }


    public function index($sortfield = 'con_id_pk', $order = 'desc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('con_sortfld', $this->sortfield);
        $this->session->set_userdata('con_sortorder', $this->order);

        $total_rows = $this->Con_Model->getContractor($where);

        if (null == $this->session->userdata('con_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('con_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/contractor/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        $this->data['CONTRACTOR'] = $this->Con_Model->getContractorList($where, $this->sortfield, $this->order, $offset, $rows);

        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'contractor';
        $module['concnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('contractor', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'contractor';
        $this->load->view('header', $module);

        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_con', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['condet'] = $this->Con_Model->getContractorList(' where con_id_pk=' . $slug);
            $this->load->view('add_con', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('con_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('con_sortfld'), $this->session->userdata('con_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['con_name'] = trim($this->input->post('txt_con_name'));


        $this->data['error'] = '';

        if (empty($this->data['con_name'])) {
            $this->data['error'] .= 'Contractor name can not be blanked<br/>';
        }


        if (empty($this->data['error'])) {
            $con_data = array(
                'con_name' => $this->data['con_name'],
                'con_date' => date('Y-m-d H:i:s'),
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
                //$schannel_data += array('created_date' => date('Y-m-d H:i:s'));
                $conId = $this->Common_Model->insert_table('contractor_mst',$con_data);
                if ($conId) {
                    $this->data['message'] = "Contractor saved successfully!..";
                }
            } else {
               // $schannel_data += array('modify_date' => date('Y-m-d H:i'), 'modify_by' => $session['id']);

                $conId = $this->Common_Model->update_table('contractor_mst',$con_data, array('con_id_pk' => $id));
                if ($conId) {
                    $this->data['message'] = "Contractor updated successfully!..";
                }
            }

            $this->index($this->session->userdata('con_sortfld'), $this->session->userdata('con_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('contractor_mst','con_id_pk',$id);
        $this->data['message'] = "Contractor is removed successfully!..";
        $this->index($this->session->userdata('con_sortfld'), $this->session->userdata('con_sortorder'));
    }

}
