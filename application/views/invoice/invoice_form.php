
<body><br>

<!-- <h2 style="margin-top:0px">Invoice <?php echo $button ?></h2> -->
<?php echo form_open_multipart($action);?>
<form action="<?php echo $action; ?>" method="post">

<div class="card card-info">
      <div class="card-header">
        <h1 class="card-title"> Invoice <?php echo $button ?></h1>
      </div>
      <div class="card-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-braille"></i></span>
          </div>

      <?php if($button=="Create"):?>
        <select name="kode_pesanan" id="kode_pesanan" onchange="get_vendor()" class="form-control">
            <option value="">-- Pilih Kode Pesanan --</option>
            <?php foreach ($list_vendor as $lv): ?>
                <option value="<?= $lv ?>" <?= ($lv == $kode_pesanan) ? 'selected' : '' ?>><?= $lv ?></option>
            <?php endforeach; ?>
        </select>
      <?php else:?>
        <select name="kode_pesanan" id="kode_pesanan" onchange="get_vendor()" class="form-control">
            <option value="">-- Pilih Kode Pesanan --</option>
            <?php foreach ($list_vendor as $lv): ?>
                <option value="<?= $lv->kode_pesanan ?>" <?= ($lv->kode_pesanan == $kode_pesanan) ? 'selected' : '' ?>><?= $lv->kode_pesanan ?></option>
            <?php endforeach; ?>
        </select>
      <?php endif; ?>
        
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
         <input class="form-control" rows="3" name="alamat" id="alamat"placeholder="Alamat" value="<?php echo $alamat; ?>"></input>
        </div> 

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span  for="email"  class="input-group-text"><b>Rp.</b></span>
          </div>
           <input type="text" class="form-control" name="jumlah_pembayaran" id="jumlah_pembayaran" placeholder="Jumlah Pembayaran Vendor" readonly="readonly" value="<?php echo $jumlah_pembayaran; ?>" />
     <input type="hidden" class="form-control" name="jumlah_pembayaran_hidden" id="jumlah_pembayaran_hidden" />
        </div>

         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-image"></i></span>
          </div>
         <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" placeholder="Bukti Pembayaran Vendor" value="<?php echo $bukti_pembayaran; ?>" onchange="updateLabel(this)"/>
         <label class="custom-file-label"  for="bukti_pembayaran"><?php echo $bukti_pembayaran; ?></label>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
          </div>
              <select class="custom-select" name="status">
            <option value="#" >Pilih Status Pembayaran Vendor</option>
            <option value="Paid" <?php echo ($status == "Paid") ? 'selected' : ''; ?>>Paid</option>
            <option value="Unpaid" <?php echo ($status == "Unpaid") ? 'selected' : ''; ?>>Unpaid</option>
            </select>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Rp.</b></span>
          </div>
          <input onkeypress="return isNumberKey(event)" class="form-control"  placeholder="Jumlah Pembayaran Customer" type="text" name="jumlah_pembayaran_customer" id="jumlah_pembayaran_customer" value="<?php echo $jumlah_pembayaran_customer; ?>" required>
        </div>

         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-image"></i></span>
          </div>
           <input type="file" class="form-control" name="bukti_pembayaran_customer" id="bukti_pembayaran_customer" placeholder="Bukti Pembayaran Customer" value="<?php echo $bukti_pembayaran_customer; ?>" onchange="updateLabel(this)"/>
           <label class="custom-file-label"  for="bukti_pembayaran_customer"><?php echo $bukti_pembayaran_customer; ?></label>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
          </div>
           <select class="custom-select" name="status_customer">
            <option value="#" >Pilih Status Pembayaran Customer</option>
            <option value="Paid" <?php echo ($status_customer == "Paid") ? 'selected' : ''; ?>>Paid</option>
            <option value="Unpaid" <?php echo ($status_customer == "Unpaid") ? 'selected' : ''; ?>>Unpaid</option>
                        </select>
    </div>


<input type="hidden" name="id_invoice" value="<?php echo $id_invoice; ?>" /> 
<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
<a href="<?php echo site_url('invoice') ?>" class="btn btn-danger">Cancel</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
function get_vendor() {
  var kode_pesanan = $('#kode_pesanan').val();

  var formdata = new FormData();
  formdata.append('kode_pesanan', kode_pesanan);

  $.ajax({
  type: 'POST',
  url: "<?= base_url('invoice/get_vendor'); ?>",
  data: formdata,
  processData: false,
  contentType: false,
  dataType: 'json',
  success: function (response) {
      $('#nama_client_hidden').val(response.nama_client_hidden);
      $('#nama_client').val(response.nama_client);
      // $('#alamat_hidden').val(response.alamat_hidden);
      // $('#alamat').val(response.alamat);
      $('#jumlah_pembayaran_hidden').val(response.jumlah_pembayaran_hidden);
      $('#jumlah_pembayaran').val(response.jumlah_pembayaran);
      $('#bukti_pembayaran_customer').val(response.bukti_pembayaran_customer); // Atur nilai default input bukti_pembayaran_customer di sini
},
});
}

function updateLabel(input) {
        // Get the label element associated with the input
        var label = document.querySelector('label[for="' + input.id + '"]');

        // Check if a file is selected
        if (input.files.length > 0) {
            // Update the label text to show the selected file name
            label.innerHTML = input.files[0].name;
        } else {
            // If no file is selected, revert to the original label text
            label.innerHTML = '<?php echo $bukti_pembayaran_customer; ?>';
        }
    }
</script>

</script>
<?php echo form_close();?>
</body>



</html>