
    <body><br>
        <h2 style="margin-top:0px">Vendor Read</h2>
        <table class="table">
        <tr><td>Kode Pesanan</td><td><?php echo $kode_pesanan; ?></td></tr>
	    <tr><td>Nama Vendor</td><td><?php echo $nama_vendor; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Tlp</td><td><?php echo $no_tlp; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
        <tr><td>Jenis Transportasi</td><td><?php echo $jenis_transportasi; ?></td></tr>
        <tr><td>Jenis Transportasi</td><td><?php echo $jumlah_pembayaran; ?></td></tr>
        <tr><td>Jenis Transportasi</td><td><?php echo $tanggal_pesanan; ?></td></tr>
	    <tr><td>Jenis Transportasi</td><td><?php echo $nama_client; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('vendor') ?>" class="btn btn-danger">Cancel</a></td></tr>
	</table>
        </body>
</html>