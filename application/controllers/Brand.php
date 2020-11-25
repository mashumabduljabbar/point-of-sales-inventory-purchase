<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Brand extends CI_Controller {
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
        $this->load->view("v_brand");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_brand()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_brand
        )temp";
		
        $primaryKey = 'id_brand';
        $columns = array(
        array( 'db' => 'id_brand',     'dt' => 0 ),
        array( 'db' => 'nama_brand',        'dt' => 1 ),
        array( 'db' => 'id_brand',     'dt' => 2 ),
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
	
	public function brand()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_brand");
        $this->load->view("v_admin_footer");
    }		
	public function brand_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_brand_add");
		$this->load->view("v_admin_footer");
    }
	public function brand_ubah($id_brand)
	{
		$where = array("id_brand" => $id_brand);
		$data['tbl_brand'] = $this->m_general->view_by("tbl_brand",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_brand_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function brand_aksi_tambah()
    {
			$nama_brand = $this->input->post('nama_brand');
			$check_brand = $this->m_general->countdata("tbl_brand", array("nama_brand" => $nama_brand));
			if($check_brand==0){
					$_POST['id_brand'] = $this->m_general->bacaidterakhir("tbl_brand", "id_brand");
					$this->m_general->add("tbl_brand", $_POST);
					redirect('brand');
			}else{
					redirect('brand/brand_tambah/err');
			}
    }	
	public function brand_aksi_ubah($id_brand)
    {
			$nama_brand = $this->input->post('nama_brand');
			$check_brand = $this->m_general->countdata("tbl_brand", array("nama_brand" => $nama_brand));
			if($check_brand==0){
					$where['id_brand'] = $id_brand;
					$this->m_general->edit("tbl_brand", $where, $_POST);
					redirect('brand');
			}else{
					redirect('brand/brand_ubah/'.$id_brand.'/err');
			}
    }	
	public function brand_aksi_hapus($id_brand){
			$where['id_brand'] = $id_brand;
			$this->m_general->hapus("tbl_brand", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('brand');
	}
}