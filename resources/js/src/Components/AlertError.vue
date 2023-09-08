<template>
  <p v-if="typeof error === 'string'" class="basic-plugin-alert basic-plugin-alert-danger" :class="error.length > 0 ? '' : 'hidden'">
    {{ error }}
  </p>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "AlertError",
  computed: {
    ...mapGetters({
      error: "getError",
    })
  },
}
</script>

<style>

</style>
