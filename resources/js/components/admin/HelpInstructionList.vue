<template>
    <div>
        <h6 class="title">{{title}}</h6>
        <v-sheet   class="grey lighten-4 mx-1 my-2">
        <slot name="instructions">

        </slot>
        
        </v-sheet>    
    </div>    
</template>
<script>
export default {
    props:{
        title:{
            type:String,default:""
        }
    }
}
</script>
