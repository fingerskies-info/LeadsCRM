<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    public function index() {
        if ($this->session->userdata('user_id') == '') {
			
            $this->load->view('login');
			
        } else {
            redirect('enquiry/add', 'refresh');
        }
    }

    public function bye() {
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

    
     public function auth() {
      
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('login');
        } else {
           
            redirect('enquiry/add', 'refresh');
        }
       
    }

    function check_database($password) {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        
        //query the database
         $result = $this->UserModel->login($username, $password);
        
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
				
					

                $sess_array = array(
                    'id' => $row->staff_id_pk,
                    'username' => $row->staff_uname,
		     'role'=>$row->staff_role
                );

                $this->session->set_userdata('user_id', $sess_array);
				 return TRUE;

				}
            
           
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }
    public function not_found() {
        $this->load->view('header');
        $this->load->view('not_404found');
        $this->load->view('footer');
    }
    
     public function wikicourts() {
      $module['title']='WikiCourts';
      $this->load->view('header',$module);  
      $this->load->view('wikicourts');
      $this->load->view('footer');  
    }

}
