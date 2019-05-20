<template>
    <nav>
    <v-toolbar
        color="blue darken-1"
         flat
        dark
    >
         <v-toolbar-side-icon v-if="admin" @click="opneDrawer"></v-toolbar-side-icon>
        <a href="/"><v-toolbar-title class="white--text text-uppercase" ><span class="font-weight-light">Space</span><span> Bubble</span></v-toolbar-title>
                    </a>

    </v-toolbar>
      <v-navigation-drawer  dark class="purple" v-if="admin" temporary  app v-model="drawer">
    <v-list>

      <v-list-tile :href="adminLink.link" v-for="(adminLink,index) in adminLinks" :key="'admin-link'+index">
        <v-list-tile-action>
          <v-icon>{{adminLink.icon}}</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{adminLink.title}}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

    </v-list>
    <v-divider></v-divider>
    <v-switch
      v-model="darkMode"
      @input="changeMode"
      label="Dark mode (still in beta)"
    ></v-switch>
      </v-navigation-drawer>
    </nav>
</template>
<script>
export default {
    props:{
        admin:{default:false,type:Boolean}
    },
    data(){
        return {
          darkMode:this.$cookies.get("dark_mode")==="on",
            drawer:false,
            adminLinks:[
                {icon:"map",title:"Maps",link:"/admin/"},
                {icon:"help",title:"Help",link:"/admin/help"},
                {icon:"tab",title:"Data",link:"/admin/area-history"},
            ]
        }
    },
    methods:{
        opneDrawer:function () {
            this.drawer=!this.drawer;
        },
        changeMode:function(){
          console.log("Dark mode ::",this.darkMode);
          this.darkMode ? this.$cookies.set('dark_mode', 'on'):this.$cookies.set("dark_mode","off");
        }
    },watch: {
    // whenever question changes, this function will run
    darkMode: function (newValue, oldValue) {
      this.darkMode ? this.$cookies.set('dark_mode', 'on'):this.$cookies.set("dark_mode","off"); 
      this.$emit('changeMode');
    }
  },
}
</script>
<style scoped>
a{
    text-decoration: none;
}
</style>