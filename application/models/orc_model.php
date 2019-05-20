<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Orc_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getOwnerRCList($where='', $sortfield='orc_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select orc_id_pk,`cat_id_fk`, `orc_name`, `orc_date`, staff_id_fk,staff_name FROM `owner_rc_mst` r '
                . 'left join `staff_mst` ON staff_id_pk = r.staff_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
           $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
           $query = $this->db->query($str);
        }
       // echo $str; exit;
        return $query->result();
    }

 

    function getOwnerRC($where) {
        //echo 'select count(prblm_id_pk) as cnt from prblm_mst left join case_topic_mst ON ct_id_pk = ct_id_fk ' . $where . ' order by prblm_id_pk asc'; exit;
        $query = $this->db->query('select count(orc_id_pk) as cnt from owner_rc_mst ' . $where . ' order by orc_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

	

}

?>
