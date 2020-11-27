<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Rfqsales extends CI_Controller {
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
        $this->load->view("v_rfqsales");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_rfq()
	{
		$table = "
        (
              SELECT
                a.*,b.nama_customer,
                @subtotal := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as a,
                @diskon := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail*c.disc_rfq_detail/100),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as b,
                @tax := ROUND((@subtotal-@diskon)*a.tax_rfq/100,0) as c,
                @total := ROUND(@subtotal-@diskon+@tax,0) as d,
                
                FORMAT(@subtotal,0) as subtotal,
                FORMAT(@diskon,0) as diskon,
                FORMAT(@tax,0) as tax,
                FORMAT(@total,0) as total
                
            FROM
                tbl_rfq a
				join tbl_customer b on a.id_customer=b.id_customer
				where jenis_rfq='0'
        )temp";
		
        $primaryKey = 'id_rfq';
        $columns = array(
        array( 'db' => 'id_rfq',     'dt' => 0 ),
        array( 'db' => 'tanggal_rfq',        'dt' => 1 ),
        array( 'db' => 'nama_customer',        'dt' => 2 ),
        array( 'db' => 'subtotal',        'dt' => 3 ),
        array( 'db' => 'diskon',        'dt' => 4 ),
        array( 'db' => 'tax',        'dt' => 5 ),
        array( 'db' => 'total',        'dt' => 6 ),
        array( 'db' => 'id_rfq',     'dt' => 7 ),
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
			
	public function rfq_tambah()
    {
		$data['tbl_supplier'] = $this->m_general->view_order("tbl_supplier", $order ="nama_supplier ASC");
		$data['tbl_perusahaan'] = $this->m_general->view_order("tbl_perusahaan", $order ="nama_perusahaan ASC");
		$data['tbl_customer'] = $this->m_general->view_order("tbl_customer", $order ="nama_customer ASC");
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_rfqsales_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function rfq_ubah($id_rfq)
	{
		$where = array("id_rfq" => $id_rfq);
		$data['tbl_rfq'] = $this->m_general->view_by("tbl_rfq",$where);
		$data['tbl_supplier'] = $this->m_general->view_order("tbl_supplier", $order ="nama_supplier ASC");
		$data['tbl_supplier_by'] = $this->m_general->view_by("tbl_supplier", array("id_supplier"=>$data['tbl_rfq']->id_supplier));
		$data['tbl_customer'] = $this->m_general->view_order("tbl_customer", $order ="nama_customer ASC");
		$data['tbl_customer_by'] = $this->m_general->view_by("tbl_customer", array("id_customer"=>$data['tbl_rfq']->id_customer));
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", $order ="nama_user ASC");
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_rfq']->id_user));
		$data['tbl_rfq_detail'] = $this->db->query("select a.*, b.nama_produk from tbl_rfq_detail a 
join tbl_produk b on a.id_produk=b.id_produk where id_rfq='$id_rfq' order by id_rfq_detail ASC")->result();
		$this->load->view("v_admin_header");
		$this->load->view('v_rfqsales_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function rfq_aksi_tambah()
    {
			$id_rfq = $this->m_general->bacaidterakhir("tbl_rfq", "id_rfq");
			$id_perusahaan = $this->m_general->bacaidterakhir("tbl_perusahaan", "id_perusahaan");
				$data_rfq = array(
					'id_rfq' => $id_rfq,
					'tanggal_rfq' => $_POST['tanggal_rfq'],
					'alamat_pengiriman_rfq' => $_POST['alamat_pengiriman_rfq'],
					'tax_rfq' => $_POST['tax_rfq'],
					'jenis_rfq' => 0,
					'id_user' => $_POST['id_user'],
					'id_perusahaan' => $id_perusahaan-1,
					'id_customer' => $_POST['id_customer']
				);
				$this->m_general->add("tbl_rfq", $data_rfq);
			
			$jumlah_id_produk = count($this->input->post('id_produk'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_produk; $x++){
				if($_POST['id_produk'][$x]!=""){
					$id_rfq_detail = $this->m_general->bacaidterakhir("tbl_rfq_detail", "id_rfq_detail");
					$data_detail = array(
						'id_rfq_detail'=>$id_rfq_detail,
						'harga_rfq_detail'=>$_POST['harga_rfq_detail'][$x],
						'qty_rfq_detail'=>$_POST['qty_rfq_detail'][$x],
						'disc_rfq_detail'=>$_POST['disc_rfq_detail'][$x],
						'id_produk'=>$_POST['id_produk'][$x],
						'id_rfq'=>$id_rfq
					);
					$this->m_general->add("tbl_rfq_detail", $data_detail);	
				}
			}
			
			redirect('rfqsales');
    }	
	public function rfq_aksi_ubah($id_rfq)
    {
			$where['id_rfq'] = $id_rfq;
			$data_rfq = array(
					'tanggal_rfq' => $_POST['tanggal_rfq'],
					'alamat_pengiriman_rfq' => $_POST['alamat_pengiriman_rfq'],
					'tax_rfq' => $_POST['tax_rfq'],
					'id_user' => $_POST['id_user'],
					'id_customer' => $_POST['id_customer']
				);
				$this->m_general->edit("tbl_rfq", $where, $data_rfq);
			
			$this->m_general->hapus("tbl_rfq_detail", $where);
			$jumlah_id_produk = count($this->input->post('id_produk'), COUNT_RECURSIVE);
			for($x=0; $x<$jumlah_id_produk; $x++){
				if($_POST['id_produk'][$x]!=""){
					$id_rfq_detail = $this->m_general->bacaidterakhir("tbl_rfq_detail", "id_rfq_detail");
					$data_detail = array(
						'id_rfq_detail'=>$id_rfq_detail,
						'harga_rfq_detail'=>$_POST['harga_rfq_detail'][$x],
						'qty_rfq_detail'=>$_POST['qty_rfq_detail'][$x],
						'disc_rfq_detail'=>$_POST['disc_rfq_detail'][$x],
						'id_produk'=>$_POST['id_produk'][$x],
						'id_rfq'=>$id_rfq
					);
					$this->m_general->add("tbl_rfq_detail", $data_detail);	
				}
			}
			redirect('rfqsales');
    }	
	public function rfq_aksi_hapus($id_rfq){
			$where['id_rfq'] = $id_rfq;
			$this->m_general->hapus("tbl_rfq", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('rfqsales');
	}
	public function rfq_detail($id_rfq)
	{
		$data['tbl_rfq'] = $this->db->query("SELECT
                a.*,b.nama_customer,
                @subtotal := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as a,
                @diskon := (select ROUND(sum(c.harga_rfq_detail*c.qty_rfq_detail*c.disc_rfq_detail/100),0) from tbl_rfq_detail c where c.id_rfq=a.id_rfq group by c.id_rfq) as b,
                @tax := ROUND((@subtotal-@diskon)*a.tax_rfq/100,0) as c,
                @total := ROUND(@subtotal-@diskon+@tax,0) as d,
                
				concat(tax_rfq,'%') as tax_rfq,
				
                FORMAT(@subtotal,0) as subtotal,
                FORMAT(@diskon,0) as diskon,
                FORMAT(@tax,0) as tax,
                FORMAT(@total,0) as total
                
            FROM
                tbl_rfq a
				join tbl_customer b on a.id_customer=b.id_customer
				where id_rfq='$id_rfq'")->row();
		$data['tbl_supplier_by'] = $this->m_general->view_by("tbl_supplier", array("id_supplier"=>$data['tbl_rfq']->id_supplier));
		$data['tbl_perusahaan_by'] = $this->m_general->view_by("tbl_perusahaan", array("id_perusahaan"=>$data['tbl_rfq']->id_perusahaan));
		$data['tbl_customer_by'] = $this->m_general->view_by("tbl_customer", array("id_customer"=>$data['tbl_rfq']->id_customer));
		$data['tbl_user_by'] = $this->m_general->view_by("tbl_user", array("id_user"=>$data['tbl_rfq']->id_user));
		$data['tbl_rfq_detail'] = $this->db->query("select b.nama_produk, 
@harga := a.harga_rfq_detail as harga_rfq_detail,
@qty := a.qty_rfq_detail as qty_rfq_detail,
@subtotal := @harga*@qty as subtotal_rfq_detail,
@disc := ROUND(@subtotal*a.disc_rfq_detail/100,0) as disc_rfq_detail,
@total := ROUND(@subtotal-@disc,0) as total_rfq_detail,
@tax := ROUND(@total*c.tax_rfq/100,0) as tax_rfq,
FORMAT(ROUND(@total*c.tax_rfq/100,0),0) as pajak,

FORMAT(@harga,0) as harga,
FORMAT(@qty,0) as qty,
FORMAT(@subtotal,0) as subtotal,
CONCAT(a.disc_rfq_detail,' %') as discount,
FORMAT(@total+@tax,0) as total

from tbl_rfq_detail a 
join tbl_produk b on a.id_produk=b.id_produk 
join tbl_rfq c on c.id_rfq=a.id_rfq
where a.id_rfq='$id_rfq' order by id_rfq_detail ASC")->result();
		$this->load->view("v_admin_header");
		$this->load->view('v_rfqsales_detail', $data);
		$this->load->view("v_admin_footer");
	}
	public function json($id_rfq){
		$tbl_rfq = $this->db->query("select * from tbl_rfq where id_rfq='$id_rfq'")->result_array();
		echo json_encode($tbl_rfq);
	}
}