
    <body><br>
        <h2 style="margin-top:0px">Invoice Read</h2>
        <table class="table">
	    <tr><td>Nama Client</td><td><?php echo $nama_client; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Jumlah Pembayaran</td><td><?php echo $jumlah_pembayaran; ?></td></tr>
        <tr><td>Bukti Pembayaran</td><td><?php echo $bukti_pembayaran; ?></td></tr>
	    <tr><td>Bukti Pembayaran</td><td><?php echo $tanggal_pembayaran; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
        <tr><td>Jumlah Pembayaran Customer</td><td>Rp.<?php echo $jumlah_pembayaran_customer; ?></td></tr>
        <tr><td>Bukti Pembayaran Customer</td><td><?php echo $bukti_pembayaran_customer; ?></td></tr>
        <tr><td>Tanggal Pembayaran Customer</td><td><?php echo $tanggal_pembayaran_customer; ?></td></tr>
        <tr><td>Status Pembayaran Customer</td><td><?php echo $status_customer; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('invoice') ?>" class="btn btn-danger">Cancel</a></td></tr>
	</table>
        </body>
</html>