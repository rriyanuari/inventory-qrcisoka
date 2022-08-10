<?php

    class Model_user extends CI_Model {

        public function semua(){
            $query = $this->db  ->select('*')
                                ->get('t_user');
            return $query;
        }

        public function by($id_user){
            $query = $this->db  ->select('*')
                                ->from('t_user a')
                                ->join('pelamar b', 'a.id_user = b.id_user', 'left')
                                ->where('a.id_user', $id_user);
            $query = $this->db->get(); 
            return $query;
        }
    
        public function by_id($id){
            $query = $this->db  ->select('*')
                                ->where('id_user', $id)
                                ->get('t_user');
            return $query;
        }
        
        public function tambah($data, $table){
            $query = $this->db->insert($table, $data);
            if($query){
            return TRUE;
            }
        }

        public function hapus_by_id($id){
            $query = $this->db->delete('t_user', array('id_user' => $id));
            return $query;
        }

        public function update_by_id($where,$data,$table){
            $query =    $this->db->where($where)
                                ->update($table,$data);
            return $query;
        }	
    }