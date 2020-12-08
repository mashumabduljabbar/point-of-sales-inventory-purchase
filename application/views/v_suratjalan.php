  <div class="content-wrapper ">
    <section class="content-header">
      <h3>
        Surat Jalan
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
					<a class="btn-sm btn-primary" href="<?php echo base_url("suratjalan/suratjalan_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Surat Jalan</span></a>
					</label>
					</h3>
				</div>
				<div class="box-body">
				<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>ID</th>
						<th>Tanggal Pengiriman</th>
						<th>Kurir</th>
						<th>ID Barang Keluar</th>
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
			"ajax": "<?php echo base_url('suratjalan/get_data_master_suratjalan/');?>" ,
			columnDefs: [{
				   targets: [4],
				   data: null,
				   render: function ( data, type, row, meta ) {                   
					return "<a  title='Document' href='<?php echo base_url();?>suratjalan/suratjalan_detail/"+row[0]+"'>  <button type='button' class='btn btn-xs btn-info'><i class='fa fa-file-pdf-o'></i> </button></a> <a  title='Ubah' href='<?php echo base_url();?>suratjalan/suratjalan_ubah/"+row[0]+"'> <button type='button' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i> </button></a> <a title='Hapus' onclick=\"return confirm('Yakin untuk menghapus Barang Keluar ini ?')\" href='<?php echo base_url();?>suratjalan/suratjalan_aksi_hapus/"+row[0]+"'> <button type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> </button></a>";
				   }
				},],
		});
		
setInterval( function () {
    myTable.ajax.reload();
}, 8000 );
</script>