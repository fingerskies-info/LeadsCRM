<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Common_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function insert_table($table,$info=NULL){
       $this->db->insert($table, $info);
       return $this->db->insert_id(); 
    }
    
    function update_table($table,$info,$id){
       return $this->db->update($table, $info, $id);
        
    }
    
    function delete_table($table,$key,$val){
       $this->db->where($key, $val);
       return $this->db->delete($table);
    }
   
   function select_table($table,$where=NULL){
       
       $str = 'select * from '.$table;
       if($where != NULL){
           $str .=' where '.$where;
       }
       $query = $this->db->query($str);
       return $query->result();
   }

}

?>
