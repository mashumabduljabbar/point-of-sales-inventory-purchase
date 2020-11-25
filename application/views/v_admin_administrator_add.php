  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Admin
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
							$kodepeminjam_user = $kodepeminjam_user;
							$nama_user = $nama_user;
							$tempatlahir_user = $tempatlahir_user;
							$tanggallahir_user = $tanggallahir_user;
							$notelp_user = $notelp_user;
							$alamat_user = $alamat_user;
					?>
						<p style="color:red;"><i>ID Admin sudah digunakan, silahkan coba yang lain.</i></p>
					<?php 
					}else{
							$kodepeminjam_user = "";
							$nama_user = "";
							$tempatlahir_user = "";
							$tanggallahir_user = "";
							$notelp_user = "";
							$alamat_user = "";
					}?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("admin/administrator_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>ID Admin</label>
						<input type="text" class="form-control" name="kodepeminjam_user" placeholder="ID Admin" value="<?php echo $kodepeminjam_user;?>" required>
					  </div>
					  <div class="form-group">
						<label>Nama Admin</label>
						<input type="text" class="form-control" name="nama_user" placeholder="Nama Admin" value="<?php echo $nama_user;?>" required>
					  </div>
					  <div class="form-group">
						<label>Tempat Lahir</label>
						<input type="text" class="form-control" name="tempatlahir_user" placeholder="Tempat Lahir" value="<?php echo $tempatlahir_user;?>" required>
					  </div>
					  <div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="date" class="form-control" name="tanggallahir_user" placeholder="Tanggal Lahir" value="<?php echo $tanggallahir_user;?>" required>
					  </div>
					</div>
					<div class="col-md-4">
						 <div class="form-group">
						<label>No Telp / HP</label>
						<input type="text" class="form-control" name="notelp_user" placeholder="No Telp / HP" value="<?php echo $notelp_user;?>" required>
					  </div>
					  <div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="alamat_user" placeholder="Alamat" value="<?php echo $alamat_user;?>" required>
					  </div>
					  <div class="form-group">
						<label>Sangsi Peminjaman</label>
						<select name="sangsipeminjaman_user" class="form-control select2" data-placeholder="Pilih Sangsi" required>
							<option></option>
							<option value="0">0 Hari</option>
							<option value="1">3 Hari</option>
							<option value="2">7 Hari</option>
							<option value="3">30 Hari</option>
							<option value="4">90 Hari</option>
							<option value="5">Tidak Boleh Meminjam</option>
						</select>
					  </div>
					  <div class="form-group">
						<label>&nbsp;</label>
						<input type="submit" value="Submit" class="form-control btn btn-success">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Foto Profil</label>
						<img class="img img-responsive user-image" id="blah" >
						<input type="file" onchange="readURL(this);"  class="form-control" name="userfiles" required>
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

 <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>