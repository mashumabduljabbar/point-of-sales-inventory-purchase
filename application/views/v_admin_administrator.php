<?php 
	$sortir = $this->uri->segment(3);
?>
  <div class="content-wrapper ">
    <section class="content-header">
      <h3>
        Data User - Admin
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
					<a class="btn-sm btn-primary" href="<?php echo base_url("admin/administrator_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Data User</span></a>
					</label>
					<?php if($sortir=="sortir"){ ?>
					<label>
					<a class="btn-sm btn-success" href="<?php echo base_url("admin/administrator");?>"><i class="fa fa-sort"></i> <span>Lihat Semua User Admin</span></a>
					</label>	
					<?php }else{ ?>
					<label>
					<a class="btn-sm btn-success" href="<?php echo base_url("admin/administrator/sortir");?>"><i class="fa fa-sort"></i> <span>Sortir yang Terkena Sanksi</span></a>
					</label>
					<?php } ?>
					</h3>
				</div>
				<div class="box-body">
				<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>No</th>
						<th>ID Admin</th>
						<th>Nama Admin</th>
						<th>Tempat / TGL Lahir</th>
						<th>No Telp / HP </th>
						<th>Alamat </th>
						<th>Sanksi Peminjaman </th>
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
			"ajax": "<?php echo base_url('admin/get_data_master_administrator/'.$sortir);?>" ,
			columnDefs: [{
				   targets: [7],
				   data: null,
				   render: function ( data, type, row, meta ) {                   
					return "<a href='<?php echo base_url();?>admin/administrator_ubah/"+row[7]+"'> <button type='button' class='btn btn-xs btn-warning'><i class='fa fa-pencil'></i> Ubah</button></a> <a onclick=\"return confirm('Yakin untuk menghapus user ini ?')\" href='<?php echo base_url();?>admin/administrator_aksi_hapus/"+row[7]+"'> <button type='button' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i> Hapus</button></a>";
				   }
				},],
		});

setInterval( function () {
    myTable.ajax.reload();
}, 4000 );
</script>