<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Warehouse extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function barang_masuk()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_warehouse_barang_masuk");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_barang_masuk()
	{
		$table = "
        (
              select a.id_warehouse, a.tanggal_warehouse,
a.upload_warehouse, b.nama_user, f.id_po, h.nama_supplier
from tbl_warehouse a
join tbl_user b on a.id_user=b.id_user
join tbl_po f on f.id_po=(select distinct(e.id_po) from tbl_warehouse_detail c
join tbl_warehouse d on c.id_warehouse=d.id_warehouse
join tbl_po_detail e on e.id_po_detail=c.id_po_detail
where c.id_warehouse=a.id_warehouse
)
join tbl_rfq g on g.id_rfq=f.id_rfq
join tbl_supplier h on h.id_supplier=g.id_supplier
where g.jenis_rfq='1'
        )temp";
		
        $primaryKey = 'id_warehouse';
        $columns = array(
        array( 'db' => 'id_warehouse',     'dt' => 0 ),
        array( 'db' => 'tanggal_warehouse',        'dt' => 1 ),
        array( 'db' => 'upload_warehouse',        'dt' => 2 ),
        array( 'db' => 'id_po',        'dt' => 3 ),
        array( 'db' => 'nama_supplier',        'dt' => 4 ),
        array( 'db' => 'nama_user',        'dt' => 5 ),
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
			
	public function barang_masuk_tambah($id_po="")
    {
		$data['tbl_po'] = $this->db->query("select a.id_po, c.nama_supplier  from tbl_po a
join tbl_rfq b on b.id_rfq=a.id_rfq
join tbl_supplier c on c.id_supplier=b.id_supplier
where b.jenis_rfq='1' order by a.id_po ASC")->result();
$data['tbl_po_by'] = $this->db->query("select a.id_po, c.nama_supplier  from tbl_po a
join tbl_rfq b on b.id_rfq=a.id_rfq
join tbl_supplier c on c.id_supplier=b.id_supplier
where a.id_po='$id_po'")->row();
		$data['tbl_po_detail'] = $this->db->query("select a.*, b.nama_produk from tbl_po_detail a 
join tbl_produk b on a.id_produk=b.id_produk where id_po='$id_po' order by id_po_detail ASC")->result();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_warehouse_barang_masuk_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function barang_masuk_ubah($id_warehouse)
	{
		$where = array("id_warehouse" => $id_warehouse);
		$data['tbl_warehouse'] = $this->m_general->view_by("tbl_warehouse",$where);
		$data['tbl_warehouse_detail'] = $this->db->query("select c.nama_produk, a.qty_warehouse_detail, a.id_warehouse_detail, a.id_po_detail
from tbl_warehouse_detail a 
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk c on b.id_produk=c.id_produk 
where a.id_warehouse='$id_warehouse' order by a.id_warehouse_detail ASC")->result();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_warehouse']->id_user));
		$this->load->view("v_admin_header");
		$this->load->view('v_warehouse_barang_masuk_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function barang_masuk_aksi_tambah()
    {
			$id_warehouse = $this->m_general->bacaidterakhir("tbl_warehouse", "id_warehouse");
			$folder = "warehouse";
			$file_upload = $_FILES['userfiles'];
			$files = $file_upload;
			if($files['name'] != "" OR $files['name'] != NULL){
				$upload_warehouse = $this->m_general->file_upload($files, $folder);
			}else{
				$upload_warehouse = "";
			}	
				$data_warehouse = array(
					'id_warehouse' => $id_warehouse,
					'tanggal_warehouse' => $_POST['tanggal_warehouse'],
					'upload_warehouse' => $upload_warehouse,
					'id_user' => $_POST['id_user']
				);
				$this->m_general->add("tbl_warehouse", $data_warehouse);
			
			$jumlah_id_po_detail = count($this->input->post('id_po_detail'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_po_detail; $x++){
				if($_POST['id_po_detail'][$x]!=""){
					$id_warehouse_detail = $this->m_general->bacaidterakhir("tbl_warehouse_detail", "id_warehouse_detail");
					$data_detail = array(
						'id_warehouse_detail'=>$id_warehouse_detail,
						'qty_warehouse_detail'=>$_POST['qty_warehouse_detail'][$x],
						'id_po_detail'=>$_POST['id_po_detail'][$x],
						'id_warehouse'=>$id_warehouse
					);
					$this->m_general->add("tbl_warehouse_detail", $data_detail);	
				}
			}
			
			redirect('warehouse/barang_masuk');
    }	
	public function barang_masuk_aksi_ubah($id_warehouse)
    {
			$upload_warehouse = $this->input->post('upload_warehouse');
			$where['id_warehouse'] = $id_warehouse;
			$tbl_warehouse = $this->m_general->view_by("tbl_warehouse",$where);
			$folder = "warehouse";
			$file_upload = $_FILES['userfiles'];
			$files = $file_upload;
			if($files['name'] != "" OR $files['name'] != NULL){
				$file = './assets/dist/img/warehouse/'.$tbl_warehouse->upload_warehouse;
				if(is_readable($file)){
					unlink($file);
				}
				$upload_warehouse2 = $this->m_general->file_upload($files, $folder);
			}else{
				$upload_warehouse2 = $upload_warehouse;
			}	
			
			$where['id_warehouse'] = $id_warehouse;
			$data_warehouse = array(
					'tanggal_warehouse' => $_POST['tanggal_warehouse'],
					'upload_warehouse' => $upload_warehouse2,
					'id_user' => $_POST['id_user'],
					'id_warehouse'=>$id_warehouse
				);
			$this->m_general->edit("tbl_warehouse", $where, $data_warehouse);
			
			$this->m_general->hapus("tbl_warehouse_detail", $where);
			$jumlah_id_po_detail = count($this->input->post('id_po_detail'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_po_detail; $x++){
				if($_POST['id_po_detail'][$x]!=""){
					$id_warehouse_detail = $this->m_general->bacaidterakhir("tbl_warehouse_detail", "id_warehouse_detail");
					$data_detail = array(
						'id_warehouse_detail'=>$id_warehouse_detail,
						'qty_warehouse_detail'=>$_POST['qty_warehouse_detail'][$x],
						'id_po_detail'=>$_POST['id_po_detail'][$x],
						'id_warehouse'=>$id_warehouse
					);
					$this->m_general->add("tbl_warehouse_detail", $data_detail);		
				}
			}
			redirect('warehouse/barang_masuk');
    }	
	public function barang_masuk_aksi_hapus($id_warehouse){
			$where['id_warehouse'] = $id_warehouse;
			$this->m_general->hapus("tbl_warehouse", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('warehouse/barang_masuk');
	}
	public function barang_masuk_detail($id_warehouse)
	{
		$where = array("id_warehouse" => $id_warehouse);
		$data['tbl_warehouse'] = $this->m_general->view_by("tbl_warehouse",$where);
		$data['tbl_warehouse_detail'] = $this->db->query("select c.nama_produk, a.qty_warehouse_detail, a.id_warehouse_detail, a.id_po_detail
from tbl_warehouse_detail a 
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk c on b.id_produk=c.id_produk 
where a.id_warehouse='$id_warehouse' order by a.id_warehouse_detail ASC")->result();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_warehouse']->id_user));
		$this->load->view("v_admin_header");
		$this->load->view('v_warehouse_barang_masuk_detail', $data);
		$this->load->view("v_admin_footer");
	}
/////////////////////////////////////////////////////////////////////////////////

	public function barang_keluar()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_warehouse_barang_keluar");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_barang_keluar()
	{
		$table = "
        (
              select a.id_warehouse, a.tanggal_warehouse,
a.upload_warehouse, b.nama_user, f.id_po, h.nama_customer
from tbl_warehouse a
join tbl_user b on a.id_user=b.id_user
join tbl_po f on f.id_po=(select distinct(e.id_po) from tbl_warehouse_detail c
join tbl_warehouse d on c.id_warehouse=d.id_warehouse
join tbl_po_detail e on e.id_po_detail=c.id_po_detail
where c.id_warehouse=a.id_warehouse
)
join tbl_rfq g on g.id_rfq=f.id_rfq
join tbl_customer h on h.id_customer=g.id_customer
where g.jenis_rfq='0'
        )temp";
		
        $primaryKey = 'id_warehouse';
        $columns = array(
        array( 'db' => 'id_warehouse',     'dt' => 0 ),
        array( 'db' => 'tanggal_warehouse',        'dt' => 1 ),
        array( 'db' => 'upload_warehouse',        'dt' => 2 ),
        array( 'db' => 'id_po',        'dt' => 3 ),
        array( 'db' => 'nama_customer',        'dt' => 4 ),
        array( 'db' => 'nama_user',        'dt' => 5 ),
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
			
	public function barang_keluar_tambah($id_po="")
    {
		$data['tbl_po'] = $this->db->query("select a.id_po, c.nama_customer  from tbl_po a
join tbl_rfq b on b.id_rfq=a.id_rfq
join tbl_customer c on c.id_customer=b.id_customer
where b.jenis_rfq='0' order by a.id_po ASC")->result();
$data['tbl_po_by'] = $this->db->query("select a.id_po, c.nama_customer  from tbl_po a
join tbl_rfq b on b.id_rfq=a.id_rfq
join tbl_customer c on c.id_customer=b.id_customer
where a.id_po='$id_po'")->row();
		$data['tbl_po_detail'] = $this->db->query("select a.*, b.nama_produk from tbl_po_detail a 
join tbl_produk b on a.id_produk=b.id_produk where id_po='$id_po' order by id_po_detail ASC")->result();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_warehouse_barang_keluar_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function barang_keluar_ubah($id_warehouse)
	{
		$where = array("id_warehouse" => $id_warehouse);
		$data['tbl_warehouse'] = $this->m_general->view_by("tbl_warehouse",$where);
		$data['tbl_warehouse_detail'] = $this->db->query("select c.nama_produk, a.qty_warehouse_detail, a.id_warehouse_detail, a.id_po_detail
from tbl_warehouse_detail a 
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk c on b.id_produk=c.id_produk 
where a.id_warehouse='$id_warehouse' order by a.id_warehouse_detail ASC")->result();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_warehouse']->id_user));
		$this->load->view("v_admin_header");
		$this->load->view('v_warehouse_barang_keluar_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function barang_keluar_aksi_tambah()
    {
			$id_warehouse = $this->m_general->bacaidterakhir("tbl_warehouse", "id_warehouse");
			$folder = "warehouse";
			$file_upload = $_FILES['userfiles'];
			$files = $file_upload;
			if($files['name'] != "" OR $files['name'] != NULL){
				$upload_warehouse = $this->m_general->file_upload($files, $folder);
			}else{
				$upload_warehouse = "";
			}	
				$data_warehouse = array(
					'id_warehouse' => $id_warehouse,
					'tanggal_warehouse' => $_POST['tanggal_warehouse'],
					'upload_warehouse' => $upload_warehouse,
					'id_user' => $_POST['id_user']
				);
				$this->m_general->add("tbl_warehouse", $data_warehouse);
			
			$jumlah_id_po_detail = count($this->input->post('id_po_detail'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_po_detail; $x++){
				if($_POST['id_po_detail'][$x]!=""){
					$id_warehouse_detail = $this->m_general->bacaidterakhir("tbl_warehouse_detail", "id_warehouse_detail");
					$data_detail = array(
						'id_warehouse_detail'=>$id_warehouse_detail,
						'qty_warehouse_detail'=>$_POST['qty_warehouse_detail'][$x],
						'id_po_detail'=>$_POST['id_po_detail'][$x],
						'id_warehouse'=>$id_warehouse
					);
					$this->m_general->add("tbl_warehouse_detail", $data_detail);	
				}
			}
			
			redirect('warehouse/barang_keluar');
    }	
	public function barang_keluar_aksi_ubah($id_warehouse)
    {
			$upload_warehouse = $this->input->post('upload_warehouse');
			$where['id_warehouse'] = $id_warehouse;
			$tbl_warehouse = $this->m_general->view_by("tbl_warehouse",$where);
			$folder = "warehouse";
			$file_upload = $_FILES['userfiles'];
			$files = $file_upload;
			if($files['name'] != "" OR $files['name'] != NULL){
				$file = './assets/dist/img/warehouse/'.$tbl_warehouse->upload_warehouse;
				if(is_readable($file)){
					unlink($file);
				}
				$upload_warehouse2 = $this->m_general->file_upload($files, $folder);
			}else{
				$upload_warehouse2 = $upload_warehouse;
			}	
			
			$where['id_warehouse'] = $id_warehouse;
			$data_warehouse = array(
					'tanggal_warehouse' => $_POST['tanggal_warehouse'],
					'upload_warehouse' => $upload_warehouse2,
					'id_user' => $_POST['id_user'],
					'id_warehouse'=>$id_warehouse
				);
			$this->m_general->edit("tbl_warehouse", $where, $data_warehouse);
			
			$this->m_general->hapus("tbl_warehouse_detail", $where);
			$jumlah_id_po_detail = count($this->input->post('id_po_detail'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_po_detail; $x++){
				if($_POST['id_po_detail'][$x]!=""){
					$id_warehouse_detail = $this->m_general->bacaidterakhir("tbl_warehouse_detail", "id_warehouse_detail");
					$data_detail = array(
						'id_warehouse_detail'=>$id_warehouse_detail,
						'qty_warehouse_detail'=>$_POST['qty_warehouse_detail'][$x],
						'id_po_detail'=>$_POST['id_po_detail'][$x],
						'id_warehouse'=>$id_warehouse
					);
					$this->m_general->add("tbl_warehouse_detail", $data_detail);		
				}
			}
			redirect('warehouse/barang_keluar');
    }	
	public function barang_keluar_aksi_hapus($id_warehouse){
			$where['id_warehouse'] = $id_warehouse;
			$this->m_general->hapus("tbl_warehouse", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('warehouse/barang_keluar');
	}
	
	public function barang_keluar_detail($id_warehouse)
	{
		$where = array("id_warehouse" => $id_warehouse);
		$data['tbl_warehouse'] = $this->m_general->view_by("tbl_warehouse",$where);
		$data['tbl_warehouse_detail'] = $this->db->query("select c.nama_produk, a.qty_warehouse_detail, a.id_warehouse_detail, a.id_po_detail
from tbl_warehouse_detail a 
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk c on b.id_produk=c.id_produk 
where a.id_warehouse='$id_warehouse' order by a.id_warehouse_detail ASC")->result();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_warehouse']->id_user));
		$this->load->view("v_admin_header");
		$this->load->view('v_warehouse_barang_keluar_detail', $data);
		$this->load->view("v_admin_footer");
	}
}