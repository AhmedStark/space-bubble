<template>
<div>
    <v-container>
        <create-building-dialog
            v-on:building_created="getBuildings()"
            ref="create_building_dialog"
        ></create-building-dialog>
        <create-level-dialog
            v-on:level_created="getLevels()"
            ref="create_level_dialog"
        ></create-level-dialog>
        <create-area-dialog
            v-on:area_created="getAreas()"
            ref="create_area_dialog"
        ></create-area-dialog>
        <v-layout row wrap>
            <v-flex md4>
                <v-card class="mx-2">
                    <v-card-text>
                        <v-progress-circular
                            v-if="loadingBuildings"
                            indeterminate
                            color="primary"
                            ></v-progress-circular>
                        <v-btn color="green" dark href="#" @click="createBuilding">Create a Building</v-btn>
                        <p v-if="buildings.length===0" >There are no building click on the button to add you first building</p>
                        <v-card style="border-radius:50px;" class="my-3 building-card" v-for="(building,index) in buildings" :dark="index===selectedBuilding" :key="'b'+building.id" @click="selectBuilding(index)">
                            <v-card-text>             
                                <v-layout row>
                                    <v-flex>
                                        {{building.name }}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        ID:{{building.id}}
                                    </v-flex>
                                    <v-flex><v-icon color="red" @click="deleteBuilding(index)">delete</v-icon></v-flex>
                                    <v-flex><v-icon  @click="editBuilding(index)">edit</v-icon></v-flex>
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
                        <h3 class="title" v-if="buildings.length>0" >{{buildings[selectedBuilding].name}} levels</h3>
                         <v-btn v-if="buildings.length>0" dark color="blue" @click="showCreateLevelForm">Add new level to this building</v-btn>
                         <v-card style="border-radius:50px;" class="my-3 building-card" v-for="(level,index) in levels" :dark="index===selectedLevel" :key="'l'+level.id" @click="selectLevel(index)">
                        <v-card-text>
                               <v-layout row>
                                    <v-flex>
                                        {{level.name}}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        7 areas    
                                    </v-flex>
                                    <v-flex><v-icon @click="editLevel(index)">edit</v-icon></v-flex>
                                </v-layout> 
                        </v-card-text></v-card>
                   </v-card-text>
                </v-card>
            </v-flex>
            <v-flex md3>
                <v-card class="mx-2">
                    <v-card-text>

                    <h3 class="title" v-if="levels.length>0" >{{levels[selectedLevel].name}} areas</h3>
                    <p v-if="areas.length===0" class="my-2">This level does not contain any areas click on the button to add your first one. </p>
                        <v-progress-circular
                            v-if="loadingBuildings"
                            indeterminate
                            color="primary"
                            ></v-progress-circular>
                         <v-btn v-if="levels.length>0" dark color="blue" normal @click="showCreateAreaForm">Add new area to this level</v-btn>
                        <v-card  class="my-3" v-for="(area,index) in areas" :key="'a'+area.id" @click="selectArea(index)">
                            <v-card-text>
                                <v-layout row>
                                    <v-flex>
                                        {{area.name}}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        6 seats  
                                    </v-flex>
                                    <v-flex>
                                        <a :href="'/admin/area/'+area.id">edit</a>
                                    </v-flex>
                                </v-layout> 
                        </v-card-text>
                        </v-card>
                   </v-card-text></v-card>
            </v-flex>
            
        </v-layout>
    </v-container>
    </div>
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
        editLevel:function(index){
            this.$refs.create_level_dialog.edit(this.levels[index].id,this.levels[index].name);
        },
        editBuilding:function(index){
            this.$refs.create_building_dialog.edit(this.buildings[index].id,this.buildings[index].name);
        },
        showCreateLevelForm:function(){
            this.$refs.create_level_dialog.openDialog(this.buildings[this.selectedBuilding].id);
        },
        showCreateAreaForm:function(){
            this.$refs.create_area_dialog.openDialog(this.levels[this.selectedLevel].id);
        },
        createBuilding:function () {
            this.$refs.create_building_dialog.openDialog();
        },
        deleteBuilding:function(index){
            
            axios.post('/buildings/'+this.buildings[index].id+"/delete", {
                        csrf:this.csrf,
                    })
                    .then((response) => {
                        this.getBuildings();
                    })
                    .catch(function (error) {
                    }).then((response) => {     
                        
                });
        },
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
            this.selectedBuilding =0;
            this.loadingBuildings = true;
            axios.get('/buildings').then((response)=> {
                this.buildings=response.data;
                console.log(this.buildings);
                this.getLevels(this.buildings[this.selectedBuilding].id);
            }).catch(function(error){
            }).then((response)=> {
                this.loadingBuildings = false;
            });;
        },
        getLevels:function(id){
            
            this.loadingLevels = true;
            axios.get('/buildings/'+this.buildings[this.selectedBuilding].id+"/levels").then((response)=> {
                this.levels=response.data;
                this.getAreas(id);
                console.log("Load");
            }).catch(function(error){
            }).then((response)=> {
                this.loadingLevels = false;
            });;
        },

        getAreas:function(id){
            this.loadingAreas = true;
            axios.get('/levels/'+this.levels[this.selectedLevel].id+"/areas").then((response)=> {
                this.areas=response.data;
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
