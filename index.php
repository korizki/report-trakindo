<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trakindo Dashboard</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" href="https://www.trakindo.co.id/sites/default/files/inline-images/Cat%20App.png">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div id="app">
        <!-- navigasi -->
        <nav class="navigation">
            <img src="https://www.trakindo.co.id/themes/custom/trakindo_2016/images/logo.png" alt="icontrakindo" height=35>
            <div>
                <h5>Welcome back, User </h5>
                <i class="uil uil-user-circle adj aleft" style="font-size: 2rem"></i>
            </div>
        </nav>
        <div class="maincontent">
            <div class="head">
                <h1><i class="uil uil-chart adj"></i> Production Dashboard </h1>
                <div class="filterbox">
                    <h3>Filter Report Data</h3>
                </div>
            </div>
            <h2 class="head"><i class="uil uil-building"></i>{{activePage.company}} - Summary</h2>
            <div class="boxtable">
              <table v-if="activePage">
                <thead>
                  <tr>
                    <th>Objective</th>
                    <th v-for="month in periode" :key="month">{{month}}-{{yearSelect}}</th>
                    <th>YTD 22</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="heads">
                    <td colspan="14"><h3>Production</h3></td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-wheel-barrow"></i> Overbudden</td>
                    <td v-for="(item, index) in activePage.prodOb" :key="index">{{item}}</td>
                    <td>{{activePage.ytdOb}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-gold"></i> Coal</td>
                    <td v-for="(item, index) in activePage.prodCoal" :key="index">{{item}}</td>
                    <td>{{activePage.ytdCoal}}</td>
                  </tr>
                  <tr class="heads">
                    <td colspan="14"><h3>Availability Unit (in Percent %)</h3></td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-tachometer-fast"></i> HMS</td>
                    <td v-for="(item, index) in activePage.av_hms" :key="index">{{item}}</td>
                    <td>{{activePage.ytdhms}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-tachometer-fast-alt"></i> OHT</td>
                    <td v-for="(item, index) in activePage.av_oht" :key="index">{{item}}</td>
                    <td>{{activePage.ytdoht}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-wrench"></i> Support Dozer</td>
                    <td v-for="(item, index) in activePage.av_dozer" :key="index">{{item}}</td>
                    <td>{{activePage.ytddozer}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-wrench"></i> Support Grader</td>
                    <td v-for="(item, index) in activePage.av_grader" :key="index">{{item}}</td>
                    <td>{{activePage.ytdgrader}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-wrench"></i> Support Hexa</td>
                    <td v-for="(item, index) in activePage.av_hexa" :key="index">{{item}}</td>
                    <td>{{activePage.ytdhexa}}</td>
                  </tr>
                  <tr class="heads">
                    <td colspan="14"><h3>Support Waranty (in Percent %)</h3></td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-question-circle"></i> Waiting Decision</td>
                    <td v-for="(item, index) in activePage.sup_dec" :key="index">{{item}}</td>
                    <td>{{activePage.ytddec}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-exclamation-circle"></i> Waiting Action</td>
                    <td v-for="(item, index) in activePage.sup_act" :key="index">{{item}}</td>
                    <td>{{activePage.ytdact}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-check-circle"></i> Complete</td>
                    <td v-for="(item, index) in activePage.sup_comp" :key="index">{{item}}</td>
                    <td>{{activePage.ytdcomp}}</td>
                  </tr>
                  <tr class="heads">
                    <td colspan="14"><h3>Readiness (in Percent %)</h3></td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-cell"></i> Parts</td>
                    <td v-for="(item, index) in activePage.part" :key="index">{{item}}</td>
                    <td>{{activePage.ytdpart}}</td>
                  </tr>
                  <tr>
                    <td><i class="uil uil-atom"></i> Component</td>
                    <td v-for="(item, index) in activePage.comp" :key="index">{{item}}</td>
                    <td>{{activePage.ytdcompt}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <h2 class="head sect"><i class="uil uil-chart-line"></i> Data in Graph</h2>
            <div class="navs">
              <a @click="showProd" :class="{active: activePageIndex == 1}"><i class="uil uil-award"></i> Production</a>
              <a @click="showAv" :class="{active: activePageIndex == 2}"><i class="uil uil-percentage"></i> Availability Unit</a>
              <a @click="showSup" :class="{active: activePageIndex == 3}"><i class="uil uil-shield-exclamation"></i> Support Waranty</a>
              <a @click="showReady" :class="{active: activePageIndex == 4}"><i class="uil uil-file-shield-alt"></i> Readiness</a>
            </div>
            <div v-if="activePageIndex == 1" class="boxtable chart">
              <canvas id="myChart" width="600" height="200"></canvas>
            </div>
            <div v-if="activePageIndex == 2" class="boxtable chart">
              <canvas id="myChart2" width="600" height="200"></canvas>
            </div>
            <div v-if="activePageIndex == 3" class="boxtable chart">
              <canvas id="myChart3" width="600" height="200"></canvas>
            </div>
            <div v-if="activePageIndex == 4" class="boxtable chart">
              <canvas id="myChart4" width="600" height="200"></canvas>
            </div>
            <div v-if="showWaiting"  class="waiting">
              <h2>Processing your request, please wait...</h2>
            </div>
        </div>
    </div>
</body>
<!-- cdn vue js -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const { createApp } = Vue
  
    createApp({
      data() {
        return {
          message: 'Hello Vue!',
          listData: [],
          activePage: '',
          periode: '',
          yearSelect: '2022',
          activePageIndex: 1,
          showWaiting: false,
        }
      },
      methods: {
        showReady(){
          this.activePageIndex = 4
          this.showWaiting = true
          // chartjs production
          setTimeout(() => {
            const ctx4 = document.getElementById('myChart4').getContext('2d');
            const myChart4 = new Chart(ctx4, {
              type: 'line',
              data: {
                  labels: this.periode,
                  datasets: [
                    {
                      label: 'Readiness Part',
                      data: this.activePage.part,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'Readiness Component',
                      data: this.activePage.comp,
                      backgroundColor: [
                          'rgba(30, 144, 255, 0.2)',
                      ],
                      borderColor: [
                          'rgba(30, 144, 255, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                ]
              },
              options: {
                  responsive: true,
                  scales: {
                      y: {
                          beginAtZero: false
                      }
                  }
              }
            });
            this.showWaiting = false
          },1000)
        },
        showSup(){
          this.activePageIndex = 3;
          this.showWaiting = true
          // chartjs production
          setTimeout(() => {
            const ctx3 = document.getElementById('myChart3').getContext('2d');
            const myChart3 = new Chart(ctx3, {
              type: 'line',
              data: {
                  labels: this.periode,
                  datasets: [
                    {
                      label: 'Waiting Decision',
                      data: this.activePage.sup_dec,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'Waiting Action',
                      data: this.activePage.sup_act,
                      backgroundColor: [
                          'rgba(30, 144, 255, 0.2)',
                      ],
                      borderColor: [
                          'rgba(30, 144, 255, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'Completed',
                      data: this.activePage.sup_comp,
                      backgroundColor: [
                          'rgba(77, 77, 77, 0.2)',
                      ],
                      borderColor: [
                          'rgba(77, 77, 77, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                ]
              },
              options: {
                  responsive: true,
                  scales: {
                      y: {
                          beginAtZero: false
                      }
                  }
              }
            });
            this.showWaiting = false
          },1000)
        },
        showAv(){
          this.activePageIndex = 2;
          this.showWaiting = true
          // chartjs production
          setTimeout(() => {
            const ctx2 = document.getElementById('myChart2').getContext('2d');
            const myChart2 = new Chart(ctx2, {
              type: 'line',
              data: {
                  labels: this.periode,
                  datasets: [
                    {
                      label: 'HMS',
                      data: this.activePage.av_hms,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'OHT',
                      data: this.activePage.av_oht,
                      backgroundColor: [
                          'rgba(30, 144, 255, 0.2)',
                      ],
                      borderColor: [
                          'rgba(30, 144, 255, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'Support Grader',
                      data: this.activePage.av_grader,
                      backgroundColor: [
                          'rgba(77, 77, 77, 0.2)',
                      ],
                      borderColor: [
                          'rgba(77, 77, 77, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'Support Dozer',
                      data: this.activePage.av_dozer,
                      backgroundColor: [
                          'rgba(255, 165, 0, 0.2)',
                      ],
                      borderColor: [
                          'rgba(255, 165, 0, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'Support Hexa',
                      data: this.activePage.av_hexa,
                      backgroundColor: [
                          'rgba(129, 1, 129, 0.2)',
                      ],
                      borderColor: [
                          'rgba(129, 1, 129, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                ]
              },
              options: {
                  responsive: true,
                  scales: {
                      y: {
                          beginAtZero: false
                      }
                  }
              }
            });
            this.showWaiting = false
          },1000)
        },
        showProd(){
          this.activePageIndex = 1;
          this.showWaiting = true
          // chartjs production
          setTimeout(() => {
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: this.periode,
                  datasets: [
                    {
                      label: 'Production OB',
                      data: this.activePage.prodOb,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                  {
                      label: 'Production Coal',
                      data: this.activePage.prodCoal,
                      backgroundColor: [
                          'rgba(30, 144, 255, 0.2)',
                      ],
                      borderColor: [
                          'rgba(30, 144, 255, 1)',
                      ],
                      pointStyle: 'circle',
                      pointRadius: 5,
                      pointHoverRadius: 15,
                      borderWidth: 3
                  },
                ]
              },
              options: {
                  responsive: true,
                  scales: {
                      y: {
                          beginAtZero: false
                      }
                  }
              }
            });
            this.showWaiting = false
          },1000)
        },
        loadData(data){
          this.listData = data
          let prodOb = []
          let prodCoal = []
          let av_hms = []
          let av_oht = []
          let av_dozer = []
          let av_grader = []
          let av_hexa = []
          let sup_dec = []
          let sup_act = []
          let sup_comp = []
          let part = []
          let comp = []
          this.listData.sort((a,b) => a.month - b.month).forEach(item => {
            prodOb.push(item.prod_ob) 
            prodCoal.push(item.prod_coal) 
            av_hms.push(item.av_hms) 
            av_oht.push(item.av_oht) 
            av_dozer.push(item.av_dozer) 
            av_grader.push(item.av_grader) 
            av_hexa.push(item.av_hexa) 
            sup_dec.push(item.sup_decision) 
            sup_act.push(item.sup_action) 
            sup_comp.push(item.sup_complete) 
            part.push(item.ready_parts) 
            comp.push(item.ready_component) 
          })
          this.activePage = {
            company : this.listData[0].company,
            prodOb,
            ytdOb : (prodOb.reduce((a,b) => a + b ,0)/prodOb.length).toLocaleString('id-ID', ),
            prodCoal,
            ytdCoal : (prodCoal.reduce((a,b) => a + b ,0)/prodCoal.length).toLocaleString(),
            av_hms,
            ytdhms: (av_hms.reduce((a,b) => a + b ,0)/av_hms.length).toLocaleString(),
            av_oht,
            ytdoht: (av_oht.reduce((a,b) => a + b ,0)/av_oht.length).toLocaleString(),
            av_dozer,
            ytddozer: (av_dozer.reduce((a,b) => a + b ,0)/av_dozer.length).toLocaleString(),
            av_grader,
            ytdgrader: (av_grader.reduce((a,b) => a + b ,0)/av_grader.length).toLocaleString(),
            av_hexa,
            ytdhexa: (av_hexa.reduce((a,b) => a + b ,0)/av_hexa.length).toLocaleString(),
            sup_dec,
            ytddec: (sup_dec.reduce((a,b) => a + b ,0)/sup_dec.length).toLocaleString(),
            sup_act,
            ytdact: (sup_act.reduce((a,b) => a + b ,0)/sup_act.length).toLocaleString(),
            sup_comp,
            ytdcomp: (sup_comp.reduce((a,b) => a + b ,0)/sup_comp.length).toLocaleString(),
            part,
            ytdpart: (part.reduce((a,b) => a + b ,0)/part.length).toLocaleString(),
            comp,
            ytdcompt: (comp.reduce((a,b) => a + b ,0)/comp.length).toLocaleString(),
          }
          let listmonth = ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
          this.periode = listmonth.slice(0,prodOb.length)
          // chartjs production
          const ctx = document.getElementById('myChart').getContext('2d');
          const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: this.periode,
                datasets: [
                  {
                    label: 'Production OB',
                    data: this.activePage.prodOb,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointHoverRadius: 15,
                    borderWidth: 3
                },
                {
                    label: 'Production Coal',
                    data: this.activePage.prodCoal,
                    backgroundColor: [
                        'rgba(30, 144, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(30, 144, 255, 1)',
                    ],
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointHoverRadius: 15,
                    borderWidth: 3
                },
              ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
          });
        }
      },
      mounted(){
        axios.get('https://ap-southeast-1.aws.data.mongodb-api.com/app/trakindo_dashboard-gjgry/endpoint/getalldata')
        .then(res => this.loadData(res.data))
      }
    }).mount('#app')
  </script>
</html>