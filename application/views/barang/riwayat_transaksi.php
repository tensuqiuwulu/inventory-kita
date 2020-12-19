<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div style="margin: 10px">
          <button type="button" onclick="goBack()" class="btn btn-danger"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</button>
        </div>
        <div class="card card-red" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">Riwayat Transaksi</h3>
          </div>
          <div class="card-body">
            <table id="trans_barang" class="table table-bordered">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Tanggal</td>
                  <td>Keterangan</td>
                  <td>Harga Satuan</td>
                  <td>S.Sekarang</td>
                  <td>S.Masuk</td>
                  <td>S.Keluar</td>
                  <td>S.Total</td>
                  <td>Harga Total</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($riwayat as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $list['tgl_riwayat'] ?></td>
                    <td><?= $list['keterangan'] ?></td>
                    <td>
                      <?php
                      if ($list['harga_satuan'] == NULL) {
                        echo "0";
                      } else {
                        echo $list['harga_satuan'];
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      if ($list['stock_sekarang'] == NULL) {
                        echo "0";
                      } else {
                        echo $list['stock_sekarang'];
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      if ($list['stock_masuk'] == NULL) {
                        echo "0";
                      } else {
                        echo $list['stock_masuk'];
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      if ($list['stock_keluar'] == NULL) {
                        echo "0";
                      } else {
                        echo $list['stock_keluar'];
                      }
                      ?>
                    </td>
                    <td><?= $list['total'] ?></td>
                    <td>
						<?php 
							if($list['stock_masuk']){
								$hargaTotal = $list['harga_satuan'] * $list['stock_masuk'];
							}else if($list['stock_keluar']){
								$hargaTotal = $list['harga_satuan'] * $list['stock_keluar'];
							}
							
							echo $hargaTotal;
						?>
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