<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Perusahaan extends CI_Controller {
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
        $this->load->view("v_perusahaan");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_perusahaan()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_perusahaan
        )temp";
		
        $primaryKey = 'id_perusahaan';
        $columns = array(
        array( 'db' => 'id_perusahaan',     'dt' => 0 ),
        array( 'db' => 'nama_perusahaan',        'dt' => 1 ),
        array( 'db' => 'npwp_perusahaan',        'dt' => 2 ),
        array( 'db' => 'alamat_perusahaan',        'dt' => 3 ),
        array( 'db' => 'no_telp_perusahaan',        'dt' => 4 ),
        array( 'db' => 'email_perusahaan',        'dt' => 5 ),
        array( 'db' => 'id_perusahaan',     'dt' => 6 ),
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
	
	public function perusahaan()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_perusahaan");
        $this->load->view("v_admin_footer");
    }		
	public function perusahaan_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_perusahaan_add");
		$this->load->view("v_admin_footer");
    }
	public function perusahaan_ubah($id_perusahaan)
	{
		$where = array("id_perusahaan" => $id_perusahaan);
		$data['tbl_perusahaan'] = $this->m_general->view_by("tbl_perusahaan",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_perusahaan_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function perusahaan_aksi_tambah()
    {
			$nama_perusahaan = $this->input->post('nama_perusahaan');
			$check_nama_perusahaan = $this->m_general->countdata("tbl_perusahaan", array("nama_perusahaan" => $nama_perusahaan));
			if($check_nama_perusahaan==0){
				$_POST['id_perusahaan'] = $this->m_general->bacaidterakhir("tbl_perusahaan", "id_perusahaan");
				$this->m_general->add("tbl_perusahaan", $_POST);
				redirect('perusahaan');
			}else{
				$this->load->view("v_admin_header");
				$this->load->view("v_perusahaan_add",$_POST);
				$this->load->view("v_admin_footer");
			}
    }	
	public function perusahaan_aksi_ubah($id_perusahaan)
    {
			$where['id_perusahaan'] = $id_perusahaan;
			$nama_perusahaan = $this->input->post('nama_perusahaan')[0];
			$nama_perusahaane_old = $this->input->post('nama_perusahaan')[1];
			
			if($nama_perusahaan!=$nama_perusahaane_old){
				$check_perusahaan = $this->m_general->countdata("tbl_perusahaan", array("nama_perusahaan" => $nama_perusahaan));
				$_POST['nama_perusahaan'] = $nama_perusahaan;
			}else{
				$check_perusahaan = 0;
				$_POST['nama_perusahaan'] = $nama_perusahaan;
			}
			
			if($check_perusahaan==0){
				$this->m_general->edit("tbl_perusahaan", $where, $_POST);
				redirect('perusahaan');
			}else{
				$data = $_POST;
				$data['err'] = 1;
				$data['nama_perusahaan'] = $nama_perusahaan;
				$data['tbl_perusahaan'] = $this->m_general->view_by("tbl_perusahaan",$where);
				$this->load->view("v_admin_header");
				$this->load->view("v_perusahaan_edit",$data);
				$this->load->view("v_admin_footer");
			}
    }	
	public function perusahaan_aksi_hapus($id_perusahaan){
			$where['id_perusahaan'] = $id_perusahaan;
			$this->m_general->hapus("tbl_perusahaan", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('perusahaan');
	}
}