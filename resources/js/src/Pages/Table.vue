<template>
  <section v-if="table" class="basic-plugin-page_wrapper">
    <div class="basic-plugin-page_header">
      <h4 class="basic-plugin-page_title">{{ $t( table.title ) }}</h4>
      <p>{{ $t('api_data_table') }}</p>
    </div>

    <hr>

    <div>
      <table class="basic-plugin-table" v-if="table.data">
        <thead>
        <tr>
          <th v-for="(col, key) in table.data.headers" :key="key">{{ $t( col ) }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(row, key) in table.data.rows" :key="key">
          <th>{{ row.id }}</th>
          <td>{{ row.url }}</td>
          <th>{{ row.title }}</th>
          <td>{{ row.pageviews }}</td>
          <td>{{ row.date }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  name: 'TablePage',
  computed: {
    ...mapGetters({
      table: 'getTable'
    })
  }
}
</script>

<style>

</style>
