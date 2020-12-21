<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-red" style="margin: 10px;">
          <div class="card-header">
            <h3 class="card-title">Form Input User</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div style="margin: 14px">
              <?php echo form_open('update_user', 'id="user_form"') ?>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="nama_user">Nama Lengkap</label>
                    <input value="<?= $users->nama_user ?>" type="text" name="nama_user" id="nama_user" class="form-control form-control-sm" />
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="username">Username</label>
                    <input value="<?= $users->username ?>" type="text" name="username" id="username" class="form-control form-control-sm" />
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="no_hp">No HP</label>
                    <input value="<?= $users->no_hp ?>" name="no_hp" id="no_hp" class="form-control form-control-sm" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-3">
                        <label style="font-weight: normal;" for="kode_kantor">Kode Kantor</label>
                        <input value="<?= $users->kode_kantor ?>" type="text" name="kode_kantor" id="kode_kantor" class="form-control form-control-sm" placeholder="000" />
                      </div>
                      <div class="col-md-4">
                        <label style="font-weight: normal;" for="level_user">Level User</label>
                        <select name="level_user" id="level_user" class="form-control form-control-sm">
                          <option value="<?= $users->level_user ?>"><?= $users->level_user ?></option>
                          <option value="superedp">Superedp</option>
                          <option value="otorisator">Otorisator</option>
                          <option value="admin">Admin</option>
                          <option value="operator">Operator</option>
                        </select>
                      </div>
                      <div class="col-md-5">
                        <label style="font-weight: normal;" for="id_divisi">Divisi</label>
                        <select name="id_divisi" id="id_divisi" class="form-control form-control-sm divisi">
                          <option value="<?= $users->nama_divisi ?>"><?= $users->nama_divisi ?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="password">Password</label>
                    <input value="" type="password" name="password" id="password" class="form-control form-control-sm">
                  </div>
                  <div class="col-md-4">
                    <label style="font-weight: normal;" for="cek_password">Ulangi Password</label>
                    <input value="" type="password" name="cek_password" id="cek_password" class="form-control form-control-sm">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-1">
                    <label style="font-weight: normal;" for="status_aktif">Status Aktif</label>
                    <select name="status_aktif" id="status_aktif" class="form-control form-control-sm">
                      <option value="0">0</option>
                      <option value="1">1</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <a href="<?= base_url('users') ?>">
                  <button type="button" class="btn btn-danger"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</button>
                </a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
              </div>
              <?php echo form_close() ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    //Form Validasi Tambah Barang
    $('#user_form').validate({
      rules: {
        nama_user: {
          required: true,
        },
        username: {
          required: true
        },
        kode_kantor: {
          required: true
        },
        level_user: {
          required: true
        },
        id_divisi: {
          required: true
        },
        cek_password: {
          equalTo: "#password"
        },
      },
      messages: {
        nama_user: {
          required: "Nama user tidak boleh kosong",
        },
        username: {
          required: "Username tidak boleh kosong",
        },
        kode_kantor: {
          required: "",
        },
        level_user: {
          required: "",
        },
        id_divisi: {
          required: "",
        },
        cek_password: {
          required: "Password tidak sama",
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.col-md-4').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });

    $('.divisi').select2({
      ajax: {
        url: base_url + "divisi/GetDivisiAjax",
        dataType: "json",
        delay: 250,
        data: function(params) {
          return {
            nama_divisi: params.term
          };
        },
        processResults: function(data) {
          var results = [];
          $.each(data, function(index, item) {
            results.push({
              id: item.id_divisi,
              text: item.nama_divisi
            });
          });
          return {
            results: results
          }
        }
      }
    });
  });
</script>