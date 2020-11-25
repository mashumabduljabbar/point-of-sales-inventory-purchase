  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Customer
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
					<?php if(isset($_POST['nama_customer'])){?>
						<p style="color:red;"><i>Nama Customer telah digunakan, coba yang lain.</i></p>
						<?php
							$nama_customer = $_POST['nama_customer'];
							$npwp_customer = $_POST['npwp_customer'];
							$alamat_customer = $_POST['alamat_customer'];
							$no_telp_customer = $_POST['no_telp_customer'];
							$email_customer = $_POST['email_customer'];
						?>
					<?php }else{ 
							$nama_customer = "";
							$npwp_customer = "";
							$alamat_customer = "";
							$no_telp_customer = "";
							$email_customer = "";
					}
					?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("customer/customer_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Customer</label>
						<input type="text" class="form-control" name="nama_customer" placeholder="Nama Customer, Contoh : PT XYZ" value="<?php echo $nama_customer;?>">
					  </div>
					  <div class="form-group">
						<label>NPWP</label>
						<input type="text" class="form-control" name="npwp_customer" placeholder="NPWP" value="<?php echo $npwp_customer;?>">
					  </div>
					  <div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email_customer" placeholder="Email" value="<?php echo $email_customer;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>No. Telp</label>
						<input type="text" class="form-control" name="no_telp_customer" placeholder="No. Telp" value="<?php echo $no_telp_customer;?>">
					  </div>
					  <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_customer" placeholder="Alamat"><?php echo $alamat_customer;?></textarea>
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