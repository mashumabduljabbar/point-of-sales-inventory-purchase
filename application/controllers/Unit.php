<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Unit extends CI_Controller {
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
        $this->load->view("v_unit");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_unit()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_unit
        )temp";
		
        $primaryKey = 'id_unit';
        $columns = array(
        array( 'db' => 'id_unit',     'dt' => 0 ),
        array( 'db' => 'nama_unit',        'dt' => 1 ),
        array( 'db' => 'id_unit',     'dt' => 2 ),
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
	
	public function unit()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_unit");
        $this->load->view("v_admin_footer");
    }		
	public function unit_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_unit_add");
		$this->load->view("v_admin_footer");
    }
	public function unit_ubah($id_unit)
	{
		$where = array("id_unit" => $id_unit);
		$data['tbl_unit'] = $this->m_general->view_by("tbl_unit",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_unit_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function unit_aksi_tambah()
    {
			$nama_unit = $this->input->post('nama_unit');
			$check_unit = $this->m_general->countdata("tbl_unit", array("nama_unit" => $nama_unit));
			if($check_unit==0){
					$_POST['id_unit'] = $this->m_general->bacaidterakhir("tbl_unit", "id_unit");
					$this->m_general->add("tbl_unit", $_POST);
					redirect('unit');
			}else{
					redirect('unit/unit_tambah/err');
			}
    }	
	public function unit_aksi_ubah($id_unit)
    {
			$nama_unit = $this->input->post('nama_unit');
			$check_unit = $this->m_general->countdata("tbl_unit", array("nama_unit" => $nama_unit));
			if($check_unit==0){
					$where['id_unit'] = $id_unit;
					$this->m_general->edit("tbl_unit", $where, $_POST);
					redirect('unit');
			}else{
					redirect('unit/unit_ubah/'.$id_unit.'/err');
			}
    }	
	public function unit_aksi_hapus($id_unit){
			$where['id_unit'] = $id_unit;
			$this->m_general->hapus("tbl_unit", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('unit');
	}
}