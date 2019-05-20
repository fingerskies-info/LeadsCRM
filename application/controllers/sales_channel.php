<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_channel extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['schannelID'] = $this->data['person_name'] = $this->data['company_name'] = $this->data['address'] = $this->data['home_tel'] = $this->data['off_tel'] = $this->data['mobile'] = $this->data['email'] = $this->data['postal_code'] = $this->data['designation'] = $this->data['enquiry_type'] = $this->data['enquiry_msg'] = $this->data['enquiry_date'] = $this->data['staff_id'] = $this->data['modify_date'] = $this->data['modify_by'] = '';
        $this->data['schannel_name'] = '';
    }


    public function index($sortfield = 'schannel_id_pk', $order = 'desc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('schannel_sortfld', $this->sortfield);
        $this->session->set_userdata('schannel_sortorder', $this->order);

        $total_rows = $this->SchannelModel->getTotalSalesChannel($where);

        if (null == $this->session->userdata('schannel_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('schannel_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/sales_channel/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        $this->data['SCHANNEL'] = $this->SchannelModel->getSalesChannelList($where, $this->sortfield, $this->order, $offset, $rows);

        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'sales channel';
        $module['schannelcnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('sales_channel', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'sales channel';
        $this->load->view('header', $module);

        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_schannel', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['schanneldet'] = $this->SchannelModel->getSalesChannelList(' where schannel_id_pk=' . $slug);
            $this->load->view('add_schannel', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('schannel_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('schannel_sortfld'), $this->session->userdata('schannel_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['schannel_name'] = trim($this->input->post('txt_schannel_name'));


        $this->data['error'] = '';

        if (empty($this->data['schannel_name'])) {
            $this->data['error'] .= 'Sales channel name can not be blanked<br/>';
        }


        if (empty($this->data['error'])) {
            $schannel_data = array(
                'scn_name' => $this->data['schannel_name'],
                'scn_date' => date('Y-m-d H:i:s'),
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
                //$schannel_data += array('created_date' => date('Y-m-d H:i:s'));
                $schannelId = $this->Common_Model->insert_table('sales_channel_mst',$schannel_data);
                if ($schannelId) {
                    $this->data['message'] = "Sales channel saved successfully!..";
                }
            } else {
               // $schannel_data += array('modify_date' => date('Y-m-d H:i'), 'modify_by' => $session['id']);

                $schannelId = $this->Common_Model->update_table('sales_channel_mst',$schannel_data, array('schannel_id_pk' => $id));
                if ($schannelId) {
                    $this->data['message'] = "Sales channel updated successfully!..";
                }
            }

            $this->index($this->session->userdata('schannel_sortfld'), $this->session->userdata('schannel_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('sales_channel_mst','schannel_id_pk',$id);
        $this->data['message'] = "Sales channel is removed successfully!..";
        $this->index($this->session->userdata('schannel_sortfld'), $this->session->userdata('schannel_sortorder'));
    }

}
