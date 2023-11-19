</head>
    <body>
        <br>
            <div class="card ">
              <div class="card-header">
                <div class="row">
                  <div class="col" >
                    <h5 class="mt-2 font-weight-bold text-primary "> <b> Daftar List Monitoring </b></h5>
                  </div>
                   <?php if ($_SESSION['hak_akses'] == 'admin'
          ){
          ?>
                   <div class="col-md-6" style="text-align: right;">
                    <?php echo anchor(site_url('monitoring/excel'), '<i class="fa fa-download"> </i> Excel', 'class="btn btn-success"'); ?>
                   </div>
                  <div class="col-xs-6" style="text-align: right;">
                  <a class="btn btn-primary shadow" href="<?php echo site_url('monitoring/create');?>">
                      <span class="icon  ">
                        <i class="fas fa-user-plus mr-lg-2"></i>
                      </span>Tambah Data Monitong </a>
                    <!-- <?php echo anchor(site_url('monitoring/create'),' <i class="fa fa-user-plus"> </i>  ', 'class="btn btn-primary"'); ?>
                      </span>Tambah Data User </a> -->
                  </div>
                </div>
              </div>
            <?php
          }
          ?>
        
                <div class="card-body table-responsive shadow">
                <table id="example3" class="shadow table table-bordered table-striped " >
                  <thead class="thead-dark text-center">
            <tr>
                <th>No</th>
		<th>Kode Pesanan</th>
		<th>Nama Client</th>
		<th>Alamat</th>
		<th>Pekerjaan</th>
		<th>Status Pembayaran</th>
		<th>Jenis Barang</th>
        <th>Berat Barang</th>
		<th>Tanggal Pengiriman</th>
		<th>Rute Pengiriman</th>
        <th>Status Pengiriman</th>
        <th>Dokumentasi </th>
        
       
		<th>Action</th>
            </tr></thead><tbody><?php
            foreach ($monitoring_data as $monitoring)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $monitoring->kode_pesanan ?></td>
			<td><?php echo $monitoring->nama_client ?></td>
			<td><?php echo $monitoring->alamat ?></td>
			<td><?php echo $monitoring->jenis_transportasi ?></td>
			<td width="100"><center><?php if($monitoring->status_customer=="Paid"){
                echo "<span class='badge badge-success' style='background-color:green;color:#fff'>Paid</span>";
            } else{ echo "<span class='badge badge-danger' style='background-color:#f8294a;color:#fff'>Unpaid</span>";
            }?></td></center>
			<td><?php echo $monitoring->jenis_barang ?></td>
            <td><?php echo $monitoring->berat_barang ?></td>
			<td><?php echo $monitoring->tanggal_pengiriman ?></td>
			<td><?php echo $monitoring->rute_pengiriman ?></td>
			<td><?php if($monitoring->status_pengiriman=="Sampai Tujuan"){
                                echo "<span class='badge badge-success  rounded-pill' style='background-color:green;color:#fff'>  Sampai Tujuan  </span>";
                            } elseif ($monitoring->status_pengiriman=="Dalam Perjalanan"){
                                echo "<span class='badge badge-warning  rounded-pill' style='background-color:#f1c40f;color:#000'>  Dalam Perjalanan   </span>";  
                            }
                            else{
                           echo "<span class='badge badge-danger  rounded-pill' style='background-color: #f8294a;color:#fff'>Belum Dikirim</span>";
                            }?></td>
            <!-- <td><?php echo $monitoring->foto_1 ?></td> -->
         <td>
    <div style="display: flex; flex-wrap: wrap;">
    <?php if ($monitoring->foto_1): ?>
        <div style="flex: 50%; padding: 1px;">
            <a href="<?php echo base_url('assets/dokumentasi/' . $monitoring->foto_1); ?>" target="_blank">
                <img src="<?php echo base_url('assets/dokumentasi/' . $monitoring->foto_1); ?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
    <?php endif; ?>
    <?php if ($monitoring->foto_2): ?>
        <div style="flex: 50%; padding: 1px;">
            <a href="<?=base_url('assets/dokumentasi/'.$monitoring->foto_2)?>" target="_blank">
                <img src="<?=base_url('assets/dokumentasi/'.$monitoring->foto_2)?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
    <?php endif; ?>
    <?php if ($monitoring->foto_3): ?>
        <div style="flex: 50%; padding: 1px;">
            <a href="<?=base_url('assets/dokumentasi/'.$monitoring->foto_3)?>" target="_blank">
                <img src="<?=base_url('assets/dokumentasi/'.$monitoring->foto_3)?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
    <?php endif; ?>
    <?php if ($monitoring->foto_4): ?>
        <div style="flex: 50%; padding: 1px;">
            <a href="<?=base_url('assets/dokumentasi/'.$monitoring->foto_4)?>" target="_blank">
                <img src="<?=base_url('assets/dokumentasi/'.$monitoring->foto_4)?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
    <?php endif; ?>
</div>

</td>


			<td style="text-align:center" width="500px">
				<?php 
                echo '<a  onclick="showHistory(' . $monitoring->id_monitoring . ');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="History"><i class="far fa-clock"></i>' . '</a>';
				if ($_SESSION['hak_akses'] == 'admin' ) {
             echo ' | '; 
                echo anchor(site_url('monitoring/update/'.$monitoring->id_monitoring),'<div class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit" ></i></div>');  
				
         }
?>
             

			</td>
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <!-- Modal -->

<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">History Pengiriman</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
      
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

        <!-- <script type="text/javascript"> -->
            <script type="text/javascript">
    function showHistory(id) {
        var id_monitoring = id;

        $.ajax({
            type: "GET",
            url: "<?= base_url('monitoring/getHistory')?>",
            data: {
                id_monitoring: id_monitoring
            },
            dataType: "json",
            success: function (response) {
                var modal = $('#exampleModal');
                var html = '<table class="table table-bordered table-responsive">';
                html += '<thead><tr>' +
                    '<th>Kode Pesanan</th>' +
                    '<th>Nama Client</th>' +
                    '<th>Jenis Transportasi</th>' +
                    '<th>Tanggal Pengiriman</th>' +
                    '<th >Rute Pengiriman</th>' +
                    '<th>Status Pengiriman</th>' +
                    '<th>Dokumentasi 1</th>' +
                    '<th>Dokumentasi 2</th>' +
                    '<th>Dokumentasi 3</th>' +
                    '<th>Dokumentasi 4</th>' +
                    '</tr></thead>';
                html += '<tbody>';
                
                $.each(response, function (i, data) {
                    html += '<tr>' +
                        '<td >' + data.kode_pesanan + '</td>' +
                        '<td >' + data.nama_client + '</td>' +
                        '<td>' + data.jenis_transportasi + '</td>' +
                        '<td>' + data.tanggal_pengiriman + '</td>' +
                        '<td>' + data.rute_pengiriman + '</td>' +
                        '<td>' + data.status_pengiriman + '</td>' +
                            '<td>';
                if (data.foto_1) {
                    html += '<a href="<?= base_url("assets/dokumentasi/") ?>' + data.foto_1 + '" target="_blank"><img src="<?= base_url("assets/dokumentasi/") ?>' + data.foto_1 + '" class="rounded" width="100%" alt="Dokumentasi 1"></a>';
                }
                html += '</td><td>';
                if (data.foto_2) {
                    html += '<a href="<?= base_url("assets/dokumentasi/") ?>' + data.foto_2 + '" target="_blank"><img src="<?= base_url("assets/dokumentasi/") ?>' + data.foto_2 + '" class="rounded" width="100%" alt="Dokumentasi 2"></a>';
                }
                html += '</td><td>';
                if (data.foto_3) {
                    html += '<a href="<?= base_url("assets/dokumentasi/") ?>' + data.foto_3 + '" target="_blank"><img src="<?= base_url("assets/dokumentasi/") ?>' + data.foto_3 + '" class="rounded" width="100%" alt="Dokumentasi 3"></a>';
                }
                html += '</td><td>';
                if (data.foto_4) {
                    html += '<a href="<?= base_url("assets/dokumentasi/") ?>' + data.foto_4 + '" target="_blank"><img src="<?= base_url("assets/dokumentasi/") ?>' + data.foto_4 + '" class="rounded" width="100%" alt="Dokumentasi 4"></a>';
                }
                html += '</td></tr>';
            });
                
                html += '</tbody>';
                html += '</table>';

                $('.modal-body').html(html);
                modal.modal('show');
            }
        });
    }
</script>

        </script>
    </body>
</html>