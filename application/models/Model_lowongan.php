<?php

  class Model_lowongan extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('lowongan');
          return $query;
      }

      public function by_id($id){
        $query = $this->db  ->select('*')
                            ->where('id', $id)
                            ->get('lowongan');
        return $query;
      }

      public function tambah($data, $table){
        $query = $this->db->insert($table, $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('lowongan', array('id' => $id));
        return $query;
      }

      public function update_by_id($where,$data,$table){
        $query =    $this->db->where($where)
                            ->update($table,$data);
        return $query;
      }	
    }