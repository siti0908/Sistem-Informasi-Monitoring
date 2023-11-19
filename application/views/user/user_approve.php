 </head>
    <body>
        <br>
    <!-- <h2 style="margin-top:0px"><center>Daftar User</center></h2> -->
      <div class="card ">
              <div class="card-header">             
                <div class="row">
                  <div class="col">
                    <h5 class="mt-2 font-weight-bold text-primary "> <b> Daftar User Belum Di Approve </b></h5>
                  </div>

                  <div class="col-xs-5" style="text-align: right;">
                       <?php echo anchor(site_url('user'),'<i class="fa fa-hand-point-left"></i>      Kembali ', 'class="btn btn-danger"'); ?>
                   </div> 
                   <div class="col-xs-6" style="text-align: right;">
                   
                   </div> 
                  <div class="col-xs-8" style="text-align: right;">
                 
                  </div>
                </div>
              </div>

        
            <div class="card-body shadow">
            <table id="example1" class="shadow table table-bordered table-striped " >
                  <thead class="thead-dark">
            <tr>
                <th>No</th>
		<th>Username</th>
		
		<th>Email</th>
		<th>Nama Client</th>
		<th>Alamat</th>
		<th>Hak Akses</th>
		<th><center> Approve </center></th>
            </tr></thead><tbody><?php
            $i = 1;
            foreach ($user_data as $user)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $i++ ?></td>
			<td><?php echo $user->username ?></td>
			
			<td><?php echo $user->email ?></td>
			<td><?php echo $user->nama_client ?></td>
			<td><?php echo $user->alamat ?></td>
			<td><?php echo $user->hak_akses ?></td>
			<td style="text-align:center" width="150px">
            <form action = "<?php echo site_url('user/approve/'.$user->id_client)?>" method = 'POST'>
            <button class = "btn btn-success" type="submit"><i class="fa fa-hand-pointer"></i></button>
            </form>
			</td>
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <!-- <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div> -->
            <!-- <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div> -->
        </div>
    </body>
</html>