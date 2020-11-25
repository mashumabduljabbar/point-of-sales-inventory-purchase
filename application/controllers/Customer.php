<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Customer extends CI_Controller {
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
        $this->load->view("v_customer");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_customer()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_customer
        )temp";
		
        $primaryKey = 'id_customer';
        $columns = array(
        array( 'db' => 'id_customer',     'dt' => 0 ),
        array( 'db' => 'nama_customer',        'dt' => 1 ),
        array( 'db' => 'npwp_customer',        'dt' => 2 ),
        array( 'db' => 'alamat_customer',        'dt' => 3 ),
        array( 'db' => 'no_telp_customer',        'dt' => 4 ),
        array( 'db' => 'email_customer',        'dt' => 5 ),
        array( 'db' => 'id_customer',     'dt' => 6 ),
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
	
	public function customer()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_customer");
        $this->load->view("v_admin_footer");
    }		
	public function customer_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_customer_add");
		$this->load->view("v_admin_footer");
    }
	public function customer_ubah($id_customer)
	{
		$where = array("id_customer" => $id_customer);
		$data['tbl_customer'] = $this->m_general->view_by("tbl_customer",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_customer_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function customer_aksi_tambah()
    {
			$nama_customer = $this->input->post('nama_customer');
			$check_nama_customer = $this->m_general->countdata("tbl_customer", array("nama_customer" => $nama_customer));
			if($check_nama_customer==0){
				$_POST['id_customer'] = $this->m_general->bacaidterakhir("tbl_customer", "id_customer");
				$this->m_general->add("tbl_customer", $_POST);
				redirect('customer');
			}else{
				$this->load->view("v_admin_header");
				$this->load->view("v_customer_add",$_POST);
				$this->load->view("v_admin_footer");
			}
    }	
	public function customer_aksi_ubah($id_customer)
    {
			$where['id_customer'] = $id_customer;
			$nama_customer = $this->input->post('nama_customer')[0];
			$nama_customere_old = $this->input->post('nama_customer')[1];
			
			if($nama_customer!=$nama_customere_old){
				$check_customer = $this->m_general->countdata("tbl_customer", array("nama_customer" => $nama_customer));
				$_POST['nama_customer'] = $nama_customer;
			}else{
				$check_customer = 0;
				$_POST['nama_customer'] = $nama_customer;
			}
			
			if($check_customer==0){
				$this->m_general->edit("tbl_customer", $where, $_POST);
				redirect('customer');
			}else{
				$data = $_POST;
				$data['err'] = 1;
				$data['nama_customer'] = $nama_customer;
				$data['tbl_customer'] = $this->m_general->view_by("tbl_customer",$where);
				$this->load->view("v_admin_header");
				$this->load->view("v_customer_edit",$data);
				$this->load->view("v_admin_footer");
			}
    }	
	public function customer_aksi_hapus($id_customer){
			$where['id_customer'] = $id_customer;
			$this->m_general->hapus("tbl_customer", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('customer');
	}
}