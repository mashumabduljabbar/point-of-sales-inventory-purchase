  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah PO
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
				  <?php echo form_open_multipart("po/po_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>RFQ</label>
						<select name="id_rfq" class="form-control" data-placeholder="Pilih RFQ" onchange="location = '<?php echo base_url();?>po/po_tambah/'+this.value;" required >
							<?php if($this->uri->segment(3)!=''){
								echo "<option value='$tbl_rfq_by->id_rfq'>$tbl_rfq_by->id_rfq $tbl_rfq_by->nama_supplier</option>";
							}else{
								echo "<option>Pilih RFQ</option>";
							} ?>
							<?php foreach($tbl_rfq as $rfq){?>
								<option value="<?php echo $rfq->id_rfq;?>"><?php echo $rfq->id_rfq;?> <?php echo $rfq->nama_supplier;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Tax</label>
						<select name="tax_po" class="form-control select2" data-placeholder="Pilih Tax" required >
							<?php if($this->uri->segment(3)!=''){
								echo "<option value='$tbl_rfq_by->pajak;'>$tbl_rfq_by->tax_rfq</option>";
							}else{
								echo "<option>Pilih Tax</option>";
							}?>
							<option value="0">Tanpa Tax</option>
							<option value="5">5%</option>
							<option value="10">10%</option>
						</select>
					  </div>
					</div>
					<div class="col-md-4">
					  
					  <div class="form-group">
						<label>Alamat Pengiriman</label>
						<textarea class="form-control" rows="4" name="alamat_pengiriman_po" placeholder="Alamat Pengiriman"><?php if($this->uri->segment(3)!=''){
								echo "$tbl_rfq_by->alamat_pengiriman_rfq";
							}else{
								echo "";
							}?></textarea>
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Tanggal</label>
						<input type="date" class="form-control" name="tanggal_po" value="<?php echo date("Y-m-d");?>">
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
					<div class="col-md-12">
								<hr/>
								<table id="tambahproduklainnya" width="100%" class="table-condensed">
									<thead>
										<tr id='tambahproduklainnyadiv0'>
											<th>Nama Produk</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Discount (%)</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if($this->uri->segment(3)!=''){
											$x=1;
											foreach($tbl_rfq_detail as $detail){ ?>
												<tr id='tambahproduklainnyadiv<?php echo $x;?>' >
													<td>
														<select class='form-control' id='id_produk<?php echo $x;?>' name='id_produk[]' style='width: 100%;' >
																<option value='<?php echo $detail->id_produk;?>'> <?php echo $detail->nama_produk;?></option>
														</select>
													</td>
													<td>
														<input type="number" class="form-control" id="harga_po_detail<?php echo $x;?>" name="harga_po_detail[]" placeholder="Harga" value="<?php echo $detail->harga_rfq_detail;?>">
													</td>
													<td>
														<input type="number" class="form-control" id="qty_po_detail<?php echo $x;?>" name="qty_po_detail[]" placeholder="Qty" value="<?php echo $detail->qty_rfq_detail;?>">
													</td>
													<td>
														<input type="number" class="form-control" id="disc_po_detail<?php echo $x;?>" name="disc_po_detail[]" placeholder="Discount" value="<?php echo $detail->disc_rfq_detail;?>">
													</td>
												</tr>
											<?php $x++; }
											
											for($y=0; $y<(30+$x); $y++){
												echo "
												<tr id='tambahproduklainnyadiv$y' style='display:none'>
													<td>
													<div class='form-group'><select data-placeholder='Nama Produk' class='form-control' id='id_produk$y' name='id_produk[]' style='width: 100%;' >
														<option value=''> Nama Produk</option>
													</select></div>
													</td>
													<td><div class='form-group'><input type='number' id='harga_po_detail$y' name='harga_po_detail[]' class='form-control' placeholder='Harga'></div></td>
													<td><div class='form-group'><input type='number' id='qty_po_detail$y' name='qty_po_detail[]' class='form-control' placeholder='Qty'></div></td>
													<td><div class='form-group'><input type='number' id='disc_po_detail$y' name='disc_po_detail[]' class='form-control' placeholder='Discount'></div></td>
												</tr>
												";
											}
										}
									?>
									</tbody>
								</table>
								<?php if($this->uri->segment(3)!=''){ ?>
								<div class="form-group">
									<label><button id="tambahproduk"  type="button" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Tambah Produk</button></label>
									<label><button id="hapusproduk"  type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus Produk</button></label> 
									<input id="idhapusnilai" type="hidden" value="<?php echo $x-1;?>">
								</div>
								<?php } ?>
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
	$("#tambahproduk").click(function(){
	var numb = $("#idhapusnilai").val();
	$("#hapusproduk").show();
	numb++;	
	
	
	$.getJSON("<?php echo base_url('produk/tbl_produk');?>", function(data) {
			$("#id_produk"+numb).empty();
			$.each(data, function(key, value) {
				$("#id_produk"+numb).append('<option value="' + value.id_produk + '">' + value.nama_produk + '</option>');
			});
	}); 
	
	
	document.getElementById( 'idhapusnilai' ).value = numb;
	$("#tambahproduklainnyadiv"+numb).show();
		document.getElementById( 'idhapusnilai' ).value = numb;
		return false;
	});
	
	$("#hapusproduk").click(function() {
	   var nomore = $("#idhapusnilai").val();
	   document.getElementById("harga_po_detail"+nomore).value = "";
	   document.getElementById("qty_po_detail"+nomore).value = "";
	   document.getElementById("disc_po_detail"+nomore).value = "";
	   $("#id_produk"+nomore).empty();
       $("#tambahproduklainnyadiv"+nomore).hide();
	   nomore--;	
	   document.getElementById( 'idhapusnilai' ).value = nomore;
	   if(nomore<1){
			$("#hapusproduk").hide();
	   }
    });
//////////////////////////////////////////////////////////////////////
</script>