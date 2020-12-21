<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-success" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">Data Divisi</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
            <a href="<?= base_url('input_divisi') ?>">
              <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-pencil-alt"></i> Tambah Divisi </button>
            </a>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <td style="width: 50px;">No</td>
                  <td>Nama Divisi</td>
                  <td style="width: 100px;">Opsi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($divisi as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $list['nama_divisi'] ?></td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="<?= base_url('edit_kategori/') . $list['id_divisi'] ?>" title="Edit">
                          <button style="height: 24px" class="btn btn-danger btn-xs">
                            <i style="font-size: 12px">Edit</i>
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