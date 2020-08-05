<?php
  class Blog_model extends CI_Model
  {
    // public function _construct()
    // {
      // $this->load->database();
    // }

    public function get_user_data()
    {
      //$query = $this->db->select()
      $query = $this->db->get('user');
      //$query = $this->db->query('SELECT murmur FROM user WHERE username = "mei";');
      var_dump($query->row_array());
       if(mysqli_num_rows()>0)
       {
         $row = $query->row_array();
       }
       else
       {
         echo "找不到資料啦馬的";
       }
    return $query->result_array();
      return $row;
    }
  }
