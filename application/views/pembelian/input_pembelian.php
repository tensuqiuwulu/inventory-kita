<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-red" style="margin: 10px;">
          <div class="card-header">
            <h3 class="card-title">Form Input Pembelian</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div style="margin: 14px">
              <?php echo form_open('', 'id="cart_form"') ?>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="tgl_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control form-control-sm" value="<?= $nota->tgl_pembelian ?>" readonly>
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="nama_barang">No Nota</label>
                    <input type="text" name="no_nota" id="no_nota" class="form-control form-control-sm" value="<?= $nota->no_nota ?>" data-nota="<?= $nota->no_nota ?>" readonly>
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="nama_vendor">Vendor</label>
                    <select name="id_vendor" id="id_vendor" class="form-control form-control-sm vendor"></select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="nama_barang">Nama Barang</label>
                    <select type="text" name="id_barang" id="id_barang" class="form-control form-control-sm barang"></select>
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="qty">Qty</label>
                    <input type="number" name="qty" id="qty" class="form-control form-control-sm">
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="harga_satuan">Harga Satuan</label>
                    <input type="number" name="harga_satuan" id="harga_satuan" class="form-control form-control-sm">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <a href="<?= base_url('list_pembelian') ?>">
                  <button type="button" class="btn btn-danger"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</button>
                </a>
                <button id="add_cart" type="submit" class="btn btn-success"><i class="fa fa-cart-plus"></i> Tambah</button>
              </div>
              <?php echo form_close() ?>

              <table id="list_barang_table" class="table table-bordered" style="width: 100%;">
                <thead>
                  <tr>
                    <td style="width: 10px;">No</td>
                    <td style="width: 55px;">Cek Fisik</td>
                    <td>Nama Barang</td>
                    <td>Vendor</td>
                    <td>Qty</td>
                    <td>Harga Satuan</td>
                    <td>Total Harga</td>
                    <td>Verifikasi</td>
                    <td>Opsi</td>
                  </tr>
                </thead>

                <tbody id="list_barang">
                </tbody>

              </table>
              <div class="form-group" style="float: left;">
                <button id="verifikasi" class="btn btn-md btn-success"><i class="fa fa-check-square"></i> Verifikasi</button>
              </div>
              <div class="form-group" style="float: right;">
                <label for="" style="text-align: center; font-weight:normal; float:right">Total Harga Keseluruhan</label>
                <input style="text-align: right;" id="total_harga" type="text" placeholder="Total Harga" class="form-control" readonly>
              </div>
            </div>
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
        <h4 class="modal-title">Apa Anda Yakin ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pastika seluruh barang sudah dicek fisik dengan benar</p>
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

<form id="delete_cart_form" method="post">
  <div class="modal fade" id="delete_cart_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Hapus Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda Yakin Menghapus Barang Ini ?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="delete_cart" id="delete_cart" class="form-control">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/nota.js') ?>"></script>

<script type="text/javascript">
  // <?php if ($this->session->flashdata('success')) { ?>
  //   $('.toastrDefaultSuccess').ready(function() {
  //     toastr.success('<?php echo $this->session->flashdata('success'); ?>')
  //   });
  // <?php } else if ($this->session->flashdata('error')) {  ?>
  //   $('.toastrDefaultError').ready(function() {
  //     toastr.error('<?php echo $this->session->flashdata('error'); ?>')
  //   });
  // <?php } ?>
</script>