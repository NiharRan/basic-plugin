<template>
  <section class="basic-plugin-page_wrapper">
    <alert-success />
    <alert-error />
    <div class="basic-plugin-page_header">
      <h4 class="basic-plugin-page_title">{{ $t( 'Settings' ) }}</h4>
      <p>{{ $t('table_data_setting') }}</p>
    </div>

    <hr>


    <div class="basic-plugin-settings">
      <div class="basic-plugin-settings-col">
        <label>{{ $t('Records per page') }}</label>
        <div>
          <input
            :value="settings.per_page"
            @input="e => handleDataChange('per_page', e.target.value)"
            type="number"
            min="1"
            max="5"
            :placeholder="$t( 'Records per page' )">
          <span class="nrd-error" v-if="error.per_page">{{ error.per_page }}</span>
          <span>{{ $t('per_page_note_1') }}</span>
          <span>{{ $t('per_page_note_2') }}</span>
        </div>
      </div>

      <div class="basic-plugin-settings-col">
        <label>{{ $t('Date format') }}</label>
        <div>
          <div class="basic-plugin-settings-radio_block">
            <label>
              <input
                type="radio"
                :value="'human-format'"
                :checked="settings.date_human_readable === 'human-format'"
                @input="e => handleDataChange( 'date_human_readable', e.target.value )">
              <span>{{ $t('Human readable format') }}</span>
            </label>
            <label>
              <input
                type="radio"
                :value="'unix-format'"
                :checked="settings.date_human_readable === 'unix-format'"
                @input="e => handleDataChange( 'date_human_readable', e.target.value )">
              <span>{{ $t('Unix timestamp') }}</span>
            </label>
          </div>
          <span class="nrd-error" v-if="error.date_human_readable">{{ error.date_human_readable }}</span>
          <span>{{ $t('date_format_note_1') }}</span>
          <span>{{ $t('date_format_note_2') }}</span>
        </div>
      </div>

      <div class="basic-plugin-settings-col">
        <label>{{ $t('Add new email') }}</label>
        <div>
          <div class="basic-plugin-settings-email-item">
            <input type="email" id="email" name="email" :value="email" @input="e => handleEmailUpdate(e.target.value)" />
            <button type="button" class="basic-plugin-btn-success" @click="handleEmailAdd">{{ $t( 'Add' ) }}</button>
          </div>
          <span class="nrd-error" v-if="error.email">{{ error.email }}</span>
          <span>{{ $t('add_new_email_note_1') }}</span>
          <span>{{ $t('add_new_email_note_2') }}</span>
          <div style="margin-top: 14px" v-if="settings.emails && settings.emails.length > 0">
            <div class="basic-plugin-settings-email-item" v-for="(email, key) in settings.emails" :key="key">
              <p>{{ email }}</p>
              <button type="button" class="basic-plugin-btn-danger" @click="handleEmailRemove(key)">{{ $t( 'Remove' ) }}</button>
            </div>
          </div>
        </div>
      </div>

      <div class="basic-plugin-settings-col">
        <button type="button" class="basic-plugin-btn-success" @click="handleSave">{{ $t('Save Settings') }}</button>
      </div>

    </div>
  </section>
</template>

<script>
import { mapGetters } from 'vuex';
import AlertSuccess from '@/Components/AlertSuccess';
import AlertError from '@/Components/AlertError';

export default {
  name: 'SettingsPage',
  components: {AlertError, AlertSuccess},
  computed: {
    ...mapGetters({
      email: 'getEmail',
      settings: 'getSettings',
      error: 'getError',
    }),
  },
  methods: {
    handleDataChange: function ( key, value) {
      this.$store.dispatch('settingDataChanged', {
        key,
        value
      })
    },
    handleEmailAdd: function () {
      this.$store.dispatch('addEmail');
    },
    handleEmailRemove: function (key) {
      this.$store.dispatch('removeEmail', key);
    },
    handleEmailUpdate: function (value) {
      this.$store.dispatch('updateEmail', value);
    },
    handleSave: function () {
      this.$store.dispatch('updateGlobalSettings');
    }
  }
}
</script>

<style>

</style>
