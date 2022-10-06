<?php

  class Material_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('a.id, a.id_jenis_material, a.qty, a.status, a.tgl_kadaluarsa, a.last_update,
                                        b.nama, b.satuan')
                              ->from('material a')
                              ->join('jenis_material b', 'a.id_jenis_material = b.id');
          $query = $this->db->get(); 
          return $query;
      }

      public function last_id(){
        $query = $this->db  ->select('id')
                            ->order_by("id", "desc")
                            ->get('material');
        return $query;
      }

      public function by($where){
        $query = $this->db  ->select('material.id, material.id_jenis_material, material.qty, material.tgl_kadaluarsa,
                                      jenis_material.nama, jenis_material.satuan')
                            ->from('material')
                            ->join('jenis_material', 'material.id_jenis_material = jenis_material.id')
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function permintaan_validasi($where){
        $query = $this->db  ->select('material.id, material.id_jenis_material, material.qty, material.tgl_kadaluarsa,
                                      jenis_material.nama, jenis_material.satuan, loading.tgl_valid')
                            ->from('material')
                            ->join('jenis_material', 'material.id_jenis_material = jenis_material.id')
                            ->join('loading_detail', 'material.id = loading_detail.id_material')
                            ->join('loading', 'loading_detail.id_loading = loading.id')
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

      public function loading_keluar($id, $qty){
        $query =    $this->db->query("call prosedur_loading_keluar($id, $qty)");
        return $query;
      }	
    }