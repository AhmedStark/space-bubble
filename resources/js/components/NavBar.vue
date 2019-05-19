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
            drawer:false,
            adminLinks:[
                {icon:"map",title:"Maps",link:"/admin/"},
                {icon:"help",title:"Help",link:"/admin/help"},
            ]
        }
    },
    methods:{
        opneDrawer:function () {
            this.drawer=!this.drawer;
        }
    }
}
</script>
<style scoped>
a{
    text-decoration: none;
}
</style>