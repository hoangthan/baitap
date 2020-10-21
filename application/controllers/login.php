<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
    public function __construct()
	{
        parent::__construct();
        $this->load->library('session');
	}

	public function index()
	{
		$this->load->view("Login");
    }

    public function loginstudent()
    {   
        if(isset($_POST['json']) ) {
            $json = $this->input->post('json');
        }else {
            $json="";
        }
        if ($json !== '') {
            $data = json_decode(str_replace('\"', '"', $json), true);
            $uname = $data['uname'];
            $pass = $data['psw'];   
        }
      
        $this->load->model("sinhvien_model");
        if ($this->sinhvien_model -> studentlogin( $uname,$pass)) {
            $response = ["message" => "Success", "status" => 200];
            header('Content-type: application/json');
            echo json_encode($response);
        } else {
            $response = ["message" => "Tài khoản không hợp lệ", "status" => 400];
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }
}
