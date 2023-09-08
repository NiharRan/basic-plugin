<template>
  <div class="basic-plugin-app">
    <div class="basic-plugin-body">
      <router-view key="main_route"></router-view>
    </div>
  </div>
</template>

<script type="text/babel">

export default {
  name: 'App',
  data() {
    return {
    }
  },
  mounted() {
    jQuery('.update-nag,.notice, #wpbody-content > .updated, #wpbody-content > .error').not('.fc_notice').remove();

    jQuery('.basic-plugin-menu li[data-key="' + this.$route.name + '"]').addClass('active');

    this.$store.dispatch('fetchGlobalSettings');
    this.$store.dispatch('fetchRecords');
  }
};
</script>
