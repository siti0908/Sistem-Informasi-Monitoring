<!DOCTYPE html>
<html>

<head>
	<title>Contoh DataTables</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<!-- Load DataTables Buttons -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
	<style>
		#gambarQrCode:hover {
			transform: scale(1.2);
			/* Memperbesar gambar menjadi 120% saat disorot */
			transition: transform 0.5s ease;
		}
	</style>
</head>

<body>

	<div class="container mt-4">

		<h2>Data Project</h2>
		<a target="_blank" href="<?= base_url('welcome/print'); ?>" class="btn btn-primary">PRINT</a>
		<table id="example" class="table table-striped table-bordered" style="width:100%;">
			<thead>
				<tr>
					<th>ID</th>
					<th>Project code</th>
					<th>Nama</th>
					<th>Klien</th>
					<th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Looping data mahasiswa
				foreach ($project as $value) {
					echo "<tr>";
					echo "<td class='text-center'><a href='" . generate_qrcode($value['id']) . "' target='_BLANK'><img id='gambarQrCode' src=" . generate_qrcode($value['id']) . " width='70px' /></a></td>";
					echo "<td>" . $value['project_code'] . "</td>";
					echo "<td>" . $value['name'] . "</td>";
					echo "<td>" . $value['client_name'] . "</td>";
					echo "<td class='text-center'><a href='" . base_url('welcome/cetak_resi/') . $value['id'] . "' class='btn btn-sm btn-primary' target='_blank'>Cetak Resi</a></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


	<script>
		$(document).ready(function() {
			$('#example').DataTable({
				"paging": true,
				"ordering": true,
				"info": false,
				"searching": true,
				"pageLength": 5, // Batasi jumlah baris menjadi 10
				// dom: 'Blfrtip',
				"lengthMenu": [
					[5, 10, 25, 50, -1],
					[5, 10, 25, 50, "All"]
				],
				buttons: [
					// 'print'
				],
				"language": {
					"paginate": {
						"next": "Selanjutnya",
						"previous": "Sebelumnya"
					},
					"search": "Cari:",
					"zeroRecords": "Data tidak ditemukan"
				}
			});
		});
	</script>

</body>

</html>