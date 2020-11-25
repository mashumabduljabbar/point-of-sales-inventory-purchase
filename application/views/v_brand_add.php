  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Brand
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
					<?php if($this->uri->segment(3)=="err"){?>
						<p style="color:red;"><i>Brand telah digunakan, coba yang lain.</i></p>
					<?php }?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("brand/brand_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Brand</label>
						<input type="text" class="form-control" name="nama_brand" placeholder="Brand, Contoh : Panasonic">
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