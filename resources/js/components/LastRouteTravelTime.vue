<template>
  <!-- <div id="time" style="height: 200px !important;"></div> -->
  <div style="height: 150px !important; background-color: #6976FF;" class="d-flex justify-content-center align-items-center flex-column text-white">
    <span class="material-icons" style=" font-size: 50px;">
      access_time
    </span>
    <small>
      Travel time
    </small>
    <template v-if="lastRoute">
      <h3>
        {{ lastRoute.time }}
      </h3>
    </template>
    <template v-else>
      <h3>
        00:00:00
      </h3>
    </template>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'LastRouteTravelTime',
  data() {
    return {
      // gaugeOptions: {
      //   chart: {
      //     type: 'solidgauge'
      //   },

      //   title: null,

      //   pane: {
      //     center: ['50%', '85%'],
      //     size: '120%',
      //     startAngle: -90,
      //     endAngle: 90,
      //     background: {
      //       backgroundColor:
      //         Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
      //       innerRadius: '60%',
      //       outerRadius: '100%',
      //       shape: 'arc'
      //     }
      //   },

      //   exporting: {
      //     enabled: false
      //   },

      //   tooltip: {
      //     enabled: false
      //   },

      //   // the value axis
      //   yAxis: {
      //     stops: [
      //       [0.1, '#55BF3B'], // green
      //       [0.5, '#DDDF0D'], // yellow
      //       [0.9, '#DF5353'] // red
      //     ],
      //     lineWidth: 0,
      //     tickWidth: 0,
      //     minorTickInterval: null,
      //     tickAmount: 2,
      //     title: {
      //       y: -70
      //     },
      //     labels: {
      //       y: 16
      //     }
      //   },

      //   plotOptions: {
      //     solidgauge: {
      //       dataLabels: {
      //         y: 5,
      //         borderWidth: 0,
      //         useHTML: true
      //       }
      //     }
      //   }
      // },
      // chartSpeed: null,
    };
  },
  mounted() {
    // this.chartSpeed = Highcharts.chart('time', Highcharts.merge(this.gaugeOptions, {
    //   yAxis: {
    //     min: 0,
    //     max: 200,
    //     title: {
    //       text: 'Travel time'
    //     }
    //   },

    //   credits: {
    //     enabled: false
    //   },

    //   series: [{
    //     name: 'Time',
    //     data: [80],
    //     dataLabels: {
    //       format:
    //         '<div style="text-align:center">' +
    //         '<span style="font-size:25px">{y}</span><br/>' +
    //         '<span style="font-size:12px;opacity:0.4">Hrs.</span>' +
    //         '</div>'
    //     },
    //     tooltip: {
    //       valueSuffix: ' time'
    //     }
    //   }]

    // }));
  },
  watch: {
    // lastRoute: function() {
    //   // Bring life to the dials
    //   // setInterval(function () {
    //   // Speed
    //   var point,
    //     newVal,
    //     inc;

    //   if (this.chartSpeed) {
    //     point = this.chartSpeed.series[0].points[0];
    //     // inc = Math.round((Math.random() - 0.5) * 100);
        
    //     var hms = this.lastRoute.time;   // your input string
    //     var a = hms.split(':'); // split it at the colons

    //     // minutes are worth 60 seconds. Hours are worth 60 minutes.
    //     var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 

    //     console.log('seconds', seconds);
    //     console.log('minutes', Math.round(seconds / 60));

    //     inc = Math.round(seconds / 60);

    //     newVal = point.y + inc;

    //     if (newVal < 0 || newVal > 200) {
    //       newVal = point.y - inc;
    //     }

    //     point.update(newVal);
    //   }
    //   // }, 2000);
    // }
  },
  computed: {
    ...mapGetters({
      lastRoute: 'route/lastRoute', 
    }),
  },
}
</script>

<style>
/* .highcharts-figure .chart-container {
	width: 300px;
	height: 200px;
	float: left;
}

.highcharts-figure, .highcharts-data-table table {
	width: 600px;
	margin: 0 auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}

@media (max-width: 600px) {
	.highcharts-figure, .highcharts-data-table table {
		width: 100%;
	}
	.highcharts-figure .chart-container {
		width: 300px;
		float: none;
		margin: 0 auto;
	}

} */
</style>