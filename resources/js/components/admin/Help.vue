<template >
<admin-help-layout title="Admin help page"> 
    <template slot="side-nav-up">
            <h3 class="title" >Menu</h3>
            <v-divider class=" my-2"></v-divider>
            <a :class="this.$attrs.dark?'linkDark':'link'" href="/admin/dashboard"><v-icon color="yellow darken-1">dashboard</v-icon> Dashboard</a><br>
            <a :class="this.$attrs.dark?'linkDark':'link'" href="/"><v-icon color="blue darken-1">map</v-icon> map</a>
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
                        <li class="listItem"><a href="#level" class="linkHash">Levels</a></li>
                        <ul class="list">
                            <li class="listItem"><a href="#level-create">Creating levels</a></li>
                            <li class="listItem"><a href="#level-edit">Editing levels</a></li>
                            <li class="listItem"><a href="#level-delete">Deleting levels</a></li>
                        </ul>
                        <li><a href="#area" class="linkHash">Area</a></li>
                        <ul class="list">
                            <li class="listItem"><a href="#area-create">Creating areas</a></li>
                            <li class="listItem"><a href="#area-edit">Editing areas</a></li>
                            <li class="listItem"><a href="#area-delete">Deleting areas</a></li>
                        </ul>
                        <li><a href="#table" class="linkHash">Tables/Seats</a></li>
                        <ul class="list">
                            <li class="listItem"><a href="#table-show">Show area tables/seats</a></li>
                            <li class="listItem"><a href="#table-create">Creating tables/seats</a></li>
                            <li class="listItem"><a href="#table-delete">Deleting tables/seats</a></li>
                        </ul>
                    </ul>
                </li>
                <li><a href="#map" class="linkHash" ><b>Drawing maps</b></a>
                    <ul class="list">
                        <li class="listItem"><a href="#map-file" class="linkHash">File format</a></li>
                        <li class="listItem"><a href="#map-integrate" class="linkHash">Integrating maps</a></li>
                    </ul>
                </li>
            </ul>                        
        
        </div>
        <v-divider></v-divider>
        <div class="py-4">
            <h3 class="display-1  font-weight-light mb-4"># Creating map layout</h3>
            <div class="mx-4" id="2">
                <h6 class="headline font-weight-regular mb-3" id="building">Buildings</h6>
                    <admin-help-instruction title="Creating a building" id="building-create" >
                        <template slot="instructions">
                            <ol>
                                <li>Click on the add Building button <v-btn color="green" dark>CREATE A BUILDING</v-btn> on the top left of the page</li>
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
                    <p>To delete a building click on the delete icon <v-icon color="red">delete</v-icon> on that building.</p>

            </div>
            <v-divider class="my-3"></v-divider>
            <div class="ml-4" id="level">
                <h6 class="headline font-weight-regular mb-3">Levels</h6>
                <admin-help-instruction title="Creating a Level" id="level-create" >
                    <template slot="instructions">
                        <ol>
                            <li>Click on the add new level to this building button <v-btn color="blue" dark>ADD NEW LEVEL TO THIS BUILDING</v-btn></li>
                            <li>Key in the Level name and press Create</li><br>
                            <img src="/imgs/create_level_form.png" alt="">
                        </ol>
                        
                    </template>
                </admin-help-instruction>
                <admin-help-instruction title="Editing a Level" id="level-edit" class="mt-4" >
                    <template slot="instructions">
                        <ol>
                            <li>Click on the edit icon edit a level <v-icon>edit</v-icon>.</li>
                            <li>Key in the level's name.</li>
                            <li>click upload map button <v-btn flat color="green" small>upload map</v-btn> and choose a file to change the level's map. (The map has to be in <b>SVG</b> format)</li>
                            <img src="/imgs/edit_level_form.png" alt="">
                            <li>Press on edit to save the changes.</li>
                        </ol>
                    </template>
                </admin-help-instruction>
                <h6 class="title mt-4" id="level-delete">Deleting levels :-</h6>
                <p>To delete a level click on the delete icon <v-icon color="red">delete</v-icon> on that level.</p>
            </div>
            
            <v-divider class="my-3"></v-divider>

            <div class="ml-4" id="area">
                <h6 class="headline font-weight-regular mb-3">Areas</h6>
                <admin-help-instruction title="Creating an Area" id="area-create">
                    <template slot="instructions">
                        <ol>
                            <li>Click on add new area button <v-btn color="blue" dark>ADD NEW AREA TO THIS LEVEL</v-btn></li>
                            <li>Key in the area's name then press <v-btn flat color="green" small>Create</v-btn></li>
                            <img src="/imgs/create_area_form.png" alt="">
                        </ol>
                    </template>
                </admin-help-instruction>
                <admin-help-instruction id="area-edit" class="mt-4" title="Creating an Area">
                    <template slot="instructions">
                        <ol>
                            <li>Click on the edit icon edit an area <v-icon>edit</v-icon>.</li>
                            <li>Key in the area's name then press <v-btn flat color="green" small>Edit</v-btn></li>
                            <img src="/imgs/edit_area_form.png" alt="">
                            <li>Press on edit to save the changes.</li>
                        </ol>
                    </template>
                </admin-help-instruction>
                <h6 class="title mt-4" id="area-delete">Deleting Areas :-</h6>
                <p>To delete a area click on the delete icon <v-icon color="red">delete</v-icon> on that level.</p>

            </div>
            <v-divider class="my-3"></v-divider>
            <div class="ml-4" id="table">
                <h6 class="headline font-weight-regular mb-3">Tables/Seats</h6>
                
                <h6 class="title mt-4" id="table-show">showing an area's seats/tables</h6>
                <p>To show an area seats/tables you can click on the <u class="blue--text">seats</u> link on that area.
                after that you will see the area's page which will show you the tables/seats and their tokens</p>

                <admin-help-instruction id="table-create" class="mt-4" title="Creating tables/seats">
                    <template slot="instructions">
                        <ol>
                            <li>Click on <v-btn color="green" dark small>Add new table</v-btn></li>
                            <li>You will see the seat with its token</li>
                        </ol>
                    </template>
                </admin-help-instruction>
                <h6 class="title mt-4" id="table-delete">Deleting seats/tables :-</h6>
                <p>
                    Click on <v-icon color="red">delete</v-icon> to delete a seat/table.
                </p>
                
                <v-divider class="my-3"></v-divider>
                <h3 class="display-1  font-weight-light mb-4" id="map"># Drawing maps</h3>
                <h6 class="title mt-4" id="map-file">Deleting seats/tables :-</h6>
                <p>The level map file uploaded must be in <b class="blue--text">SVG</b> format. Many programs can be used to draw these maps on of the softwares that we highly recommend is <a target="_blank" href="https://inkscape.org/">Inkscape</a>.</p>
                <h6 class="title mt-4" id="map-integrate">Integrating maps</h6>
                <p>When drawing a map a set of rules must be followed to ensure that the map will be reactive in the website. 
                    <ol>
                        <li>You need to create the areas of the level you want to show in the map in the <a href="/admin/dashboard">dashboard <v-icon color="blue"> dashboard</v-icon></a> before uploading the map.</li>
                        <li>After creating the areas start assigning the area IDs to the object IDs in your drawing software by giving them an ID of <span class="grey lighten-2">area-[Area's shown ID]</span> .</li>
                        <li>You can also assign ids to the text to show the area map and the number of seats by giving the test objects an ID of <span class="grey lighten-2">text-[Area's shown ID]</span> .</li>
                        <li>Uploade the map after that by clicking edit on the level you create and clicking <v-btn flat color="green">upload map</v-btn></li>
                    </ol>          
                </p>
                
            </div>
            <div></div>
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
.link:hover ,.linkDark:hover{
    color:blue;        
}
.list{
    list-style-type: none;
}
.listItem::before{
    content:"# ";
    
}
title{
    text-decoration: none
}
.linkDark{
    color:white;
    text-decoration: none;
}


</style>