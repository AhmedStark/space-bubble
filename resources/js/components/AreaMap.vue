<template>
    <div>
        <ul>
            <li v-for="(area,index) in areas" :key="index">{{status[areaStatus(area.taken_desks,area.desks)]}}</li>
        </ul>
    </div>
</template>

<script>
const axios = require('axios');
    export default {
        
        data:function(){
            return{
                areas:[],
                status:["Full","Crowded","Normal","Good","Empty"],
                statusColors:["Full","Crowded","Normal","Good","Empty"],
                FULL:0,
                CROWDED:1,
                NORMAL:2,
                GOOD:3,
                EMPTY:4,
            }
        },methods:{
            getAreas:function () {
                axios.get('/areas').then((response)=> {
                this.areas=response.data;
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
