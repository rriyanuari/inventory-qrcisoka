<script>
  //TAMBAH DATA
  $('.btn-add').on('click', function() {
    let nama = $("input[name=nama]");
    let satuan = $("select[name='satuan']");
    let satuan_konversi = $("select[name='satuan_konversi']");
    let nilai_konversi = $("input[name=nilai_konversi]");
    let file_data = $("#foto").prop('files')[0];

    if (!nama.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Nama tidak boleh kosong',
        position: 'topRight'
      });
      nama.focus();

      return false
    }

    if (!satuan.val()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Satuan tidak boleh kosong',
        position: 'topRight'
      });
      satuan.focus();

      return false
    }

    if (!satuan_konversi.val()) {
      iziToast.error({
        title: 'Oops!',
        message: 'satuan konversi tidak boleh kosong',
        position: 'topRight'
      });
      satuan_konversi.focus();

      return false
    }

    if (!nilai_konversi.val()) {
      iziToast.error({
        title: 'Oops!',
        message: 'nilai konversi tidak boleh kosong',
        position: 'topRight'
      });
      nilai_konversi.focus();

      return false
    }

    let form_data = new FormData();
    form_data.append('nama', nama.val());
    form_data.append('satuan', satuan.val());
    form_data.append('satuan_konversi', satuan_konversi.val());
    form_data.append('nilai_konversi', nilai_konversi.val());
    form_data.append('file', file_data);

    $.ajax({
      url: '<?php echo base_url('jenis-material/create') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          swal('Success', `${data.msg}`, 'success').then(function() {
            $(location).attr('href', `<?= base_url('jenis-material') ?>`); // redirect setelah sukses
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
        // text: 'Once deleted, you will not be able to recover this imaginary file!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '<?php echo base_url('jenis-material/delete') ?>',
          dataType: 'json', // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data, status) {
            if (data.status == 'success') {
              swal('Success', `${data.msg}`, 'success').then(function() {
                $(location).attr('href', `<?= base_url('jenis-material') ?>`); // redirect setelah sukses
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