
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
                <a href="<?= base_url('loading-keluar/scan'); ?>" class="btn btn-success">
                  <i class="fas fa-plus-circle"></i> Scan Qr
                </a>
              </div>
              <h4 class="my-3 text-center">Validasi Loading Keluar</h4>
              <div class="table-responsive">
                <table class="table table-striped datatables">
                  <thead>
                    <tr>
                      <th width="5%" class="text-center">ID Loading</th>
                      <th width="" class="text-center">Waktu Scan</th>
                      <th width="15%" class="text-center">Total Qty</th>
                      <th width="15%" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      // print("<pre>".print_r($loadings,true)."</pre>");
                      $no = 0;
                      foreach ($loadings as $loading) :
                        $loading['total_qty'] = 0;
                        
                        foreach($loading['scans'] as $scan) :
                          $loading['total_qty'] += $scan['qty'];
                        endforeach;
                      $no += 1;
                    ?>
                      <tr class="">
                        <td class="text-center align-middle"><?= $loading['id']; ?></td>
                        <td class="text-center align-middle">
                          <div id="accordion<?=$loading['id']?>">
                            <div class="accordion">
                              <div class="accordion-header collapsed py-4" role="button" data-toggle="collapse" data-target="#panel-body-<?=$loading['id']?>" aria-expanded="false">
                                <h4><?= date('d-m-Y | h:i A', strtotime($loading['tgl_scan'])); ?></h4>
                              </div>
                              <div class="accordion-body collapse" id="panel-body-<?=$loading['id']?>" data-parent="#accordion<?=$loading['id']?>">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>Material</th>
                                      <th>Qty</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      foreach($loading['scans'] as $scan):
                                    ?>
                                    <tr>
                                      <td><?= $scan['nama'] ?> ( <em><?= $scan['id_material']; ?><em> )</td>
                                      <td><?= $scan['qty']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="text-center align-middle"><?= $loading['total_qty']; ?></td>
                        <td class="text-center align-middle">
                          <a class="btn btn-success btn-sm text-light" data-toggle="tooltip" data-original-title="Setujui permintaan  " href="<?= base_url('cetak-qr/') . $loading['id'] ?>">
                            <i class="fas fa-check-circle"></i>
                            </i>
                          </a>
                          <button class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" data-original-title="Tolak permintaan" id="<?= $loading['id']; ?>">
                            <i class="fas fa-times-circle"></i>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>