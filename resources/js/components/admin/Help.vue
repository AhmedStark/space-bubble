<template>
<admin-help-layout title="Admin help page"> 
    <template slot="side-nav-up">
            <h3 class="title" >Menu</h3>
            <v-divider class=" my-2"></v-divider>
            <a class="link" href="/admin/dashboard"><v-icon color="yellow darken-1">dashboard</v-icon> Dashboard</a><br>
            <a class="link" href="/admin/dashboard"><v-icon color="blue darken-1">map</v-icon> map</a>
    </template>
    <template slot="main" >

        <div class="py-3">
            <ul class="list">
                <li><a href="#1" class="linkHash"><b>Creating map layout</b></a>
                    <ul class="list" >
                        <li class="listItem"><a href="#building" class="linkHash">Buildings</a></li>
                        <ul class="list">
                            <li class="listItem"><a href="#building-create">Creating buildings</a></li>
                            <li class="listItem"><a href="#building-edit">Editing buildings</a></li>
                            <li class="listItem"><a href="#building-delete">Deleting buildings</a></li>
                        </ul>
                        <li class="listItem"><a href="#2" class="linkHash">Levels</a></li>
                        <ul class="list">
                            <li class="listItem"><a href="#level-create">Creating levels</a></li>
                            <li class="listItem"><a href="#level-edit">Editing levels</a></li>
                            <li class="listItem"><a href="#level-delete">Deleting levels</a></li>
                        </ul>
                        <li><a href="#3" class="linkHash">Area</a></li>
                        <ul class="list">
                            <li class="listItem"><a href="#area-create">Creating areas</a></li>
                            <li class="listItem"><a href="#area-edit">Editing areas</a></li>
                            <li class="listItem"><a href="#area-delete">Deleting areas</a></li>
                        </ul>
                        <li><a href="#3" class="linkHash">Tables/Seats</a></li>
                    </ul>
                </li>
                <li><a href="#4" class="linkHash" ><b>Drawing maps</b></a>
                    <ul class="list">
                        <li class="listItem"><a href="#5" class="linkHash">File format</a></li>
                        <li class="listItem"><a href="#6" class="linkHash">Integrating maps</a></li>
                    </ul>
                </li>
            </ul>                        
        
        </div>
        <v-divider></v-divider>
        <div id="1" class="py-4">
            <h3 class="display-1  font-weight-light mb-4"># Creating map layout</h3>
            <div class="mx-4" id="2">
                <h6 class="headline font-weight-regular mb-3" id="building">Buildings</h6>
                    <admin-help-instruction title="Creating a building" id="building-create" >
                        <template slot="instructions">
                            <ol>
                                <li>Click on the add Building button <img height="30" src="/imgs/building_button.png"  alt=""> on the top left of the page</li>
                                <li>Key in the building name and press Create</li><br>
                                <img src="/imgs/create_building_form.png" alt="">
                            </ol>
                            
                        </template>
                    </admin-help-instruction>

                    <admin-help-instruction title="Editing buildings' details" id="building-edit" class="mt-4">
                        <template slot="instructions">
                            <ol>
                                <li>Click on the the edit icon <v-icon>edit</v-icon> on the building you want to edit</li>
                                <li>Change the values and press edit</li><br>
                                <img src="/imgs/edit_building_form.png" alt="">
                            </ol>
                            
                        </template>
                    </admin-help-instruction>
                    

                    <h6 class="title mt-4" id="building-delete">Deleting buildings :-</h6>
                    <p>To delete a building click on the delete icon <v-icon color="red">delete</v-icon></p>

            </div>
            <v-divider class="my-3"></v-divider>
            <div class="ml-4" id="3">
                <h6 class="headline font-weight-regular mb-3">Levels</h6>
                
            </div>
        </div>
    </template>
</admin-help-layout>
</template>

<script>
export default {
    data(){
        return{

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
.list{
    list-style-type: none;
}
.listItem::before{
    content:"# "
}
title{
    text-decoration: none
}

</style>