  <div class="content-wrapper ">
    <section class="content-header">
      <h3>
        Brand
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
					<a class="btn-sm btn-primary" href="<?php echo base_url("brand/brand_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Brand</span></a>
					</label>
					</h3>
				</div>
				<div class="box-body">
				<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th width="20%">ID Brand</th>
						<th>Nama Brand</th>
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
			"ajax": "<?php echo base_url('brand/get_data_master_brand/');?>" ,
			columnDefs: [{
				   targets: [2],
				   data: null,
				   render: function ( data, type, row, meta ) {                   
					return "<a href='<?php echo base_url();?>brand/brand_ubah/"+row[2]+"'> <button type='button' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i> Ubah</button></a> <a onclick=\"return confirm('Yakin untuk menghapus brand ini ?')\" href='<?php echo base_url();?>brand/brand_aksi_hapus/"+row[2]+"'> <button type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</button></a>";
				   }
				},],
		});
		
setInterval( function () {
    myTable.ajax.reload();
}, 4000 );
</script>