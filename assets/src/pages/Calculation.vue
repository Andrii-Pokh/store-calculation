<template>
  <div class="container">
    <Form @submitted="onSubmitted"/>
    <Table :chart="this.chart"/>
    <FinChart :charts="this.chart" />
  </div>
</template>

<script lang="ts">
import 'vue-multiselect/dist/vue-multiselect.css';
import '@vuepic/vue-datepicker/dist/main.css';
import {defineComponent, ref} from 'vue';
import {Price} from '@/model';
import Form from "../components/CalculateForm.vue";
import Table from "../components/CalculateTable.vue";
import FinChart from "../components/OHLCChart.vue";

const date = ref();

export default defineComponent({
  name: 'Calculation',
  components: { Form, Table, FinChart },
  props: {},
  methods: {
    onSubmitted(value: Price[]) {
      this.chart = value;
    }
  },
  data: () => {
    return {
      chart: [] as Price[]
    }
  }
});
</script>