<?php

  class Model_auth extends CI_Model {

    public function getusername($username){
      $this->db->select("*");
      $this->db->from("t_user");
      $this->db->where("username", $username);
      $query = $this->db->get();
      return $query->row();
    }

    public function login($username, $password){
      $user = $this->getusername($username);
      if (!empty($user)) {
          if ($password == $user->password) {
              return $user;
          } else {
              return FALSE;
          }
        } else {
          return FALSE;
        }
      }
    }
    