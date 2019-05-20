<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Prdc_catModel');
        $this->data['prdc_cat_ID'] = $this->data['person_name'] = $this->data['company_name'] = $this->data['address'] = $this->data['home_tel'] = $this->data['off_tel'] = $this->data['mobile'] = $this->data['email'] = $this->data['postal_code'] = $this->data['designation'] = $this->data['enquiry_type'] = $this->data['enquiry_msg'] = $this->data['enquiry_date'] = $this->data['staff_id'] = $this->data['modify_date'] = $this->data['modify_by'] = '';
        $this->data['prdc_cat_name'] = '';
    }


    public function index($sortfield = 'prdc_cat_id_pk', $order = 'desc', $page = '1') {
        
        $this->sortfield = $sortfield;
        $this->order = $order;

        $where = ' where 1=1';

        $this->session->set_userdata('prdc_cat_sortfld', $this->sortfield);
        $this->session->set_userdata('prdc_cat_sortorder', $this->order);

        $total_rows = $this->Prdc_catModel->getTotalProductCategory($where);

        if (null == $this->session->userdata('prdc_cat_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('prdc_cat_rows');
        }

        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("product_category/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        $this->data['PRDC_CAT'] = $this->Prdc_catModel->getProductCategoryList($where, $this->sortfield, $this->order, $offset, $rows);

        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();

        $module['title'] = 'procuct category';
        $module['prdc_catcnt'] = $total_rows;
        $this->load->view('header', $module);
        $this->load->view('product_category', $this->data);
        $this->load->view('footer');
    }

    public function add($slug = '') {

        $module['title'] = 'procuct category';
        $this->load->view('header', $module);

        if (empty($slug)) {
            $this->data['id'] = '';
            $this->load->view('add_prdc_cat', $this->data);
        } else {
            $this->data['id'] = $slug;
            $this->data['prdc_catdet'] = $this->Prdc_catModel->getProductCategoryList(' where prdc_cat_id_pk=' . $slug);
            $this->load->view('add_prdc_cat', $this->data);
        }
        $this->load->view('footer');
    }

    function showRows() {
        $this->session->set_userdata('prdc_cat_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('prdc_cat_sortfld'), $this->session->userdata('prdc_cat_sortorder'));
    }

    public function save() {

        $session = $this->session->userdata('user_id');
        $id = ($this->input->post('id'));

        $this->data['prdc_cat_name'] = trim($this->input->post('txt_prdc_cat_name'));


        $this->data['error'] = '';

        if (empty($this->data['prdc_cat_name'])) {
            $this->data['error'] .= 'Product category name can not be blanked<br/>';
        }


        if (empty($this->data['error'])) {
            $prdc_cat_data = array(
                'prdc_cat_name' => $this->data['prdc_cat_name'],
                'prdc_cat_date' => date('Y-m-d H:i:s'),
                'staff_id_fk' => $session['id']
            );

            if (empty($id)) {
                //$schannel_data += array('created_date' => date('Y-m-d H:i:s'));
                $prdc_catId = $this->Common_Model->insert_table('prdc_cat_mst',$prdc_cat_data);
                if ($prdc_catId) {
                    $this->data['message'] = "Product category saved successfully!..";
                }
            } else {
               // $schannel_data += array('modify_date' => date('Y-m-d H:i'), 'modify_by' => $session['id']);

                $prdc_catId = $this->Common_Model->update_table('prdc_cat_mst',$prdc_cat_data, array('prdc_cat_id_pk' => $id));
                if ($prdc_catId) {
                    $this->data['message'] = "Product category updated successfully!..";
                }
            }

            $this->index($this->session->userdata('prdc_cat_sortfld'), $this->session->userdata('prdc_cat_sortorder'));
        } else {
            $this->add($id);
        }
    }

    function delete($id) {

        $this->Common_Model->delete_table('prdc_cat_mst','prdc_cat_id_pk',$id);
        $this->data['message'] = "Product category is removed successfully!..";
        $this->index($this->session->userdata('prdc_cat_sortfld'), $this->session->userdata('prdc_cat_sortorder'));
    }

}
