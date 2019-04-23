<template>
    <div>
    <v-layout>
        <v-flex lg3 sm12 >
            <v-card height="105%" elevation="4">
                <v-card-title><h3 class="display-1">This map wasn't found</h3></v-card-title>
                <v-card-text>
                    <v-btn round  color="green" dark large href="/"><v-icon>home</v-icon> Go back to the main page</v-btn>
                </v-card-text>
            </v-card>
        </v-flex>
        <v-flex lg9 sm12>
             <img src="/404-map.svg" alt="" class="responsive">
        </v-flex>
    </v-layout>
</div>
</template>
<style>
.responsive{
    width: 100%;
    height: 105%;
}
</style>
