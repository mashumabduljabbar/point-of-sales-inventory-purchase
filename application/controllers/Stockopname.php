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
            select b.id_produk, a.tanggal_stockopname, b.nama_produk, a.qty_stocksistem, a.qty_stokcopname
from tbl_stockopname a
left join tbl_produk b on a.id_produk=b.id_produk
order by a.tanggal_stockopname DESC, b.nama_produk ASC
        )temp";
		
        $primaryKey = 'id_produk';
        $columns = array(
        array( 'db' => 'tanggal_stockopname',     'dt' => 0 ),
        array( 'db' => 'nama_produk',        'dt' => 1 ),
        array( 'db' => 'qty_stocksistem',        'dt' => 2 ),
        array( 'db' => 'qty_stokcopname',        'dt' => 3 ),
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
	public function stockopname_tambah()
    {
		$data['tbl_stockopname'] = $this->db->query("SELECT table4.id_produk, table4.nama_produk, 
IFNULL(table3.sisa,0) as stocksistem
FROM (SELECT table1.id_produk, IFNULL(table2.nama_produk,table1.nama_produk) as nama_produk, 
@masuk := IFNULL(table2.jumlah,0) as jumlah_masuk,
@keluar := table1.jumlah as jumlah_keluar, 
@sisa := ROUND(@masuk-@keluar,0) as sisa
FROM (select e.id_produk, e.nama_produk, sum(a.qty_po_detail) as jumlah
from tbl_po_detail a
join tbl_produk e on e.id_produk=a.id_produk
join tbl_po c on c.id_po=a.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='0'
group by e.id_produk) as table1
LEFT JOIN
(select e.id_produk, e.nama_produk, sum(a.qty_po_detail) as jumlah
from tbl_po_detail a
join tbl_produk e on e.id_produk=a.id_produk
join tbl_po c on c.id_po=a.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='1'
group by e.id_produk) as table2
ON table1.id_produk=table2.id_produk
UNION
SELECT table2.id_produk, IFNULL(table1.nama_produk,table2.nama_produk) as nama_produk, 
@masuk := table2.jumlah as jumlah_masuk,
@keluar := IFNULL(table1.jumlah,0) as jumlah_keluar, 
@sisa := ROUND(@masuk-@keluar,0) as sisa
FROM (select e.id_produk, e.nama_produk, sum(a.qty_po_detail) as jumlah
from tbl_po_detail a
join tbl_produk e on e.id_produk=a.id_produk
join tbl_po c on c.id_po=a.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='0'
group by e.id_produk) as table1
RIGHT JOIN
(select e.id_produk, e.nama_produk, sum(a.qty_po_detail) as jumlah
from tbl_po_detail a
join tbl_produk e on e.id_produk=a.id_produk
join tbl_po c on c.id_po=a.id_po
join tbl_rfq d on d.id_rfq=c.id_rfq
where d.jenis_rfq='1'
group by e.id_produk) as table2
ON table1.id_produk=table2.id_produk) as table3
RIGHT JOIN tbl_produk table4 ON table3.id_produk=table4.id_produk 
order by id_produk ASC")->result();
		$this->load->view("v_admin_header");
        $this->load->view("v_stockopname_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function stockopname_aksi_tambah()
    {
		$jumlah_id_produk = count($this->input->post('id_produk'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_produk; $x++){
				$id_stockopname = $this->m_general->bacaidterakhir("tbl_stockopname", "id_stockopname");
					$data_detail = array(
						'id_stockopname'=>$id_stockopname,
						'tanggal_stockopname'=>$_POST['tanggal_stockopname'][$x],
						'id_produk'=>$_POST['id_produk'][$x],
						'qty_stocksistem'=>$_POST['qty_stocksistem'][$x],
						'qty_stokcopname'=>$_POST['qty_stokcopname'][$x]
					);
					$this->m_general->add("tbl_stockopname", $data_detail);	
			}
			
			redirect('stockopname');	
    }
	public function stockopname_ubah($tanggal="")
    {
		$data['tbl_stockopname'] = $this->db->query("select a.id_stockopname, b.id_produk, a.tanggal_stockopname, b.nama_produk, a.qty_stocksistem, a.qty_stokcopname
from tbl_stockopname a
left join tbl_produk b on a.id_produk=b.id_produk
where a.tanggal_stockopname='$tanggal'
order by a.tanggal_stockopname DESC, b.nama_produk ASC")->result();
		
		$data['tanggal'] = $this->db->query("select distinct(a.tanggal_stockopname)
from tbl_stockopname a
order by a.tanggal_stockopname DESC")->result();
		$this->load->view("v_admin_header");
        $this->load->view("v_stockopname_edit",$data);
		$this->load->view("v_admin_footer");
    }
	public function stockopname_aksi_ubah()
    {
		$tanggal_stockopname = $this->input->post('tanggal_stockopname');
		$where['tanggal_stockopname'] = $tanggal_stockopname;
		$this->m_general->hapus("tbl_stockopname", $where);
		
		$jumlah_id_produk = count($this->input->post('id_produk'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_produk; $x++){
					$data_detail = array(
						'id_stockopname'=>$_POST['id_stockopname'][$x],
						'tanggal_stockopname'=>$_POST['tanggal_stockopname'],
						'id_produk'=>$_POST['id_produk'][$x],
						'qty_stocksistem'=>$_POST['qty_stocksistem'][$x],
						'qty_stokcopname'=>$_POST['qty_stokcopname'][$x]
					);
					$this->m_general->add("tbl_stockopname", $data_detail);	
			}
			
			redirect('stockopname');	
    }
		
}