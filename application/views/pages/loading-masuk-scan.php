<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Validasi <?= $title; ?></h1>
    </div>
    <div class="section-body">
      <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
          <div class="form-group col-md-2">
            <label> ID Jenis Material : </label>
            <input type="text" size="5" class="form-control" id="id_jenis_material" value="<?= $material['id_jenis_material']; ?>" disabled>
          </div>
          <div class="form-group col-md-4">
            <label> </label>
            <input type="text" size="5" class="form-control" id="jenis_material" value="<?= $material['nama']; ?>" disabled>
          </div>
          <div class="form-group col-md-2">
            <label> ID Material : </label>
            <input type="text" size="5" class="form-control" id="id_material" value="<?= $material['id'] ?>" disabled>
          </div>
          <div class="form-group col-md-4">
            <label>Tgl Kadaluarsa</label>
            <input type="date" class="form-control" name="tgl_kadaluarsa" min="<?= date("Y-m-d"); ?>">
          </div>
        </div>

        <div id="app" class="app_qr">
          <div class="preview-container">
            <video id="preview" style="height: 90%;"></video>
          </div>
          <div class="sideApp">
            <section class="cameras">
              <h5 class="bg-primary text-light p-2">Cameras</h5>
              <ul>
                <li v-if="cameras.length === 0" class="empty">No cameras found</li>
                <li v-for="camera in cameras">
                  <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">{{ formatName(camera.name) }}</span>
                  <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                    <a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
                  </span>
                </li>
              </ul>
            </section>
            <section class="scans">
              <h5 class="bg-primary text-light p-2 d-flex">Scans
                <span class="badge badge-light ml-auto"><span id="qty_material">{{ scans.length }}</span> / <?= $material['qty'] ?><span>
              </h5>

              <ul v-if="scans.length === 0">
                <li class="empty">No scans yet</li>
              </ul>
              <ul v-if="scans.length == <?= $material['qty'] ?>">
                <li><button class="btn btn-block btn-success" id="tmb-simpan" onclick="simpan()">Simpan</button></li>
              </ul>
              <transition-group name="scans" tag="ul">
                <li v-for="scan in scans" :key="scan.date" :value="scan.content"><input type="text" :value="scan.content" class="hasilscan" hidden />{{ scan.content }}</li>
              </transition-group>
            </section>
            <div id="autoSave"></div>
          </div>
        </div>

      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
</div>