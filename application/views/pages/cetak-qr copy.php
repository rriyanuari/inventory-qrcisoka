<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $title; ?> - Inventory Qr Cisoka</title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('public/img/fyfe-background-icon.png') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/fontawesome/css/all.min.css"> -->
  <script src="<?php echo base_url() ?>/assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/modules/jquery_qrcode.min.js"></script>

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
    <table class="table">
      <tbody>
        <?php 
          $x = 1;

          for($x; $x <= $material['qty']; $x++):
            if($x < 10){
              $no = "00".$x;
            }elseif($x < 100 && $x >= 10){
              $no = "0".$x;
            } else{
              $no = $x;
            }

            if($x % 4 == 1) {
        ?>
            <tr cols="4">
              <td class="m-1 p-1 border text-center">
                <span style="font-size:12px"><?= $material['id'].'-'.$no; ?></span>
                <div id="output<?=$no?>"></div> 
              </td>
        <?php
            }
            elseif($x % 4 == 1){
        ?>
            <td class="m-1 p-1 border text-center">
              <span style="font-size:12px"><?= $material['id'].'-'.$no; ?></span>
              <div id="output<?=$no?>"></div> 
            </td>
          </tr>
        <?php
            }
            else{
        ?>
            <td class="m-1 p-1 border text-center">
              <span style="font-size:12px"><?= $material['id'].'-'.$no; ?></span>
              <div id="output<?=$no?>"></div> 
            </td>
        <?php
            }
        ?>
        <script>
          $(`#output<?=$no?>`).qrcode({
            render: "canvas", 
            text: `<?= base_url(); ?>/view/<?= $material['id'] ?>/<?=$no?>`, 
            width: 200, 
            height: 200,
            background: "#ffffff", 
            foreground: "#000000", 
            src: '<?= base_url('public/img/fyfe-background.jpg') ?>',
            imgWidth: 72,
            imgHeight: 36
          });          
        </script>
        <?php 
          endfor 
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>