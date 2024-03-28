<template>
<div class="LoginBackground">
<form v-on:submit.prevent="submitLogin">
    <div class="loginForm">
    <label for="email">Email</label>
    <input type="email" name="" id="">
    <label for="password">Senha</label>
    <input type="password" name="" id="">
    <input type="submit" value="Login">
    </div>
</form></div>
</template>
<style lang="scss">
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
        flex-direction: column;;
    }
    form{
        background-color: rgb(255, 255, 255);
        padding: 10px;
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