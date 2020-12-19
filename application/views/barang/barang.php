<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-green" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">Data Master Barang</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
            <a href="<?= base_url('input_barang') ?>">
              <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-pencil-alt"></i> Tambah</button>
            </a>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <td>Kode Barang</td>
                  <td>Nama Barang</td>
                  <td>Tanggal Transaksi Terakhir</td>
                  <td>Stock Awal</td>
                  <td>Stock Akhir</td>
                  <td>Harga Transaksi Terakhir</td>
                  <td>Jumlah Stock (IDR)</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($barang as $list) : ?>
                  <tr>
                    <td><?= $list['kode_barang'] ?></td>
                    <td><?= $list['nama_barang'] ?></td>
                    <td></td>
                    <td><?= $list['stock_awal'] ?></td>
                    <td><?= $list['stock_akhir'] ?></td>
                    <td><?= $list['harga_terakhir'] ?></td>
                    <td><?= $list['jml_stock_idr'] ?></td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="<?= base_url('riwayat_transaksi_barang/') . $list['id_barang'] ?>" title="Preview">
                          <button style="height: 24px;" type="button" class="btn btn-danger btn-xs">
                            <i style="font-size: 12px;">Riwayat</i>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- <script type="text/javascript">
  $(document).ready(function() {
    $('#list_barang').DataTable({
      "processing": true,
      "serverSide": true,
      "autoWidth": false,

      "ajax": {
        "url": "<?php echo site_url('barang/get_list') ?>",
        "type": "POST"
      },
    });
  });
</script> -->

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