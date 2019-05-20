<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Prblm_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getIssueList($where='', $sortfield='prblm_id_pk', $order='asc', $startindex='0', $endindex='100') {

        $str = 'select `prblm_id_pk`, `prblm_name`, `prblm_date`, p.staff_id_fk,ct_id_fk, staff_name,ct_name,is_complaint FROM `prblm_mst` p '
                . 'left join `staff_mst` ON staff_id_pk = p.staff_id_fk'
                . ' left join case_topic_mst ON ct_id_pk = ct_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
           $query = $this->db->query($str);
        }
        //echo $str;exit;
        return $query->result();
    }

      function getIssues($where) {
        //echo 'select count(prblm_id_pk) as cnt from prblm_mst left join case_topic_mst ON ct_id_pk = ct_id_fk ' . $where . ' order by prblm_id_pk asc'; exit;
        $query = $this->db->query('select count(prblm_id_pk) as cnt from prblm_mst left join case_topic_mst ON ct_id_pk = ct_id_fk ' . $where . ' order by prblm_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

   function getIssuesFrmTopic($id,$complaint=0){
        $str = 'select `prblm_id_pk`, `prblm_name` FROM `prblm_mst` where is_complaint="'.$complaint.'" and ct_id_fk='.$id;
        //echo $str; exit;
        $query = $this->db->query($str);
       return $res = $query->result();
                 
   }	

}

?>
