  <div class="content-wrapper" >
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div id="printableArea">
				<div class="box">
					<div class="box-body">
					  <div class="row">
						<div class="col-md-12">
							<h3 style="text-align:center;">RFQ Sales</h3>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Nomor</td><td width="20px">:</td><td><?php echo "RFQ-".$tbl_rfq->id_rfq;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Tanggal</td><td width="20px">:</td><td><?php echo $tbl_rfq->tanggal_rfq;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Petugas</td><td width="20px">:</td><td><?php echo $tbl_user_by->nama_user;?></td></tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table class="table-condensed">
									<tr><td width="130px">Alamat Pengiriman</td><td width="20px">:</td><td><?php echo $tbl_rfq->alamat_pengiriman_rfq;?></td></tr>
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
					  
					  <div class="row">
						<div class="col-md-12">
							<br>
							<div class="box-body"  style="border:1px solid #F4F4F4;">
								<table width="100%" class="table table-condensed">
										<thead>
											<tr id='tambahproduklainnyadiv0'>
												<th>Nama Produk</th>
												<th style="text-align:center;">Harga</th>
												<th style="text-align:center;">Qty</th>
												<th style="text-align:center;">Subtotal</th>
												<th style="text-align:center;">Discount</th>
												<th style="text-align:center;">Tax</th>
												<th style="text-align:center;">Total</th>
											</tr>
										</thead>
										<tbody>
											<?php
										$x=0;
										foreach($tbl_rfq_detail as $detail){ ?>
											<tr>
												<td>
													<?php echo $detail->nama_produk;?>
												</td>
												<td style="text-align:center;">
													<?php echo $detail->harga;?>
												</td>
												<td style="text-align:center;">
													<?php echo $detail->qty;?>
												</td>
												<td style="text-align:center;">
													<?php echo $detail->subtotal;?>
												</td>
												<td style="text-align:center;">
													<?php echo $detail->discount;?>
												</td>
												<td style="text-align:center;">
													<?php echo $detail->pajak;?>
												</td>
												<td style="text-align:right;">
													<?php echo $detail->total;?>
												</td>
											</tr>
										<?php $x++; }?>
											<tr>
												<td colspan="7">
												</td>
											</tr>
											<tr>
												<td colspan="5">
													
												</td>
												<td>
													<b>Grand Sub Total</b>
												</td>
												<td style="text-align:right;">
													<b><?php echo $tbl_rfq->subtotal;?></b>
												</td>
											</tr>
											<tr>
												<td colspan="5">
													
												</td>
												<td>
													<b>Grand Discount</b>
												</td>
												<td style="text-align:right;">
													<b>- <?php echo $tbl_rfq->diskon;?></b>
												</td>
											</tr>
											<tr>
												<td colspan="5">
													
												</td>
												<td>
													<b>Tax <?php echo $tbl_rfq->tax_rfq;?></b>
												</td>
												<td style="text-align:right;">
													<b><?php echo $tbl_rfq->tax;?></b>
												</td>
											</tr>
											<tr>
												<td colspan="5">
													
												</td>
												<td>
													<b>Grand Total</b>
												</td>
												<td style="text-align:right;">
													<b><?php echo $tbl_rfq->total;?></b>
												</td>
											</tr>
										</tbody>
								</table>
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