<!-- Main Content -->
  <section class="section container mt-5">
    <div class="my-5">
      <img src="<?= base_url('public/img/fyfe-transparant.png') ?>" class="image" height="50">
      <p> 
        <em>
          Karawaci Office Park - Lippo Karawaci Jl. Pintu Besar Blok H 56-57 15811<br />
          Telp Office: +62 21 5576 3933. www.fyfeindonesia.com 
        </em>
      </p>
    </div>
    <div class="text-center">
      <h2 class=""><?= $title; ?> Inventory - Gudang Cisoka</h2>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex">
                <?php
                  if ($periode) {
                    echo "<p>Periode : " . $periode . "</p>";
                  }
                ?>
                <!-- <p>Periode : Agustus 2022</p> -->
                <div class="ml-auto  mb-3">
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
    </div>
    <div class="row text-center mb-5">
      <div class="col-md-4">
        Reported by
      </div>
      <div class="col-md-5">
        Review by
      </div>
      <div class="col-md-3">
        Approved by
      </div>
    </div>
    <br />
    <br />
    <div class="row text-center my-5">
      <div class="col-md-2">
        Dedi Purwanto <br />
        Warehouse
      </div>
      <div class="col-md-2">
        A. Sopian Sauri <br />
        Inventory
      </div>
      <div class="col-md-3">
        Kristanti Maria Ignatia <br />
        Deputy Operasional
      </div>
      <div class="col-md-2">
        Renaldy Susilo <br />
        Accounting
      </div>
      <div class="col-md-3">
        Anang Widarso <br />
        GM Operasional
      </div>
    </div>
  </section>

