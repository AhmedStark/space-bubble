<template>
    <v-dialog v-model="open">
        <v-card>
            <v-card-title>{{title}}</v-card-title>
            <v-card-text>
                <v-divider></v-divider>
                <v-flex class="text-xs-center my-2" v-for="(area,index) in areas" :key="index"><a :href="'/map/'+area.id" class="area-link title">{{area.name}}</a></v-flex>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
const axios = require('axios');
export default {
    data(){
        
        return{
            open:false,
            title:"Select a area ",
            areas:[],
        }
        
        
    },methods:{
        openList(areaID,areaName){
            console.log(areaID);
            this.open = true;
            this.title = "Select an area " + areaName;
            axios.get('/levels/'+areaID+'/areas/').then((response)=> {
                this.areas=response.data;
            }).catch(function(error){
            }).then((response)=> {

            });
        }
    }
    
}
</script>
