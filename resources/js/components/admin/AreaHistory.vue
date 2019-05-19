<template>
    <div>
        <v-container >
            <v-layout row>
            <v-flex md4>
                <v-card >
                    <v-card-title>Choose a building</v-card-title>
                    <v-card-text></v-card-text>
                </v-card>
            </v-flex>
            <v-flex md7>
                  <apexchart  width="100%" type="line" :options="options" :series="series"></apexchart>
            </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>
<script>

export default {
data(){
        return{
            options: {
                 palette: 'palette2',
                chart: {
                id: 'vuechart-example'
                },
                xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                }
            },
            series: [
                {
                    name: 'Lab-2',
                    data: [30, 10, 15, 50, 49, 70, 70, 91]
                },
                {
                    name: 'Lab-1',
                    categories: [ 1992, 1993, 1994, 1995, 1996, 1997, 1998],
                    data: [null,30, 40, 45, 10, 49, 30, 50]
                },
            ]
        }
    }
}
</script>
