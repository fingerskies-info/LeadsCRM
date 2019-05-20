<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class  UserModel extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    function getUserList($where,$sortfield='user_id_pk',$order='desc',$startindex='0',$endindex='10'){
       
       $query= $this->db->query('select user_id_pk,user_name,user_password from user_mst '.$where.' order by '.$sortfield.' '.$order.' limit '.$startindex.','.$endindex);
	return $query->result();			
    }
    
    
     function getTotalUser($where){
        $query= $this->db->query('select count(user_id_pk) as cnt from user_mst  inner join user_level_mst ul ON ul.level_id_pk = user_level '.$where.' order by user_id_pk asc');
	$res = $query->result();
        return $res[0]->cnt;
    }
    function get_s($num, $offset) {
    $this->db->select ('user_id_pk,user_name');  // field name
    $sql = $this->db->get('user_mst',$num, $offset); // table name
         return $sql->result();
    
    }
    
   function login($username, $password) {
        $this->db->select('staff_id_pk, staff_uname, staff_pwd,staff_mobile,staff_name,staff_role');
        $this->db->from('staff_mst');
        $this->db->where('staff_uname', $username);
        $this->db->where('staff_pwd', MD5($password));
		 $this->db->where('staff_active', '1');
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}

?>
