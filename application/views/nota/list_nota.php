<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-red" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">List Nota Pembelian</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
            <?php echo form_open('list_nota') ?>
            <div class="form-group">
              <div class="row">
                <div class="col-md-2">
                  <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                  <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-success btn-sm">Refresh</button>
                </div>
              </div>
            </div>
            <button style="margin-top: -10px" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-nota"><i class="fa fa-pencil-alt"></i> Tambah Nota</button>
            <?php echo form_close() ?>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <td style="width: 50px;">No</td>
                  <td>No Nota</td>
                  <td>Tanggal Pembelian</td>
                  <td>Status Verifikasi</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($nota as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $list['no_nota'] ?></td>
                    <td><?= $list['tgl_pembelian'] ?></td>
                    <td>
                      <?php if ($list['verifikasi'] == 1) {
                        echo "Sudah Verifikasi";
                      } else {
                        echo "Menunggu Verifikasi";
                      } ?>
                    </td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="<?= base_url('input_pembelian/' . $list['no_nota']) ?>">
                          <button style="height: 24px;" type="button" class="btn btn-danger btn-xs">
                            <i style="font-size: 12px;">Tambah / Verifikasi</i>
                          </button>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="add-nota">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Nota Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('add_nota', 'id="validasi_add_nota"') ?>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label style="font-weight: normal;" for="tgl_pembelian">Tanggal Pembelian</label>
              <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control form-control-sm">
            </div>
            <div class="col-md-6">
              <label style="font-weight: normal;" for="nama_barang">No Nota</label>
              <input type="text" name="no_nota" id="no_nota" class="form-control form-control-sm">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div>
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-danger">Batal</button>
        </div>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Apa Anda Yakin Menghapus Data ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Data yang sudah dihapus tidak dapat dikembalikan !</p>
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
  $(document).ready(function() {
    $('#validasi_add_nota').validate({
      rules: {
        tgl_pembelian: {
          required: true,
        },
        no_nota: {
          required: true,
        },
      },
      messages: {
        tgl_pembelian: {
          required: "Tanggal Pembelian Harus Diisi !",
        },
        no_nota: {
          required: "No Nota Harus Diisi !",
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
  $('button[name="confirm"]').on('click', function(e) {
    var $form = $(this).closest('form');
    var id = $(this).data('id');
    e.preventDefault();
    $('#confirm').modal({
        backdrop: 'static',
        keyboard: false
      })
      .on('click', '#ya', function() {
        window.location = "<?= base_url('delete_kategori/') ?>" + id;
      });
    $("#cancel").on('click', function(e) {
      e.preventDefault();
      $('#confirm').modal.model('hide');
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