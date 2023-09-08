// Import Vue library
import Vue from 'vue';

// Import the Vue Router configuration from './routes'
import router from './routes';

// Import the root Vue component from './src/App'
import App from './src/App';

// Import the 'trans' mixin
import trans from './mixins/trans';

// Import the Vuex store instance
import store from './store';

// Mix in the 'trans' mixin globally for language translation
Vue.mixin(trans);

// Assign the global variable 'Window.nrd' to the Vue instance
Window.nrd = Vue;

// Create a new Vue instance
new Vue({
  // Mount the Vue app to the HTML element with the id 'basic_plugin'
  el: '#basic_plugin',

  // Render the root Vue component
  render: h => h(App),

  // Use the Vue Router configuration
  router,

  // Use the Vuex store instance
  store
});
