<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <div class="card card-red" style="margin: 10px;">
          <div class="card-header">
            <h3 class="card-title">Form Distribusi Barang</h3>
          </div>
          <?php echo form_open_multipart('create_distribusi', 'id="validasi_create_barang"') ?>
          <div style="margin: 14px">

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label style="font-weight: normal;" for="nama_barang">Nama Barang</label>
                  <input type="text" name="nama_barang" id="nama_barang" value="<?= $barang->nama_barang ?>" class="form-control form-control-sm" readonly>
                  <input type="hidden" name="id_barang" value="<?= $barang->id_barang ?>">
                </div>
                <div class="col-md-6">
                  <label style="font-weight: normal;" for="total_qty">Sisa Qty</label>
                  <input type="number" name="qty_saat_ini" id="qty_saat_ini" value="<?= $barang->qty_saat_ini ?>" class="form-control form-control-sm" readonly>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label style="font-weight: normal;" for="cif">Pilih Kantor</label>
                  <select class="form-control form-control-sm input-sm" name="id_kantor" id="id_kantor">
                    <option value=''>- Pilih -</option>
                    <?php foreach ($kantor as $list) : ?>
                      <option value='<?= $list['id_kantor'] ?>'><?= $list['nama_kantor'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label style="font-weight: normal;">Jumlah Barang</label>
                  <input type="number" name="distribusi_qty" id="distribusi_qty" class="form-control form-control-sm">
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="button" onclick="goBack()" class="btn btn-danger"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</button>
              <button type="submit" name="remove_levels" class="btn btn-success"><i class="fa fa-paper-plane"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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