<!-- Content Disini -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-red" style="margin: 10px 10px 0px 10px;">
          <div class="card-header">
            <h3 class="card-title">List Kantor</h3>
          </div>
          <div style="margin: 10px 10px -10px 20px">
            <a href="<?= base_url('input_barang') ?>">
              <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i> Tambah</button>
            </a>
          </div>
          <div class="card-body">
            <table id="list_barang" class="table table-bordered">
              <thead>
                <tr>
                  <td>No Barang</td>
                  <td>Nama Barang</td>
                  <td>Vendor</td>
                  <td>Tanggal</td>
                  <td>Total Qty</td>
                  <td>Sisa Qty</td>
                  <td>Harga</td>
                  <td>Total</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
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