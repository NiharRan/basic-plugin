<template>
  <section v-if="graph" class="basic-plugin-page_wrapper">
    <div class="basic-plugin-page_header">
      <h4 class="basic-plugin-page_title">{{ $t( 'Chart' ) }}</h4>
      <p>{{ $t('api_data_graph') }}</p>
    </div>

    <hr>

    <div style="height: 500px; margin-top: 1rem;">
      <bar-chart />
    </div>
  </section>
</template>

<script>
import { mapGetters } from 'vuex';
import BarChart from '@/Components/BarChart';

export default {
  name: 'ChartPage',
  components: {BarChart},
  computed: {
    ...mapGetters({
      graph: 'getGraph'
    })
  }
}
</script>

<style>

</style>
