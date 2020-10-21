<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include "UploadHandler.php";
class nhansu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$this->load->model('nhansu_model');
		$ketqua = $this->nhansu_model->laydulieu();
		$ketqua1 = array("mangketqua"=>$ketqua); // biến  ketqua thành mảng có tên ketqua1
		

		// truyền dữ liệu cho view 
		$this->load->view('danhsachnv_view', $ketqua1, FALSE);
	}
	public function addinfor()
	{
		
		// sử lý phần  upload ảnh 
				$target_dir = "imageupload/";
				$target_file = $target_dir . basename($_FILES["anhavatar"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["anhavatar"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				}
				// Check if file already exists
				if (file_exists($target_file)) {
				    echo "Sorry, file đã tồn tại.";
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["anhavatar"]["size"] > 5000000) {
				    echo "Sorry, ảnh của bạn quá lớn.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    echo "Sorry, chỉ upload  JPG, JPEG, PNG & GIF .";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["anhavatar"]["tmp_name"], $target_file)) {
				      //  echo "The file ". basename( $_FILES["anhavatar"]["name"]). " has been uploaded.";
				    } else {
				        echo "Sorry, lỗi khi upload ảnh.";
				    }
				} 
				$anh = base_url() ."imageupload/".basename($_FILES["anhavatar"]["name"]);

				
				// lay dữ lieeujj từ view 
					$ten=$this->input->post('ten');
					$old = $this->input->post('tuoi');
					$diachi= $this->input->post('diachi');
					$phone= $this->input->post('phone');
				
					$donhang = $this->input->post('donhang'); 
					// sử dụng controller  truyền dữ liệu vào  model
					//gọi model 
					$this->load->model('nhansu_model');
					//truyền thông tin cho model -- truyền đến hàm insert data thông tin nhận được 
					$trangthai= $this->nhansu_model -> inseartdata ($ten,$old,$diachi,$phone,$anh,$donhang);
					if ($trangthai) {
						  		echo ' insert thành công';
						  		$this->load->view('insertthanhcong_view');
					} else {
						echo 'chua thanh công  kiểm  tra lại ';
					}	
	}

	//sử lý   truyền dữ liệu qua view 
	public function getdatatoview()
	{ 

		// truyền qua indexx
	} 
	// sửa nhân viên 
   public function suanhansu($idnhanduoc)
   {
   	 $this->load->model('nhansu_model');
   	$ketqua = $this->nhansu_model->getdatabyid($idnhanduoc); // dựa vào id lấy ra dữ liệu 
   	// bien dữ liệu thành mảng 
   	 $ketqua1 = array('dulieuketqua' =>$ketqua );
   	// đưa ra view sửa 
	   $this->load->view('suanhanvien_view', $ketqua1, FALSE);
	   
   }
   public function updatenhansu()
   {
   	 
   	 //lay dữ lieeujj từ view 
   					$id = $this->input->post('id');
					$ten=$this->input->post('ten');
					$old = $this->input->post('tuoi');
					$diachi= $this->input->post('diachi');
					$phone= $this->input->post('phone');
				
					$donhang = $this->input->post('donhang'); 
					// sử lý phần  upload ảnh 
	
				$target_dir = "imageupload/";
				$target_file = $target_dir . basename($_FILES["anhavatar"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["anhavatar"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				}
				// Check if file already exists
				if (file_exists($target_file)) {
				    echo "Sorry, file đã tồn tại.";
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["anhavatar"]["size"] > 5000000) {
				    echo "Sorry, ảnh của bạn quá lớn.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    echo "Sorry, chỉ upload  JPG, JPEG, PNG & GIF .";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["anhavatar"]["tmp_name"], $target_file)) {
				      //  echo "The file ". basename( $_FILES["anhavatar"]["name"]). " has been uploaded.";
				    } else {
				        echo "Sorry, lỗi khi upload ảnh.";
				    }
				} 
				$anh = basename($_FILES["anhavatar"]["name"]);

				if ($anh) { 
					 // nếu có ảnh thì in ra ảnh ;à ảnh cũ
					echo $anh;
				} else {
					// nếu upload ảnh mới thì in ra ảnh mới 
					$anh = $this->input->post('anhavatar2');
					echo $anh;
				}

				$this->load->model('nhansu_model');
			 $trangthai = $this->nhansu_model->updatebyid($id,$ten,$old,$diachi,$phone,$anh,$donhang);
			 if ($trangthai) {
			 	 echo 'update thanh cong'; 
			 	 $this->load->view('insertthanhcong_view');
			 } else {
			 	echo 'up date khong thành công ';
			 }
   }

   public function xoanhansu($idnhanduoc)
   {
   	 $this->load->model('nhansu_model');
   	 if ( $this->nhansu_model->xoadulieubyid($idnhanduoc)) { 
   	 	echo 'xoa thanh cong';
   	 	$this->load->view('xoa_view');
   	 	
   	 } else {
   	 	echo 'xóa chưa thành công  ';
   	 }
   	

   }  
   //load từ ajax
   public function ajaxadd()
   {
   	 // lay dữ lieeujj từ view 
					$ten=$this->input->post('ten');
					$old = $this->input->post('tuoi');
					$diachi= $this->input->post('diachi');
					$phone= $this->input->post('phone');
				    $anh = $this->input->post('anh');
					$donhang = $this->input->post('donhang'); 
					
					// sử dụng controller  truyền dữ liệu vào  model
					//gọi model 
					$this->load->model('nhansu_model');
					//truyền thông tin cho model -- truyền đến hàm insert data thông tin nhận được 
					$trangthai= $this->nhansu_model -> inseartdata($ten,$old,$diachi,$phone,$anh,$donhang);
					if ($trangthai) {
						  		echo ' insert thành công';
						  		$this->load->view('insertthanhcong_view');
					} else {
						echo 'chua thanh công  kiểm  tra lại ';
					}	
   } 

   public function uploadajax()
   {  
   	$uploadajax = new UploadHandler(); // định nghĩa để sử  dụng lớp uploadhander

   }

}

/* End of file nhansu.php */
/* Location: ./application/controllers/nhansu.php */