<template>
  <div class="form-container" v-if="chart.length !== 0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Open</th>
          <th scope="col">High</th>
          <th scope="col">Low</th>
          <th scope="col">Close</th>
          <th scope="col">Volume</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in chart">
          <th scope="row">{{ item.date }}</th>
          <th scope="row">{{ item.open }}</th>
          <th scope="row">{{ item.high }}</th>
          <th scope="row">{{ item.low }}</th>
          <th scope="row">{{ item.close }}</th>
          <th scope="row">{{ item.volume }}</th>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import {Price} from "@/model";

export default defineComponent({
  name: 'CalculateTable',
  props: {
    chart: [] as Price[]
  }
});
</script>