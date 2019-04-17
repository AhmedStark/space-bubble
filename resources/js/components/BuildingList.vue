<template>
    <v-dialog width="400" v-model="open">
        <v-card>
            <v-card-title>{{title}}</v-card-title>
            <v-card-text>
                <v-divider></v-divider>
                <v-layout>
                    <v-flex xs12 class="text-xs-center my-2" v-for="(level,index) in levels" :key="index" ><a :href="'/map/'+level.id" class="building-link title">{{level.name}}</a></v-flex>
                </v-layout>
                
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
        openAreasList(id,name){
            this.$emit("selected-level",{name:name,id:id});
        },
        openList(buildingName,buildingID){
            console.log(buildingID);
            this.open = true;
            this.title = "Select a level " + buildingName;
            axios.get('/buildings/'+buildingID+'/levels/').then((response)=> {
                this.levels=response.data;
            }).catch(function(error){
            }).then((response)=> {

            });
        }
    }
    
}
</script>
