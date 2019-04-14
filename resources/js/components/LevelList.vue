<template>
    <v-dialog v-model="open">
        <v-card>
            <v-card-title>{{title}}</v-card-title>
            <v-card-text>
                <v-divider></v-divider>
                <v-flex class="text-xs-center my-2" v-for="(level,index) in levels" :key="index"><a href="#" class="level-link title">{{level.name}}</a></v-flex>
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
            title:"Select a level ",
            levels:[],
        }
        
        
    },methods:{
        openList(levelID,levelName){
            console.log(levelID);
            this.open = true;
            this.title = "Select an area " + levelName;
            axios.get('/levels/'+levelID+'/areas/').then((response)=> {
                this.levels=response.data;
            }).catch(function(error){
            }).then((response)=> {

            });
        }
    }
    
}
</script>
