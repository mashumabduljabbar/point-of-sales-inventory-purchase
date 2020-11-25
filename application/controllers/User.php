<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function index()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_user");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_user()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_user
        )temp";
		
        $primaryKey = 'id_user';
        $columns = array(
        array( 'db' => 'id_user',     'dt' => 0 ),
        array( 'db' => 'nama_user',        'dt' => 1 ),
        array( 'db' => 'username',        'dt' => 2 ),
        array( 'db' => 'jabatan_user',        'dt' => 3 ),
        array( 'db' => 'alamat_user',        'dt' => 4 ),
        array( 'db' => 'no_telp_user',        'dt' => 5 ),
        array( 'db' => 'email_user',        'dt' => 6 ),
        array( 'db' => 'id_user',     'dt' => 7 ),
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}	
	
	public function user()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_user");
        $this->load->view("v_admin_footer");
    }		
	public function user_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_user_add");
		$this->load->view("v_admin_footer");
    }
	public function user_ubah($id_user)
	{
		$where = array("id_user" => $id_user);
		$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_user_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function user_aksi_tambah()
    {
			$username = $this->input->post('username');
			$check_username = $this->m_general->countdata("tbl_user", array("username" => $username));
			if($check_username==0){
				$_POST['id_user'] = $this->m_general->bacaidterakhir("tbl_user", "id_user");
				$_POST['password'] = md5($this->input->post('password'));
				$this->m_general->add("tbl_user", $_POST);
				redirect('user');
			}else{
				$this->load->view("v_admin_header");
				$this->load->view("v_user_add",$_POST);
				$this->load->view("v_admin_footer");
			}
    }	
	public function user_aksi_ubah($id_user)
    {
			$where['id_user'] = $id_user;
			$username = $this->input->post('username')[0];
			$username_old = $this->input->post('username')[1];
			$password = $this->input->post('password')[0];
			$password_old = $this->input->post('password')[1];
			
			if($username!=$username_old){
				$check_username = $this->m_general->countdata("tbl_user", array("username" => $username));
				$_POST['username'] = $username;
			}else{
				$check_username = 0;
				$_POST['username'] = $username;
			}
			
			if($check_username==0){
				if($password!=$password_old){
					$_POST['password'] = md5($password);
				}else{
					$_POST['password'] = $password;
				}
				$this->m_general->edit("tbl_user", $where, $_POST);
				redirect('user');
			}else{
				$data = $_POST;
				$data['err'] = 1;
				$data['username'] = $username;
				$data['password'] = $password;
				$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
				$this->load->view("v_admin_header");
				$this->load->view("v_user_edit",$data);
				$this->load->view("v_admin_footer");
			}
    }	
	public function user_aksi_hapus($id_user){
			$where['id_user'] = $id_user;
			$this->m_general->hapus("tbl_user", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('user');
	}
}