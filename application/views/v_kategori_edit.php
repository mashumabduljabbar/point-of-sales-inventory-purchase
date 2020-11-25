  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Kategori
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
						<p style="color:red;"><i>Nama Kategori masih sama dengan sebelumnya. Silahkan diubah.</i></p>
					<?php }?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("kategori/kategori_aksi_ubah/".$tbl_kategori->id_kategori); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" class="form-control" name="nama_kategori" value="<?php echo $tbl_kategori->nama_kategori;?>">
					  </div>
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
						<a href="<?php echo base_url("kategori/kategori");?>" class="btn btn-info">Cancel</a>
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