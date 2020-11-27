  <div class="content-wrapper ">
    <section class="content-header">
      <h3>
        Sales Order
      </h3>
    </section>
    <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<!-- /.box-header -->
				<div class="box-header">
					<h3 class="box-title">
					<label>
					<a class="btn-sm btn-primary" href="<?php echo base_url("so/so_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah SO</span></a>
					</label>
					</h3>
				</div>
				<div class="box-body">
				<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>ID SO</th>
						<th>Tanggal</th>
						<th>Nama Customer</th>
						<th>Sub Total</th>
						<th>Discount</th>
						<th>Tax</th>
						<th>Total</th>
						<th width="150px"> Action</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				  </table>
				</div>
				<!-- /.box-body -->
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
			"info": true,
			'order': [[0, 'asc']],
			"ajax": "<?php echo base_url('so/get_data_master_so/');?>" ,
			columnDefs: [{
				   targets: [7],
				   data: null,
				   render: function ( data, type, row, meta ) {                   
					return "<a  title='Detail' href='<?php echo base_url();?>so/so_detail/"+row[7]+"/"+row[8]+"'> <button type='button' class='btn btn-xs btn-info'><i class='fa fa-eye'></i> </button></a> <a  title='Ubah' href='<?php echo base_url();?>so/so_ubah/"+row[7]+"/"+row[8]+"'> <button type='button' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i> </button></a> <a title='Hapus' onclick=\"return confirm('Yakin untuk menghapus rfq ini ?')\" href='<?php echo base_url();?>so/so_aksi_hapus/"+row[7]+"'> <button type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> </button></a>";
				   }
				},],
		});
		
setInterval( function () {
    myTable.ajax.reload();
}, 8000 );
</script>