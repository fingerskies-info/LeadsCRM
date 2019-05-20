<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SchannelModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getSalesChannelList($where='', $sortfield='schannel_id_pk', $order='asc', $startindex='0', $endindex='10') {

        $str = 'select `schannel_id_pk`, `scn_name`, `scn_date`, `staff_id_fk` FROM `sales_channel_mst`  inner join `staff_mst` ON staff_id_pk = staff_id_fk';
        if ($where != '') {
            $str.=$where . ' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        } else {
            $str.=' order by ' . $sortfield . ' ' . $order . ' limit ' . $startindex . ',' . $endindex;
            $query = $this->db->query($str);
        }
        return $query->result();
    }

    function getTotalSalesChannel($where) {
        $query = $this->db->query('select count(schannel_id_pk) as cnt from sales_channel_mst ' . $where . ' order by schannel_id_pk asc');
        $res = $query->result();
        return $res[0]->cnt;
    }

	

}

?>
