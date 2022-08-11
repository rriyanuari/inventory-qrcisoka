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
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Jenis Material</th>
                      <th>Satuan</th>
                      <th>Nilai Konversi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach ($jenis_materials->result_array() as $jenis_material) :
                    ?>
                      <tr>
                        <td>
                          <?= $no; ?>
                        </td>
                        <td class=""><?= $jenis_material['nama']; ?></td>
                        <td class=""><?= $jenis_material['satuan']; ?></td>
                        <td class="text-right"><?= $jenis_material['nilai_konversi'] . " - " . $jenis_material['satuan_konversi']; ?></td>
                        <td class=""><a href="#" class="btn btn-secondary">Detail</a></td>
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