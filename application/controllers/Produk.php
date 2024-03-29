<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Produk extends CI_Controller {
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
        $this->load->view("v_produk");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_produk()
	{
		$table = "
        (
            SELECT khalid.*, IFNULL(ibrahim.stock,0) as stock FROM (SELECT
                a.*, CASE
					WHEN image_produk='' OR image_produk IS NULL THEN 'default.jpg'
					ELSE image_produk
				END as imageproduk, b.nama_kategori, c.nama_brand, d.nama_unit
            FROM
                tbl_produk a
				join tbl_kategori b on a.id_kategori=b.id_kategori
				join tbl_brand c on a.id_brand=c.id_brand
				join tbl_unit d on a.id_unit=d.id_unit) as khalid
left join (select tablex.id_produk, tablex.sisa as stock
from (select table3.id_produk, IFNULL(table4.sisa,0) as sisa from tbl_produk table3
left join 
(select table1.id_produk, table1.qty_po_detail-table2.qty_po_detail as sisa
from (select d.id_produk, a.qty_po_detail from tbl_po_detail a
join tbl_po b on a.id_po=b.id_po
join tbl_rfq c on b.id_rfq=c.id_rfq
join tbl_produk d on d.id_produk=a.id_produk
where c.jenis_rfq='1') as table1
left join 
(select d.id_produk, a.qty_po_detail from tbl_po_detail a
join tbl_po b on a.id_po=b.id_po
join tbl_rfq c on b.id_rfq=c.id_rfq
join tbl_produk d on d.id_produk=a.id_produk
where c.jenis_rfq='0') as table2
on table1.id_produk=table2.id_produk
UNION
select table1.id_produk, table1.qty_po_detail-table2.qty_po_detail as sisa
from (select d.id_produk, a.qty_po_detail from tbl_po_detail a
join tbl_po b on a.id_po=b.id_po
join tbl_rfq c on b.id_rfq=c.id_rfq
join tbl_produk d on d.id_produk=a.id_produk
where c.jenis_rfq='1') as table1
right join 
(select d.id_produk, a.qty_po_detail from tbl_po_detail a
join tbl_po b on a.id_po=b.id_po
join tbl_rfq c on b.id_rfq=c.id_rfq
join tbl_produk d on d.id_produk=a.id_produk
where c.jenis_rfq='0') as table2
on table1.id_produk=table2.id_produk) as table4
on table3.id_produk=table4.id_produk) as tablex) as ibrahim
on khalid.id_produk=ibrahim.id_produk
        )temp";
		
        $primaryKey = 'id_produk';
        $columns = array(
        array( 'db' => 'id_produk',     'dt' => 0 ),
        array( 'db' => 'nama_produk',        'dt' => 1 ),
        array( 'db' => 'size_produk',        'dt' => 2 ),
        array( 'db' => 'cost_produk',        'dt' => 3 ),
        array( 'db' => 'price_produk',        'dt' => 4 ),
        array( 'db' => 'stock',        'dt' => 5 ),
        array( 'db' => 'nama_kategori',        'dt' => 6 ),
        array( 'db' => 'nama_brand',        'dt' => 7 ),
        array( 'db' => 'nama_unit',        'dt' => 8 ),
        array( 'db' => 'imageproduk',     'dt' => 9 ),
        array( 'db' => 'id_produk',     'dt' => 10 ),
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
	
	public function produk()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_produk");
        $this->load->view("v_admin_footer");
    }		
	public function produk_tambah()
    {
		$data['tbl_kategori'] = $this->m_general->view_order("tbl_kategori", $order ="nama_kategori ASC");
		$data['tbl_brand'] = $this->m_general->view_order("tbl_brand", $order ="nama_brand ASC");
		$data['tbl_unit'] = $this->m_general->view_order("tbl_unit", $order ="nama_unit ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_produk_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function produk_ubah($id_produk)
	{
		$where = array("id_produk" => $id_produk);
		$data['tbl_produk'] = $this->m_general->view_by("tbl_produk",$where);
		$data['tbl_kategori'] = $this->m_general->view_order("tbl_kategori", $order ="nama_kategori ASC");
		$data['tbl_kategori_by'] = $this->m_general->view_by("tbl_kategori", array("id_kategori"=>$data['tbl_produk']->id_kategori));
		$data['tbl_brand'] = $this->m_general->view_order("tbl_brand", $order ="nama_brand ASC");
		$data['tbl_brand_by'] = $this->m_general->view_by("tbl_brand", array("id_brand"=>$data['tbl_produk']->id_brand));
		$data['tbl_unit'] = $this->m_general->view_order("tbl_unit", $order ="nama_unit ASC");
		$data['tbl_unit_by'] = $this->m_general->view_by("tbl_unit", array("id_unit"=>$data['tbl_produk']->id_unit));
		$this->load->view("v_admin_header");
		$this->load->view('v_produk_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function produk_aksi_tambah()
    {
			$_POST['id_produk'] = $this->m_general->bacaidterakhir("tbl_produk", "id_produk");
			$folder = "produk";
			$file_upload = $_FILES['userfiles'];
			$files = $file_upload;
			if($files['name'] != "" OR $files['name'] != NULL){
				$_POST['image_produk'] = $this->m_general->file_upload($files, $folder);
			}else{
				$_POST['image_produk'] = "";
			}
			$this->m_general->add("tbl_produk", $_POST);
			redirect('produk');
    }	
	public function produk_aksi_ubah($id_produk)
    {
			$image_produk = $this->input->post('image_produk');
			$where['id_produk'] = $id_produk;
			$tbl_produk = $this->m_general->view_by("tbl_produk",$where);
			$folder = "produk";
			$file_upload = $_FILES['userfiles'];
			$files = $file_upload;
			if($files['name'] != "" OR $files['name'] != NULL){
				$file = './assets/dist/img/produk/'.$tbl_produk->image_produk;
				if(is_readable($file)){
					unlink($file);
				}
				$_POST['image_produk'] = $this->m_general->file_upload($files, $folder);
			}else{
				$_POST['image_produk'] = $image_produk;
			}
			$this->m_general->edit("tbl_produk", $where, $_POST);
			redirect('produk');
    }	
	public function produk_aksi_hapus($id_produk){
			$where['id_produk'] = $id_produk;
			$this->m_general->hapus("tbl_produk", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('produk');
	}
	public function tbl_produk(){
		$tbl_produk = $this->db->query("select * from tbl_produk order by nama_produk ASC")->result_array();
		echo json_encode($tbl_produk);
	}
}