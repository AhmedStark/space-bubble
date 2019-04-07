<template>
    <v-container>
        <v-layout>
            <v-flex md6 offset-md3 xs12>
                <v-card>
                    <v-card-title><h3 class="display-1">Admin login</h3></v-card-title>
                    <v-card-text>
                        <v-form id="login-form" action="/admin/login" method="post">
                            <v-text-field
                                
                                :rules="nameRules"
                                label="Login-ID"
                                required
                            ></v-text-field>
                            <input type="hidden" name="_token" :value="csrf" />
                            <v-text-field
                                type="password"                            
                                label="Password"
                                required
                            ></v-text-field>
                            <p v-html="response"></p>
                            <v-btn form="login-form" color="green" dark type="submit">Login</v-btn>
                        </v-form>
                        
                    </v-card-text>
                </v-card>
            </v-flex>
            
        </v-layout>
    </v-container>
</template>
<script>
export default {
    props:{
        response:{default:"",type:String}
    },
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            nameRules:[v => !!v || 'Name is required',],
        }
    }
}
</script>
