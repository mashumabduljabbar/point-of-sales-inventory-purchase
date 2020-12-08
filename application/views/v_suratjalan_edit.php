  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Surat Jalan
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
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("suratjalan/suratjalan_aksi_ubah/$tbl_warehouse_by->id_surat_jalan"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Barang Keluar</label>
						<select name="id_warehouse" class="form-control" data-placeholder="Pilih Barang Keluar" required >
								<option value="<?php echo $tbl_warehouse_by->id_warehouse;?>"><?php echo $tbl_warehouse_by->id_warehouse;?> <?php echo $tbl_warehouse_by->nama_customer;?></option>
							<?php foreach($tbl_warehouse as $warehouse){?>
								<option value="<?php echo $warehouse->id_warehouse;?>"><?php echo $warehouse->id_warehouse;?> <?php echo $warehouse->nama_customer;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Tanggal Pengiriman</label>
						<input type="date" class="form-control" name="tanggal_pengiriman" value="<?php echo $tbl_warehouse_by->tanggal_pengiriman;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Kurir</label>
						<select name="id_user" class="form-control select2" data-placeholder="Pilih Kurir" required >
							<option value="<?php echo $tbl_user_by->id_user;?>"><?php echo $tbl_user_by->nama_user;?></option>
							<?php foreach($tbl_user as $user){?>
							<option value="<?php echo $user->id_user;?>"><?php echo $user->nama_user;?></option>
							<?php } ?>
						</select>
					  </div>
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-md-12">
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
				  </div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
      </div>
    </section>
  </div>