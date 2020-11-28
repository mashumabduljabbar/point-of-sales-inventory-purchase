  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Tambah RFQ
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
				  <?php echo form_open_multipart("rfqpurchase/rfq_aksi_tambah"); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Supplier</label>
						<select name="id_supplier" class="form-control select2" data-placeholder="Pilih Supplier" required >
							<option></option>
							<?php foreach($tbl_supplier as $customer){?>
							<option value="<?php echo $customer->id_supplier;?>"><?php echo $customer->nama_supplier;?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>Tax</label>
						<select name="tax_rfq" class="form-control select2" data-placeholder="Pilih Tax" required >
							<option value="0">Tanpa Tax</option>
							<option value="5">5%</option>
							<option value="10">10%</option>
						</select>
					  </div>
					</div>
					<div class="col-md-4">
					  
					  <div class="form-group">
						<label>Alamat Pengiriman</label>
						<textarea class="form-control" rows="4" name="alamat_pengiriman_rfq" placeholder="Alamat Pengiriman"></textarea>
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Tanggal</label>
						<input type="date" class="form-control" name="tanggal_rfq" value="<?php echo date("Y-m-d");?>">
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
								<table id="tambahproduklainnya" width="100%">
									<thead>
										<tr id='tambahproduklainnyadiv0' style='display:none'>
											<th>Nama Produk</th>
											<th>&nbsp;</th>
											<th>Harga</th>
											<th>&nbsp;</th>
											<th>Qty</th>
											<th>&nbsp;</th>
											<th>Discount (%)</th>
										</tr>
									</thead>
									<tbody>
										<?php 									
										for($y=0; $y<30; $y++){
											echo "
											<tr id='tambahproduklainnyadiv$y' style='display:none'>
												<td>
												<div class='form-group'><select data-placeholder='Nama Produk' class='form-control' id='id_produk$y' name='id_produk[]' style='width: 100%;' >
													<option value=''> Nama Produk</option>
												</select></div>
												</td>
												<td>&nbsp;</td>
												<td><div class='form-group'><input type='number' id='harga_rfq_detail$y' name='harga_rfq_detail[]' class='form-control' placeholder='Harga'></div></td>
												<td>&nbsp;</td>
												<td><div class='form-group'><input type='number' id='qty_rfq_detail$y' name='qty_rfq_detail[]' class='form-control' placeholder='Qty'></div></td>
												<td>&nbsp;</td>
												<td><div class='form-group'><input type='number' id='disc_rfq_detail$y' name='disc_rfq_detail[]' class='form-control' placeholder='Discount'></div></td>
											</tr>
											";
										}
									?>
									</tbody>
								</table>
								<div class="form-group">
									<label><button id="tambahproduk"  type="button" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Tambah Produk</button></label>
									<label><button id="hapusproduk"  type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus Produk</button></label> 
									<input id="idhapusnilai" type="hidden" value="0">
								</div>
					</div>
					<div class="col-md-12">
					  <div class="form-group">
						<input type="submit" value="Submit" class="btn btn-success">
					  </div>
					</div>
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
	$("#hapusproduk").hide();
	$("#tambahproduk").click(function(){
	var numb = $("#idhapusnilai").val();
	$("#tambahproduklainnyadiv0").show();	
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
	   document.getElementById("harga_rfq_detail"+nomore).value = "";
	   document.getElementById("qty_rfq_detail"+nomore).value = "";
	   document.getElementById("disc_rfq_detail"+nomore).value = "";
	   $("#id_produk"+nomore).empty();
       $("#tambahproduklainnyadiv"+nomore).hide();
	   nomore--;	
	   document.getElementById( 'idhapusnilai' ).value = nomore;
	   if(nomore<1){
			$("#hapusproduk").hide();
			$("#tambahproduklainnyadiv0").hide();	
	   }
    });

//////////////////////////////////////////////////////////////////////
</script>