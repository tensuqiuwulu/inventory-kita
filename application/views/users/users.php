<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-green" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">Data Users</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
            <a href="<?= base_url('input_user') ?>">
              <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-user-plus"></i> Tambah Users</button>
            </a>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Nama User</td>
                  <td>Username</td>
                  <td>Divisi</td>
                  <td>No Hp</td>
                  <td>Level</td>
                  <td>Status Aktif</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($users as $list) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $list['nama_user'] ?></td>
                    <td><?= $list['username'] ?></td>
                    <td><?= $list['nama_divisi'] ?></td>
                    <td><?= $list['no_hp'] ?></td>
                    <td><?= $list['level_user'] ?></td>
                    <td><?= $list['status_aktif'] ?></td>
                    <td>
                      <div style="text-align:center; margin:-2.5px">
                        <a href="<?= base_url('edit_user/') . $list['id_user'] ?>" title="Edit">
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