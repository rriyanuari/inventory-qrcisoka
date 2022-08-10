<?php

  class Model_lamaran extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('lamaran');
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

      public function join_pelamar_lowongan(){
        $query = $this->db  ->select('*')
                            ->from('lamaran a')
                            ->join('lowongan b', 'a.id_lowongan=b.id', 'left')
                            ->join('pelamar c', 'a.id_pelamar=c.id', 'left');
        $query = $this->db->get(); 
        return $query;
      }

      public function laporan_by_tanggal($tanggal1, $tanggal2){
        $query = $this->db  ->select('*')
                            ->from('lamaran a')
                            ->join('lowongan b', 'a.id_lowongan=b.id', 'left')
                            ->join('pelamar c', 'a.id_pelamar=c.id', 'left')
                            ->where('a.tgl_lamaran >=', $tanggal1)
                            ->where('a.tgl_lamaran <=', $tanggal2);
        $query = $this->db->get(); 
        return $query;
      }

      public function check_by($id_pelamar, $id_lowongan){
        $query = $this->db  ->select('*')
                            ->where('id_pelamar', $id_pelamar)
                            ->where('id_lowongan', $id_lowongan)
                            ->get('lamaran');
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