<?php

  class Proyek_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('proyek');
          return $query;
      }

      public function by($where){
        $query = $this->db  ->select('*')
                            ->from('proyek')
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function tambah($data){
        $query = $this->db->insert('proyek', $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('proyek', array('id' => $id));
        return $query;
      }

      public function update_by_id($where, $data){
        $query =    $this->db->where($where)
                            ->update('proyek', $data);
        return $query;
      }	
    }