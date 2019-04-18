
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import 'vuetify/dist/vuetify.min.css' ;
window.Vue = require('vue');

import Vuetify from 'vuetify';

Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('map-22', require('./components/map-22.vue').default);

Vue.component('area-map', require('./components/AreaMap.vue').default);
Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('navigation-map', require('./components/NavigationMap.vue').default);
Vue.component('main-map', require('./components/MainMap.vue').default);
Vue.component('admin-dashboard', require('./components/admin/AdminDashboard.vue').default);
Vue.component('admin-area', require('./components/admin/AdminArea.vue').default);
Vue.component('create-building-dialog', require('./components/admin/CreateBuildingForm.vue').default);
Vue.component('create-level-dialog', require('./components/admin/CreateLevelForm.vue').default);
Vue.component('create-area-dialog', require('./components/admin/CreateAreaForm.vue').default);
Vue.component('admin-login', require('./components/admin/AdminLogin.vue').default);
Vue.component('building-list', require('./components/BuildingList.vue').default);
Vue.component('level-list', require('./components/LevelList.vue').default);



Vue.component('map-24', require('./components/maps/map-24.vue').default);

Vue.component('map-25', require('./components/maps/map-25.vue').default);

Vue.component('map-26', require('./components/maps/map-26.vue').default);

Vue.component('map-2', require('./components/maps/map-2.vue').default);

Vue.component('map-3', require('./components/maps/map-3.vue').default);

Vue.component('map-4', require('./components/maps/map-4.vue').default);

Vue.component('map-5', require('./components/maps/map-5.vue').default);

Vue.component('map-6', require('./components/maps/map-6.vue').default);

Vue.component('map-7', require('./components/maps/map-7.vue').default);

Vue.component('map-8', require('./components/maps/map-8.vue').default);

Vue.component('map-9', require('./components/maps/map-9.vue').default);

Vue.component('map-10', require('./components/maps/map-10.vue').default);

Vue.component('map-11', require('./components/maps/map-11.vue').default);

Vue.component('map-12', require('./components/maps/map-12.vue').default);
//--------------------

const app = new Vue({
    el: '#app'
});