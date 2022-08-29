
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
      var audio = new Audio(`<?=base_url('assets/qrscan/')?>notif2.mp3`);
      self.exist = false
      for(var i=0; i < self.scans.length; i++){
        // console.log(self.scans[i].content.toString()+' - '+content.toString());
        if( self.scans[i].content.toString() == content.toString()){
          self.exist = true;
        }
      }
      // console.log(self.exist);
      if(!self.exist){
        self.scans.unshift({ date: +(Date.now()), content: content });
        audio.play(); 
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
</script>