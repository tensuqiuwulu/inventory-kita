<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <div class="card card-red" style="margin: 10px;">
          <div class="card-header">
            <h3 class="card-title">Form Edit Vendor</h3>
          </div>
          <?php echo form_open_multipart('update_vendor', 'id="validasi_edit_vendor"') ?>
          <div style="margin: 14px">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label style="font-weight: normal;" for="nama_vendor">Nama Vendor</label>
                  <input type="text" name="nama_vendor" id="nama_vendor" value="<?= $vendor->nama_vendor ?>" class="form-control form-control-sm">
                </div>
                <div class="col-md-6">
                  <label style="font-weight: normal;" for="no_tlp">Telepon</label>
                  <input type="text" name="no_tlp" id="no_tlp" class="form-control form-control-sm" value="<?= $vendor->no_tlp ?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label style="font-weight: normal;" for="bidang_usaha">Bidang Usaha</label>
                  <input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control form-control-sm" value="<?= $vendor->bidang_usaha ?>">
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <label style="font-weight: normal;" for="no_npwp">No NPWP</label>
                      <input type="text" name="no_npwp" id="no_npwp" value="<?= $vendor->no_npwp ?>" class="form-control form-control-sm" data-inputmask="'mask': ['99.999.999.9-999.999']" data-mask placeholder="00.000.000.0-000.000">
                    </div>
                    <div class="col-md-6">
                      <label style="font-weight: normal;" for="no_pic">No PIC</label>
                      <input type="text" name="no_pic" id="no_pic" value="<?= $vendor->no_pic ?>" class="form-control form-control-sm">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <label style="font-weight: normal;" for="alamat">Alamat</label>
                  <textarea name="alamat" id="" cols="30" rows="3" class="form-control form-control-sm"><?= $vendor->alamat ?></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="button" onclick="goBack()" class="btn btn-danger"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</button>
              <button type="submit" name="confirm" class="btn btn-success"><i class="fa fa-paper-plane"></i> Simpan</button>
              <input type="hidden" name="id_vendor" value="<?= $vendor->id_vendor ?>">
            </div>
          </div>
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="confirm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Apa Anda Yakin ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pastikan data telah terinput dengan benar !</p>
      </div>
      <div class="modal-footer justify-content-between">
        <div style="text-align: center; margin: auto">
          <button type="button" data-dismiss="modal" class="btn btn-success" id="ya">YES</button>
          <button type="button" data-dismiss="modal" class="btn btn-danger">NO</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
  $('button[name="confirm"]').on('click', function(e) {
    var $form = $(this).closest('form');
    e.preventDefault();
    $('#confirm').modal({
        backdrop: 'static',
        keyboard: false
      })
      .on('click', '#ya', function(e) {
        $form.trigger('submit');
      });
    $("#cancel").on('click', function(e) {
      e.preventDefault();
      $('#confirm').modal.model('hide');
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#validasi_edit_vendor').validate({
      rules: {
        nama_vendor: {
          required: true,
        },
        no_tlp: {
          required: true,
        },
        alamat: {
          required: true,
        },
        bidang_usaha: {
          required: true,
        },
      },
      messages: {
        nama_vendor: {
          required: "Nama vendor harus diisi",
        },
        no_tlp: {
          required: "Telepon harus diisi",
        },
        alamat: {
          required: "Alamat harus diisi",
        },
        bidang_usaha: {
          required: "Bidang usaha harus diisi",
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.col-md-6').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>

<script type="text/javascript">
  <?php if ($this->session->flashdata('success')) { ?>
    $('.toastrDefaultSuccess').ready(function() {
      toastr.success('<?php echo $this->session->flashdata('success'); ?>')
    });
  <?php } else if ($this->session->flashdata('error')) {  ?>
    $('.toastrDefaultError').ready(function() {
      toastr.error('<?php echo $this->session->flashdata('error'); ?>')
    });
  <?php } ?>
</script>