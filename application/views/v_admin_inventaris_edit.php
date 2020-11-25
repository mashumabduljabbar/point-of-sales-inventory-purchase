  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Inventaris
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
					<?php 
					if($err==1){
							$kode_inventaris = $kode_inventaris;
							$nama_inventaris = $nama_inventaris;
					?>
						<p style="color:red;"><i>ID Inventaris sudah digunakan, silahkan coba yang lain.</i></p>
					<?php 
					}else{
							$kode_inventaris = $tbl_inventaris->kode_inventaris;
							$nama_inventaris = $tbl_inventaris->nama_inventaris;
					}?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("admin/inventaris_aksi_ubah/$tbl_inventaris->id_inventaris"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>ID Inventaris</label>
						<input type="text" class="form-control" name="kode_inventaris[]" placeholder="ID Inventaris, Contoh : Laptop001" value="<?php echo $kode_inventaris;?>" required>
						<input type="hidden" class="form-control" name="kode_inventaris[]" value="<?php echo $tbl_inventaris->kode_inventaris;?>" >
					  </div>
					  <div class="form-group">
						<label>Nama Inventaris</label>
						<input type="text" class="form-control" name="nama_inventaris" placeholder="Nama Inventaris, Contoh : Laptop Labor 001" value="<?php echo $nama_inventaris;?>" required>
					  </div>
					  <div class="form-group">
						<label>Kategori</label>
						<select name="id_kategori" class="form-control select2" data-placeholder="Pilih Kategori" required >
							<option value="<?php echo $tbl_inventaris->id_kategori;?>"><?php echo $tbl_kategori_by->nama_kategori;?></option>
							<?php foreach($tbl_kategori as $kategori){?>
							<option value="<?php echo $kategori->id_kategori;?>"><?php echo $kategori->nama_kategori;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Ketersediaan</label>
						<select name="ketersediaan_inventaris" class="form-control select2" data-placeholder="Pilih Ketersediaan" required>
							<option value="<?php $ketersediaan_inventaris = array("Tidak Tersedia","Tersedia"); echo $tbl_inventaris->ketersediaan_inventaris;?>"><?php echo $ketersediaan_inventaris[$tbl_inventaris->ketersediaan_inventaris];?></option>
							<option value="0">Tidak Tersedia</option>
							<option value="1">Tersedia</option>
						</select>
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