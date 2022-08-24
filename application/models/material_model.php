<?php

  class Material_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('material');
          return $query;
      }

      public function by($where){
        $query = $this->db  ->select('*')
                            ->from('material')
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function tambah($data){
        $query = $this->db->insert('material', $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('material', array('id' => $id));
        return $query;
      }

      public function update_by_id($where, $data){
        $query =    $this->db->where($where)
                            ->update('material', $data);
        return $query;
      }	
    }