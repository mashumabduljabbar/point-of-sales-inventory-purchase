  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Perusahaan
      </h3>
    </section>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						<span>Silahkan melengkapi form berikut</span>
					</h3>
					<?php if(isset($err)){?>
						<p style="color:red;"><i>Perusahaanname telah digunakan, coba yang lain.</i></p>
						<?php
							$nama_perusahaan = $nama_perusahaan;
							$npwp_perusahaan = $npwp_perusahaan;
							$alamat_perusahaan = $alamat_perusahaan;
							$no_telp_perusahaan = $no_telp_perusahaan;
							$email_perusahaan = $email_perusahaan;
						?>
					<?php }else{ 
							$nama_perusahaan = $tbl_perusahaan->nama_perusahaan;
							$npwp_perusahaan = $tbl_perusahaan->npwp_perusahaan;
							$alamat_perusahaan = $tbl_perusahaan->alamat_perusahaan;
							$no_telp_perusahaan = $tbl_perusahaan->no_telp_perusahaan;
							$email_perusahaan = $tbl_perusahaan->email_perusahaan;
					}
					?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("perusahaan/perusahaan_aksi_ubah/".$tbl_perusahaan->id_perusahaan); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Perusahaan</label>
						<input type="text" class="form-control" name="nama_perusahaan[]" placeholder="Nama Perusahaan, Contoh : Budi Doremi" value="<?php echo $nama_perusahaan;?>">
						<input type="hidden" name="nama_perusahaan[]" value="<?php echo $tbl_perusahaan->nama_perusahaan;?>">
					  </div>
					  <div class="form-group">
						<label>NPWP</label>
						<input type="text" class="form-control" name="npwp_perusahaan" placeholder="NPWP" value="<?php echo $npwp_perusahaan;?>">
					  </div>
					  <div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" name="email_perusahaan" placeholder="Email" value="<?php echo $email_perusahaan;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_perusahaan" placeholder="Alamat"><?php echo $alamat_perusahaan;?></textarea>
					  </div>
					  <div class="form-group">
						<label>No. Telp</label>
						<input type="text" class="form-control" name="no_telp_perusahaan" placeholder="No. Telp" value="<?php echo $no_telp_perusahaan;?>">
					  </div>
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<?php echo form_close(); ?>
				  </div>
				</div>
			</div>
		</div>
      </div>
    </section>
  </div>