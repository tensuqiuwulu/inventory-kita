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
                  <td>Kode Kantor</td>
                  <td>Nama Kantor</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($kantor as $list) : ?>
                  <tr>
                    <td><?= $list['kode_kantor'] ?></td>
                    <td><?= $list['nama_kantor'] ?></td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="<?= base_url('detail_distribusi/') . $list['id_kantor'] ?>" title="Preview">
                          <button style="height: 24px" class="btn btn-danger btn-xs">
                            <i style="font-size: 12px">Detail</i>
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