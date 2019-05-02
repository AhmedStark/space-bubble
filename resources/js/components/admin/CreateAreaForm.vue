<template>
    <v-dialog width="600" v-model="open">
       <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Create a new area
        </v-card-title>

        <v-card-text>
            <v-text-field
                v-model="areaName"
                :rules="nameRules"
                label="area name"
                required
            ></v-text-field>
            <div v-html="response"></div>
            <v-progress-circular
                v-if="loading"
                indeterminate
                color="primary"
                ></v-progress-circular><!--
<img large class="responsive pr-1" :src="imageUrl" alt="" />
                <div >
                    <input accept=".svg" hidden class="" @change="fileChange" type="file" name="item_image" ref="file" >
                    <v-btn @click="$refs.file.click()" class="pr-1" type='file' color="green" flat >change Image</v-btn>
                </div> -->
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn
            color="error"
            flat
            @click="openDialog(null)"
          >Discard</v-btn>
          <v-btn
            color="success"
            flat
            v-if="!editMode"
            @click="createArea"
          >Create</v-btn>
          <v-btn
            color="success"
            flat
            v-if="editMode"
            @click="editArea"
          >Edit</v-btn>
        </v-card-actions>
      </v-card> 
    </v-dialog>
</template>
<script>
const axios = require('axios');
export default {
    data(){
        return{
            id:null,
            editMode:false,
            imageUrl:null,
            levelID:null,
            AREA_CREATED:1,
            areaName:"",
            open:false,
            loading:false,
            response:"",
            status:0,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            nameRules:[v => !!v || 'Name is required',],
        }
    },methods:{

    edit:function (id,name) {
            this.areaName = name;
            this.id=id;
            this.openDialog(null);
            this.editMode = true;
        },
        fileChange(e){
            this.selectedFile = e.target.files[0];
            this.imageUrl = URL.createObjectURL(this.selectedFile);
        },
        openDialog(levelID){
            this.levelID=levelID;
            this.open=!this.open;
            if(this.open==false){
                this.clear();
            }
            this.editMode=false;
        },createArea(){
            if(this.areaName === ""){
                this.response = "<p class='error--text'>area name is required</p>";
            }else{
                this.loading = true;
                axios.post('/areas/create', {
                        name: this.areaName,
                        level_id:this.levelID,
                        csrf:this.csrf,
                    })
                    .then((response) => {     
                        this.response = response.data.response;
                        this.status = response.data.status;
                    })
                    .catch(function (error) {
                        console.log(error);
                    }).then((response) => {     
                        if(this.status===this.AREA_CREATED){
                            this.$emit("area_created");
                            this.openDialog(this.buildingID);
                        }
                        this.loading = false;
                });
            }
        },editArea(){
            console.log("editing area");
            var bodyFormData = new FormData();
            
            bodyFormData.set('name',this.areaName);
            bodyFormData.set('_token',this.csrf);
            var url = '/area/'+this.id+'/edit';
            axios(
                {
                    method:'post',
                    url:url,
                    data:bodyFormData,
                }
            )
                    .then( (response)=> {
                        this.response = response.data.response;
                        this.status = response.data.status;
                    })
                    .catch(function (error) {
                    })
                    .then( ()=> {
                           
                        if(this.status===this.AREA_CREATED){
                            this.$emit("area_created");
                            this.openDialog(this.buildingID);
                        }
                        this.loading = false;
                    });
        }
        ,clear:function () {
            this.areaName = "";
            this.response = "";   
            this.status = 0;   
        }
    }

}
</script>