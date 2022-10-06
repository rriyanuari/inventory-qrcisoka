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
              <div id="accordion" class="card">
                <div class="accordion mb-5 card-body">
                  <div class="accordion-header collapsed py-4" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="false">
                    <h4>Form Permintaan Loading Masuk</h4>
                  </div>
                  <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Jenis Material</label>
                        <select name="id_jenis_material" class="form-control select2" style="width:100%;">
                          <?php
                            foreach ($jenis_materials->result_array() as $jenis_material) :
                          ?>
                          <option value="<?= $jenis_material['id']; ?>"><?= $jenis_material['id'] . ' - ' . $jenis_material['nama']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Qty</label>
                        <input type="number" class="form-control" name="qty" placeholder="0" min="0">
                      </div>
                      <!-- <div class="form-group col-md-6">
                        <label>Tgl Kadaluarsa</label>
                        <input type="date" class="form-control" name="tgl_kadaluarsa" min="<?= date("Y-m-d"); ?>" value="<?= date("Y-m-d"); ?>">
                      </div> -->
                    </div>

                    <button type="submit" class="btn btn-success btn-add">Tambahkan</button>

                  </div>
                </div>
              </div>
              <h4 class="my-3 text-center">Validasi Loading Masuk</h4>
              <div class="table-responsive">
                <table class="table table-striped datatables">
                  <thead>
                    <tr>
                      <th width="5%" class="text-center">ID Loading</th>
                      <th width="" class="text-center">Jenis Material</th>
                      <th width="15%" class="text-center">Qty</th>
                      <th width="15%" class="text-center">Tgl Permintaan</th>
                      <th width="15%" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($loadings as $loading):
                    ?>
                      <tr>
                        <td class="text-center"><?= $loading['id']; ?></td>
                        <td class=""><?= $loading['material']['nama']; ?></td>
                        <td class="text-right">
                          <?= number_format($loading['qty_loading'], 2, ',', '.') . " " . $loading['material']['satuan']; ?>
                        </td>
                        <td class="text-center"><?= date('d-m-Y | h:i A', strtotime($loading['tgl_permintaan'])); ?></td>
                        <td class="text-center">
                          <a class="btn btn-primary btn-sm text-light" data-toggle="tooltip" data-original-title="Cetak QR" href="<?= base_url('cetak-qr/') . $loading['material']['id'] ?>" target="_blank">
                            <i class="fas fa-qrcode"></i>
                            </i>
                          </a>
                          <a class="btn btn-success btn-sm text-light" data-toggle="tooltip" data-original-title="Validasi permintaan" href="<?= base_url('loading-masuk/scan/') . $loading['id'] ?>">
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