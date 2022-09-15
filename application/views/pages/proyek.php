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
                      <th class="text-center">Nama Proyek</th>
                      <th class="text-center">Tgl Mulai</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($proyeks->result_array() as $proyek) :
                    ?>
                      <tr>
                        <td class="text-center"><?= $proyek['id']; ?></td>
                        <td class=""><?= $proyek['nama']; ?></td>
                        <td class=""><?= $proyek['tgl_mulai']; ?></td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_data_modal<?= $proyek['id']; ?>">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" data-original-title="Delete item" id="<?= $proyek['id']; ?>">
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
          <div class="form-group col-md-4">
            <label for="id">ID Proyek</label>
            <input type="number" name="id" class="form-control" placeholder="ID Proyek" max="999999">
          </div>
          <div class="form-group col-md-8">
            <label for="nama">Nama Proyek</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Proyek">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="tgl_mulai">Tgl Mulai Proyek</label>
            <input type="date" name="tgl_mulai" class="form-control" placeholder="tgl_mulai Proyek">
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
foreach ($proyeks->result_array() as $proyek) :
?>

<!-- MODAL EDIT -->
<div class="modal fade" id="edit_data_modal<?= $proyek['id']; ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Ubah Data <?= $title; ?> ( <?= $proyek['id']; ?> )</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="id<?= $proyek['id']; ?>">ID Proyek</label>
            <input type="number" name="id<?= $proyek['id']; ?>" class="form-control" placeholder="ID Proyek" value="<?= $proyek['id']; ?>">
          </div>
          <div class="form-group col-md-8">
            <label for="nama<?= $proyek['id']; ?>">Nama Proyek</label>
            <input type="text" name="nama<?= $proyek['id']; ?>" class="form-control" placeholder="Nama Proyek" value="<?= $proyek['nama']; ?>">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="tgl_mulai<?= $proyek['id']; ?>">Tgl Mulai Proyek</label>
            <input type="date" name="tgl_mulai<?= $proyek['id']; ?>" class="form-control" placeholder="tgl_mulai Proyek" value="<?= $proyek['tgl_mulai']; ?>">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-edit" id="<?= $proyek['id']; ?>">Ubah</button>
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