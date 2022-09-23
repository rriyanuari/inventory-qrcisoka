<script>
  $(document).ready(function() {
    function formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2)
        month = '0' + month;
      if (day.length < 2)
        day = '0' + day;

      return [day, month, year].join('-');
    }

    $.ajax({
      url: '<?php echo base_url('dashboard/get-data') ?>',
      dataType: 'json', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      type: 'post',
      success: function(data, status) {
        if (data.status == 'success') {
          console.log(data.return)
          $('#jenis_material').html(data.return.jenis_material);
          $('#material').html(data.return.material);
          $('#proyek').html(data.return.proyek);

          // GENERATE CHART
          var ctx = document.getElementById("myChart").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: ["Januari", "Februari", "Maret", "April ", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
              datasets: [{
                  label: 'Masuk',
                  data: data.return.loading_masuk,
                  borderWidth: 2,
                  backgroundColor: 'rgba(63,82,227,.8)',
                  // backgroundColor: 'transparent',
                  // borderColor: 'rgba(63,82,227,.8)',
                  borderColor: 'transparent',
                  pointBorderWidth: 0,
                  pointRadius: 3.5,
                  pointBackgroundColor: 'transparent',
                  pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                },
                {
                  label: 'Keluar',
                  data: data.return.loading_keluar,
                  borderWidth: 2,
                  backgroundColor: 'rgba(254,86,83,.7)',
                  // backgroundColor: 'transparent',
                  // borderColor: 'rgba(254,86,83,.7)',
                  borderColor: 'transparent',
                  pointBorderWidth: 0,
                  pointRadius: 3.5,
                  pointBackgroundColor: 'transparent',
                  pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                }
              ]
            },
            options: {
              legend: {
                display: false
              },
              scales: {
                yAxes: [{
                  gridLines: {
                    display: false,
                    drawBorder: false,
                    // color: '#f2f2f2',
                  },
                  ticks: {
                    beginAtZero: true,
                    stepSize: 10,
                    callback: function(value, index, values) {
                      return `${value}`;
                    }
                  }
                }],
                xAxes: [{
                  gridLines: {
                    // display: false,
                    // tickMarkLength: 15,
                    color: '#fbfbfb',
                    lineWidth: 2
                  }
                }]
              },
            }
          });

          // GENERATE AKTIFITAS TERAKHIR
          for (let i = 0; i < 3; i++) {
            loading = data.return.loadings[i];

            let icon ={}

            switch (loading.type) {
              case "Masuk":
                icon.name = "fas fa-truck-loading"
                icon.color = "success"
                icon.number = "fas fa-angle-up"
                break;

              case "Keluar":
                icon.name = "fas fa-truck-moving"
                icon.color = "danger"
                icon.number = "fas fa-angle-down"
                break;
              
              case "Return":
                icon.name = "fas fa-undo"
                icon.color = "warning"
                icon.number = "fas fa-angle-up"
                break;  
            
              default:
                break;
            }
            console.log(icon)

            $('#aktifitas_terakhir').append(`
            <li class="media">
              <div class="mr-3 p-3 bg-${icon.color} text-white" width="50">
                <i class="${icon.name}"></i>
              </div>
              <div class="media-body">
                <div class="float-right text-primary">${formatDate(loading.tgl_valid)}</div>
                <div class="media-title font-weight-bold">${loading.type}</div>
                <span class="text-small">
                  <em>${loading.material.id} - ${loading.material.nama}</em> <br />
                  ${loading.total_qty_awal} --> ${loading.total_qty_akhir} (<span class="text-${icon.color}"> ${loading.qty_loading}  <i class="${icon.number}"></i> </span>)
                </span>
              </div>
            </li>
          `)
          }
        } else {
          console.log(data.return)
        }
      },
      error: function(data) {
        console.log(data);
      }
    });
  });
</script>