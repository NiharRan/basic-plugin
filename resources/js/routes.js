import Vue from "vue";
import VueRouter from "vue-router";

// Import components for each route
import Table from "@/Pages/Table";
import Graph from "@/Pages/Graph";
import Settings from "@/Pages/Settings";

// Define the routes for the VueRouter
const routes = [
  {
    name: 'table',
    path: '/',
    component: Table, // Component to render for this route
    props: true, // Pass route params as props to the component
    meta: {
      active_menu: 'table', // Metadata for active menu highlight
      side_path: '/' // Metadata for side path
    },
  },
  {
    name: 'graph',
    path: '/graph',
    component: Graph,
    props: true,
    meta: {
      active_menu: 'graph',
      side_path: '/'
    },
  },
  {
    name: 'settings',
    path: '/settings',
    component: Settings,
    props: true,
    meta: {
      active_menu: 'settings',
      side_path: '/'
    },
  },
];

// Create a new VueRouter instance with the defined routes
const vueRouter = new VueRouter({
  routes
});

// Use VueRouter as a Vue plugin
Vue.use(VueRouter);

// Export the VueRouter instance for use in other parts of the application
export default vueRouter;
