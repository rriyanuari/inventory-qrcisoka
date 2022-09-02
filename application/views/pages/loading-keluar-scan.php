<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Validasi <?= $title; ?></h1>
    </div>
    <div class="section-body">
      <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
          <div class="form-group col-md-6">
            <label> ID Scan : </label> 
            <input type="text" size="5" class="form-control" id="id_material" value="0" disabled> 
          </div>
        </div>

        <div id="app" class="app_qr">
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
                <span class="badge badge-light ml-auto">{{ scans.length }}<span>
              </h5>

              <ul v-if="scans.length === 0">
                <li class="empty">No scans yet</li>
              </ul>
              <ul v-if="scans.length != 0">
                <li><button class="btn btn-block btn-success" id="tmb-simpan" onclick="simpan()">Simpan</button></li>
              </ul>
              <transition-group name="scans" tag="ul">
                <li v-for="(scan, index) in scans" :key="scan.date" :value="scan.content" class="d-flex">
                  <input type="text" :value="scan.content" class="hasilscan" hidden />{{ scan.content }}
                  <button class="btn btn-sm btn-danger btn-delete ml-auto" v-on:click="remove(index)">
                    <i class="fas fa-times-circle"></i>
                  </button>
                </li>
              </transition-group>
            </section>
            <div id="autoSave"></div>
          </div>
          <div class="preview-container">
            <video id="preview" style="height: 90%;"></video>
          </div>
        </div>

      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
</div>