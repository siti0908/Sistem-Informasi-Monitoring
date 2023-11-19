
    </head>
    <body>
        <br>
          
        <!-- <h2 style="margin-top:0px">User List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1">
                <?php echo anchor(site_url('user/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-3">
                <?php echo anchor(site_url('user/list_approve'),'Akun yang perlu diapprove', 'class="btn btn-danger"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('user/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div> -->
          <div class="card ">
              <div class="card-header">             
                <div class="row">
                  <div class="col">
                    <h5 class="mt-2 font-weight-bold text-primary "> <b> Daftar List User </b></h5>
                  </div>

                  <div class="col-xs-5" style="text-align: right;">
                    <?php echo anchor(site_url('user/excel'), '<i class="fa fa-download">  </i>  Excel', 'class="btn btn-success"'); ?>
                   </div> |
                   <div class="col-xs-6" style="text-align: right;">
                   <?php echo anchor(site_url('user/list_approve'),'Akun yang perlu diapprove', 'class="btn btn-danger"'); ?>
                   </div> |
                  <div class="col-xs-8" style="text-align: right;">
                  <a class="btn btn-primary shadow" href="<?php echo site_url('user/create');?>">
                      <span class="icon  ">
                        <i class="fas fa-user-plus mr-lg-2"></i>
                      </span>Tambah Data User </a>
                    <!-- <?php echo anchor(site_url('user/create'),' <i class="fa fa-user-plus"> </i>  ', 'class="btn btn-primary"'); ?>
                      </span>Tambah Data User </a> -->
                  </div>
                </div>
              </div>

        
            <div class="card-body shadow">
            <table id="example1" class="shadow table table-bordered table-striped " >
                  <thead class="thead-dark text-center">
            <tr>
                <th>No</th>
		<th>Nama Client</th>
		<th>Alamat</th>
		<th>No Tlp</th>
		<th>Username</th>
		<th>Email</th>
		<th>Status</th>
		<th><center>Action</center></th>
            </tr></thead><tbody><?php
            foreach ($user_data as $user)
            {
                ?>
                <tr>
			<td width="50px"><?php echo ++$start ?></td>
			<td><?php echo $user->nama_client ?></td>
			<td><?php echo $user->alamat ?></td>
			<td><?php echo $user->no_tlp ?></td>
			<td><?php echo $user->username ?></td>
			<td><?php echo $user->email ?></td>
			<td><center><?php if($user->status=="approve"){
                echo "<span class='badge badge-success' style='background-color:green;color:#fff'>approve</span>";
            } else{ echo "<span class='badge badge-danger' style='background-color:#f8294a;color:#fff'>belum approve</span>";
            }?></td>
			<td style="text-align:center" width="150px">
				<?php 
				echo anchor(site_url('user/read/'.$user->id_client),'<div class="btn btn-primary btn-sm" title="Lihat Selengkapnya"><i class="fa fa-search-plus" ></i></div>'); 
				echo ' | '; 
				echo anchor(site_url('user/update/'.$user->id_client),'<div class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit" ></i></div>'); 
				echo ' | '; 
				echo anchor(site_url('user/delete/'.$user->id_client),'<div class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash" ></i></div>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td></center>
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </body>
</html>