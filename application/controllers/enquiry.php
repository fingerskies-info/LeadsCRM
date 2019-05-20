<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_Controller {
public function __construct()
    {
	    parent::__construct();
                    $this->load->model(array('EnquiryModel','Prdc_catModel','Tp_Model','Case_nature_Model','Ct_Model','Prblm_Model','Rc_Model','Orc_Model','Con_Model'));
                    $this->data['ccit_cust_name'] =$this->data['ccit_cust_account']=
                    $this->data['ccit_custnric']=$this->data['ccit_mobile']=
                    $this->data['ccit_del_address']=$this->data['ccit_orderdate']=
                    $this->data['ccit_ip_number']=$this->data['ccit_brand_name']=
                    $this->data['ccit_vendor_modelno']=$this->data['ccit_cust_desc']=
                    $this->data['ccit_ship_date']=$this->data['ccit_ship_qnty']=
                    $this->data['cit_caller_name']=$this->data['cit_callernum']=
                    $this->data['cit_call_times']=$this->data['schannel_id_fk']=
                    $this->data['prdc_cat_id_fk']=$this->data['tp_id_fk']=
                    $this->data['cn_id_fk']=
                    $this->data['ct_id_fk']=
                    $this->data['prblm_id_fk']=$this->data['cit_id_fk']=
                    $this->data['rc_id_fk']=$this->data['orc_id_fk']=
                    $this->data['con_id_fk']=$this->data['cit_remarks']=
                    $this->data['status_id_fk']=$this->data['cat_transfer_to']=
                    $this->data['cat_action_msg']=$this->data['cat_action_duedate']=
                    $this->data['cat_closuredate']=$this->data['cat_closuretime']=
                    $this->data['cct_staff_num']=$this->data['cct_staff_name']=
                    $this->data['cct_staff_dept']=$this->data['cct_staff_store']=
                    $this->data['cct_for']=$this->data['cct_remarks']=
                    $this->data['cet_exercised']=
                    $this->data['cet_amount']=
                    $this->data['srchcustid']=$this->data['srchcustacc']=$this->data['srchcustnric']=
                    $this->data['srchcustmobile']=$this->data['srchtopic']=$this->data['srchtopic']=
                    $this->data['srchnature']=$this->data['srchproduct']=$this->data['srchstatus']=
                    $this->data['srchfrmdate']=$this->data['srchtodate']=
                    $this->data['case_received'] = $this->data['case_received_time'] = '';
                    
                    if (null == $this->session->userdata('user_id')) {
                        redirect('login', 'refresh');
                    }
    }
	public function reset(){
            $this->session->unset_userdata('enquiry_srchset');
            $this->session->unset_userdata('srch_txtname');
            $this->session->unset_userdata('srch_txtstaffid');
            $this->session->unset_userdata('srch_txtmobileno');
            $this->session->unset_userdata('srch_enquiry_date');
            $this->index($this->session->userdata('enquiry_sortfld'), $this->session->userdata('enquiry_sortorder'));
	}
	
	public function search(){
	 		
	$this->data['srchcustid'] = $_POST['srchcustid'];
	$this->data['srchcustacc'] = $_POST['srchcustacc'];
	$this->data['srchcustnric'] = $_POST['srchcustnric'];
	$this->data['srchcustmobile'] = $_POST['srchcustmobile'];
        $this->data['srchtopic'] = $_POST['srchtopic'];
        $this->data['srchnature'] = $_POST['srchnature'];
        $this->data['srchproduct'] = $_POST['srchproduct'];
        $this->data['srchstatus'] = $_POST['srchstatus'];
        $this->data['srchfrmdate'] = $_POST['srchfrmdate'];
        $this->data['srchtodate'] = $_POST['srchtodate'];
	$where = ' where 1=1 ';
			
            if ($this->data['srchcustid'] != '') {
			    $this->session->set_userdata('srchcustid', $this->data['srchcustid']);
                $where .= ' and case_number like "%' . $this->data['srchcustid'] . '%"';
            }

			 if ($this->data['srchcustacc'] != '') {
			 $this->session->set_userdata('srchcustacc', $this->data['srchcustacc']);
                $where .= ' and ccit_cust_account  like "%' . $this->data['srchcustacc'] . '%"';
            }

			if ($this->data['srchcustnric'] != '') {
				$this->session->set_userdata('srchcustnric', $this->data['srchcustnric']);
                $where .= ' and ccit_custnric like "%' . $this->data['srchcustnric'] . '%"';
            }
                        if ($this->data['srchcustmobile'] != '') {
			 $this->session->set_userdata('srchcustmobile', $this->data['srchcustmobile']);
                $where .= ' and ccit_mobile  like "%' . $this->data['srchcustmobile'] . '%"';
            }
            
                        if ($this->data['srchtopic'] != '0') {
			 $this->session->set_userdata('srchtopic', $this->data['srchtopic']);
                $where .= ' and ct_id_fk  = "' . $this->data['srchtopic'] . '"';
            }
            
            if ($this->data['srchnature'] != '0') {
			 $this->session->set_userdata('srchnature', $this->data['srchnature']);
                $where .= ' and cn_id_fk  = "' . $this->data['srchnature'] . '"';
            }
            if ($this->data['srchproduct'] != '0') {
			 $this->session->set_userdata('srchproduct', $this->data['srchproduct']);
                $where .= ' and prdc_cat_id_fk  = "' . $this->data['srchproduct'] . '"';
            }
            if ($this->data['srchstatus'] != '0') {
			 $this->session->set_userdata('srchstatus', $this->data['srchstatus']);
                $where .= ' and status_id_fk  = "' . $this->data['srchstatus'] . '"';
            }
            if ($this->data['srchfrmdate'] != '') {
				$this->session->set_userdata('srchfrmdate', $this->data['srchfrmdate']);
                $where .= ' and case_created_date = "' . date('Y-m-d',strtotime($this->data['srchfrmdate'])).'"' ;
            }    
                       
             if ($this->data['srchtodate'] != '') {
				$this->session->set_userdata('srchtodate', $this->data['srchtodate']);
                $where .= ' and case_created_date = "' . date('Y-m-d',strtotime($this->data['srchtodate'])).'"' ;
            }
			
           // echo $where; exit;
            $this->session->set_userdata('enquiry_srchset', $where);
            $this->index();
			
        }

	
	public function index($sortfield='case_id_pk', $order='desc', $page='1')
	{
	
            $session = $this->session->userdata('user_id');
            if (null == $this->session->userdata('enquiry_srchset')) {
		$where = ' where 1=1';
            }else{
		$where = $this->session->userdata('enquiry_srchset');
            }
		if($session["role"] == '2') {
		$where .= ' and case_created_by='.($session["id"]);
            }
			
        $this->sortfield = $sortfield;
        $this->order = $order;
                
	$this->session->set_userdata('enquiry_srchset', $where);

        $this->session->set_userdata('enquiry_sortfld', $this->sortfield);
        $this->session->set_userdata('enquiry_sortorder', $this->order);
		
        $total_rows = $this->EnquiryModel->getTotalEnquiry($where);
        $total_open = $this->EnquiryModel->getTotalEnquiry($where.' and status_id_fk=1');
	if (null == $this->session->userdata('enquiry_rows')) {
            $rows = '10';
        } else {
            $rows = $this->session->userdata('enquiry_rows');
        }
		
        $total_page = round($total_rows / $rows);
        $offset = ($page - 1) * $rows;
        $this->userpagination->init_pagination("index.php/enquiry/index/" . $sortfield . '/' . $order . '/', $total_rows, $rows);

        $this->data['ENQUIRY'] = $this->EnquiryModel->getEnquiryList($where, $this->sortfield, $this->order, $offset, $rows);
	$this->data['sales_channel']= $this->Common_Model->select_table('sales_channel_mst');
        $this->data['touch_point']= $this->Common_Model->select_table('touch_point_mst');
        $this->data['product_cat']= $this->Common_Model->select_table('prdc_cat_mst');
        $this->data['contractor']= $this->Common_Model->select_table('contractor_mst');
        $this->data['case_topic']= $this->Common_Model->select_table('case_topic_mst');
        $this->data['case_nature']= $this->Common_Model->select_table('case_nature_mst');
        $this->data['status_list']= $this->Common_Model->select_table('case_status_mst');
        $this->data['owner_cause']= $this->Common_Model->select_table('owner_rc_mst');
        
        $this->data['sort_by'] = $this->sortfield;
        $this->data['sort_order'] = $this->order;
        $this->data['pageNum'] = $page;
        $this->data['rows'] = $rows;
        $this->data['links'] = $this->pagination->create_links();
		
	$module['title']='enquiry';
	$this->data['enquirycnt'] = $total_rows;
        $this->data['total_open'] = $total_open;
        $this->load->view('header',$module);
	$this->load->view('enquiry', $this->data);
	$this->load->view('footer');
		
	}
        public function add($slug='')
	{
            $module['title']='enquiry';
	    $this->load->view('header',$module);
            
            $this->data['sales_channel']= $this->Common_Model->select_table('sales_channel_mst');
            $this->data['touch_point']= $this->Common_Model->select_table('touch_point_mst');
            $this->data['product_cat']= $this->Common_Model->select_table('prdc_cat_mst');
            $this->data['contractor']= $this->Common_Model->select_table('contractor_mst');
            $this->data['case_topic']= $this->Common_Model->select_table('case_topic_mst');
            $this->data['case_nature']= $this->Common_Model->select_table('case_nature_mst');
            $this->data['status_list']= $this->Common_Model->select_table('case_status_mst');
            $this->data['owner_cause']= $this->Common_Model->select_table('owner_rc_mst');
			      
            if (empty($slug)) {
                $this->data['case_number'] = random_string('numeric',6);
                 $this->data['id'] = '';
                 $this->load->view('call_log', $this->data);
            } else {			   
		$this->data['id'] = $slug;
		$this->data['enquirydet'] = $this->EnquiryModel->getEnquiryList(' where case_id_pk=' . $slug);
		$this->load->view('call_log', $this->data);
		}
            $this->load->view('footer');
	}
      
 public function export() {
	  
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Courts CRM")
                ->setLastModifiedBy("Courts CRM")
                ->setTitle("COURTS Case Log")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Report document for COURTS Case Log.")
                ->setKeywords("office 2007 Courts CRM")
                ->setCategory("Courts CRM");

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Case Raised By')
                ->setCellValue('B1', 'Case Number')
                ->setCellValue('C1', 'Case Open Date')
                ->setCellValue('D1', 'Case Open Time')
                ->setCellValue('E1', 'Customer Name')
                ->setCellValue('F1', 'Account Number')
                ->setCellValue('G1', 'NRIC')
                ->setCellValue('H1', 'Mobile Number')
                ->setCellValue('I1', 'Delivery Address')
                ->setCellValue('J1', 'Order Date')
                ->setCellValue('K1', 'IP Number')
                ->setCellValue('L1', 'Brand Code')
                ->setCellValue('M1', 'Vendor Model No.')
                ->setCellValue('N1', 'Description')
                ->setCellValue('O1', 'Shipment Date')
                ->setCellValue('P1', 'Quantity Shipped')
                ->setCellValue('Q1', 'Case Received Date')
		->setCellValue('R1', 'Case Received Time')
                ->setCellValue('S1', 'Case Acknowledge Date')
                ->setCellValue('T1', 'Case Acknowledge Time')
                ->setCellValue('U1', 'Name Of Caller')
                ->setCellValue('V1', 'Contact Number of Caller')
                ->setCellValue('W1', 'No.of Times Customer Call In')
		->setCellValue('X1', 'Sales Channel')
                ->setCellValue('Y1', 'Product Category')
                ->setCellValue('Z1', 'Touch Point')
		->setCellValue('AA1', 'Nature of Case')
		->setCellValue('AB1', 'Topic of Case')
		->setCellValue('AC1', 'Issue of Case')
		->setCellValue('AD1', 'Internal / External')
                ->setCellValue('AE1', 'Root Cause')
                ->setCellValue('AF1', 'Owner of Root Cause')
                ->setCellValue('AG1', 'Name of del team / Supplier / Installer')
                ->setCellValue('AH1', 'Remarks')
                ->setCellValue('AI1', 'Case Status')
                ->setCellValue('AJ1', 'Case Escalated To')
                ->setCellValue('AK1', 'Action Message')
                ->setCellValue('AL1', 'Action Due Date')
                ->setCellValue('AM1', 'Case Closure Date')
                ->setCellValue('AN1', 'Case Closure Time')
                ->setCellValue('AO1', 'Compliment COURTS Staff Number')
                ->setCellValue('AP1', 'Compliment COURTS Staff Name')
                ->setCellValue('AQ1', 'Compliment COURTS Staff (Dept)')
                ->setCellValue('AR1', 'Compliment COURTS Staff (Store)')
                ->setCellValue('AS1', 'Compliment For Promoter/Installer/Delivery Guys/Supplier')
                ->setCellValue('AT1', 'Type of Compliment')
                ->setCellValue('AU1', 'Compliment Remarks from Customer')
                ->setCellValue('AV1', 'Empowerment Exercise')
                ->setCellValue('AW1', 'Amount') ;
        $i = 2;
        $WHERE = $this->session->userdata('enquiry_srchset');
	$total_rows = $this->EnquiryModel->getTotalEnquiry($WHERE);
        $enquiry_list = $this->EnquiryModel->getEnquiryList($WHERE,'case_id_pk','asc',0,$total_rows);
        foreach(range('A','N') as $columnID) {
    		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
		}
        Foreach(range('O','Z') as $columnID) {
    		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
		}
        foreach(range('AA','AN') as $columnID) {
    		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
		}
         Foreach(range('AO','AZ') as $columnID) {
    		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
		}
                /*echo '<pre>';
                var_dump($enquiry_list);
                exit;*/
                $compliment_for = array("","Promoter","Installer","Delivery Guys","Supplier");
                $compliment_type = array("","Service Recovery","Good Service");
        foreach ($enquiry_list as $ulist) {
            //echo 'comp for :'.$compliment_type[$ulist->cct_type]; exit;
           // echo $this->SchannelModel->getSalesChannelList(' WHERE schannel_id_pk='.$ulist->schannel_id_fk)[0]->scn_name; exit;
            //echo $this->Rc_Model->getRootCauseList(' WHERE rc_id_pk='.$ulist->rc_id_fk)[0]->rc_name; exit;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $ulist->staff_name)
                    ->setCellValue('B' . $i, $ulist->case_number)
                    ->setCellValue('C' . $i, date('d-m-Y',strtotime($ulist->case_created_date)))
                    ->setCellValue('D' . $i, date('h:i A',strtotime($ulist->case_created_date)))
                    ->setCellValue('E' . $i, $ulist->ccit_cust_name)
                    ->setCellValue('F' . $i, $ulist->ccit_cust_account)
                    ->setCellValue('G' . $i, $ulist->ccit_custnric)
                    ->setCellValue('H' . $i, $ulist->ccit_mobile)
                    ->setCellValue('I' . $i, $ulist->ccit_del_address)
                    ->setCellValue('J' . $i, ($ulist->ccit_orderdate!="0000-00-00" && $ulist->ccit_orderdate!="1970-01-01")?date('d-m-Y',strtotime($ulist->ccit_orderdate)):'')
                    ->setCellValue('K' . $i, $ulist->ccit_ip_number)
                    ->setCellValue('L' . $i, $ulist->ccit_brand_name)
                    ->setCellValue('M' . $i, $ulist->ccit_vendor_modelno)
                    ->setCellValue('N' . $i, $ulist->ccit_cust_desc)
                    ->setCellValue('O' . $i, ($ulist->ccit_ship_date!="0000-00-00" && $ulist->ccit_ship_date!="1970-01-01")?date('d-m-Y H:i A',strtotime($ulist->ccit_ship_date)):'')
                    ->setCellValue('P' . $i, $ulist->ccit_ship_qnty)
                    ->setCellValue('Q' . $i, date('d-m-Y',strtotime($ulist->case_received_date)))
                    ->setCellValue('R' . $i, date('H:i A',strtotime($ulist->case_received_time)))
                    ->setCellValue('S' . $i, date('d-m-Y',strtotime($ulist->case_created_date)))
                    ->setCellValue('T' . $i, date('h:i A',strtotime($ulist->case_created_date)))
                    ->setCellValue('U' . $i, $ulist->cit_caller_name)
                    ->setCellValue('V' . $i, $ulist->cit_callernum)
                    ->setCellValue('W' . $i, $ulist->cit_call_times)
                    ->setCellValue('X' . $i, $this->SchannelModel->getSalesChannelList(' WHERE schannel_id_pk='.$ulist->schannel_id_fk)[0]->scn_name)
                    ->setCellValue('Y' . $i, $this->Prdc_catModel->getProductCategoryList(' WHERE prdc_cat_id_pk='.$ulist->prdc_cat_id_fk)[0]->prdc_cat_name)
                    ->setCellValue('Z' . $i, $this->Tp_Model->getTouchPointList(' WHERE tp_id_pk='.$ulist->tp_id_fk)[0]->tp_name)
                    ->setCellValue('AA' . $i, $this->Case_nature_Model->getCaseNatureList(' WHERE cn_id_pk='.$ulist->cn_id_fk)[0]->cn_name)
                    ->setCellValue('AB' . $i, $this->Ct_Model->getCaseTopicList(' WHERE ct_id_pk='.$ulist->ct_id_fk)[0]->ct_name)
                    ->setCellValue('AC' . $i, $this->Prblm_Model->getIssueList(' WHERE prblm_id_pk='.$ulist->prblm_id_fk)[0]->prblm_name)
                    ->setCellValue('AD' . $i, ($ulist->cit_id_fk=='1')?'Internal':'External')
                    ->setCellValue('AE' . $i, ($ulist->rc_id_fk!=0)?$this->Rc_Model->getRootCauseList(' WHERE rc_id_pk='.$ulist->rc_id_fk)[0]->rc_name:'')
                    ->setCellValue('AF' . $i, ($ulist->orc_id_fk!=0)?$this->Orc_Model->getOwnerRCList(' WHERE orc_id_pk='.$ulist->orc_id_fk)[0]->orc_name:'')
                    ->setCellValue('AG' . $i, ($ulist->con_id_fk!=0)?$this->Con_Model->getContractorList(' WHERE con_id_pk='.$ulist->con_id_fk)[0]->con_name:'')
                    ->setCellValue('AH' . $i, $ulist->cit_remarks)
                    ->setCellValue('AI' . $i, $ulist->status_name)
                    ->setCellValue('AJ' . $i, $ulist->cat_transfer_to)
                    ->setCellValue('AK' . $i, $ulist->cat_action_msg)
                    ->setCellValue('AL' . $i, ($ulist->cat_action_duedate!="0000-00-00" && $ulist->cat_action_duedate!="1970-01-01")?date('d-m-Y',strtotime($ulist->cat_action_duedate)):'')
                    ->setCellValue('AM' . $i, ($ulist->cat_closuredate!="0000-00-00" && $ulist->cat_closuredate!="1970-01-01")?date('d-m-Y',strtotime($ulist->cat_closuredate)):'')
                    ->setCellValue('AN' . $i, date('h:i A',strtotime($ulist->cat_closuretime)))
                    ->setCellValue('AO' . $i, $ulist->cct_staff_num)
                    ->setCellValue('AP' . $i, $ulist->cct_staff_name)
                    ->setCellValue('AQ' . $i, $ulist->cct_staff_dept)
                    ->setCellValue('AR' . $i, $ulist->cct_staff_store)
                    ->setCellValue('AS' . $i, @$compliment_for[$ulist->cct_for])
                    ->setCellValue('AT' . $i, @$compliment_type[$ulist->cct_type])
                    ->setCellValue('AU' . $i, $ulist->cct_remarks)
                    ->setCellValue('AV' . $i, $ulist->cet_exercised)
                    ->setCellValue('AW' . $i, $ulist->cet_amount);

            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('CALL LOGS');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

		$file_name = 'CALL_LOGS_'.date('dmy_hi').'.xls';
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
    
//    function exportPDF() {
//        $this->load->library('cezpdf');
//        $this->load->helper('pdf');
//        $total_rows = $this->EnquiryModel->getTotalEnquiry($this->session->userdata('enquiry_srchset'));
//        $enquiry_list = $this->EnquiryModel->getEnquiryList($this->session->userdata('enquiry_srchset'),'enquiry_id_pk','asc',0,$total_rows);
//        prep_pdf(); // creates the footer for the document we are creating.
//
//        foreach ($enquiry_list as $ulist) {
//		$tel = '';
//		if(!empty($ulist->cust_mobile)){
//			$tel = $ulist->cust_mobile;
//		}
//		if(!empty($ulist->cust_hometel)){
//			$tel .= '/'.$ulist->cust_hometel;
//		}
//		if(!empty($ulist->cust_offtel)){
//			$tel .= '/'.$ulist->cust_offtel;
//		}
//            $db_data[] = array('p_name' => $ulist->cust_name,
//                'tel' => $tel,
//                'email' => $ulist->cust_email,
//                'enquiry_type' => $ulist->type_name,
//				'enquiry' => $ulist->enquiry_msg,
//				'enquiry_date' => date('d-m-Y H:i A',strtotime($ulist->enquiry_date))
//            );
//        }
//
//        $col_names = array(
//            'p_name' => 'Name',
//            'tel' => 'Tel.',
//			'email' => 'Email',
//			'enquiry_type' => 'Enquiry Type',
//			'enquiry' => 'Enquiry',
//            'enquiry_date'=> 'Date'
//        );
//
//        $this->cezpdf->ezTable($db_data, $col_names, 'Enquiries', array('width' => 580));
//        $this->cezpdf->ezStream();
//    }

    function showRows() {
        $this->session->set_userdata('enquiry_rows', $this->input->post('txtrows'));
        $this->index($this->session->userdata('enquiry_sortfld'), $this->session->userdata('enquiry_sortorder'));
        
    }
        public function save() {
         
        $session = $this->session->userdata('user_id');
        //echo '<pre>';
        //var_dump($_POST); exit;
        $id = ($this->input->post('id'));
		$this->data['case_number'] = $this->input->post('txtcase_number');
	$this->data['case_received'] = $this->input->post('txtrecvd_date');
        $this->data['case_received_time'] =$this->input->post('txtrecvd_time');
        $this->data['ccit_cust_name']= trim($this->input->post('txtcustname'));
	$this->data['ccit_cust_account']= trim($this->input->post('txtcustacc'));
	$this->data['ccit_custnric'] = trim($this->input->post('txtcustnric'));
	$this->data['ccit_mobile'] = ($this->input->post('txtcustmobile'));
	$this->data['ccit_del_address'] = trim($this->input->post('txtcustaddress'));
        $this->data['ccit_orderdate'] = trim($this->input->post('txtorderdate'));
        $this->data['ccit_ip_number'] = ($this->input->post('txtcustipnum'));
        $this->data['ccit_brand_name'] = ($this->input->post('txtbrandcode'));
        $this->data['ccit_vendor_modelno'] = trim($this->input->post('txtmodelno'));
	$this->data['ccit_cust_desc'] = trim($this->input->post('txtcustdesc'));
       	$this->data['ccit_ship_date'] = $this->input->post('txtshipdate');
        $this->data['ccit_ship_qnty'] = $this->input->post('txtshipqnty');
        $this->data['cit_caller_name'] = $this->input->post('txtcallername');
        $this->data['cit_callernum'] = $this->input->post('txtcallernum');
        $this->data['cit_call_times'] = $this->input->post('txtcalltimes');
        $this->data['schannel_id_fk'] = $this->input->post('selsaleschannel');
        $this->data['prdc_cat_id_fk'] = $this->input->post('selprodcat');
        $this->data['tp_id_fk'] = $this->input->post('seltouchpoint');
        $this->data['cn_id_fk'] = $this->input->post('selcasenature');
         $this->data['ct_id_fk'] = $this->input->post('selcasetopic');
         $this->data['prblm_id_fk'] = $this->input->post('selcaseissue');
         $this->data['cit_id_fk'] = $this->input->post('selintext');
         $this->data['rc_id_fk'] = $this->input->post('selrootcause');
         $this->data['orc_id_fk'] = $this->input->post('selown_rootcause');
         $this->data['con_id_fk'] = $this->input->post('selsupplier');
         $this->data['cit_remarks'] = $this->input->post('cit_remarks');
         $this->data['status_id_fk'] = $this->input->post('selstatus');
         $this->data['cat_transfer_to'] = $this->input->post('txtcase_to');
         $this->data['cat_action_msg'] = $this->input->post('txtaction_msg');
         $this->data['cat_action_duedate'] = $this->input->post('txtaction_duedate');
         $this->data['cat_closuredate'] = $this->input->post('txtclosuredate');
         $this->data['cat_closuretime'] = $this->input->post('txtclosuretime');
         $this->data['cct_staff_num'] = $this->input->post('txtstaffnum');
         $this->data['cct_staff_name'] = $this->input->post('txtstaffname');
         $this->data['cct_staff_dept'] = $this->input->post('txtstaffdept');
         $this->data['cct_staff_store'] = $this->input->post('txtstaffstore');
         $this->data['cct_for'] = $this->input->post('selcomp_for');
         $this->data['cct_remarks'] = $this->input->post('txtfinal_remarks');
         $this->data['cet_exercised'] = $this->input->post('txtemp_exer');
         $this->data['cet_amount'] = $this->input->post('txtemp_amount');
     
     
        $this->data['error'] = '';
       
        if (empty($this->data['ccit_cust_account'])) {
            $this->data['error'] .= 'Customer account can not be blanked<br/>';
        }
        
		if (empty($this->data['ccit_custnric'])) {
            $this->data['error'] .= 'Customer NRIC can not be blanked<br/>';
        }
		
        if (empty($this->data['ccit_mobile'])) {
            $this->data['error'] .= 'Customer mobile can not be blanked<br/>';
        }
        
        if (empty($this->data['ccit_cust_desc'])) {
            $this->data['error'] .= 'Description message can not be blanked<br/>';
        }
       
        if (empty($this->data['error'])) {
           
            $cust_info = array('ccit_cust_name'=>$this->data['ccit_cust_name'],
                        'ccit_cust_account'=>$this->data['ccit_cust_account'],
                        'ccit_custnric'=>$this->data['ccit_custnric'],
                        'ccit_mobile'=>$this->data['ccit_mobile'],
                        'ccit_del_address'=>$this->data['ccit_del_address'],
                        'ccit_orderdate'=>date('Y-m-d',strtotime($this->data['ccit_orderdate'])),
                        'ccit_ip_number'=>$this->data['ccit_ip_number'],
                        'ccit_brand_name'=>$this->data['ccit_brand_name'],
                        'ccit_vendor_modelno'=>$this->data['ccit_vendor_modelno'],
                        'ccit_cust_desc'=>$this->data['ccit_cust_desc'],
                        'ccit_ship_date'=>date('Y-m-d',strtotime($this->data['ccit_ship_date'])),
                        'ccit_ship_qnty'=>$this->data['ccit_ship_qnty']);
            
            $case_info = array('cit_caller_name'=>$this->data['cit_caller_name'],
                        'cit_callernum'=>$this->data['cit_callernum'],
                        'cit_call_times'=>$this->data['cit_call_times'],
                        'schannel_id_fk'=>$this->data['schannel_id_fk'],
                        'prdc_cat_id_fk'=>$this->data['prdc_cat_id_fk'],
                        'tp_id_fk'=>$this->data['tp_id_fk'],
                        'cn_id_fk'=>$this->data['cn_id_fk'],
                        'ct_id_fk'=>$this->data['ct_id_fk'],
                        'prblm_id_fk'=>$this->data['prblm_id_fk'],
                        'cit_id_fk'=>$this->data['cit_id_fk'],
                        'rc_id_fk'=>$this->data['rc_id_fk'],
                        'orc_id_fk'=>$this->data['orc_id_fk'],
                        'con_id_fk'=>$this->data['con_id_fk'],
                        'cit_remarks'=>$this->data['cit_remarks']);
            
             $assign_info = array('cat_transfer_to'=>$this->data['cat_transfer_to'],
                        'cat_action_msg'=>$this->data['cat_action_msg'],
                        'cat_action_duedate'=>date('Y-m-d',strtotime($this->data['cat_action_duedate'])),
                        'cat_closuredate'=>date('Y-m-d',strtotime($this->data['cat_closuredate'])),
                        'cat_closuretime'=>date('H:i',strtotime($this->data['cat_closuretime'])),
                        'status_id_fk'=>$this->data['status_id_fk']);
             
             $compliment_info = array('cct_staff_num'=>$this->data['cct_staff_num'],
                        'cct_staff_name'=>$this->data['cct_staff_name'],
                        'cct_staff_dept'=>$this->data['cct_staff_dept'],
                        'cct_staff_store'=>$this->data['cct_staff_store'],
                        'cct_for'=>$this->data['cct_for'],
                        'cct_remarks'=>$this->data['cct_remarks']);
             
             $empowerment_info = array('cet_exercised'=>$this->data['cet_exercised'],
                        'cet_amount'=>$this->data['cet_amount']);
             
            if (empty($id)) {
                
                $this->data['case_number'] = random_string('numeric',6);
                $case_data = array('case_number'=>$this->data['case_number'],
                    'case_received_date'=>date('Y-m-d H:i:s',strtotime($this->data['case_received'])),
                    'case_received_time'=>date('H:i:s',strtotime($this->data['case_received_time'])),
                    'case_created_date'=>date('Y-m-d H:i:s'),
                    'case_created_by'=>$session['id']);
                
                $caseId = $this->Common_Model->insert_table('case_mst',$case_data);
                if($caseId) {
                    //***************** Add in Customer Information ***********//
                    $cust_info += array('case_id_fk'=>$caseId);
                    $this->Common_Model->insert_table('case_cust_info_txn',$cust_info);
                    
                   //***************** Add in Case Information ***********//
                    $case_info += array('case_id_fk'=>$caseId);
                    $this->Common_Model->insert_table('case_info_txn',$case_info);
                   
                   //***************** Add in Case Assignment ***********//  
                    $assign_info += array('case_id_fk'=>$caseId);
                    $this->Common_Model->insert_table('case_assignment_txn',$assign_info);
                    
                   //***************** Add in Case Compliments ***********//  
                    $compliment_info += array('case_id_fk'=>$caseId);
                    $this->Common_Model->insert_table('case_compliment_txn',$compliment_info);
                    
                  //***************** Add in Case Empowement Info ***********//    
                    $empowerment_info += array('case_id_fk'=>$caseId);
                    $this->Common_Model->insert_table('case_empowerment_txn',$empowerment_info);
                   //***************** Call Navision API to integrate comments ***********// 
                    $data_array =  array(
                            "Comment"=> $this->data['cit_remarks'],
                            "DocumentNo"=>$this->data['ccit_cust_account']);
                    $result_api = $this->call_me_now($data_array);
                    //echo '<pre>';
                    //var_dump($result_api);
                    //exit;
                    $this->data['message'] = "Case has been logged successfully!..";
                }
            } else {
                 $case_data = array('case_modified_date'=>date('Y-m-d H:i'),'case_modified_by'=>$session['id']);
                 
                 $this->Common_Model->update_table('case_mst',$case_data, array('case_id_pk' => $id));
                 $this->Common_Model->update_table('case_cust_info_txn',$cust_info, array('case_id_fk' => $id));
                 $this->Common_Model->update_table('case_info_txn',$case_info, array('case_id_fk' => $id));
                 $this->Common_Model->update_table('case_assignment_txn',$assign_info, array('case_id_fk' => $id));
                 $this->Common_Model->update_table('case_compliment_txn',$compliment_info, array('case_id_fk' => $id));
                 $this->Common_Model->update_table('case_empowerment_txn',$empowerment_info, array('case_id_fk' => $id));
                 $this->data['message'] = "Case has been updated Successfully!..";
                
            }
            $this->index();
        } else {
            $this->add($id);
        }
    }
 	
    function  delete($id){
            $this->Common_Model->delete_table('case_empowerment_txn','case_id_fk',$id);
            $this->Common_Model->delete_table('case_compliment_txn','case_id_fk',$id);
            $this->Common_Model->delete_table('case_assignment_txn','case_id_fk',$id);
            $this->Common_Model->delete_table('case_info_txn','case_id_fk',$id);
            $this->Common_Model->delete_table('case_cust_info_txn','case_id_fk',$id);
            $this->Common_Model->delete_table('case_mst','case_id_pk',$id);
            
            $this->data['message'] = "Case is removed successfully!..";
       	    $this->index();
    }
  
  function call_me_now($api_data){
      
      $user = 'PTC0001';
      $url = 'http://203.127.31.170:8081/CustomerService_WS/CustService.svc/InsertComments?User='.$user;
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_POST, 1);
      if ($api_data) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($api_data));
      }
        curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
      ));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      // EXECUTE:
      $result = curl_exec($curl);
      if($errno = curl_errno($curl)) {
      $error_message = curl_strerror($errno);
      echo "cURL error ({$errno}):\n {$error_message}";
    }
      if(!$result){die("Connection Failure");}
      curl_close($curl);
      return $result;
      
    }
}