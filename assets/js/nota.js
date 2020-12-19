$(document).ready(function () {
  listBarang();
  $('#list_barang_table').dataTable({
    "bPaginate": false,
    "bInfo": false,
    "bFilter": false,
    "bLengthChange": false,
    "pageLength": 5
  });

  // Menampilkan semua list barang
  function listBarang() {
    var no_nota = $('#no_nota').data("nota");
    console.log(no_nota)
    $.ajax({
      type: 'ajax',
      url: base_url + "nota/get_list_barang/" + no_nota,
      dataType: 'json',
      success: function (data) {
        console.log(data);
        var html = '';
        var i;
        var no = 1;
        var total_harga = 0;
        var total_keseluruhan_harga = 0;
        for (i = 0; i < data.length; i++) {
          total_harga = Number(data[i].qty) * Number(data[i].harga_satuan);
          total_keseluruhan_harga = total_keseluruhan_harga + total_harga;
          html += '<tr>' +
            '<td>' + no++ + '</td>' +
            '<td style="text-align: center"><input type="checkbox" name="cek"> </td>' +
            '<td>' + data[i].nama_barang + '</td>' +
            '<td>' + data[i].nama_vendor + '</td>' +
            '<td>' + data[i].qty + '</td>' +
            '<td style="text-align: right">Rp. ' + data[i].harga_satuan + '</td>' +
            '<td style="text-align: right">Rp. ' + total_harga + '</td>' +
            '<td><div style="text-align: center; margin:-2.5px">' +
            '<button id="delete_cart" name="delete_cart" class="btn btn-danger btn-sm" data - id="' + data[i].kode_pembelian + '" > Delete</button > ' +
            '</div>' +
            '</td>' +
            '</tr>';
        }
        $('#total_harga').val('Rp. ' + total_keseluruhan_harga);
        $('#list_barang').html(html);
      }
    });
  }

  //Menambah Barang
  $('#add_cart').click(function () {
    var data = $('#cart_form').serialize();
    console.log(data);
    $.ajax({
      type: "POST",
      url: base_url + "nota/add_barang",
      dataType: "JSON",
      data: data,
      success: function (data) {
        listBarang();
      }
    });
  });

  //Menghapus Barang
  $('button[name="delete_cart"]').on('click', function (e) {
    console.log('Yes');
    alert("Alert");
    var id = $(this).data('id');
    console.log(id)
    $.ajax({
      type: "POST",
      url: base_url + "pembelian/delete",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function (data) {
        listUsers();
      }
    });
    return false;
  });

  //Form Validasi Tambah Barang
  $('#cart_form').validate({
    rules: {
      harga_satuan: {
        required: true,
      },
      id_vendor: {
        required: true
      },
      kode_barang: {
        required: true
      },
      qty: {
        required: true
      },
    },
    messages: {
      harga_satuan: {
        required: "Harga barang tidak boleh kosong",
      },
      id_vendor: {
        required: "Vendor tidak boleh kosong",
      },
      kode_barang: {
        required: "Barang tidak boleh kosong",
      },
      qty: {
        required: "Jumlah barang tidak boleh kosong",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.col-md-4').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('button[name="confirm"]').on('click', function (e) {
    var $form = $(this).closest('form');
    e.preventDefault();
    $('#confirm').modal({
      backdrop: 'static',
      keyboard: false
    })
      .on('click', '#ya', function (e) {
        $form.trigger('submit');
      });
    $("#cancel").on('click', function (e) {
      e.preventDefault();
      $('#confirm').modal.model('hide');
    });
  });

  $('.barang').select2({
    ajax: {
      url: base_url + "barang/GetBarangAjax",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          nama_barang: params.term
        };
      },
      processResults: function (data) {
        var results = [];
        $.each(data, function (index, item) {
          results.push({
            id: item.id_barang,
            text: item.nama_barang
          });
        });
        return {
          results: results
        }
      }
    }
  });

  $('.vendor').select2({
    ajax: {
      url: base_url + "vendor/GetVendorAjax",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          nama_vendor: params.term
        };
      },
      processResults: function (data) {
        var results = [];
        $.each(data, function (index, item) {
          results.push({
            id: item.id_vendor,
            text: item.nama_vendor
          });
        });
        return {
          results: results
        }
      }
    }
  });
});