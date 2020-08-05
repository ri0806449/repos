<?php
class Blog extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('blog_model');
        }



        public function index()
        {
          $data['user'] = $this->blog_model->get_user_data();
          //$query = $this->db->query('SELECT * FROM user');
          //$fields = $query->field_data();
          //print_r($fields[0]);
/*          foreach ($query->list_fields() as $field)
            {
                    echo $field;
            }


          $fields = $this->db->list_fields('user');

          foreach ($fields as $field)
          {
                  echo $field;
          }

*/
          $data['title'] = ucfirst('superb stuff');
          $data['heading'] = "小教學一波";
          $data['to_do_list'] = array("吃飯","打東東","打東東燈燈～");
          $data['footer_title'] = 'footer一波';
          $data['footer_content'] = '小天地一波';

          $this->load->view('head',$data);
          $this->load->view('blogview', $data);
          $this->load->view('footer', $data);
        }

}
?>
