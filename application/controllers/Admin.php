<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Admin extends CI_Controller {
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
        $this->load->view("v_admin_index");
        $this->load->view("v_admin_footer");
    }

	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_kategori()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_kategori
        )temp";
		
        $primaryKey = 'id_kategori';
        $columns = array(
        array( 'db' => 'id_kategori',     'dt' => 0 ),
        array( 'db' => 'nama_kategori',        'dt' => 1 ),
        array( 'db' => 'id_kategori',     'dt' => 2 ),
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
	
	public function kategori()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_kategori");
        $this->load->view("v_admin_footer");
    }		
	public function kategori_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_kategori_add");
		$this->load->view("v_admin_footer");
    }
	public function kategori_ubah($id_kategori)
	{
		$where = array("id_kategori" => $id_kategori);
		$data['tbl_kategori'] = $this->m_general->view_by("tbl_kategori",$where);
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_kategori_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function kategori_aksi_tambah()
    {
			$nama_kategori = $this->input->post('nama_kategori');
			$check_kategori = $this->m_general->countdata("tbl_kategori", array("nama_kategori" => $nama_kategori));
			if($check_kategori==0){
					$_POST['id_kategori'] = $this->m_general->bacaidterakhir("tbl_kategori", "id_kategori");
					$this->m_general->add("tbl_kategori", $_POST);
					redirect('admin/kategori');
			}else{
					redirect('admin/kategori_tambah/err');
			}
    }	
	public function kategori_aksi_ubah($id_kategori)
    {
			$nama_kategori = $this->input->post('nama_kategori');
			$check_kategori = $this->m_general->countdata("tbl_kategori", array("nama_kategori" => $nama_kategori));
			if($check_kategori==0){
					$where['id_kategori'] = $id_kategori;
					$this->m_general->edit("tbl_kategori", $where, $_POST);
					redirect('admin/kategori');
			}else{
					redirect('admin/kategori_ubah/'.$id_kategori.'/err');
			}
    }	
	public function kategori_aksi_hapus($id_kategori){
			$where['id_kategori'] = $id_kategori;
			$this->m_general->hapus("tbl_kategori", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/kategori');
	}
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_inventaris()
	{
		$table = "
        (
            SELECT
                a.*,
				CASE
					WHEN a.ketersediaan_inventaris='0' THEN 'Tidak Tersedia'
					WHEN a.ketersediaan_inventaris='1' THEN 'Tersedia'
				END as ketersediaaninventaris,
				b.nama_kategori
            FROM
                tbl_inventaris a JOIN tbl_kategori b ON a.id_kategori=b.id_kategori
        )temp";
		
        $primaryKey = 'id_inventaris';
        $columns = array(
        array( 'db' => 'id_inventaris',     'dt' => 0 ),
        array( 'db' => 'kode_inventaris',     'dt' => 1 ),
        array( 'db' => 'nama_inventaris',        'dt' => 2 ),
        array( 'db' => 'nama_kategori',       'dt' => 3 ),
        array( 'db' => 'ketersediaaninventaris',     'dt' => 4 )
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
	
	public function inventaris()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_inventaris");
        $this->load->view("v_admin_footer");
    }		
	public function inventaris_tambah()
    {
		$data['err'] = "";
		$data['tbl_kategori'] = $this->m_general->view_order("tbl_kategori", $order ="nama_kategori ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_inventaris_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function inventaris_ubah($id_inventaris)
	{
		$where = array("id_inventaris" => $id_inventaris);
		$data['tbl_inventaris'] = $this->m_general->view_by("tbl_inventaris",$where);
		$data['err'] = "";
		$data['tbl_kategori'] = $this->m_general->view_order("tbl_kategori", $order ="nama_kategori ASC");
		$data['tbl_kategori_by'] = $this->m_general->view_by("tbl_kategori", array("id_kategori" => $data['tbl_inventaris']->id_kategori));
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_inventaris_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function inventaris_aksi_tambah()
    {
			$kode_inventaris = $this->input->post('kode_inventaris');
			$nama_inventaris = $this->input->post('nama_inventaris');
			$check_inventaris = $this->m_general->countdata("tbl_inventaris", array("kode_inventaris" => $kode_inventaris));
			if($check_inventaris==0){
					$_POST['id_inventaris'] = $this->m_general->bacaidterakhir("tbl_inventaris", "id_inventaris");
					$this->m_general->add("tbl_inventaris", $_POST);
					redirect('admin/inventaris');
			}else{
					$data['tbl_kategori'] = $this->m_general->view_order("tbl_kategori", $order ="nama_kategori ASC");
					$data['err'] = 1;
					$data['kode_inventaris'] = $kode_inventaris;
					$data['nama_inventaris'] = $nama_inventaris;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_inventaris_add",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function inventaris_aksi_ubah($id_inventaris)
    {
			$kode_inventaris = $this->input->post('kode_inventaris')[0];
			$kode_inventaris_old = $this->input->post('kode_inventaris')[1];
			$nama_inventaris = $this->input->post('nama_inventaris');
			
			if($kode_inventaris!=$kode_inventaris_old){
				$check_inventaris = $this->m_general->countdata("tbl_inventaris", array("kode_inventaris" => $kode_inventaris));
			}else{
				$check_inventaris = 0;
			}
			
			if($check_inventaris==0){
					$where['id_inventaris'] = $id_inventaris;
					$_POST['kode_inventaris'] = $kode_inventaris;
					$this->m_general->edit("tbl_inventaris", $where, $_POST);
					redirect('admin/inventaris');
			}else{
					$where = array("id_inventaris" => $id_inventaris);
					$data['tbl_inventaris'] = $this->m_general->view_by("tbl_inventaris",$where);
					$data['err'] = 1;
					$data['tbl_kategori'] = $this->m_general->view_order("tbl_kategori", $order ="nama_kategori ASC");
					$data['tbl_kategori_by'] = $this->m_general->view_by("tbl_kategori", array("id_kategori" => $data['tbl_inventaris']->id_kategori));
					$data['kode_inventaris'] = $kode_inventaris;
					$data['nama_inventaris'] = $nama_inventaris;
					$this->load->view("v_admin_header");
					$this->load->view('v_admin_inventaris_edit', $data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function inventaris_aksi_hapus($id_inventaris){
			$where['id_inventaris'] = $id_inventaris;
			$this->m_general->hapus("tbl_inventaris", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/inventaris');
	}
	
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_ruangan()
	{
		$table = "
        (
            SELECT
                *
            FROM
                tbl_ruangan
        )temp";
		
        $primaryKey = 'id_ruangan';
        $columns = array(
        array( 'db' => 'id_ruangan',     'dt' => 0 ),
        array( 'db' => 'kode_ruangan',     'dt' => 1 ),
        array( 'db' => 'nama_ruangan',        'dt' => 2 ),
        array( 'db' => 'keterangan_ruangan',       'dt' => 3 ),
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
	
	public function ruangan()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_ruangan");
        $this->load->view("v_admin_footer");
    }		
	public function ruangan_tambah()
    {
		$data['err'] = "";
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_ruangan_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function ruangan_ubah($id_ruangan)
	{
		$where = array("id_ruangan" => $id_ruangan);
		$data['tbl_ruangan'] = $this->m_general->view_by("tbl_ruangan",$where);
		$data['err'] = "";
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_ruangan_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function ruangan_aksi_tambah()
    {
			$kode_ruangan = $this->input->post('kode_ruangan');
			$nama_ruangan = $this->input->post('nama_ruangan');
			$keterangan_ruangan = $this->input->post('keterangan_ruangan');
			$check_ruangan = $this->m_general->countdata("tbl_ruangan", array("kode_ruangan" => $kode_ruangan));
			if($check_ruangan==0){
					$_POST['id_ruangan'] = $this->m_general->bacaidterakhir("tbl_ruangan", "id_ruangan");
					$this->m_general->add("tbl_ruangan", $_POST);
					redirect('admin/ruangan');
			}else{
					$data['err'] = 1;
					$data['kode_ruangan'] = $kode_ruangan;
					$data['nama_ruangan'] = $nama_ruangan;
					$data['keterangan_ruangan'] = $keterangan_ruangan;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_ruangan_add",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function ruangan_aksi_ubah($id_ruangan)
    {
			$kode_ruangan = $this->input->post('kode_ruangan')[0];
			$kode_ruangan_old = $this->input->post('kode_ruangan')[1];
			$nama_ruangan = $this->input->post('nama_ruangan');
			$keterangan_ruangan = $this->input->post('keterangan_ruangan');
			
			if($kode_ruangan!=$kode_ruangan_old){
				$check_ruangan = $this->m_general->countdata("tbl_ruangan", array("kode_ruangan" => $kode_ruangan));
			}else{
				$check_ruangan = 0;
			}
			
			if($check_ruangan==0){
					$where['id_ruangan'] = $id_ruangan;
					$_POST['kode_ruangan'] = $kode_ruangan;
					$this->m_general->edit("tbl_ruangan", $where, $_POST);
					redirect('admin/ruangan');
			}else{
					$where = array("id_ruangan" => $id_ruangan);
					$data['tbl_ruangan'] = $this->m_general->view_by("tbl_ruangan",$where);
					$data['err'] = 1;
					$data['kode_ruangan'] = $kode_ruangan;
					$data['nama_ruangan'] = $nama_ruangan;
					$data['keterangan_ruangan'] = $keterangan_ruangan;
					$this->load->view("v_admin_header");
					$this->load->view('v_admin_ruangan_edit', $data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function ruangan_aksi_hapus($id_ruangan){
			$where['id_ruangan'] = $id_ruangan;
			$this->m_general->hapus("tbl_ruangan", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/ruangan');
	}
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_mahasiswa($sortir = "")
	{
		if($sortir=="sortir"){
			$where = "and sangsipeminjaman_user>0 AND 
(CASE WHEN (UNIX_TIMESTAMP(DATE_ADD(tanggalsangsi_user, INTERVAL (CASE
	WHEN sangsipeminjaman_user=0 THEN '0'
	WHEN sangsipeminjaman_user=1 THEN '3'
	WHEN sangsipeminjaman_user=2 THEN '7'
	WHEN sangsipeminjaman_user=3 THEN '30'
	WHEN sangsipeminjaman_user=4 THEN '90'
	WHEN sangsipeminjaman_user=5 THEN '100'
END) DAY)) - UNIX_TIMESTAMP() ) < 0 THEN 0
      ELSE 1 END)=1";
		}else{
			$where = "";
		}
		
		$table = "
        (
            SELECT (@cnt := @cnt + 1) AS rowNumber,
                tbl_user.*,
				CONCAT(tempatlahir_user,', ',DATE_FORMAT(tanggallahir_user, '%d/%m/%Y')) as ttl,
				CASE
					WHEN sangsipeminjaman_user=0 THEN '0 Hari'
					WHEN sangsipeminjaman_user=1 THEN '3 Hari'
					WHEN sangsipeminjaman_user=2 THEN '7 Hari'
					WHEN sangsipeminjaman_user=3 THEN '30 Hari'
					WHEN sangsipeminjaman_user=4 THEN '90 Hari'
					WHEN sangsipeminjaman_user=5 THEN 'Tidak Boleh Meminjam'
				END as sangsipeminjamanuser 
            FROM
                tbl_user CROSS JOIN (SELECT @cnt := 0) AS dummy
				where level_user='mahasiswa' 
				$where
        )temp";
		
        $primaryKey = 'id_user';
        $columns = array(
        array( 'db' => 'rowNumber',     'dt' => 0 ),
        array( 'db' => 'kodepeminjam_user',     'dt' => 1 ),
        array( 'db' => 'nama_user',        'dt' => 2 ),
        array( 'db' => 'ttl',       'dt' => 3 ),
        array( 'db' => 'notelp_user',       'dt' => 4 ),
        array( 'db' => 'alamat_user',       'dt' => 5 ),
        array( 'db' => 'sangsipeminjamanuser',       'dt' => 6 ),
        array( 'db' => 'id_user',       'dt' => 7 ),
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
	
	public function mahasiswa()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_mahasiswa");
        $this->load->view("v_admin_footer");
    }		
	public function mahasiswa_tambah()
    {
		$data['err'] = "";
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_mahasiswa_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function mahasiswa_ubah($id_user)
	{
		$where = array("id_user" => $id_user);
		$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
		$data['err'] = "";
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_mahasiswa_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function mahasiswa_aksi_tambah()
    {
			$kodepeminjam_user = $this->input->post('kodepeminjam_user');
			$nama_user = $this->input->post('nama_user');
			$tempatlahir_user = $this->input->post('tempatlahir_user');
			$tanggallahir_user = $this->input->post('tanggallahir_user');
			$notelp_user = $this->input->post('notelp_user');
			$alamat_user = $this->input->post('alamat_user');
			$check_user = $this->m_general->countdata("tbl_user", array("kodepeminjam_user" => $kodepeminjam_user));
			if($check_user==0){
					$_POST['id_user'] = $this->m_general->bacaidterakhir("tbl_user", "id_user");
					$_POST['level_user'] = "mahasiswa";
					$_POST['user_name'] = $kodepeminjam_user;
					
					//The original date format.
					$original = $tanggallahir_user;

					//Explode the string into an array.
					$exploded = explode("-", $original);

					//Reverse the order.
					$exploded = array_reverse($exploded);

					//Convert it back into a string.
					$newFormat = implode("-", $exploded);
					
					$date = str_replace("-","",$newFormat);

					$_POST['user_password'] = md5($date);
					
					$folder = "avatar";
					$file_upload = $_FILES['userfiles'];
					$files = $file_upload;
					
					if($files['name'] != "" OR $files['name'] != NULL){
						$_POST['foto_user'] = $this->m_general->file_upload($files, $folder);
					}else{
						$_POST['foto_user'] = "";
					}
					$this->m_general->add("tbl_user", $_POST);
					redirect('admin/mahasiswa');
			}else{
					$data['err'] = 1;
					$data['kodepeminjam_user'] = $kodepeminjam_user;
					$data['nama_user'] = $nama_user;
					$data['tempatlahir_user'] = $tempatlahir_user;
					$data['tanggallahir_user'] = $tanggallahir_user;
					$data['notelp_user'] = $notelp_user;
					$data['alamat_user'] = $alamat_user;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_mahasiswa_add",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function mahasiswa_aksi_ubah($id_user)
    {
			$where['id_user'] = $id_user;
			$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
			$tbl_user = $this->m_general->view_by("tbl_user",$where);
			
			$kodepeminjam_user = $this->input->post('kodepeminjam_user')[0];
			$kodepeminjam_user_old = $this->input->post('kodepeminjam_user')[1];
			$user_password = $this->input->post('user_password')[0];
			$user_password_old = $this->input->post('user_password')[1];
			$nama_user = $this->input->post('nama_user');
			$tempatlahir_user = $this->input->post('tempatlahir_user');
			$tanggallahir_user = $this->input->post('tanggallahir_user');
			$notelp_user = $this->input->post('notelp_user');
			$alamat_user = $this->input->post('alamat_user');
			$sangsipeminjaman_user = $this->input->post('sangsipeminjaman_user');
			$foto_user = $this->input->post('foto_user');
			
			if($kodepeminjam_user!=$kodepeminjam_user_old){
				$check_user = $this->m_general->countdata("tbl_user", array("kodepeminjam_user" => $kodepeminjam_user));
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}else{
				$check_user = 0;
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}
			
			if($check_user==0){
				if($user_password!=$user_password_old){
					$_POST['user_password'] = md5($user_password);
				}else{
					$_POST['user_password'] = $user_password;
				}
					$folder = "avatar";
					$file_upload = $_FILES['userfiles'];
					$files = $file_upload;
					
					if($files['name'] != "" OR $files['name'] != NULL){
						$file = './assets/dist/img/avatar/'.$tbl_user->foto_user;
						if($tbl_user->foto_user!="default/user.png" && is_readable($file)){
							unlink($file);
						}
						$_POST['foto_user'] = $this->m_general->file_upload($files, $folder);
					}else{
						$_POST['foto_user'] = $foto_user;
					}
					$_POST['user_name'] = $kodepeminjam_user;
					$this->m_general->edit("tbl_user", $where, $_POST);
					redirect('admin/mahasiswa');
			}else{
					$data['err'] = 1;
					$data['kodepeminjam_user'] = $kodepeminjam_user;
					$data['user_password'] = $user_password;
					$data['nama_user'] = $nama_user;
					$data['tempatlahir_user'] = $tempatlahir_user;
					$data['tanggallahir_user'] = $tanggallahir_user;
					$data['notelp_user'] = $notelp_user;
					$data['alamat_user'] = $alamat_user;
					$data['sangsipeminjaman_user'] = $sangsipeminjaman_user;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_mahasiswa_edit",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function mahasiswa_aksi_hapus($id_user){
			$where['id_user'] = $id_user;
			$tbl_user = $this->m_general->view_by("tbl_user", $where);
			$file = './assets/dist/img/avatar/'.$tbl_user->foto_user;
			if($tbl_user->foto_user!="default/user.png" && is_readable($file)){
				unlink($file);
			}
			$this->m_general->hapus("tbl_user", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/mahasiswa');
	}
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_administrator($sortir = "")
	{
		if($sortir=="sortir"){
			$where = "and sangsipeminjaman_user>0 AND 
(CASE WHEN (UNIX_TIMESTAMP(DATE_ADD(tanggalsangsi_user, INTERVAL (CASE
	WHEN sangsipeminjaman_user=0 THEN '0'
	WHEN sangsipeminjaman_user=1 THEN '3'
	WHEN sangsipeminjaman_user=2 THEN '7'
	WHEN sangsipeminjaman_user=3 THEN '30'
	WHEN sangsipeminjaman_user=4 THEN '90'
	WHEN sangsipeminjaman_user=5 THEN '100'
END) DAY)) - UNIX_TIMESTAMP() ) < 0 THEN 0
      ELSE 1 END)=1";
		}else{
			$where = "";
		}
		
		$table = "
        (
            SELECT (@cnt := @cnt + 1) AS rowNumber,
                tbl_user.*,
				CONCAT(tempatlahir_user,', ',DATE_FORMAT(tanggallahir_user, '%d/%m/%Y')) as ttl,
				CASE
					WHEN sangsipeminjaman_user=0 THEN '0 Hari'
					WHEN sangsipeminjaman_user=1 THEN '3 Hari'
					WHEN sangsipeminjaman_user=2 THEN '7 Hari'
					WHEN sangsipeminjaman_user=3 THEN '30 Hari'
					WHEN sangsipeminjaman_user=4 THEN '90 Hari'
					WHEN sangsipeminjaman_user=5 THEN 'Tidak Boleh Meminjam'
				END as sangsipeminjamanuser 
            FROM
                tbl_user CROSS JOIN (SELECT @cnt := 0) AS dummy
				where level_user='administrator' 
				$where
        )temp";
		
        $primaryKey = 'id_user';
        $columns = array(
        array( 'db' => 'rowNumber',     'dt' => 0 ),
        array( 'db' => 'kodepeminjam_user',     'dt' => 1 ),
        array( 'db' => 'nama_user',        'dt' => 2 ),
        array( 'db' => 'ttl',       'dt' => 3 ),
        array( 'db' => 'notelp_user',       'dt' => 4 ),
        array( 'db' => 'alamat_user',       'dt' => 5 ),
        array( 'db' => 'sangsipeminjamanuser',       'dt' => 6 ),
        array( 'db' => 'id_user',       'dt' => 7 ),
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
	
	public function administrator()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_administrator");
        $this->load->view("v_admin_footer");
    }		
	public function administrator_tambah()
    {
		$data['err'] = "";
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_administrator_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function administrator_ubah($id_user)
	{
		$where = array("id_user" => $id_user);
		$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
		$data['err'] = "";
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_administrator_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function administrator_aksi_tambah()
    {
			$kodepeminjam_user = $this->input->post('kodepeminjam_user');
			$nama_user = $this->input->post('nama_user');
			$tempatlahir_user = $this->input->post('tempatlahir_user');
			$tanggallahir_user = $this->input->post('tanggallahir_user');
			$notelp_user = $this->input->post('notelp_user');
			$alamat_user = $this->input->post('alamat_user');
			$check_user = $this->m_general->countdata("tbl_user", array("kodepeminjam_user" => $kodepeminjam_user));
			if($check_user==0){
					$_POST['id_user'] = $this->m_general->bacaidterakhir("tbl_user", "id_user");
					$_POST['level_user'] = "administrator";
					$_POST['user_name'] = $kodepeminjam_user;
					
					//The original date format.
					$original = $tanggallahir_user;

					//Explode the string into an array.
					$exploded = explode("-", $original);

					//Reverse the order.
					$exploded = array_reverse($exploded);

					//Convert it back into a string.
					$newFormat = implode("-", $exploded);
					
					$date = str_replace("-","",$newFormat);

					$_POST['user_password'] = md5($date);
					
					$folder = "avatar";
					$file_upload = $_FILES['userfiles'];
					$files = $file_upload;
					
					if($files['name'] != "" OR $files['name'] != NULL){
						$_POST['foto_user'] = $this->m_general->file_upload($files, $folder);
					}else{
						$_POST['foto_user'] = "";
					}
					$this->m_general->add("tbl_user", $_POST);
					redirect('admin/administrator');
			}else{
					$data['err'] = 1;
					$data['kodepeminjam_user'] = $kodepeminjam_user;
					$data['nama_user'] = $nama_user;
					$data['tempatlahir_user'] = $tempatlahir_user;
					$data['tanggallahir_user'] = $tanggallahir_user;
					$data['notelp_user'] = $notelp_user;
					$data['alamat_user'] = $alamat_user;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_administrator_add",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function administrator_aksi_ubah($id_user)
    {
			$where['id_user'] = $id_user;
			$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
			$tbl_user = $this->m_general->view_by("tbl_user",$where);
			
			$kodepeminjam_user = $this->input->post('kodepeminjam_user')[0];
			$kodepeminjam_user_old = $this->input->post('kodepeminjam_user')[1];
			$user_name = $this->input->post('user_name')[0];
			$user_name_old = $this->input->post('user_name')[1];
			$user_password = $this->input->post('user_password')[0];
			$user_password_old = $this->input->post('user_password')[1];
			$nama_user = $this->input->post('nama_user');
			$tempatlahir_user = $this->input->post('tempatlahir_user');
			$tanggallahir_user = $this->input->post('tanggallahir_user');
			$notelp_user = $this->input->post('notelp_user');
			$alamat_user = $this->input->post('alamat_user');
			$sangsipeminjaman_user = $this->input->post('sangsipeminjaman_user');
			$foto_user = $this->input->post('foto_user');
			
			if($kodepeminjam_user!=$kodepeminjam_user_old){
				$check_user = $this->m_general->countdata("tbl_user", array("kodepeminjam_user" => $kodepeminjam_user));
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}else{
				$check_user = 0;
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}
			
			if($user_name!=$user_name_old){
				$check_username = $this->m_general->countdata("tbl_user", array("user_name" => $user_name));
				$_POST['user_name'] = $user_name;
			}else{
				$check_username = 0;
				$_POST['user_name'] = $user_name;
			}
			
			if($check_user==0 && $check_username==0){
				if($user_password!=$user_password_old){
					$_POST['user_password'] = md5($user_password);
				}else{
					$_POST['user_password'] = $user_password;
				}
					$folder = "avatar";
					$file_upload = $_FILES['userfiles'];
					$files = $file_upload;
					
					if($files['name'] != "" OR $files['name'] != NULL){
						$file = './assets/dist/img/avatar/'.$tbl_user->foto_user;
						if($tbl_user->foto_user!="default/user.png" && is_readable($file)){
							unlink($file);
						}
						$_POST['foto_user'] = $this->m_general->file_upload($files, $folder);
					}else{
						$_POST['foto_user'] = $foto_user;
					}
					$this->m_general->edit("tbl_user", $where, $_POST);
					redirect('admin/administrator');
			}else{
					if($check_user>0){
						$data['err'] = 1;
					}
					if($check_username>0){
						$data['err'] = 2;
					}
					$data['kodepeminjam_user'] = $kodepeminjam_user;
					$data['user_name'] = $user_name;
					$data['user_password'] = $user_password;
					$data['nama_user'] = $nama_user;
					$data['tempatlahir_user'] = $tempatlahir_user;
					$data['tanggallahir_user'] = $tanggallahir_user;
					$data['notelp_user'] = $notelp_user;
					$data['alamat_user'] = $alamat_user;
					$data['sangsipeminjaman_user'] = $sangsipeminjaman_user;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_administrator_edit",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function administrator_aksi_hapus($id_user){
			$where['id_user'] = $id_user;
			$tbl_user = $this->m_general->view_by("tbl_user", $where);
			$file = './assets/dist/img/avatar/'.$tbl_user->foto_user;
			if($tbl_user->foto_user!="default/user.png" && is_readable($file)){
				unlink($file);
			}
			$this->m_general->hapus("tbl_user", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/administrator');
	}
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_dosen($sortir = "")
	{
		if($sortir=="sortir"){
			$where = "and sangsipeminjaman_user>0 AND 
(CASE WHEN (UNIX_TIMESTAMP(DATE_ADD(tanggalsangsi_user, INTERVAL (CASE
	WHEN sangsipeminjaman_user=0 THEN '0'
	WHEN sangsipeminjaman_user=1 THEN '3'
	WHEN sangsipeminjaman_user=2 THEN '7'
	WHEN sangsipeminjaman_user=3 THEN '30'
	WHEN sangsipeminjaman_user=4 THEN '90'
	WHEN sangsipeminjaman_user=5 THEN '100'
END) DAY)) - UNIX_TIMESTAMP() ) < 0 THEN 0
      ELSE 1 END)=1";
		}else{
			$where = "";
		}
		
		$table = "
        (
            SELECT (@cnt := @cnt + 1) AS rowNumber,
                tbl_user.*,
				CONCAT(tempatlahir_user,', ',DATE_FORMAT(tanggallahir_user, '%d/%m/%Y')) as ttl,
				CASE
					WHEN sangsipeminjaman_user=0 THEN '0 Hari'
					WHEN sangsipeminjaman_user=1 THEN '3 Hari'
					WHEN sangsipeminjaman_user=2 THEN '7 Hari'
					WHEN sangsipeminjaman_user=3 THEN '30 Hari'
					WHEN sangsipeminjaman_user=4 THEN '90 Hari'
					WHEN sangsipeminjaman_user=5 THEN 'Tidak Boleh Meminjam'
				END as sangsipeminjamanuser 
            FROM
                tbl_user CROSS JOIN (SELECT @cnt := 0) AS dummy
				where level_user='dosen' 
				$where
        )temp";
		
        $primaryKey = 'id_user';
        $columns = array(
        array( 'db' => 'rowNumber',     'dt' => 0 ),
        array( 'db' => 'kodepeminjam_user',     'dt' => 1 ),
        array( 'db' => 'nama_user',        'dt' => 2 ),
        array( 'db' => 'ttl',       'dt' => 3 ),
        array( 'db' => 'notelp_user',       'dt' => 4 ),
        array( 'db' => 'alamat_user',       'dt' => 5 ),
        array( 'db' => 'sangsipeminjamanuser',       'dt' => 6 ),
        array( 'db' => 'id_user',       'dt' => 7 ),
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
	
	public function dosen()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_dosen");
        $this->load->view("v_admin_footer");
    }		
	public function dosen_tambah()
    {
		$data['err'] = "";
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_dosen_add",$data);
		$this->load->view("v_admin_footer");
    }
	public function dosen_ubah($id_user)
	{
		$where = array("id_user" => $id_user);
		$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
		$data['err'] = "";
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_dosen_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	public function dosen_aksi_tambah()
    {
			$kodepeminjam_user = $this->input->post('kodepeminjam_user');
			$nama_user = $this->input->post('nama_user');
			$tempatlahir_user = $this->input->post('tempatlahir_user');
			$tanggallahir_user = $this->input->post('tanggallahir_user');
			$notelp_user = $this->input->post('notelp_user');
			$alamat_user = $this->input->post('alamat_user');
			$check_user = $this->m_general->countdata("tbl_user", array("kodepeminjam_user" => $kodepeminjam_user));
			if($check_user==0){
					$_POST['id_user'] = $this->m_general->bacaidterakhir("tbl_user", "id_user");
					$_POST['level_user'] = "dosen";
					$_POST['user_name'] = $kodepeminjam_user;
					
					//The original date format.
					$original = $tanggallahir_user;

					//Explode the string into an array.
					$exploded = explode("-", $original);

					//Reverse the order.
					$exploded = array_reverse($exploded);

					//Convert it back into a string.
					$newFormat = implode("-", $exploded);
					
					$date = str_replace("-","",$newFormat);

					$_POST['user_password'] = md5($date);
					
					$folder = "avatar";
					$file_upload = $_FILES['userfiles'];
					$files = $file_upload;
					
					if($files['name'] != "" OR $files['name'] != NULL){
						$_POST['foto_user'] = $this->m_general->file_upload($files, $folder);
					}else{
						$_POST['foto_user'] = "";
					}
					$this->m_general->add("tbl_user", $_POST);
					redirect('admin/dosen');
			}else{
					$data['err'] = 1;
					$data['kodepeminjam_user'] = $kodepeminjam_user;
					$data['nama_user'] = $nama_user;
					$data['tempatlahir_user'] = $tempatlahir_user;
					$data['tanggallahir_user'] = $tanggallahir_user;
					$data['notelp_user'] = $notelp_user;
					$data['alamat_user'] = $alamat_user;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_dosen_add",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function dosen_aksi_ubah($id_user)
    {
			$where['id_user'] = $id_user;
			$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
			$tbl_user = $this->m_general->view_by("tbl_user",$where);
			
			$kodepeminjam_user = $this->input->post('kodepeminjam_user')[0];
			$kodepeminjam_user_old = $this->input->post('kodepeminjam_user')[1];
			$user_password = $this->input->post('user_password')[0];
			$user_password_old = $this->input->post('user_password')[1];
			$nama_user = $this->input->post('nama_user');
			$tempatlahir_user = $this->input->post('tempatlahir_user');
			$tanggallahir_user = $this->input->post('tanggallahir_user');
			$notelp_user = $this->input->post('notelp_user');
			$alamat_user = $this->input->post('alamat_user');
			$sangsipeminjaman_user = $this->input->post('sangsipeminjaman_user');
			$foto_user = $this->input->post('foto_user');
			
			if($kodepeminjam_user!=$kodepeminjam_user_old){
				$check_user = $this->m_general->countdata("tbl_user", array("kodepeminjam_user" => $kodepeminjam_user));
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}else{
				$check_user = 0;
				$_POST['kodepeminjam_user'] = $kodepeminjam_user;
			}
			
			if($check_user==0){
				if($user_password!=$user_password_old){
					$_POST['user_password'] = md5($user_password);
				}else{
					$_POST['user_password'] = $user_password;
				}
					$folder = "avatar";
					$file_upload = $_FILES['userfiles'];
					$files = $file_upload;
					
					if($files['name'] != "" OR $files['name'] != NULL){
						$file = './assets/dist/img/avatar/'.$tbl_user->foto_user;
						if($tbl_user->foto_user!="default/user.png" && is_readable($file)){
							unlink($file);
						}
						$_POST['foto_user'] = $this->m_general->file_upload($files, $folder);
					}else{
						$_POST['foto_user'] = $foto_user;
					}
					$_POST['user_name'] = $kodepeminjam_user;
					$this->m_general->edit("tbl_user", $where, $_POST);
					redirect('admin/dosen');
			}else{
					$data['err'] = 1;
					$data['kodepeminjam_user'] = $kodepeminjam_user;
					$data['user_password'] = $user_password;
					$data['nama_user'] = $nama_user;
					$data['tempatlahir_user'] = $tempatlahir_user;
					$data['tanggallahir_user'] = $tanggallahir_user;
					$data['notelp_user'] = $notelp_user;
					$data['alamat_user'] = $alamat_user;
					$data['sangsipeminjaman_user'] = $sangsipeminjaman_user;
					$this->load->view("v_admin_header");
					$this->load->view("v_admin_dosen_edit",$data);
					$this->load->view("v_admin_footer");
			}
    }	
	public function dosen_aksi_hapus($id_user){
			$where['id_user'] = $id_user;
			$tbl_user = $this->m_general->view_by("tbl_user", $where);
			$file = './assets/dist/img/avatar/'.$tbl_user->foto_user;
			if($tbl_user->foto_user!="default/user.png" && is_readable($file)){
				unlink($file);
			}
			$this->m_general->hapus("tbl_user", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/dosen');
	}
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_peminjamaninv()
	{
		$table = "
        (
            SELECT (@cnt := @cnt + 1) AS rowNumber, a.id_peminjaman, 
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_inventaris, a.tanggal_peminjaman, a.tanggal_kembali,
			CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='1' THEN 'Batal Pinjam'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() >0) THEN 'Belum Kembali'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() <0) THEN 'Terlambat'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='1' THEN 'Sudah Kembali'
			END as keterangan
			FROM tbl_peminjaman_inventaris a 
			LEFT JOIN tbl_inventaris b ON a.kode_inventaris=b.kode_inventaris
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			CROSS JOIN (SELECT @cnt := 0) AS dummy
			order by created_peminjaman DESC
        )temp";
		
        $primaryKey = 'id_peminjaman';
        $columns = array(
        array( 'db' => 'rowNumber',     'dt' => 0 ),
        array( 'db' => 'kode_peminjaman',     'dt' => 1 ),
        array( 'db' => 'kodepeminjam_user',        'dt' => 2 ),
        array( 'db' => 'nama_user',       'dt' => 3 ),
        array( 'db' => 'kode_inventaris',       'dt' => 4 ),
        array( 'db' => 'tanggal_peminjaman',       'dt' => 5 ),
        array( 'db' => 'tanggal_kembali',       'dt' => 6 ),
        array( 'db' => 'keterangan',       'dt' => 7 ),
        array( 'db' => 'id_peminjaman',     'dt' => 8 )
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
	
	public function peminjamaninv_notifikasi()
    {
		$url = base_url("notifikasi/check_peminjaman");
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		curl_exec($curl);
		curl_close($curl);
		redirect('admin/peminjamaninv/notif');
    }
	
	public function peminjamaninv()
    {
		$data['hitungterlambat'] = $this->db->query(" SELECT a.kodepeminjam_user, a.kode_inventaris, 
			CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='1' THEN 'Batal Pinjam'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() >0) THEN 'Belum Kembali'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() <0) THEN 'Terlambat'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='1' THEN 'Sudah Kembali'
			END as keterangan
			FROM tbl_peminjaman_inventaris a 
			LEFT JOIN tbl_inventaris b ON a.kode_inventaris=b.kode_inventaris
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			WHERE (CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='1' THEN 'Batal Pinjam'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() >0) THEN 'Belum Kembali'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' AND (UNIX_TIMESTAMP(a.tanggal_kembali) - UNIX_TIMESTAMP() <0) THEN 'Terlambat'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='1' THEN 'Sudah Kembali'
			END)='Terlambat'
			order by created_peminjaman DESC")->num_rows();
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_peminjaman_inventaris", $data);
        $this->load->view("v_admin_footer");
    }		
	
	public function peminjamaninv_ubah($id_peminjaman, $action)
	{
		$data['tbl_peminjaman_inventaris'] = $this->db->query("SELECT a.id_peminjaman, 
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_inventaris, b.nama_inventaris, a.tanggal_peminjaman, a.tanggal_kembali,
			CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' THEN 'Belum Kembali'
			END as keterangan, c.foto_user
			FROM tbl_peminjaman_inventaris a 
			LEFT JOIN tbl_inventaris b ON a.kode_inventaris=b.kode_inventaris
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user WHERE id_peminjaman='$id_peminjaman'")->row();
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_peminjaman_inventaris_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	
	public function peminjamaninv_aksi_ubah($id_peminjaman)
    {
			$konfirmasi_peminjaman = $this->input->post('konfirmasi_peminjaman');
			$where2['kode_inventaris'] = $_POST['kode_inventaris'];
			$inventaris = $this->m_general->view_by("tbl_inventaris",$where2);
					
			if($konfirmasi_peminjaman==0){
					$_POST['konfirmasi_peminjaman'] = 0;
					$_POST['konfirmasi_kembali'] = 1;
					$_POST['tanggal_peminjaman'] = NULL;
					$_POST['tanggal_kembali'] = NULL;
					$ketersediaan_inventaris = 1;
					$pesan = "Peminjaman Inventaris { $inventaris->kode_inventaris } { $inventaris->nama_inventaris } telah dibatalkan oleh admin, Terimakasih.";
			}else if($konfirmasi_peminjaman==1){
					$_POST['konfirmasi_peminjaman'] = 1;
					$_POST['konfirmasi_kembali'] = 0;
					$tanggal_peminjaman = $this->input->post('tanggal_peminjaman');
					$_POST['tanggal_peminjaman'] = $tanggal_peminjaman;
					$_POST['tanggal_kembali'] = $this->input->post('tanggal_kembali');
					$ketersediaan_inventaris = 0;
					$pesan = "Peminjaman Inventaris { $inventaris->kode_inventaris } { $inventaris->nama_inventaris } telah dikonfirmasi oleh admin, mohon untuk mengembalikan sesuai jadwal yang telah ditentukan, Terimakasih.";
			}else if($konfirmasi_peminjaman==2){
					$tanggal_kembali = $this->input->post('tanggal_kembali');
					$_POST['konfirmasi_peminjaman'] = 1;
					$_POST['konfirmasi_kembali'] = 1;
					$_POST['tanggal_kembali'] = $tanggal_kembali;
					$ketersediaan_inventaris = 1;
					$pesan = "Anda sudah mengembalikan peminjaman  inventaris { $inventaris->kode_inventaris } { $inventaris->nama_inventaris }, Terimakasih.";
			}
			
			$id_inbox = $this->m_general->bacaidterakhir("tbl_inbox", "id_inbox");
						$inbox = array(
						'id_inbox' => $id_inbox,
						'isi_inbox' => $pesan,
						'kodepeminjam_user' => $_POST['kodepeminjam_user']
						);
			$this->m_general->add("tbl_inbox", $inbox);
				
			$where['id_peminjaman'] = $id_peminjaman;
			$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
			$this->m_general->edit("tbl_peminjaman_inventaris", $where, $_POST);
			
			//update tabel inventaris untuk inventaris yang dipinjam menjadi status ketersediannya 0
			$where2['kode_inventaris'] = $tbl_peminjaman_inventaris->kode_inventaris;
			$data = array(
				'ketersediaan_inventaris'=>$ketersediaan_inventaris
			);
			$this->m_general->edit("tbl_inventaris", $where2, $data);			
			redirect('admin/peminjamaninv');
    }	
	public function peminjamaninv_aksi_hapus($id_peminjaman){
			$where['id_peminjaman'] = $id_peminjaman;
			$tbl_peminjaman_inventaris = $this->m_general->view_by("tbl_peminjaman_inventaris",$where);
			$where2['kode_inventaris'] = $tbl_peminjaman_inventaris->kode_inventaris;
			$data = array(
				'ketersediaan_inventaris'=>1
			);
			$this->m_general->edit("tbl_inventaris", $where2, $data);
			$this->m_general->hapus("tbl_peminjaman_inventaris", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/peminjamaninv');
	}
	
	////////////////////////////////////
	
	////////////////////////////////////
	
	public function get_data_master_peminjamanruang($date)
	{
		$table = "
        (
            SELECT (@cnt := @cnt + 1) AS rowNumber, a.id_peminjaman, a.kode_jadwal,
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_ruangan, a.tanggal_peminjaman, b.nama_ruangan,
			CASE 
				WHEN a.status_peminjaman='0' THEN 'Menunggu Konfirmasi'
				WHEN a.status_peminjaman='1' THEN 'Terjadwal'
				WHEN a.status_peminjaman='2' THEN 'Batal'
			END as keterangan,
			CONCAT(jam1_jadwal,' - ',jam2_jadwal) as jadwal
			FROM tbl_peminjaman_ruangan a 
			LEFT JOIN tbl_ruangan b ON a.kode_ruangan=b.kode_ruangan
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			LEFT JOIN tbl_jadwal d ON a.kode_jadwal=d.kode_jadwal
			CROSS JOIN (SELECT @cnt := 0) AS dummy
			WHERE tanggal_peminjaman='$date'
			order by created_peminjaman DESC
        )temp";
		
        $primaryKey = 'id_peminjaman';
        $columns = array(
        array( 'db' => 'rowNumber',     'dt' => 0 ),
        array( 'db' => 'kode_peminjaman',     'dt' => 1 ),
        array( 'db' => 'kodepeminjam_user',        'dt' => 2 ),
        array( 'db' => 'nama_user',       'dt' => 3 ),
        array( 'db' => 'kode_ruangan',       'dt' => 4 ),
        array( 'db' => 'nama_ruangan',       'dt' => 5 ),
        array( 'db' => 'jadwal',       'dt' => 6 ),
        array( 'db' => 'keterangan',       'dt' => 7 ),
        array( 'db' => 'id_peminjaman',     'dt' => 8 ),
        array( 'db' => 'tanggal_peminjaman',     'dt' => 9 )
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
	
	public function peminjamanruang()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_peminjaman_ruangan");
        $this->load->view("v_admin_footer");
    }
	
	public function cekuser($kodepeminjam_user)
    {
		$where['kodepeminjam_user'] = $kodepeminjam_user;
		$tbl_user = $this->m_general->view_by("tbl_user",$where);
		echo $tbl_user->foto_user;
    }

	public function peminjamanruang_tambah()
    {
		$data['kode_peminjaman'] = $this->m_general->last_peminjaman("tbl_peminjaman_ruangan");
		$data['tbl_user'] = $this->m_general->view_order("tbl_user", "nama_user ASC");
		$data['tbl_ruangan'] = $this->m_general->view_order("tbl_ruangan", "nama_ruangan ASC");
		$data['tbl_jadwal'] = $this->m_general->view_order("tbl_jadwal", "id_jadwal ASC");
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_peminjaman_ruangan_add", $data);
        $this->load->view("v_admin_footer");
    }		
	
	public function peminjamanruang_ubah($id_peminjaman)
	{
		$data['tbl_peminjaman_ruangan'] = $this->db->query("SELECT a.id_peminjaman, a.kode_jadwal,
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_ruangan, a.tanggal_peminjaman, b.nama_ruangan,
			CASE 
				WHEN a.status_peminjaman='0' THEN 'Menunggu Konfirmasi'
				WHEN a.status_peminjaman='1' THEN 'Terjadwal'
				WHEN a.status_peminjaman='2' THEN 'Batal'
			END as keterangan, c.foto_user,
			CONCAT(jam1_jadwal,' - ',jam2_jadwal) as jadwal
			FROM tbl_peminjaman_ruangan a 
			LEFT JOIN tbl_ruangan b ON a.kode_ruangan=b.kode_ruangan
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			LEFT JOIN tbl_jadwal d ON a.kode_jadwal=d.kode_jadwal WHERE id_peminjaman='$id_peminjaman'")->row();
		$this->load->view("v_admin_header");
		$this->load->view('v_admin_peminjaman_ruangan_edit', $data);
		$this->load->view("v_admin_footer");
	}	
	
	public function peminjamanruang_aksi_tambah()
    {
			$_POST['id_peminjaman'] = $this->m_general->bacaidterakhir("tbl_peminjaman_ruangan", "id_peminjaman");
			$_POST['kode_peminjaman'] = $this->m_general->last_peminjaman("tbl_peminjaman_ruangan");
			$this->m_general->add("tbl_peminjaman_ruangan", $_POST);
			redirect('admin/peminjamanruang/'.$_POST['tanggal_peminjaman']);
    }
	public function peminjamanruang_aksi_ubah($id_peminjaman, $tanggal_peminjaman)
    {
			$where['id_peminjaman'] = $id_peminjaman;
			$this->m_general->edit("tbl_peminjaman_ruangan", $where, $_POST);
			
			$where2['kode_ruangan'] = $_POST['kode_ruangan'];
			$ruangan = $this->m_general->view_by("tbl_ruangan",$where2);
				
			if($_POST['status_peminjaman']==1){
				$pesan = "Peminjaman Ruangan { $ruangan->kode_ruangan } { $ruangan->nama_ruangan } telah dikonfirmasi oleh admin, Terimakasih.";
			}else if($_POST['status_peminjaman']==2){
				$pesan = "Peminjaman Ruangan { $ruangan->kode_ruangan } { $ruangan->nama_ruangan } telah dibatalkan oleh admin, Terimakasih.";
			}
			
			$id_inbox = $this->m_general->bacaidterakhir("tbl_inbox", "id_inbox");
			$inbox = array(
					'id_inbox' => $id_inbox,
					'isi_inbox' => $pesan,
					'kodepeminjam_user' => $_POST['kodepeminjam_user']
			);
			$this->m_general->add("tbl_inbox", $inbox);
			
			redirect('admin/peminjamanruang/'.$tanggal_peminjaman);
    }	
	public function peminjamanruang_aksi_hapus($id_peminjaman, $tanggal_peminjaman){
			$where['id_peminjaman'] = $id_peminjaman;
			$this->m_general->hapus("tbl_peminjaman_ruangan", $where); // Panggil fungsi hapus() yang ada di m_general.php
			redirect('admin/peminjamanruang/'.$tanggal_peminjaman);
	}
	
	////////////////////////////////////
	
	public function laporan()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_admin_laporan");
        $this->load->view("v_admin_footer");
    }
	
	public function get_data_master_inbox()
	{
		$table = "
        (
            SELECT * FROM tbl_inbox
        )temp";
		
        $primaryKey = 'id_inbox';
        $columns = array(
        array( 'db' => 'created_inbox',     'dt' => 0 ),
        array( 'db' => 'isi_inbox',     'dt' => 1 ),
        array( 'db' => 'kodepeminjam_user',     'dt' => 2 ),
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