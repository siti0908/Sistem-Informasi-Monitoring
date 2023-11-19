
    <body><br>
        <h2 style="margin-top:0px">User Read</h2>
        <table class="table">
	    <tr><td>Nama Client</td><td><?php echo $nama_client; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Tlp</td><td><?php echo $no_tlp; ?></td></tr>
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $password; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Hak Akses</td><td><?php echo $hak_akses; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user') ?>" class="btn btn-danger">Cancel</a></td></tr>
	</table>
        </body>
</html>