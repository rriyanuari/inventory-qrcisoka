<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title; ?></h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-end mb-3">
              </div>
              <div class="table-responsive">
                <table class="table table-striped datatables">
                  <thead>
                    <tr>
                      <th width="" class="text-center">#</th>
                      <th width="" class="text-center">Jenis Material</th>
                      <th width="" class="text-center">Total Qty</th>
                      <th width="" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jenis_materials as $jenis_material) :

                      $total_qty = 0;
                      foreach ($jenis_material['materials'] as $material) :
                        $total_qty += $material['qty'];
                      endforeach;
                    ?>
                      <tr>
                        <td class="text-center"><?= $jenis_material['id']; ?></td>
                        <td class=""><?= $jenis_material['nama']; ?></td>
                        <td class="text-right"><?= $total_qty . ' ' . $jenis_material['satuan']; ?></td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detail_modal<?= $jenis_material['id']; ?>">
                            <i class="fas fa-info-circle"></i>
                          </button>
                        </td>
                      </tr>
                    <?php
                      $no++;
                    endforeach;
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>


<?php
foreach ($jenis_materials as $jenis_material) :
  $path_foto = ($jenis_material['foto']) ? ($jenis_material['foto']) : 'product_default.png';

  $total_qty = 0;
  foreach ($jenis_material['materials'] as $material) :
    $total_qty += $material['qty'];
  endforeach;
?>
  <!-- MODAL DETAIL -->
  <div class="modal fade" id="detail_modal<?= $jenis_material['id'] ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h4 class="modal-title">Detail Jenis Material <?= $jenis_material['id'] ?></h4>
          <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-4 text-center">
              <img src="<?= base_url('public/img/materials/') . $path_foto; ?>" width="100px">
            </div>
            <div class="col-md-8">
              <table width="100%">
                <tr class="row py-2 font-weight-bold">
                  <td width="30%">Jenis Barang</td>
                  <td width="70%">: <?= $jenis_material['id'] . ' - ' . $jenis_material['nama'] ?></td>
                </tr>
                <tr class="row py-2">
                  <td width="30%">Satuan</td>
                  <td width="70%">: <?= $jenis_material['satuan'] ?></td>
                </tr>
                <tr class="row py-2">
                  <td width="30%">Total Qty</td>
                  <td width="70%">: <?= $total_qty ?></td>
                </tr>
              </table>
              <hr>
            </div>
          </div>
          <div class="bg-primary text-light">
            <h5 class="text-center py-2 mb-3">List Material</h5 class="text-center">
          </div>
          <table class="table table-striped datatables" width="100%" bordered>
            <thead>
              <tr class="text-center">
                <td>#</td>
                <td>Tgl Masuk (valid)</td>
                <td>Tgl Kadaluarsa</td>
                <td>Qty</td>
                <td>Qr</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($jenis_material['materials'] as $material) :
                $total_qty += $material['qty'];
              ?>
                <tr class="text-center">
                  <td width="5%"><?= $material['id'] ?></td>
                  <td class="text-right"><?= date('d-m-Y', strtotime($material['tgl_valid'])); ?></td>
                  <td class="text-right"><?= date('d-m-Y', strtotime($material['tgl_kadaluarsa'])); ?></td>
                  <td class="text-right"><?= number_format($material['qty'], 2, ',', '.') ?></td>
                  <td width="10%" class="project-actions align-middle">
                    <a class="btn btn-primary btn-sm text-light" href="<?= base_url('cetak-qr/') . $material['id'] ?>" target="_blank">
                      <i class="fas fa-qrcode">
                      </i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.MODAL DETAIL -->
<?php endforeach; ?>