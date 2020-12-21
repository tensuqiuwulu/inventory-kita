<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-red" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">List My Stock</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
            <a href="<?= base_url('MyStock/InputFormMyStock') ?>">
              <button type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i> Buat Permintaan</button>
            </a>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <td style="width: 50px;">No</td>
                  <td>Cabang / Divisi</td>
                  <td>Nama Barang</td>
                  <td>Stock Permintaan</td>
                  <td>Stock Sekarang</td>
                  <td>Tanggal Permintaan</td>
                  <td>Status Permintaan</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($permintaan as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $list['divisi_peminta'] ?></td>
                    <td><?= $list['nama_barang'] ?></td>
                    <td><?= $list['stock_permintaan'] ?></td>
                    <td></td>
                    <td><?= $list['tgl_permintaan'] ?></td>
                    <td>
                      <?php if ($list['status_permintaan'] == 0) {
                        echo "Menunggu Verifikasi";
                      } else {
                        echo "Telah Diverifikasi";
                      } ?>
                    </td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="<?= base_url('detail_verifikasi/' . $list['id_permintaan'] . '/' . $list['id_barang']) ?>">
                          <button style="height: 24px;" type="button" class="btn btn-danger btn-xs">
                            <i style="font-size: 12px;">Verifikasi</i>
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
        <?php echo form_open('create_nota', 'id="validasi_create_nota"') ?>
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
    $('#validasi_create_nota').validate({
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