<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class StaffModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getStaffList($where='', $sortfield='staff_name', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select `staff_id_pk`, `staff_name`, `staff_mobile`, `staff_email`, `staff_uname`, `staff_pwd`, `staff_ext`, `staff_prefix`, `staff_suffix`, `staff_role`, `staff_active` from staff_mst';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

    function addStaff($staff=NULL) {
        $this->db->insert('staff_mst', $staff);
        return $this->db->insert_id();
    }

    function updateStaff($staff, $id) {
        return $this->db->update('staff_mst', $staff, $id);
    }

    function delStaff($id) {
        $this->db->where('staff_id_pk', $id);
        return $this->db->delete('staff_mst');
    }

    function getTotalStaff($where) {
        $query = $this->db->query('select count(staff_id_pk) as cnt from staff_mst ' . $where . ' order by staff_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

       
   function StaffUsernameExists($uname,$id=null){

		$str = 'select count(staff_id_pk) as cnt from staff_mst where staff_uname="'.$uname.'" ';

		if(!empty($id)){
			$str .=' and staff_id_pk != ' . $id;
		}	
		
		$query = $this->db->query($str);
        $res = $query->result();

        if($res[0]->cnt>0){
            return true;
        }else{
            return false;
        }
	}
}

?>
