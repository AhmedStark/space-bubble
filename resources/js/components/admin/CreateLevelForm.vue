<template>
    <v-dialog width="600" :value="open">
       <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Create a new level
        </v-card-title>

        <v-card-text>
            <v-text-field
                v-model="levelName"
                :rules="nameRules"
                label="Level name"
                required
            ></v-text-field>
            <div v-html="response"></div>
            <v-progress-circular
                v-if="loading"
                indeterminate
                color="primary"
                ></v-progress-circular>

<img large class="responsive pr-1" :src="imageUrl" alt="" />
                <div >
                    <input accept=".svg" hidden class="" @change="fileChange" type="file" name="item_image" ref="file" >
                    <v-btn @click="$refs.file.click()" class="pr-1" type='file' color="green" flat >change Image</v-btn>
                </div> 
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn
            color="error"
            flat
            @click="createLevel"
          >Discard</v-btn>
          <v-btn
            color="success"
            flat
            @click="createLevel"
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
            imageUrl:null,
            buildingID:null,
            LEVEL_CREATED:1,
            levelName:"",
            open:false,
            loading:false,
            response:"",
            status:0,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            nameRules:[v => !!v || 'Name is required',],
        }
    },methods:{
        openDialog(buildingID){
            this.buildingID=buildingID;
            this.open=!this.open;
        },createLevel(){
            if(this.levelName === ""){
                this.response = "<p class='error--text'>Level name is required</p>";
            }else{
                this.loading = true;
                axios.post('/levels/create', {
                        name: this.levelName,
                        building_id:this.buildingID,
                        csrf:this.csrf,
                    })
                    .then((response) => {     
                        this.response = response.data.response;
                        this.status = response.data.status;
                    })
                    .catch(function (error) {
                        console.log(error);
                    }).then((response) => {     
                        if(this.status===this.LEVEL_CREATED){
                            this.$emit("level_created");
                            this.openDialog(this.buildingID);
                        }
                        this.loading = false;
                });
            }
        }
        ,clear:function () {
            this.levelName = "";
            this.response = "";   
            this.status = 0;   
        },fileChange(e){
            this.selectedFile = e.target.files[0];
            this.imageUrl = URL.createObjectURL(this.selectedFile);
        },
    }

}
</script>

<style scoped>
.responsive{
    width: 100%;
    height: auto;
}
</style>