/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import store from './store';

require("./bootstrap");
import "leaflet/dist/leaflet.css";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.js";

window.Vue = require("vue");


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.use(HighchartsVue)

Vue.component(
    "last-route-component",
    require("./components/LastRoute.vue").default
);

Vue.component(
    "last-route-travel-time-component",
    require("./components/LastRouteTravelTime.vue").default
);

Vue.component(
    "last-route-distance-traveled-component",
    require("./components/LastRouteDistanceTraveled.vue").default
);

Vue.component(
    "last-route-speed-component",
    require("./components/LastRouteSpeed.vue").default
);

Vue.component(
    "route-list-component",
    require("./components/RouteList.vue").default
);

Vue.component(
    "current-route-component",
    require("./components/CurrentRoute.vue").default
);

Vue.component(
    "current-route-chart-component",
    require("./components/CurrentRouteChart/index.vue").default
);

Vue.component(
    "current-route-lat-lng-component",
    require("./components/CurrentRouteLatlng.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    store
});
