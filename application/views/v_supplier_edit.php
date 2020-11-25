  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Supplier
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
						<p style="color:red;"><i>Suppliername telah digunakan, coba yang lain.</i></p>
						<?php
							$nama_supplier = $nama_supplier;
							$npwp_supplier = $npwp_supplier;
							$alamat_supplier = $alamat_supplier;
							$no_telp_supplier = $no_telp_supplier;
							$email_supplier = $email_supplier;
						?>
					<?php }else{ 
							$nama_supplier = $tbl_supplier->nama_supplier;
							$npwp_supplier = $tbl_supplier->npwp_supplier;
							$alamat_supplier = $tbl_supplier->alamat_supplier;
							$no_telp_supplier = $tbl_supplier->no_telp_supplier;
							$email_supplier = $tbl_supplier->email_supplier;
					}
					?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("supplier/supplier_aksi_ubah/".$tbl_supplier->id_supplier); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Supplier</label>
						<input type="text" class="form-control" name="nama_supplier[]" placeholder="Nama Supplier, Contoh : Budi Doremi" value="<?php echo $nama_supplier;?>">
						<input type="hidden" name="nama_supplier[]" value="<?php echo $tbl_supplier->nama_supplier;?>">
					  </div>
					  <div class="form-group">
						<label>NPWP</label>
						<input type="text" class="form-control" name="npwp_supplier" placeholder="NPWP" value="<?php echo $npwp_supplier;?>">
					  </div>
					  <div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" name="email_supplier" placeholder="Email" value="<?php echo $email_supplier;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_supplier" placeholder="Alamat"><?php echo $alamat_supplier;?></textarea>
					  </div>
					  <div class="form-group">
						<label>No. Telp</label>
						<input type="text" class="form-control" name="no_telp_supplier" placeholder="No. Telp" value="<?php echo $no_telp_supplier;?>">
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