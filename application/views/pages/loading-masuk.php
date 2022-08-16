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
                    <h4>Form Loading Masuk</h4>
                  </div>
                  <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Satuan Unit</label>
                        <select name="satuan" class="form-control select2" style="width:100%;">
                          <option value="">-</option>
                        </select>
                      </div>
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
                      <th width="" class="text-center">#</th>
                      <th width="" class="text-center">Jenis Material</th>
                      <th width="15%" class="text-center">Total Qty</th>
                      <th width="10%" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>