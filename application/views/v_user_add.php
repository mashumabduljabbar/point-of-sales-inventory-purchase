  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah User
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
					<?php if(isset($_POST['username'])){?>
						<p style="color:red;"><i>Username telah digunakan, coba yang lain.</i></p>
						<?php
							$nama_user = $_POST['nama_user'];
							$username = $_POST['username'];
							$password = $_POST['password'];
							$jabatan_user = $_POST['jabatan_user'];
							$alamat_user = $_POST['alamat_user'];
							$no_telp_user = $_POST['no_telp_user'];
							$email_user = $_POST['email_user'];
						?>
					<?php }else{ 
							$nama_user = "";
							$username = "";
							$password = "";
							$jabatan_user = "";
							$alamat_user = "";
							$no_telp_user = "";
							$email_user = "";
					}
					?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("user/user_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama User</label>
						<input type="text" class="form-control" name="nama_user" placeholder="Nama User, Contoh : Budi Doremi" value="<?php echo $nama_user;?>">
					  </div>
					  <div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" placeholder="Username, Contoh : budidoremi" value="<?php echo $username;?>">
					  </div>
					  <div class="form-group">
						<label>Password User</label>
						<input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $password;?>">
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