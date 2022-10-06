<script>
  let nilai_konversi;

  const change_nilai_konversi = () => {
    qty = $("input[name='qty_konversi']").val() / nilai_konversi;
    qty = Number(qty).toFixed(2);
    $("input[name='qty']").val(qty);
  }

  // CHANGE INPUT NILAI KONVERSI -> INPUT NILAI SATUAN UNIT 
  $("input[name='qty_konversi']").keyup(() => {
    change_nilai_konversi()
  })

  // CHANGE JB -> SET INPUT APPEND & NILAIKONVERSI
  $("select[name='id_jenis_material']").change(() => {
    var id_jenis_material = $("select[name='id_jenis_material']").val();

    if(!id_jenis_material){
      $("input[name='satuan']").val(`-`);
      $("input[name='satuan_konversi']").val(`-`);
      $("input[name='qty']").val(0);
      $("input[name='qty_konversi']").prop('disabled', true);

      return false;
    }

    var form_data = new FormData();
    form_data.append('id_jenis_material', id_jenis_material);


    $.ajax({
      url: '<?php echo base_url('loading_return/get_data') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          $("input[name='satuan']").val(`${data.return.satuan}`);
          $("input[name='satuan_konversi']").val(`${data.return.satuan_konversi}`);
          $("input[name='qty']").val(0);
          $("input[name='qty_konversi']").val('');
          $("input[name='qty_konversi']").prop('disabled', false);

          nilai_konversi = data.return.nilai_konversi
        } 
      },
    });
  })

  $('.btn-add').on('click', function() {
    let id_jenis_material = $(`select[name='id_jenis_material']`);
    let id_proyek = $(`select[name='id_proyek']`);
    let qty_konversi = $(`input[name=qty_konversi]`);
    let qty = $(`input[name=qty]`);

    if (!id_jenis_material.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Jenis Material tidak boleh kosong',
        position: 'topRight'
      });
      id_jenis_material.focus();

      return false
    }

    if (!id_proyek.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Proyek tidak boleh kosong',
        position: 'topRight'
      });
      id_proyek.focus();

      return false
    }

    if (!qty_konversi.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Qty konversi tidak boleh kosong',
        position: 'topRight'
      });
      qty_konversi.focus();

      return false
    }

    if (parseFloat(qty.val().trim()) > 1) {
      iziToast.error({
        title: 'Oops!',
        message: 'Qty tidak boleh lebih dari 1 ',
        position: 'topRight'
      });
      qty_konversi.focus();

      return false
    }

    let form_data = new FormData();
    form_data.append('id_jenis_material', id_jenis_material.val());
    form_data.append('id_proyek', id_proyek.val());
    form_data.append('qty', qty.val());
    form_data.append('qty_konversi', qty_konversi.val());

    $.ajax({
      url: '<?php echo base_url('loading-return/create') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          swal('Success', `${data.msg}`, 'success').then(function() {
            $(location).attr('href', `<?= base_url('loading-return') ?>`); // redirect setelah sukses
          })
        } else {
          swal('Error', `${data.msg}`, 'error');
        }
        console.log(data);
      },
      error: function(data) {
        swal('Error', `${data.msg}`, 'error');
        console.log(data);
      }
    });
  });

  //  VALIDASI DATA
  $('.btn-valid').on('click', function() {
    let id = this.id

    let id_proyek = $(`select[name='id_proyek${id}']`);
    let keterangan = $(`input[name=keterangan${id}]`);

    if (!id_proyek.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Proyek tidak boleh kosong',
        position: 'topRight'
      });
      id_proyek.focus();

      return false
    }

    let form_data = new FormData();
    form_data.append('id', id);
    form_data.append('id_proyek', id_proyek.val());
    form_data.append('keterangan', keterangan.val());

    $.ajax({
      url: '<?php echo base_url('loading-keluar/validasi') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          swal('Success', `${data.msg}`, 'success').then(function() {
            $(location).attr('href', `<?= base_url('loading-keluar') ?>`); // redirect setelah sukses
          })
        } else {
          swal('Error', `${data.msg}`, 'error');
          nama.focus();
        }
        console.log(data);
      },
      error: function(data) {
        swal('Error', `${data.msg}`, 'error');
        console.log(data);
      }
    });
  });

  //DELETE DATA
  $('.btn-delete').on('click', function() {
    let form_data = new FormData();
    form_data.append('id', this.id);

    swal({
        title: 'Apakah anda yakin?',
        text: 'Ketika sudah terhapus, aksi anda tidak dapat dibatalkan',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '<?php echo base_url('loading-keluar/delete') ?>',
            dataType: 'json', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data, status) {
              if (data.status == 'success') {
                swal('Success', `${data.msg}`, 'success').then(function() {
                  $(location).attr('href', `<?= base_url('loading-keluar') ?>`); // redirect setelah sukses
                })
              } else {
                swal('Error', `${data.msg}`, 'error');
              }
              console.log(data);
            },
            error: function(data) {
              swal('Error', `${data.msg}`, 'error');
              console.log(data);
            }
          });
        }
      });
  });
</script>