  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Unit
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
						<p style="color:red;"><i>Unit telah digunakan, coba yang lain.</i></p>
					<?php }?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("unit/unit_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Unit</label>
						<input type="text" class="form-control" name="nama_unit" placeholder="Unit, Contoh : Box, Buah, Pcs">
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