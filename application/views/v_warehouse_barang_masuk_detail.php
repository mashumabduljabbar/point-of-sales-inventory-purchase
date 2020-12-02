  <div class="content-wrapper" >
    <section class="content-header">
      <h3>
        Detail Barang Masuk
      </h3>
    </section>
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
				  <div class="row">
					<div class="col-md-4">
					  <div class="form-group">
						<label> Document</label>
						<img alt="" width="220px" class="img img-responsive user-image" id="blah" src="<?php echo base_url();?>assets/dist/img/warehouse/<?php echo $tbl_warehouse->upload_warehouse."?".strtotime("now");?>">
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						<label>Tanggal Barang Masuk</label>
						<p><?php echo $tbl_warehouse->tanggal_warehouse;?></p>
					  </div>
					  <div class="form-group">
						<label>Petugas</label>
						<p><?php echo $tbl_user_by->nama_user;?></p>
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
														<?php echo $detail->qty_warehouse_detail;?>
													</td>
												</tr>
											<?php $x++; }
											
										}
									?>
									</tbody>
								</table>
					</div>
				  </div>
				</div>
			</div>
		</div>
      </div>
    </section>
  </div>
