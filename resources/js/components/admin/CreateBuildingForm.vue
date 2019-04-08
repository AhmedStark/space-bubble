<template>
    <v-dialog width="600" :value="open">
       <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Create a new building
        </v-card-title>

        <v-card-text>
            <v-text-field
                v-model="buildingName"
                :rules="nameRules"
                label="Building name"
                required
            ></v-text-field>
            <div v-html="response"></div>
            <v-progress-circular
                v-if="loading"
                indeterminate
                color="primary"
                ></v-progress-circular>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn
            color="error"
            flat
            @click="createBuilding"
          >Discard</v-btn>
          <v-btn
            color="success"
            flat
            @click="createBuilding"
          >Create</v-btn>
        </v-card-actions>
      </v-card> 
    </v-dialog>
</template>
<script>
const axios = require('axios');
export default {
    data(){
        return{
            BUILDING_CREATED:true,
            buildingName:"",
            open:false,
            loading:false,
            response:"",
            status:0,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            nameRules:[v => !!v || 'Name is required',],
        }
    },methods:{
        openDialog(){
            this.open=!this.open;
        },createBuilding(){
            if(this.buildingName === ""){
                this.response = "<p class='error--text'>Building name is required</p>";
            }else{
                this.loading = true;
                axios.post('/buildings/create', {
                        name: this.buildingName,
                        csrf:this.csrf,
                    })
                    .then((response) => {     
                        this.response = response.data.response;
                        this.status = response.data.status;
                    })
                    .catch(function (error) {
                        console.log(error);
                    }).then((response) => {     
                        if(this.status===this.BUILDING_CREATED){
                            this.$emit("building_created");
                            this.openDialog();
                        }
                        this.loading = false;
                });
            }
        }
        ,clear:function () {
            this.buildingName = "";
            this.response = "";   
            this.status = 0;   
        }
    }

}
</script>
