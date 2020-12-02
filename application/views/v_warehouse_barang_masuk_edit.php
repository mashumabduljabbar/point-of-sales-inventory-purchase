  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Ubah Barang Masuk
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
				  <?php echo form_open_multipart("warehouse/barang_masuk_aksi_ubah/$tbl_warehouse->id_warehouse"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Upload Document</label>
						<input type="file" onchange="readURL(this);"  class="form-control" name="userfiles" >
						<input type="hidden" name="upload_warehouse" value="<?php echo $tbl_warehouse->upload_warehouse; ?>">
						<img alt="" width="220px" class="img img-responsive user-image" id="blah" src="<?php echo base_url();?>assets/dist/img/warehouse/<?php echo $tbl_warehouse->upload_warehouse."?".strtotime("now");?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Tanggal Barang Masuk</label>
						<input type="date" class="form-control" name="tanggal_warehouse" value="<?php echo $tbl_warehouse->tanggal_warehouse;?>">
					  </div>
					  <div class="form-group">
						<label>Petugas</label>
						<select name="id_user" class="form-control select2" data-placeholder="Pilih User" required >
							<option value="<?php echo $tbl_user_by->id_user;?>"><?php echo $tbl_user_by->nama_user;?></option>
							<?php foreach($tbl_user as $user){?>
							<option value="<?php echo $user->id_user;?>"><?php echo $user->nama_user;?></option>
							<?php } ?>
						</select>
					  </div>
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-md-6">
								<hr/>
								<table id="tambahproduklainnya" width="100%" class="table-condensed">
									<thead>
										<tr id='tambahproduklainnyadiv0'>
											<th>Nama Produk</th>
											<th>Qty</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if($this->uri->segment(3)!=''){
											$x=1;
											foreach($tbl_warehouse_detail as $detail){ ?>
												<tr id='tambahproduklainnyadiv<?php echo $x;?>' >
													<td>
														<?php echo $detail->nama_produk;?>
														<input type="hidden"  name="id_po_detail[]"  value="<?php echo $detail->id_po_detail;?>">
													</td>
													<td>
														<input type="number" class="form-control" id="qty_po_detail<?php echo $x;?>" name="qty_warehouse_detail[]" placeholder="Qty" value="<?php echo $detail->qty_warehouse_detail;?>">
													</td>
												</tr>
											<?php $x++; }
											
										}
									?>
									</tbody>
								</table>
					</div>
					<?php if($this->uri->segment(3)!=''){ ?>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<?php } ?>
				  </div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
      </div>
    </section>
  </div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
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