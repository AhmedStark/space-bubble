<template>
    <main-map :areas="areas" ref="main_map">


    
    <div class="my-2" slot="child-map" >
        <v-container>

<v-layout row>

</v-layout>
            <v-layout row wrap>
                <v-flex xs12 lg8 sm7>
                    
                    <v-container>
                    <h3 class="display-1">{{name}}</h3>
                        <slot name="map" class="svg-container"></slot>
                        </v-container>
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
                <v-flex xs12 lg3 sm5>
                    <v-card class="my-2">
                        <v-card-title><h3 class="title">Areas :-</h3></v-card-title>
                        <v-card-text >
                            <v-card v-for="area in areas" :key="area.id" @click="selectArea(area.id)">
                                <v-card-text>
                                    <v-layout row>
                                        <v-flex xs4>
                                            {{area.name}} {{area.takenTables}}/{{area.tables}} 
                                        </v-flex>
                                        <v-spacer></v-spacer>
                                        <v-flex xs3>
                                            <v-chip small :color="getColorForArea(area.takenTables,area.tables)" class="white--text" >{{status[areaStatus(area.takenTables,area.tables)]}}</v-chip>
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
    </main-map>
</template>

<script>
const axios = require('axios');
    export default {
        props:{
            name:{default:""},
            v:{type:Boolean,default:false}
            ,id:{type:String},
            nav:{type:Array,default:function () {
                return [{"text":"sss","href":"sss","disabled":false}]
            }}
        },
        data:function(){
            return{
                areas:[],
                status:["Full","Crowded","Normal","Good","Empty"],
                areaColors:["#ff3939","#ffa238","#b4d65e","#42f4a7","#5bcfef"],
                FULL:0,
                CROWDED:1,
                NORMAL:2,
                GOOD:3,
                EMPTY:4,
                fullV:this.v,
                t:0,
                holdIdZoom : 0,
            }
        },methods:{
            changeColor:function () {
                for(var i = 0 ;i<this.areas.length;i++){
                    var area = this.areas[i];
                    var el=document.getElementById("area-"+area.id);
                    var elText=document.getElementById("text-"+area.id);
                    el===null ? console.warn("error id 10 not found in the map"):el.style.fill=this.getColorForArea(area.takenTables,area.tables);
                    elText===null ? console.warn("error id text-"+area.id+" not found in the map"):null;
                    
                    if(elText===null){
                        console.error("Area text not found",area.id);
                        continue;
                    }
                   elText.style.fontSize="3pt"
                    
                    if(area.tables==0){
                        elText.innerHTML=area.name+"(No tables)"
                    }else{
                        elText.innerHTML=area.name+"( "+area.takenTables+" / "+area.tables+" )";
                    }
                    
                    
                }
            },selectArea(id){
                this.$refs.main_map.selectArea(id);
            },
            getAreas:function () {
                this.fullV ? this.changeColor():null;
                axios.get('/levels/'+this.id+"/areas").then((response)=> {
                this.areas=response.data;
                
                
            }).catch(function(error){
            }).then((response)=> {
            });
            },areaStatus(takenTables,tables){
                if(takenTables===tables){
                    return this.FULL;
                }else if(takenTables===0){
                    return this.EMPTY;
                }else if (takenTables/tables>0.6){
                    return this.CROWDED;
                }else if (takenTables/tables>0.4){
                    return this.NORMAL
                }else if (takenTables/tables>0){
                    return this.GOOD;
                }
            },getColorForArea:function (takenTables,tables) {
                return this.areaColors[this.areaStatus(takenTables,tables)];
            },clickMapEvent:function(evt){
            
            },
        },
        mounted() {
            this.getAreas();
        }
        ,created () {
            setInterval(() => {
                this.getAreas();
            }, 1000)
        }
    }
</script>
<style>
.svg-container {
    display: inline-block;
    position: relative;
    width: 100%;
    padding-bottom: 100%;
    vertical-align: top;
    overflow: hidden;
}
.svg-content {
    display: inline-block;
    position: absolute;
    top: 0;
    left: 0;
}
</style>
