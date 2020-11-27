<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class So extends CI_Controller {
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
        $this->load->view("v_so");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_so()
	{
		$table = "
        (
              SELECT
                a.*,c.nama_customer,
                @subtotal := (select ROUND(sum(c.harga_po_detail*c.qty_po_detail),0) from tbl_po_detail c where c.id_po=a.id_po group by c.id_po) as a,
                @diskon := (select ROUND(sum(c.harga_po_detail*c.qty_po_detail*c.disc_po_detail/100),0) from tbl_po_detail c where c.id_po=a.id_po group by c.id_po) as b,
                @tax := ROUND((@subtotal-@diskon)*a.tax_po/100,0) as c,
                @total := ROUND(@subtotal-@diskon+@tax,0) as d,
                
                FORMAT(@subtotal,0) as subtotal,
                FORMAT(@diskon,0) as diskon,
                FORMAT(@tax,0) as tax,
                FORMAT(@total,0) as total
                
            FROM
                tbl_po a
				join tbl_rfq b on a.id_rfq=b.id_rfq
				join tbl_customer c on c.id_customer=b.id_customer
        )temp";
		
        $primaryKey = 'id_po';
        $columns = array(
        array( 'db' => 'id_po',     'dt' => 0 ),
        array( 'db' => 'tanggal_po',        'dt' => 1 ),
        array( 'db' => 'nama_customer',        'dt' => 2 ),
        array( 'db' => 'subtotal',        'dt' => 3 ),
        array( 'db' => 'diskon',        'dt' => 4 ),
        array( 'db' => 'tax',        'dt' => 5 ),
        array( 'db' => 'total',        'dt' => 6 ),
        array( 'db' => 'id_po',     'dt' => 7 ),
        array( 'db' => 'id_rfq',     'dt' => 8 ),
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
			
	public function so_tambah($id_rfq="")
    {
		$data['tbl_rfq'] = $this->db->query("select a.id_rfq, CONCAT('RFQ-',a.id_rfq,' a.n ',b.nama_customer) as nama_customer from tbl_rfq a
join tbl_customer b on a.id_customer=b.id_customer order by a.id_rfq ASC")->result();
$data['tbl_rfq_by'] = $this->db->query("SELECT
                a.*,CONCAT('RFQ-',a.id_rfq,' a.n ',b.nama_customer) as nama_customer,
                @subtotal := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as a,
                @diskon := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail*c.disc_rfq_detail/100),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as b,
                @tax := ROUND((@subtotal-@diskon)*a.tax_rfq/100,0) as c,
                @total := ROUND(@subtotal-@diskon+@tax,0) as d,
                
				concat(tax_rfq,'%') as tax_rfq,
				a.tax_rfq as pajak,
				
                FORMAT(@subtotal,0) as subtotal,
                FORMAT(@diskon,0) as diskon,
                FORMAT(@tax,0) as tax,
                FORMAT(@total,0) as total
                
            FROM
                tbl_rfq a
				join tbl_customer b on a.id_customer=b.id_customer
				where id_rfq='$id_rfq'")->row();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_rfq_detail'] = $this->db->query("select a.*, b.nama_produk from tbl_rfq_detail a 
join tbl_produk b on a.id_produk=b.id_produk where id_rfq='$id_rfq' order by id_rfq_detail ASC")->result();
		$this->load->view("v_admin_header");
        $this->load->view("v_so_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function so_ubah($id_po)
	{
		$where = array("id_po" => $id_po);
		$data['tbl_po'] = $this->m_general->view_by("tbl_po",$where);
		$data['tbl_rfq'] = $this->db->query("select a.id_rfq, CONCAT('RFQ-',a.id_rfq,' a.n ',b.nama_customer) as nama_customer from tbl_rfq a
join tbl_customer b on a.id_customer=b.id_customer order by a.id_rfq ASC")->result();
$data['tbl_rfq_by'] = $this->db->query("SELECT
                a.*,CONCAT('RFQ-',a.id_rfq,' a.n ',b.nama_customer) as nama_customer,
                @subtotal := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as a,
                @diskon := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail*c.disc_rfq_detail/100),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as b,
                @tax := ROUND((@subtotal-@diskon)*a.tax_rfq/100,0) as c,
                @total := ROUND(@subtotal-@diskon+@tax,0) as d,
                
				concat(tax_rfq,'%') as tax_rfq,
				a.tax_rfq as pajak,
				
                FORMAT(@subtotal,0) as subtotal,
                FORMAT(@diskon,0) as diskon,
                FORMAT(@tax,0) as tax,
                FORMAT(@total,0) as total
                
            FROM
                tbl_rfq a
				join tbl_customer b on a.id_customer=b.id_customer
				join tbl_po c on c.id_rfq=a.id_rfq
				where c.id_po='$id_po'")->row();
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_po']->id_user));
		$data['tbl_po_detail'] = $this->db->query("select a.*, b.nama_produk from tbl_po_detail a 
join tbl_produk b on a.id_produk=b.id_produk where id_po='$id_po' order by id_po_detail ASC")->result();
		$this->load->view("v_admin_header");
		$this->load->view('v_so_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function so_aksi_tambah()
    {
			$id_po = $this->m_general->bacaidterakhir("tbl_po", "id_po");
				$data_so = array(
					'id_po' => $id_po,
					'tanggal_po' => $_POST['tanggal_po'],
					'alamat_pengiriman_po' => $_POST['alamat_pengiriman_po'],
					'tax_po' => $_POST['tax_po'],
					'status_po' => 0,
					'id_user' => $_POST['id_user'],
					'id_rfq' => $_POST['id_rfq']
				);
				$this->m_general->add("tbl_po", $data_so);
			
			$jumlah_id_produk = count($this->input->post('id_produk'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_produk; $x++){
				if($_POST['id_produk'][$x]!=""){
					$id_po_detail = $this->m_general->bacaidterakhir("tbl_po_detail", "id_po_detail");
					$data_detail = array(
						'id_po_detail'=>$id_po_detail,
						'harga_po_detail'=>$_POST['harga_po_detail'][$x],
						'qty_po_detail'=>$_POST['qty_po_detail'][$x],
						'disc_po_detail'=>$_POST['disc_po_detail'][$x],
						'id_produk'=>$_POST['id_produk'][$x],
						'id_po'=>$id_po
					);
					$this->m_general->add("tbl_po_detail", $data_detail);	
				}
			}
			
			redirect('so');
    }	
	public function so_aksi_ubah($id_po)
    {
			$where['id_po'] = $id_po;
			$data_so = array(
					'tanggal_po' => $_POST['tanggal_po'],
					'alamat_pengiriman_po' => $_POST['alamat_pengiriman_po'],
					'tax_po' => $_POST['tax_po'],
					'id_user' => $_POST['id_user'],
					'id_rfq' => $_POST['id_rfq']
				);
				$this->m_general->edit("tbl_po", $where, $data_so);
			
			$this->m_general->hapus("tbl_po_detail", $where);
			$jumlah_id_produk = count($this->input->post('id_produk'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_produk; $x++){
				if($_POST['id_produk'][$x]!=""){
					$id_po_detail = $this->m_general->bacaidterakhir("tbl_po_detail", "id_po_detail");
					$data_detail = array(
						'id_po_detail'=>$id_po_detail,
						'harga_po_detail'=>$_POST['harga_po_detail'][$x],
						'qty_po_detail'=>$_POST['qty_po_detail'][$x],
						'disc_po_detail'=>$_POST['disc_po_detail'][$x],
						'id_produk'=>$_POST['id_produk'][$x],
						'id_po'=>$id_po
					);
					$this->m_general->add("tbl_po_detail", $data_detail);	
				}
			}
			redirect('so');
    }	
	public function so_aksi_hapus($id_po){
			$where['id_po'] = $id_po;
			$this->m_general->hapus("tbl_po", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('so');
	}
	public function so_detail($id_po)
	{
		$data['tbl_po'] = $this->db->query("SELECT
                a.*,c.nama_customer,
                @subtotal := (select ROUND(sum(c.harga_po_detail*c.qty_po_detail),0) from tbl_po_detail c where c.id_po=a.id_po group by c.id_po) as a,
                @diskon := (select ROUND(sum(c.harga_po_detail*c.qty_po_detail*c.disc_po_detail/100),0) from tbl_po_detail c where c.id_po=a.id_po group by c.id_po) as b,
                @tax := ROUND((@subtotal-@diskon)*a.tax_po/100,0) as c,
                @total := ROUND(@subtotal-@diskon+@tax,0) as d,
                
				concat(tax_po,'%') as tax_po,
				
                FORMAT(@subtotal,0) as subtotal,
                FORMAT(@diskon,0) as diskon,
                FORMAT(@tax,0) as tax,
                FORMAT(@total,0) as total
                
            FROM
                tbl_po a
				join tbl_rfq b on a.id_rfq=b.id_rfq
				join tbl_customer c on c.id_customer=b.id_customer
				where a.id_po='$id_po'")->row();
		$data['tbl_supplier_by'] = $this->m_general->view_by("tbl_supplier", array("id_supplier"=>$data['tbl_po']->id_supplier));
		$data['tbl_perusahaan_by'] = $this->m_general->view_by("tbl_perusahaan", array("id_perusahaan"=>$data['tbl_po']->id_perusahaan));
		$data['tbl_so_by'] = $this->m_general->view_by("tbl_rfq", array("id_rfq"=>$data['tbl_po']->id_rfq));
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_po']->id_user));
		$data['tbl_po_detail'] = $this->db->query("select b.nama_produk, 
@harga := a.harga_po_detail as harga_po_detail,
@qty := a.qty_po_detail as qty_po_detail,
@subtotal := @harga*@qty as subtotal_po_detail,
@disc := ROUND(@subtotal*a.disc_po_detail/100,0) as disc_po_detail,
@total := ROUND(@subtotal-@disc,0) as total_po_detail,
@tax := ROUND(@total*c.tax_po/100,0) as tax_po,
FORMAT(ROUND(@total*c.tax_po/100,0),0) as pajak,

FORMAT(@harga,0) as harga,
FORMAT(@qty,0) as qty,
FORMAT(@subtotal,0) as subtotal,
CONCAT(a.disc_po_detail,' %') as discount,
FORMAT(@total+@tax,0) as total

from tbl_po_detail a 
join tbl_produk b on a.id_produk=b.id_produk 
join tbl_po c on c.id_po=a.id_po
where a.id_po='$id_po' order by id_po_detail ASC")->result();
		$this->load->view("v_admin_header");
		$this->load->view('v_so_detail', $data);
		$this->load->view("v_admin_footer");
	}
}