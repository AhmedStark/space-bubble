<template>
    
<v-app :dark="darkMode">
<nav-bar v-on:changeMode="darkMode =!darkMode" :admin="admin"></nav-bar>
<slot name="content" :dark="darkMode"   >

</slot>
</v-app>
</template>
<script>
export default {
    props:{
        admin:{type:Boolean,default:false}
    },data(){
        return{
            darkMode:this.$cookies.get('dark_mode')==='on',
        }
    }
}
</script>

