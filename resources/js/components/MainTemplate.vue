<template>
    
<v-app :dark="darkMode">
<nav-bar v-on:changeMode="darkMode =!darkMode" :admin="admin"></nav-bar>
<slot name="content" :dark="darkMode"   >

</slot>
</v-app>
</template>
<script>
var VueCookie = require('vue-cookie');
export default {
    props:{
        admin:{type:Boolean,default:false}
    },data(){
        return{
            darkMode:VueCookie.get('dark_mode')==='on',
        }
    },mounted(){
        VueCookie.get('dark_mode')===null ?VueCookie.set('dark_mode','off'):null;
    }
}
</script>

