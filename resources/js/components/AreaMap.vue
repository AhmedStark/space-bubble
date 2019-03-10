<template>
    <div class="my-2">
        <v-container>
            <v-layout row wrap>
                <v-flex xs12 lg8 md8>

<slot name="map"></slot>
                <v-card>
                    
                    <v-card-text class="mx-4 px-4" v-if="fullV">
                        <v-chip class="white--text" :color="areaColors[FULL]">Full</v-chip>
                        <v-chip class="white--text" :color="areaColors[CROWDED]">Crowded</v-chip>
                        <v-chip class="white--text" :color="areaColors[NORMAL]">Normal</v-chip>
                        <v-chip class="white--text" :color="areaColors[GOOD]">Good</v-chip>
                        <v-chip class="white--text" :color="areaColors[EMPTY]">Empty</v-chip>
                    </v-card-text>
                </v-card>
                </v-flex>
                <v-spacer></v-spacer>
                <v-flex xs12 lg4 md6>

                    <v-card>
                        <v-card-title><h3 class="title">Areas :-</h3></v-card-title>
                        <v-card-text >
                            <v-card v-for="area in areas" :key="area.id">
                                <v-card-text>
                                    <v-layout row>
                                        <v-flex xs4>
                                            Area-{{area.id}} {{area.takenDesks}}/{{area.desks}} 
                                        </v-flex>
                                        <v-spacer></v-spacer>
                                        <v-flex xs3>
                                            <v-chip small :color="getColorForArea(area.takenDesks,area.desks)" class="white--text" >{{status[areaStatus(area.takenDesks,area.desks)]}}</v-chip>
                                        </v-flex>
                                    </v-layout>

                                    
                                </v-card-text>
                            </v-card>
                        </v-card-text>
                    </v-card>

                </v-flex>
            </v-layout>
        </v-container>
        
    </div>
</template>

<script>
const axios = require('axios');
    export default {
        props:{
            v:{type:Boolean,default:false}
        },
        data:function(){
            return{
                id:1,
                areas:[],
                status:["Full","Crowded","Normal","Good","Empty"],
                areaColors:["#ff3939","#ffa238","#b4d65e","#42f4a7","#5bcfef"],
                FULL:0,
                CROWDED:1,
                NORMAL:2,
                GOOD:3,
                EMPTY:4,
                fullV:this.v,
                t:0
            }
        },methods:{
            changeColor:function () {
                for(var i = 0 ;i<this.areas.length;i++){
                    var area = this.areas[i];
                    var el=document.getElementById("area-"+area.id);
                    var elText=document.getElementById("text-"+area.id);
                    el===null ? console.warn("error id 10 not found in the map"):el.style="fill: "+this.getColorForArea(area.takenDesks,area.desks)+"; stroke: rgb(0, 0, 0);";
                    elText===null ? console.warn("error id text-"+area.id+" not found in the map"):null;
                    elText.innerHTML=area.name+"( "+area.takenDesks+" / "+area.desks+" )";
                }
            },
            getAreas:function () {
                
                this.fullV ? this.changeColor():null;
                axios.get('/areas/'+this.id).then((response)=> {
                this.areas=response.data.areas;
                
            }).catch(function(error){
            }).then((response)=> {
            });
            },areaStatus(takenDesks,desks){
                if(takenDesks===desks){
                    return this.FULL;
                }else if(takenDesks===0){
                    return this.EMPTY;
                }else if (takenDesks/desks>0.6){
                    return this.CROWDED;
                }else if (takenDesks/desks>0.4){
                    return this.NORMAL
                }else if (takenDesks/desks>0){
                    return this.GOOD;
                }
            },getColorForArea:function (takenDesks,desks) {
                return this.areaColors[this.areaStatus(takenDesks,desks)];
            }
        },
        mounted() {
            this.getAreas();
        }
        ,created () {
            setInterval(() => {
                this.getAreas();
            }, 2000)
        }
    }
</script>
