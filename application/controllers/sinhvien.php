<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sinhvien extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('email');
		$this->load->helper('security');
	}

	public function index()
	{
		$this->load->view("sinhviensignup_view");
	}

	public function  getInforStudent()
	{
		if (isset($_POST['json'])) {
			$json = $this->input->post('json');
		} else {
			$json = "";
		}

		if ($json !== '') {
			$datars = json_decode(str_replace('\"', '"', $json), true);
			$Chucvu = $datars['Chucvu'];
			$phone = $datars['phone'];
			$email = $datars['email'];
			$username = $datars['username'];
			$password = $datars['password'];
			$passwordconfirm = $datars['passwordconfirm'];
			$address = $datars['address'];
		}

		$options = [
			'cost' => 11,
		];

		$hashed_password = password_hash($password, PASSWORD_DEFAULT, $options);
		$hashed_passwordconfirm = password_hash($passwordconfirm, PASSWORD_DEFAULT, $options);
		$this->load->model('sinhvien_model');
		$trangthai = $this->sinhvien_model->insertdatastudent($Chucvu, $phone, $email, $username, $hashed_password, $hashed_passwordconfirm, $address);

		if ($trangthai) {
			$session_data   =   array(
				'uname' => $username,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($session_data);
			$response = ["message" => "chinh xac.", "status" => 200];
			header('Content-type: application/json');
			echo json_encode($response);
		} else {
			$response = ["message" => "Co loi khi dang ky vui long kiem tra lai .", "status" => 400];
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}

	public function quenmatkhau()
	{
		$this->load->view("quenmatkhau.php");
	}

	public  function randomPass()
	{
		$lower = 'abcdefghijklmnopqrstuvwxyz';
		$upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$number = '1234567890';
		$spec = '!@#$%^&*\-_{}.~';
		$lower_n = strlen($lower) - 1;
		$upper_n = strlen($upper) - 1;
		$number_n = strlen($number) - 1;
		$spec_n =  strlen($spec) - 1;
		$pass1 = rand(0, $lower_n);
		$pass2 = rand(0, $lower_n);
		$pass3 = rand(0, $lower_n);
		$pass4 = rand(0, $upper_n);
		$pass5 = rand(0, $upper_n);
		$pass6 = rand(0, $number_n);
		$pass7 = rand(0, $number_n);
		$pass8 = rand(0, $spec_n);
		$str_pass = $lower[$pass1] . $lower[$pass2] . $lower[$pass3] . $upper[$pass4] . $upper[$pass5] . $number[$pass6] . $number[$pass7] . $spec[$pass8];
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, 7);
			$password[] = $str_pass[$n];
		}
		$password[] = $spec[$pass8];
		return implode($password);
	}

	public function forgotpass()
	{
		$this->load->model('sinhvien_model');
		$this->form_validation->set_rules(
			'email',
			'email',
			'required|trim|xss_clean|valid_email'
		);
		// Thiết lập message
		$this->form_validation->set_message('required', 'Bạn chưa nhập %s.');
		$this->form_validation->set_message('valid_email', 'Email không hợp lệ.');
		if ($this->form_validation->run($this) == false) {
			$this->_data['email'] = $this->input->post('email');
			$this->load->view("quenmatkhau", $this->_data);
		} else {
			$email = $this->input->post('email');
			$user = $this->sinhvien_model->getuserbyemail($email);
			if (count($user) > 0) {
				$passwordnews = "VV3iVV33-";

				$options = [
					'cost' => 11,
				];

				$hashed_password1 = password_hash($passwordnews, PASSWORD_DEFAULT, $options);
				$hashed_passwordconfirm1 = password_hash($passwordnews, PASSWORD_DEFAULT, $options);
				$trangthai = $this->sinhvien_model->forgotpassword($email, $hashed_password1, $hashed_passwordconfirm1);
				if ($trangthai == 1) {
					$config = array(
						'protocol' => 'smtp',
						'smtp_host' => $this->config->item('smtp_host'),
						'smtp_port' => $this->config->item('smtp_port'),
						'smtp_user' => $this->config->item('smtp_user'),
						'smtp_pass' => $this->config->item('smtp_pass'),
						'mailtype'     => "html",
						'charset' => 'utf-8',
						'wordwrap' => TRUE
					);
					// $this->load->library('email', $config);
					$this->load->library('email');
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					//Nội dung Email
					$message = '<div bgcolor="#F1F1F1" style="min-width:100%!important;margin:40px 0;padding:40px 0;background:#f1f1f1;font-size:13px;font-family:\'Helvetica\',\'Arial\'">
										<table cellpadding="0" cellspacing="0" border="0" bgcolor="#F1F1F1" style="background:#f1f1f1;width:100%;height:100%;font-size:14px;line-height:1.5;border-collapse:collapse">
											<tbody>
											<tr>
												<td>
													<table cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF" align="center" style="background:#ffffff;width:100%;max-width:600px">
														<tbody>
														<tr>
															<td bgcolor="gray" style="font-size:20px;padding:20px 40px;color:#ffffff;border-bottom:5px solid #fe9703">Yêu cầu Khôi phục mật khẩu</td>
														</tr>
														<tr>
															<td style="padding:22px 40px;border:1px solid #dddddd;border-top:none">
																<p>Hi <strong>' . $email . '</strong>!</p>
																<p>Chúng tôi đã nhận được yêu cầu khôi phục mật khẩu của bạn!</p>
																<p>Mật khẩu mới của bạn là: <strong>' . $passwordnews . '</strong></p>
																<p>Bạn vui lòng thay đổi mật khẩu sau khi đăng nhập thành công!</p>
																<p>Link đăng nhập <a href=' . base_url() . ' >tại đây</a>.</p>
																<br>
																<p>Trân trọng thông báo!</p>
															</td>
														</tr>
														</tbody>
													</table>
													<p style="text-align:center;color:#aaabbb;font-size:9pt">2020 © By HoangQuangThan - AT130449.</p>
													<br>
												</td>
											</tr>
											</tbody>
										</table>
										<div class="yj6qo"></div>
										<div class="adL"></div>
									</div>';
					// Set to, from, message, etc. // Note: no $config param needed
					$this->email->from($this->config->item('smtp_user'), 'quanlythuvien');
					$this->email->to($email);
					$this->email->subject('Khôi phục mật khẩu');
					$this->email->message($message);
					if ($this->email->send()) {
						$mail = 'Email Successfully Send !';
					} else {
						$mail =  $this->email->print_debugger();
					}
					$code = 200;
					$mess = 'Chúng tôi đã gửi email đến địa chỉ email <strong>' . $this->input->post('email') . '</strong>. Vui lòng kiểm tra hộp thư';
				} else {
					$code = 404;
					$mess = 'Vui lòng thử lại';
				}
				$arrayketqua['dulieutrave'] = array($mess);
				$this->load->view("quenmatkhau.php", $arrayketqua);
			} else {
				$mess = 'Email của bạn chưa được đăng ký vui lòng đăng ký để sử dụng dịch vụ';

				$arrayketqua['dulieutrave'] = array($mess);
				$this->load->view("quenmatkhau.php", $arrayketqua);
			}
		}
	}
}
