<script>
  //  VALIDASI DATA
  $('.btn-valid').on('click', function() {
    let id  = this.id

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