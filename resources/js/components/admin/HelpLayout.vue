<template>
<v-container>
    <v-layout row>
        
        <v-flex  :md3="!big" v-if="!big" lg3 class="hidden-sm-and-down" >
            <v-card>
                <v-card-text>
                    <slot name="side-nav-up">

                    </slot>
                </v-card-text>
            </v-card>
        </v-flex>
        <v-flex :md9="!big" :md12="big" >

            <v-card class="mx-1">
                <v-card-text >
                    <h3 class="display-2 font-weight-light pb-4">{{this.title}}</h3>
                <v-btn small flat color='blue' @click="bigScreen">
                    
                    <v-icon v-if="!big">keyboard_arrow_leftkeyboard_arrow_leftkeyboard_arrow_left</v-icon>
                    <v-icon v-if="big">keyboard_arrow_rightkeyboard_arrow_rightkeyboard_arrow_right</v-icon>
                </v-btn>
                <!--The component that will load in the main layout -->
                <slot name="main"></slot>
                </v-card-text >
            </v-card>
        </v-flex>
        <v-btn      color="purple"
                    key="add"
                    @click="goUp"
                    dark
                    fixed
                    bottom
                    right
                    fab
                ><v-icon>arrow_drop_up</v-icon></v-btn>
    </v-layout>
    </v-container>
</template>
<script>
export default {
    props:{
        showMenuList:{
            type:Boolean,
            default:false
        },
        page:{
            
            type:String,
            default:""
        },
        title:{
            type:String,
            default:""
        }
    },
    components:{
    },
    data(){

        return{
            menuList:this.showMenuList,
            big:false,
            pagesList:true,
            sideLinks:[
                {id:1,name:"Pages",children:[{name:"Home"},{name:"<a href='#'>about-us</a>"}]}
            ],
            
        }
    },
    methods:{
        openPagesList:function(event){
            event.preventDefault();
            this.pagesList = !this.pagesList;
        },bigScreen:function(){
            this.big = !this.big;
        },goUp:function(){
            window.scrollTo(0,0); 
        }
        ,goUpALittle:function(){
            
        }
    }
}
</script>
<style scoped>
.link{
    color:black;
    text-decoration: none;
}
.link:hover{
    color:blue;        
}
ul{
        
    list-style-type: none;
}
li::before{
    content:"# "
}
title{
    text-decoration: none
}
</style>
