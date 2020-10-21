<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nhansu_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function inseartdata($ten,$tuoi,$diachi,$sdt,$anh,$donhang)
	{
		//nhan du liệu từ  controller
		$mangdulieu = array
		(
			'ten' => $ten ,
			'tuoi' =>$tuoi,
			'diachi' => $diachi,
			'sdt' => $sdt,
			'anh' =>$anh,
			'donhang' =>$donhang

		);
			$this->db->insert('nhanvien', $mangdulieu);
			return $this->db->insert_id();  //neu id là 0 thì là không insert được 
	}

	// sử lý view dữ liệu lấy dữ liệu từ  database 
	public function laydulieu()
	{ 
			$this->db->select('*'); // lấy dữ lieu gì 
			$this->db->order_by('id', 'asc');
			$dulieulayduoc= $this->db->get('nhanvien'); // từ bảng nhân viên 
			$dulieu = $dulieulayduoc->result_array(); // biens dữ liệu lấy được thành 1 mảng  dữ liệu 
			// var_dump($dulieu);
			// die();
			return $dulieu;
	
	} 
	// sửa dữ liệu 
	public function getdatabyid($key)
	{
		$this->db->select('*');

		$this->db->where('id', $key);
		$dulieunhanduoc = $this->db->get('nhanvien'); // lấy từ bảng nhân viên 
		$dulieu2= $dulieunhanduoc->result_array(); // biến dữ liệu thành mảng có  tên $dulieu3 
		return $dulieu2;

	}
  public function updatebyid($id,$ten,$tuoi,$diachi,$sdt,$anh,$donhang)
  { 

  	 $mangdulieu = array
  	 ( 
  	 		'id' =>$id,
  	 		'ten' => $ten ,
			'tuoi' =>$tuoi,
			'diachi' => $diachi,
			'sdt' => $sdt,
			'anh' =>$anh,
			'donhang' =>$donhang
  	 );
  	 $this->db->where('id', $id);
  	
  	return $this->db->update('nhanvien', $mangdulieu); 

  }
  public function xoadulieubyid($idnhanduoc)
  { 
  	$this->db->where('id', $idnhanduoc);
  
  	return $this->db->delete('nhanvien');
  	
  }
  public function get_user($id)
  {
	  $this->db->where('id', $id);
	  $query = $this->db->get('users');
	  return $query->row();
  }

  public function update_user($id, $userdata)
  {
	  $this->db->where('id', $id);
	  $this->db->update('users', $userdata);
  }
}

/* End of file nhansu_model.php */
/* Location: ./application/models/nhansu_model.php */