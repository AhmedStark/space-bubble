<template>
    <div>
        <v-container >
            <v-layout row>
            <v-flex md3 class="body-2">
                <v-card class="mx-2">
                    <v-card-title><h1 class="title">Choose a building</h1></v-card-title>
                    <v-card-text>
                <v-expansion-panel v-model="buildingPanel" expand>
                    <v-expansion-panel-content key="building-panel">
                        <template v-slot:header>
                            <div>Buildings</div>
                        </template>
                    <v-card>
                        <v-list>
                            <v-list-tile :class="selectedBuilding === index ? 'indigo white--text':''"  @click="selectBuilding(building.id,index)" v-for="(building,index) in buildings" :key="index">
                                <v-list-tile-title>{{building.name}}</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>

                <v-expansion-panel v-model="levelPanel" expand >
                    <v-expansion-panel-content key="building-panel">
                        <template v-slot:header>
                            <div>Levels</div>
                        </template>
                    <v-card>
                        <v-list>
                            <v-list-tile :class="selectedLevel === index ? 'indigo white--text':''"  @click="selectLevel(level.id,index)" v-for="(level,index) in levels" :key="index">
                                <v-list-tile-title>{{level.name}}</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>


                <v-expansion-panel v-model="areaPanel" expand >
                    <v-expansion-panel-content >
                        <template v-slot:header>
                            <div>Areas</div>
                        </template>
                    <v-card>
                        <v-list>
                            <v-list-tile  :class="selectedAreas.indexOf(index) !== -1 ? 'indigo white--text':''"  @click="selectArea(area.id,index)" v-for="(area,index) in areas" :key="index">
                                <v-list-tile-title>{{area.name}}</v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>


                    </v-card-text>
                </v-card>
                <v-card class="mt-4 mx-2">
                    <v-card-text>

<v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-right="40"
        lazy
        transition="scale-transition"
        offset-y
        full-width
        min-width="290px"
      >
        <template v-slot:activator="{ on }">
          <v-text-field
            v-model="fromDatePicker"
            label="Start date"
            prepend-icon="event"
            readonly
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker 
            min="2019-01-01"
            max="2019-06-02"
            v-model="fromDatePicker" @input="menu = false"></v-date-picker>
      </v-menu>
<v-menu
        v-model="toDatePickerMenu"
        :close-on-content-click="false"
        :nudge-right="40"
        lazy
        transition="scale-transition"
        offset-y
        full-width
        min-width="290px"
      >
        <template v-slot:activator="{ on }">
          <v-text-field
            v-model="toDatePicker"
            label="End date"
            prepend-icon="event"
            readonly
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker 
            :min="fromDatePicker"
            max="2019-06-02"
            v-model="toDatePicker" @input="toDatePickerMenu = false"></v-date-picker>
      </v-menu>
<p v-if="fromDatePicker!==null &&toDatePicker !==null" class="body-2">Download data that is recorded from {{fromDatePicker}} to {{toDatePicker}}.</p>
                        <v-btn color="blue" dark @click="downloadData" :loading="loadingDownload"><span><v-icon>cloud_download</v-icon> Download</span></v-btn>
                    </v-card-text>

                </v-card>
            </v-flex>
            <v-flex md7>
                    <!--<apexchart class="chart" backgroud="#000"  width="100%" type="line" :options="options" :series="series" ></apexchart>-->
                <line-chart
                    :width="500"
                    :height="300"
                    :labels="labels"
                    :datasets="chartData.dataset"
                    :options="chartOptions"
                    ></line-chart>
                    <v-card class="my-2">
                        <v-card-title class="title">Areas</v-card-title>
                        <v-list>
                            <v-list-tile   v-for="(area,index) in chartData.dataset" :key="index">
                                <v-list-tile-title>{{area.label}}</v-list-tile-title>
                                <v-list-tile-action><v-icon @click="deleteArea(area.id)" color="red">delete</v-icon></v-list-tile-action>
                            </v-list-tile>
                        </v-list>
                    </v-card>
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
            colors:['red','green','tile','orange','yellow'],
                labels:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
            chartData:{
                dataset:[]
            },
            chartOptions:{},
            fromDatePicker:null,
            toDatePicker:null,
            menu:false,
            toDatePickerMenu:false,
            selectedBuilding : null,
            selectedLevel : null,
            selectedAreas : [],
            buildingPanel:[],
            levelPanel:[],
            areaPanel:[],
            loadingDownload:false,
       
            
            buildings:[
                {name:"Building A",id:1},
                {name:"Building B",id:2},
            ],
            levels:[
                {name:"level A",id:1},
                {name:"level B",id:2},
            ],
            areas:[
                {name:"area A",id:1},
                {name:"area B",id:2},
            ],
            lineOptions:{
                lineTension: 0.1,
              borderDashOffset: 0.0,
            pointBackgroundColor: "white",
        pointBorderWidth: 1,
                pointHoverRadius: 8,
            }
        }
    },methods:{
        getColor:function () {
            return this.colors[Math.floor(Math.random()*this.colors.length)];
        },
        downloadData:function () {
          this.loadingDownload = true;
          document.getElementById('my_iframe').src = "http://localhost:8000/imgs/BS.png";
          this.loadingDownload = false; 
        },
        selectBuilding:function (id,index) {
            console.log("You selected this building"+id);
            console.log(this.panels);
            this.buildingPanel= [];
            this.selectedBuilding = index;
            this.levelPanel =  [...Array(this.items).keys()].map(_ => true);
            
        },
        selectLevel:function (id,index) {
            this.areaPanel = [...Array(this.items).keys()].map(_ => true);
            this.levelPanel= [];
            this.selectedLevel = index;
            
        },

        selectArea:function (id,index) {
            
            if(this.selectedAreas.indexOf(index)===-1){
                this.getAreaData(id);
                this.selectedAreas.push(index)
                
                return;
            }
            this.deleteArea(id);
            this.selectedAreas.splice(this.selectedAreas.indexOf(index), 1);
            
            
        },getAreaData(id){
            

            axios.get('/area/'+id+'/data').then((response)=> {
                this.lineOptions.borderColor=this.getColor();
                console.log(this.getColor());
                this.chartData.dataset.push({...response.data,...this.lineOptions});
                this.labels = response.data.categories;
            }).catch(function(error){
            }).then((response)=> {
                this.loadingAreas = false;
            });;
        },deleteArea(id){
            var index= this.chartData.dataset.findIndex(x => x.id === id); 
            this.chartData.dataset.splice(index,1);
        }
    }
}
</script>
<style>
.chart {
    background: #fff;
}
</style>
