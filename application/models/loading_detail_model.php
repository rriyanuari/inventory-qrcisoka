<?php

  class loading_detail_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('loading_detail');
          return $query;
      }

      public function last_id(){
        $query = $this->db  ->select('id')
                            ->order_by("id", "desc")
                            ->get('loading_detail');
        return $query;
    }

      public function by($where){
        $query = $this->db  ->select('*')
                            ->from('loading_detail')
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function tambah($data){
        $query = $this->db->insert('loading_detail', $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('loading_detail', array('id' => $id));
        return $query;
      }

      public function update_by($where, $data){
        $query =    $this->db->where($where)
                            ->update('loading_detail', $data);
        return $query;
      }
    }