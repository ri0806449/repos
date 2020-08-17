<?php
class Product extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('product_model');
    }
    function index(){
            $data['title'] = "CI實作會員系統";
            $this->load->view('main/header',$data);
            $this->load->view('main/content',$data);
            $this->load->view('main/footer',$data);
    }
 
    function product_data(){
        $data=$this->product_model->product_list();
        echo json_encode($data);
    }
 
    function save(){
        $data=$this->product_model->save_product();
        echo json_encode($data);
    }
 
    function update(){
        $data=$this->product_model->update_product();
        echo json_encode($data);
    }
 
    function delete(){
        $data=$this->product_model->delete_product();
        echo json_encode($data);
    }
 
}