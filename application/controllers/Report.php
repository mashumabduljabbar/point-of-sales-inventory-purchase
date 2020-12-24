<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Report extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function laporanpembelian($periode="")
    {
		if($periode!=""){
			$explode = explode("-",$periode); 
		}else{
			$explode = array("","");
		}
		$data['laporanpembelian'] = $this->db->query("select DISTINCT(CONCAT(YEAR(a.tanggal_po),'-',MONTH(a.tanggal_po))) as periode from tbl_po_detail c
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
where b.jenis_rfq='1' ## Pembelian
order by tanggal_po DESC")->result();
		$data['total'] = $this->db->query("SELECT SUM(tablex.subtotaldiskon) as total FROM (select t1.tanggal_po, t1.nama_produk, sum(t2.qty_po_detail) as qty_po_detail, t2.subtotaldiskon, FORMAT(t2.subtotaldiskon,0) as format FROM 
(select a.id_po, a.tanggal_po, c.id_produk, d.nama_produk, c.qty_po_detail, e.nama_supplier
from tbl_po_detail c
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
join tbl_supplier e on e.id_supplier=b.id_supplier
where b.jenis_rfq='1' ## Pembelian
and MONTH(a.tanggal_po)='$explode[1]' and YEAR(a.tanggal_po)='$explode[0]'
group by a.tanggal_po, c.id_produk
) as t1
left join 
(select w.id_po, w.id_produk, w.qty_po_detail, w.harga_po_detail, concat(w.disc_po_detail,' %') as diskon, 
ROUND((w.harga_po_detail*w.qty_po_detail),0) as subtotal,
ROUND((w.harga_po_detail*w.qty_po_detail)-(w.harga_po_detail*w.qty_po_detail*w.disc_po_detail*0.01),0) as subtotaldiskon
from tbl_po_detail w ) as t2 on t1.id_produk=t2.id_produk and t1.id_po=t2.id_po
group by t1.tanggal_po, t1.id_produk, t1.id_po
order by t1.tanggal_po ASC) as tablex")->row();
		$this->load->view("v_admin_header");
        $this->load->view("v_laporanpembelian", $data);
        $this->load->view("v_admin_footer");
    }

	public function get_data_master_laporanpembelian($periode="")
	{
		$explode = explode("-",$periode); 
		$table = "
        (
           select t1.id_po, t1.tanggal_po, t1.nama_supplier, t1.nama_produk, sum(t2.qty_po_detail) as qty_po_detail, t2.subtotaldiskon, FORMAT(t2.subtotaldiskon,0) as format FROM 
(select a.id_po, a.tanggal_po, c.id_produk, d.nama_produk, c.qty_po_detail, e.nama_supplier
from tbl_po_detail c
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
join tbl_supplier e on e.id_supplier=b.id_supplier
where b.jenis_rfq='1' ## Pembelian
and MONTH(a.tanggal_po)='$explode[1]' and YEAR(a.tanggal_po)='$explode[0]'
group by a.tanggal_po, c.id_produk
) as t1
left join 
(select w.id_po, w.id_produk, w.qty_po_detail, w.harga_po_detail, concat(w.disc_po_detail,' %') as diskon, 
ROUND((w.harga_po_detail*w.qty_po_detail),0) as subtotal,
ROUND((w.harga_po_detail*w.qty_po_detail)-(w.harga_po_detail*w.qty_po_detail*w.disc_po_detail*0.01),0) as subtotaldiskon
from tbl_po_detail w ) as t2 on t1.id_produk=t2.id_produk and t1.id_po=t2.id_po
group by t1.tanggal_po, t1.id_produk, t1.id_po
order by t1.tanggal_po ASC
        )temp";
		
        $primaryKey = 'id_po';
        $columns = array(
        array( 'db' => 'tanggal_po',     'dt' => 0 ),
        array( 'db' => 'nama_supplier',        'dt' => 1 ),
        array( 'db' => 'nama_produk',        'dt' => 2 ),
        array( 'db' => 'qty_po_detail',        'dt' => 3 ),
        array( 'db' => 'format',        'dt' => 4 ),
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
	
	public function laporanpenjualan($periode="")
    {
		if($periode!=""){
			$explode = explode("-",$periode); 
		}else{
			$explode = array("","");
		}
		$data['laporanpenjualan'] = $this->db->query("select DISTINCT(CONCAT(YEAR(a.tanggal_po),'-',MONTH(a.tanggal_po))) as periode from tbl_po_detail c
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
where b.jenis_rfq='0' ## Penjualan
order by tanggal_po DESC")->result();
		$data['total'] = $this->db->query("SELECT SUM(tablex.subtotaldiskon) as total FROM (select t1.tanggal_po, t1.nama_produk, sum(t2.qty_po_detail) as qty_po_detail, t2.subtotaldiskon, FORMAT(t2.subtotaldiskon,0) as format 
FROM (select a.id_po, a.tanggal_po, c.id_produk, d.nama_produk, c.qty_po_detail, e.nama_customer from tbl_po_detail c
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
join tbl_customer e on e.id_customer=b.id_customer
where b.jenis_rfq='0' ## Penjualan
and MONTH(a.tanggal_po)='$explode[1]' and YEAR(a.tanggal_po)='$explode[0]'
group by a.tanggal_po, c.id_produk) as t1
left join 
(select w.id_po, w.id_produk, w.qty_po_detail, w.harga_po_detail, concat(w.disc_po_detail,' %') as diskon, 
ROUND((w.harga_po_detail*w.qty_po_detail),0) as subtotal,
ROUND((w.harga_po_detail*w.qty_po_detail)-(w.harga_po_detail*w.qty_po_detail*w.disc_po_detail*0.01),0) as subtotaldiskon
from tbl_po_detail w ) as t2 on t1.id_produk=t2.id_produk and t1.id_po=t2.id_po
group by t1.tanggal_po, t1.id_produk, t1.id_po
order by t1.tanggal_po ASC) as tablex")->row();
		$this->load->view("v_admin_header");
        $this->load->view("v_laporanpenjualan", $data);
        $this->load->view("v_admin_footer");
    }

	public function get_data_master_laporanpenjualan($periode="")
	{
		$explode = explode("-",$periode); 
		$table = "
        (
              select t1.id_po, t1.tanggal_po, t1.nama_customer, t1.nama_produk, sum(t2.qty_po_detail) as qty_po_detail, t2.subtotaldiskon, FORMAT(t2.subtotaldiskon,0) as format 
FROM (select a.id_po, a.tanggal_po, c.id_produk, d.nama_produk, c.qty_po_detail, e.nama_customer from tbl_po_detail c
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
join tbl_customer e on e.id_customer=b.id_customer
where b.jenis_rfq='0' ## Penjualan
and MONTH(a.tanggal_po)='$explode[1]' and YEAR(a.tanggal_po)='$explode[0]'
group by a.tanggal_po, c.id_produk) as t1
left join 
(select w.id_po, w.id_produk, w.qty_po_detail, w.harga_po_detail, concat(w.disc_po_detail,' %') as diskon, 
ROUND((w.harga_po_detail*w.qty_po_detail),0) as subtotal,
ROUND((w.harga_po_detail*w.qty_po_detail)-(w.harga_po_detail*w.qty_po_detail*w.disc_po_detail*0.01),0) as subtotaldiskon
from tbl_po_detail w ) as t2 on t1.id_produk=t2.id_produk and t1.id_po=t2.id_po
group by t1.tanggal_po, t1.id_produk, t1.id_po
order by t1.tanggal_po ASC
        )temp";
		
        $primaryKey = 'id_po';
        $columns = array(
        array( 'db' => 'tanggal_po',     'dt' => 0 ),
        array( 'db' => 'nama_customer',        'dt' => 1 ),
        array( 'db' => 'nama_produk',        'dt' => 2 ),
        array( 'db' => 'qty_po_detail',        'dt' => 3 ),
        array( 'db' => 'format',        'dt' => 4 ),
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
	
	public function laporanbarangmasuk($periode="")
    {
		$data['laporanbarangmasuk'] = $this->db->query("select DISTINCT(CONCAT(YEAR(g.tanggal_warehouse),'-',MONTH(g.tanggal_warehouse))) as periode 
from tbl_warehouse_detail f
join tbl_warehouse g on g.id_warehouse=f.id_warehouse
join tbl_po_detail c on f.id_po_detail=c.id_po_detail
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
where b.jenis_rfq='1' ## Barang Masuk
order by tanggal_warehouse DESC")->result();
		$this->load->view("v_admin_header");
        $this->load->view("v_laporanbarangmasuk", $data);
        $this->load->view("v_admin_footer");
    }

	public function get_data_master_laporanbarangmasuk($periode="")
	{
		$explode = explode("-",$periode); 
		$table = "
        (
              select f.id_warehouse_detail, g.tanggal_warehouse, d.nama_produk, f.qty_warehouse_detail, e.nama_supplier 
from tbl_warehouse_detail f
join tbl_warehouse g on g.id_warehouse=f.id_warehouse
join tbl_po_detail c on f.id_po_detail=c.id_po_detail
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
join tbl_supplier e on e.id_supplier=b.id_supplier
where b.jenis_rfq='1' ## Barang Masuk
and MONTH(g.tanggal_warehouse)='$explode[1]' and YEAR(g.tanggal_warehouse)='$explode[0]'
order by tanggal_warehouse ASC
        )temp";
		
        $primaryKey = 'id_warehouse_detail';
        $columns = array(
        array( 'db' => 'tanggal_warehouse',     'dt' => 0 ),
        array( 'db' => 'nama_produk',        'dt' => 1 ),
        array( 'db' => 'qty_warehouse_detail',        'dt' => 2 ),
        array( 'db' => 'nama_supplier',        'dt' => 3 ),
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
	
	public function laporanbarangkeluar($periode="")
    {
		$data['laporanbarangkeluar'] = $this->db->query("select DISTINCT(CONCAT(YEAR(g.tanggal_warehouse),'-',MONTH(g.tanggal_warehouse))) as periode 
from tbl_warehouse_detail f
join tbl_warehouse g on g.id_warehouse=f.id_warehouse
join tbl_po_detail c on f.id_po_detail=c.id_po_detail
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
where b.jenis_rfq='0' ## Barang Keluar
order by tanggal_warehouse DESC")->result();
		$this->load->view("v_admin_header");
        $this->load->view("v_laporanbarangkeluar", $data);
        $this->load->view("v_admin_footer");
    }

	public function get_data_master_laporanbarangkeluar($periode="")
	{
		$explode = explode("-",$periode); 
		$table = "
        (
              select f.id_warehouse_detail, g.tanggal_warehouse, d.nama_produk, f.qty_warehouse_detail, e.nama_customer 
from tbl_warehouse_detail f
join tbl_warehouse g on g.id_warehouse=f.id_warehouse
join tbl_po_detail c on f.id_po_detail=c.id_po_detail
join tbl_po a on c.id_po=a.id_po
join tbl_produk d on d.id_produk=c.id_produk
join tbl_rfq b on a.id_rfq=b.id_rfq
join tbl_customer e on e.id_customer=b.id_customer
where b.jenis_rfq='0' ## Barang Keluar
and MONTH(g.tanggal_warehouse)='$explode[1]' and YEAR(g.tanggal_warehouse)='$explode[0]'
order by tanggal_warehouse ASC
        )temp";
		
        $primaryKey = 'id_warehouse_detail';
        $columns = array(
        array( 'db' => 'tanggal_warehouse',     'dt' => 0 ),
        array( 'db' => 'nama_produk',        'dt' => 1 ),
        array( 'db' => 'qty_warehouse_detail',        'dt' => 2 ),
        array( 'db' => 'nama_customer',        'dt' => 3 ),
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