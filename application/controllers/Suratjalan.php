<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Suratjalan extends CI_Controller {
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
        $this->load->view("v_suratjalan");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_suratjalan()
	{
		$table = "
        (
              select a.id_surat_jalan, a.tanggal_pengiriman,
b.nama_user, c.id_warehouse
from tbl_surat_jalan a
join tbl_user b on a.id_user=b.id_user
join tbl_warehouse c on a.id_warehouse=c.id_warehouse
        )temp";
		
        $primaryKey = 'id_surat_jalan';
        $columns = array(
        array( 'db' => 'id_surat_jalan',     'dt' => 0 ),
        array( 'db' => 'tanggal_pengiriman',        'dt' => 1 ),
        array( 'db' => 'nama_user',        'dt' => 2 ),
        array( 'db' => 'id_warehouse',        'dt' => 3 ),
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
			
	public function suratjalan_tambah()
    {
		$data['tbl_warehouse'] = $this->db->query("select distinct(a.id_warehouse),
f.nama_customer
from tbl_warehouse a
join tbl_warehouse_detail b on b.id_warehouse=a.id_warehouse
join tbl_po_detail c on c.id_po_detail=b.id_po_detail
join tbl_po d on d.id_po=c.id_po
join tbl_rfq e on e.id_rfq=d.id_rfq
join tbl_customer f on f.id_customer=e.id_customer
where e.jenis_rfq='0'")->result();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_suratjalan_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function suratjalan_ubah($id_surat_jalan)
	{
		$data['tbl_warehouse'] = $this->db->query("select distinct(a.id_warehouse),
f.nama_customer
from tbl_warehouse a
join tbl_warehouse_detail b on b.id_warehouse=a.id_warehouse
join tbl_po_detail c on c.id_po_detail=b.id_po_detail
join tbl_po d on d.id_po=c.id_po
join tbl_rfq e on e.id_rfq=d.id_rfq
join tbl_customer f on f.id_customer=e.id_customer
where e.jenis_rfq='0'")->result();
		$data['tbl_warehouse_by'] = $this->db->query("select distinct(t.id_surat_jalan), t.id_warehouse,  f.nama_customer, t.tanggal_pengiriman, t.id_user
from tbl_surat_jalan t
join tbl_warehouse a on a.id_warehouse=t.id_warehouse
join tbl_warehouse_detail b on b.id_warehouse=a.id_warehouse
join tbl_po_detail c on c.id_po_detail=b.id_po_detail
join tbl_po d on d.id_po=c.id_po
join tbl_rfq e on e.id_rfq=d.id_rfq
join tbl_customer f on f.id_customer=e.id_customer
where t.id_surat_jalan='$id_surat_jalan'")->row();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_warehouse_by']->id_user));
		$this->load->view("v_admin_header");
		$this->load->view('v_suratjalan_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function suratjalan_aksi_tambah()
    {
			$id_surat_jalan = $this->m_general->bacaidterakhir("tbl_surat_jalan", "id_surat_jalan");
				$data_surat_jalan = array(
					'id_surat_jalan' => $id_surat_jalan,
					'tanggal_pengiriman' => $_POST['tanggal_pengiriman'],
					'id_warehouse' => $_POST['id_warehouse'],
					'id_user' => $_POST['id_user']
				);
				$this->m_general->add("tbl_surat_jalan", $data_surat_jalan);
			redirect('suratjalan');
    }	
	public function suratjalan_aksi_ubah($id_surat_jalan)
    {
			$where['id_surat_jalan'] = $id_surat_jalan;
			$data_surat_jalan = array(
					'tanggal_pengiriman' => $_POST['tanggal_pengiriman'],
					'id_warehouse' => $_POST['id_warehouse'],
					'id_user' => $_POST['id_user']
				);
			$this->m_general->edit("tbl_surat_jalan", $where, $data_surat_jalan);
			redirect('suratjalan');
    }	
	public function suratjalan_aksi_hapus($id_surat_jalan){
			$where['id_surat_jalan'] = $id_surat_jalan;
			$this->m_general->hapus("tbl_surat_jalan", $where); 
			redirect('suratjalan');
	}
	
	public function suratjalan_detail($id_surat_jalan)
	{
		$data['tbl_warehouse'] = $this->db->query("select distinct(t.id_surat_jalan), t.id_warehouse,  f.nama_customer, t.tanggal_pengiriman, t.id_user, d.alamat_pengiriman_po, 
		e.id_perusahaan, e.id_customer
from tbl_surat_jalan t
join tbl_warehouse a on a.id_warehouse=t.id_warehouse
join tbl_warehouse_detail b on b.id_warehouse=a.id_warehouse
join tbl_po_detail c on c.id_po_detail=b.id_po_detail
join tbl_po d on d.id_po=c.id_po
join tbl_rfq e on e.id_rfq=d.id_rfq
join tbl_customer f on f.id_customer=e.id_customer
where t.id_surat_jalan='$id_surat_jalan'")->row();
		$data['tbl_warehouse_detail'] = $this->db->query("select d.nama_produk, b.qty_warehouse_detail
from tbl_surat_jalan t
join tbl_warehouse a on a.id_warehouse=t.id_warehouse
join tbl_warehouse_detail b on b.id_warehouse=a.id_warehouse
join tbl_po_detail c on c.id_po_detail=b.id_po_detail
join tbl_produk d on d.id_produk=c.id_produk
where t.id_surat_jalan='$id_surat_jalan'")->result();
		$data['tbl_perusahaan_by'] = $this->m_general->view_by("tbl_perusahaan", array("id_perusahaan"=>$data['tbl_warehouse']->id_perusahaan));
		$data['tbl_customer_by'] = $this->m_general->view_by("tbl_customer", array("id_customer"=>$data['tbl_warehouse']->id_customer));
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_warehouse']->id_user));
		$this->load->view("v_admin_header");
		$this->load->view('v_suratjalan_detail', $data);
		$this->load->view("v_admin_footer");
	}
}