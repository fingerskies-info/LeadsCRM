<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Touch_point extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Tp_Model');
        $this->data['tp_ID'] = $this->data['person_name'] = $this->data['company_name'] = $this->data['address'] = $this->data['home_tel'] = $this->data['off_tel'] = $this->data['mobile'] = $this->data['email'] = $this->data['postal_code'] = $this->data['designation'] = $this->data['enquiry_type'] = $this->data['enquiry_msg'] = $this->data['enquiry_date'] = $this->data['staff_id'] = $this->data['modify_date'] = $this->data['modify_by'] = '';
        $this->data['tp_name'] = '';
    }


    public function index($sortfield = 'tp_id_pk', $order = 'desc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('tp_sortfld', $this->sortfield);
        $this->session->set_userdata('tp_sortorder', $this->order);

        $total_rows = $this->Tp_Model->getTouchPoint($where);

        if (null == $this->session->userdata('tp_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('tp_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/touch_point/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        $this->data['TOUCH_POINT'] = $this->Tp_Model->getTouchPointList($where, $this->sortfield, $this->order, $offset, $rows);

        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'touch point';
        $module['tpcnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('touch_point', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'touch point';
        $this->load->view('header', $module);

        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_tp', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['tpdet'] = $this->Tp_Model->getTouchPointList(' where tp_id_pk=' . $slug);
            $this->load->view('add_tp', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('tp_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('tp_sortfld'), $this->session->userdata('tp_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['tp_name'] = trim($this->input->post('txt_tp_name'));


        $this->data['error'] = '';

        if (empty($this->data['tp_name'])) {
            $this->data['error'] .= 'Touch point name can not be blanked<br/>';
        }


        if (empty($this->data['error'])) {
            $tp_data = array(
                'tp_name' => $this->data['tp_name'],
                'tp_date' => date('Y-m-d H:i:s'),
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
               
                $tpId = $this->Common_Model->insert_table('touch_point_mst',$tp_data);
                if ($tpId) {
                    $this->data['message'] = "Touch point saved successfully!..";
                }
            } else {
              
                $tpId = $this->Common_Model->update_table('touch_point_mst',$tp_data, array('tp_id_pk' => $id));
                if ($tpId) {
                    $this->data['message'] = "Touch point updated successfully!..";
                }
            }

            $this->index($this->session->userdata('tp_sortfld'), $this->session->userdata('tp_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('touch_point_mst','tp_id_pk',$id);
        $this->data['message'] = "Touch point is removed successfully!..";
        $this->index($this->session->userdata('tp_sortfld'), $this->session->userdata('tp_sortorder'));
    }

}
