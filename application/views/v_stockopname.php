  <div class="content-wrapper ">
    <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
				<div class="box">
				<div class="box-header">
					<h3 class="box-title">
					<label>
					<a class="btn-sm btn-primary" href="<?php echo base_url("stockopname/stockopname_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Stock Opname</span></a>
					<a class="btn-sm btn-warning" href="<?php echo base_url("stockopname/stockopname_ubah");?>"><i class="fa fa-pencil"></i> <span>Ubah Stock Opname</span></a>
					</label>
					</h3>
				</div>
				<!-- /.box-header -->
				<div id="printableArea">
						<img src="<?php echo base_url();?>assets/dist/img/domas.png?<?php echo strtotime("now");?>" height="50px">
						<!-- /.box-header -->
						<div class="box-header">
							<h4 style="text-align: center;">
								Stock Opname
							</h4>
						</div>
				<div class="box-body">
				<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>Tanggal</th>
						<th>Nama Produk</th>
						<th>Jumlah di Sistem</th>
						<th>Jumlah Sebenarnya</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				  </table>
				</div>
				<!-- /.box-body -->
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
			"ordering": true,
			'order': [[0, 'desc'],[1, 'asc']],
			"ajax": "<?php echo base_url('stockopname/get_data_master_stockopname/');?>" ,
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