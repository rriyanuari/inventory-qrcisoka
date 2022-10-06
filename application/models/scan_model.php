<?php

  class scan_model extends CI_Model {

      public function semua(){
          $query = $this->db  ->select('*')
                              ->get('scan');
          return $query;
      }

      public function by($where){
        $query = $this->db  ->select('*')
                            ->from('scan')
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function where_group_by($where, $group_by){
        $query = $this->db  ->select('id_jenis_material, id_material, COUNT(`'.$group_by.'`) AS qty')
                            ->from('scan a')
                            ->join('material b', 'a. id_material = b.id', 'left')
                            ->group_by($group_by)
                            ->where($where);
        $query = $this->db->get(); 
        return $query;
      }

      public function tambah($data){
        $query = $this->db->insert('scan', $data);
        return $query;
      }

      public function hapus_by_id($id){
        $query = $this->db->delete('scan', array('id' => $id));
        return $query;
      }

      public function update_by_id($where, $data){
        $query =    $this->db->where($where)
                            ->update('scan', $data);
        return $query;
      }	

      public function by_and_join($where){
        $query = $this->db  ->select('scan.id, scan.id_material, scan.no_qr,
                                      jenis_material.nama, jenis_material.satuan,
                                      COUNT(jenis_material.nama) AS qty')
                            ->from('scan')
                            ->join('material', 'scan.id_material = material.id')
                            ->join('jenis_material', 'material.id_jenis_material = jenis_material.id')
                            ->where($where)
                            ->group_by("scan.id_material");
        $query = $this->db->get(); 
        return $query;
      }
    }