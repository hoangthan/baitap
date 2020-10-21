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
    //    $this->sinhvien_model -> studentlogin( $uname,$pass);
    //    $this->load->view("loginstudent_view");
        // User Model Loaded in constructor
        if ($this->sinhvien_model -> studentlogin( $uname,$pass)) {

            // $this->load->view('insertthanhcong_view');
            $response = ["message" => "chinh xac.", "status" => 200];
            header('Content-type: application/json');
            echo json_encode($response);
            // redirect(base_url() . 'index.php/sinhvien');  

        } else {
            // $this->load->view("loginstudenterro_view");
            $response = ["message" => "passwork hoac mat khau khong chinh xac.", "status" => 400];
            header('Content-type: application/json');
            echo json_encode($response);
        }
  
    }
}