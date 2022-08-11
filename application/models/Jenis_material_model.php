<?php

  class Jenis_material_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('jenis_material');
          return $query;
      }

      public function by($collumn, $id){
        $query = $this->db  ->select('*')
                            ->from('lamaran a')
                            ->join('lowongan b', 'a.id_lowongan=b.id', 'left')
                            ->where($collumn, $id);
        $query = $this->db->get(); 
        return $query;
      }

      public function tambah($data, $table){
        $query = $this->db->insert($table, $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('lamaran', array('id' => $id));
        return $query;
      }

      public function update_by_id($where, $data, $table){
        $query =    $this->db->where($where)
                            ->update($table, $data);
        return $query;
      }	
    }