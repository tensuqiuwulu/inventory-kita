<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-red" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">List Distribusi Kantor</h3>
          </div>
          <div class="card-body">
            <table id="list_distribusi_kantor" class="table table-bordered">
              <thead>
                <tr>
                  <td>Kode Barang</td>
                  <td>Nama Barang</td>
                  <td>Total Distribusi Qty</td>
                  <td>Sisa Qty</td>
                  <td>Tanggal</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($distribusi as $list) : ?>
                  <tr>
                    <td><?= $list['no_barang'] ?></td>
                    <td><?= $list['nama_barang'] ?></td>
                    <td><?= $list['total_distribusi_qty'] ?></td>
                    <td><?= $list['sisa_distribusi_qty'] ?></td>
                    <td><?= $list['tgl_distribusi'] ?></td>
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