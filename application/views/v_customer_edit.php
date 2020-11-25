  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Customer
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
						<p style="color:red;"><i>Customername telah digunakan, coba yang lain.</i></p>
						<?php
							$nama_customer = $nama_customer;
							$npwp_customer = $npwp_customer;
							$alamat_customer = $alamat_customer;
							$no_telp_customer = $no_telp_customer;
							$email_customer = $email_customer;
						?>
					<?php }else{ 
							$nama_customer = $tbl_customer->nama_customer;
							$npwp_customer = $tbl_customer->npwp_customer;
							$alamat_customer = $tbl_customer->alamat_customer;
							$no_telp_customer = $tbl_customer->no_telp_customer;
							$email_customer = $tbl_customer->email_customer;
					}
					?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("customer/customer_aksi_ubah/".$tbl_customer->id_customer); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Customer</label>
						<input type="text" class="form-control" name="nama_customer[]" placeholder="Nama Customer, Contoh : Budi Doremi" value="<?php echo $nama_customer;?>">
						<input type="hidden" name="nama_customer[]" value="<?php echo $tbl_customer->nama_customer;?>">
					  </div>
					  <div class="form-group">
						<label>NPWP</label>
						<input type="text" class="form-control" name="npwp_customer" placeholder="NPWP" value="<?php echo $npwp_customer;?>">
					  </div>
					  <div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" name="email_customer" placeholder="Email" value="<?php echo $email_customer;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_customer" placeholder="Alamat"><?php echo $alamat_customer;?></textarea>
					  </div>
					  <div class="form-group">
						<label>No. Telp</label>
						<input type="text" class="form-control" name="no_telp_customer" placeholder="No. Telp" value="<?php echo $no_telp_customer;?>">
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