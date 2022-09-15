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
                <a href="<?= base_url('loading-return/scan'); ?>" class="btn btn-success">
                  <i class="fas fa-plus-circle"></i> Scan Qr
                </a>
              </div>
              <h4 class="my-3 text-center">Validasi Loading Return</h4>
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

                      foreach ($loading['scans'] as $scan) :
                        $loading['total_qty'] += $scan['qty'];
                      endforeach;
                      $no += 1;
                    ?>
                      <tr class="">
                        <td class="text-center align-middle"><?= $loading['id']; ?></td>
                        <td class="text-center align-middle">
                          <div id="accordion<?= $loading['id'] ?>">
                            <div class="accordion">
                              <div class="accordion-header collapsed py-4" role="button" data-toggle="collapse" data-target="#panel-body-<?= $loading['id'] ?>" aria-expanded="false">
                                <h4><?= date('d-m-Y | h:i A', strtotime($loading['tgl_scan'])); ?></h4>
                              </div>
                              <div class="accordion-body collapse" id="panel-body-<?= $loading['id'] ?>" data-parent="#accordion<?= $loading['id'] ?>">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>Material</th>
                                      <th>Qty</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    foreach ($loading['scans'] as $scan) :
                                    ?>
                                      <tr>
                                        <td><?= $scan['nama'] ?> ( <em><?= $scan['id_material']; ?><em> )</td>
                                        <td><?= $scan['qty'] ?></td>
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
                          <a class="btn btn-success btn-sm text-light" data-toggle="modal" data-target="#validasi_modal<?= $loading['id']; ?>">
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

<?php
foreach ($loadings as $loading) :
  $loading['total_qty'] = 0;

  foreach ($loading['scans'] as $scan) :
    $loading['total_qty'] += $scan['qty'];
  endforeach;
?>

<!-- MODAL EDIT -->
<div class="modal fade" id="validasi_modal<?= $loading['id']; ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Validasi <?= $title; ?> ( <?= $loading['id']; ?> )</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row font-weight-bold">
          <div class="col-md-3">Id Loading</div>
          <div>: <?= $loading['id'] ?></div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-3">Waktu scan</div>
          <div>: <?= date('d-m-Y | h:i A', strtotime($loading['tgl_scan'])); ?></div>
        </div>
        <div class="row">
          <div class="col-md-3">Total Qty</div>
          <div>: <?= $loading['total_qty'] ?> material</div>
        </div>
        <hr />
        <div class="form-group col-md-12">
          <label>Nama Proyek</label>
          <select name="id_proyek<?= $loading['id']; ?>" class="form-control select2" style="width:100%;">
            <?php
              foreach ($proyeks as $proyek) :
            ?>
            <option value="<?= $proyek['id']; ?>"><?= $proyek['id'] . ' - ' . $proyek['nama']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col-md-12">
          <label>Keterangan</label>
          <textarea class="form-control" name="keterangan<?= $loading['id']; ?>" cols="30" rows="10"></textarea>
        </div>
        <div id="accordion-detail<?= $loading['id'] ?>">
          <div class="accordion">
            <div class="bg-primary text-light accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-detail-<?= $loading['id'] ?>" aria-expanded="false">
              <h5>List Material</h5>
            </div>
            <div class="accordion-body collapse" id="panel-body-detail-<?= $loading['id'] ?>" data-parent="#accordion-detail<?= $loading['id'] ?>">
              <table class="table table-striped datatables">
                <thead>
                  <tr>
                    <th>Material</th>
                    <th>Qty</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($loading['scans'] as $scan) :
                  ?>
                    <tr>
                      <td><?= $scan['nama'] ?> ( <em><?= $scan['id_material']; ?><em> )</td>
                      <td><?= $scan['qty'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-valid" id="<?= $loading['id']; ?>">Validasi</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.MODAL EDIT -->

<?php
endforeach;
?>