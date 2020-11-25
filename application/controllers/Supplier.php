<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Supplier extends CI_Controller {
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
        $this->load->view("v_supplier");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_supplier()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_supplier
        )temp";
		
        $primaryKey = 'id_supplier';
        $columns = array(
        array( 'db' => 'id_supplier',     'dt' => 0 ),
        array( 'db' => 'nama_supplier',        'dt' => 1 ),
        array( 'db' => 'npwp_supplier',        'dt' => 2 ),
        array( 'db' => 'alamat_supplier',        'dt' => 3 ),
        array( 'db' => 'no_telp_supplier',        'dt' => 4 ),
        array( 'db' => 'email_supplier',        'dt' => 5 ),
        array( 'db' => 'id_supplier',     'dt' => 6 ),
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
	
	public function supplier()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_supplier");
        $this->load->view("v_admin_footer");
    }		
	public function supplier_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_supplier_add");
		$this->load->view("v_admin_footer");
    }
	public function supplier_ubah($id_supplier)
	{
		$where = array("id_supplier" => $id_supplier);
		$data['tbl_supplier'] = $this->m_general->view_by("tbl_supplier",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_supplier_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function supplier_aksi_tambah()
    {
			$nama_supplier = $this->input->post('nama_supplier');
			$check_nama_supplier = $this->m_general->countdata("tbl_supplier", array("nama_supplier" => $nama_supplier));
			if($check_nama_supplier==0){
				$_POST['id_supplier'] = $this->m_general->bacaidterakhir("tbl_supplier", "id_supplier");
				$this->m_general->add("tbl_supplier", $_POST);
				redirect('supplier');
			}else{
				$this->load->view("v_admin_header");
				$this->load->view("v_supplier_add",$_POST);
				$this->load->view("v_admin_footer");
			}
    }	
	public function supplier_aksi_ubah($id_supplier)
    {
			$where['id_supplier'] = $id_supplier;
			$nama_supplier = $this->input->post('nama_supplier')[0];
			$nama_suppliere_old = $this->input->post('nama_supplier')[1];
			
			if($nama_supplier!=$nama_suppliere_old){
				$check_supplier = $this->m_general->countdata("tbl_supplier", array("nama_supplier" => $nama_supplier));
				$_POST['nama_supplier'] = $nama_supplier;
			}else{
				$check_supplier = 0;
				$_POST['nama_supplier'] = $nama_supplier;
			}
			
			if($check_supplier==0){
				$this->m_general->edit("tbl_supplier", $where, $_POST);
				redirect('supplier');
			}else{
				$data = $_POST;
				$data['err'] = 1;
				$data['nama_supplier'] = $nama_supplier;
				$data['tbl_supplier'] = $this->m_general->view_by("tbl_supplier",$where);
				$this->load->view("v_admin_header");
				$this->load->view("v_supplier_edit",$data);
				$this->load->view("v_admin_footer");
			}
    }	
	public function supplier_aksi_hapus($id_supplier){
			$where['id_supplier'] = $id_supplier;
			$this->m_general->hapus("tbl_supplier", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('supplier');
	}
}