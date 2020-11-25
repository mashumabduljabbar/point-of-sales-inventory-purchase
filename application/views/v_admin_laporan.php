  <div class="content-wrapper" >
    
 <!-- Main content -->
    <section class="content" >
      <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
				  <div class="row">
				  <?php 
				  $attributes1 = array('target' => '', 'id' => 'myform');
				  echo form_open_multipart("laporan/cetak_laporan",$attributes1); ?>
					<div class="col-md-4">
					  <div class="form-group">
						<h3 class="box-title">
							<span>Pilih bentuk Laporan</span>
						</h3>
					  </div>
					  <div class="form-group">
						<label>Pilih Data</label>
						<br><input type="radio" name="pilih_data" value="0"  checked > Semua
						<br><input type="radio" name="pilih_data" value="1"  > Data History Peminjaman Inventaris Labor
						<br><input type="radio" name="pilih_data" value="2"  > Data History Peminjaman Ruangan Labor
						<br><input type="radio" name="pilih_data" value="3"  > Data Peminjam Yang Terkena Sanksi
					  </div>
					  <div id="tanggal">
						  <div class="form-group">
							<label>Pilih Tanggal Mulai</label>
							<input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" >
						  </div>
						  <div class="form-group">
							<label>Pilih Tanggal Selesai</label>
							<input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" >
						  </div>
					  </div>
					  <div class="form-group">
						<input type="submit" value="Cetak PDF" form="myform" class="btn btn-success">
					  </div>
					</div>
					<?php echo form_close(); ?>
					 <?php 
				  $attributes2 = array('target' => '', 'id' => 'myform2');
				  echo form_open_multipart("laporan/cetak_inbox", $attributes2); ?>
					<div class="col-md-6">
						<div class="col-md-12">
							<div class="form-group">
							<h3 class="box-title">
								<span>Inbox</span>
							</h3>
							</div>
						  
							<div class="col-md-5"><label>Pilih Tanggal Mulai</label>
							<label><input type="date" name="tanggal_mulai" class="form-control" required></label></div>
							<div class="col-md-5"><label>Pilih Tanggal Selesai</label>
							<label><input type="date" name="tanggal_selesai" class="form-control" required></label></div>
							<div class="col-md-2"><label>&nbsp;</label><label><input type="submit" value="Cetak Inbox" form="myform2" class="btn btn-success"></label></div>
						  
						</div>
						<div class="col-md-12">
							<div class="box-body">
								<table id="datatable" class="table table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
									<tr>
										<th>Waktu</th>
										<th>Isi Pesan</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				  </div>
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
$("#tanggal").show();
$('input[type="radio"]').click(function() {
        var valueradio = $(this).val();
		if(valueradio==3){
			 $("#tanggal").hide();
			 document.getElementById("tanggal_mulai").required = false;
			 document.getElementById("tanggal_selesai").required = false;
		}else{
			 $("#tanggal").show();
			 document.getElementById("tanggal_mulai").required = true;
			 document.getElementById("tanggal_selesai").required = true;
		}
    });
	
var myTable =  $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
			"paging": true,
			"info": true,
			'order': [[0, 'desc']],
			"ajax": "<?php echo base_url('admin/get_data_master_inbox/');?>" ,
		});

</script>