<script>
  //TAMBAH DATA
  $('.btn-add').on('click', function() {
    let id = $("input[name=id]");
    let nama = $("input[name=nama]");
    let tgl_mulai = $("input[name=tgl_mulai]");

    $(id).on('change',function(){
      if(id.length == 5) return false
    })

    if (!id.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'ID tidak boleh kosong',
        position: 'topRight'
      });
      id.focus();

      return false
    }

    if (!nama.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Nama tidak boleh kosong',
        position: 'topRight'
      });
      nama.focus();

      return false
    }

    if (!tgl_mulai.val()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Tgl Mulai tidak boleh kosong',
        position: 'topRight'
      });
      tgl_mulai.focus();

      return false
    }

    let form_data = new FormData();
    form_data.append('id', id.val());
    form_data.append('nama', nama.val());
    form_data.append('tgl_mulai', tgl_mulai.val());

    $.ajax({
      url: '<?php echo base_url('proyek/create') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          swal('Success', `${data.msg}`, 'success').then(function() {
            $(location).attr('href', `<?= base_url('proyek') ?>`); // redirect setelah sukses
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

  //EDIT DATA
  $('.btn-edit').on('click', function() {
    let id = this.id
    let id_new = $(`input[name=id${id}]`);
    let nama = $(`input[name=nama${id}]`);
    let tgl_mulai = $(`input[name=tgl_mulai${id}]`);

    $(id_new).on('change',function(){
      if(id_new.length == 5) return false
    })

    if (!id_new.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'ID tidak boleh kosong',
        position: 'topRight'
      });
      id_new.focus();

      return false
    }

    if (!nama.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Nama tidak boleh kosong',
        position: 'topRight'
      });
      nama.focus();

      return false
    }

    if (!tgl_mulai.val()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Tgl Mulai tidak boleh kosong',
        position: 'topRight'
      });
      tgl_mulai.focus();

      return false
    }

    let form_data = new FormData();
    form_data.append('id', id);
    form_data.append('id_new', id_new.val());
    form_data.append('nama', nama.val());
    form_data.append('tgl_mulai', tgl_mulai.val());

    $.ajax({
      url: '<?php echo base_url('proyek/edit') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          swal('Success', `${data.msg}`, 'success').then(function() {
            $(location).attr('href', `<?= base_url('proyek') ?>`); // redirect setelah sukses
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
            url: '<?php echo base_url('proyek/delete') ?>',
            dataType: 'json', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data, status) {
              if (data.status == 'success') {
                swal('Success', `${data.msg}`, 'success').then(function() {
                  $(location).attr('href', `<?= base_url('proyek') ?>`); // redirect setelah sukses
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