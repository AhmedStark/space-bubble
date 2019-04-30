
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


//--------------------

const app = new Vue({
    el: '#app'
});
