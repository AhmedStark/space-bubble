
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
