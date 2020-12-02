<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Stockopname extends CI_Controller {
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
        $this->load->view("v_stockopname");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_stockopname()
	{
		$table = "
        (
              SELECT table4.id_produk, table4.nama_produk, 
IFNULL(table3.jumlah_masuk,0) as jumlah_masuk, IFNULL(table3.jumlah_keluar,0) as jumlah_keluar, IFNULL(table3.sisa,0) as sisa
FROM (SELECT table1.id_produk, IFNULL(table2.nama_produk,table1.nama_produk) as nama_produk, 
@masuk := IFNULL(table2.jumlah,0) as jumlah_masuk,
@keluar := table1.jumlah as jumlah_keluar, 
@sisa := ROUND(@masuk-@keluar,0) as sisa
FROM (select e.id_produk, e.nama_produk, sum(a.qty_warehouse_detail) as jumlah
from tbl_warehouse_detail a
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk e on e.id_produk=b.id_produk
join tbl_po c on c.id_po=b.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='0'
group by e.id_produk) as table1
LEFT JOIN
(select e.id_produk, e.nama_produk, sum(a.qty_warehouse_detail) as jumlah
from tbl_warehouse_detail a
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk e on e.id_produk=b.id_produk
join tbl_po c on c.id_po=b.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='1'
group by e.id_produk) as table2
ON table1.id_produk=table2.id_produk
UNION
SELECT table2.id_produk, IFNULL(table1.nama_produk,table2.nama_produk) as nama_produk, 
@masuk := table2.jumlah as jumlah_masuk,
@keluar := IFNULL(table1.jumlah,0) as jumlah_keluar, 
@sisa := ROUND(@masuk-@keluar,0) as sisa
FROM (select e.id_produk, e.nama_produk, sum(a.qty_warehouse_detail) as jumlah
from tbl_warehouse_detail a
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk e on e.id_produk=b.id_produk
join tbl_po c on c.id_po=b.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='0'
group by e.id_produk) as table1
RIGHT JOIN
(select e.id_produk, e.nama_produk, sum(a.qty_warehouse_detail) as jumlah
from tbl_warehouse_detail a
join tbl_po_detail b on a.id_po_detail=b.id_po_detail
join tbl_produk e on e.id_produk=b.id_produk
join tbl_po c on c.id_po=b.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='1'
group by e.id_produk) as table2
ON table1.id_produk=table2.id_produk) as table3
RIGHT JOIN tbl_produk table4 ON table3.id_produk=table4.id_produk 
        )temp";
		
        $primaryKey = 'id_produk';
        $columns = array(
        array( 'db' => 'id_produk',     'dt' => 0 ),
        array( 'db' => 'nama_produk',        'dt' => 1 ),
        array( 'db' => 'jumlah_masuk',        'dt' => 2 ),
        array( 'db' => 'jumlah_keluar',        'dt' => 3 ),
        array( 'db' => 'sisa',        'dt' => 4 ),
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
}