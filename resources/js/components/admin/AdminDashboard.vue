<template>
<div>
    <v-container>
        <v-layout row>

            <main-map-form ref="change_main_map_form"></main-map-form>
            <v-btn large color="warning" @click="changeMainMap"><v-icon>map</v-icon>change main map</v-btn>
             <v-spacer></v-spacer>
             <a href="/admin/help" class="mt-3">Help <v-icon color="blue">help</v-icon></a>
        </v-layout>
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
            <v-flex md3>
                <v-card class="mx-2">
                    <v-card-text>
                        <v-progress-circular
                            v-if="loadingBuildings"
                            indeterminate
                            color="primary"
                            ></v-progress-circular>
                        <v-btn color="green" dark href="#" @click="createBuilding">Create a Building</v-btn>
                        <p v-if="buildings.length===0" >There are no building click on the button to add you first building</p>
                        <v-card style="border-radius:50px;" :class="index===selectedBuilding?'my-3 building-card  grey lighten-1':'my-3 building-card'" v-for="(building,index) in buildings"  :key="'b'+building.id" @click="selectBuilding(index)">
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
            <v-flex md4>
                <v-card class="mx-2">
                    
                    <v-card-text>
                    
                        <v-progress-circular
                            v-if="loadingBuildings"
                            indeterminate
                            color="primary"
                            ></v-progress-circular>
                        <h3 class="title" v-if="buildings.length>0" >{{buildings[selectedBuilding].name}} levels</h3>
                         <v-btn v-if="buildings.length>0" dark color="blue" @click="showCreateLevelForm">Add new level to this building</v-btn>
                         <v-card style="border-radius:50px;" :class="index===selectedLevel?'my-3 building-card grey lighten-1':'my-3 building-card'" v-for="(level,index) in levels"  :key="'l'+level.id" @click="selectLevel(index)">
                        <v-card-text>
                               <v-layout row>
                                    <v-flex>
                                        {{level.name}}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        <v-icon color="red" @click="deleteLevel(index)">delete</v-icon>    
                                    </v-flex>
                                    <v-flex><v-icon @click="editLevel(index)">edit</v-icon></v-flex>
                                </v-layout> 
                        </v-card-text></v-card>
                   </v-card-text>
                </v-card>
            </v-flex>
            <v-flex md5>
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
                        <div v-if="levels.length>0">
                            
                        <v-card  class="my-3" v-for="(area,index) in areas" :key="'a'+area.id" @click="selectArea(index)">
                            <v-card-text>
                                <v-layout row>
                                    <v-flex>
                                        {{area.name}}
                                    </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-flex>
                                        ID::{{area.id}}  
                                    </v-flex>
                                    <v-flex>tables :: {{area.tables}}</v-flex>
                                    <v-flex>
                                        <a :href="'/admin/area/'+area.id">seats</a>
                                        <v-icon color="red" @click="deleteArea(index)">delete</v-icon>
                                        <v-icon @click="editArea(index)" >edit</v-icon>
             
                                    </v-flex>
                                </v-layout> 
                        </v-card-text>
                        </v-card>

                        </div>
                        <v-card v-if="levels.length===0">
                            <v-card-text>
                                <p>No level selected</p>
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
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
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
            this.selectedLevel = 0;
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
            if(this.levels[this.selectedLevel].length<0){
                return;
            }
            axios.get('/levels/'+this.levels[this.selectedLevel].id+"/areas").then((response)=> {
                this.areas=response.data;
            }).catch(function(error){
            }).then((response)=> {
                this.loadingAreas = false;
            });;
        },deleteLevel(index){
            axios.post('/levels/'+this.levels[index].id+"/delete", {
                        csrf:this.csrf,
                    })
                    .then((response) => {
                        this.getLevels();
                    })
                    .catch(function (error) {
                    }).then((response) => {     
                        
                });
        },deleteArea(index){
            console.log("lol");
            axios.post('/deleteArea', {
                        id:this.areas[index].id,
                        csrf:this.csrf,
                    })
                    .then((response) => {
                        this.getAreas();
                    })
                    .catch(function (error) {
                    }).then((response) => {     
                        
                });
        },editArea(index){
            console.log('hok ::',this.areas[index].id,this.areas[index].name)
         this.$refs.create_area_dialog.edit(this.areas[index].id,this.areas[index].name);   
        },changeMainMap(){
            this.$refs.change_main_map_form.openDialog();
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
