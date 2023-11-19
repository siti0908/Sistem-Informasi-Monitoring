
    <body><br>
        <div class="card ">
              <div class="card-header">
                <div class="row">
                  <div class="col">
                    <h5 class="mt-2 font-weight-bold text-primary "> <b> Daftar List Vendor </b></h5>
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                    <?php echo anchor(site_url('vendor/excel'), '<i class="fa fa-download">    </i>   Excel ', 'class="btn btn-success"'); ?>
                   </div>
                  <div class="col-xs-6" style="text-align: right;">
                  <a class="btn btn-primary shadow" href="<?php echo site_url('vendor/create');?>">
                      <span class="icon  ">
                        <i class="fas fa-user-plus mr-lg-2"></i>
                      </span>Tambah Data Vendor </a>
                    <!-- <?php echo anchor(site_url('vendor/create'),' <i class="fa fa-user-plus"> </i>  ', 'class="btn btn-primary"'); ?>
                      </span>Tambah Data User </a> -->
                  </div>
                </div>
              </div>

        
              <div class="card-body shadow table-responsive">
                <table id="example1" class="shadow table table-bordered table-striped " >
                  <thead class="thead-dark">
            
            <tr>
                <th>No</th>
        <th>Kode Pesanan</th>
		<th width="100">Nama Vendor</th>
		<th width="200">Alamat</th>
		<th>No Tlp</th>
		<th>Email</th>
        <th>Pekerjaan</th>
        <th>Jumlah Pembayaran</th>
        <th>Tanggal Pesanan</th>
		<th width="100">Nama Client</th>
		<th width="500"><center>Action</center></th>
            </tr></thead><tbody><?php
            foreach ($vendor_data as $vendor)
            {
                ?>
                <tr>
			<td width="20px"><?php echo ++$start ?></td>
            <td><?php echo $vendor->kode_pesanan ?></td>
			<td width="100"><?php echo $vendor->nama_vendor ?></td>
			<td width="200"><?php echo $vendor->alamat ?></td>
			<td><?php echo $vendor->no_tlp ?></td>
			<td><?php echo $vendor->email ?></td>
            <td><?php echo $vendor->jenis_transportasi ?></td>
            <td width="150">Rp. <?php  echo number_format($vendor->jumlah_pembayaran, 0, '', '.')?></td>
            <td><?php echo $vendor->tanggal_pesanan ?></td>
			<td width="100"><?php echo $vendor->nama_client ?></td>
			<td style="text-align:center" width="150px">
				<?php 
				// echo anchor(site_url('vendor/read/'.$vendor->id_vendor),'<div class="btn btn-primary btn-sm" title="Lihat Selengkapnya"><i class="fa fa-search-plus" ></i></div>'); 
				// echo ' | '; 
				echo anchor(site_url('vendor/update/'.$vendor->id_vendor),'<div class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit" ></i></div>'); 
				// echo ' | '; 
				// echo anchor(site_url('vendor/delete/'.$vendor->id_vendor),'<div class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash" ></i></div>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
   
                <?php
            }
            ?>
             </tbody>
        </table>




        
      
    </body>
</html>