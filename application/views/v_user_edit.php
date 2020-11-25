  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah User
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
						<p style="color:red;"><i>Username telah digunakan, coba yang lain.</i></p>
						<?php
							$nama_user = $nama_user;
							$username = $username;
							$password = $password;
							$jabatan_user = $jabatan_user;
							$alamat_user = $alamat_user;
							$no_telp_user = $no_telp_user;
							$email_user = $email_user;
						?>
					<?php }else{ 
							$nama_user = $tbl_user->nama_user;
							$username = $tbl_user->username;
							$password = $tbl_user->password;
							$jabatan_user = $tbl_user->jabatan_user;
							$alamat_user = $tbl_user->alamat_user;
							$no_telp_user = $tbl_user->no_telp_user;
							$email_user = $tbl_user->email_user;
					}
					?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("user/user_aksi_ubah/".$tbl_user->id_user); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama User</label>
						<input type="text" class="form-control" name="nama_user" placeholder="Nama User, Contoh : Budi Doremi" value="<?php echo $nama_user;?>">
					  </div>
					  <div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username[]" placeholder="Username, Contoh : budidoremi" value="<?php echo $username;?>">
						<input type="hidden" name="username[]" value="<?php echo $tbl_user->username;?>">
					  </div>
					  <div class="form-group">
						<label>Password User</label>
						<input type="password" class="form-control" name="password[]" placeholder="Password" value="<?php echo $password;?>">
						<input type="hidden" name="password[]" value="<?php echo $tbl_user->password;?>">
					  </div>
					  <div class="form-group">
						<label>Jabatan User</label>
						<input type="text" class="form-control" name="jabatan_user" placeholder="Jabatan" value="<?php echo $jabatan_user;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_user" placeholder="Alamat"><?php echo $alamat_user;?></textarea>
					  </div>
					  <div class="form-group">
						<label>No. Telp</label>
						<input type="text" class="form-control" name="no_telp_user" placeholder="No. Telp" value="<?php echo $no_telp_user;?>">
					  </div>
					  <div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" name="email_user" placeholder="Email" value="<?php echo $email_user;?>">
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