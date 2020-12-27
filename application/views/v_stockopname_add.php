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
					<div class="col-md-12">
				  <?php echo form_open_multipart("stockopname/stockopname_aksi_tambah"); ?>
					<table class="table">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>Nama Produk</th>
								<th>Jumlah di Sistem</th>
								<th>Jumlah Sebenarnya</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($tbl_stockopname as $stockopname){ ?>
							<tr>
								<td><?php echo date("Y-m-d");?><input type="hidden" class="form-control" name="tanggal_stockopname[]" value="<?php echo date("Y-m-d");?>"></td>
								<td><?php echo $stockopname->nama_produk;?>
									<input type="hidden" class="form-control" name="id_produk[]" value="<?php echo $stockopname->id_produk;?>">
								</td>
								<td><?php echo $stockopname->stocksistem;?>
									<input type="hidden" class="form-control" name="qty_stocksistem[]" value="<?php echo $stockopname->stocksistem;?>">
								</td>
								<td><input type="number" class="form-control" name="qty_stokcopname[]" placeholder="Jumlah Sebenarnya"></td>
							</tr>
									
							<?php 	}
							?>
						</tbody>
					</table>
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