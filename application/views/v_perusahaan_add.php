  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Perusahaan
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
					<?php if(isset($_POST['nama_perusahaan'])){?>
						<p style="color:red;"><i>Nama Perusahaan telah digunakan, coba yang lain.</i></p>
						<?php
							$nama_perusahaan = $_POST['nama_perusahaan'];
							$npwp_perusahaan = $_POST['npwp_perusahaan'];
							$alamat_perusahaan = $_POST['alamat_perusahaan'];
							$no_telp_perusahaan = $_POST['no_telp_perusahaan'];
							$email_perusahaan = $_POST['email_perusahaan'];
						?>
					<?php }else{ 
							$nama_perusahaan = "";
							$npwp_perusahaan = "";
							$alamat_perusahaan = "";
							$no_telp_perusahaan = "";
							$email_perusahaan = "";
					}
					?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("perusahaan/perusahaan_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Perusahaan</label>
						<input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan, Contoh : PT XYZ" value="<?php echo $nama_perusahaan;?>">
					  </div>
					  <div class="form-group">
						<label>NPWP</label>
						<input type="text" class="form-control" name="npwp_perusahaan" placeholder="NPWP" value="<?php echo $npwp_perusahaan;?>">
					  </div>
					  <div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email_perusahaan" placeholder="Email" value="<?php echo $email_perusahaan;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>No. Telp</label>
						<input type="text" class="form-control" name="no_telp_perusahaan" placeholder="No. Telp" value="<?php echo $no_telp_perusahaan;?>">
					  </div>
					  <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_perusahaan" placeholder="Alamat"><?php echo $alamat_perusahaan;?></textarea>
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