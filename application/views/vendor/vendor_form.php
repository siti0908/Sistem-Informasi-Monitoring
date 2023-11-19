
    <body><br>
        <!-- <h2 style="margin-top:0px">Vendor <?php echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
              <!-- Input addon -->
            <div class="card card-info">
              <div class="card-header">
                <h1 class="card-title">Vendor <?php echo $button ?></h1>
              </div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                  </div>
                 <input type="text" class="form-control" name="nama_vendor" id="nama_vendor" placeholder="Nama Vendor" value="<?php echo $nama_vendor; ?>" />
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                  </div>
                 <textarea class="form-control" rows="2" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                </div>

               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                 <!-- <input type="text" class="form-control" name="no_tlp" id="no_tlp" placeholder="No Tlp" value="<?php echo $no_tlp; ?>" /> -->
                 <input onkeypress="return isNumberKey(event)"  maxlength="12"  class="form-control"  placeholder="Nomor Telepon" type="text"  name="no_tlp" id="no_tlp" placeholder="No Tlp" value="<?php echo $no_tlp; ?>" required>
                </div> 

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span  for="email"  class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                   <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                </div>
 

                <div class="form-group">
                <label for="enum" class="control-label">Pekerjaan <?php echo form_error('jenis_transportasi') ?></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_transportasi" id="jenis_transportasi" value="Truk" <?php echo ($jenis_transportasi === "Truk") ? "checked" : "";?>>
                    <label class="form-check-label" for="truk">Truk</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_transportasi" id="jenis_transportasi" value="Kapal" <?php echo ($jenis_transportasi === "Kapal") ? "checked" : "";?>>
                    <label class="form-check-label" for="kapal">Kapal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_transportasi" id="jenis_transportasi" value="PBM" <?php echo ($jenis_transportasi === "PBM") ? "checked" : "";?>>
                    <label class="form-check-label" for="PBM">PBM</label>
                </div>
            </div>


                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Rp.</b></i></span>
                  </div>
                  
                    <input onkeypress="return isNumberKey(event)" class="form-control"  placeholder="Jumlah Pembayaran" type="text" name="jumlah_pembayaran" id="jumlah_pembayaran" value="<?php echo $jumlah_pembayaran; ?>" required>
                </div>

                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                  </div>
                 <input type="text" class="form-control" name="nama_client" id="nama_client" placeholder="Nama Client" value="<?php echo $nama_client; ?>" />
                </div>

        
        
	    <input type="hidden" name="id_vendor" value="<?php echo $id_vendor; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('vendor') ?>" class="btn btn-danger">Cancel</a>
       </div>
     
     </div>
     </form>

 <script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
      (charCode < 48 || charCode > 57))
      return false;
    return true;
  }


  function isNumericKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
      (charCode < 48 || charCode > 57))
      return true;
    return false;
  }


// update radio
   function ubahRadio() {
            var selectedValue = document.querySelector('input[name="jenis_transportasi"]:checked').value;
            var radioButtons = document.querySelectorAll('input[name="jenis_transportasi"]');

            radioButtons.forEach(function(radioButton) {
                if (radioButton.value === selectedValue) {
                    radioButton.checked = true;
                } else {
                    radioButton.checked = false;
                }
            });
        }
</script>


    </body>
</html>