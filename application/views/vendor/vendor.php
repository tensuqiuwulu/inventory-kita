<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-success" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">Data Vendor</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
            <a href="<?= base_url('input_vendor') ?>">
              <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-pencil-alt"></i> Tambah Vendor</button>
            </a>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Nama Vendor</td>
                  <td>Telepon</td>
                  <td>Alamat</td>
                  <td>Npwp</td>
                  <td>Pic</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($vendor as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $list['nama_vendor'] ?></td>
                    <td><?= $list['no_tlp'] ?></td>
                    <td><?= $list['alamat'] ?></td>
                    <td><?= $list['no_npwp'] ?></td>
                    <td><?= $list['no_pic'] ?></td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="<?= base_url('edit_vendor/') . $list['id_vendor'] ?>" title="Edit">
                          <button style="height: 24px" class="btn btn-danger btn-xs">
                            <i style="font-size: 12px">Edit</i>
                          </button>
                        </a>
                        <button style="height: 24px" class="btn btn-danger btn-xs" name="confirm" data-id="<?= $list['id_vendor'] ?>" title="Hapus">
                          <i style="font-size: 12px">Hapus</i>
                        </button>
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
  $('button[name="confirm"]').on('click', function(e) {
    var $form = $(this).closest('form');
    var id = $(this).data('id');
    e.preventDefault();
    $('#confirm').modal({
        backdrop: 'static',
        keyboard: false
      })
      .on('click', '#ya', function() {
        window.location = "<?= base_url('delete_vendor/') ?>" + id;
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