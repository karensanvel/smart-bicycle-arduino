import { Line } from 'vue-chartjs';

export default {
  extends: Line,
  props: {
    chartData: {
      type: Object,
      required: true,
    },
    options: {
      type: Object,
      required: true,
    },
  },
  // watch: {
  //   chartdata: function() {
  //     this.renderChart(this.chartData, this.options);
  //   },
  // },
  mounted() {
    this.renderChart(this.chartData, this.options);
    this.$refs.canvas.parentNode.style.height = '300px';
    this.$refs.canvas.parentNode.style.width = '600px';
    console.log('canvas', this.$refs.canvas);
  },
};
