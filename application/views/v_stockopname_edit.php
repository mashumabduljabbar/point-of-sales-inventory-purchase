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
					<div class="col-md-3">
						<div class="form-group">
						<label>Periode</label>
							<select name="tanggal_stockopname" class="form-control" onchange="location = '<?php echo base_url();?>stockopname/stockopname_ubah/'+this.value;" required >
									<?php 
									if($this->uri->segment(3)!=''){
										$periode = $this->uri->segment(3);
										echo "<option value='$periode'>$periode</option>";
									}else{
										$periode = "1900-01";
										echo "<option>Pilih Periode</option>";
									} ?>
									<?php foreach($tanggal as $data){?>
										<option value="<?php echo $data->tanggal_stockopname;?>"><?php echo $data->tanggal_stockopname;?></option>
									<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="box-body">
				  <div class="row">
					<div class="col-md-12">
				  <?php 
				  $tanggal = $this->uri->segment(3);
				  echo form_open_multipart("stockopname/stockopname_aksi_ubah"); ?>
					<?php 
							if($tanggal!=""){ ?>
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
								<input type="hidden" class="form-control" name="id_stockopname[]" value="<?php echo $stockopname->id_stockopname;?>">
							<tr>
								<td><?php echo $stockopname->tanggal_stockopname;?><input type="hidden" class="form-control" name="tanggal_stockopname" value="<?php echo $stockopname->tanggal_stockopname;?>"></td>
								<td><?php echo $stockopname->nama_produk;?>
									<input type="hidden" class="form-control" name="id_produk[]" value="<?php echo $stockopname->id_produk;?>">
								</td>
								<td><input type="number" class="form-control" name="qty_stocksistem[]" value="<?php echo $stockopname->qty_stocksistem;?>"></td>
								<td><input type="number" class="form-control" name="qty_stokcopname[]" value="<?php echo $stockopname->qty_stokcopname;?>"></td>
							</tr>
									
							<?php 	}
							?>
						</tbody>
					</table>
							<?php } ?>
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