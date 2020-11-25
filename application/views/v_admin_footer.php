<footer class="main-footer"  style="text-align:center;">
    <div class="pull-right hidden-xs">
    </div>
    <strong><small>Labor Komputer FASILKOM - UNILAK 2020</small></strong> 
  </footer>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script type="text/javascript">        
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
		var waktu = new Date();            //membuat object date berdasarkan waktu saat 
		var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
		var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
		var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
		var hari = waktu.getDate();
		var bulan = waktu.getMonth()+1 ;
		var tahun = waktu.getFullYear();
		document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
		document.getElementById("clock2").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
		<?php if($this->uri->segment(2)=="peminjamaninv_ubah" && $this->uri->segment(4)=="konfirmasi"){ ?>
		document.getElementsByName("tanggal_peminjaman")[0].value = (tahun+"-"+bulan+"-"+hari+" ") + (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
		<?php } ?>
		<?php if($this->uri->segment(2)=="peminjamaninv_ubah" && $this->uri->segment(4)=="kembali"){ ?>
			document.getElementsByName("tanggal_kembali")[0].value = (tahun+"-"+bulan+"-"+hari+" ") + (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
		<?php } ?>
    }
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
	
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

  });
</script>
<script>
 $(':radio').change(function (event) {
    var id = $(this).data('id');
    $('#' + id).addClass('none').siblings().removeClass('none');
});
 </script>
</body>
</html>