<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Rc_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getRootCauseList($where='', $sortfield='rc_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select rc_id_pk,`prblm_id_fk`, `rc_name`, `rc_date`, r.staff_id_fk,r.ct_id_fk, staff_name,ct_name FROM `root_cause_mst` r '
                . 'left join `staff_mst` ON staff_id_pk = r.staff_id_fk'
                . ' left join case_topic_mst ON ct_id_pk = ct_id_fk'
                . ' left join prblm_mst ON prblm_id_pk = prblm_id_fk';
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

   
    function getRootCause($where) {
        //echo 'select count(prblm_id_pk) as cnt from prblm_mst left join case_topic_mst ON ct_id_pk = ct_id_fk ' . $where . ' order by prblm_id_pk asc'; exit;
        $query = $this->db->query('select count(rc_id_pk) as cnt from root_cause_mst '
                . 'left join case_topic_mst ON ct_id_pk = ct_id_fk ' . $where . ' order by rc_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }
    
    function getIssueRootCause($id){
        $str = 'select `rc_id_pk`, `rc_name` FROM `root_cause_mst` where prblm_id_fk='.$id;
        //echo $str; exit;
        $query = $this->db->query($str);
       return $res = $query->result();
                 
   }	

}

?>
