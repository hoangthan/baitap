<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class editpass extends CI_Controller {
    public function __construct()
	{
        parent::__construct();
        $this->load->library('session');
	}
	public function index()
	{ 
        $sessiton = $this->session->all_userdata();
        $userlogined= $sessiton['uname'];
        $this->load->model("sinhvien_model");
       $mangdatalogin= $this->sinhvien_model -> getstudentbyname( $userlogined);
       $ketqua1 = array('dulieuketqua' =>$mangdatalogin );

       $this->load->view("editpass_view", $ketqua1,false);
    }
    public function editpassword()
    {
        if(isset($_POST['json']) ) {
            $json = $this->input->post('json');
        }else {
            $json="";
        }
        if ($json !== '') {
            $data = json_decode(str_replace('\"', '"', $json), true);
            $id = $data['id'];
            $oldpass = $data['oldpass'];
            $newpass = $data['newpass']; 
            $confimnewpass=$data['confimnewpass'];   
        }
        $this->load->model("sinhvien_model");
       if($this->sinhvien_model -> changeedpass( $id,$oldpass, $newpass,$confimnewpass)){
            $response = ["message" => "Thay doi mat  khau thanh cong.", "status" => 200];
            header('Content-type: application/json');
            echo json_encode($response);
       }else {
        $response = ["message" => "vui long nhap lai thong tin", "status" => 300];
        header('Content-type: application/json');
        echo json_encode($response);
       }
    }
 
}