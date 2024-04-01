
<template>
    
<div class="LoginBackground">
    <v-card title="Login">
<form v-on:submit.prevent="submitLogin">
    <div class="loginForm">
        <v-text-field label="Email" type="email" variant="outlined"></v-text-field>
        <v-text-field label="Senha" type="password" variant="outlined"></v-text-field>
        <v-btn class="btn-form" color="primary">
            Login
        </v-btn>
        <p style="text-align: center; margin: 0.4rem;">Ainda não tem uma conta? <a href="">Clique aqui</a></p>
    </div>
</form></v-card></div>
</template>
<style lang="scss">
.btn-form{
   width: 100%
}
.LoginBackground{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
  
}
    .loginForm{
        display: flex;
        justify-content: center;
        align-content: center;
        flex-direction: column;
        
    }
    form{
        padding: 10px; width: 20rem;
    }
</style>
<script>
import axios from "axios";
export default{
    data(){
        return{
            login:{
                email:null,
                password: null
            },
            loading: false,
        };
    },
    methods: {
        submitLogin(){
            this.loading = true;
            axios
            .post('/login', {
                email: this.login.email,
                password: this.login.password
            })
            .then((response) => console.log(response));
        }
    }
}
</script>