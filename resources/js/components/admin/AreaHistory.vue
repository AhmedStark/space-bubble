<template>
    <div>
        <v-container >
            <v-layout row>
            <v-flex md3>
                <v-card >
                    <v-card-title>Choose a building</v-card-title>
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
            </v-flex>
            <v-flex md7>
                  <apexchart  width="100%" type="line" :options="options" :series="series"></apexchart>
            </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>
<script>

export default {
data(){
        return{
            selectedBuilding : null,
            selectedLevel : null,
            selectedAreas : [],
            buildingPanel:[],
            levelPanel:[],
            areaPanel:[],
            options: {
                 palette: 'palette2',
                chart: {
                id: 'vuechart-example'
                },
                xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                }
            },
            series: [
                {
                    name: 'Lab-2',
                    data: [30, 10, 15, 50, 49, 70, 70, 91]
                },
                {
                    name: 'Lab-1',
                    categories: [ 1992, 1993, 1994, 1995, 1996, 1997, 1998],
                    data: [null,30, 40, 45, 10, 49, 30, 50]
                },
            ],
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
                {name:"area C",id:2},
            ],

        }
    },methods:{
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
                this.selectedAreas.push(index)
                return;
            }
            this.selectedAreas.splice(this.selectedAreas.indexOf(index), 1);
            
            
        }
    }
}
</script>
