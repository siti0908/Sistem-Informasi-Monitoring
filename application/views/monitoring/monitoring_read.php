
    <body>
        <h2 style="margin-top:0px">Monitoring Read</h2>
        <table class="table">
	    <tr><td>Kode Pesanan</td><td><?php echo $kode_pesanan; ?></td></tr>
	    <tr><td>Nama Client</td><td><?php echo $nama_client; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Jenis Transportasi</td><td><?php echo $jenis_transportasi; ?></td></tr>
	    <tr><td>Status Customer</td><td><?php echo $status_customer; ?></td></tr>
	    <tr><td>Jenis Barang</td><td><?php echo $jenis_barang; ?></td></tr>
	    <tr><td>Berat Barang</td><td><?php echo $berat_barang; ?></td></tr>
	    <tr><td>Rute Pengiriman</td><td><?php echo $rute_pengiriman; ?></td></tr>
	    <tr><td>Status Pengiriman</td><td><?php echo $status_pengiriman; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('monitoring') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>