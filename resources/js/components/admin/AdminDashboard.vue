<template>
    <v-container>
        <v-layout row wrap>
            <v-flex md4>
                <v-card class="mx-2">
                    <v-card-text>
                        <v-progress-circular
                            v-if="loadingBuildings"
                            indeterminate
                            color="primary"
                            ></v-progress-circular>
                        <v-btn color="green" dark href="#">Create a Building</v-btn>
                        <v-card style="border-radius:50px;" class="my-3 building-card" v-for="(building,index) in buildings" :dark="index===selectedBuilding" :key="'b'+building.id" @click="selectBuilding(index)">
                            <v-card-text>             
                                <v-layout row>
                                    <v-flex>
                                        {{building.name }}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        12 levels
                                    </v-flex>
                                </v-layout>
                            </v-card-text>
                        </v-card>
                        
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex md5>
                <v-card class="mx-2">
                    
                    <v-card-text>
                    
                        <v-progress-circular
                            v-if="loadingBuildings"
                            indeterminate
                            color="primary"
                            ></v-progress-circular>
                        <h3 class="title">{{buildings[selectedBuilding].name}} levels</h3>
                        <v-card style="border-radius:50px;" class="my-3 building-card" v-for="(level,index) in levels" :dark="index===selectedLevel" :key="'l'+level.id" @click="selectLevel(index)">
                        <v-card-text>
                                <v-layout row>
                                    <v-flex>
                                        {{level.name}}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        6 areas    
                                    </v-flex>
                                </v-layout> 
                        </v-card-text></v-card>
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex md3>
                <v-card class="mx-2">
                    <v-card-text>

                        <v-progress-circular
                            v-if="loadingBuildings"
                            indeterminate
                            color="primary"
                            ></v-progress-circular>
                        <v-card  class="my-3" v-for="(area,index) in areas" :key="'a'+area.id" @click="selectArea(index)">
                            <v-card-text>
                                <v-layout row>
                                    <v-flex>
                                        {{area.name}}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        6 areas    
                                    </v-flex>
                                </v-layout> 
                        </v-card-text>
                        </v-card>
                        
                    </v-card-text></v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
const axios = require('axios');
export default {
    
    data(){
        return{
            loadingBuildings:false,
            loadingLevels:false,
            loadingAreas:false,
            selectedBuilding:0,
            selectedLevel:0,
            buildings:[{name:'none'}],            
            levels:[],
            areas:[],
            selectedArea:0,
        }    
    },methods:{

        selectBuilding:function (index) {
            this.selectedBuilding = index;
            this.getLevels();
        },
        selectLevel:function (index) {
            this.selectedLevel = index;
            this.getAreas();
        },
        selectArea:function (index) {
            this.selectedArea = index;
        },
        getBuildings:function(){
            this.loadingBuildings = true;
            axios.get('/buildings').then((response)=> {
                
                this.buildings=response.data.buildings;
                this.getLevels(this.buildings[this.selectedBuilding].id);
            }).catch(function(error){
            }).then((response)=> {
                this.loadingBuildings = false;
            });;
        },
        getLevels:function(id){

            this.loadingLevels = true;
            axios.get('/buildings/'+this.buildings[this.selectedBuilding].id+"/levels").then((response)=> {
                this.levels=response.data.levels;
                this.getAreas(id);
                console.log("Load");
            }).catch(function(error){
            }).then((response)=> {
                this.loadingLevels = false;
            });;
        },

        getAreas:function(id){
            this.loadingAreas = true;
            axios.get('/levels/'+id+"/areas").then((response)=> {
                this.areas=response.data.areas;
                
            }).catch(function(error){
            }).then((response)=> {
                this.loadingAreas = false;
            });;
        }
    },mounted(){
        this.getBuildings();


    }
}
</script>
<style scoped>
.building-card{
    border-radius:50px;
    cursor: pointer;
}
</style>
