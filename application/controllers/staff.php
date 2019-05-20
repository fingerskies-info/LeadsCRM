<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
public function __construct()
    {
        parent::__construct();
        $this->data['staff_name']=$this->data['staff_mobile']=$this->data['staff_status']=$this->data['staff_uname']=$this->data['staff_email'] = '';     
    }
	public function reset(){
	$this->session->unset_userdata('staff_srchset');
	$this->session->unset_userdata('srch_staffname');
	 $this->index($this->session->userdata('staff_sortfld'), $this->session->userdata('staff_sortorder'));
	}
	
	public function search(){
	 		
			$this->data['staffname'] = $_POST['staffname'];
			
			
			$where = ' where 1=1 ';
			
            if ($this->data['staffname'] != '0') {
			    $this->session->set_userdata('srch_staffname', $this->data['staffname']);
                $where .= ' and staff_uname like "%' . $this->data['staffname'] . '%"';
            }

			
			$this->session->set_userdata('staff_srchset', $where);
			  $this->index($this->session->userdata('staff_sortfld'), $this->session->userdata('staff_sortorder'));
			
        }
	public function index($sortfield='staff_id_pk', $order='desc', $page='1')
	{
           
           if (null == $this->session->userdata('staff_srchset')) {
				$where = ' where 1=1';
			}else{
				$where = $this->session->userdata('staff_srchset');
			}
			if (null == $this->session->userdata('srch_staffname')) {
				$this->data['staffname'] = '';
			}else{
				$this->data['staffname'] = $this->session->userdata('srch_staffname');
			}
        $this->sortfield = $sortfield;
        $this->order = $order;
		$this->session->set_userdata('staff_srchset', $where);
		
        $this->session->set_userdata('staff_sortfld', $this->sortfield);
        $this->session->set_userdata('staff_sortorder', $this->order);
		
        $total_rows = $this->StaffModel->getTotalStaff($where);
        if (null == $this->session->userdata('staff_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('staff_rows');
        }
        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/staff/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);
		
        $this->data['STAFF'] = $this->StaffModel->getStaffList($where, $this->sortfield, $this->order, $offset, $rows);
        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();
		
		$module['title']='staff';
		$module['staffcnt'] = $total_rows;
        $this->load->view('header',$module);
		$this->load->view('staff', $this->data);
		$this->load->view('footer');
	}
        public function add($slug='')
	{
			$module['title']='staff';
              $this->load->view('header',$module);
             if (empty($slug)) {
                 $this->data['id'] = '';
                 $this->load->view('add_staff', $this->data);
        } else {
               
            $this->data['id'] = $slug;
            $this->data['staffdet'] = $this->StaffModel->getStaffList(' where staff_id_pk=' . $slug);
            $this->load->view('add_staff', $this->data);
            
        }
		$this->load->view('footer');
              
		//$this->load->view('add_cust');
	}
        
        
         public function export() {
			$this->load->library('PHPExcel');
			$objPHPExcel = new PHPExcel();
	
			// Set document properties
			$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
					->setLastModifiedBy("Maarten Balliauw")
					->setTitle("Office 2007 XLSX Test Document")
					->setSubject("Office 2007 XLSX Test Document")
					->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
					->setKeywords("office 2007 openxml php")
					->setCategory("Test result file");
	
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Name')
					->setCellValue('B1', 'Username')
					->setCellValue('C1', 'Mobile')
					->setCellValue('D1', 'Email');
			$i = 2;
			$staff_list = $this->StaffModel->getStaffList($this->session->userdata('staff_srchset'));
			foreach(range('A','D') as $columnID) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			->setAutoSize(true);
	}
			foreach ($staff_list as $ulist) {
				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A' . $i, $ulist->staff_name)
						->setCellValue('B' . $i, $ulist->staff_uname)
						->setCellValue('C' . $i, $ulist->staff_mobile)
						->setCellValue('D' . $i, $ulist->staff_email);
	
				$i++;
			}
	
			$objPHPExcel->getActiveSheet()->setTitle('Staff List');
	
	
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
	
			$file_name = 'Staff_'.date('dmy_hi').'.xls';
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$file_name.'"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');
	
			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0
	
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
		}
	
		function exportPDF() {
			$this->load->library('cezpdf');
			$this->load->helper('pdf');
			$staff_list = $this->StaffModel->getStaffList($this->session->userdata('staff_srchset').' and staff_id_pk!=1');
			prep_pdf(); // creates the footer for the document we are creating.
	
			foreach ($staff_list as $ulist) {
				$db_data[] = array('staff_name' => $ulist->staff_name, 
					'staff_uname' => $ulist->staff_uname,
					'staff_number' => $ulist->staff_mobile,
					'staff_email' => $ulist->staff_email);
			}
	
			$col_names = array(
				'staff_name' => 'Name',
				 'staff_uname' => 'Username',
				'staff_number' => 'Mobile',
				 'staff_email' => 'Email'     
			);
	
			$this->cezpdf->ezTable($db_data, $col_names, 'Staffs', array('width' => 580));
			$this->cezpdf->ezStream();
		}
	
		function showRows() {
			$this->session->set_userdata('staff_rows', $this->input->post('txtrows'));
			$this->index($this->session->userdata('staff_sortfld'), $this->session->userdata('staff_sortorder'));

		}
			public function save() {
			$id = ($this->input->post('id'));
			$this->data['staff_name']= trim($this->input->post('txtstaffname'));
			$this->data['staff_mobile'] = trim($this->input->post('txtstaffnumber'));
			$this->data['staff_email'] = trim($this->input->post('txtstaffemail'));
			$this->data['staff_status'] = trim($this->input->post('selstaffstatus'));
			$this->data['selstaffrole'] = $this->input->post('selstaffrole');
                        
			$this->data['error'] = '';
		   
			if (empty($this->data['staff_name'])) {
				$this->data['error'] .= 'Staff Name can not be blanked<br/>';
			}
			
			if(empty($id)){
	
				$this->data['staff_uname'] = trim($this->input->post('txtstaffuname'));
				$this->data['staff_pwd'] = trim($this->input->post('txtstaffpwd'));
				$this->data['staff_cpwd'] = trim($this->input->post('txtstaffcpwd'));

				if (empty($this->data['staff_uname'])) {
					$this->data['error'] .= 'Username can not be blanked<br/>';

				}else{

					// Check Username existance
					if($this->StaffModel->StaffUsernameExists($this->data['staff_uname'],$id)){
						$this->data['error'] .= 'Username exists. Please choose another<br/>';

					}
				}

				if (empty($this->data['staff_pwd'])) {
					$this->data['error'] .= 'Password can not be blanked<br/>';

				}else if (empty($this->data['staff_cpwd'])) {
					$this->data['error'] .= 'Confirm password can not be blanked<br/>';

				}else	if ($this->data['staff_cpwd'] != $this->data['staff_pwd']) {
					$this->data['error'] .= 'Passwords do not match<br/>';

				}

				
				
		}   
        
        if (empty($this->data['error'])) {
            $staff = array(
                'staff_name'=>$this->data['staff_name'],
                'staff_mobile' => $this->data['staff_mobile'],
		'staff_email' => $this->data['staff_email'],
                'staff_role' => $this->data['selstaffrole'],
                'staff_active' => $this->data['staff_status'] );

            if (empty($id)) {
				
				$staff += array(
					'staff_uname'=>$this->data['staff_uname'],
					'staff_pwd' => md5($this->data['staff_pwd']));

                $staffId = $this->StaffModel->addStaff($staff);
                if ($staffId) {
                    $this->data['message'] = "Staff Saved Successfully!..";
                }
            } else {
                $staffId = $this->StaffModel->updateStaff($staff, array('staff_id_pk' => $id));
                if ($staffId) {
                    $this->data['message'] = "Staff Updated Successfully!..";
                }
            }
           
            $this->index($this->session->userdata('staff_sortfld'), $this->session->userdata('staff_sortorder'));
        } else {
            $this->add($id);
        }
    }
    function  delete($id){
        
            $this->StaffModel->delStaff($id);
            $this->data['message'] = "Staff Deleted Successfully!..";
        
        $this->index();
    }
	function staffListdrp($staffid=''){
		$staffdet = $this->StaffModel->getStaffList(' where staff_id_pk!=1');
		$html = '<select id="sel_orderstaff">';
		if(!empty($staffdet)){
			foreach($staffdet as $s){
				$html .= '<option value="'.$s->staff_id_pk.'">'.$s->staff_name.'</option>';
			}
		}
		$html .='</select>';
		echo $html;
	}
}
