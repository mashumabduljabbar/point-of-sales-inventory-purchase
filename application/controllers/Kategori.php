<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Kategori extends CI_Controller {
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
        $this->load->view("v_kategori");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_kategori()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_kategori
        )temp";
		
        $primaryKey = 'id_kategori';
        $columns = array(
        array( 'db' => 'id_kategori',     'dt' => 0 ),
        array( 'db' => 'nama_kategori',        'dt' => 1 ),
        array( 'db' => 'id_kategori',     'dt' => 2 ),
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
	
	public function kategori()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_kategori");
        $this->load->view("v_admin_footer");
    }		
	public function kategori_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_kategori_add");
		$this->load->view("v_admin_footer");
    }
	public function kategori_ubah($id_kategori)
	{
		$where = array("id_kategori" => $id_kategori);
		$data['tbl_kategori'] = $this->m_general->view_by("tbl_kategori",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_kategori_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function kategori_aksi_tambah()
    {
			$nama_kategori = $this->input->post('nama_kategori');
			$check_kategori = $this->m_general->countdata("tbl_kategori", array("nama_kategori" => $nama_kategori));
			if($check_kategori==0){
					$_POST['id_kategori'] = $this->m_general->bacaidterakhir("tbl_kategori", "id_kategori");
					$this->m_general->add("tbl_kategori", $_POST);
					redirect('kategori');
			}else{
					redirect('kategori/kategori_tambah/err');
			}
    }	
	public function kategori_aksi_ubah($id_kategori)
    {
			$nama_kategori = $this->input->post('nama_kategori');
			$check_kategori = $this->m_general->countdata("tbl_kategori", array("nama_kategori" => $nama_kategori));
			if($check_kategori==0){
					$where['id_kategori'] = $id_kategori;
					$this->m_general->edit("tbl_kategori", $where, $_POST);
					redirect('kategori');
			}else{
					redirect('kategori/kategori_ubah/'.$id_kategori.'/err');
			}
    }	
	public function kategori_aksi_hapus($id_kategori){
			$where['id_kategori'] = $id_kategori;
			$this->m_general->hapus("tbl_kategori", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('kategori');
	}
}