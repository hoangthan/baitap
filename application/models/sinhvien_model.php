<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sinhvien_model extends CI_Model {

	// public $variable;

	public function __construct()
	{
        parent::__construct();
        $this->load->library('session');		
    }
    public function checkexitemail($email)
    {
        $this->db->where('email', $email);
        $queryemail = $this->db->get('sinhvien');
        if($queryemail->num_rows() > 0 ){
            return true;
        }

    }
    public function checkexitname($username)
    {
        $this->db->where('username',$username);
        $queryusername = $this->db->get('sinhvien');
        if($queryusername->num_rows() > 0 ){
            return true;
        }

    }
    public function insertdatastudent($Chucvu,$phone,$email,$username,$password,$passwordconfirm,$address){
        $sinhvien = new sinhvien_model;
        $sinhvien->checkexitemail($email);
        $sinhvien->checkexitname($username);
       if( $sinhvien->checkexitemail($email)==true){
            //    echo "email da ton tai";
            return false;
            } else if ($sinhvien->checkexitname($username)==true) {
                return false;
                // echo "ten da ton tai";
            }
            else {
                // echo"email chua ton tai";
                $dataStudent = array
                (   
                    'Group'=>'3',
                    'Chucvu'=>$Chucvu,
                    'phone' => $phone ,
                    'email' =>$email,
                    'username' => $username,
                    'password' => $password,
                    'passwordconfirm' =>$passwordconfirm,
                    'address' =>$address
                );
                $this->db->insert('sinhvien', $dataStudent);
                return $this->db->insert_id();  //neu id là 0 thì là không insert được 
              }
    }
    public function Updateuser($id,$quyen,$chucvu,$phone,$email,$username,$password,$passwordconfirm,$address)
    {
        $dataStudentupdate = array
        (   'id' =>$id,
            'Group'=>$quyen,
            'Chucvu'=>$chucvu,
            'phone' => $phone ,
            'email' =>$email,
            'username' => $username,
            'password' => $password,
            'passwordconfirm' =>$passwordconfirm,
            'address' =>$address
        );
        $this->db->where('id', $id);
  	
        return $this->db->update('sinhvien', $dataStudentupdate); 
    }
    
    public function studentlogin ( $uname,$pass) {
         $this->db->where('username', $uname);
         $query = $this->db->get('sinhvien');
         $row = $query->row();
         $session_data   =   array(
            'uname' => $row->username ,
             'logged_in' => TRUE,
             'Group'=>$row->Group
            );
            $this->session->set_userdata($session_data);
        return $row ? password_verify($pass, $row->password) : false;
    }

    public function getstudentbyname($uname)
    {
        $this->db->select('*');
        $this->db->where('username',$uname);
		$dulieunhanduoc = $this->db->get('sinhvien'); 
		$dulieu2= $dulieunhanduoc->result_array(); // biến dữ liệu thành mảng có  tên $dulieu3 
		return $dulieu2;
    }
    public function getuserbyemail($email)
    {
        $this->db->select('*');
        $this->db->where('email',$email);
		$dulieunhanduoccc = $this->db->get('sinhvien'); 
		$dulieuuseremail= $dulieunhanduoccc->result_array(); // biến dữ liệu thành mảng có  tên $dulieu3 
		return $dulieuuseremail;
    }
    public function getstudentbyID($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $dulieunhanduoc2 = $this->db->get('sinhvien'); 
		$dulieu22= $dulieunhanduoc2->result_array(); // biến dữ
		return $dulieu22;
    }
    public function Deleteuserbyid($id)
    {
        $this->db->where('id', $id);
  
        return $this->db->delete('sinhvien');
    }
     public function changeedpass( $id,$oldpass, $newpass,$confimnewpass)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $dulieunhanduoc = $this->db->get('sinhvien'); 
        $row1 = $dulieunhanduoc->row();
        if($row1 && password_verify($oldpass, $row1->password) ){ 
            $options = [
                'cost' => 11,
            ];
            $hashed_passwordn = password_hash($newpass, PASSWORD_DEFAULT,$options);
            $hashed_passwordconfirmn=password_hash($confimnewpass, PASSWORD_DEFAULT,$options);
            $mangdulieu = array
            ( 
                    'id' =>$id,
                    'password' =>$hashed_passwordn,
                    'passwordconfirm' =>  $hashed_passwordconfirmn
            );
            $this->db->where('id', $id);
           
           return $this->db->update('sinhvien', $mangdulieu); 
        }

    }
    public function forgotpassword($email,$hashed_password1,$hashed_passwordconfirm1)
    {

        $dulieuupdate = array (
            'password' =>$hashed_password1,
            'passwordconfirm' =>  $hashed_passwordconfirm1
        );
        $this->db->select('*');
        $this->db->where('email',$email);
		return $this->db->update('sinhvien', $dulieuupdate); 
    }
     public function Getalluser()
    {
        $this->db->select('*');
        $dulieuuser = $this->db->get('sinhvien'); 
        $dulieuusertrave= $dulieuuser->result_array(); 
		return $dulieuusertrave;
    }
}