<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Case_nature_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getCaseNatureList($where='', $sortfield='cn_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select `cn_id_pk`, `cn_name`, `cn_date`, `staff_id_fk`, staff_name FROM `case_nature_mst`  left join `staff_mst` ON staff_id_pk = staff_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

   
    function getCaseNature($where) {
        $query = $this->db->query('select count(cn_id_pk) as cnt from case_nature_mst ' . $where . ' order by cn_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

	

}

?>
