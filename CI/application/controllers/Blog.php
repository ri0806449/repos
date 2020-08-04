<?php
class Blog extends CI_Controller {
        $this->load->model('blogmodel');

        public function index(){
          $data['title'] = "標題來啊";
          $data['heading'] = "第一句話";
          $data['to_do_list'] = array("吃飯","打東東","打東東燈燈～");
          $this->load->view('blogview', $data);
        }


}
?>
