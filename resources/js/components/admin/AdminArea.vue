<template>
    <v-container>
        <h3 class="display-2">Area {{areaName}}</h3>
        <v-card>
            <v-card-text>
                <v-list>
                    <v-list-tile v-for="(table,index) in tables" :key="index">
                        <v-list-tile-avatar>
                            <v-icon >event_seat</v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content :ref="'token-'+index">
                            {{table.token}}
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-layout row>
                                <v-icon color="red">delete</v-icon>
                                <v-icon color="grey" @click="copyTokenToClipBoard(index)">file_copy</v-icon>
                            </v-layout>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
            </v-card-text>
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
export default {
    props:{
        areaName:{default:'',type:String}
    },data(){
        return{
            snackbarText:"Hi guys",
            snackbar:false,
            tables:[{"token":"djhagwifyat7y8ildhb2891i","id":"12"},{"token":"ngcbfxdvwafi2i91`acwpoc","id":"13"},],
        }
    },methods:{
        copyTokenToClipBoard:function (index) {
            const el = document.createElement('textarea');
            el.value = this.tables[index].token;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            this.snackbar=true
        }
    }
}
</script>
