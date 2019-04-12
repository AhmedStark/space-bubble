<template>
<v-container>
<v-layout row wrap class="my-2">

<v-flex md8 sm12>

    <main-map :buildings="buildings" ref="main_map">
        <div slot="child-map" >
        <slot name="map"></slot>
        </div>
    </main-map>
</v-flex>
<v-spacer></v-spacer>
<v-flex md3 sm12>
    <v-card>
        <v-card-title><v-flex class="text-xs-center"><b class="headline">Buildings</b></v-flex></v-card-title>
        <v-card-text>
            <v-flex class="text-xs-center my-2" v-for="(building,index) in buildings" :key="index"><a :href="'/buildings/'+building.id" class="building-link title">{{building.name}}</a></v-flex>
        </v-card-text>
    </v-card>
</v-flex>   
</v-layout>
</v-container>

</template>
        

<script>
export default {
    data:function(){
        return{
            buildings:[
                {id:"17",direct:"1",name:"Hello world"},
                {id:"10",direct:"1",name:"Hello world"},
                {id:"14",direct:"1",name:"Hello world"},
                {id:"16",direct:"1",name:"Hello world"},
                {id:"9",direct:"1",name:"Hello world"},
                {id:"11",direct:"1",name:"Hello world"},
                {id:"4",name:"Hello world"},
                {id:"5",name:"Hello world"},
                {id:"15",direct:"1",name:"Hello world"},
                {id:"3",direct:"1",name:"Hello world"},
                {id:"2",name:"Hello world"},
                {id:"1",direct:"1",name:"Hello world"},
                {id:"7",direct:"1",name:"Hello world"},
                {id:"6",name:"Hello world"},
                {id:"18",name:"Hello world"},
                {id:"8",direct:"1",name:"Hello world"},
                {id:"12",name:"Hello world"},
                {id:"13",name:"Hello world"},
                {id:"100",name:"Hello world"},
                ]
        }
    },
    methods:{
        changeColor:function () {
                for(var i = 0 ;i<this.buildings.length;i++){
                    var building = this.buildings[i];
                    var el=document.getElementById("building-"+building.id);
                    el.addEventListener("mouseover",this.mouseOverMapEvent);
                    el.addEventListener("mouseout",this.mouseOutMapEvent);
                    el.buildingID = "building-"+ building.id;
                    el.buildingIndex = i;
                    this.buildings[i].color=el.style.fill;


                    if(building.direct!==undefined){
                        el.direct=building.direct;
                        el.addEventListener("click",this.clickMapEvent);
                        el.style.cursor ="pointer"
                    }
                }
            },mouseOverMapEvent:function(evt){
                var el = document.getElementById(evt.target.buildingID);
                el.style.fill = "blue";
            },mouseOutMapEvent:function(evt){
                var el = document.getElementById(evt.target.buildingID);
                el.style.fill = this.buildings[el.buildingIndex].color;
            },
            clickMapEvent:function(evt){
                window.location = 'http://localhost:8000/map/'+evt.target.direct;
            },selectbuilding(id){
                this.$refs.main_map.selectbuilding(id);
            },
    },mounted(){
        this.changeColor();
    }
}

</script>

<style>
.building-link:hover{
        color: rgb(4, 21, 248);
        background: rgba(205, 205, 205, 0.803)
}
.building-link{
    color: black;
    text-decoration: none;
}
</style>