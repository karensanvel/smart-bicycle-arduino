<template>
  <div class="chart">
    <LineChart
      v-if="!loading"
      :chartData="chartdata"
      :options="options"
    ></LineChart>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import moment from 'moment';
import LineChart from './components/LineChart';

export default {
  components: {
    LineChart,
  },
  data() {
    return {
      labels: [],
      data: [],
      loading: false,
      chartdata: {
        labels: [],
        datasets: [
          {
            label: 'Kilometres traveled',
            backgroundColor: '#f87979',
            data: [],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
          mode: 'label',
          callbacks: {
            label(tooltipItems) {
              return tooltipItems.yLabel.toFixed(1) + ' km';
            },
          },
        },
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                callback(value) {
                  return value + ' km';
                },
              },
            },
          ],
        },
      },
    };
  },
  watch: {
    currentRoute: function(newRoute) {
      this.handleData();
    },
  },
  computed: {
    ...mapGetters({
      currentRoute: 'route/currentRoute',
    }),
  },
  methods: {
    handleData() {
      this.loading = true;
      this.chartdata.labels = [];
      this.chartdata.datasets[0].data = [];
      if (this.currentRoute.coordenadas) {
        let kilometres = 0;
        this.currentRoute.coordenadas.forEach((item, index) => {
          this.labels.push(moment(item.created_at).format('LTS'));

          if (index === 0) {
            this.data.push(index);
          } else {
            let lat1 = this.currentRoute.coordenadas[index - 1].latitud;
            let lon1 = this.currentRoute.coordenadas[index - 1].longitud;
            let lat2 = this.currentRoute.coordenadas[index].latitud;
            let lon2 = this.currentRoute.coordenadas[index].longitud;
            kilometres += parseFloat(this.calcCrow(lat1, lon1, lat2, lon2));
            this.data.push(kilometres);
          }
        });

        this.chartdata.labels = this.labels;
        this.chartdata.datasets[0].data = this.data;
      }
      setTimeout(() => {
        this.loading = false;
        this.labels = [];
        this.data = [];
      }, 500);
    },
    //This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
    calcCrow(lat1, lon1, lat2, lon2) {
      var R = 6371; // km
      var dLat = this.toRad(lat2-lat1);
      var dLon = this.toRad(lon2-lon1);
      var lat1 = this.toRad(lat1);
      var lat2 = this.toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      return d;
    },
    // Converts numeric degrees to radians
    toRad(Value) {
      return Value * Math.PI / 180;
    },
  },
};
</script>
<style lang="sass" scoped>
.chart
  position: relative
</style>
