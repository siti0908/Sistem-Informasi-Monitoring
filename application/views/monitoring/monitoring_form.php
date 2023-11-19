
    <body><br>
        <!-- <h2 style="margin-top:0px">Monitoring <?php echo $button ?></h2> -->
        <?php echo form_open_multipart($action);?>
        <!-- <form action="<?php echo $action; ?>" method="post"> -->
	    <div class="card card-info">
      <div class="card-header">
        <h1 class="card-title">Monitoring <?php echo $button ?></h1>
      </div>
      <div class="card-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-braille"></i></span>
          </div>
    

        <select name="kode_pesanan" id="kode_pesanan" onchange="get_invoice()" class="form-control" <?= $isDisabled?>>
            <option value="">-- Pilih Kode Pesanan --</option>
            <?php foreach ($list_invoice as $li): ?>
                <option value="<?= $li ?>" <?= ($li == $kode_pesanan) ? 'selected' : '' ?>><?= $li ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="kode_pesanan_hidden" id="kode_pesanan_hidden" value="<?php echo $kode_pesanan; ?>">
</div>

	     <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-address-book"></i></span>
          </div>
        <input type="text" class="form-control" name="nama_client" id="nama_client" placeholder="Nama Client" readonly="readonly" value="<?php echo $nama_client; ?>" ?>
    <input type="hidden" class="form-control" name="nama_client_hidden"  id="nama_client_hidden"/>
        </div>


	    <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
          </div>
         <input class="form-control" rows="3"  readonly="readonly" name="alamat" id="alamat"placeholder="Alamat" value="<?php echo $alamat; ?>"></input>
        <input type="hidden" class="form-control" name="alamat_hidden"  id="alamat_hidden"/>
        </div> 

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-ship"></i></span>
          </div>
         <input class="form-control" rows="3"  readonly="readonly" name="jenis_transportasi" id="jenis_transportasi"placeholder="Pekerjaan" value="<?php echo $jenis_transportasi; ?>"></input>
        <input type="hidden" class="form-control" name="jenis_transportasi_hidden"  id="jenis_transportasi_hidden"/>
        </div> 

	    <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
          </div>
        <input type="text" class="form-control" name="status_customer" id="status_customer" placeholder="Status Customer" readonly="readonly" value="<?php echo $status_customer; ?>" ?>
        <input type="hidden" class="form-control" name="status_customer_hidden"  id="status_customer_hidden"/>
        </div>


 <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-boxes"></i></span>  
          </div>
         <input type="text" class="form-control" name="jenis_barang" id="jenis_barang" placeholder="Jenis Barang" value="<?php echo $jenis_barang; ?>" />
        </div> 


<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
          </div>
         <input type="text" class="form-control" name="berat_barang" id="berat_barang" placeholder="Berat Barang" value="<?php echo $berat_barang; ?>" />
        </div>

	 
<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-route"></i></span>
          </div>
         <input type="text" class="form-control" name="rute_pengiriman" id="rute_pengiriman" placeholder="Rute Pengiriman" value="<?php echo $rute_pengiriman; ?>" />
        </div>

	  

	    <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-flag-checkered"></i></span>
          </div>
           <select class="custom-select" name="status_pengiriman">
            <option value="#" >Pilih Status Pengiriman</option>
            <option value="Belum Dikirim" <?php echo ($status_pengiriman == "Belum Dikirim") ? 'selected' : ''; ?>>Belum Dikirim</option>
            <option value="Dalam Perjalanan" <?php echo ($status_pengiriman == "Dalam Perjalanan") ? 'selected' : ''; ?>>Dalam Perjalanan</option>
            <option value="Sampai Tujuan" <?php echo ($status_pengiriman == "Sampai Tujuan") ? 'selected' : ''; ?>>Sampai Tujuan</option>
                        </select>
    </div>

 <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-image"></i></span>
          </div>
           <input type="file" class="form-control" name="foto_1" id="foto_1"  placeholder="Upload Foto" value="<?php echo $foto_1; ?>" onchange="updateLabel(this)"/>
           <label class="custom-file-label"  for="foto_1"><?php echo $foto_1; ?></label>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-image"></i></span>
          </div>
           <input type="file" class="form-control" name="foto_2" id="foto_2" placeholder="Upload Foto" value="<?php echo $foto_2; ?>" onchange="updateLabel(this)"/>
           <label class="custom-file-label"  for="foto_2"><?php echo $foto_2; ?></label>
        </div>

<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-image"></i></span>
          </div>
           <input type="file" class="form-control" name="foto_3" id="foto_3" placeholder="Upload Foto" value="<?php echo $foto_3; ?>" onchange="updateLabel(this)"/>
           <label class="custom-file-label"  for="foto_3"><?php echo $foto_3; ?></label>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-image"></i></span>
          </div>
           <input type="file" class="form-control" name="foto_4" id="foto_4" placeholder="Upload Foto" value="<?php echo $foto_4; ?>" onchange="updateLabel(this)"/>
           <label class="custom-file-label"  for="foto_4"><?php echo $foto_4; ?></label>
        </div>

	    <input type="hidden" name="id_monitoring" value="<?php echo $id_monitoring; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('monitoring') ?>" class="btn btn-danger">Cancel</a>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script type="text/javascript">
function get_invoice() {
  var kode_pesanan = $('#kode_pesanan').val();

  var formdata = new FormData();
  formdata.append('kode_pesanan', kode_pesanan);

  $.ajax({
  type: 'POST',
  url: "<?= base_url('monitoring/get_invoice'); ?>",
  data: formdata,
  processData: false,
  contentType: false,
  dataType: 'json',
  success: function (response) {
    if(response != null){
     $('#nama_client_hidden').val(response.nama_client_hidden);
      $('#nama_client').val(response.nama_client);
      $('#alamat_hidden').val(response.alamat_hidden);
      $('#alamat').val(response.alamat);
      $('#status_customer_hidden').val(response.status_customer_hidden);
      $('#status_customer').val(response.status_customer);
      $('#jenis_transportasi_hidden').val(response.jenis_transportasi_hidden);
      $('#jenis_transportasi').val(response.jenis_transportasi);
    }else{
      $('#nama_client_hidden').val("");
        $('#nama_client').val("");
        $('#alamat_hidden').val("");
        $('#alamat').val("");
        $('#status_customer_hidden').val("");
        $('#status_customer').val("");
        $('#jenis_transportasi_hidden').val("");
        $('#jenis_transportasi').val("");
    }
      
      }
    });
  }

  function get_vendor() {
  var kode_pesanan = $('#kode_pesanan').val();

  var formdata = new FormData();
  formdata.append('kode_pesanan', kode_pesanan);

  $.ajax({
  type: 'POST',
  url: "<?= base_url('monitoring/get_vendor'); ?>",
  data: formdata,
  processData: false,
  contentType: false,
  dataType: 'json',
  success: function (response) {
     
      $('#jenis_transportasi_hidden').val(response.jenis_transportasi_hidden);
      $('#jenis_transportasi').val(response.jenis_transportasi);
      }
    });
  }



function updateLabel(input) {
    var fileName = input.files[0].name;
    $(input).next('.custom-file-label').html(fileName);
}

</script>
<?php echo form_close();?>
 <!--  </form>
    </body>
</html> -->