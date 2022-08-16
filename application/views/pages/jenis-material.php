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
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah_data_modal">
                  <i class="fas fa-plus-circle"></i> Tambah Data
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-striped datatables">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Foto</th>
                      <th class="text-center">Jenis Material</th>
                      <th class="text-center">Satuan</th>
                      <th class="text-center">Konversi</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jenis_materials->result_array() as $jenis_material) :
                      $path_foto = ($jenis_material['foto']) ? ($jenis_material['foto']) : 'product_default.png';
                    ?>
                      <tr>
                        <td class="text-center"><?= $jenis_material['id']; ?></td>
                        <td class="text-center">
                          <img src="<?= base_url('public/img/materials/') . $path_foto ; ?>" alt="<?= $jenis_material['id']; ?>" width="80">
                        </td>
                        <td class=""><?= $jenis_material['nama']; ?></td>
                        <td class=""><?= $jenis_material['satuan']; ?></td>
                        <td class="text-right">
                          <?= (!$jenis_material['nilai_konversi']) ? '-' : $jenis_material['nilai_konversi'] . " " . $jenis_material['satuan_konversi']; ?>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_data_modal<?= $jenis_material['id']; ?>">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" data-original-title="Delete item" id="<?= $jenis_material['id']; ?>">
                            <i class="fas fa-times-circle"></i>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambah_data_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Tambah Data <?= $title; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-12">
            <label for="nama">Nama Jenis Material</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Jenis Material">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Satuan Unit</label>
            <select name="satuan" class="form-control select2" style="width:100%;">
              <option value="">-</option>
              <option value="Roll">Roll</option>
              <option value="Pail">Pail</option>
              <option value="Pcs">Pcs</option>
              <option value="Bag">Bag</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Satuan Konversi</label>
            <select name="satuan_konversi" class="form-control select2" style="width:100%;">
              <option value="">-</option>
              <option value="Liter">Liter</option>
              <option value="Kg">Kg</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Nilai Konversi</label>
            <input type="number" class="form-control" name="nilai_konversi" placeholder="0.00">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label for="foto">Upload Foto</label>
            <input type="file" class="form-control-file" id="foto">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-add">Tambahkan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.MODAL TAMABAH -->

<?php
foreach ($jenis_materials->result_array() as $jenis_material) :
?>

<!-- MODAL EDIT -->
<div class="modal fade" id="edit_data_modal<?= $jenis_material['id']; ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Ubah Data <?= $title; ?> ( <?= $jenis_material['id']; ?> )</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-12">
            <label for="nama">Nama Jenis Material</label>
            <input type="text" name="nama<?= $jenis_material['id']; ?>" class="form-control" value="<?= $jenis_material['nama']; ?>">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Satuan Unit</label>
            <select name="satuan<?= $jenis_material['id']; ?>" class="form-control select2" style="width:100%;">
              <option value="">-</option>
              <option <?= ($jenis_material['satuan'] == 'Roll') ? 'selected' : '' ; ?> value="Roll">Roll</option>
              <option <?= ($jenis_material['satuan'] == 'Pail') ? 'selected' : '' ; ?> value="Pail">Pail</option>
              <option <?= ($jenis_material['satuan'] == 'Pcs') ? 'selected' : '' ; ?> value="Pcs">Pcs</option>
              <option <?= ($jenis_material['satuan'] == 'Bag') ? 'selected' : '' ; ?> value="Bag">Bag</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Satuan Konversi</label>
            <select name="satuan_konversi<?= $jenis_material['id']; ?>" class="form-control select2" style="width:100%;">
              <option <?= ($jenis_material['satuan_konversi'] == '-') ? 'selected' : '' ; ?> value="">-</option>
              <option <?= ($jenis_material['satuan_konversi'] == 'Liter') ? 'selected' : '' ; ?> value="Liter">Liter</option>
              <option <?= ($jenis_material['satuan_konversi'] == 'Kg') ? 'selected' : '' ; ?> value="Kg">Kg</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Nilai Konversi</label>
            <input type="number" class="form-control" name="nilai_konversi<?= $jenis_material['id']; ?>" value="<?= $jenis_material['nilai_konversi']; ?>">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label for="foto">Upload Foto</label>
            <input type="file" class="form-control-file" id="foto<?= $jenis_material['id']; ?>">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-edit" id="<?= $jenis_material['id']; ?>">Ubah</button>
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