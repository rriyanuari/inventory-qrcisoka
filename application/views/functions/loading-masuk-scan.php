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
  mounted: function () {
    var self = this;
    self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
    self.scanner.addListener('scan', function (content, image) {
      // self.scans.unshift({ date: +(Date.now()), content: content });

      // Split content (isi qrcode)
      split_content = content.split("/");
      // variabel isi qrcode siap disimpan
      content = `${split_content[6]} / ${split_content[7]}`;

      self.exist = false

      // Validasi benar qr fyfe?
      if(split_content.length != 8){
        self.exist = true;
        var audio = new Audio(`<?=base_url('assets/qrscan/')?>failure.mp3`);
        audio.play(); 

        iziToast.error({
          title: 'Oops!',
          message: 'Qr bukan dari sistem fyfe',
          position: 'topRight'
        });
        return false
      }

      // Validasi qr sudah pernah discan?
      for(var i=0; i < self.scans.length; i++){
        // console.log(self.scans[i].content.toString()+' - '+content.toString());
        
        if( self.scans[i].content.toString() == content.toString()){
          self.exist = true;
          var audio = new Audio(`<?=base_url('assets/qrscan/')?>failure.mp3`);
          audio.play(); 

          iziToast.error({
            title: 'Oops!',
            message: 'Material sudah discan',
            position: 'topRight'
          });
          return false
        }
      }

      // Validasi benar qr material yang dimaksud?
      if(split_content[6] != '<?= $material['id']; ?>'){
        console.log(split_content[6]);
        console.log('<?= $material['id'] ?>')
        self.exist = true;
        var audio = new Audio(`<?=base_url('assets/qrscan/')?>failure.mp3`);
        audio.play(); 

        iziToast.error({
          title: 'Oops!',
          message: 'Bukan Material yang dimaksud',
          position: 'topRight'
        });
        return false
      }

      if(!self.exist){
        var audio = new Audio(`<?=base_url('assets/qrscan/')?>success.mp3`);
        self.scans.unshift({ date: +(Date.now()), content: content });
        audio.play(); 
        // console.log(self.scans.content);
      }
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      self.cameras = cameras;
      if (cameras.length > 0) {
        self.activeCameraId = cameras[0].id;
        self.scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  },
  methods: {
    formatName: function (name) {
      return name || '(unknown)';
    },
    selectCamera: function (camera) {
      this.activeCameraId = camera.id;
      this.scanner.start(camera);
    }
  }
});

function simpan(){
  event.preventDefault();

  // SET DATA SCANNED
  // var materials = [];
  // var id_scans = [];
  // var id_materials = [];
  // $('.hasilscan').each(function() {
  //   var material = $(this).val()
  //   material = material.split("/")
  //   id_material = material[1]
  //   id_scan = material[2]
  //   material = material[1].concat('/',material[2])

  //   var exist = false
  //   for(var i=0; i < materials.length; i++){
  //     if( materials[i].toString() == material.toString()){
  //       exist = true;
  //     } 
  //   }

  //   if(!exist){
  //     materials.push(material)
  //     id_scans.push(id_scan)
  //     id_materials.push(id_material)
  //     console.log(id_scans)
  //     }
  // })
  let tgl_kadaluarsa = $("input[name=tgl_kadaluarsa]");

  if (!tgl_kadaluarsa.val().trim()) {
      iziToast.error({
        title: 'Oops!',
        message: 'Tanggal kadaluarsa tidak boleh kosong',
        position: 'topRight'
      });
      tgl_kadaluarsa.focus();

      return false
    }

  var form_data = new FormData();
  form_data.append('id_material', $("#id_material").val());
  form_data.append('id_jenis_material', $("#id_jenis_material").val());
  form_data.append('qty', $("#qty_material").html());
  form_data.append('tgl_kadaluarsa', tgl_kadaluarsa.val());

  $.ajax({
      url: '<?php echo base_url('loading-masuk/scan-proses') ?>',
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
          tgl_kadaluarsa.focus();
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