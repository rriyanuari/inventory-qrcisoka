<script>
  let qty = $("input[name=qty]");

  $(qty).on('change', function() {
    if (qty.val() < 1) {
      qty.val(1)
    };
  })

  //  TAMBAH DATA
  $('.btn-add').on('click', function() {
    let id_jenis_material = $("select[name='id_jenis_material']");
    let qty = $("input[name=qty]");

    if (!qty.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Qty tidak boleh kosong',
        position: 'topRight'
      });
      qty.focus();

      return false
    }

    if (!id_jenis_material.val()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Jenis Material tidak boleh kosong',
        position: 'topRight'
      });
      id_jenis_material.focus();

      return false
    }

    let form_data = new FormData();
    form_data.append('qty', qty.val());
    form_data.append('id_jenis_material', id_jenis_material.val());

    $.ajax({
      url: '<?php echo base_url('loading-masuk/create') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          swal('Success', `${data.msg}`, 'success').then(function() {
            $(location).attr('href', `<?= base_url('loading-masuk') ?>`); // redirect setelah sukses
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