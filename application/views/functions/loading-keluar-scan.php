<script>
  var app = new Vue({
    el: '#app',
    data: {
      scanner: null,
      activeCameraId: null,
      cameras: [],
      exist: false,
      scans: []
    },
    methods: {
      greet: function (event) {
        // `this` inside methods point to the Vue instance
        alert('Hello ' + this.name + '!')
        // `event` is the native DOM event
        alert(event.target.tagName)
      }
    },
    mounted: function() {
      var self = this;
      self.scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        scanPeriod: 5
      });
      self.scanner.addListener('scan', function(content, image) {
        // self.scans.unshift({ date: +(Date.now()), content: content });

        // Split content (isi qrcode)
        split_content = content.split("/");
        // variabel isi qrcode siap disimpan
        content = `${split_content[6]}/${split_content[7]}`;

        self.exist = false

        // Validasi benar qr fyfe?
        if (split_content.length != 8) {
          self.exist = true;
          var audio = new Audio(`<?= base_url('assets/qrscan/') ?>failure.mp3`);
          audio.play();

          iziToast.error({
            title: 'Oops!',
            message: 'Qr bukan dari sistem fyfe',
            position: 'topRight'
          });
          return false
        }

        // Validasi qr sudah pernah discan?
        for (var i = 0; i < self.scans.length; i++) {
          // console.log(self.scans[i].content.toString()+' - '+content.toString());

          if (self.scans[i].content.toString() == content.toString()) {
            self.exist = true;
            var audio = new Audio(`<?= base_url('assets/qrscan/') ?>failure.mp3`);
            audio.play();

            iziToast.error({
              title: 'Oops!',
              message: 'Material sudah discan',
              position: 'topRight'
            });
            return false
          }
        }

        if (!self.exist) {
          var audio = new Audio(`<?= base_url('assets/qrscan/') ?>success.mp3`);
          self.scans.unshift({
            date: +(Date.now()),
            content: content
          });
          audio.play();
          // console.log(self.scans.content);
        }
      });
      Instascan.Camera.getCameras().then(function(cameras) {
        self.cameras = cameras;
        if (cameras.length > 0) {
          self.activeCameraId = cameras[0].id;
          self.scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function(e) {
        console.error(e);
      });
    },
    methods: {
      formatName: function(name) {
        return name || '(unknown)';
      },
      selectCamera: function(camera) {
        this.activeCameraId = camera.id;
        this.scanner.start(camera);
      }
    }
  });

  function remove(index) {
    swal({
        title: 'Apakah anda yakin?',
        text: 'Setelah terhapus, anda perlu scan ulang untuk menambahkan materialnya jika diperlukan',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          console.log("item yang index nya = " + index + " sudah dihapus");
          app.scans.splice(index, 1);
          console.log(app.scans)
        }
      });
  }

  function simpan() {
    event.preventDefault();

    // SET DATA SCANNED
    let materials = [];
    
    $('.hasilscan').each(function() {
      let no_qr = $(this).val()
      let split_material = no_qr.split("/")

      let material = {}

      material['id_material'] = split_material[0]
      material['id_scan'] = split_material[1]
      material['no_qr'] = no_qr;

      materials.push(material)
    });

    console.log(materials);

    var form_data = new FormData();
    form_data.append('materials', JSON.stringify(materials));

    $.ajax({
      url: '<?php echo base_url('loading-keluar/scan-proses') ?>',
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
  };
</script>