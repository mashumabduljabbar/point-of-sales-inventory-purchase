  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Produk
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
				  <?php echo form_open_multipart("produk/produk_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Nama Produk</label>
						<input type="text" class="form-control" name="nama_produk" placeholder="Produk, Contoh : Televisi">
					  </div>
					  <div class="form-group">
						<label>Size Produk</label>
						<input type="text" class="form-control" name="size_produk" placeholder="Size, Contoh : 42inch">
					  </div>
					  <div class="form-group">
						<label>Cost Produk</label>
						<input type="number" class="form-control" name="cost_produk" placeholder="Cost Produk">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Price Produk</label>
						<input type="number" class="form-control" name="price_produk" placeholder="Price Produk">
					  </div>
					  <div class="form-group">
						<label>Alert Produk</label>
						<input type="number" class="form-control" name="alert_quantity" placeholder="Alert Produk">
					  </div>
					  <div class="form-group">
						<label>Image Produk</label>
						<input type="file" onchange="readURL(this);"  class="form-control" name="userfiles" >
						<img class="img img-responsive user-image" id="blah" >
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Kategori</label>
						<select name="id_kategori" class="form-control select2" data-placeholder="Pilih Kategori" required >
							<option></option>
							<?php foreach($tbl_kategori as $kategori){?>
							<option value="<?php echo $kategori->id_kategori;?>"><?php echo $kategori->nama_kategori;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Brand</label>
						<select name="id_brand" class="form-control select2" data-placeholder="Pilih Brand" required >
							<option></option>
							<?php foreach($tbl_brand as $brand){?>
							<option value="<?php echo $brand->id_brand;?>"><?php echo $brand->nama_brand;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Unit</label>
						<select name="id_unit" class="form-control select2" data-placeholder="Pilih Unit" required >
							<option></option>
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