<?php

  class Material_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('a.id, a.id_jenis_material, a.qty, a.status, a.valid, a.tgl_kadaluarsa, a.tgl_valid, a.tgl_permintaan, a.last_update,
                                        b.nama, b.satuan')
                              ->from('material a')
                              ->join('jenis_material b', 'a.id_jenis_material = b.id');
          $query = $this->db->get(); 
          return $query;
      }

      public function by($where){
        $query = $this->db  ->select('a.id, a.id_jenis_material, a.qty, a.status, a.valid, a.tgl_kadaluarsa, a.tgl_valid, a.tgl_permintaan, a.last_update,
                                    b.nama, b.satuan')
                            ->from('material a')
                            ->join('jenis_material b', 'a.id_jenis_material = b.id')
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

      public function update_by($where, $data){
        $query =    $this->db->where($where)
                            ->update('material a', $data);
        return $query;
      }	
    }