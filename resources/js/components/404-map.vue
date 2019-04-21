<template>
    <v-layout>
        <v-flex lg3 >
            <v-card height="100%" elevation="4">
                <v-card-title><h3 class="display-1">This map wasn't found</h3></v-card-title>
                <v-card-text>
                    <v-btn round  color="green" dark large href="/"><v-icon>home</v-icon> Go back to the main page</v-btn>
                </v-card-text>
            </v-card>
        </v-flex>
        <v-flex lg9 >
             <img src="/404-map.svg" alt="" class="responsive">
        </v-flex>
    </v-layout>
</template>
<style>
.responsive{
    width: 100%;
    height: auto;
}
</style>
