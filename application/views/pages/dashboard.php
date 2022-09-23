<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title;  ?></h1>
    </div>

    <div class="section-body">
      <h6>Summary Master Data</h6>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-box"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jenis Material</h4>
              </div>
              <div class="card-body" id="jenis_material">
                -
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-boxes"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Material</h4>
              </div>
              <div class="card-body" id="material">
                -
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Proyek</h4>
              </div>
              <div class="card-body" id="proyek">
                -
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-stats">
              <div class="card-stats-title">Statistik Loading Material -
                <div class="dropdown d-inline">
                  <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                  <ul class="dropdown-menu dropdown-menu-sm">
                    <li class="dropdown-title">Select Month</li>
                    <li><a href="#" class="dropdown-item">January</a></li>
                    <li><a href="#" class="dropdown-item">February</a></li>
                    <li><a href="#" class="dropdown-item">March</a></li>
                    <li><a href="#" class="dropdown-item">April</a></li>
                    <li><a href="#" class="dropdown-item">May</a></li>
                    <li><a href="#" class="dropdown-item">June</a></li>
                    <li><a href="#" class="dropdown-item">July</a></li>
                    <li><a href="#" class="dropdown-item active">August</a></li>
                    <li><a href="#" class="dropdown-item">September</a></li>
                    <li><a href="#" class="dropdown-item">October</a></li>
                    <li><a href="#" class="dropdown-item">November</a></li>
                    <li><a href="#" class="dropdown-item">December</a></li>
                  </ul>
                </div>
              </div>
              <div class="card-stats-items">
                <div class="card-stats-item">
                  <div class="card-stats-item-count">24</div>
                  <div class="card-stats-item-label">Pending </div>
                </div>
                <div class="card-stats-item">
                  <div class="card-stats-item-count">12</div>
                  <div class="card-stats-item-label">Shipping</div>
                </div>
                <div class="card-stats-item">
                  <div class="card-stats-item-count">23</div>
                  <div class="card-stats-item-label">Completed</div>
                </div>
              </div>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Orders</h4>
              </div>
              <div class="card-body">
                59
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <hr />
      <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Loading Material ( Masuk vs Keluar )</h4>
            </div>
            <div class="card-body">
              <canvas id="myChart" height="200"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Aktifitas Terakhir</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border" id="aktifitas_terakhir">
              </ul>
              <!-- <div class="text-center pt-1 pb-1">
                <a href="#" class="btn btn-primary btn-lg btn-round">
                  View All
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>