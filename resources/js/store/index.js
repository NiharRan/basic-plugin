import Vue from 'vue';
import Vuex from 'vuex';
import rest from '../utils/rest';


Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    table: {},
    graph: {},
    settings: {},
    email: '',
    success: '',
    error: ''|Object
  },
  getters: {
    getSettings: state => state.settings,
    getTable: state => state.table,
    getGraph: state => state.graph,
    getEmail: state => state.email,
    getSuccess: state => state.success,
    getError: state => state.error,
    formatGraphData: state => {
      const labels = [];
      const ItemValues = {
        label: 'Generated Using API Graph Data',
        yAxisID: 'byDate',
        backgroundColor: 'rgba(81, 52, 178, 0.5)',
        data: [],
      };


      Object.keys(state.graph).forEach(key => {
        ItemValues.data.push(state.graph[key].value);
        labels.push(state.graph[key].date);
      });

      return  {
        labels: labels,
        datasets: [ItemValues]
      }
    }
  },
  actions: {
    fetchGlobalSettings: async ( { commit } ) => {
      const response = await rest.get('global-settings');
      commit( 'STORE_GLOBAL_SETTINGS', response );
    },
    fetchRecords: async ( { commit} ) => {
      const response = await rest.get('records');
      commit( 'STORE_TABLE_DATA', response.table );
      commit( 'STORE_GRAPH_DATA', response.graph );
    },
    removeEmail: async ( { commit, state }, key ) => {
      try {
        const response = await rest.delete('remove-email', {
          key
        });
        state.success = response.message;
        state.error = '';

        commit( 'STORE_GLOBAL_SETTINGS', response.data );
      } catch (e) {
        if (e.message) {
          state.error = e.message;
        } else {
          state.error = e;
        }
        state.success = '';
      }
    },
    updateEmail: ( { state }, payload ) => {
      state.email = payload;
    },
    addEmail: async ( { commit, state } ) => {
      try {
        const response = await rest.post('add-email', {
          email: state.email
        });
        state.success = response.message;

        state.error = '';
        state.email = '';
        commit( 'STORE_GLOBAL_SETTINGS', response.data );
      } catch (e) {
        if (e.message) {
          state.error = e.message;
        } else {
          state.error = e;
        }
        state.success = '';
      }
    },
    settingDataChanged: ( { commit }, payload ) => {
      commit( 'UPDATE_SETTINGS_DATA', payload )
    },
    updateGlobalSettings: async ( { state, dispatch } ) => {
      try{
        const response = await rest.put('global-settings', state.settings);
        state.email = '';
        state.success = response.message;
        state.error = '';

        await dispatch('fetchRecords');
      } catch (e) {
        if (e.message) {
          state.error = e.message;
        } else {
          state.error = e;
        }
        state.success = '';
      }
    },
  },
  mutations: {
    STORE_GLOBAL_SETTINGS: ( state, payload  ) => {
      state.settings = payload
    },
    STORE_TABLE_DATA: ( state, payload ) => {
      state.table = payload
    },
    STORE_GRAPH_DATA: ( state, payload ) => {
      state.graph = payload
    },
    REMOVE_EMAIL_FROM_SETTINGS: ( state, key ) => {
      let emails = state.settings.emails;
      if ( emails.length > 0 ) {
        emails.splice(key, 1);
        state.settings.emails = emails;
      }
    },
    ADD_EMAIL_TO_SETTINGS: ( state, payload ) => {
      let emails = state.settings.emails;
      if ( emails.length > 0 ) {
        emails.push( payload );

        state.settings.emails = emails;
      }
    },
    UPDATE_SETTINGS_DATA: ( state, payload ) => {
      if ( state.settings[payload.key] ) {
        console.log(payload)
        state.settings[payload.key] = payload.value;
      }
    }
  }
});
