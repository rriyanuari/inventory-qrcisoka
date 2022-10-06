<?php

  class Permintaan_model extends CI_Model {

      public function tambah($data){
        $query = $this->db->insert('permintaan', $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('permintaan', array('id' => $id));
        return $query;
      }

      public function update_by($where, $data){
        $query =    $this->db->where($where)
                            ->update('permintaan', $data);
        return $query;
      }	

    }