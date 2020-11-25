<?php 
if($this->uri->segment(3)!=""){
	$date = $this->uri->segment(3);
}else{
	$date = date("Y-m-d");
}
$hari = date('l', strtotime($date));

	switch($hari){
		case 'Sunday':
			$hari_ini = "Minggu";
		break;
 
		case 'Monday':			
			$hari_ini = "Senin";
		break;
 
		case 'Tuesday':
			$hari_ini = "Selasa";
		break;
 
		case 'Wednesday':
			$hari_ini = "Rabu";
		break;
 
		case 'Thursday':
			$hari_ini = "Kamis";
		break;
 
		case 'Friday':
			$hari_ini = "Jumat";
		break;
 
		case 'Saturday':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
?> 
 <!-- Full Width Column -->
  <div class="content-wrapper">
		<div class="row">
		  <section class="content">
				<div class="col-md-6">
					<div class="box">
						<div class="bg-green">
							<table style="border:2px solid white; width:100%;">
								<tr>
									<th style="padding:15px;">Informasi Inventaris Labor</th>
								</tr>
							</table>
						</div>
						<?php foreach($tbl_inventaris as $inventaris){ ?>
						<div class="bg-yellow">
							<table style="border:2px solid white; width:100%;">
								<tr>
									<td style="padding:10px;" width="200px">Jumlah <?php echo $inventaris->nama_kategori;?> Tersedia</td>
									<td style="padding:10px;"> : </td>
									<td style="padding:10px;"> <?php echo $inventaris->jumlah;?> </td>
								</tr>
							</table>
						</div>
						<?php } ?>
					</div>
					
					<div class="box">
						<div class="bg-green">
							<table style="border:2px solid white; width:100%;">
								<tr>
									<th style="padding:15px;">Pemberitahuan</th>
								</tr>
							</table>
						</div>
						<div class="bg-white">
							<table style="border:2px solid white; width:100%;">
								<tr>
									<td style="padding:10px;"> 
										<p>Untuk melakukan peminjaman Inventaris Labor, harap membawa Kartu Tanda Mahasiswa (KTM) sebagai syarat peminjaman, terimakasih!</p>
										<br>
										<p>
										Contact Admin Labor : <br>
										<?php foreach($tbl_user as $user){ 
											echo "$user->nama_user ( $user->notelp_user ) <br>";
										 } ?>
										</p>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box">
						<div class="bg-green">
							<table style="border:2px solid white; width:100%;">
								<tr>
									<th style="padding:15px;">Jadwal Penggunaan dan Ketersediaan Labor</th>
								</tr>
							</table>
						</div>
						<div class="bg-white">
							<table style="border:2px solid white; width:100%;">
								<tr>
									<td style="padding:5px;">
									<label>Pilih Tanggal : </label> <label> <?php echo $hari_ini;?>, </label> <label><input type="date" value="<?php echo $date;?>" onchange="handler(event);"></label>
									</td>
								</tr>
							</table>
						</div>
					</div>
						<?php foreach($tbl_ruangan as $ruangan){ ?>
						<div class="col-md-6">
							<div class="box">
								<div class="bg-white">
									<table style="border:1px solid black; width:100%;">
										<tr>
											<th colspan="2" style="text-align:center; padding:10px; border:1px solid black;"> 
												<?php echo $ruangan->nama_ruangan;?>
											</th>
										</tr>
										<tr>
											<th style="text-align:center; padding:10px; border:1px solid black;"> 
												Jam
											</th>
											<th style="text-align:center; padding:10px; border:1px solid black;"> 
												Peminjam Labor
											</th>
										</tr>
										<?php 
										$tbl_peminjaman_ruangan = $this->db->query("select a.nama_ruangan, c.jam1_jadwal, c.jam2_jadwal, b.kodepeminjam_user from tbl_ruangan a right OUTER join tbl_peminjaman_ruangan b ON a.kode_ruangan=b.kode_ruangan right OUTER join tbl_jadwal c ON b.kode_jadwal=c.kode_jadwal and b.tanggal_peminjaman='$date' and a.kode_ruangan='$ruangan->kode_ruangan' and b.status_peminjaman='1' order by c.jam1_jadwal ASC")->result();
										foreach($tbl_peminjaman_ruangan as $peminjaman_ruangan){
										?>
										<tr>
											<td style="text-align:center; padding:5px; border:1px solid black;"> 
												<?php echo substr($peminjaman_ruangan->jam1_jadwal,0,5);?> - 
												<?php echo substr($peminjaman_ruangan->jam2_jadwal,0,5);?>
											</td>
											<td style="padding:5px; border:1px solid black;"> 
												<?php
												if($peminjaman_ruangan->kodepeminjam_user!=NULL){
												$tbl_user = $this->db->query("select * from tbl_user where kodepeminjam_user='$peminjaman_ruangan->kodepeminjam_user'")->row();
												echo $tbl_user->nama_user; 
												}
												?>
											</td>
										</tr>
										<?php } ?>
									</table>
								</div>
							</div>
						</div>
						<?php } ?>
					
				</div>
		  </section>
		</div>
  </div>
  <footer class="main-footer"  style="text-align:center;">
    <div class="pull-right hidden-xs">
    </div>
    <strong><small>Labor Komputer FASILKOM - UNILAK 2020</small></strong> 
  </footer>
  

<script type="text/javascript">        
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
		var waktu = new Date();            //membuat object date berdasarkan waktu saat 
		var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
		var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
		var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
		document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
	
	function handler(e){
	  window.location.href = '<?php echo base_url()."Beranda/index/"; ?>'+e.target.value;
	}
	
	setTimeout(function() {
	  location.reload();
	}, 5000);
</script>