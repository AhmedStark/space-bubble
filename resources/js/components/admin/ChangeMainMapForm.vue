<template>
    <v-dialog width="600" v-model="open">
       <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Change main map
        </v-card-title>

        <v-card-text>   
            <div v-html="response"></div>
            <v-progress-circular
                v-if="loading"
                indeterminate
                color="primary"
                ></v-progress-circular>

                <img large class="responsive pr-1" :src="imageUrl" alt="" />
                <input accept=".svg" hidden class="" @change="fileChange" type="file" name="item_image" ref="file" >
                <v-btn @click="$refs.file.click()" class="pr-1" type='file' color="green" flat>upload map</v-btn>
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
            @click="changeMap"
          >Create</v-btn>
          <v-btn
            color="success"
            flat
            v-if="editMode"
            @click="editLevel"
          >Edit</v-btn>
        </v-card-actions>
      </v-card> 
    </v-dialog>
</template>
<script>
const axios = require('axios');
export default {
    props:{
        
    },
    data(){
        return{
            editMode:false,
            id:null,
            imageUrl:null,
            MAP_CHANGED:1,
            levelName:"",
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
        },changeMap(){
            var bodyFormData = new FormData();
            bodyFormData.append('map', this.selectedFile);
            var url = '/admin/change-main-map';
            axios(
                {
                    method:'post',
                    url:url,
                    data:bodyFormData,
                    config:{ headers: {'Content-Type': 'multipart/form-data' }}
                }
            )
                    .then( (response)=> {
                        this.response = response.data.response;
                        this.status = response.data.status;

                    })
                    .catch(function (error) {
                    })
                    .then( ()=> {
                           
                        if(this.status===this.MAP_CHANGED){
                            this.$emit("map_changed");
                            this.openDialog();
                            this.clear();
                        }
                        this.loading = false;
                    });
        }
        ,clear:function () {
            this.levelName = "";
            this.response = "";   
            this.status = 0;
            this.imageUrl = null;
        },fileChange(e){
            this.selectedFile = e.target.files[0];
            this.imageUrl = URL.createObjectURL(this.selectedFile);
        },edit:function (id,name) {
            this.levelName = name;
            this.id=id;
            this.openDialog(null);
            this.editMode = true;
        }
    }

}
</script>

<style scoped>
.responsive{
    width: 100%;
    height: auto;
}
</style>