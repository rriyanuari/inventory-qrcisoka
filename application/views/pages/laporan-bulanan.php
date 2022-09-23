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
                  <input type="month" name="periode" class="form-control" max="<?= date("Y-m"); ?>" value="<?= ($periode) ? date('Y-m', strtotime($periode)) : ""; ?>">
                </div>

                <div class="col-md-6">
                  <button class="btn btn-primary text-light" id="tmb_cari" data-toggle="tooltip" data-original-title="Simpan Periode">
                    Simpan Periode
                  </button>
                </div>
              </div>
              <div class="d-flex">
                <?php
                if ($periode) {
                  echo "<h5>Periode : " . $periode . "</h5>";
                }
                ?>
                <div class="d-flex ml-auto mb-3">
                  <?php if($periode != null){ ?>
                  <a class="btn btn-primary text-light" href="<?= base_url('laporan-bulanan/cetak/?periode=') . date('Y-m', strtotime($periode)); ?>" target="_blank" data-toggle="tooltip" data-original-title="Cetak Laporan">
                    <i class="fas fa-print">
                    </i>
                  </a>
                  <?php } ?>
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
                            if ($out != 0) {
                            ?>
                              <?php
                              foreach ($jenis_material['materials'] as $material) : ?>
                                <p>
                                  <?= number_format($material['qty'], 2, ',', '.'); ?> || <em><?= $material['tgl_kadaluarsa']; ?></em>
                                </p>
                              <?php endforeach ?>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      endforeach;
                    } else {
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