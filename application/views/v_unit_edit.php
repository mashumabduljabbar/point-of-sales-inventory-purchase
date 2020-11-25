  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Unit
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
						<p style="color:red;"><i>Nama Unit masih sama dengan sebelumnya. Silahkan diubah.</i></p>
					<?php }?>
				</div>
				<div class="box-body">
				  <div class="row">
				  <?php echo form_open_multipart("unit/unit_aksi_ubah/".$tbl_unit->id_unit); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Unit</label>
						<input type="text" class="form-control" name="nama_unit" value="<?php echo $tbl_unit->nama_unit;?>">
					  </div>
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
						<a href="<?php echo base_url("unit/unit");?>" class="btn btn-info">Cancel</a>
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