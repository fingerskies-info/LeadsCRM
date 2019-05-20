<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Prdc_catModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getProductCategoryList($where='', $sortfield='prdc_cat_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select `prdc_cat_id_pk`, `prdc_cat_name`, `prdc_cat_date`, `staff_id_fk`, staff_name FROM `prdc_cat_mst`  left join `staff_mst` ON staff_id_pk = staff_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

  
    function getTotalProductCategory($where) {
        $query = $this->db->query('select count(prdc_cat_id_pk) as cnt from prdc_cat_mst ' . $where . ' order by prdc_cat_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

	

}

?>
