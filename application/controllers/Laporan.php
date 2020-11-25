<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general'); // Load model/m_general ke controller ini
	}
	
	public function cetak_laporan(){
		$date = date("YmdHis");
		$date2 = date("Y-m-d");
		$pilih_data = $this->input->post('pilih_data');
		$data['pilih_data'] = $pilih_data;
		$data['tanggalcetak'] = $this->m_general->getTanggalIndo($date2);
		
		if($pilih_data==3){
			
		}else{
			$tanggal_mulai = $this->input->post('tanggal_mulai');
			$tanggal_selesai = $this->input->post('tanggal_selesai');
			$data['tanggal_mulai'] = $this->m_general->getTanggalIndo($tanggal_mulai);
			$data['tanggal_selesai'] = $this->m_general->getTanggalIndo($tanggal_selesai);
		}
		
		if($pilih_data==1 || $pilih_data==0){
		$data['tbl_peminjaman_inventaris'] = $this->db->query("SELECT (@cnt := @cnt + 1) AS rowNumber, 
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_inventaris, a.tanggal_peminjaman, a.tanggal_kembali,
			CASE 
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='0' THEN 'Menunggu Konfirmasi'
				WHEN a.konfirmasi_peminjaman='0' AND a.konfirmasi_kembali='1' THEN 'Batal Pinjam'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='0' THEN 'Belum Kembali'
				WHEN a.konfirmasi_peminjaman='1' AND a.konfirmasi_kembali='1' THEN 'Sudah Kembali'
			END as keterangan
			FROM tbl_peminjaman_inventaris a 
			LEFT JOIN tbl_inventaris b ON a.kode_inventaris=b.kode_inventaris
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			CROSS JOIN (SELECT @cnt := 0) AS dummy
			Where a.tanggal_kembali <= date('$tanggal_selesai') AND a.tanggal_peminjaman >=DATE_SUB(date('$tanggal_mulai'), INTERVAL 1 DAY)
			order by created_peminjaman DESC")->result();
		}
		
		if($pilih_data==2 || $pilih_data==0){
		$data['tbl_peminjaman_ruangan'] = $this->db->query("SELECT (@cnt := @cnt + 1) AS rowNumber, a.id_peminjaman, a.kode_jadwal,
			a.kode_peminjaman, a.kodepeminjam_user, c.nama_user, a.kode_ruangan, a.tanggal_peminjaman, b.nama_ruangan,
			CASE 
				WHEN a.status_peminjaman='0' THEN 'Menunggu Konfirmasi'
				WHEN a.status_peminjaman='1' THEN 'Terjadwal'
				WHEN a.status_peminjaman='2' THEN 'Batal'
			END as keterangan,
			CONCAT(TIME_FORMAT((jam1_jadwal), '%h:%i'),' - ',TIME_FORMAT((jam2_jadwal), '%h:%i')) as jadwal
			FROM tbl_peminjaman_ruangan a 
			LEFT JOIN tbl_ruangan b ON a.kode_ruangan=b.kode_ruangan
			LEFT JOIN tbl_user c ON a.kodepeminjam_user=c.kodepeminjam_user
			LEFT JOIN tbl_jadwal d ON a.kode_jadwal=d.kode_jadwal
			CROSS JOIN (SELECT @cnt := 0) AS dummy
			WHERE tanggal_peminjaman >= CAST('$tanggal_mulai' AS DATE) AND tanggal_peminjaman <= CAST('$tanggal_selesai' AS DATE)
			order by created_peminjaman DESC")->result();
		}
		
		if($pilih_data==3 || $pilih_data==0){
		$data['tbl_user'] = $this->db->query("SELECT (@cnt := @cnt + 1) AS rowNumber, a.kodepeminjam_user, a.nama_user, 
CONCAT(tempatlahir_user,', ',DATE_FORMAT(tanggallahir_user, '%d/%m/%Y')) as ttl,
a.notelp_user, a.alamat_user, tanggalsangsi_user,
@sangsihari:=CASE
	WHEN sangsipeminjaman_user=0 THEN '0'
	WHEN sangsipeminjaman_user=1 THEN '3'
	WHEN sangsipeminjaman_user=2 THEN '7'
	WHEN sangsipeminjaman_user=3 THEN '30'
	WHEN sangsipeminjaman_user=4 THEN '90'
	WHEN sangsipeminjaman_user=5 THEN '100'
END as sangsihari,
@tanggalselesaisangsi:=DATE_ADD(tanggalsangsi_user, INTERVAL @sangsihari DAY) as tanggalselesaisangsi,
@tanggalhariini:=NOW() as tanggalhariini,
@diff:=ABS( UNIX_TIMESTAMP(@tanggalselesaisangsi) - UNIX_TIMESTAMP() ) as pengurangan,
@hari:=CAST(@days := IF(@diff/86400 >= 1, floor(@diff / 86400 ),0) AS SIGNED) as days, 
@jam:=CAST(@hours := IF(@diff/3600 >= 1, floor((@diff:=@diff-@days*86400) / 3600),0) AS SIGNED) as hours, 
@menit:=CAST(@minutes := IF(@diff/60 >= 1, floor((@diff:=@diff-@hours*3600) / 60),0) AS SIGNED) as minutes, 
@detik:=CAST(@diff-@minutes*60 AS SIGNED) as seconds,
@sisa:=CASE
	WHEN (UNIX_TIMESTAMP(@tanggalselesaisangsi) > UNIX_TIMESTAMP(@tanggalhariini) && @sangsihari!=100) THEN CONCAT(@hari,'hari ',@jam,'jam ',@menit,'menit ',@detik,'detik')
	WHEN (UNIX_TIMESTAMP(@tanggalselesaisangsi) < UNIX_TIMESTAMP(@tanggalhariini) && @sangsihari!=100) THEN ''
	WHEN (UNIX_TIMESTAMP(@tanggalselesaisangsi) = UNIX_TIMESTAMP(@tanggalhariini) && @sangsihari!=100) THEN ''
	WHEN (@sangsihari=100) THEN 'Tidak Boleh Meminjam'
	ELSE ''
	END as sisa
FROM tbl_user a 
CROSS JOIN (SELECT @cnt := 0) AS dummy
WHERE sangsipeminjaman_user > 0 AND 
(CASE WHEN (UNIX_TIMESTAMP(DATE_ADD(tanggalsangsi_user, INTERVAL (CASE
	WHEN sangsipeminjaman_user=0 THEN '0'
	WHEN sangsipeminjaman_user=1 THEN '3'
	WHEN sangsipeminjaman_user=2 THEN '7'
	WHEN sangsipeminjaman_user=3 THEN '30'
	WHEN sangsipeminjaman_user=4 THEN '90'
	WHEN sangsipeminjaman_user=5 THEN '100'
END) DAY)) - UNIX_TIMESTAMP() ) < 0 THEN 0
      ELSE 1 END)=1
order by nama_user ASC")->result();
		}
		
		$mpdf = new \Mpdf\Mpdf([
		'mode' => 'utf-8', 
		'format' => 'A4-P',
		'margin_left' => 12,
		'margin_right' => 12,
		'margin_top' => 5,
		'margin_bottom' => 10,
		'margin_header' => 3,
		'margin_footer' => 3,
		]); //L For Landscape , P for Portrait
        $mpdf->SetTitle($date);
		$halaman = $this->load->view('v_laporan_cetak',$data,true);
		$mpdf->setFooter('{PAGENO}');
        $mpdf->WriteHTML($halaman);
        $mpdf->Output();
	}
	
	public function cetak_inbox(){
		$date = date("YmdHis");
		$date2 = date("Y-m-d");
		$data['tanggalcetak'] = $this->m_general->getTanggalIndo($date2);
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_selesai = $this->input->post('tanggal_selesai');
		$data['tanggal_mulai'] = $this->m_general->getTanggalIndo($tanggal_mulai);
		$data['tanggal_selesai'] = $this->m_general->getTanggalIndo($tanggal_selesai);
		$data['tbl_inbox'] = $this->db->query("SELECT (@cnt := @cnt + 1) AS rowNumber, a.*
			FROM tbl_inbox a CROSS JOIN (SELECT @cnt := 0) AS dummy
			WHERE a.created_inbox >= CAST('$tanggal_mulai' AS DATE) AND a.created_inbox <= DATE_ADD(CAST('$tanggal_selesai' AS DATE), INTERVAL 1 DAY)
			order by created_inbox DESC")->result();
		$mpdf = new \Mpdf\Mpdf([
		'mode' => 'utf-8', 
		'format' => 'A4-P',
		'margin_left' => 12,
		'margin_right' => 12,
		'margin_top' => 5,
		'margin_bottom' => 10,
		'margin_header' => 3,
		'margin_footer' => 3,
		]); //L For Landscape , P for Portrait
        $mpdf->SetTitle($date);
		$halaman = $this->load->view('v_laporan_cetak_inbox',$data,true);
		$mpdf->setFooter('{PAGENO}');
        $mpdf->WriteHTML($halaman);
        $mpdf->Output();
	}
}