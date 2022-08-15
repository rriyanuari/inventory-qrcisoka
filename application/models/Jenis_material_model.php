<?php

  class Jenis_material_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('jenis_material');
          return $query;
      }

      public function by($collumn, $data){
        $query = $this->db  ->select('*')
                            ->from('jenis_material')
                            ->where($collumn, $data);
        $query = $this->db->get(); 
        return $query;
      }

      public function tambah($data){
        $query = $this->db->insert('jenis_material', $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('jenis_material', array('id' => $id));
        return $query;
      }

      public function update_by_id($where, $data, $table){
        $query =    $this->db->where($where)
                            ->update($table, $data);
        return $query;
      }	
    }