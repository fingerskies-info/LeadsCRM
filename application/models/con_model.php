<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Con_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getContractorList($where='', $sortfield='con_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select `con_id_pk`, `con_name`, `con_date`, `staff_id_fk`, staff_name FROM `contractor_mst`  left join `staff_mst` ON staff_id_pk = staff_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

 

    function getContractor($where) {
        $query = $this->db->query('select count(con_id_pk) as cnt from contractor_mst ' . $where . ' order by con_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

	

}

?>
