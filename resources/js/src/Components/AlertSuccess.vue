<template>
  <p class="basic-plugin-alert basic-plugin-alert-success" :class="success.length > 0 ? '' : 'hidden'">
    {{ success }}
  </p>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "AlertSuccess",
  computed: {
    ...mapGetters({
      success: "getSuccess"
    })
  },
}
</script>

<style>

</style>
