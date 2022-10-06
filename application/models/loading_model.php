<?php

  class loading_model extends CI_Model {

      public function semua(){
        $query = $this->db  ->select('b.id, a.id_material, b.type, b.tgl_valid, 
                                      a.total_qty_awal, a.qty_loading, a.total_qty_akhir')
                            ->from('loading_detail a')
                            ->join('loading b', 'a.id_loading = b.id')
                            ->order_by('b.tgl_valid', 'DESC');
        $query = $this->db->get(); 
        return $query;
      }

      public function last_id(){
        $query = $this->db  ->select('id')
                            ->order_by("id", "desc")
                            ->get('loading');
        return $query;
      }

      public function by_satuan($where){
        $query = $this->db  ->select('*')
                            ->from('loading')
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function by($where){
        $query = $this->db  ->select('DISTINCT(loading.id), loading.type, loading.tgl_permintaan,
                                    loading_detail.id_material, loading_detail.qty_loading')
                            ->from('loading')
                            ->join('loading_detail', 'loading_detail.id_loading = loading.id')
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function permintaan_validasi($type){
        $query = $this->db  ->select('a.id, a.type, b.id_material, b.qty_loading, a.tgl_permintaan')
                            ->from('loading a')
                            ->join('loading_detail b', 'b.id_loading = a.id')
                            ->where('a.is_valid', 0)
                            ->where('a.type', $type);
        $query = $this->db->get(); 
        return $query;
      }

      public function laporan_bulanan($id, $periode){
        $query = $this->db  ->select('b.id, a.id_material, b.type, b.tgl_valid, 
                                      a.total_qty_awal, a.qty_loading, a.total_qty_akhir')
                            ->from('loading_detail a')
                            ->join('loading b', 'a.id_loading = b.id')
                            ->where('a.id_material', $id)  
                            ->where("DATE_FORMAT(b.tgl_valid,'%Y-%m')", $periode);
        $query = $this->db->get(); 
        return $query;
      }

      public function laporan_tahunan($id){
        $query = $this->db  ->select('b.id, a.id_material, b.type, b.tgl_valid, 
                                      a.total_qty_awal, a.qty_loading, a.total_qty_akhir')
                            ->from('loading_detail a')
                            ->join('loading b', 'a.id_loading = b.id')
                            ->where('a.id_material = ' . $id);
        $query = $this->db->get(); 
        return $query;
      }

      public function tambah($data){
        $query = $this->db->insert('loading', $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('loading', array('id' => $id));
        return $query;
      }

      public function update_by($where, $data){
        $query =    $this->db->where($where)
                            ->update('loading', $data);
        return $query;
      }
    }