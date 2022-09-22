<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title; ?> Inventory - Gudang Cisoka</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="form-group col-md-6">
                  <label>Pilih Periode</label>
                  <?php
                  // date("Y-m", strtotime(date("Y-m-d"). ' - 1 months')); 
                  ?>
                  <input type="month" name="periode" class="form-control" max="<?= date("Y-m"); ?>"
                  value="<?= ($periode) ? date('Y-m', strtotime($periode)) : ""; ?>">
                </div>

                <div class="col-md-6">
                  <button class="btn btn-primary text-light" id="tmb_cari" data-toggle="tooltip" data-original-title="Simpan Periode">
                    Simpan Periode
                  </button>
                </div>
              </div>
              <div class="d-flex">
                <?php 
                  if($periode){
                    echo "<h5>Periode : " . $periode . "</h5>";
                  } 
                ?> 
                <div class="d-flex ml-auto mb-3">

                  <a class="btn btn-primary text-light" href="<?= base_url('laporan-bulanan/cetak') ?>"
                      target="_blank" data-toggle="tooltip" data-original-title="Cetak Laporan">
                    <i class="fas fa-print">
                    </i>
                  </a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered datatables">
                  <thead>
                    <tr>
                      <th width="" class="text-center">#</th>
                      <th width="" class="text-center">Material</th>
                      <th width="" class="text-center">Satuan</th>
                      <th width="8%" class="text-center">Qty Awal</th>
                      <th width="8%" class="text-center">In</th>
                      <th width="8%" class="text-center">Out</th>
                      <th width="8%" class="text-center">Qty Akhir</th>
                      <th width="20%" class="text-center">Expired</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;

                    if ($jenis_materials) {

                      // print("<pre>".print_r($jenis_materials,true)."</pre>");
                      foreach ($jenis_materials as $jenis_material) :
                        $stock_awal    = 0;
                        $stock_akhir   = 0;
                        $in   = 0;
                        $out   = 0;

                        foreach ($jenis_material['materials'] as $material) :

                          if ($material['loadings'] != null) {

                            $loading_length = count($material['loadings']);

                            $stock_awal   = $material['loadings'][0]['total_qty_awal'];
                            $stock_akhir  = $material['loadings'][$loading_length - 1]['total_qty_akhir'];

                            foreach ($material['loadings'] as $loading) :
                              // print("<pre>".print_r($loading, true)."</pre>");

                              if ($loading['type'] == 'Masuk') {
                                $in += $loading['qty_loading'];
                              }

                              if ($loading['type'] == 'Keluar') {
                                $out += $loading['qty_loading'];
                              }

                            endforeach;
                          }

                        endforeach;

                        ?>
                          <tr>
                            <td class="align-middle text-center"><?= $jenis_material['id']; ?></td>
                            <td class="align-middle"><?= $jenis_material['nama']; ?></td>
                            <td class="align-middle text-center"><?= $jenis_material['satuan']; ?></td>
                            <td class="align-middle text-center"><?= number_format($stock_awal, 2, ',', '.'); ?></td>
                            <td class="align-middle text-center"><?= number_format($in, 2, ',', '.'); ?></td>
                            <td class="align-middle text-center"><?= number_format($out, 2, ',', '.'); ?></td>
                            <td class="align-middle text-center"><?= number_format($stock_akhir, 2, ',', '.'); ?></td>
                            <td class="align-middle text-right">
                              <?php
                              foreach ($jenis_material['materials'] as $material) : ?>
                                <p>
                                  <?= number_format($material['qty'], 2, ',', '.'); ?> || <em><?= $material['tgl_kadaluarsa']; ?></em>
                                </p>
                              <?php endforeach ?>
                            </td>
                          </tr>
                        <?php
                        $no++;
                      endforeach;
                    }
                    else{
                      ?>
                      <tr>
                        <td colspan="8" class="text-center">
                          <em>-- Silahkan pilih periode terlebih dahulu --</em>
                        </td>
                      </tr>
                      <?php
                    }
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
                    <a class="btn btn-primary btn-sm text-light" href="<?= base_url('cetak-qr/') . $material['id'] ?>">
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