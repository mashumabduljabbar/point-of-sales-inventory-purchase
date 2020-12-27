  <div class="content-wrapper" >
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
					<div id="printableArea">
						<img src="<?php echo base_url();?>assets/dist/img/domas.png?<?php echo strtotime("now");?>" height="50px">
						
				<div class="box-body">
				  <div class="row">
					<div class="col-md-12">
						<h3 style="text-align:center;">Surat Jalan</h3>
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">ID Barang Keluar</td><td width="20px">:</td><td><?php echo $tbl_warehouse->id_warehouse;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Tanggal Pengiriman</td><td width="20px">:</td><td><?php echo $tbl_warehouse->tanggal_pengiriman;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Alamat Pengiriman</td><td width="20px">:</td><td><?php echo $tbl_warehouse->alamat_pengiriman_po;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Kurir</td><td width="20px">:</td><td><?php echo $tbl_user_by->nama_user;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Pengirim</td><td width="20px">:</td><td><b><?php echo $tbl_perusahaan_by->nama_perusahaan;?></b></td></tr>
									<tr><td>Alamat</td><td width="20px">:</td><td><?php echo $tbl_perusahaan_by->alamat_perusahaan;?></td></tr>
									<tr><td>NPWP</td><td width="20px">:</td><td><?php echo $tbl_perusahaan_by->npwp_perusahaan;?></td></tr>
									<tr><td>No.Telp</td><td width="20px">:</td><td><?php echo $tbl_perusahaan_by->no_telp_perusahaan;?></td></tr>
									<tr><td>Email</td><td width="20px">:</td><td><?php echo $tbl_perusahaan_by->email_perusahaan;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Penerima</td><td width="20px">:</td><td><b><?php echo $tbl_customer_by->nama_customer;?></b></td></tr>
									<tr><td>Alamat</td><td width="20px">:</td><td><?php echo $tbl_customer_by->alamat_customer;?></td></tr>
									<tr><td>NPWP</td><td width="20px">:</td><td><?php echo $tbl_customer_by->npwp_customer;?></td></tr>
									<tr><td>No.Telp</td><td width="20px">:</td><td><?php echo $tbl_customer_by->no_telp_customer;?></td></tr>
									<tr><td>Email</td><td width="20px">:</td><td><?php echo $tbl_customer_by->email_customer;?></td></tr>
								</table>
							</div>
						</div>
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-md-12">
						<div class="col-md-12">
							<br>
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table id="tambahproduklainnya" width="100%" class="table table-condensed">
									<thead>
										<tr>
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
				  
				  <div class="row">
					<div class="col-md-12">
						<div class="col-md-12">
							<br>
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table width="100%" class="table table-condensed">
									<tr>
										<th width="50%" style="text-align:center;">Pengirim</th>
										<th width="50%" style="text-align:center;">Penerima</th>
									</tr>
									<tr>
										<td style="text-align:center;"><br><br><br><br>........................</td>
										<td style="text-align:center;"><br><br><br><br>........................</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>
			
			</div>
			<div class="col-md-12">
				 <div class="form-group">
					<input type="button" onclick="printDiv('printableArea')" value="Cetak"  class="btn btn-success">
				 </div>
			</div>
		</div>
      </div>
    </section>
  </div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>