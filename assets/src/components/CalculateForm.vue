<template>
  <div class="form-container">
    <form @submit.prevent="handleSubmit" method="post">
      <div class="form-group">
        <label class="sr-only" for="ajax">choose companySymbol</label>
        <VueMultiselect
            v-model="form.companySymbol"
            :options="companySymbols"
            id="ajax"
            track-by="code"
            placeholder="Type to search"
            open-direction="bottom"
            :searchable="true"
            :loading="isLoading"
            :internal-search="false"
            :clear-on-select="false"
            :close-on-select="true"
            :options-limit="300"
            :limit="3"
            :max-height="600"
            :show-no-results="false"
            :hide-selected="true"
            @search-change="asyncFind"
        />
      </div>
      <div class="form-group">
        <label class="sr-only" for="range">choose date range</label>
        <VueDatePicker v-model="date" range :max-date="new Date()" id="range" :enable-time-picker="false" />
      </div>
      <div class="form-group">
        <label class="sr-only" for="email">Email</label>
        <input v-model="form.email" class="form-control" id="email"/>
      </div>
      <div>
        <button type="submit" class="btn btn-outline-success">Submit</button>
      </div>
    </form>
    <div :class="{ error: v$.form.email.$errors.length }">
      <div class="input-errors" v-for="error of v$.form.email.$errors" :key="error.$uid">
        <div class="error-msg">{{ error.$message }}</div>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import 'vue-multiselect/dist/vue-multiselect.css';
import '@vuepic/vue-datepicker/dist/main.css';
import {defineComponent} from "vue";
import VueMultiselect from "vue-multiselect";
import VueDatePicker from "@vuepic/vue-datepicker";
import {useVuelidate} from "@vuelidate/core";
import {CalculationForm, CompanySymbol, Price} from "@/model";
import {email, required} from "@vuelidate/validators";
import CalculationService from "../services/CalculationService";
import {NasdaqResponse, RapidResponse, MailResponse} from "@/response";

export default defineComponent({
  name: 'CalculateForm',
  components: { VueMultiselect, VueDatePicker },
  props: {},
  computed: {
    date: {
      get (): [Date|null, Date|null] {
        return [
          this.form.startDate,
          this.form.endDate
        ];
      },
      set (val: [Date, Date]) {
        this.form.startDate = val[0];
        this.form.endDate = val[1];
      }
    }
  },
  methods: {
    async handleSubmit () {
      const result = await this.v$.$validate()
      if (!result) {
        return;
      }

      const Calc = {
        startDate: this.form.startDate.toISOString().split('T')[0],
        endDate: this.form.endDate.toISOString().split('T')[0],
        companySymbol: {
          companyName: this.form.companySymbol!['Company Name'],
          financialStatus: this.form.companySymbol!['Financial Status'],
          marketCategory: this.form.companySymbol!['Market Category'],
          roundLotSize: this.form.companySymbol!['Round Lot Size'],
          securityName: this.form.companySymbol!['Security Name'],
          Symbol: this.form.companySymbol!['Symbol'],
          testIssue: this.form.companySymbol!['Test Issue']
        },
        email: this.form.email
      }
      CalculationService.postForm(JSON.stringify(Calc))
          .then((response: RapidResponse) => response.data)
          .then((data) => {
            const startAt = this.form.startDate.valueOf() / 1000;
            const endAt = this.form.endDate.valueOf() / 1000;
            this.chart = data.prices.filter((price) => price.date >= startAt && price.date <= endAt);

            CalculationService.sendEmail(JSON.stringify(Calc))
                .then((response: MailResponse) => response.data)
            this.$emit('submitted', this.chart);
          })
          .catch(() => {
          });
    },

    async getData (url: string): Promise<CompanySymbol[]> {
      const localData = localStorage.getItem(url);
      if (localData) {
        return JSON.parse(localData);
      }

      const res: NasdaqResponse = await CalculationService.getNasdaq();
      localStorage.setItem(url, JSON.stringify(res.data));

      return JSON.parse(localData!);
    },

    asyncFind: function (query: string) {
      this.isLoading = true
      this.getData('nasdaq').then((response: CompanySymbol[]) => {
        this.companySymbols = response.filter(companySymbol => companySymbol['Company Name'].includes(query));
        this.isLoading = false
      })
    },
  },
  setup () {
    return { v$: useVuelidate() }
  },
  data: () => {
    return {
      form: {
        startDate: (() => {let now = new Date(); now.setDate(now.getDate() - 7); return now;})(),
        endDate: new Date(),
        companySymbol: null,
        email: null,
      } as CalculationForm,
      companySymbols: [] as CompanySymbol[],
      isLoading: false,
      chart: [] as Price[]
    }
  },
  validations() {
    return {
      form: {
        startDate: required,
        endDate: required,
        companySymbol: {required},
        email: {required, email},
      }
    }
  }
});

</script>