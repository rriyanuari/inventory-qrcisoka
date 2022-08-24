<!DOCTYPE html>
<html>
<head>
  <title>DB-qrcisoka | QR Code</title>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/fontawesome/css/all.min.css"> -->
  <script src="<?php echo base_url() ?>/assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/modules/jquery_qrcode.min.js"></script>

  <script>
    function generate(x){
      $(`#output${x}`).qrcode({
        render: "canvas", 
        text: `<?= $material['id'] ?>.${x}`, 
        width: 100, 
        height: 100,
        background: "#ffffff", 
        foreground: "#000000", 
        src: '<?= base_url() ?>public/img/fyfe-transparant.png',
        imgWidth: 36,
        imgHeight: 18
      });  
    };
  </script>

  <style>
    .container{
      width: 85%;
      padding: 20px;
      margin: 50px auto;
      border: 2px solid;
    }
    .col{
      border: 1px solid;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="d-flex flex-wrap">
      <?php 
        $x = 1;
        for($x; $x <= $material['qty']; $x++):
          if($x < 10){
            $no = "00".$x;
          }elseif($x < 100 && $x >= 10){
            $no = "0".$x;
          }

          $tgl_kadaluarsa = date("m/y", strtotime($material['tgl_kadaluarsa'])); 
          $tgl_masuk = date("m/y", strtotime($material['tgl_permintaan'])); 
      ?>
          <div class="m-1 p-1 border text-center">
            <span style="font-size:12px"><?= $material['id'].'-'.$no.' | '.$tgl_masuk.'-'.$tgl_kadaluarsa  ?></span>
            <div id="output<?=$no?>"></div> 
          </div>
          <script>
            $(`#output<?=$no?>`).qrcode({
              render: "canvas", 
              text: `FyfeQR/<?= $material['id'] ?>/<?=$no?>`, 
              width: 100, 
              height: 100,
              background: "#ffffff", 
              foreground: "#000000", 
              src: '<?= base_url() ?>public/img/fyfe-background.jpg',
              imgWidth: 36,
              imgHeight: 18
            });          
          </script>
      <?php endfor ?>
    </div>
  </div>
</body>
</html>