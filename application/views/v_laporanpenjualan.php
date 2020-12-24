  <div class="content-wrapper ">
    <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="col-md-3">
				<div class="form-group">
				<label>Periode</label>
					<select name="id_rfq" class="form-control" onchange="location = '<?php echo base_url();?>report/laporanpenjualan/'+this.value;" required >
							<?php 
							if($this->uri->segment(3)!=''){
								$periode = $this->uri->segment(3);
								echo "<option value='$periode'>$periode</option>";
							}else{
								$periode = "1900-01";
								echo "<option>Pilih Periode</option>";
							} ?>
							<?php foreach($laporanpenjualan as $data){?>
								<option value="<?php echo $data->periode;?>"><?php echo $data->periode;?></option>
							<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box">
					<div id="printableArea">
						<img src="<?php echo base_url();?>assets/dist/img/domas.png?<?php echo strtotime("now");?>" height="50px">
						<!-- /.box-header -->
						<div class="box-header">
							<h4 style="text-align: center;">
								Laporan Penjualan<br>
								Periode : <?php if($this->uri->segment(3)!=''){ echo $periode; };?>
							</h4>
						</div>
					<div class="box-body">
					<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Tanggal Penjualan</th>
							<th>Customer</th>
							<th>Nama Produk</th>
							<th>Jumlah Produk</th>
							<th>Sub Total</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
						<tr>
							<th colspan="4" style="text-align:right;">Total Penjualan</th>
							<th><?php echo number_format($total->total);?></th>
						</tr>
						</tfoot>
					  </table>
					</div>
					<!-- /.box-body -->
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
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script>
var myTable =  $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
			"paging": true,
			"info": false,
			"bFilter": false,
			"bPaginate": false,
			"bLengthChange": false,
			"paging":   false,
			"ordering": false,
			'order': [[0, 'asc']],
			"ajax": "<?php echo base_url('report/get_data_master_laporanpenjualan/'.$periode);?>" ,
			aLengthMenu: [
				[25, 50, 100, 200, -1],
				[25, 50, 100, 200, "All"]
			],
			iDisplayLength: -1
		});

</script>
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>