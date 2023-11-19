 
 


    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Dashboard</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
    
        <div class="row ">
       <!--    <div class="col-lg-2 col-6">
</div> -->
 
          <div class="col-lg-3 col-6 ">
            
            <div class="small-box bg-info text-white">
              <div class="inner">
                <h3  id="p1"><?= $jml_user?></h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        
            </div>
          </div> 

        
          <!-- ./kantor -->

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="p1"><?= $jml_vendor?></h3>

                <p>Vendor</p>
              </div>
              <div class="icon">
                <i class="fas fa-business-time"></i>
              </div>
           
              <!-- <a href="<?php echo site_url('vendor');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->

            </div>
          </div>
        
          <!-- ./col -->
          <div class="col-lg-3 col-6 ">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="p1"><?= $jml_monitoring?></h3>

                <p id="p1">Monitoring</p>
              </div>
              <div class="icon">
                <i class="fas fa-map-marked-alt"></i>
              </div>
              <!-- <a href="<?php echo site_url('monitoring');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
               <!-- <div class="col-lg-2 col-6">
</div> -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="p1"><?= $jml_invoice?></h3>

                <p>Invoice</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <!-- <a href="<?php echo site_url('invoice');?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        </div>
        <!-- /.row -->

 <?php if ($_SESSION['hak_akses'] == 'admin' 
          ){
          ?>

  <section class="col-lg-12 connectedSortable"> 
       <div class="card ">
              <div class="card-header">
                <div class="row">
                  <div class="col" >
                    <h5 class="mt-2 font-weight-bold text-primary "> <b> Daftar Invoice</b></h5>
                  </div>
                   
                  <div class="col-xs-6" style="text-align: right;">
                  <a class="btn btn-primary shadow" href="<?php echo site_url('invoice');?>">
                      <span class="icon  ">
                        <i class="fas fa-info-circle mr-lg-2"></i>
                      </span>More Info </a>
                  </div>
                </div>
              </div>

        
                <div class="card-body table-responsive shadow">
                <table id="example3" class="shadow table table-bordered table-striped " >
                  <thead class="thead-dark text-center">
            <tr>
            <th width="100">Kode Pesanan</th>
            <th width="100">Nama Client</th>
            <th width="100">Jumlah Pembayaran (AP)</th>
            <th width="100">Status (AP)</th> 
            <th width="100">Jumalah Pembayaran (AR)</th>
            <th width="100">Status (AR)</th>       
            </tr></thead><tbody><?php
            foreach ($invoice_data as $invoice)
            {
                ?>
                <tr>

            <td width="100"><?php echo $invoice->kode_pesanan ?></td>
            <td width="100"><?php echo $invoice->nama_client ?></td>
            <td width="150">Rp. <?php  echo number_format($invoice->jumlah_pembayaran, 0, '', '.')?></td>
            <td width="100"><center><?php if($invoice->status=="Paid"){
                echo "<span class='badge badge-success' style='background-color:green;color:#fff'>Paid</span>";
            } else{ echo "<span class='badge badge-danger' style='background-color:#f8294a;color:#fff'>Unpaid</span>";
            }?></td></center>
             <td width="150">Rp. <?php  echo number_format($invoice->jumlah_pembayaran_customer, 0, '', '.')?></td>
           <td width="100"><center><?php if($invoice->status_customer=="Paid"){
                echo "<span class='badge badge-success' style='background-color:green;color:#fff'>Paid</span>";
            } else{ echo "<span class='badge badge-danger' style='background-color:#f8294a;color:#fff'>Unpaid</span>";
            }?></td></center>
          
     
    </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
</section>


    <?php
          }
          ?>

<!-- halaman dashboard monitoring -->

  <section class="col-lg-12 connectedSortable"> 

 <div class="card ">
              <div class="card-header">
                <div class="row">
                  <div class="col" >
                    <h5 class="mt-2 font-weight-bold text-primary "> <b> Daftar  Monitoring </b></h5>
                  </div>
        
                  
                  <div class="col-xs-6" style="text-align: right;">
                  <a class="btn btn-primary shadow" href="<?php echo site_url('monitoring');?>">
                      <span class="icon  ">
                        <i class="fas fa-info-circle mr-lg-2"></i>
                      </span>More Info </a>
                
                  </div>
                </div>
              </div>
         
        
                <div class="card-body table-responsive shadow">
                <table id="example3" class="shadow table table-bordered table-striped " >
                  <thead class="thead-dark text-center">
            <tr>
            <th width="100">Kode Pesanan</th>
            <th width="100">Nama Client</th>
            <th width="100">Pekerjaan</th>
            <th width="100">Status Pembayaran</th>
            <th>Tanggal Pengiriman</th>
            <th>Rute Pengiriman</th>
            <th>Status Pengiriman</th>
            <th width="300">Dokumentasi </th>      
            </tr></thead><tbody><?php
            foreach ($monitoring_data as $monitoring)
            {
                ?>
                <tr>
            <td  width="100"><?php echo $monitoring->kode_pesanan ?></td>
            <td  width="100"><?php echo $monitoring->nama_client ?></td>
            <td  width="100"><?php echo $monitoring->jenis_transportasi ?></td>
            <td width="100"><center><?php if($monitoring->status_customer=="Paid"){
                echo "<span class='badge badge-success' style='background-color:green;color:#fff'>Paid</span>";
            } else{ echo "<span class='badge badge-danger' style='background-color:#f8294a;color:#fff'>Unpaid</span>";
            }?></td></center>
            <td><?php echo $monitoring->tanggal_pengiriman ?></td>
            <td><?php echo $monitoring->rute_pengiriman ?></td>
            <td><center><?php if($monitoring->status_pengiriman=="Sampai Tujuan"){
                                echo "<span class='badge badge-success  rounded-pill' style='background-color:green;color:#fff'>  Sampai Tujuan  </span>";
                            } elseif ($monitoring->status_pengiriman=="Dalam Perjalanan"){
                                echo "<span class='badge badge-warning  rounded-pill' style='background-color:#f1c40f;color:#000'>  Dalam Perjalanan   </span>";  
                            }
                            else{
                           echo "<span class='badge badge-danger  rounded-pill' style='background-color: #f8294a;color:#fff'>Belum Dikirim</span>";
                            }?></td></center>
         <td>
    <div style="display: flex; flex-wrap: wrap;">
        <div style="flex: 50%; padding: 1px;">
            <a href="<?php echo base_url('assets/dokumentasi/' . $monitoring->foto_1); ?>" target="_blank">
                <img src="<?php echo base_url('assets/dokumentasi/' . $monitoring->foto_1); ?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
        <div style="flex: 50%; padding: 1px;">
            <a href="<?=base_url('assets/dokumentasi/'.$monitoring->foto_2)?>" target="_blank">
                <img src="<?=base_url('assets/dokumentasi/'.$monitoring->foto_2)?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
        <div style="flex: 50%; padding: 1px;">
            <a href="<?=base_url('assets/dokumentasi/'.$monitoring->foto_3)?>" target="_blank">
                <img src="<?=base_url('assets/dokumentasi/'.$monitoring->foto_3)?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
        <div style="flex: 50%; padding: 1px;">
            <a href="<?=base_url('assets/dokumentasi/'.$monitoring->foto_4)?>" target="_blank">
                <img src="<?=base_url('assets/dokumentasi/'.$monitoring->foto_4)?>" class="rounded" width='100%' alt="foto">
            </a>
        </div>
    </div>
</td>


      
    </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </section>


  <br>
 


 
  
     