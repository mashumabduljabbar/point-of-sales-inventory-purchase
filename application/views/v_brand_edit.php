  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Brand
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
					<?php if($this->uri->segment(4)=="err"){?>
						<p style="color:red;"><i>Nama Brand masih sama dengan sebelumnya. Silahkan diubah.</i></p>
					<?php }?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("brand/brand_aksi_ubah/".$tbl_brand->id_brand); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Brand</label>
						<input type="text" class="form-control" name="nama_brand" value="<?php echo $tbl_brand->nama_brand;?>">
					  </div>
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
						<a href="<?php echo base_url("brand/brand");?>" class="btn btn-info">Cancel</a>
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