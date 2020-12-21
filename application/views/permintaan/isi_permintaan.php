<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="card card-primary" style="margin: 10px 10px 10px 10px;">
          <div class="card-header">
            <h3 class="card-title">Permintaan Barang</h3>
          </div>
          <div>
            <table style="margin: 16px">
              <tr>
                <td>Divisi</td>
                <td>:</td>
                <td>FL Teller</td>
              </tr>
              <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><?= $permintaan->nama_barang ?></td>
              </tr>
              <tr>
                <td>Stock Permintaan</td>
                <td>:</td>
                <td><?= $permintaan->stock_permintaan ?></td>
              </tr>
              <tr>
                <td>Stock Sekarang</td>
                <td>:</td>
                <td></td>
              </tr>
              <tr>
                <td>Tanggal Permintaan</td>
                <td>:</td>
                <td><?= $permintaan->tgl_permintaan ?></td>
              </tr>
              <tr>
                <td>Status Verifikasi</td>
                <td>:</td>
                <td>
                  <?php
                  if ($permintaan->status_permintaan == 0) {
                    echo "Menunggu Permintaan";
                  } else {
                    echo "Diterima";
                  }
                  ?>
                </td>
              </tr>
            </table>
          </div>

          <div class="form-group" style="float: left; margin-right:10px">
            <div class="col-md-9">
              <div class="row">
                <?php if ($permintaan->status_permintaan != 2) { ?>
                  <div class="col-md-3">
                    <?php echo form_open('permintaan/verifikasi') ?>
                    <input type="hidden" value="<?= $permintaan->id_permintaan ?>" name="id_permintaan" id="">
                    <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Terima</button>
                    <?php echo form_close() ?>
                  </div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-thumbs-up"></i> Tolak</button>
                  </div>
                <?php } ?>
                <?php if ($permintaan->status_permintaan == 2) { ?>
                  <div class="col-md-6">
                    <?php echo form_open('permintaan/distribusi/' . $permintaan->id_permintaan . '/' . $this->uri->segment(3)) ?>
                    <input type="hidden" value="<?= $permintaan->id_permintaan ?>" name="id_permintaan" id="">
                    <button type="submit" class="btn btn-success"><i class="fab fa-telegram-plane"></i> Distribusikan</button>
                    <?php echo form_close() ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card card-primary" style="margin: 10px 10px 10px 10px;">
          <div class="card-header">
            <h3 class="card-title">Stock Barang</h3>
          </div>
          <table style="margin: 16px">
            <tr>
              <td>Nama Barang</td>
              <td>:</td>
              <td><?= $stockBarang->nama_barang ?></td>
            </tr>
            <tr>
              <td>Stock Saat Ini</td>
              <td>:</td>
              <td>
                <?php
                if ($stockBarang->stock_akhir == null) {
                  echo $stockBarang->stock_awal;
                } else {
                  echo $stockBarang->stock_akhir;
                } ?>
              </td>
            </tr>

          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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