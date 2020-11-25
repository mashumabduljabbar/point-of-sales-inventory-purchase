
<style>
.laporan{
	width: 100%;
	border: 1px solid black;
	border-collapse: collapse;
}

th,td
{
    font-family: arial;
    font-size: 7pt;
	padding: 10px;
}
</style>
<table width="100%" style="border-bottom:1px solid black;">
<tr>
	<td style="text-align:right; padding:10px;" width="15%">
		<img src="<?php echo base_url(); ?>assets/dist/img/logo.png" width="60px">
	</td>
	<td style="text-align:center;" width="85%">
		<h4 style="text-align:center; font-size:1.1em"><b>Aplikasi e-Inventory Laboratorium <br>
		Fakultas Ilmu Komputer Universitas Lancang Kuning</b></h4>
	</td>
</tr>
</table>
<br>
<label><h4 style="text-align:center;">Inbox</h4></label>
<label><h5>Tanggal Cetak : <?php echo $tanggalcetak;?></h5><label/>
<br>
	<table>
		<tr>
			<td>Perihal : Data History Peminjaman Inventaris Labor</td>
		</tr>
		<tr>
			<td> Rentang Waktu Sejak : <?php echo $tanggal_mulai; ?>   Sampai : <?php echo $tanggal_selesai; ?> </td>
		</tr>
	</table>
	<table border="1" class="laporan">
		<tr>
			<th>No</th>
			<th>Waktu</th>
			<th>Isi Pesan</th>
		</tr>
	<?php		
		foreach($tbl_inbox as $inbox){
			echo "<tr>";
				echo "<td width='50px'>$inbox->rowNumber</td>";
				echo "<td width='150px'>$inbox->created_inbox</td>";
				echo "<td>$inbox->isi_inbox</td>";
			echo "</tr>";
		}
	?>
	</table>