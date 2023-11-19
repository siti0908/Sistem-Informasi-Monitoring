
    </head>
    <body>
        <br>
       

       <div class="card ">
              <div class="card-header">
                <div class="row">
                  <div class="col" >
                    <h5 class="mt-2 font-weight-bold text-primary "> <b> Daftar List Invoice </b></h5>
                  </div>
                   <div class="col-md-6" style="text-align: right;">
                    <?php echo anchor(site_url('invoice/excel'), '<i class="fa fa-download"> </i> Excel', 'class="btn btn-success"'); ?>
                   </div>
                  <div class="col-xs-6" style="text-align: right;">
                  <a class="btn btn-primary shadow" href="<?php echo site_url('invoice/create');?>">
                      <span class="icon  ">
                        <i class="fas fa-user-plus mr-lg-2"></i>
                      </span>Tambah Data Invoice </a>
                    <!-- <?php echo anchor(site_url('invoice/create'),' <i class="fa fa-user-plus"> </i>  ', 'class="btn btn-primary"'); ?>
                      </span>Tambah Data User </a> -->
                  </div>
                </div>
              </div>

        
                <div class="card-body table-responsive shadow">
                <table id="example3" class="shadow table table-bordered table-striped " >
                  <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th width="150"><center>Kode Pesanan</center></th>
        		<th width="200"><center>Nama Client</center></th>
        		<th width="150"><center>Alamat</center></th>
        		<th width="150"><center>Account Payable (AP)</center></th>
                <th ><center>Bukti Pembayaran (AP)</center></th>
        		<th ><center>Tanggal Pembayaran (AP)</center></th>
        		<th><center>Status (AP)</center></th>        
                <th width="200"><center>Account Receivable (AR)</center></th>
                <th ><center>Bukti Pembayaran (AR)</center></th>
                <th ><center>Tanggal Pembayaran (AR)</center></th>
                <th><center>Status Pembayaran (AR)</center></th>
        		<th><center>Action</center></th>
            </tr></thead><tbody><?php
            foreach ($invoice_data as $invoice)
            {
                ?>
                <tr>

			<td width="50px"><?php echo ++$start ?></td>
            <td width="150"><?php echo $invoice->kode_pesanan ?></td>
			<td width="200"><?php echo $invoice->nama_client ?></td>
			<td width="150"><?php echo $invoice->alamat ?></td>
            <td width="150">Rp. <?php  echo number_format($invoice->jumlah_pembayaran, 0, '', '.')?></td>
			<!-- <td><?php echo $invoice->jumlah_pembayaran ?></td> -->
			<!-- <td><?php echo $invoice->bukti_pembayaran ?></td> -->
            <td><center><img src="<?=base_url('assets/bukti pembayaran/'.$invoice->bukti_pembayaran)?>" class="rounded" width='40%' > <br>
            <a target="_blank" href="<?=base_url('assets/bukti pembayaran/'.$invoice->bukti_pembayaran)?>"></a>
            <?php
            // Memeriksa apakah variabel $invoice->bukti_pembayaran terisi atau tidak
            if (!empty($invoice->bukti_pembayaran)) {
                // Jika variabel terisi, tampilkan tautan "Lihat Detail"
                echo '<a target="_blank" href="' . base_url('assets/bukti pembayaran/' . $invoice->bukti_pembayaran) . '">Lihat Detail</a>';
            } else {
                // Jika variabel tidak terisi, tautan "Lihat Detail" tidak ditampilkan
                echo 'Tidak ada bukti pembayaran';
            }
            ?></td></center>

            <td width="100"><?php echo $invoice->tanggal_pembayaran ?></td>

              <td width="100"><center><?php if($invoice->status=="Paid"){
                echo "<span class='badge badge-success' style='background-color:green;color:#fff'>Paid</span>";
            } else{ echo "<span class='badge badge-danger' style='background-color:#f8294a;color:#fff'>Unpaid</span>";
            }?></td></center>
             
            <td width="150">Rp. <?php  echo number_format($invoice->jumlah_pembayaran_customer, 0, '', '.')?></td>
            <!-- <td><?php echo $invoice->jumlah_pembayaran ?></td> -->
            <!-- <td><?php echo $invoice->bukti_pembayaran ?></td> -->
            <td><center><img src="<?=base_url('assets/bukti pembayaran/'.$invoice->bukti_pembayaran_customer)?>" class="rounded" width='40%' > <br>
            <a target="_blank" href="<?=base_url('assets/bukti pembayaran/'.$invoice->bukti_pembayaran_customer)?>"></a>
            <?php
            // Memeriksa apakah variabel $invoice->bukti_pembayaran terisi atau tidak
            if (!empty($invoice->bukti_pembayaran_customer)) {
                // Jika variabel terisi, tampilkan tautan "Lihat Detail"
                echo '<a target="_blank" href="' . base_url('assets/bukti pembayaran/' . $invoice->bukti_pembayaran_customer) . '">Lihat Detail</a>';
            } else {
                // Jika variabel tidak terisi, tautan "Lihat Detail" tidak ditampilkan
                echo 'Tidak ada bukti pembayaran';
            }
            ?></td></center>
            <td width="100"><?php echo $invoice->tanggal_pembayaran_customer ?></td>

         
           <td width="100"><center><?php if($invoice->status_customer=="Paid"){
                echo "<span class='badge badge-success' style='background-color:green;color:#fff'>Paid</span>";
            } else{ echo "<span class='badge badge-danger' style='background-color:#f8294a;color:#fff'>Unpaid</span>";
            }?></td></center>
			<td style="text-align:center" width="200px">
				<?php 
				// echo anchor(site_url('invoice/read/'.$invoice->id_invoice),'<div class="btn btn-primary btn-sm" title="Lihat Selengkapnya"><i class="fa fa-search-plus" ></i></div>'); 
				// echo ' | '; 
				echo anchor(site_url('invoice/update/'.$invoice->id_invoice),'<div class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit" ></i></div>'); 
				// echo ' | '; 
				// echo anchor(site_url('invoice/delete/'.$invoice->id_invoice),'<div class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash" ></i></div>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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