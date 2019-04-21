<template>
    <v-toolbar
        color="blue"
        dark
    >
        <a href="/"><v-toolbar-title class="white--text text-uppercase" ><span class="font-weight-light">Space</span><span> Bubble</span></v-toolbar-title></a>
                    

    </v-toolbar>
</template>
<script>
export default {
    data(){
        return {

        }
    },
    methods:{
        opneNavDrawer:function () {
            console.log('open drawer');
        }
    }
}
</script>
<style scoped>
a{
    text-decoration: none;
}
</style>