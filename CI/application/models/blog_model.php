<?php
  class Blog_model extends CI_Model
  {
    public function get_user_data()
    {
      //$query = $this->db->select()
      //選取某項資料
      //$this->db->select('murmur');
      //選取資料表並限定人
      $query = $this->db->get('user');
      $row = $query->result_array(); 
      //var_dump($row); 
        return $row;         
      //限定輸出某項資料   
      //return $row["murmur"];
        

    }
  }
