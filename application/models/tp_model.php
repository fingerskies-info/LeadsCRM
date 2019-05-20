<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Tp_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getTouchPointList($where='', $sortfield='tp_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select `tp_id_pk`, `tp_name`, `tp_date`, `staff_id_fk`, staff_name FROM `touch_point_mst`  left join `staff_mst` ON staff_id_pk = staff_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

    function getTouchPoint($where) {
        $query = $this->db->query('select count(tp_id_pk) as cnt from touch_point_mst ' . $where . ' order by tp_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

	

}

?>
