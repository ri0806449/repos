<?php
  $this->load->database('Try');
  $config['hostname'] = 'localhost';
  $config['username'] = 'root';
  $config['password'] = '';
  $config['database'] = 'Try';
  $config['dbdriver'] = 'mysqli';
  $config['dbprefix'] = '';
  $config['pconnect'] = FALSE;
  $config['db_debug'] = TRUE;
  $config['cache_on'] = FALSE;
  $config['cachedir'] = '';
  $config['char_set'] = 'utf8';
  $config['dbcollat'] = 'utf8_general_ci';
  $this->load->database($config);

  public function get_last_ten_entries()
    {
      $query = $this->db->get('entries', 10);
      return $query->result();
      echo $query;
    }
?>
