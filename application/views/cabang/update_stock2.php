<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-green" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">Data Master Barang Cabang</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <td>No Biliyet</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>10000001</td>
                  <td>

                    <button data-toggle="modal" data-target="#exampleModal">Keluar</button>

                  </td>
                </tr>
                <tr>
                  <td>10000002</td>
                  <td>

                    <button data-toggle="modal" data-target="#exampleModal">Keluar</button>

                  </td>
                </tr>
                <tr>
                  <td>10000003</td>
                  <td>
                    <button data-toggle="modal" data-target="#exampleModal">Keluar</button>

                  </td>
                </tr>
                <tr>
                  <td>10000004</td>
                  <td>
                    <button data-toggle="modal" data-target="#exampleModal">Keluar</button>

                  </td>
                </tr>
                <tr>
                  <td>10000005</td>
                  <td>
                    <button data-toggle="modal" data-target="#exampleModal">Keluar</button>

                  </td>
                </tr>
                <!-- <?php foreach ($barang as $list) : ?>
                  <tr>
                    <td><?= $list['kode_barang'] ?></td>
                    <td><?= $list['nama_barang'] ?></td>
                    <td><?= date('d-m-Y', strtotime($list['tgl_pembelian'])) ?></td>
                    <td><?= $list['stock_awal'] ?></td>
                    <td><?= $list['stock_akhir'] ?></td>
                    <td><?= $list['harga_terakhir'] ?></td>
                    <td><?= $list['jml_stock_idr'] ?></td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="barang/get_detail/<?= $list['kode_barang'] ?>" title="Preview">
                          <button style="height: 24px;" type="button" class="btn btn-danger btn-xs">
                            <i style="font-size: 12px;">Edit</i>
                          </button>
                        </a>
                        <a href="DistribusiBarang/index_create/<?= $list['kode_barang'] ?>" title="Preview">
                          <button style="height: 24px;" type="button" class="btn btn-success btn-xs">
                            <i style="font-size: 12px;">Riwayat</i>
                          </button>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="exampleModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h4 class="modal-title">Bilyet Keluar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label style="font-weight: normal;" for="nama_barang">No Bilyet</label>
              <input type="text" name="nama_barang" id="nama_barang" value="1000001" class="form-control form-control-sm" readonly>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label style="font-weight: normal;" for="nama_barang">Nama Nasabah</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control form-control-sm">
              </div>
              <div class="col-md-6">
                <label style="font-weight: normal;" for="stock_awal">CIF</label>
                <input type="text" name="stock_awal" id="stock_awal" class="form-control form-control-sm">
              </div>
            </div>
            <div class="form-group">
              <button type="button" onclick="goBack()" class="btn btn-danger"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</button>
              <button type="submit" name="confirm" class="btn btn-success"><i class="fa fa-paper-plane"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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