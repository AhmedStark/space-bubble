<template>
    <v-container>
        <h3 class="display-2">Area {{areaName}}</h3>
        <v-layout row>
            <v-flex >
                <a href="/admin/dashboard/"><v-icon color="blue" small>keyboard_backspace</v-icon> back to the dashboard</a>
            </v-flex>
            <v-spacer></v-spacer>
            <v-flex><v-btn small color="green" @click="addTable" dark>Add new table</v-btn></v-flex>
        </v-layout>        
        <v-card>
            <v-card-text>
                <v-list>
                    <v-list-tile v-for="(table,index) in tables" :key="index">
                        <v-list-tile-avatar>
                            <v-icon >event_seat</v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content @click="copyTokenToClipBoard(index)">
                            token :: {{table.token}}
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-layout row>
                                <v-icon color="red" @click="deleteTable(table.id)">delete</v-icon>
                                <v-icon @click="copyTokenToClipBoard(index)">file_copy</v-icon>
                            </v-layout>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
                
            </v-card-text>

                <v-layout row>
                    <v-flex xs6 offset-xs3 offset-lg4>
                        <v-pagination
                            @input="changePage"
                            v-model="currentPage"
                            :length="pagesNumber"
                            ></v-pagination>
                    </v-flex>
                </v-layout>
        </v-card>
         <v-snackbar
            v-model="snackbar"
            :timeout="3000"
            >{{ snackbarText }}<v-btn
                dark
                flat
                color="red"
                @click="snackbar = false">Close</v-btn>
            </v-snackbar>
    </v-container>
</template>
<script>
const axios = require('axios');
export default {
    props:{
        areaName:{default:'',type:String},id:{default:"",type:String}
    },data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            currentPage:1,
            pagesNumber:1,
            loadingTables:false,
            snackbarText:"Hi guys",
            snackbar:false,
            tables:[],
        }
    },methods:{
        copyTokenToClipBoard:function (index) {
            const el = document.createElement('textarea');
            el.value = this.tables[index].token;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            this.snackbarText="Copied token to clipboard"
            this.snackbar=true
        },
        getTables:function(){
            this.loadingTables = true;
            axios.get('/area/'+this.id+'/tables/?page='+this.currentPage).then((response)=> {
                this.tables=response.data.data;
                this.pagesNumber=response.data.last_page;
            }).catch(function(error){
            }).then((response)=> {
                this.loadingBuildings = false;
            });;
        },changePage(){
            this.getTables();
        },addTable(){
            axios.post('/table', {
                        area_id: this.id,
                        
                        csrf:this.csrf,
                    })
                    .then((response) => {
                        this.currentPage=this.pagesNumber;
                        this.getTables();
                        this.snackbarText=response.data.response;
                        this.snackbar=true;
                    })
                    .catch(function (error) {
                    }).then((response) => {     
                        
                });
        },deleteTable(id){
            axios.post('/deleteTable', {
                        area_id: this.id,
                        id:id,
                        csrf:this.csrf,
                    })
                    .then((response) => {
                        this.getTables();
                        this.snackbarText=response.data.response;
                        this.snackbar=true;
                    })
                    .catch(function (error) {
                    }).then((response) => {     
                        
                });
        }
    },mounted(){
        this.getTables();
    }
}
</script>