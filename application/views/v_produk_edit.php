  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Produk
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
				  <?php echo form_open_multipart("produk/produk_aksi_ubah/".$tbl_produk->id_produk); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Produk</label>
						<input type="text" class="form-control" name="nama_produk" placeholder="Produk, Contoh : Televisi" value="<?php echo $tbl_produk->nama_produk;?>">
					  </div>
					  <div class="form-group">
						<label>Size Produk</label>
						<input type="text" class="form-control" name="size_produk" placeholder="Size, Contoh : 42inch" value="<?php echo $tbl_produk->size_produk;?>">
					  </div>
					  <div class="form-group">
						<label>Cost Produk</label>
						<input type="number" class="form-control" name="cost_produk" placeholder="Cost Produk" value="<?php echo $tbl_produk->cost_produk;?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Price Produk</label>
						<input type="number" class="form-control" name="price_produk" placeholder="Price Produk" value="<?php echo $tbl_produk->price_produk;?>">
					  </div>
					  <div class="form-group">
						<label>Alert Produk</label>
						<input type="number" class="form-control" name="alert_quantity" placeholder="Alert Produk" value="<?php echo $tbl_produk->alert_quantity;?>">
					  </div>
					  <div class="form-group">
						<label>Image Produk</label>
						<input type="file" onchange="readURL(this);"  class="form-control" name="userfiles" >
						<input type="hidden" name="image_produk" value="<?php echo $tbl_produk->image_produk; ?>">
						<img width="220px" class="img img-responsive user-image" id="blah" src="<?php echo base_url();?>assets/dist/img/produk/<?php echo $tbl_produk->image_produk."?".strtotime("now");?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Kategori</label>
						<select name="id_kategori" class="form-control select2" data-placeholder="Pilih Kategori" required >
							<option value="<?php echo $tbl_kategori_by->id_kategori;?>"><?php echo $tbl_kategori_by->nama_kategori;?></option>
							<?php foreach($tbl_kategori as $kategori){?>
							<option value="<?php echo $kategori->id_kategori;?>"><?php echo $kategori->nama_kategori;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Brand</label>
						<select name="id_brand" class="form-control select2" data-placeholder="Pilih Brand" required >
							<option value="<?php echo $tbl_brand_by->id_brand;?>"><?php echo $tbl_brand_by->nama_brand;?></option>
							<?php foreach($tbl_brand as $brand){?>
							<option value="<?php echo $brand->id_brand;?>"><?php echo $brand->nama_brand;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Unit</label>
						<select name="id_unit" class="form-control select2" data-placeholder="Pilih Unit" required >
							<option value="<?php echo $tbl_unit_by->id_unit;?>"><?php echo $tbl_unit_by->nama_unit;?></option>
							<?php foreach($tbl_unit as $unit){?>
							<option value="<?php echo $unit->id_unit;?>"><?php echo $unit->nama_unit;?></option>
							<?php } ?>
						</select>
					  </div>
					</div>
					<div class="col-md-6">
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