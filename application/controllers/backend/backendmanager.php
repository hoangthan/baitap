<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class backendmanager extends CI_Controller {
    public function __construct()
	{ 
        // $this->load->library('form_validation');
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('email');
		$this->load->helper('security');
        $this->load->model("sinhvien_model");
	}

	public function index()
	{	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$Grouplogined =$this->session->userdata('Group') ;
		$logintrue=$this->session->userdata('logged_in') ;

		$unames= $this->session->userdata('uname') ;		
		// var_dump($Grouplogined);
		if($Grouplogined == '1' && $logintrue==true){
		$this->load->view("backendmanager");
		}else if($Grouplogined == '3' && $logintrue==true){
			$this->load->view("studentview");

		}else{
			redirect(base_url('Login'));

		}
	}
	
	public function manageruser()
	{ 
		$mangdatauser= $this->sinhvien_model -> Getalluser();
		$ketquaus = array('dulieuketqua' =>$mangdatauser ); 
		$this->load->view("backend/manageruser", $ketquaus,false);
		// $this->load->view("backend/manageruser");
	}

	public function quanlydanhmuc()
	{
		$this->load->view("backend/quanlydanhmuc");
	}
	public function danhsachmuonsach()
	{
		$this->load->view("backend/danhsachmuonsach");
	}
	public function listbook()
	{
		$this->load->view("backend/listbook");
	}
	public function deleteuser($id)
	{ 
		$this->sinhvien_model -> Deleteuserbyid($id);
		if($this->sinhvien_model -> Deleteuserbyid($id)){
			redirect(base_url('backend/backendmanager/manageruser'));
		}else{
			echo " co loi say ra vui long thuc hien lai";
		}
	}
	public function editUserbacked($id)
	{ 
		//validate form		
		 $this->_data['user'] =  $this->sinhvien_model -> getstudentbyID($id);
		$this->form_validation->set_rules('username', 'Username','required|trim|min_length[5]|max_length[32]|xss_clean');
		// $this->form_validation->set_rules('email', 'Email',
		// 		'required|trim|xss_clean|valid_email'.$is_unique_email
		// 	);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

		// $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[sinhvien.email]');
		$this->form_validation->set_rules('address', 'Address','required|trim|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone','required|trim|xss_clean');

		$this->form_validation->set_rules('password', 'Mật khẩu',
		'required|trim|min_length[8]|max_length[32]|xss_clean|callback_valid_password'
		);
		// $this->form_validation->set_rules('password', 'Mật khẩu',
		// 'trim|max_length[32]|xss_clean'.$pwd_validate
		// );
		$this->form_validation->set_rules('pswrepeat', 'Nhập lại mật khẩu',
			'required|trim|max_length[32]|xss_clean|matches[password]'
		);
		// $this->form_validation->set_rules('pswrepeat', 'Nhập lại mật khẩu',
		// 'trim|max_length[32]|xss_clean'.$re_pwd_validate
		// );
	        // Thiết lập message
			$this->form_validation->set_message('required', 'Bạn chưa nhập %s.');
			$this->form_validation->set_message('is_unique', '%s Đã tồn tại.');
			$this->form_validation->set_message('max_length', 'Tối đa 32 ký tự.');
			$this->form_validation->set_message('min_length', 'Tối thiểu 8 ký tự.');
			$this->form_validation->set_message('matches', 'Nhập lại mật khẩu không đúng.');
			$this->form_validation->set_message('valid_email', 'Email không hợp lệ.');
	
		if($this->form_validation->run($this)==true)
		{
			$phone= $this->input->post('phone');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$passwordconfirm = $this->input->post('pswrepeat');
			$address = $this->input->post('address');
			$options = [
				'cost' => 11,
			];
			$chucvu=$this->input->post('rol');
			
			if(strpos($chucvu,"Quản trị viên")  !== false){
				$quyen=1;
			}else if(strpos($chucvu,"Thủ Thư")  !== false){
				$quyen=2;
			}else{
				$quyen=3;
			}
			
			$hashed_password = password_hash($password, PASSWORD_DEFAULT,$options);
			$hashed_passwordconfirm=password_hash($passwordconfirm, PASSWORD_DEFAULT,$options);
			$this->load->model('sinhvien_model');
			$trangthai1= $this->sinhvien_model -> Updateuser($id,$quyen,$chucvu,$phone,$email,$username,$hashed_password,$hashed_passwordconfirm,$address);
			if($trangthai1){
				redirect(base_url('backend/backendmanager/manageruser'));
			}

		}else{
			$this->_data['phone'] = $this->input->post('phone');
			$this->_data['email'] = $this->input->post('email');
			$this->_data['address'] = $this->input->post('address');
			$this->_data['username'] = $this->input->post('username');	
			$this->_data['password'] = $this->input->post('password');
			$this->_data['pswrepeat'] = $this->input->post('pswrepeat');	
			$this->load->view("backend/editstudent",$this->_data);
		}
		
	}
	/**
	 * Validate Password
	 * 
	 */
	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

		// Cần có ít nhất 1 chữ thường
		if($password == '') {
			$this->form_validation->set_message('valid_password', 'Mật khẩu không được để trống!');

			return FALSE;
		}
		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'Mật khẩu bao gồm: a-z, A-Z, 0-9, ký tự đặc biệt.');

			return FALSE;
		}

		//Có ít nhất một chữ cái hoa
		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'Mật khẩu bao gồm: a-z, A-Z, 0-9, ký tự đặc biệt.');

			return FALSE;
		}

		// có ít nhất một chữ số
		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'Mật khẩu bao gồm: a-z, A-Z, 0-9, ký tự đặc biệt.');

			return FALSE;
		}

		//Có ít nhất một ký tự đặc biệt
		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'Mật khẩu bao gồm: a-z, A-Z, 0-9, ký tự đặc biệt.');

			return FALSE;
		}

		return TRUE;
	}

}