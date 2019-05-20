<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EnquiryModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getEnquiryList($where='', $sortfield='case_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select `case_id_pk`, `case_number`, `case_created_date`, `case_created_by`, `case_modified_date`, `case_modified_by`,'
                . '`cit_id_pk`,`cit_caller_name`, `cit_callernum`, `cit_call_times`, `schannel_id_fk`, `prdc_cat_id_fk`, `tp_id_fk`, `cn_id_fk`, `ct_id_fk`, `prblm_id_fk`, `cit_id_fk`, `rc_id_fk`, `orc_id_fk`, `con_id_fk`, `cit_remarks`, '
                . '`ccit_id_pk`,`ccit_cust_name`, `ccit_cust_account`, `ccit_custnric`, `ccit_mobile`, `ccit_del_address`, `ccit_orderdate`, `ccit_ip_number`, `ccit_brand_name`, `ccit_vendor_modelno`, `ccit_cust_desc`, `ccit_ship_date`, `ccit_ship_qnty`,'
                . '`cat_id_pk`,`cat_transfer_to`, `cat_action_msg`, `cat_action_duedate`, `cat_closuredate`, `cat_closuretime`, `status_id_fk`,'
                . '`cct_id_pk`,`cct_staff_num`, `cct_staff_name`, `cct_staff_dept`, `cct_staff_store`, `cct_for`, `cct_type`, `cct_remarks`,'
                . '`cet_id_pk`,`cet_exercised`, `cet_amount`,status_name,staff_name,case_received_date,case_received_time '
                . ' FROM `case_mst` '
                . 'inner join `case_info_txn` cit ON cit.case_id_fk = case_id_pk '
                . 'inner join `case_cust_info_txn` ccit ON ccit.case_id_fk = case_id_pk '
                . 'left join `case_assignment_txn` cat ON cat.case_id_fk = case_id_pk '
                . 'left join `case_compliment_txn` cct ON cct.case_id_fk = case_id_pk '
                . 'left join `case_empowerment_txn` cet ON cet.case_id_fk = case_id_pk '
                . 'left join `case_status_mst`  ON status_id_fk = status_id_pk '
                . 'inner join `staff_mst` ON staff_id_pk = case_created_by ';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

    
    function delEnquiry($id) {
        $this->db->where('case_id_pk', $id);
        return $this->db->delete('case_mst');
    }

    function getTotalEnquiry($where) {
        $query = $this->db->query('select count(case_id_pk) as cnt from case_mst inner join `case_info_txn` cit ON cit.case_id_fk = case_id_pk '
                . 'inner join `case_cust_info_txn` ccit ON ccit.case_id_fk = case_id_pk '
                . 'left join `case_assignment_txn` cat ON cat.case_id_fk = case_id_pk '
                . 'left join `case_compliment_txn` cct ON cct.case_id_fk = case_id_pk '
                . 'left join `case_empowerment_txn` cet ON cet.case_id_fk = case_id_pk '
                . 'inner join `staff_mst` ON staff_id_pk = case_created_by '.$where . ' order by case_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

    function insert_table($table,$info=NULL){
       $this->db->insert($table, $info);
       return $this->db->insert_id(); 
    }
    
    function update_table($table,$info,$id){
       return $this->db->update($table, $info, $id);
        
    }
    
    function delete_table($table,$key,$val){
       $this->db->where($key, $val);
       return $this->db->delete($table);
    }
   
   

}

?>
