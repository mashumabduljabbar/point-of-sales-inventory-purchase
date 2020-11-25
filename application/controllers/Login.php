<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Bangkok");	
		$this->load->model('m_general');
	}	
	
	public function index()
	{
		$data['hasillogin'] = "";
		$this->load->view('v_login_index',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
	
	function aksi_login(){
		$username = $this->input->post('username');
		$user_password = md5($this->input->post('password'));
		$where = array(
			'username' => $username,
			'password' => $user_password
			);
		$checking = $this->m_general->check_login('tbl_user', array('username' => $username), array('password' => $user_password));
		
		if($checking > 0){
			foreach ($checking as $apps) {
				$data_session = array(
					'userid' => $apps->id_user,
					'username' => $apps->username,
					'status' => "login"
					);
	 
				$this->session->set_userdata($data_session);
				
				redirect(base_url("admin"));
			}
		}else{
			$data['hasillogin'] = "<i style='color:red;'>Username dan password salah !</i>";
			$this->load->view('v_login_index' , $data);
		}
	}
 
}
