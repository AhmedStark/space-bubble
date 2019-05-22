<template>
<v-container>
<building-list ref="levels" v-on:selected-level="selectLevel"></building-list>
<level-list ref="areas"></level-list>
<v-layout row>
    <v-flex md4>    
        <v-card>
            <v-breadcrumbs :items="navBreadCrumbs" large class="subtitle" divider=">" ></v-breadcrumbs>
        </v-card>
    </v-flex>

</v-layout>
<v-layout row wrap class="my-2">

<v-flex lg8 sm12>

    <main-map :buildings="buildings" ref="main_map">
        <div slot="child-map" >
        <slot name="map"></slot>
        </div>
    </main-map>
</v-flex>
<v-spacer></v-spacer>
<v-flex lg4 sm12>
    <v-card>
        <v-card-title><v-flex class="text-xs-center"><b class="headline">Buildings</b></v-flex></v-card-title>
        <v-card-text>
            <v-flex class="text-xs-center my-2" v-for="(building,index) in buildings" :key="index"><a href="#" @click="showLevels(building.name,building.id)" v-bind:class=" $attrs.dark ? 'building-link-dark title':'building-link title'">{{building.name}}</a></v-flex>
        </v-card-text>
    </v-card>
</v-flex>
</v-layout>
<v-layout row>
    <v-flex xs2><v-btn float dark color="purple lighten-1" large icon @click="getBuilding(buildings.length-1)"><v-icon>arrow_left</v-icon></v-btn></v-flex>
    <v-spacer></v-spacer>
    <v-flex xs2><v-btn float dark color="purple lighten-1" large icon @click="getBuilding(0)"><v-icon>arrow_right</v-icon></v-btn></v-flex>
</v-layout>
</v-container>

</template>
        

<script>
const axios = require('axios');
export default {
    props:{
        navBreadCrumbs:{default:function () {
            return [{text:'Buildings',href:"/","disabled":false}]
        },type:Array    }
    },
    data:function(){
        return{
            buildings:[],
            buildingName:"",
        }
    },
    methods:{
        changeColor:function () {
                                
                for(var i = 0 ;i<this.buildings.length;i++){
                    var building = this.buildings[i];
                    console.log("damn");
                    var el=document.getElementById("building-"+building.id);
                    el.addEventListener("mouseover",this.mouseOverMapEvent);
                    el.addEventListener("mouseout",this.mouseOutMapEvent);
                    el.buildingID = "building-"+ building.id;
                    el.buildingName =  building.name;
                    el.buildingIndex = i;
                    this.buildings[i].color=el.style.fill;


                        el.addEventListener("click",this.clickMapEvent);
                        el.style.cursor ="pointer"
                }
            },mouseOverMapEvent:function(evt){
                var el = document.getElementById(evt.target.buildingID);
                el.style.fill = "blue";
            },mouseOutMapEvent:function(evt){
                var el = document.getElementById(evt.target.buildingID);
                el.style.fill = this.buildings[el.buildingIndex].color;
            },findById:function (building,id) {
                
                return building.id===id;
            },
            clickMapEvent:function(evt){
                this.showLevels(evt.target.buildingName,evt.target.buildingID.substr(9,evt.target.buildingID.length-1));
            },selectbuilding(id){
                this.$refs.main_map.selectbuilding(id);
            },getBuilding:function(index){
                this.showLevels(this.buildings[index].name,this.buildings[index].id);
            },showLevels:function(buildingName,buildingID){
                this.$refs.levels.openList(buildingName,buildingID);
            },getBuildings:function(){
                
                axios.get('/buildings/').then((response)=> {
                    console.log("sjs");
                    console.log(response.data)
                    this.buildings=response.data;
                }).catch(function(error){
                }).then((response)=> {
                    this.changeColor();
                });
            },selectLevel(e){
                this.$refs.areas.openList(e.id,e.name);
            }
    },mounted(){
        console.log("lol")
        this.changeColor();
    },created(){
        console.log("cearted")
        this.getBuildings();
    }
}

</script>

<style>
.building-link:hover ,.building-link-dark:hover{
        color: rgb(4, 21, 248);
        background: rgba(205, 205, 205, 0.803)
}
.building-link{
    color: black;
    text-decoration: none;
}
.building-link-dark{
    color: white;
    text-decoration: none;
}
</style>