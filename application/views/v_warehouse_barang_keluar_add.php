  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah Barang Keluar
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
				  <?php echo form_open_multipart("warehouse/barang_keluar_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>SO</label>
						<select name="id_po" class="form-control" data-placeholder="Pilih SO" onchange="location = '<?php echo base_url();?>warehouse/barang_keluar_tambah/'+this.value;" required >
							<?php if($this->uri->segment(3)!=''){
								echo "<option value='$tbl_po_by->id_po'>$tbl_po_by->id_po $tbl_po_by->nama_customer</option>";
							}else{
								echo "<option>Pilih SO</option>";
							} ?>
							<?php foreach($tbl_po as $po){?>
								<option value="<?php echo $po->id_po;?>"><?php echo $po->id_po;?> <?php echo $po->nama_customer;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Upload Document</label>
						<input type="file" onchange="readURL(this);"  class="form-control" name="userfiles" >
						<img class="img img-responsive user-image" id="blah" >
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Tanggal Barang Keluar</label>
						<input type="date" class="form-control" name="tanggal_warehouse" value="<?php echo date("Y-m-d");?>">
					  </div>
					  <div class="form-group">
						<label>Petugas</label>
						<select name="id_user" class="form-control select2" data-placeholder="Pilih User" required >
							<option value="<?php echo $this->session->userdata('id_user');?>"><?php echo $this->session->userdata('nama_user');?></option>
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
											foreach($tbl_po_detail as $detail){ ?>
												<tr id='tambahproduklainnyadiv<?php echo $x;?>' >
													<td>
														<select class='form-control' id='id_produk<?php echo $x;?>' name='id_po_detail[]' style='width: 100%;' >
																<option value='<?php echo $detail->id_po_detail;?>'> <?php echo $detail->nama_produk;?></option>
														</select>
													</td>
													<td>
														<input type="number" class="form-control" id="qty_po_detail<?php echo $x;?>" name="qty_warehouse_detail[]" placeholder="Qty" value="<?php echo $detail->qty_po_detail;?>">
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