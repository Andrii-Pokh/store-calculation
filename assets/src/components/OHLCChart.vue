<template>
  <div v-if="charts.length !== 0">
    <CanvasJSChart :options="commitChartOptions" :style="styleOptions" />
  </div>
</template>

<script lang="ts">
  import CanvasJSChart from './CanvasJSVueComponent.vue';
  import {Price} from "@/model";
  import {defineComponent} from "vue";
  export default defineComponent({
    name: 'OHLC',
    props: {
      charts: [] as Price[]
    },
    components: {
      CanvasJSChart
    },
    data:() => {
      return {
        chart: null,
        options: {
          animationEnabled: true,
          theme: "light2",
          exportEnabled: true,
          title: {
            text: "Litcoin Price"
          },
          axisX: {
            interval:1,
            intervalType: "day",
            valueFormatString: "d"
          },
          axisY: {
            prefix: "$",
            title: "Price in USD"
          },
          data: [{
            type: "ohlc",
            yValueFormatString: "$###0.00", 
            xValueFormatString: "MMM YYYY",
            dataPoints: [
              { x: new Date(2020, 2, 1),y: [41.326534, 69.738029, 39.450844, 67.879494] },
              { x: new Date(2020, 2, 2),y: [67.908516, 83.689163, 57.804031, 58.543262] },
              { x: new Date(2020, 2, 3),y: [58.530544, 63.773266, 25.573105, 39.299103] },
              { x: new Date(2020, 2, 4),y: [39.284687, 50.921558, 37.445934, 46.71402] },
              { x: new Date(2020, 2, 5),y: [46.714264, 50.044678, 40.135761, 45.591885] },
              { x: new Date(2020, 2, 6),y: [45.57423, 49.761257, 40.754646, 41.467793] },
              { x: new Date(2020, 2, 7),y: [41.43354, 58.738693, 40.65646, 57.998138] },
              { x: new Date(2020, 2, 8),y: [57.998138, 68.519516, 52.322857, 61.113796] },
              { x: new Date(2020, 2, 9),y: [61.105076, 64.18396, 42.54327, 46.37146] },
              { x: new Date(2020, 2, 10),y: [46.426956, 60.302204, 44.201286, 55.59026] },
              { x: new Date(2020, 2, 11),y: [55.59026, 93.576019, 51.60656, 87.574631] },
              { x: new Date(2020, 2, 12),y: [87.576599, 138.319717, 70.231308, 124.690323] }
            ]
          }]
        } as {},
        styleOptions: {
          width: "100%",
          height: "360px"
        }
      }
    },
    computed: {
      commitChartOptions(): {} {
        let localOptions = Object.assign({}, this.options);
        localOptions.data[0].dataPoints = [];
        localOptions.title.text = '';

        this.charts.forEach((item: Price) => {
          localOptions.data[0].dataPoints.push({
            x: new Date(item.date * 1000),
            y: [ item.open, item.high, item.low, item.close]
          })
        });

        return localOptions;
      }
    }
  });
</script>