<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ct_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getCaseTopicList($where='', $sortfield='ct_id_pk', $order='asc', $startindex='0', $endindex='100') {

        $str = 'select `ct_id_pk`, `ct_name`, `ct_date`, `staff_id_fk`, staff_name FROM `case_topic_mst`  left join `staff_mst` ON staff_id_pk = staff_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

  

    function getCaseTopic($where) {
        $query = $this->db->query('select count(ct_id_pk) as cnt from case_topic_mst ' . $where . ' order by ct_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

	

}

?>
